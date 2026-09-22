<x-layouts::app :title="__('Buat Pengaduan - RT Platform')">
<div class="mx-auto max-w-2xl space-y-6">
    <div>
        <a href="{{ route('resident.complaints.index') }}" class="text-sm font-medium text-teal-700 hover:text-teal-800">← Kembali ke pengaduan</a>
        <h1 class="mt-3 text-2xl font-bold">Buat Pengaduan</h1>
        <p class="mt-1 text-sm text-slate-600">Sampaikan informasi secara jelas agar pengurus RT dapat menindaklanjutinya.</p>
    </div>

    <form action="{{ route('resident.complaints.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 rounded-lg border border-slate-200 bg-white p-6">
        @csrf

        <label class="block">
            <span class="text-sm font-medium text-slate-700">Kategori <span class="text-rose-700">*</span></span>
            <select name="category" required class="mt-1 block w-full rounded border-slate-300 text-sm focus:border-teal-700 focus:ring-teal-700">
                <option value="">Pilih kategori</option>
                @foreach($categories as $value => $label)
                    <option value="{{ $value }}" @selected(old('category') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            @error('category') <p class="mt-1 text-sm text-rose-700">{{ $message }}</p> @enderror
        </label>

        <label class="block">
            <span class="text-sm font-medium text-slate-700">Judul <span class="text-rose-700">*</span></span>
            <input name="title" value="{{ old('title') }}" required maxlength="255" class="mt-1 block w-full rounded border-slate-300 text-sm focus:border-teal-700 focus:ring-teal-700" placeholder="Ringkas inti pengaduan">
            @error('title') <p class="mt-1 text-sm text-rose-700">{{ $message }}</p> @enderror
        </label>

        <label class="block">
            <span class="text-sm font-medium text-slate-700">Deskripsi <span class="text-rose-700">*</span></span>
            <textarea name="description" required rows="6" maxlength="5000" class="mt-1 block w-full rounded border-slate-300 text-sm focus:border-teal-700 focus:ring-teal-700" placeholder="Jelaskan lokasi, kondisi, dan informasi pendukung lainnya.">{{ old('description') }}</textarea>
            @error('description') <p class="mt-1 text-sm text-rose-700">{{ $message }}</p> @enderror
        </label>

        <label class="block">
            <span class="text-sm font-medium text-slate-700">Lampiran (opsional)</span>
            <input name="attachment" type="file" accept=".jpg,.jpeg,.png,.webp,.pdf" class="mt-1 block w-full text-sm text-slate-600 file:mr-4 file:rounded file:border-0 file:bg-slate-100 file:px-3 file:py-2 file:text-sm file:font-medium file:text-slate-700 hover:file:bg-slate-200">
            <p class="mt-1 text-xs text-slate-500">JPG, PNG, WEBP, atau PDF. Maksimal 5 MB.</p>
            @error('attachment') <p class="mt-1 text-sm text-rose-700">{{ $message }}</p> @enderror
        </label>

        <div class="flex flex-wrap gap-3 border-t border-slate-100 pt-5">
            <button type="submit" class="rounded bg-teal-700 px-5 py-2 text-sm font-medium text-white hover:bg-teal-800">Kirim Pengaduan</button>
            <a href="{{ route('resident.complaints.index') }}" class="rounded border border-slate-300 bg-white px-5 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Batal</a>
        </div>
    </form>
</div>
</x-layouts::app>
