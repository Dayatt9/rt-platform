<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - RT Platform</title>
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
<body class="antialiased min-h-screen flex bg-slate-50">

    <!-- Sidebar -->
    <aside class="fixed inset-y-0 left-0 w-[260px] bg-white border-r border-slate-200 z-20 flex flex-col hidden lg:flex">
        <!-- Logo -->
        <div class="h-16 flex items-center px-6 border-b border-slate-200 shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-teal-700 text-white rounded flex items-center justify-center font-display font-bold text-lg">
                    R
                </div>
                <div>
                    <h1 class="font-display font-bold text-slate-900 text-sm leading-tight">RT Platform</h1>
                    <p class="text-[10px] text-slate-500 font-medium">Administrasi RT</p>
                </div>
            </div>
        </div>

        <!-- Tenant Label -->
        <div class="px-6 py-4">
            <div class="bg-slate-50 border border-slate-200 rounded px-3 py-2 text-xs font-medium text-slate-700">
                RT 04 / RW 08 · Kel. Sukamaju
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto px-4 space-y-6 pb-6">
            
            <!-- Overview -->
            <div>
                <div class="px-2 mb-2 text-[10px] font-bold tracking-wider text-slate-400 uppercase">Overview</div>
                <div class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-3 py-2 bg-teal-700 text-white rounded-md text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                </div>
            </div>

            <!-- Administrasi -->
            <div>
                <div class="px-2 mb-2 text-[10px] font-bold tracking-wider text-slate-400 uppercase">Administrasi</div>
                <div class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-3 py-2 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-md text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        Data Warga
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-md text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Data Keluarga
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-md text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Data Rumah & Peta
                    </a>
                </div>
            </div>

            <!-- Layanan -->
            <div>
                <div class="px-2 mb-2 text-[10px] font-bold tracking-wider text-slate-400 uppercase">Layanan</div>
                <div class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-3 py-2 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-md text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Surat Administrasi
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-md text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        Pengaduan Warga
                    </a>
                </div>
            </div>

            <!-- Keuangan -->
            <div>
                <div class="px-2 mb-2 text-[10px] font-bold tracking-wider text-slate-400 uppercase">Keuangan</div>
                <div class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-3 py-2 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-md text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Iuran
                    </a>
                </div>
            </div>

            <!-- Informasi -->
            <div>
                <div class="px-2 mb-2 text-[10px] font-bold tracking-wider text-slate-400 uppercase">Informasi</div>
                <div class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-3 py-2 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-md text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                        Pengumuman
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-md text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Kegiatan
                    </a>
                </div>
            </div>

            <!-- Sistem -->
            <div>
                <div class="px-2 mb-2 text-[10px] font-bold tracking-wider text-slate-400 uppercase">Sistem</div>
                <div class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-3 py-2 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-md text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Log Aktivitas
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 text-slate-600 hover:bg-slate-50 hover:text-slate-900 rounded-md text-sm font-medium transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Pengaturan RT
                    </a>
                </div>
            </div>

        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen lg:pl-[260px]">
        
        <!-- Header -->
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 sticky top-0 z-10">
            <!-- Search -->
            <div class="flex-1 max-w-md relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" placeholder="Cari nama warga atau no. rumah..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-md text-sm bg-slate-50 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-1 focus:ring-teal-700 focus:border-teal-700 transition-colors">
            </div>

            <!-- Header Actions -->
            <div class="flex items-center gap-4 pl-4">
                <button class="hidden sm:inline-flex px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white font-medium rounded-md text-sm transition-colors shadow-sm focus:outline-none items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Warga
                </button>
                
                <div class="h-6 w-px bg-slate-200 mx-1"></div>

                <!-- Notification -->
                <button class="relative p-2 text-slate-400 hover:text-slate-600 transition-colors rounded-full hover:bg-slate-50">
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-500 rounded-full border border-white"></span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </button>

                <!-- Profile -->
                <div class="flex items-center gap-3 pl-2 border-l border-slate-200">
                    <div class="w-8 h-8 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center font-bold text-sm">
                        H
                    </div>
                    <div class="hidden sm:block text-right leading-tight">
                        <div class="text-sm font-semibold text-slate-900">Bpk. Hendrawan</div>
                        <div class="text-[10px] font-medium text-slate-500">Ketua RT 04</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Workspace -->
        <main class="flex-1 p-6 lg:p-8 max-w-[1600px] mx-auto w-full space-y-6">
            
            <!-- Page Header -->
            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-display font-bold text-slate-900">Ringkasan Operasional RT 04</h2>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-semibold bg-teal-50 text-teal-700 border border-teal-200">RT 04 Sukamaju</span>
                        <span class="text-sm text-slate-500">Periode September 2026</span>
                    </div>
                    <p class="text-xs text-slate-400 mt-2">Pembaruan Terakhir: 20 Sep 2026 - 14:15 WIB</p>
                </div>

                <!-- View Toggles (For Demo Purposes) -->
                <div class="flex bg-white border border-slate-200 rounded-md p-1 shadow-sm shrink-0 h-fit">
                    <button class="px-3 py-1.5 text-xs font-semibold rounded bg-slate-100 text-slate-800 shadow-sm border border-slate-200">Standar<br><span class="font-normal">(Aktif)</span></button>
                    <button class="px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700">Skeleton</button>
                    <button class="px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700">Kosong</button>
                    <button class="px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700">Error<br>Server</button>
                </div>
            </div>

            <!-- Alert / Callout -->
            <div class="rounded-md border-l-4 border-amber-500 bg-amber-50 p-4 flex items-start justify-between gap-4 shadow-sm">
                <div class="flex items-start">
                    <div class="shrink-0 text-amber-500">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-amber-900">Perhatian Pengurus: Terdapat 2 surat permohonan menunggu persetujuan dan 1 pengaduan warga kategori fasilitas membutuhkan tindak lanjut hari ini.</h3>
                    </div>
                </div>
                <button class="shrink-0 text-sm font-semibold text-amber-800 hover:text-amber-900 flex items-center gap-1">
                    Tinjau sekarang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4">
                <!-- Total Warga -->
                <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="text-sm font-medium text-slate-500 mb-1 flex justify-between items-center">
                            Total Warga
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <div class="text-3xl font-display font-bold text-slate-900">486</div>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-4 leading-tight">
                        <span class="font-medium text-slate-700">412 aktif</span> - 74 pindah/mutasi
                    </div>
                </div>

                <!-- Total KK -->
                <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="text-sm font-medium text-slate-500 mb-1 flex justify-between items-center">
                            Total KK
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div class="text-3xl font-display font-bold text-slate-900">142 <span class="text-sm font-medium text-slate-500 ml-1">KK</span></div>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-4 leading-tight">
                        8 rumah multi-KK
                    </div>
                </div>

                <!-- Total Rumah -->
                <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="text-sm font-medium text-slate-500 mb-1 flex justify-between items-center">
                            Total Rumah
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <div class="text-3xl font-display font-bold text-slate-900">134 <span class="text-sm font-medium text-slate-500 ml-1">Unit</span></div>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-4 leading-tight">
                        <span class="font-medium text-slate-700">128 berpenghuni</span> - 6 kosong
                    </div>
                </div>

                <!-- Surat Menunggu -->
                <div class="bg-white p-5 rounded-lg border border-amber-200 shadow-sm flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-2 h-full bg-amber-400"></div>
                    <div>
                        <div class="text-sm font-medium text-slate-500 mb-1 leading-tight pr-4">Surat Menunggu Diproses</div>
                        <div class="text-3xl font-display font-bold text-slate-900">3</div>
                    </div>
                    <div class="mt-4">
                        <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-semibold bg-amber-100 text-amber-800 border border-amber-200">
                            3 Butuh Tindakan
                        </span>
                    </div>
                </div>

                <!-- Pengaduan Aktif -->
                <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-2 h-full bg-blue-500"></div>
                    <div>
                        <div class="text-sm font-medium text-slate-500 mb-1 leading-tight pr-4">Pengaduan Aktif</div>
                        <div class="text-3xl font-display font-bold text-slate-900">3</div>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-4 leading-tight">
                        Baru 1 - Diproses 2
                    </div>
                </div>

                <!-- Iuran Menunggu Verifikasi -->
                <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-2 h-full bg-amber-400"></div>
                    <div>
                        <div class="text-sm font-medium text-slate-500 mb-1 leading-tight pr-4">Iuran Menunggu Verifikasi</div>
                        <div class="text-3xl font-display font-bold text-slate-900">2</div>
                    </div>
                    <div class="text-[10px] text-slate-500 mt-3 leading-tight">
                        Rp 120.rb/tagihan<br>
                        - Jatuh Tempo 25/09 (42 tagihan belum bayar)
                    </div>
                </div>
            </div>

            <!-- Two Columns Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Column (Wider) -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Antrean Pengajuan Surat -->
                    <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                        <div class="p-4 border-b border-slate-200 flex items-center justify-between">
                            <div>
                                <h3 class="font-display font-semibold text-slate-900">Antrean Pengajuan Surat</h3>
                                <p class="text-xs text-slate-500 mt-0.5">5 pengajuan surat terbaru yang perlu ditindaklanjuti.</p>
                            </div>
                            <a href="#" class="text-sm font-medium text-teal-700 hover:text-teal-800">Lihat Semua (5) ></a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm whitespace-nowrap">
                                <thead class="bg-slate-50 text-slate-600 font-medium border-b border-slate-200">
                                    <tr>
                                        <th class="px-4 py-3 font-normal text-xs">No. Surat</th>
                                        <th class="px-4 py-3 font-normal text-xs">Pemohon</th>
                                        <th class="px-4 py-3 font-normal text-xs">Jenis Surat</th>
                                        <th class="px-4 py-3 font-normal text-xs">Waktu Pengajuan</th>
                                        <th class="px-4 py-3 text-center font-normal text-xs">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
                                    <!-- Row 1 -->
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-4 py-3 font-mono text-xs text-slate-500">048/SP-<br>RT04/IX/2026</td>
                                        <td class="px-4 py-3">
                                            <div class="font-medium text-slate-900">Bambang Suryono</div>
                                            <div class="text-xs text-slate-500">Blok B2 No. 14</div>
                                        </td>
                                        <td class="px-4 py-3 text-xs">Keterangan<br>Domisili</td>
                                        <td class="px-4 py-3 text-xs text-slate-500">20/09/2026<br>10:15 WIB</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[11px] font-semibold bg-amber-50 text-amber-900 border border-amber-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Diajukan
                                            </span>
                                        </td>
                                    </tr>
                                    <!-- Row 2 -->
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-4 py-3 font-mono text-xs text-slate-500">047/SP-<br>RT04/IX/2026</td>
                                        <td class="px-4 py-3">
                                            <div class="font-medium text-slate-900">Dewi Lestari</div>
                                            <div class="text-xs text-slate-500">Blok C5 No. 02</div>
                                        </td>
                                        <td class="px-4 py-3 text-xs">Pengantar<br>SKCK</td>
                                        <td class="px-4 py-3 text-xs text-slate-500">20/09/2026<br>08:30 WIB</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[11px] font-semibold bg-amber-50 text-amber-900 border border-amber-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Diajukan
                                            </span>
                                        </td>
                                    </tr>
                                    <!-- Row 3 -->
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-4 py-3 font-mono text-xs text-slate-500">046/SP-<br>RT04/IX/2026</td>
                                        <td class="px-4 py-3">
                                            <div class="font-medium text-slate-900">Farhan Malik</div>
                                            <div class="text-xs text-slate-500">Blok A3 No. 04</div>
                                        </td>
                                        <td class="px-4 py-3 text-xs">Keterangan<br>Usaha</td>
                                        <td class="px-4 py-3 text-xs text-slate-500">19/09/2026<br>19:40 WIB</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[11px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> Diproses
                                            </span>
                                        </td>
                                    </tr>
                                    <!-- Row 4 -->
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-4 py-3 font-mono text-xs text-slate-500">045/SP-<br>RT04/IX/2026</td>
                                        <td class="px-4 py-3">
                                            <div class="font-medium text-slate-900">Agus Wicaksono</div>
                                            <div class="text-xs text-slate-500">Blok D1 No. 08</div>
                                        </td>
                                        <td class="px-4 py-3 text-xs">Pengantar<br>Nikah</td>
                                        <td class="px-4 py-3 text-xs text-slate-500">19/09/2026<br>14:10 WIB</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[11px] font-semibold bg-orange-50 text-orange-800 border border-orange-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-orange-600"></span> Perlu Revisi
                                            </span>
                                        </td>
                                    </tr>
                                    <!-- Row 5 -->
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-4 py-3 font-mono text-xs text-slate-500">044/SP-<br>RT04/IX/2026</td>
                                        <td class="px-4 py-3">
                                            <div class="font-medium text-slate-900">Siti Rahmawati</div>
                                            <div class="text-xs text-slate-500">Blok B1 No. 16</div>
                                        </td>
                                        <td class="px-4 py-3 text-xs">Ket. Belum<br>Punya Rumah</td>
                                        <td class="px-4 py-3 text-xs text-slate-500">18/09/2026<br>16:30 WIB</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[11px] font-semibold bg-green-50 text-green-800 border border-green-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Disetujui
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pengaduan Aktif -->
                    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-5">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="font-display font-semibold text-slate-900">Pengaduan Aktif</h3>
                                <p class="text-xs text-slate-500 mt-0.5">Laporan terkait fasilitas dan ketertiban dari warga.</p>
                            </div>
                            <a href="#" class="text-sm font-medium text-teal-700 hover:text-teal-800">Ke Halaman Pengaduan ></a>
                        </div>
                        
                        <div class="space-y-3">
                            <!-- Card 1 -->
                            <div class="border border-slate-200 rounded-md p-4 bg-slate-50/50">
                                <div class="flex items-start justify-between gap-4 mb-2">
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-0.5 bg-white border border-slate-200 rounded text-[10px] font-medium text-slate-500">Fasilitas Lingkungan</span>
                                        <h4 class="text-sm font-semibold text-slate-900">Lampu Penerangan Jalan Blok B Mati (Tiang 4)</h4>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-200 shrink-0">
                                        <span class="w-1 h-1 rounded-full bg-blue-600"></span> Diproses
                                    </span>
                                </div>
                                <div class="text-xs text-slate-500 mb-3 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Farhan Malik (B3/04) <span class="mx-1">•</span> 20/09/2026 09:10 WIB
                                </div>
                                <div class="bg-white p-3 border border-slate-200 rounded text-xs text-slate-600 flex items-start gap-2">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                    <p>Catatan: Sudah dikoordinasikan dengan petugas PLN sektor timur.</p>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="border border-slate-200 rounded-md p-4 bg-slate-50/50">
                                <div class="flex items-start justify-between gap-4 mb-2">
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-0.5 bg-white border border-slate-200 rounded text-[10px] font-medium text-slate-500">Kebersihan</span>
                                        <h4 class="text-sm font-semibold text-slate-900">Saluran Air Tersumbat Sampah Daun</h4>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[10px] font-semibold bg-amber-50 text-amber-900 border border-amber-200 shrink-0">
                                        <span class="w-1 h-1 rounded-full bg-amber-500"></span> Baru
                                    </span>
                                </div>
                                <div class="text-xs text-slate-500 mb-3 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Rahmat Hidayat (A4/04) <span class="mx-1">•</span> 19/09/2026 15:45 WIB
                                </div>
                                <div class="bg-white p-3 border border-slate-200 rounded text-xs text-slate-600 flex items-start gap-2">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                    <p>Catatan: Akan dimasukkan ke agenda kerja bakti minggu terdekat.</p>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="border border-slate-200 rounded-md p-4 bg-slate-50/50">
                                <div class="flex items-start justify-between gap-4 mb-2">
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-0.5 bg-white border border-slate-200 rounded text-[10px] font-medium text-slate-500">Ketertiban & Lingkungan</span>
                                        <h4 class="text-sm font-semibold text-slate-900">Pangkas Dahan Pohon Dekat Kabel Listrik</h4>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-200 shrink-0">
                                        <span class="w-1 h-1 rounded-full bg-blue-600"></span> Diproses
                                    </span>
                                </div>
                                <div class="text-xs text-slate-500 mb-3 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Dewi Lestari (C5/02) <span class="mx-1">•</span> 18/09/2026 11:20 WIB
                                </div>
                                <div class="bg-white p-3 border border-slate-200 rounded text-xs text-slate-600 flex items-start gap-2">
                                    <svg class="w-4 h-4 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                    <p>Catatan: Petugas keamanan sedang berkoordinasi untuk pemotongan bertahap.</p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Right Column (Narrower) -->
                <div class="space-y-6">
                    
                    <!-- Iuran Menunggu Verifikasi Widget -->
                    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-display font-semibold text-slate-900 text-sm">Iuran Menunggu Verifikasi<br><span class="text-xs font-normal text-slate-500">Konfirmasi transfer via WhatsApp/Manual</span></h3>
                            <div class="w-2 h-2 rounded-full bg-amber-400 mt-1"></div>
                        </div>
                        <div class="space-y-3 mb-4">
                            <!-- Item 1 -->
                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                <div>
                                    <div class="text-sm font-semibold text-slate-900">Bambang Suryono</div>
                                    <div class="text-[10px] text-slate-500 mb-1">Blok B2 / 14</div>
                                    <div class="text-xs font-bold text-teal-700 font-mono">Rp 125.000</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-[10px] text-slate-500 mb-1">20/09<br>09:30</div>
                                    <button class="px-2 py-1 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded text-[10px] inline-flex items-center gap-1 shadow-sm uppercase tracking-wider">
                                        <svg class="w-3 h-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Tinjau Bukti
                                    </button>
                                </div>
                            </div>
                            <!-- Item 2 -->
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm font-semibold text-slate-900">Dewi Lestari</div>
                                    <div class="text-[10px] text-slate-500 mb-1">Blok C5 / 02</div>
                                    <div class="text-xs font-bold text-teal-700 font-mono">Rp 125.000</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-[10px] text-slate-500 mb-1">20/09<br>08:15</div>
                                    <button class="px-2 py-1 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded text-[10px] inline-flex items-center gap-1 shadow-sm uppercase tracking-wider">
                                        <svg class="w-3 h-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Tinjau Bukti
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="bg-teal-50 border border-teal-100 rounded p-2 flex items-start gap-2">
                            <svg class="w-3.5 h-3.5 text-teal-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-[10px] text-teal-800 leading-tight">Mulai jatuh tempo 25/09/2026. Sebanyak 42 tagihan belum melakukan pembayaran.</p>
                        </div>
                    </div>

                    <!-- Kegiatan Mendatang Widget -->
                    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-display font-semibold text-slate-900 text-sm">Kegiatan Mendatang</h3>
                            <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Agenda RT</span>
                        </div>
                        <div class="space-y-4">
                            <!-- Item 1 -->
                            <div class="flex gap-3">
                                <div class="w-10 h-10 rounded bg-slate-50 border border-slate-200 flex flex-col items-center justify-center shrink-0">
                                    <div class="text-[9px] font-bold text-rose-600 uppercase">Sep</div>
                                    <div class="text-sm font-display font-bold text-slate-700">27</div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-slate-900 leading-tight">Kerja Bakti Saluran Air & Fogging</h4>
                                    <div class="text-[10px] text-slate-500 mt-1 flex items-center gap-1">
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Minggu, 27/09/2026 - 07:00 WIB
                                    </div>
                                    <div class="text-[10px] text-slate-500 mt-0.5 flex items-center gap-1">
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Lapangan & Selokan Utama RT 04
                                    </div>
                                </div>
                            </div>
                            <!-- Item 2 -->
                            <div class="flex gap-3">
                                <div class="w-10 h-10 rounded bg-slate-50 border border-slate-200 flex flex-col items-center justify-center shrink-0">
                                    <div class="text-[9px] font-bold text-teal-700 uppercase">Okt</div>
                                    <div class="text-sm font-display font-bold text-slate-700">03</div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-slate-900 leading-tight">Rapat Koordinasi Pengurus RT & Tokoh</h4>
                                    <div class="text-[10px] text-slate-500 mt-1 flex items-center gap-1">
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Sabtu, 03/10/2026 - 19:30 WIB
                                    </div>
                                    <div class="text-[10px] text-slate-500 mt-0.5 flex items-center gap-1">
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Balai Warga RT 04
                                    </div>
                                </div>
                            </div>
                            <!-- Item 3 -->
                            <div class="flex gap-3">
                                <div class="w-10 h-10 rounded bg-slate-50 border border-slate-200 flex flex-col items-center justify-center shrink-0">
                                    <div class="text-[9px] font-bold text-teal-700 uppercase">Okt</div>
                                    <div class="text-sm font-display font-bold text-slate-700">07</div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-slate-900 leading-tight">Posyandu Balita & Lansia Rutin</h4>
                                    <div class="text-[10px] text-slate-500 mt-1 flex items-center gap-1">
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Rabu, 07/10/2026 - 08:30 WIB
                                    </div>
                                    <div class="text-[10px] text-slate-500 mt-0.5 flex items-center gap-1">
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Rumah Ibu RW 08
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Log Aktivitas Pengurus -->
                    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-display font-semibold text-slate-900 text-sm flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Log Aktivitas Pengurus
                            </h3>
                            <a href="#" class="text-[10px] font-semibold text-teal-700 uppercase tracking-wider hover:text-teal-800">Seluruh Log</a>
                        </div>
                        
                        <div class="relative border-l-2 border-slate-200 ml-2 space-y-4 pb-2">
                            <!-- Log 1 -->
                            <div class="relative pl-4">
                                <div class="absolute w-2 h-2 bg-slate-300 rounded-full -left-[5px] top-1.5"></div>
                                <div class="flex justify-between items-start mb-0.5">
                                    <div class="text-xs font-semibold text-slate-800">Persetujuan Surat</div>
                                    <div class="text-[10px] text-slate-500 font-mono">20/09 14:15 WIB</div>
                                </div>
                                <p class="text-[10px] text-slate-600 leading-relaxed">
                                    Bpk. Hendrawan (Ketua RT 04) menyetujui Surat Pengantar No. <strong>044/SP-RT04/IX/2026</strong>
                                </p>
                            </div>
                            <!-- Log 2 -->
                            <div class="relative pl-4">
                                <div class="absolute w-2 h-2 bg-slate-300 rounded-full -left-[5px] top-1.5"></div>
                                <div class="flex justify-between items-start mb-0.5">
                                    <div class="text-xs font-semibold text-slate-800">Update Status Aduan</div>
                                    <div class="text-[10px] text-slate-500 font-mono">20/09 13:50 WIB</div>
                                </div>
                                <p class="text-[10px] text-slate-600 leading-relaxed">
                                    Ibu Ratna (Sekretaris) mengubah status pengaduan <strong>#PG-319</strong> menjadi "Diproses"
                                </p>
                            </div>
                            <!-- Log 3 -->
                            <div class="relative pl-4">
                                <div class="absolute w-2 h-2 bg-slate-300 rounded-full -left-[5px] top-1.5"></div>
                                <div class="flex justify-between items-start mb-0.5">
                                    <div class="text-xs font-semibold text-rose-600 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Melihat NIK Tersensor
                                    </div>
                                    <div class="text-[10px] text-slate-500 font-mono">20/09 10:14 WIB</div>
                                </div>
                                <p class="text-[10px] text-slate-600 leading-relaxed">
                                    Bpk. Hendrawan membuka unmasking NIK warga Bambang Suryono (•••• •••• •••• 0001)
                                </p>
                            </div>
                            <!-- Log 4 -->
                            <div class="relative pl-4">
                                <div class="absolute w-2 h-2 bg-slate-300 rounded-full -left-[5px] top-1.5"></div>
                                <div class="flex justify-between items-start mb-0.5">
                                    <div class="text-xs font-semibold text-slate-800">Pengajuan Akun Warga</div>
                                    <div class="text-[10px] text-slate-500 font-mono">19/09 19:40 WIB</div>
                                </div>
                                <p class="text-[10px] text-slate-600 leading-relaxed">
                                    Siti Rahmawati mengajukan permohonan surat melalui aplikasi warga
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </main>
    </div>

</body>
</html>
