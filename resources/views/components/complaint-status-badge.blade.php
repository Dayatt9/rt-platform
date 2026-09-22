@props(['status'])

@php
    $value = $status instanceof \App\Enums\ComplaintStatus ? $status->value : $status;
    $classes = match ($value) {
        'pending' => 'border-amber-200 bg-amber-50 text-amber-800',
        'in_progress' => 'border-blue-200 bg-blue-50 text-blue-800',
        'resolved' => 'border-green-200 bg-green-50 text-green-800',
        'rejected' => 'border-rose-200 bg-rose-50 text-rose-800',
        default => 'border-slate-200 bg-slate-50 text-slate-700',
    };
    $dot = match ($value) {
        'pending' => 'bg-amber-600',
        'in_progress' => 'bg-blue-600',
        'resolved' => 'bg-green-600',
        'rejected' => 'bg-rose-600',
        default => 'bg-slate-500',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 rounded border px-2 py-1 text-xs font-medium {$classes}"]) }}>
    <span class="h-1.5 w-1.5 rounded-full {{ $dot }}"></span>
    {{ $status instanceof \App\Enums\ComplaintStatus ? $status->label() : $value }}
</span>
