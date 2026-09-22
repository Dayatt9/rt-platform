<?php

namespace App\Services;

use App\Models\LetterRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class LetterDocumentService
{
    public function generate(LetterRequest $request): string
    {
        $tenant = $request->tenant;
        $resident = $request->resident;
        $type = $request->letterType;

        $template = $type->template_body ?? '';

        $placeholders = [
            '{{resident_name}}' => $resident->name,
            '{{resident_nik}}' => $resident->nik,
            '{{resident_birth_date}}' => $resident->birth_date?->format('d/m/Y') ?? '-',
            '{{letter_number}}' => $request->letter_number ?? '-',
            '{{letter_date}}' => Carbon::now()->format('d/m/Y'),
            '{{rt_number}}' => str_pad($tenant->rt_number, 3, '0', STR_PAD_LEFT),
            '{{rw_number}}' => str_pad($tenant->rw_number, 3, '0', STR_PAD_LEFT),
            '{{village}}' => $tenant->village,
            '{{tenant_address}}' => $tenant->address,
        ];

        // Add custom fields from request_data
        if (is_array($request->snapshot_fields) && is_array($request->request_data)) {
            foreach ($request->snapshot_fields as $field) {
                $fieldName = $field['name'];
                $value = $request->request_data[$fieldName] ?? '-';
                $placeholders['{{'.$fieldName.'}}'] = htmlspecialchars((string) $value);
            }
        }

        // Escape values before replacement
        $safePlaceholders = [];
        foreach ($placeholders as $key => $value) {
            $safePlaceholders[$key] = htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
        }

        $content = strtr($template, $safePlaceholders);
        $content = nl2br($content);

        $html = sprintf(
            '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Surat Warga</title><style>body { font-family: serif; line-height: 1.5; padding: 2rem; max-width: 800px; margin: 0 auto; }</style></head><body>%s</body></html>',
            $content
        );

        $path = sprintf('letters/%d/%d/%s.html',
            $tenant->id,
            $request->resident_id,
            $request->letter_number ? str_replace('/', '_', $request->letter_number) : uniqid()
        );

        Storage::disk('local')->put($path, $html);

        return $path;
    }
}
