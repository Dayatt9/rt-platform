@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="{{ route('admin.letters.index') }}" class="hover:text-slate-900">Surat Administrasi</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-slate-900 font-medium">Jenis Surat</span>
            </div>
            <h1 class="text-2xl font-bold">Jenis Surat</h1>
            <p class="text-sm text-slate-600">Kelola jenis surat yang dapat diajukan oleh warga.</p>
        </div>
        <a href="{{ route('admin.letter-types.create') }}" class="rounded bg-teal-700 px-4 py-2 text-sm font-medium text-white">Tambah Jenis Surat</a>
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
                    <th class="px-4 py-3">Kode</th>
                    <th class="px-4 py-3">Nama Surat</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($letterTypes as $type)
                <tr class="border-t">
                    <td class="px-4 py-3 font-mono text-xs">{{ $type->code }}</td>
                    <td class="px-4 py-3 font-medium">{{ $type->name }}</td>
                    <td class="px-4 py-3"><x-status-badge :status="$type->is_active ? 'active' : 'inactive'" /></td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.letter-types.edit', $type) }}" class="font-medium text-teal-700">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-slate-500">Belum ada jenis surat yang dikonfigurasi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $letterTypes->links() }}
</div>
@endsection
