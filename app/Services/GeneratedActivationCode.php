<?php

namespace App\Services;

use App\Models\ActivationCode;

readonly class GeneratedActivationCode
{
    public function __construct(
        public ActivationCode $activationCode,
        public string $plainTextCode,
    ) {
    }
}
