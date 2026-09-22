<?php

namespace App\Listeners;

use App\Models\User;
use App\Services\ActivationCodeService;
use Illuminate\Auth\Events\Verified;

class ActivateVerifiedResidentAccount
{
    public function __construct(private ActivationCodeService $activationCodes) {}

    public function handle(Verified $event): void
    {
        if ($event->user instanceof User) {
            $this->activationCodes->completeAfterEmailVerification($event->user);
        }
    }
}
