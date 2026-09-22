@extends('layouts.admin')
@section('content')
<form method="POST" action="{{ $house->exists ? route('admin.houses.update',$house) : route('admin.houses.store') }}" class="max-w-2xl space-y-5 rounded-lg border bg-white p-6">
    @csrf
    @if($house->exists) @method('PUT') @endif
    <h1 class="text-2xl font-bold">{{ $house->exists ? 'Ubah rumah' : 'Tambah rumah' }}</h1>
    <label class="block text-sm font-medium">Nomor / identitas rumah<input required name="house_number" value="{{ old('house_number',$house->house_number) }}" class="mt-1 block w-full rounded border-slate-300" /></label>
    <label class="block text-sm font-medium">Alamat<textarea required name="address" class="mt-1 block w-full rounded border-slate-300">{{ old('address',$house->address) }}</textarea></label>
    <div class="grid gap-4 md:grid-cols-2">
        <label class="text-sm font-medium">Latitude<input id="latitude" type="number" step="0.0000001" name="latitude" value="{{ old('latitude',$house->latitude) }}" class="mt-1 block w-full rounded border-slate-300" /></label>
        <label class="text-sm font-medium">Longitude<input id="longitude" type="number" step="0.0000001" name="longitude" value="{{ old('longitude',$house->longitude) }}" class="mt-1 block w-full rounded border-slate-300" /></label>
    </div>
    @error('latitude')<p class="text-sm text-rose-700">{{ $message }}</p>@enderror
    @error('longitude')<p class="text-sm text-rose-700">{{ $message }}</p>@enderror
    <section class="space-y-2"><h2 class="text-sm font-medium">Pilih posisi pada peta</h2><p class="text-xs text-slate-500">Klik peta untuk mengisi koordinat; koordinat tetap disimpan di data rumah.</p><div id="coordinate-picker" class="h-72 rounded border border-slate-300"></div></section>
    <label class="block text-sm font-medium">Status<select name="status" class="mt-1 block w-full rounded border-slate-300"><option value="active" @selected(old('status',$house->status)==='active')>Aktif</option><option value="inactive" @selected(old('status',$house->status)==='inactive')>Tidak aktif</option></select></label>
    <button class="rounded bg-teal-700 px-4 py-2 text-sm font-medium text-white">Simpan</button>
</form>
@endsection
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');
    const initialLatitude = Number(latitudeInput.value) || -2.5489;
    const initialLongitude = Number(longitudeInput.value) || 118.0149;
    const picker = L.map('coordinate-picker').setView([initialLatitude, initialLongitude], latitudeInput.value && longitudeInput.value ? 16 : 5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap contributors' }).addTo(picker);
    let marker;
    const placeMarker = (lat, lng) => { if (marker) marker.setLatLng([lat, lng]); else marker = L.marker([lat, lng]).addTo(picker); };
    if (latitudeInput.value && longitudeInput.value) placeMarker(initialLatitude, initialLongitude);
    picker.on('click', (event) => { latitudeInput.value = event.latlng.lat.toFixed(7); longitudeInput.value = event.latlng.lng.toFixed(7); placeMarker(event.latlng.lat, event.latlng.lng); });
</script>
@endpush
