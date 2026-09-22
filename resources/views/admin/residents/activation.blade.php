@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Aktivasi akun warga</h1>
            <p class="mt-1 text-sm text-slate-600">{{ $resident->name }}</p>
        </div>

        @if (session('status'))
            <div class="rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">{{ session('status') }}</div>
        @endif

        @if ($resident->isEligibleForActivation())
            <form method="POST" action="{{ route('admin.residents.activation.store', $resident) }}">
                @csrf
                <button type="submit" class="rounded-md bg-teal-700 px-4 py-2 text-sm font-medium text-white">Buat kode aktivasi</button>
            </form>
        @else
            <div class="rounded-md border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">
                Warga ini tidak dapat menerima kode aktivasi baru.
            </div>
        @endif

        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-700">
                    <tr><th class="px-4 py-3">Dibuat</th><th class="px-4 py-3">Berlaku sampai</th><th class="px-4 py-3">Status</th><th class="px-4 py-3"></th></tr>
                </thead>
                <tbody>
                    @forelse ($activationCodes as $activationCode)
                        <tr class="border-t border-slate-200">
                            <td class="px-4 py-3">{{ $activationCode->created_at }}</td>
                            <td class="px-4 py-3">{{ $activationCode->expires_at }}</td>
                            <td class="px-4 py-3">
                                @if ($activationCode->used_at) Digunakan
                                @elseif ($activationCode->revoked_at) Dicabut
                                @elseif ($activationCode->pending_user_id) Menunggu verifikasi email
                                @elseif ($activationCode->hasExpired()) Kedaluwarsa
                                @else Aktif @endif
                            </td>
                            <td class="px-4 py-3">
                                @if ($activationCode->isClaimable())
                                    <form method="POST" action="{{ route('admin.residents.activation.destroy', [$resident, $activationCode]) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-sm font-medium text-rose-700">Cabut</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-6 text-slate-500">Belum ada kode aktivasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
