<?php

namespace App\Services;

use App\Enums\AccountStatus;
use App\Enums\UserRole;
use App\Models\ActivationCode;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ActivationCodeService
{
    public function generate(Resident $resident, User $creator): GeneratedActivationCode
    {
        abort_unless($resident->isEligibleForActivation(), 422, 'Resident is not eligible for activation.');

        $plainTextCode = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');

        $activationCode = DB::transaction(function () use ($resident, $creator, $plainTextCode): ActivationCode {
            ActivationCode::query()
                ->where('resident_id', $resident->id)
                ->whereNull('used_at')
                ->whereNull('revoked_at')
                ->whereNull('pending_user_id')
                ->update(['revoked_at' => now()]);

            return ActivationCode::query()->create([
                'tenant_id' => $resident->tenant_id,
                'resident_id' => $resident->id,
                'created_by' => $creator->id,
                'code_hash' => Hash::make($plainTextCode),
                'lookup_hash' => $this->lookupHash($plainTextCode),
                'expires_at' => now()->addHours(config('activation.code_ttl_hours')),
            ]);
        });

        return new GeneratedActivationCode($activationCode, $plainTextCode);
    }

    public function findClaimable(string $plainTextCode): ?ActivationCode
    {
        $activationCode = ActivationCode::query()
            ->with('resident')
            ->where('lookup_hash', $this->lookupHash($plainTextCode))
            ->first();

        if ($activationCode === null || ! Hash::check($plainTextCode, $activationCode->code_hash)) {
            return null;
        }

        return $activationCode->isClaimable() && $activationCode->resident->isEligibleForActivation()
            ? $activationCode
            : null;
    }

    public function claim(ActivationCode $activationCode, string $email, string $password): User
    {
        return DB::transaction(function () use ($activationCode, $email, $password): User {
            $activationCode = ActivationCode::query()
                ->with('resident')
                ->lockForUpdate()
                ->findOrFail($activationCode->id);

            if (! $activationCode->isClaimable() || ! $activationCode->resident->isEligibleForActivation()) {
                throw ValidationException::withMessages(['code' => __('Kode aktivasi tidak valid atau tidak dapat digunakan.')]);
            }

            if (User::query()->where('email', $email)->exists()) {
                throw ValidationException::withMessages(['email' => __('Alamat email sudah digunakan.')]);
            }

            $user = new User;
            $user->forceFill([
                'tenant_id' => $activationCode->tenant_id,
                'resident_id' => $activationCode->resident_id,
                'name' => $activationCode->resident->name,
                'email' => $email,
                'password' => $password,
                'role' => UserRole::Resident,
                'status' => AccountStatus::Pending,
            ])->save();

            $activationCode->update(['pending_user_id' => $user->id]);

            return $user;
        });
    }

    public function completeAfterEmailVerification(User $user): void
    {
        if (! $user->isResident() || $user->resident_id === null || $user->status !== AccountStatus::Pending) {
            return;
        }

        DB::transaction(function () use ($user): void {
            $pendingUser = User::query()->lockForUpdate()->findOrFail($user->id);
            $activationCode = ActivationCode::query()
                ->where('pending_user_id', $pendingUser->id)
                ->lockForUpdate()
                ->first();

            if ($activationCode === null || $activationCode->used_at !== null || $activationCode->revoked_at !== null) {
                return;
            }

            $pendingUser->forceFill(['status' => AccountStatus::Active])->save();
            $activationCode->update(['used_at' => now()]);
        });
    }

    public function revoke(ActivationCode $activationCode): void
    {
        abort_unless($activationCode->isClaimable(), 422, 'Activation code cannot be revoked.');

        $activationCode->update(['revoked_at' => now()]);
    }

    private function lookupHash(string $plainTextCode): string
    {
        return hash_hmac('sha256', $plainTextCode, (string) config('app.key'));
    }
}
