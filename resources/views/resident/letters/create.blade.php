@extends('layouts.app')
@section('title', 'Ajukan Surat - RT Platform')
@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
        <a href="{{ route('dashboard') }}" class="hover:text-slate-900">Dashboard</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <a href="{{ route('resident.letters.index') }}" class="hover:text-slate-900">Surat Administrasi</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        <span class="text-slate-900 font-medium">Buat Baru</span>
    </div>

    <h1 class="text-2xl font-bold">Ajukan Surat Baru</h1>

    @if(!$selectedType)
        <div class="rounded-lg border border-slate-200 bg-white p-6 space-y-6">
            <h2 class="font-semibold text-lg border-b border-slate-100 pb-2">Pilih Jenis Surat</h2>
            <div class="grid gap-4">
                @forelse($letterTypes as $type)
                    <a href="{{ route('resident.letters.create', ['type' => $type->id]) }}" class="block p-4 border border-slate-200 rounded-lg hover:border-teal-700 hover:ring-1 hover:ring-teal-700 transition-all">
                        <h3 class="font-semibold text-slate-900">{{ $type->name }}</h3>
                        @if($type->description)
                            <p class="text-sm text-slate-500 mt-1">{{ $type->description }}</p>
                        @endif
                    </a>
                @empty
                    <p class="text-slate-500 text-sm">Tidak ada jenis surat yang tersedia saat ini.</p>
                @endforelse
            </div>
        </div>
    @else
        <form action="{{ route('resident.letters.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="letter_type_id" value="{{ $selectedType->id }}">

            <div class="rounded-lg border border-slate-200 bg-white p-6 space-y-4">
                <div class="flex items-start justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h2 class="font-semibold text-lg">{{ $selectedType->name }}</h2>
                        @if($selectedType->description)
                            <p class="text-sm text-slate-500 mt-1">{{ $selectedType->description }}</p>
                        @endif
                    </div>
                    <a href="{{ route('resident.letters.create') }}" class="text-sm font-medium text-teal-700">Ganti</a>
                </div>

                <div class="space-y-4 pt-2">
                    @if(is_array($selectedType->fields) && count($selectedType->fields) > 0)
                        @foreach($selectedType->fields as $field)
                            <label class="block">
                                <span class="text-sm font-medium">{{ $field['label'] }} @if($field['required']) <span class="text-red-500">*</span> @endif</span>
                                @if($field['type'] === 'textarea')
                                    <textarea name="field_{{ $field['name'] }}" {{ $field['required'] ? 'required' : '' }} rows="3" class="mt-1 block w-full rounded border-slate-300">{{ old('field_'.$field['name']) }}</textarea>
                                @elseif($field['type'] === 'date')
                                    <input type="date" name="field_{{ $field['name'] }}" {{ $field['required'] ? 'required' : '' }} value="{{ old('field_'.$field['name']) }}" class="mt-1 block w-full rounded border-slate-300">
                                @elseif($field['type'] === 'number')
                                    <input type="number" name="field_{{ $field['name'] }}" {{ $field['required'] ? 'required' : '' }} value="{{ old('field_'.$field['name']) }}" class="mt-1 block w-full rounded border-slate-300">
                                @else
                                    <input type="text" name="field_{{ $field['name'] }}" {{ $field['required'] ? 'required' : '' }} value="{{ old('field_'.$field['name']) }}" class="mt-1 block w-full rounded border-slate-300">
                                @endif
                                @error('field_'.$field['name']) <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </label>
                        @endforeach
                    @else
                        <p class="text-sm text-slate-500">Tidak ada data tambahan yang perlu diisi. Silakan langsung ajukan.</p>
                    @endif
                </div>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="rounded bg-teal-700 px-6 py-2 font-medium text-white hover:bg-teal-800 transition-colors">Ajukan Surat</button>
                <a href="{{ route('resident.letters.index') }}" class="rounded border border-slate-300 bg-white px-6 py-2 font-medium text-slate-700 hover:bg-slate-50">Batal</a>
            </div>
        </form>
    @endif
</div>
@endsection
