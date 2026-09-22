@props(['status'])
@php($active = $status === 'active')
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 rounded px-2 py-1 text-xs font-medium '.($active ? 'border border-green-200 bg-green-50 text-green-800' : 'border border-slate-200 bg-slate-100 text-slate-700')]) }}>
    <span class="h-1.5 w-1.5 rounded-full {{ $active ? 'bg-green-600' : 'bg-slate-500' }}"></span>
    {{ $active ? 'Aktif' : 'Tidak aktif' }}
</span>
