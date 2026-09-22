@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
        <a href="{{ route('admin.letters.index') }}" class="hover:text-slate-900">Surat Administrasi</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-900 font-medium">Detail Pengajuan</span>
    </div>

    <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-200 pb-4">
        <div>
            <h1 class="text-2xl font-bold">Detail Pengajuan Surat</h1>
            <p class="text-sm text-slate-600">Diajukan pada {{ $request->requested_at->format('d/m/Y H:i') }}</p>
        </div>
        <div>
            @if($request->status->value === 'pending')
                <span class="inline-flex items-center gap-1.5 rounded bg-yellow-50 px-3 py-1.5 text-sm font-medium text-yellow-800 border border-yellow-200">Menunggu Review</span>
            @elseif($request->status->value === 'approved')
                <span class="inline-flex items-center gap-1.5 rounded bg-blue-50 px-3 py-1.5 text-sm font-medium text-blue-800 border border-blue-200">Disetujui, Menunggu Diselesaikan</span>
            @elseif($request->status->value === 'completed')
                <span class="inline-flex items-center gap-1.5 rounded bg-green-50 px-3 py-1.5 text-sm font-medium text-green-800 border border-green-200">Selesai</span>
            @elseif($request->status->value === 'rejected')
                <span class="inline-flex items-center gap-1.5 rounded bg-red-50 px-3 py-1.5 text-sm font-medium text-red-800 border border-red-200">Ditolak</span>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="rounded-md bg-green-50 p-4 border border-green-200">
            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="rounded-md bg-red-50 p-4 border border-red-200">
            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
        </div>
    @endif

    <div class="grid md:grid-cols-2 gap-6">
        <div class="space-y-6">
            <div class="rounded-lg border border-slate-200 bg-white p-6">
                <h2 class="font-semibold text-lg border-b border-slate-100 pb-2 mb-4">Informasi Warga</h2>
                <dl class="space-y-3 text-sm">
                    <div><dt class="text-slate-500">Nama</dt><dd class="font-medium">{{ $request->resident->name }}</dd></div>
                    <div><dt class="text-slate-500">NIK</dt><dd class="font-medium">{{ $request->resident->nik }}</dd></div>
                    <div><dt class="text-slate-500">No. HP</dt><dd class="font-medium">{{ $request->resident->phone ?? '-' }}</dd></div>
                </dl>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white p-6">
                <h2 class="font-semibold text-lg border-b border-slate-100 pb-2 mb-4">Data Pengajuan ({{ $request->snapshot_type_name }})</h2>
                <dl class="space-y-3 text-sm">
                    @if(is_array($request->snapshot_fields) && is_array($request->request_data))
                        @foreach($request->snapshot_fields as $field)
                            <div>
                                <dt class="text-slate-500">{{ $field['label'] ?? $field['name'] }}</dt>
                                <dd class="font-medium">{{ $request->request_data[$field['name']] ?? '-' }}</dd>
                            </div>
                        @endforeach
                    @else
                        <p class="text-slate-500">Tidak ada data tambahan.</p>
                    @endif
                </dl>
            </div>

            @if($request->status->value === 'rejected')
                <div class="rounded-lg border border-red-200 bg-red-50 p-6">
                    <h2 class="font-semibold text-lg text-red-800 border-b border-red-200 pb-2 mb-4">Alasan Penolakan</h2>
                    <p class="text-sm text-red-900">{{ $request->rejection_reason }}</p>
                    <p class="text-xs text-red-700 mt-2">Ditolak oleh {{ $request->processor?->name }} pada {{ $request->processed_at?->format('d/m/Y H:i') }}</p>
                </div>
            @endif

            @if($request->status->value === 'completed')
                <div class="rounded-lg border border-green-200 bg-green-50 p-6">
                    <h2 class="font-semibold text-lg text-green-800 border-b border-green-200 pb-2 mb-4">Surat Selesai</h2>
                    <p class="text-sm text-green-900 mb-1">Nomor Surat: <strong>{{ $request->letter_number }}</strong></p>
                    <p class="text-xs text-green-700 mb-4">Diselesaikan oleh {{ $request->processor?->name }} pada {{ $request->processed_at?->format('d/m/Y H:i') }}</p>
                    <a href="{{ route('admin.letters.download', $request) }}" class="inline-flex items-center gap-2 rounded bg-green-700 px-4 py-2 text-sm font-medium text-white hover:bg-green-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Download Dokumen
                    </a>
                </div>
            @endif
        </div>

        <div>
            @if($request->status->value === 'pending')
                <div class="rounded-lg border border-slate-200 bg-white p-6 space-y-6">
                    <h2 class="font-semibold text-lg border-b border-slate-100 pb-2">Tindakan</h2>

                    <form action="{{ route('admin.letters.approve', $request) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full rounded bg-teal-700 px-4 py-2 font-medium text-white hover:bg-teal-800">Setujui Pengajuan</button>
                    </form>

                    <form action="{{ route('admin.letters.reject', $request) }}" method="POST" class="space-y-3 pt-4 border-t border-slate-100">
                        @csrf
                        <label class="block">
                            <span class="text-sm font-medium text-slate-700">Alasan Penolakan</span>
                            <textarea name="rejection_reason" required rows="3" class="mt-1 block w-full rounded border-slate-300 text-sm" placeholder="Jelaskan alasan penolakan..."></textarea>
                        </label>
                        <button type="submit" class="w-full rounded bg-white border border-red-600 px-4 py-2 font-medium text-red-600 hover:bg-red-50">Tolak Pengajuan</button>
                    </form>
                </div>
            @elseif($request->status->value === 'approved')
                <div class="rounded-lg border border-slate-200 bg-white p-6 space-y-6">
                    <h2 class="font-semibold text-lg border-b border-slate-100 pb-2">Selesaikan Surat</h2>
                    <p class="text-sm text-slate-600">Pengajuan ini sudah disetujui. Silakan klik tombol di bawah untuk men-generate nomor surat dan dokumen akhir.</p>

                    <form action="{{ route('admin.letters.complete', $request) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full rounded bg-teal-700 px-4 py-2 font-medium text-white hover:bg-teal-800">Generate Dokumen & Selesai</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
