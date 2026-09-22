<x-layouts::app :title="__('Detail Pengaduan - RT Platform')">
<div class="mx-auto max-w-3xl space-y-6">
    <div class="flex flex-wrap items-start justify-between gap-4 border-b border-slate-200 pb-4">
        <div>
            <a href="{{ route('resident.complaints.index') }}" class="text-sm font-medium text-teal-700 hover:text-teal-800">← Pengaduan Saya</a>
            <h1 class="mt-3 text-2xl font-bold">{{ $complaint->title }}</h1>
            <p class="mt-1 text-sm text-slate-600">Dikirim pada {{ $complaint->created_at->format('d/m/Y H:i') }}</p>
        </div>
        <x-complaint-status-badge :status="$complaint->status" />
    </div>

    @if(session('success'))
        <div class="rounded-md border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-800">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="rounded-md border border-rose-200 bg-rose-50 p-4 text-sm font-medium text-rose-800">{{ session('error') }}</div>
    @endif

    <div class="space-y-5 rounded-lg border border-slate-200 bg-white p-6">
        <dl class="grid gap-4 text-sm sm:grid-cols-2">
            <div><dt class="text-slate-500">Kategori</dt><dd class="mt-1 font-medium text-slate-900">{{ $complaint->categoryLabel() }}</dd></div>
            <div><dt class="text-slate-500">Status</dt><dd class="mt-1"><x-complaint-status-badge :status="$complaint->status" /></dd></div>
        </dl>
        <div class="border-t border-slate-100 pt-4">
            <h2 class="text-sm font-semibold text-slate-900">Deskripsi</h2>
            <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-700">{{ $complaint->description }}</p>
        </div>
        @if($complaint->attachment_path)
            <div class="flex items-center justify-between gap-4 border-t border-slate-100 pt-4">
                <div><h2 class="text-sm font-semibold text-slate-900">Lampiran</h2><p class="mt-1 text-xs text-slate-500">Lampiran pendukung pengaduan tersedia.</p></div>
                <a href="{{ route('resident.complaints.attachment', $complaint) }}" class="shrink-0 rounded border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Unduh lampiran</a>
            </div>
        @endif
    </div>

    @if($complaint->admin_response)
        <div class="rounded-lg border border-teal-200 bg-teal-50 p-6">
            <h2 class="text-lg font-semibold text-teal-900">Tanggapan Pengurus RT</h2>
            <p class="mt-3 whitespace-pre-line text-sm leading-6 text-teal-950">{{ $complaint->admin_response }}</p>
            <p class="mt-3 text-xs text-teal-800">Diperbarui {{ $complaint->responded_at?->format('d/m/Y H:i') }}@if($complaint->responder), oleh {{ $complaint->responder->name }}@endif.</p>
        </div>
    @endif
</div>
</x-layouts::app>
