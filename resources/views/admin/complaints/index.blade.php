@extends('layouts.admin')

@section('title', 'Pengaduan Warga - RT Platform')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold">Pengaduan Warga</h1>
        <p class="text-sm text-slate-600">Tinjau dan tindak lanjuti pengaduan dari warga di wilayah Anda.</p>
    </div>

    @if(session('success'))
        <div class="rounded-md border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-800">{{ session('success') }}</div>
    @endif

    <form class="grid gap-3 rounded-lg border border-slate-200 bg-white p-4 md:grid-cols-3">
        <label class="text-sm font-medium text-slate-700">Status
            <select name="status" class="mt-1 block w-full rounded border-slate-300 text-sm">
                <option value="">Semua status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->value }}" @selected(request('status') === $status->value)>{{ $status->label() }}</option>
                @endforeach
            </select>
        </label>
        <label class="text-sm font-medium text-slate-700">Kategori
            <select name="category" class="mt-1 block w-full rounded border-slate-300 text-sm">
                <option value="">Semua kategori</option>
                @foreach($categories as $value => $label)
                    <option value="{{ $value }}" @selected(request('category') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
        <button class="self-end rounded bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-800">Filter</button>
    </form>

    <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50"><tr><th class="px-4 py-3">Tanggal</th><th class="px-4 py-3">Warga</th><th class="px-4 py-3">Kategori</th><th class="px-4 py-3">Judul</th><th class="px-4 py-3">Status</th><th class="px-4 py-3"><span class="sr-only">Aksi</span></th></tr></thead>
            <tbody>
                @forelse($complaints as $complaint)
                    <tr class="border-t border-slate-200">
                        <td class="whitespace-nowrap px-4 py-3 text-slate-600">{{ $complaint->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $complaint->resident->name }}</td>
                        <td class="px-4 py-3">{{ $complaint->categoryLabel() }}</td>
                        <td class="px-4 py-3">{{ $complaint->title }}</td>
                        <td class="px-4 py-3"><x-complaint-status-badge :status="$complaint->status" /></td>
                        <td class="px-4 py-3 text-right"><a href="{{ route('admin.complaints.show', $complaint) }}" class="font-medium text-teal-700 hover:text-teal-800">Detail</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-10 text-center text-slate-500">Tidak ada pengaduan yang sesuai.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $complaints->links() }}
</div>
@endsection
