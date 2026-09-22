<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layar Autentikasi & Aktivasi — RT Platform</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F8FAFC; color: #0F172A; }
        h1, h2, h3, h4, h5, h6, .font-display { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono, .tabular-nums { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col bg-slate-50">

    <!-- Demo Toolbar (For Showcase Purposes) -->
    <div class="bg-white border-b border-slate-200 px-6 py-4 flex flex-col gap-4 shrink-0 shadow-sm sticky top-0 z-50">
        
        <!-- Top Bar -->
        <div class="flex items-start justify-between">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-2 py-0.5 rounded text-[10px] font-semibold bg-teal-50 text-teal-700 border border-teal-200">Shell Publik (Mobile & Desktop)</span>
                    <span class="text-[10px] text-slate-400 font-medium">Karakter Utilitarian Sipil — Standar Blade + Tailwind</span>
                </div>
                <h1 class="text-xl font-display font-bold text-slate-900">Alur Autentikasi & Aktivasi Warga</h1>
                <p class="text-xs text-slate-500 mt-1 max-w-lg leading-relaxed">Konsep Publik: Kartu putih di tengah, logo resmi di atas, latar slate netral. Tanpa fitur lupa sandi sesuai batasan.</p>
            </div>
            
            <div class="flex bg-slate-50 border border-slate-200 rounded-md p-1">
                <button class="px-4 py-2 text-xs font-semibold rounded bg-white text-teal-700 shadow-sm border border-slate-200">1. Layar Masuk (Login)</button>
                <button class="px-4 py-2 text-xs font-medium text-slate-500 hover:text-slate-700">2. Aktivasi Akun</button>
                <button class="px-4 py-2 text-xs font-medium text-slate-500 hover:text-slate-700">3. Buat Kata Sandi</button>
            </div>
        </div>

        <!-- Toggles -->
        <div class="flex items-center justify-between pt-3 border-t border-slate-100">
            <div class="flex items-center gap-2">
                <span class="text-[10px] text-slate-500 font-medium uppercase tracking-wider">Uji Frame / Kondisi:</span>
                <div class="flex bg-white border border-slate-200 rounded p-0.5">
                    <button class="px-3 py-1 text-[11px] font-semibold rounded bg-slate-800 text-white shadow-sm">Normal</button>
                    <button class="px-3 py-1 text-[11px] font-medium text-slate-500 hover:text-slate-700">Gagal Masuk (Generik)</button>
                    <button class="px-3 py-1 text-[11px] font-medium text-slate-500 hover:text-slate-700">Terkunci Sementara (429)</button>
                </div>
            </div>
            <div class="text-[10px] text-slate-400 italic">
                *Mendukung tampilan Mobile (390px) & Desktop responsif terpusat.
            </div>
        </div>
    </div>

    <!-- Main Content Area (Auth Layout) -->
    <main class="flex-1 flex flex-col items-center justify-center p-6 sm:p-12 relative">
        
        <!-- Center Card -->
        <div class="w-full max-w-[420px] mx-auto bg-white border border-slate-200 rounded-xl shadow-sm p-8 sm:p-10 mb-6">
            
            <!-- Header -->
            <div class="text-center mb-8 flex flex-col items-center">
                <div class="w-12 h-12 bg-teal-700 text-white rounded-lg flex items-center justify-center font-display shadow-sm mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </div>
                <h2 class="text-xl font-display font-bold text-slate-900">Masuk ke RT Platform</h2>
            </div>

            <!-- Login Form -->
            <form action="#" method="POST" class="space-y-5">
                
                <!-- Phone Field -->
                <div>
                    <label for="phone" class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Ponsel <span class="text-rose-500">*</span></label>
                    <input type="text" id="phone" name="phone" value="081298765432" class="block w-full px-3 py-2.5 border border-slate-300 rounded-md text-sm font-medium text-slate-900 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:border-teal-700 transition-shadow" placeholder="08xxxxxxxxxx">
                    <p class="mt-1.5 text-[11px] text-slate-500">Gunakan nomor ponsel yang terdaftar di RT.</p>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <input type="password" id="password" name="password" value="secretpassword" class="block w-full pl-3 pr-10 py-2.5 border border-slate-300 rounded-md text-sm font-medium text-slate-900 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:border-teal-700 transition-shadow">
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full px-4 py-3 bg-teal-700 hover:bg-teal-800 text-white font-semibold rounded-md text-sm transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-700 focus:ring-offset-2 mt-2">
                    Masuk
                </button>

            </form>

            <!-- Divider -->
            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <p class="text-xs text-slate-500 mb-1">Belum mengaktifkan akun warga?</p>
                <a href="#" class="text-xs font-semibold text-teal-700 hover:text-teal-800 transition-colors">Punya kode aktivasi? Masukkan kode di sini →</a>
            </div>

        </div>

        <!-- Footer Text -->
        <p class="text-xs text-slate-400 mt-2">
            Butuh bantuan? Hubungi pengurus RT Anda.
        </p>

    </main>

    <!-- Global Footer -->
    <footer class="py-6 text-center shrink-0">
        <p class="text-xs font-medium text-slate-400">© 2026 RT Platform</p>
    </footer>

</body>
</html>
