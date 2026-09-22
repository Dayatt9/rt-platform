<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pratinjau Status Publik & Dialog - RT Platform</title>
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
    <div class="bg-white border-b border-slate-200 px-6 py-3 flex items-center justify-between shrink-0 shadow-sm sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <div class="w-6 h-6 bg-teal-700 text-white rounded flex items-center justify-center font-display font-bold text-xs">
                R
            </div>
            <div class="font-medium text-sm text-slate-800">
                RT Platform — <span class="text-slate-500">Pratinjau Status Publik & Dialog</span>
            </div>
        </div>
        
        <div class="flex items-center gap-2">
            <div class="flex bg-white border border-slate-200 rounded-md p-0.5 shadow-sm mr-2">
                <button class="px-3 py-1.5 text-xs font-semibold rounded bg-slate-100 text-teal-700 shadow-sm border border-slate-200">403</button>
                <button class="px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700">404</button>
                <button class="px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700">419</button>
                <button class="px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700">429</button>
                <button class="px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700">500</button>
            </div>
            <div class="w-px h-6 bg-slate-200 mx-1"></div>
            <div class="flex gap-2">
                <button class="px-3 py-1.5 text-xs font-semibold rounded bg-amber-50 text-amber-700 border border-amber-200 hover:bg-amber-100 transition-colors">Modal Sesi</button>
                <button class="px-3 py-1.5 text-xs font-semibold rounded bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-100 transition-colors">Konfirmasi Keluar</button>
            </div>
        </div>
    </div>

    <!-- Main Content Area (Error Layout) -->
    <main class="flex-1 flex flex-col items-center justify-center p-6 relative">
        
        <!-- Center Container -->
        <div class="w-full max-w-md mx-auto text-center">
            
            <!-- Logo & Brand Header -->
            <div class="mb-8 flex flex-col items-center">
                <div class="w-12 h-12 bg-teal-700 text-white rounded-lg flex items-center justify-center font-display font-bold text-2xl shadow-sm mb-4">
                    R
                </div>
                <h1 class="font-display font-bold text-slate-900 text-base leading-tight mb-1">RT Platform</h1>
                <p class="text-xs font-mono text-slate-500 tracking-wider">RT 04 / RW 08 · Kel. Sukamaju</p>
            </div>

            <!-- Error Card -->
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm p-8 md:p-10 mb-6">
                <!-- Icon -->
                <div class="w-14 h-14 mx-auto bg-amber-50 rounded-full flex items-center justify-center mb-6 border border-amber-100">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                
                <!-- Text Content -->
                <div class="mb-8">
                    <div class="text-[10px] font-bold tracking-[0.15em] text-slate-400 uppercase mb-2">Status 403</div>
                    <h2 class="text-2xl font-display font-bold text-slate-900 mb-3">Anda tidak punya akses</h2>
                    <p class="text-sm text-slate-500 leading-relaxed max-w-sm mx-auto">
                        Akun Anda tidak memiliki otorisasi untuk membuka halaman ini. Hubungi pengurus RT jika Anda membutuhkan izin akses ke modul terkait.
                    </p>
                </div>
                
                <!-- Action -->
                <button class="w-full px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white font-semibold rounded-md text-sm transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-700 focus:ring-offset-2">
                    Kembali
                </button>
            </div>

            <!-- Footer Text -->
            <p class="text-xs text-slate-400">
                Bila kendala berlanjut, hubungi pengurus RT Anda.
            </p>

        </div>

    </main>

    <!-- Global Footer -->
    <footer class="py-6 text-center shrink-0">
        <p class="text-xs font-medium text-slate-400">© 2026 RT Platform</p>
    </footer>

</body>
</html>
