<x-layouts.auth>
    <form method="POST" action="{{ route('activation.validate') }}" class="flex flex-col gap-6">
        @csrf

        <x-auth-header
            title="Aktivasi akun"
            description="Masukkan kode aktivasi yang diberikan oleh pengurus RT."
        />

        <flux:input
            name="code"
            label="Kode aktivasi"
            value="{{ old('code') }}"
            autocomplete="one-time-code"
            required
            autofocus
        />

        <flux:button type="submit" variant="primary" class="w-full">
            Lanjutkan
        </flux:button>
    </form>
</x-layouts.auth>
