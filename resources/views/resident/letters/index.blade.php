@extends('layouts.app')
@section('title', 'Surat Administrasi - RT Platform')
@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="{{ route('dashboard') }}" class="hover:text-slate-900">Dashboard</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-slate-900 font-medium">Surat Administrasi</span>
            </div>
            <h1 class="text-2xl font-bold">Surat Administrasi</h1>
            <p class="text-sm text-slate-600">Riwayat pengajuan surat Anda.</p>
        </div>
        <a href="{{ route('resident.letters.create') }}" class="rounded bg-teal-700 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-teal-800 transition-colors">Ajukan Surat Baru</a>
    </div>

    @if(session('success'))
        <div class="rounded-md bg-green-50 p-4 border border-green-200">
            <div class="flex">
                <div class="shrink-0"><svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg></div>
                <div class="ml-3"><p class="text-sm font-medium text-green-800">{{ session('success') }}</p></div>
            </div>
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Jenis Surat</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                <tr class="border-t">
                    <td class="px-4 py-3 whitespace-nowrap">{{ $req->requested_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-3 font-medium">{{ $req->snapshot_type_name }}</td>
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
                        <a href="{{ route('resident.letters.show', $req) }}" class="font-medium text-teal-700">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-slate-500">Anda belum pernah mengajukan surat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $requests->links() }}
</div>
@endsection
