<x-layouts.auth>
    <form method="POST" action="{{ route('activation.account.store') }}" class="flex flex-col gap-6">
        @csrf

        <x-auth-header
            title="Buat akun"
            description="Gunakan email yang dapat Anda akses untuk memverifikasi akun."
        />

        <flux:input
            name="email"
            label="Email"
            type="email"
            value="{{ old('email') }}"
            autocomplete="email"
            required
            autofocus
        />

        <flux:input
            name="password"
            label="Password"
            type="password"
            autocomplete="new-password"
            required
            viewable
        />

        <flux:input
            name="password_confirmation"
            label="Konfirmasi password"
            type="password"
            autocomplete="new-password"
            required
            viewable
        />

        <flux:button type="submit" variant="primary" class="w-full">
            Kirim verifikasi email
        </flux:button>
    </form>
</x-layouts.auth>
