<x-layouts::app :title="__('Pengaduan Saya - RT Platform')">
<div class="mx-auto max-w-4xl space-y-6">
    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Pengaduan Saya</h1>
            <p class="text-sm text-slate-600">Pantau tindak lanjut pengaduan yang Anda kirimkan.</p>
        </div>
        <a href="{{ route('resident.complaints.create') }}" class="rounded bg-teal-700 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-teal-800">
            Buat Pengaduan
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-md border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-800">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3"><span class="sr-only">Aksi</span></th>
                </tr>
            </thead>
            <tbody>
                @forelse($complaints as $complaint)
                    <tr class="border-t border-slate-200">
                        <td class="whitespace-nowrap px-4 py-3 text-slate-600">{{ $complaint->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3">{{ $complaint->categoryLabel() }}</td>
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $complaint->title }}</td>
                        <td class="px-4 py-3"><x-complaint-status-badge :status="$complaint->status" /></td>
                        <td class="px-4 py-3 text-right"><a href="{{ route('resident.complaints.show', $complaint) }}" class="font-medium text-teal-700 hover:text-teal-800">Detail</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-10 text-center text-slate-500">Belum ada pengaduan. Gunakan tombol di atas untuk membuat pengaduan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $complaints->links() }}
</div>
</x-layouts::app>
