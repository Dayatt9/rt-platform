@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Surat Administrasi</h1>
            <p class="text-sm text-slate-600">Kelola pengajuan surat dari warga.</p>
        </div>
        <a href="{{ route('admin.letter-types.index') }}" class="rounded bg-white border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700">Manajemen Jenis Surat</a>
    </div>

    @if(session('success'))
        <div class="rounded-md bg-green-50 p-4 border border-green-200">
            <div class="flex">
                <div class="shrink-0"><svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg></div>
                <div class="ml-3"><p class="text-sm font-medium text-green-800">{{ session('success') }}</p></div>
            </div>
        </div>
    @endif

    <form class="grid gap-3 rounded-lg border border-slate-200 bg-white p-4 md:grid-cols-4">
        <label class="text-sm font-medium md:col-span-3">Status Pengajuan
            <select name="status" class="mt-1 block w-full rounded border-slate-300">
                <option value="">Semua Status</option>
                <option value="pending" @selected(request('status')==='pending')>Menunggu</option>
                <option value="approved" @selected(request('status')==='approved')>Disetujui</option>
                <option value="completed" @selected(request('status')==='completed')>Selesai</option>
                <option value="rejected" @selected(request('status')==='rejected')>Ditolak</option>
            </select>
        </label>
        <button class="self-end rounded bg-slate-900 px-4 py-2 text-sm text-white">Filter</button>
    </form>

    <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Warga</th>
                    <th class="px-4 py-3">Jenis Surat</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $req->requested_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-3 font-medium">{{ $req->resident->name }}</td>
                    <td class="px-4 py-3">{{ $req->snapshot_type_name }}</td>
                    <td class="px-4 py-3">
                        @if($req->status->value === 'pending')
                            <span class="inline-flex items-center gap-1.5 rounded bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 border border-yellow-200">Menunggu</span>
                        @elseif($req->status->value === 'approved')
                            <span class="inline-flex items-center gap-1.5 rounded bg-blue-50 px-2 py-1 text-xs font-medium text-blue-800 border border-blue-200">Disetujui</span>
                        @elseif($req->status->value === 'completed')
                            <span class="inline-flex items-center gap-1.5 rounded bg-green-50 px-2 py-1 text-xs font-medium text-green-800 border border-green-200">Selesai</span>
                        @elseif($req->status->value === 'rejected')
                            <span class="inline-flex items-center gap-1.5 rounded bg-red-50 px-2 py-1 text-xs font-medium text-red-800 border border-red-200">Ditolak</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.letters.show', $req) }}" class="font-medium text-teal-700">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-slate-500">Tidak ada pengajuan surat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $requests->links() }}
</div>
@endsection
