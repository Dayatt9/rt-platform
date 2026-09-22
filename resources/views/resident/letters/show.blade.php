@extends('layouts.app')
@section('title', 'Detail Surat - RT Platform')
@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
        <a href="{{ route('dashboard') }}" class="hover:text-slate-900">Dashboard</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('resident.letters.index') }}" class="hover:text-slate-900">Surat Administrasi</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-900 font-medium">Detail</span>
    </div>

    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 pb-4">
        <div>
            <h1 class="text-2xl font-bold">Detail Pengajuan Surat</h1>
            <p class="text-sm text-slate-600">Diajukan pada {{ $request->requested_at->format('d/m/Y H:i') }}</p>
        </div>
        <div>
            @if($request->status->value === 'pending')
                <span class="inline-flex items-center gap-1.5 rounded bg-yellow-50 px-3 py-1.5 text-sm font-medium text-yellow-800 border border-yellow-200">Menunggu Review RT</span>
            @elseif($request->status->value === 'approved')
                <span class="inline-flex items-center gap-1.5 rounded bg-blue-50 px-3 py-1.5 text-sm font-medium text-blue-800 border border-blue-200">Disetujui RT</span>
            @elseif($request->status->value === 'completed')
                <span class="inline-flex items-center gap-1.5 rounded bg-green-50 px-3 py-1.5 text-sm font-medium text-green-800 border border-green-200">Selesai</span>
            @elseif($request->status->value === 'rejected')
                <span class="inline-flex items-center gap-1.5 rounded bg-red-50 px-3 py-1.5 text-sm font-medium text-red-800 border border-red-200">Ditolak RT</span>
            @endif
        </div>
    </div>

    @if($request->status->value === 'rejected')
        <div class="rounded-lg border border-red-200 bg-red-50 p-6">
            <h2 class="font-semibold text-lg text-red-800 border-b border-red-200 pb-2 mb-4">Pengajuan Ditolak</h2>
            <p class="text-sm text-red-900">{{ $request->rejection_reason }}</p>
        </div>
    @endif

    @if($request->status->value === 'completed')
        <div class="rounded-lg border border-green-200 bg-green-50 p-6">
            <h2 class="font-semibold text-lg text-green-800 border-b border-green-200 pb-2 mb-4">Surat Selesai</h2>
            <p class="text-sm text-green-900 mb-4">Pengajuan surat Anda telah diselesaikan. Silakan unduh dokumen surat Anda melalui tombol di bawah ini.</p>
            <a href="{{ route('resident.letters.download', $request) }}" class="inline-flex items-center gap-2 rounded bg-green-700 px-4 py-2 text-sm font-medium text-white hover:bg-green-800">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Download Dokumen
            </a>
        </div>
    @endif

    <div class="rounded-lg border border-slate-200 bg-white p-6 space-y-4">
        <h2 class="font-semibold text-lg border-b border-slate-100 pb-2">Informasi Pengajuan ({{ $request->snapshot_type_name }})</h2>
        <dl class="grid sm:grid-cols-2 gap-4 text-sm">
            @if(is_array($request->snapshot_fields) && is_array($request->request_data))
                @foreach($request->snapshot_fields as $field)
                    <div>
                        <dt class="text-slate-500">{{ $field['label'] ?? $field['name'] }}</dt>
                        <dd class="font-medium mt-1">{{ $request->request_data[$field['name']] ?? '-' }}</dd>
                    </div>
                @endforeach
            @else
                <p class="text-slate-500">Tidak ada data tambahan yang diisi.</p>
            @endif
        </dl>
    </div>
</div>
@endsection
