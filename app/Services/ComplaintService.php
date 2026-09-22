<?php

namespace App\Services;

use App\Enums\ComplaintStatus;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class ComplaintService
{
    /**
     * @param  array{category: string, title: string, description: string}  $data
     */
    public function create(User $user, array $data, ?UploadedFile $attachment = null): Complaint
    {
        $complaint = new Complaint($data);
        $complaint->tenant_id = $user->tenant_id;
        $complaint->resident_id = $user->resident_id;
        $complaint->status = ComplaintStatus::Pending;

        if ($attachment !== null) {
            $path = $attachment->store(
                "complaints/{$user->tenant_id}/{$user->resident_id}",
                'local',
            );

            if ($path === false) {
                throw new RuntimeException('Failed to store complaint attachment.');
            }

            $complaint->attachment_path = $path;
        }

        $complaint->save();

        return $complaint;
    }

    public function transition(Complaint $complaint, ComplaintStatus $status): bool
    {
        if (! $complaint->status->canTransitionTo($status)) {
            return false;
        }

        $complaint->status = $status;
        $complaint->save();

        return true;
    }

    public function respond(Complaint $complaint, User $admin, string $response): void
    {
        $complaint->admin_response = $response;
        $complaint->responded_by = $admin->id;
        $complaint->responded_at = Carbon::now();
        $complaint->save();
    }

    public function attachmentDownloadName(Complaint $complaint): string
    {
        $extension = pathinfo((string) $complaint->attachment_path, PATHINFO_EXTENSION);

        return "lampiran-pengaduan-{$complaint->id}".($extension === '' ? '' : ".{$extension}");
    }

    public function attachmentExists(Complaint $complaint): bool
    {
        return $complaint->attachment_path !== null
            && Storage::disk('local')->exists($complaint->attachment_path);
    }
}
