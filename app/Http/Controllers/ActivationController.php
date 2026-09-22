<?php

namespace App\Http\Controllers;

use App\Models\ActivationCode;
use App\Services\ActivationCodeService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ActivationController extends Controller
{
    public function create(): View
    {
        return view('activation.code');
    }

    public function validateCode(Request $request, ActivationCodeService $activationCodes): RedirectResponse
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:255'],
        ]);

        $activationCode = $activationCodes->findClaimable($data['code']);

        if ($activationCode === null) {
            return back()->withErrors(['code' => 'Kode aktivasi tidak valid atau tidak dapat digunakan.'])->onlyInput('code');
        }

        $request->session()->put('activation_code_id', $activationCode->id);

        return to_route('activation.account.create');
    }

    public function accountForm(Request $request): View|RedirectResponse
    {
        /** @var int|string|null $codeId */
        $codeId = $request->session()->get('activation_code_id');
        /** @var ActivationCode|null $activationCode */
        $activationCode = ActivationCode::query()
            ->with('resident')
            ->find($codeId);

        if ($activationCode === null || ! $activationCode->isClaimable() || ! $activationCode->resident->isEligibleForActivation()) {
            $request->session()->forget('activation_code_id');

            return to_route('activation.create')
                ->withErrors(['code' => 'Kode aktivasi tidak valid atau tidak dapat digunakan.']);
        }

        return view('activation.account');
    }

    public function storeAccount(Request $request, ActivationCodeService $activationCodes): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', Password::default(), 'confirmed'],
        ]);

        /** @var int|string|null $codeId */
        $codeId = $request->session()->get('activation_code_id');
        /** @var ActivationCode|null $activationCode */
        $activationCode = ActivationCode::query()->find($codeId);

        if ($activationCode === null) {
            return to_route('activation.create')
                ->withErrors(['code' => 'Kode aktivasi tidak valid atau tidak dapat digunakan.']);
        }

        $user = $activationCodes->claim($activationCode, strtolower($data['email']), $data['password']);

        event(new Registered($user));
        Auth::login($user);
        $request->session()->regenerate();
        $request->session()->forget('activation_code_id');

        return to_route('verification.notice');
    }
}
