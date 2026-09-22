@extends('layouts.admin')

@section('title', 'Data Warga - RT Platform')

@section('content')
<div class="space-y-6">
    
    <!-- Top Nav / Toggles (Demo State from screenshot) -->
    <div class="flex items-center justify-between border-b border-slate-200 pb-4">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-teal-700 text-white rounded flex items-center justify-center font-display font-bold text-lg">
                R
            </div>
            <div>
                <h1 class="font-display font-bold text-slate-900 text-sm leading-tight">RT Platform</h1>
                <p class="text-[10px] text-slate-500 font-medium">Administrasi RT</p>
            </div>
        </div>
        
        <div class="flex items-center gap-2">
            <span class="text-xs text-slate-500 font-medium">Demo State:</span>
            <div class="flex bg-white border border-slate-200 rounded-md p-0.5 shadow-sm">
                <button class="px-3 py-1.5 text-xs font-semibold rounded bg-teal-700 text-white shadow-sm border border-teal-800">Normal</button>
                <button class="px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700">Loading</button>
                <button class="px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700">Kosong</button>
                <button class="px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700">Hasil Nihil</button>
                <button class="px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700">Error</button>
                <button class="px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700">403 Izin</button>
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
        <div>
            <h2 class="text-2xl font-display font-bold text-slate-900">Data Warga</h2>
            <p class="text-sm text-slate-500 mt-1">Kelola daftar kependudukan, status domisili, dan akun warga RT 04.</p>
        </div>

        <div class="flex items-center gap-3 shrink-0">
            <button class="px-4 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded-md text-sm transition-colors shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                Ekspor
            </button>
            <button class="px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white font-medium rounded-md text-sm transition-colors shadow-sm focus:outline-none flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Warga
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1 -->
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm flex flex-col justify-between">
            <div>
                <div class="text-xs font-bold tracking-wider text-slate-500 uppercase mb-2 flex justify-between items-center">
                    TOTAL WARGA
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div class="text-3xl font-display font-bold text-slate-900">486 <span class="text-sm font-medium text-slate-500 ml-1">jiwa</span></div>
            </div>
            <div class="text-[11px] text-slate-500 mt-4 leading-tight flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                142 KK - RT 04
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm flex flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 w-1 h-full bg-teal-500"></div>
            <div>
                <div class="text-xs font-bold tracking-wider text-slate-500 uppercase mb-2 flex justify-between items-center pr-2">
                    WARGA AKTIF
                    <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path></svg>
                </div>
                <div class="text-3xl font-display font-bold text-slate-900">472 <span class="text-sm font-medium text-slate-500 ml-1">jiwa</span></div>
            </div>
            <div class="text-[11px] text-slate-500 mt-4 leading-tight flex items-center gap-1.5 text-teal-700 font-medium">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Status Tetap & Kontrak
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm flex flex-col justify-between">
            <div>
                <div class="text-xs font-bold tracking-wider text-slate-500 uppercase mb-2 flex justify-between items-center">
                    PINDAH / MUTASI
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <div class="text-3xl font-display font-bold text-slate-900">14 <span class="text-sm font-medium text-slate-500 ml-1">jiwa</span></div>
            </div>
            <div class="text-[11px] text-slate-500 mt-4 leading-tight flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Tercatat arsip mutasi
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white p-5 rounded-lg border border-orange-200 shadow-sm flex flex-col justify-between relative overflow-hidden bg-orange-50/30">
            <div class="absolute top-0 right-0 w-1 h-full bg-orange-400"></div>
            <div>
                <div class="text-xs font-bold tracking-wider text-orange-800 uppercase mb-2 flex justify-between items-center pr-2">
                    BELUM PUNYA AKUN
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div class="text-3xl font-display font-bold text-slate-900">118 <span class="text-sm font-medium text-slate-500 ml-1">warga</span></div>
            </div>
            <div class="text-[11px] text-orange-700 mt-4 leading-tight flex items-start gap-1.5 font-medium">
                <svg class="w-3.5 h-3.5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 14l-2 2m0 0l-2-2m2 2V6m-6 8h12"></path></svg>
                Perlu distribusi kode aktivasi
            </div>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4">
        <div class="text-xs font-bold text-slate-700 mb-3">Pencarian</div>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
            
            <!-- Main Search Input -->
            <div class="md:col-span-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" placeholder="Cari nama, rumah (Blok/No), atau NIK..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-teal-700 focus:border-teal-700">
                </div>
                <p class="text-[11px] font-mono text-slate-500 mt-1.5 ml-1">NIK boleh dicari, hasil tetap termasking</p>
            </div>

            <!-- Status Warga Dropdown -->
            <div class="md:col-span-2">
                <label class="block text-[11px] font-semibold text-slate-700 mb-1">Status Warga</label>
                <select class="block w-full py-2 px-3 border border-slate-200 rounded-md text-sm bg-white focus:outline-none focus:ring-1 focus:ring-teal-700 focus:border-teal-700 text-slate-700">
                    <option>Semua Status</option>
                    <option>Tetap</option>
                    <option>Kontrak</option>
                    <option>Pindah</option>
                </select>
            </div>

            <!-- Status Akun Dropdown -->
            <div class="md:col-span-2">
                <label class="block text-[11px] font-semibold text-slate-700 mb-1">Status Akun</label>
                <select class="block w-full py-2 px-3 border border-slate-200 rounded-md text-sm bg-white focus:outline-none focus:ring-1 focus:ring-teal-700 focus:border-teal-700 text-slate-700">
                    <option>Semua Status Akun</option>
                    <option>Aktif</option>
                    <option>Belum Punya Akun</option>
                    <option>Kode Aktif</option>
                </select>
            </div>

            <!-- Blok Dropdown -->
            <div class="md:col-span-2">
                <label class="block text-[11px] font-semibold text-slate-700 mb-1">Blok</label>
                <select class="block w-full py-2 px-3 border border-slate-200 rounded-md text-sm bg-white focus:outline-none focus:ring-1 focus:ring-teal-700 focus:border-teal-700 text-slate-700">
                    <option>Semua Blok</option>
                    <option>Blok A1</option>
                    <option>Blok B2</option>
                    <option>Blok C3</option>
                </select>
            </div>
        </div>
        
        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-3">
            <span class="text-xs text-slate-500">Filter Aktif:</span>
            <span class="inline-flex px-2 py-1 rounded bg-slate-100 text-slate-700 text-xs font-medium border border-slate-200">Blok: Semua</span>
            <span class="inline-flex px-2 py-1 rounded bg-slate-100 text-slate-700 text-xs font-medium border border-slate-200">Status: Semua</span>
            <a href="#" class="text-xs font-medium text-slate-500 hover:text-slate-700 underline">Reset Filter</a>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-slate-50 text-slate-600 font-bold border-b border-slate-200 text-xs tracking-wider uppercase">
                    <tr>
                        <th class="px-5 py-4">Nama Lengkap</th>
                        <th class="px-5 py-4">NIK</th>
                        <th class="px-5 py-4">Rumah (Blok/No)</th>
                        <th class="px-5 py-4 text-center">Status Warga</th>
                        <th class="px-5 py-4">Status Akun</th>
                        <th class="px-5 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <!-- Row 1 -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-teal-50 text-teal-700 border border-teal-200 flex items-center justify-center font-bold text-xs shrink-0">BS</div>
                                <div>
                                    <div class="font-semibold text-slate-900 flex items-center gap-2">
                                        Bambang Suryono 
                                        <span class="px-1.5 py-0.5 rounded text-[10px] font-semibold bg-teal-50 text-teal-700 border border-teal-200">Kepala Keluarga</span>
                                    </div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">Laki-laki - 46 th</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-slate-800 text-sm tracking-widest font-bold">•••• •••• •••• 1042</span>
                                <button class="text-slate-400 hover:text-slate-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-slate-600">Blok B2 No. 14</td>
                        <td class="px-5 py-3 text-center">
                            <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium text-slate-600 border border-slate-300 bg-white">Tetap</span>
                        </td>
                        <td class="px-5 py-3">
                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium text-green-700 bg-green-50 border border-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <button class="px-3 py-1 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded text-xs transition-colors shadow-sm">Detail</button>
                        </td>
                    </tr>
                    
                    <!-- Row 2 -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 border border-slate-200 flex items-center justify-center font-bold text-xs shrink-0">SR</div>
                                <div>
                                    <div class="font-semibold text-slate-900 flex items-center gap-2">
                                        Siti Rahmawati 
                                        <span class="text-[10px] text-slate-400">Istri</span>
                                    </div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">Perempuan - 43 th</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-slate-800 text-sm tracking-widest font-bold">•••• •••• •••• 1043</span>
                                <button class="text-slate-400 hover:text-slate-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-slate-600">Blok B2 No. 14</td>
                        <td class="px-5 py-3 text-center">
                            <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium text-slate-600 border border-slate-300 bg-white">Tetap</span>
                        </td>
                        <td class="px-5 py-3">
                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium text-green-700 bg-green-50 border border-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <button class="px-3 py-1 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded text-xs transition-colors shadow-sm">Detail</button>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 border border-slate-200 flex items-center justify-center font-bold text-xs shrink-0">KP</div>
                                <div>
                                    <div class="font-semibold text-slate-900 flex items-center gap-2">
                                        Kevin Pratama 
                                        <span class="text-[10px] text-slate-400">Anak</span>
                                    </div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">Laki-laki - 18 th</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-slate-800 text-sm tracking-widest font-bold">•••• •••• •••• 1045</span>
                                <button class="text-slate-400 hover:text-slate-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-slate-600">Blok B2 No. 14</td>
                        <td class="px-5 py-3 text-center">
                            <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium text-slate-600 border border-slate-300 bg-white">Tetap</span>
                        </td>
                        <td class="px-5 py-3">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold text-orange-800 bg-orange-100 border border-orange-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Belum punya akun
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <button class="px-3 py-1 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded text-xs transition-colors shadow-sm">Detail</button>
                        </td>
                    </tr>

                    <!-- Row 4 -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-teal-50 text-teal-700 border border-teal-200 flex items-center justify-center font-bold text-xs shrink-0">FM</div>
                                <div>
                                    <div class="font-semibold text-slate-900 flex items-center gap-2">
                                        Farhan Malik 
                                        <span class="px-1.5 py-0.5 rounded text-[10px] font-semibold bg-teal-50 text-teal-700 border border-teal-200">Kepala Keluarga</span>
                                    </div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">Laki-laki - 36 th</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-slate-800 text-sm tracking-widest font-bold">•••• •••• •••• 2189</span>
                                <button class="text-slate-400 hover:text-slate-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-slate-600 flex items-center gap-1">Blok B2 No. 14 <span class="text-[10px] text-slate-400 font-mono">(KK Ke-2)</span></td>
                        <td class="px-5 py-3 text-center">
                            <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium text-slate-600 border border-slate-300 bg-white">Tetap</span>
                        </td>
                        <td class="px-5 py-3">
                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium text-green-700 bg-green-50 border border-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <button class="px-3 py-1 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded text-xs transition-colors shadow-sm">Detail</button>
                        </td>
                    </tr>

                    <!-- Row 5 -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 border border-slate-200 flex items-center justify-center font-bold text-xs shrink-0">AM</div>
                                <div>
                                    <div class="font-semibold text-slate-900 flex items-center gap-2">
                                        Aisyah Malik 
                                        <span class="text-[10px] text-slate-400">Istri</span>
                                    </div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">Perempuan - 34 th</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-slate-800 text-sm tracking-widest font-bold">•••• •••• •••• 2190</span>
                                <button class="text-slate-400 hover:text-slate-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-slate-600">Blok B2 No. 14</td>
                        <td class="px-5 py-3 text-center">
                            <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium text-slate-600 border border-slate-300 bg-white">Tetap</span>
                        </td>
                        <td class="px-5 py-3">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold text-blue-800 bg-blue-50 border border-blue-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Kode aktif
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <button class="px-3 py-1 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded text-xs transition-colors shadow-sm">Detail</button>
                        </td>
                    </tr>

                    <!-- Row 6 -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-teal-50 text-teal-700 border border-teal-200 flex items-center justify-center font-bold text-xs shrink-0">RH</div>
                                <div>
                                    <div class="font-semibold text-slate-900 flex items-center gap-2">
                                        Rahmat Hidayat 
                                        <span class="px-1.5 py-0.5 rounded text-[10px] font-semibold bg-teal-50 text-teal-700 border border-teal-200">Kepala Keluarga</span>
                                    </div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">Laki-laki - 52 th</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-slate-800 text-sm tracking-widest font-bold">•••• •••• •••• 0811</span>
                                <button class="text-slate-400 hover:text-slate-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-slate-600">Blok A1 No. 04</td>
                        <td class="px-5 py-3 text-center">
                            <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium text-slate-600 border border-slate-300 bg-white">Tetap</span>
                        </td>
                        <td class="px-5 py-3">
                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium text-green-700 bg-green-50 border border-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <button class="px-3 py-1 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded text-xs transition-colors shadow-sm">Detail</button>
                        </td>
                    </tr>

                    <!-- Row 7 -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 border border-slate-200 flex items-center justify-center font-bold text-xs shrink-0">DL</div>
                                <div>
                                    <div class="font-semibold text-slate-900 flex items-center gap-2">
                                        Dewi Lestari 
                                    </div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">Perempuan - 39 th</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-slate-800 text-sm tracking-widest font-bold">•••• •••• •••• 3472</span>
                                <button class="text-slate-400 hover:text-slate-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-slate-600">Blok C3 No. 12</td>
                        <td class="px-5 py-3 text-center">
                            <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium text-slate-600 border border-slate-300 bg-white">Tetap</span>
                        </td>
                        <td class="px-5 py-3">
                            <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium text-green-700 bg-green-50 border border-green-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <button class="px-3 py-1 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded text-xs transition-colors shadow-sm">Detail</button>
                        </td>
                    </tr>

                    <!-- Row 8 -->
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-teal-50 text-teal-700 border border-teal-200 flex items-center justify-center font-bold text-xs shrink-0">AW</div>
                                <div>
                                    <div class="font-semibold text-slate-900 flex items-center gap-2">
                                        Agus Wicaksono 
                                        <span class="px-1.5 py-0.5 rounded text-[10px] font-semibold bg-teal-50 text-teal-700 border border-teal-200">Kepala Keluarga</span>
                                    </div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">Laki-laki - 29 th</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-slate-800 text-sm tracking-widest font-bold">•••• •••• •••• 4591</span>
                                <button class="text-slate-400 hover:text-slate-600"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                            </div>
                        </td>
                        <td class="px-5 py-3 text-slate-600">Blok D1 No. 05</td>
                        <td class="px-5 py-3 text-center">
                            <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium text-slate-600 border border-slate-300 bg-white">Kontrak</span>
                        </td>
                        <td class="px-5 py-3">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-semibold text-orange-800 bg-orange-100 border border-orange-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Belum punya akun
                            </span>
                        </td>
                        <td class="px-5 py-3 text-center">
                            <button class="px-3 py-1 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded text-xs transition-colors shadow-sm">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t border-slate-200 flex items-center justify-between bg-white text-sm">
            <div class="flex items-center gap-4">
                <p class="text-slate-600 text-xs">Menampilkan <span class="font-semibold text-slate-900">1-20</span> dari <span class="font-semibold text-slate-900">486</span> warga</p>
                <div class="flex items-center gap-2 text-xs text-slate-600">
                    Baris:
                    <select class="border border-slate-300 rounded px-2 py-1 text-xs focus:ring-teal-700 focus:border-teal-700 bg-white">
                        <option>20 per halaman</option>
                        <option>50 per halaman</option>
                        <option>100 per halaman</option>
                    </select>
                </div>
            </div>
            
            <div class="flex items-center gap-1">
                <button class="px-3 py-1.5 text-xs font-medium text-slate-500 hover:text-slate-700 rounded transition-colors disabled:opacity-50">Sebelumnya</button>
                <button class="w-7 h-7 flex items-center justify-center text-xs font-bold bg-teal-700 text-white rounded shadow-sm">1</button>
                <button class="w-7 h-7 flex items-center justify-center text-xs font-medium text-slate-600 hover:bg-slate-100 rounded">2</button>
                <button class="w-7 h-7 flex items-center justify-center text-xs font-medium text-slate-600 hover:bg-slate-100 rounded">3</button>
                <span class="w-7 h-7 flex items-center justify-center text-xs font-medium text-slate-400">...</span>
                <button class="w-7 h-7 flex items-center justify-center text-xs font-medium text-slate-600 hover:bg-slate-100 rounded">25</button>
                <button class="px-3 py-1.5 text-xs font-medium text-slate-600 hover:text-slate-900 rounded transition-colors border border-slate-200 bg-white shadow-sm ml-1">Berikutnya</button>
            </div>
        </div>
    </div>
</div>
@endsection
