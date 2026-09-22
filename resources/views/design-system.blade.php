<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RT Platform - Design System: Komponen & State</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC; /* canvas */
            color: #0F172A; /* main text */
        }
        h1, h2, h3, h4, h5, h6, .font-display {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-mono, .tabular-nums {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>
<body class="antialiased min-h-screen text-slate-900 bg-slate-50 p-8">
    
    <div class="max-w-5xl mx-auto space-y-16 pb-24">
        <!-- Header -->
        <div class="border-b border-slate-200 pb-8 flex items-end justify-between">
            <div>
                <p class="text-teal-700 font-semibold text-sm mb-2 tracking-wide uppercase">Dokumentasi Komponen & State</p>
                <h1 class="text-3xl font-display font-bold text-slate-900">RT Platform — Design System</h1>
                <p class="text-slate-600 mt-2 text-sm max-w-2xl">
                    Referensi visual untuk semua elemen UI, interaksi, dan layout aplikasi. Dioptimalkan untuk kecepatan pengembangan menggunakan Tailwind CSS dan Blade.
                </p>
            </div>
            <div class="text-right text-sm text-slate-500">
                <p>Status: <span class="font-medium text-slate-700">Production Ready</span></p>
                <p>Versi: 1.0 (Berdasarkan DESIGN.md)</p>
            </div>
        </div>

        <!-- 01. Tombol (Buttons) -->
        <section class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                <h2 class="text-xl font-display font-semibold text-slate-800 flex items-center gap-2">
                    <span class="text-slate-400 font-mono text-sm">01</span> Tombol (Buttons)
                </h2>
                <span class="text-xs text-slate-500">Primary, Secondary, Outline, Destructive, Ghost</span>
            </div>

            <div class="bg-white p-8 rounded-lg border border-slate-200 shadow-sm overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-sm font-medium text-slate-500">
                            <th class="pb-3 font-normal w-48">Varian</th>
                            <th class="pb-3 font-normal">Default</th>
                            <th class="pb-3 font-normal">Hover/Active</th>
                            <th class="pb-3 font-normal">Disabled</th>
                            <th class="pb-3 font-normal">Dengan Ikon</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <!-- Primary -->
                        <tr class="border-b border-slate-100">
                            <td class="py-4 font-medium text-slate-700">Primary</td>
                            <td class="py-4">
                                <button class="px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white font-medium rounded-md text-sm transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-700 focus:ring-offset-1">
                                    Simpan Data
                                </button>
                            </td>
                            <td class="py-4">
                                <button class="px-4 py-2 bg-teal-800 text-white font-medium rounded-md text-sm transition-colors shadow-sm focus:outline-none">
                                    Simpan Data
                                </button>
                            </td>
                            <td class="py-4">
                                <button disabled class="px-4 py-2 bg-slate-100 text-slate-400 font-medium rounded-md text-sm cursor-not-allowed">
                                    Simpan Data
                                </button>
                            </td>
                            <td class="py-4">
                                <button class="px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white font-medium rounded-md text-sm transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-700 focus:ring-offset-1 inline-flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    Tambah Warga
                                </button>
                            </td>
                        </tr>
                        <!-- Secondary -->
                        <tr class="border-b border-slate-100">
                            <td class="py-4 font-medium text-slate-700">Secondary / Outline</td>
                            <td class="py-4">
                                <button class="px-4 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded-md text-sm transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-700 focus:ring-offset-1">
                                    Batal
                                </button>
                            </td>
                            <td class="py-4">
                                <button class="px-4 py-2 bg-slate-50 border border-slate-300 text-slate-800 font-medium rounded-md text-sm transition-colors shadow-sm focus:outline-none">
                                    Batal
                                </button>
                            </td>
                            <td class="py-4">
                                <button disabled class="px-4 py-2 bg-white border border-slate-200 text-slate-400 font-medium rounded-md text-sm cursor-not-allowed">
                                    Batal
                                </button>
                            </td>
                            <td class="py-4">
                                <button class="px-4 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded-md text-sm transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-700 focus:ring-offset-1 inline-flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                                    Filter Data
                                </button>
                            </td>
                        </tr>
                        <!-- Destructive -->
                        <tr>
                            <td class="py-4 font-medium text-slate-700">Destructive</td>
                            <td class="py-4">
                                <button class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white font-medium rounded-md text-sm transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-rose-600 focus:ring-offset-1">
                                    Hapus
                                </button>
                            </td>
                            <td class="py-4">
                                <button class="px-4 py-2 bg-rose-700 text-white font-medium rounded-md text-sm transition-colors shadow-sm focus:outline-none">
                                    Hapus
                                </button>
                            </td>
                            <td class="py-4">
                                <button disabled class="px-4 py-2 bg-slate-100 text-slate-400 font-medium rounded-md text-sm cursor-not-allowed">
                                    Hapus
                                </button>
                            </td>
                            <td class="py-4">
                                <button class="px-4 py-2 bg-white border border-rose-200 hover:bg-rose-50 text-rose-600 hover:text-rose-700 font-medium rounded-md text-sm transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-rose-600 focus:ring-offset-1 inline-flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus Permanen
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- 02. Badge Status & Label Spesifik -->
        <section class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                <h2 class="text-xl font-display font-semibold text-slate-800 flex items-center gap-2">
                    <span class="text-slate-400 font-mono text-sm">02</span> Badge Status & Indikator
                </h2>
                <span class="text-xs text-slate-500">Siklus Data: Surat, Iuran, Warga</span>
            </div>

            <div class="bg-white p-8 rounded-lg border border-slate-200 shadow-sm space-y-8">
                
                <!-- Surat -->
                <div>
                    <h3 class="text-sm font-semibold text-slate-700 mb-4">Status Pengajuan (Surat / Pengaduan)</h3>
                    <div class="flex flex-wrap gap-4">
                        <!-- Menunggu / Diajukan -->
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-semibold bg-amber-50 text-amber-900 border border-amber-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            Diajukan
                        </span>
                        <!-- Diproses -->
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                            Diproses
                        </span>
                        <!-- Perlu Revisi -->
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-semibold bg-orange-50 text-orange-800 border border-orange-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-orange-600"></span>
                            Perlu Revisi
                        </span>
                        <!-- Disetujui / Selesai -->
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-800 border border-green-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                            Selesai
                        </span>
                        <!-- Ditolak -->
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span>
                            Ditolak
                        </span>
                    </div>
                </div>

                <!-- Iuran -->
                <div>
                    <h3 class="text-sm font-semibold text-slate-700 mb-4">Status Transaksi (Iuran)</h3>
                    <div class="flex flex-wrap gap-4">
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                            Belum Dibayar
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-semibold bg-amber-50 text-amber-900 border border-amber-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                            Menunggu Verifikasi
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-800 border border-green-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                            Lunas
                        </span>
                    </div>
                </div>

            </div>
        </section>

        <!-- 03. Input & Elemen Form -->
        <section class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                <h2 class="text-xl font-display font-semibold text-slate-800 flex items-center gap-2">
                    <span class="text-slate-400 font-mono text-sm">03</span> Input & Elemen Form
                </h2>
                <span class="text-xs text-slate-500">Teks, Area, Select, Error States</span>
            </div>

            <div class="bg-white p-8 rounded-lg border border-slate-200 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    
                    <!-- Text Input -->
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700">Nama Lengkap <span class="text-rose-500">*</span></label>
                        <input type="text" placeholder="Sesuai KTP" class="w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                            focus:outline-none focus:border-teal-700 focus:ring-1 focus:ring-teal-700">
                    </div>

                    <!-- Text Input (Focus/Active representation) -->
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700">Nomor Induk Kependudukan (NIK) <span class="text-rose-500">*</span></label>
                        <input type="text" value="327101" class="w-full px-3 py-2 bg-white border-teal-700 ring-1 ring-teal-700 rounded-md text-sm shadow-sm font-mono
                            focus:outline-none">
                        <p class="text-xs text-slate-500">Pastikan 16 digit angka.</p>
                    </div>

                    <!-- Text Input Error -->
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700">Nomor Kartu Keluarga (KK) <span class="text-rose-500">*</span></label>
                        <input type="text" value="32710123" class="w-full px-3 py-2 bg-white border border-rose-300 text-rose-900 rounded-md text-sm shadow-sm placeholder-rose-300 font-mono
                            focus:outline-none focus:ring-rose-500 focus:border-rose-500">
                        <p class="text-xs text-rose-600">Nomor KK harus 16 digit.</p>
                    </div>

                    <!-- Disabled Input -->
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700">Role Pengguna</label>
                        <input type="text" value="Admin RT" disabled class="w-full px-3 py-2 bg-slate-50 border border-slate-200 text-slate-500 rounded-md text-sm cursor-not-allowed">
                    </div>

                    <!-- Select Input -->
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700">Status Warga <span class="text-rose-500">*</span></label>
                        <select class="w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm focus:outline-none focus:border-teal-700 focus:ring-1 focus:ring-teal-700">
                            <option>Pilih Status...</option>
                            <option selected>Aktif</option>
                            <option>Pindah</option>
                            <option>Meninggal</option>
                        </select>
                    </div>

                    <!-- Textarea -->
                    <div class="space-y-1 md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700">Catatan / Alasan Penolakan</label>
                        <textarea rows="3" placeholder="Masukkan alasan yang jelas agar warga dapat memahami..." class="w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                            focus:outline-none focus:border-teal-700 focus:ring-1 focus:ring-teal-700"></textarea>
                    </div>

                </div>
            </div>
        </section>

        <!-- 04. Field Masking -->
        <section class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                <h2 class="text-xl font-display font-semibold text-slate-800 flex items-center gap-2">
                    <span class="text-slate-400 font-mono text-sm">04</span> Field Masking (Data Sensitif)
                </h2>
                <span class="text-xs text-slate-500">NIK, No. HP - Privacy by Design</span>
            </div>

            <div class="bg-white p-8 rounded-lg border border-slate-200 shadow-sm grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Masked State -->
                <div class="p-4 border border-slate-200 rounded-lg bg-slate-50 relative group">
                    <div class="text-xs font-medium text-slate-500 mb-1">NIK Tersamarkan (Default)</div>
                    <div class="font-mono text-slate-800 text-lg flex items-center gap-3">
                        •••• •••• •••• 0001
                        <button class="text-slate-400 hover:text-teal-700 transition-colors p-1" title="Lihat NIK (dicatat di Audit Log)">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Revealed State -->
                <div class="p-4 border border-teal-200 rounded-lg bg-teal-50 relative">
                    <div class="flex justify-between items-start mb-1">
                        <div class="text-xs font-medium text-teal-700">NIK Ditampilkan Sementara</div>
                        <div class="text-[10px] text-teal-600 font-medium bg-teal-100 px-2 py-0.5 rounded-full flex items-center gap-1 animate-pulse">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            29s
                        </div>
                    </div>
                    <div class="font-mono text-teal-900 text-lg flex items-center gap-3">
                        3271 0123 4567 0001
                        <button class="text-teal-600 hover:text-teal-800 transition-colors p-1" title="Salin NIK">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        </button>
                    </div>
                </div>

            </div>
        </section>

        <!-- 05. Dialogs / Modals -->
        <section class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                <h2 class="text-xl font-display font-semibold text-slate-800 flex items-center gap-2">
                    <span class="text-slate-400 font-mono text-sm">05</span> Dialog Konfirmasi
                </h2>
                <span class="text-xs text-slate-500">Aksi Standar, Destruktif, & Butuh Alasan</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Standard Dialog (Approval) -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-xl shadow-slate-200/40 p-6 relative overflow-hidden">
                    <div class="flex items-start gap-4">
                        <div class="shrink-0 bg-green-100 p-2 rounded-full text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-display font-bold text-slate-900 mb-1">Setujui Surat Pengantar?</h3>
                            <p class="text-sm text-slate-600 mb-6 leading-relaxed">
                                Anda akan menyetujui "Surat Keterangan Domisili" atas nama <strong>Budi Santoso</strong>. Notifikasi akan dikirim ke warga bersangkutan.
                            </p>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button class="px-4 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded-md text-sm">Batal</button>
                        <button class="px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white font-medium rounded-md text-sm">Setujui Surat</button>
                    </div>
                </div>

                <!-- Destructive with Validation -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-xl shadow-slate-200/40 p-6 relative overflow-hidden">
                    <div class="flex items-start gap-4">
                        <div class="shrink-0 bg-rose-100 p-2 rounded-full text-rose-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                        <div class="w-full">
                            <h3 class="text-lg font-display font-bold text-slate-900 mb-1">Hapus Data Warga?</h3>
                            <p class="text-sm text-slate-600 mb-4 leading-relaxed">
                                Data <strong>Budi Santoso</strong> akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.
                            </p>
                            <div class="mb-5 space-y-1">
                                <label class="block text-xs text-slate-500">Ketik "Budi Santoso" untuk konfirmasi</label>
                                <input type="text" class="w-full px-3 py-2 border border-slate-300 rounded-md text-sm focus:border-rose-500 focus:ring-1 focus:ring-rose-500">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button class="px-4 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded-md text-sm">Batal</button>
                        <button disabled class="px-4 py-2 bg-rose-200 text-white font-medium rounded-md text-sm cursor-not-allowed">Hapus Permanen</button>
                    </div>
                </div>

                <!-- Reason Required -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-xl shadow-slate-200/40 p-6 relative overflow-hidden md:col-span-2 lg:col-span-1">
                    <div class="flex items-start gap-4">
                        <div class="shrink-0 bg-orange-100 p-2 rounded-full text-orange-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </div>
                        <div class="w-full">
                            <h3 class="text-lg font-display font-bold text-slate-900 mb-1">Minta Revisi Surat</h3>
                            <p class="text-sm text-slate-600 mb-4 leading-relaxed">
                                Berikan alasan agar warga dapat memperbaiki pengajuan surat mereka.
                            </p>
                            <div class="mb-5 space-y-1">
                                <label class="block text-xs text-slate-500">Alasan Revisi <span class="text-rose-500">*</span></label>
                                <textarea rows="2" class="w-full px-3 py-2 border border-slate-300 rounded-md text-sm focus:border-teal-700 focus:ring-1 focus:ring-teal-700" placeholder="Foto KTP kurang jelas..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button class="px-4 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded-md text-sm">Batal</button>
                        <button class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white font-medium rounded-md text-sm">Kirim Revisi</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- 06. One-Time Activation Code -->
        <section class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                <h2 class="text-xl font-display font-semibold text-slate-800 flex items-center gap-2">
                    <span class="text-slate-400 font-mono text-sm">06</span> Kode Aktivasi Satu Kali (OTP)
                </h2>
                <span class="text-xs text-slate-500">Untuk aktivasi akun warga (One-Time, Expiring)</span>
            </div>

            <div class="bg-white p-8 rounded-lg border border-slate-200 shadow-sm max-w-lg mx-auto text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-amber-100 text-amber-600 rounded-full mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h3 class="text-lg font-display font-bold text-slate-900 mb-2">Kode Aktivasi Akun Warga</h3>
                <p class="text-sm text-slate-600 mb-6">
                    Berikan kode ini kepada warga. <strong class="text-rose-600">Hanya ditampilkan sekali</strong> dan akan hangus dalam 24 jam.
                </p>

                <div class="bg-slate-50 border border-slate-200 rounded-lg p-6 mb-6">
                    <div class="font-mono text-3xl font-bold tracking-[0.2em] text-slate-900 mb-4 select-all">
                        RT4-9X62-BTB3
                    </div>
                    <button class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded-md text-sm transition-colors shadow-sm focus:outline-none mx-auto">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        Salin Kode
                    </button>
                </div>
                <p class="text-xs text-slate-500">Berlaku sampai: 13 Sep 2026, 14:30 WIB</p>
            </div>
        </section>

        <!-- 07. Tabel Data & Pagination -->
        <section class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                <h2 class="text-xl font-display font-semibold text-slate-800 flex items-center gap-2">
                    <span class="text-slate-400 font-mono text-sm">07</span> Tabel Data & Pagination
                </h2>
                <span class="text-xs text-slate-500">Tabel padat, maks 6 kolom, alignment spesifik</span>
            </div>

            <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                <!-- Toolbar -->
                <div class="p-4 border-b border-slate-200 bg-slate-50/50 flex items-center justify-between gap-4">
                    <div class="relative w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" placeholder="Cari nama atau NIK..." class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-md text-sm placeholder-slate-400 focus:outline-none focus:ring-1 focus:ring-teal-700 focus:border-teal-700">
                    </div>
                    <button class="px-4 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded-md text-sm shadow-sm inline-flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        Filter Status
                    </button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="bg-slate-50 text-slate-600 font-medium border-b border-slate-200">
                            <tr>
                                <th class="px-4 py-3">Nama Warga</th>
                                <th class="px-4 py-3">NIK</th>
                                <th class="px-4 py-3">No. Rumah</th>
                                <th class="px-4 py-3">Tanggal Lahir</th>
                                <th class="px-4 py-3 text-center">Status</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white text-slate-700">
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3 font-medium text-slate-900">Budi Santoso</td>
                                <td class="px-4 py-3 font-mono text-slate-500">•••• •••• •••• 0001</td>
                                <td class="px-4 py-3">Blok A-01</td>
                                <td class="px-4 py-3">12/05/1980</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[11px] font-semibold bg-green-50 text-green-800 border border-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Aktif
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <button class="text-teal-700 hover:text-teal-900 font-medium text-sm">Detail</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3 font-medium text-slate-900">Siti Aminah</td>
                                <td class="px-4 py-3 font-mono text-slate-500">•••• •••• •••• 0002</td>
                                <td class="px-4 py-3">Blok B-12</td>
                                <td class="px-4 py-3">23/11/1992</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[11px] font-semibold bg-green-50 text-green-800 border border-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span> Aktif
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <button class="text-teal-700 hover:text-teal-900 font-medium text-sm">Detail</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3 font-medium text-slate-900">Ahmad Fauzi</td>
                                <td class="px-4 py-3 font-mono text-slate-500">•••• •••• •••• 0003</td>
                                <td class="px-4 py-3 text-slate-400 italic">Tidak ada</td>
                                <td class="px-4 py-3">05/02/1975</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[11px] font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Pindah
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <button class="text-teal-700 hover:text-teal-900 font-medium text-sm">Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-4 py-3 border-t border-slate-200 bg-white flex items-center justify-between">
                    <div class="text-sm text-slate-500">
                        Menampilkan <span class="font-medium text-slate-900">1</span>–<span class="font-medium text-slate-900">20</span> dari <span class="font-medium text-slate-900">342</span> warga
                    </div>
                    <div class="flex items-center gap-2">
                        <select class="text-sm border-slate-300 rounded-md py-1.5 pl-3 pr-8 focus:ring-teal-700 focus:border-teal-700 mr-2">
                            <option>20</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                            <button class="relative inline-flex items-center rounded-l-md px-2 py-2 text-slate-400 ring-1 ring-inset ring-slate-300 hover:bg-slate-50 focus:z-20 focus:outline-offset-0 disabled:opacity-50" disabled>
                                <span class="sr-only">Previous</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" /></svg>
                            </button>
                            <button class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-inset ring-slate-300 hover:bg-slate-50 focus:z-20 focus:outline-offset-0 bg-slate-100">1</button>
                            <button class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-inset ring-slate-300 hover:bg-slate-50 focus:z-20 focus:outline-offset-0">2</button>
                            <button class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-inset ring-slate-300 hover:bg-slate-50 focus:z-20 focus:outline-offset-0">3</button>
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-slate-700 ring-1 ring-inset ring-slate-300 focus:outline-offset-0">...</span>
                            <button class="relative inline-flex items-center rounded-r-md px-2 py-2 text-slate-400 ring-1 ring-inset ring-slate-300 hover:bg-slate-50 focus:z-20 focus:outline-offset-0">
                                <span class="sr-only">Next</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" /></svg>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <!-- 08. Empty States & Loading -->
        <section class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                <h2 class="text-xl font-display font-semibold text-slate-800 flex items-center gap-2">
                    <span class="text-slate-400 font-mono text-sm">08</span> State Kosong & Loading
                </h2>
                <span class="text-xs text-slate-500">Skeleton, Tidak Ada Data, Pencarian Kosong</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Loading Skeleton -->
                <div class="bg-white p-6 rounded-lg border border-slate-200 shadow-sm animate-pulse">
                    <div class="h-4 bg-slate-200 rounded w-1/3 mb-6"></div>
                    <div class="space-y-4">
                        <div class="h-3 bg-slate-200 rounded w-full"></div>
                        <div class="h-3 bg-slate-200 rounded w-5/6"></div>
                        <div class="h-3 bg-slate-200 rounded w-4/6"></div>
                    </div>
                </div>

                <!-- Empty State -->
                <div class="bg-white p-8 rounded-lg border border-slate-200 shadow-sm flex flex-col items-center justify-center text-center">
                    <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 mb-1">Belum Ada Warga</h3>
                    <p class="text-sm text-slate-500 mb-4">Mulai dengan menambahkan data warga baru atau impor dari Excel.</p>
                    <button class="px-4 py-2 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium rounded-md text-sm">Tambah Warga</button>
                </div>
            </div>
        </section>

        <!-- 09. Alerts & Callouts -->
        <section class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                <h2 class="text-xl font-display font-semibold text-slate-800 flex items-center gap-2">
                    <span class="text-slate-400 font-mono text-sm">09</span> Alert & Callout
                </h2>
                <span class="text-xs text-slate-500">Pesan keberhasilan, peringatan, dan error.</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Success Alert -->
                <div class="rounded-md border-l-4 border-green-600 bg-green-50 p-4">
                    <div class="flex items-start">
                        <div class="shrink-0 text-green-600">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-green-800">Tersimpan Berhasil</h3>
                            <div class="mt-1 text-sm text-green-700">Data warga atas nama Budi Santoso berhasil diperbarui.</div>
                        </div>
                    </div>
                </div>

                <!-- Warning Alert -->
                <div class="rounded-md border-l-4 border-amber-500 bg-amber-50 p-4">
                    <div class="flex items-start">
                        <div class="shrink-0 text-amber-500">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-amber-800">Menunggu Verifikasi</h3>
                            <div class="mt-1 text-sm text-amber-700">Terdapat 3 pengajuan surat yang membutuhkan persetujuan Admin.</div>
                        </div>
                    </div>
                </div>

                <!-- Error Alert / No Permission -->
                <div class="rounded-md border-l-4 border-rose-600 bg-rose-50 p-4 md:col-span-2">
                    <div class="flex items-start">
                        <div class="shrink-0 text-rose-600">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-rose-800">Akses Ditolak</h3>
                            <div class="mt-1 text-sm text-rose-700">Anda tidak memiliki izin untuk melihat data warga dari RT lain. (Tenant Isolation)</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 10. Komponen Upload -->
        <section class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-2">
                <h2 class="text-xl font-display font-semibold text-slate-800 flex items-center gap-2">
                    <span class="text-slate-400 font-mono text-sm">10</span> Upload & File Preview
                </h2>
                <span class="text-xs text-slate-500">Idle, Progress, Success, Failed</span>
            </div>

            <div class="bg-white p-8 rounded-lg border border-slate-200 shadow-sm grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Dropzone Idle -->
                <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 flex flex-col items-center justify-center text-center hover:bg-slate-50 transition-colors cursor-pointer">
                    <svg class="w-8 h-8 text-slate-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    <p class="text-sm font-medium text-slate-700 mb-1">Klik untuk unggah Bukti Pembayaran</p>
                    <p class="text-xs text-slate-500">Atau seret dan lepas file di sini. JPG, PNG maks 2MB.</p>
                </div>

                <!-- Uploaded File -->
                <div class="border border-slate-200 rounded-lg p-4 bg-white flex items-center gap-4">
                    <div class="w-10 h-10 bg-slate-100 rounded flex items-center justify-center text-slate-500 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-900 truncate">bukti_transfer_iuran.jpg</p>
                        <p class="text-xs text-slate-500">1.2 MB</p>
                    </div>
                    <button class="text-slate-400 hover:text-rose-600 transition-colors p-1" title="Hapus File">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            </div>
        </section>

    </div>
</body>
</html>
