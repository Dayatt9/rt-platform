@extends('layouts.admin')

@section('title', 'Detail Pengaduan - RT Platform')

@section('content')
<div class="space-y-6">
    <div class="flex flex-wrap items-start justify-between gap-4 border-b border-slate-200 pb-4">
        <div>
            <a href="{{ route('admin.complaints.index') }}" class="text-sm font-medium text-teal-700 hover:text-teal-800">← Pengaduan Warga</a>
            <h1 class="mt-3 text-2xl font-bold">{{ $complaint->title }}</h1>
            <p class="mt-1 text-sm text-slate-600">Diajukan {{ $complaint->created_at->format('d/m/Y H:i') }}</p>
        </div>
        <x-complaint-status-badge :status="$complaint->status" />
    </div>

    @if(session('success')) <div class="rounded-md border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-800">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="rounded-md border border-rose-200 bg-rose-50 p-4 text-sm font-medium text-rose-800">{{ session('error') }}</div> @endif

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="space-y-6">
            <div class="rounded-lg border border-slate-200 bg-white p-6">
                <h2 class="border-b border-slate-100 pb-2 text-lg font-semibold">Informasi Pengaduan</h2>
                <dl class="mt-4 grid gap-4 text-sm sm:grid-cols-2">
                    <div><dt class="text-slate-500">Warga</dt><dd class="mt-1 font-medium">{{ $complaint->resident->name }}</dd></div>
                    <div><dt class="text-slate-500">Kategori</dt><dd class="mt-1 font-medium">{{ $complaint->categoryLabel() }}</dd></div>
                </dl>
                <div class="mt-4 border-t border-slate-100 pt-4"><dt class="text-sm text-slate-500">Deskripsi</dt><dd class="mt-1 whitespace-pre-line text-sm leading-6 text-slate-800">{{ $complaint->description }}</dd></div>
                @if($complaint->attachment_path)
                    <div class="mt-4 flex items-center justify-between gap-3 border-t border-slate-100 pt-4"><span class="text-sm text-slate-600">Lampiran pendukung tersedia.</span><a href="{{ route('admin.complaints.attachment', $complaint) }}" class="rounded border border-slate-300 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Unduh lampiran</a></div>
                @endif
            </div>

            @if($complaint->admin_response)
                <div class="rounded-lg border border-teal-200 bg-teal-50 p-6"><h2 class="text-lg font-semibold text-teal-900">Tanggapan saat ini</h2><p class="mt-3 whitespace-pre-line text-sm leading-6 text-teal-950">{{ $complaint->admin_response }}</p><p class="mt-3 text-xs text-teal-800">Diperbarui {{ $complaint->responded_at?->format('d/m/Y H:i') }}@if($complaint->responder), oleh {{ $complaint->responder->name }}@endif.</p></div>
            @endif
        </div>

        <div class="space-y-6">
            @php($transitions = array_filter($statuses, fn ($status) => $complaint->status->canTransitionTo($status)))
            @if(count($transitions) > 0)
                <form method="POST" action="{{ route('admin.complaints.status', $complaint) }}" class="space-y-4 rounded-lg border border-slate-200 bg-white p-6">
                    @csrf
                    @method('PATCH')
                    <h2 class="border-b border-slate-100 pb-2 text-lg font-semibold">Ubah Status</h2>
                    <label class="block text-sm font-medium text-slate-700">Status berikutnya
                        <select name="status" required class="mt-1 block w-full rounded border-slate-300 text-sm">
                            @foreach($transitions as $status)<option value="{{ $status->value }}">{{ $status->label() }}</option>@endforeach
                        </select>
                    </label>
                    @error('status') <p class="text-sm text-rose-700">{{ $message }}</p> @enderror
                    <button type="submit" class="rounded bg-teal-700 px-4 py-2 text-sm font-medium text-white hover:bg-teal-800">Simpan Status</button>
                </form>
            @endif

            <form method="POST" action="{{ route('admin.complaints.response', $complaint) }}" class="space-y-4 rounded-lg border border-slate-200 bg-white p-6">
                @csrf
                @method('PATCH')
                <h2 class="border-b border-slate-100 pb-2 text-lg font-semibold">Tanggapan Pengurus</h2>
                <label class="block text-sm font-medium text-slate-700">Tanggapan untuk warga
                    <textarea name="admin_response" required rows="6" maxlength="5000" class="mt-1 block w-full rounded border-slate-300 text-sm focus:border-teal-700 focus:ring-teal-700">{{ old('admin_response', $complaint->admin_response) }}</textarea>
                </label>
                @error('admin_response') <p class="text-sm text-rose-700">{{ $message }}</p> @enderror
                <button type="submit" class="rounded bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">Simpan Tanggapan</button>
            </form>
        </div>
    </div>
</div>
@endsection
