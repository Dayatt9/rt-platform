<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivationCode;
use App\Models\Resident;
use App\Services\ActivationCodeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ResidentActivationController extends Controller
{
    public function show(Resident $resident): View
    {
        Gate::authorize('view', $resident);

        return view('admin.residents.activation', [
            'resident' => $resident,
            'activationCodes' => ActivationCode::query()
                ->where('resident_id', $resident->id)
                ->latest()
                ->get(),
        ]);
    }

    public function store(Request $request, Resident $resident, ActivationCodeService $activationCodes): Response
    {
        Gate::authorize('generateActivation', $resident);

        $generated = $activationCodes->generate($resident, $request->user());

        return response()->view('admin.residents.activation-created', [
            'resident' => $resident,
            'activationCode' => $generated->activationCode,
            'plainTextCode' => $generated->plainTextCode,
        ])->header('Cache-Control', 'no-store, private')
            ->header('Pragma', 'no-cache');
    }

    public function destroy(Resident $resident, ActivationCode $activationCode, ActivationCodeService $activationCodes): RedirectResponse
    {
        abort_unless($activationCode->resident_id === $resident->id, 404);
        Gate::authorize('revokeActivation', [$resident, $activationCode]);

        $activationCodes->revoke($activationCode);

        return to_route('admin.residents.activation.show', $resident)
            ->with('status', 'Kode aktivasi telah dicabut.');
    }
}
