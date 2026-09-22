@extends('layouts.admin')
@section('content')
<div class="space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
        <a href="{{ route('admin.letters.index') }}" class="hover:text-slate-900">Surat Administrasi</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('admin.letter-types.index') }}" class="hover:text-slate-900">Jenis Surat</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-900 font-medium">{{ $letterType->exists ? 'Edit' : 'Tambah' }}</span>
    </div>

    <h1 class="text-2xl font-bold">{{ $letterType->exists ? 'Edit Jenis Surat' : 'Tambah Jenis Surat' }}</h1>

    <form action="{{ $letterType->exists ? route('admin.letter-types.update', $letterType) : route('admin.letter-types.store') }}" method="POST" class="space-y-6">
        @csrf
        @if($letterType->exists) @method('PUT') @endif

        <div class="rounded-lg border border-slate-200 bg-white p-6 space-y-4">
            <h2 class="font-semibold text-lg border-b border-slate-100 pb-2">Informasi Surat</h2>

            <div class="grid md:grid-cols-2 gap-4">
                <label class="block">
                    <span class="text-sm font-medium">Kode Surat <span class="text-red-500">*</span></span>
                    <input type="text" name="code" value="{{ old('code', $letterType->code) }}" required class="mt-1 block w-full rounded border-slate-300" placeholder="Contoh: SKU">
                    @error('code') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </label>

                <label class="block">
                    <span class="text-sm font-medium">Nama Surat <span class="text-red-500">*</span></span>
                    <input type="text" name="name" value="{{ old('name', $letterType->name) }}" required class="mt-1 block w-full rounded border-slate-300" placeholder="Contoh: Surat Keterangan Usaha">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </label>
            </div>

            <label class="block">
                <span class="text-sm font-medium">Deskripsi</span>
                <textarea name="description" rows="2" class="mt-1 block w-full rounded border-slate-300">{{ old('description', $letterType->description) }}</textarea>
            </label>

            <label class="flex items-center gap-2 mt-4">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $letterType->exists ? $letterType->is_active : true)) class="rounded border-slate-300 text-teal-700">
                <span class="text-sm font-medium">Aktif (bisa diajukan warga)</span>
            </label>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                <h2 class="font-semibold text-lg">Formulir Isian Warga</h2>
                <button type="button" onclick="addField()" class="text-sm font-medium text-teal-700 hover:text-teal-800">+ Tambah Field</button>
            </div>
            <p class="text-sm text-slate-500">Tentukan data apa saja yang harus diisi warga saat mengajukan surat ini.</p>

            <div id="fields-container" class="space-y-4">
                @php $oldFields = old('fields', $letterType->fields ?? []); @endphp
                @foreach($oldFields as $index => $field)
                    <div class="flex flex-wrap items-end gap-4 p-4 border border-slate-100 bg-slate-50 rounded" id="field-{{ $index }}">
                        <label class="flex-1 min-w-[200px]">
                            <span class="text-xs font-medium">Label/Pertanyaan</span>
                            <input type="text" name="fields[{{ $index }}][label]" value="{{ $field['label'] ?? '' }}" required class="mt-1 block w-full rounded border-slate-300 text-sm">
                        </label>
                        <label class="flex-1 min-w-[150px]">
                            <span class="text-xs font-medium">Nama Field (tanpa spasi)</span>
                            <input type="text" name="fields[{{ $index }}][name]" value="{{ $field['name'] ?? '' }}" required class="mt-1 block w-full rounded border-slate-300 text-sm">
                        </label>
                        <label class="w-32">
                            <span class="text-xs font-medium">Tipe</span>
                            <select name="fields[{{ $index }}][type]" required class="mt-1 block w-full rounded border-slate-300 text-sm">
                                <option value="text" @selected(($field['type'] ?? '') == 'text')>Teks Singkat</option>
                                <option value="textarea" @selected(($field['type'] ?? '') == 'textarea')>Teks Panjang</option>
                                <option value="number" @selected(($field['type'] ?? '') == 'number')>Angka</option>
                                <option value="date" @selected(($field['type'] ?? '') == 'date')>Tanggal</option>
                            </select>
                        </label>
                        <label class="flex items-center gap-2 pb-2">
                            <input type="hidden" name="fields[{{ $index }}][required]" value="0">
                            <input type="checkbox" name="fields[{{ $index }}][required]" value="1" @checked($field['required'] ?? false) class="rounded border-slate-300 text-teal-700">
                            <span class="text-xs font-medium">Wajib</span>
                        </label>
                        <button type="button" onclick="removeField({{ $index }})" class="pb-2 text-sm font-medium text-red-600">Hapus</button>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white p-6 space-y-4">
            <h2 class="font-semibold text-lg border-b border-slate-100 pb-2">Template Cetak</h2>
            <p class="text-sm text-slate-500">Gunakan placeholder <code>{{'{{resident_name}}'}}</code>, <code>{{'{{resident_nik}}'}}</code>, <code>{{'{{letter_number}}'}}</code>, <code>{{'{{letter_date}}'}}</code>, dll.</p>
            <p class="text-sm text-slate-500">Gunakan juga nama field yang Anda buat di atas, contoh: <code>{{'{{keperluan}}'}}</code></p>
            <label class="block">
                <textarea name="template_body" rows="15" class="mt-1 block w-full rounded border-slate-300 font-mono text-sm leading-relaxed">{{ old('template_body', $letterType->template_body) }}</textarea>
                @error('template_body') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="rounded bg-teal-700 px-6 py-2 font-medium text-white">Simpan</button>
            <a href="{{ route('admin.letter-types.index') }}" class="rounded border border-slate-300 bg-white px-6 py-2 font-medium text-slate-700">Batal</a>
        </div>
    </form>
</div>

<script>
    let fieldCount = {{ count($oldFields) }};

    function addField() {
        const container = document.getElementById('fields-container');
        const index = fieldCount++;
        const html = `
            <div class="flex flex-wrap items-end gap-4 p-4 border border-slate-100 bg-slate-50 rounded" id="field-${index}">
                <label class="flex-1 min-w-[200px]">
                    <span class="text-xs font-medium">Label/Pertanyaan</span>
                    <input type="text" name="fields[${index}][label]" required class="mt-1 block w-full rounded border-slate-300 text-sm">
                </label>
                <label class="flex-1 min-w-[150px]">
                    <span class="text-xs font-medium">Nama Field (tanpa spasi)</span>
                    <input type="text" name="fields[${index}][name]" required class="mt-1 block w-full rounded border-slate-300 text-sm">
                </label>
                <label class="w-32">
                    <span class="text-xs font-medium">Tipe</span>
                    <select name="fields[${index}][type]" required class="mt-1 block w-full rounded border-slate-300 text-sm">
                        <option value="text">Teks Singkat</option>
                        <option value="textarea">Teks Panjang</option>
                        <option value="number">Angka</option>
                        <option value="date">Tanggal</option>
                    </select>
                </label>
                <label class="flex items-center gap-2 pb-2">
                    <input type="hidden" name="fields[${index}][required]" value="0">
                    <input type="checkbox" name="fields[${index}][required]" value="1" checked class="rounded border-slate-300 text-teal-700">
                    <span class="text-xs font-medium">Wajib</span>
                </label>
                <button type="button" onclick="removeField(${index})" class="pb-2 text-sm font-medium text-red-600">Hapus</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }

    function removeField(index) {
        document.getElementById(`field-${index}`).remove();
    }
</script>
@endsection
