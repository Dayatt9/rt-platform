<?php

namespace App\Services;

use App\Models\LetterRequest;
use Illuminate\Support\Carbon;

class LetterNumberService
{
    public function generate(LetterRequest $request): string
    {
        $tenant = $request->tenant;
        $date = $request->requested_at ?? Carbon::now();

        // Format: {Type Code}/RT{RT}/RW{RW}/{Month}/{Year}/{Request ID}
        $typeCode = strtoupper(trim($request->snapshot_type_code));
        $rt = str_pad($tenant->rt_number, 3, '0', STR_PAD_LEFT);
        $rw = str_pad($tenant->rw_number, 3, '0', STR_PAD_LEFT);
        $month = $date->format('m');
        $year = $date->format('Y');

        $number = sprintf('%s/RT%s/RW%s/%s/%s/%04d',
            $typeCode,
            $rt,
            $rw,
            $month,
            $year,
            $request->id
        );

        return $number;
    }
}
