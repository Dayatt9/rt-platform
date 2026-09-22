@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Kode aktivasi dibuat</h1>
            <p class="mt-1 text-sm text-slate-600">Berikan kode ini kepada {{ $resident->name }}. Kode hanya ditampilkan pada halaman ini.</p>
        </div>

        <div class="rounded-lg border border-teal-200 bg-teal-50 p-6">
            <p class="font-mono text-xl font-bold tracking-wide text-slate-900 break-all">{{ $plainTextCode }}</p>
            <p class="mt-3 text-sm text-slate-700">Berlaku sampai {{ $activationCode->expires_at }}.</p>
        </div>

        <a href="{{ route('admin.residents.activation.show', $resident) }}" class="text-sm font-medium text-teal-700">Kembali ke status aktivasi</a>
    </div>
@endsection
