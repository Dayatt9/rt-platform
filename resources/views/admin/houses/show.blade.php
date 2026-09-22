@extends('layouts.admin')
@section('content')
<div class="max-w-3xl space-y-6">
    <div class="flex flex-wrap justify-between gap-3"><div><h1 class="text-2xl font-bold">Rumah {{ $house->house_number }}</h1><p class="text-sm text-slate-600">{{ $house->address }}</p></div><div class="flex gap-4"><a href="{{ route('admin.houses.map') }}" class="font-medium text-teal-700">Lihat peta</a><a href="{{ route('admin.houses.edit',$house) }}" class="font-medium text-teal-700">Ubah</a></div></div>
    @if(session('status'))<p class="rounded border border-green-200 bg-green-50 p-3 text-sm text-green-800">{{ session('status') }}</p>@endif
    @if($errors->has('coordinates'))<p class="rounded border border-rose-200 bg-rose-50 p-3 text-sm text-rose-800">{{ $errors->first('coordinates') }}</p>@endif
    <div class="rounded-lg border bg-white p-5"><p class="text-sm">Koordinat: <span class="font-mono">{{ $house->latitude ?? '—' }}, {{ $house->longitude ?? '—' }}</span></p>@if($house->latitude !== null && $house->longitude !== null)<a class="mt-3 inline-block font-medium text-teal-700" target="_blank" rel="noopener" href="https://www.google.com/maps/dir/?api=1&amp;destination={{ $house->latitude }},{{ $house->longitude }}">Buka Navigasi</a>@endif<p class="mt-3"><x-status-badge :status="$house->status" /></p></div>
    <section class="rounded-lg border bg-white p-5"><div class="flex flex-wrap items-center justify-between gap-3"><div><h2 class="text-lg font-semibold">Tautan lokasi tamu</h2><p class="text-sm text-slate-600">Tautan sementara untuk kurir, tamu, atau teknisi.</p></div><form method="POST" action="{{ route('admin.houses.guest-links.store', $house) }}">@csrf<button class="rounded bg-teal-700 px-4 py-2 text-sm font-medium text-white">Buat tautan tamu</button></form></div>
        @if(session('guest_location_url'))<div class="mt-5 rounded border border-teal-200 bg-teal-50 p-4"><p class="text-sm font-medium text-teal-900">Tautan baru dibuat. Simpan atau kirimkan sekarang; token tidak disimpan sebagai teks biasa.</p><div class="mt-3 flex flex-col gap-3 sm:flex-row"><input id="guest-location-url" readonly value="{{ session('guest_location_url') }}" class="min-w-0 flex-1 rounded border-teal-300 bg-white text-sm" /><button id="copy-guest-location" type="button" class="rounded border border-teal-700 px-3 py-2 text-sm font-medium text-teal-800">Salin tautan</button></div><canvas id="guest-location-qr" class="mt-4 rounded bg-white p-3"></canvas></div>@endif
        <div class="mt-5 space-y-3">@forelse($house->guestLocationLinks as $link)<div class="flex flex-wrap items-center justify-between gap-3 border-t pt-3"><div><p class="font-medium">Berlaku sampai {{ $link->expires_at->format('d M Y, H:i') }}</p><p class="text-sm text-slate-600">Status: {{ $link->statusLabel() }}</p></div>@if($link->revoked_at === null)<form method="POST" action="{{ route('admin.houses.guest-links.destroy', [$house, $link]) }}">@csrf @method('DELETE')<button class="text-sm font-medium text-rose-700">Cabut tautan</button></form>@endif</div>@empty<p class="text-sm text-slate-500">Belum ada tautan lokasi tamu.</p>@endforelse</div>
    </section>
    <section><h2 class="mb-3 text-lg font-semibold">KK di rumah ini</h2><div class="rounded-lg border bg-white">@forelse($house->households as $household)<a class="block border-b px-4 py-3 text-teal-700" href="{{ route('admin.households.show',$household) }}">KK •••• {{ substr($household->kk_number,-4) }}</a>@empty<p class="p-5 text-sm text-slate-500">Belum ada KK yang ditempatkan.</p>@endforelse</div></section>
</div>
@endsection
@if(session('guest_location_url'))
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.4/build/qrcode.min.js"></script>
<script>
    const guestLocationUrl = document.getElementById('guest-location-url');
    QRCode.toCanvas(document.getElementById('guest-location-qr'), guestLocationUrl.value, { width: 180, margin: 1 });
    document.getElementById('copy-guest-location').addEventListener('click', async () => { await navigator.clipboard.writeText(guestLocationUrl.value); document.getElementById('copy-guest-location').textContent = 'Tersalin'; });
</script>
@endpush
@endif
