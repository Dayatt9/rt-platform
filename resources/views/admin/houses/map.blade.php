@extends('layouts.admin')
@section('content')
<div class="space-y-5">
    <div class="flex flex-wrap items-end justify-between gap-3"><div><h1 class="text-2xl font-bold">Peta Rumah</h1><p class="text-sm text-slate-600">Menampilkan {{ $houses->count() }} rumah tenant aktif yang memiliki koordinat.</p></div><a href="{{ route('admin.houses.index') }}" class="text-sm font-medium text-teal-700">Kembali ke data rumah</a></div>
    <div id="house-map" class="h-[65vh] min-h-96 rounded-lg border border-slate-300 bg-white"></div>
    @if($houses->isEmpty())<p class="rounded border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800">Belum ada rumah dengan koordinat. Atur koordinat dari halaman ubah rumah.</p>@endif
</div>
@endsection
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const houses = {!! json_encode($houses->map(fn ($house) => ['house_number' => $house->house_number, 'address' => $house->address, 'latitude' => (float) $house->latitude, 'longitude' => (float) $house->longitude, 'url' => route('admin.houses.show', $house)])) !!};
    const map = L.map('house-map').setView([-2.5489, 118.0149], 5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap contributors' }).addTo(map);
    const bounds = [];
    houses.forEach((house) => { const marker = L.marker([house.latitude, house.longitude]).addTo(map); const content = document.createElement('div'); const name = document.createElement('strong'); name.textContent = house.house_number; const address = document.createElement('div'); address.textContent = house.address; const detail = document.createElement('a'); detail.href = house.url; detail.textContent = 'Buka detail'; content.append(name, document.createElement('br'), address, detail); marker.bindPopup(content); bounds.push([house.latitude, house.longitude]); });
    if (bounds.length) map.fitBounds(bounds, { padding: [32, 32], maxZoom: 17 });
</script>
@endpush
