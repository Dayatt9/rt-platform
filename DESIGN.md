---
name: RT Platform Design System

colors:
  surface: '#F8FAFC'
  surface-dim: '#E2E8F0'
  surface-bright: '#FFFFFF'
  surface-container-lowest: '#FFFFFF'
  surface-container-low: '#F8FAFC'
  surface-container: '#F1F5F9'
  surface-container-high: '#E2E8F0'
  surface-container-highest: '#CBD5E1'
  on-surface: '#0F172A'
  on-surface-variant: '#475569'
  inverse-surface: '#1E293B'
  inverse-on-surface: '#F1F5F9'
  outline: '#64748B'
  outline-variant: '#CBD5E1'
  surface-tint: '#0F766E'
  primary: '#0F766E'
  on-primary: '#FFFFFF'
  primary-container: '#115E59'
  on-primary-container: '#FFFFFF'
  inverse-primary: '#5EEAD4'
  secondary: '#0F766E'
  on-secondary: '#FFFFFF'
  secondary-container: '#CCFBF1'
  on-secondary-container: '#115E59'
  tertiary: '#1D4ED8'
  on-tertiary: '#FFFFFF'
  tertiary-container: '#DBEAFE'
  on-tertiary-container: '#1E3A8A'
  error: '#BE123C'
  on-error: '#FFFFFF'
  error-container: '#FFE4E6'
  on-error-container: '#9F1239'
  primary-fixed: '#F0FDFA'
  primary-fixed-dim: '#99F6E4'
  on-primary-fixed: '#134E4A'
  on-primary-fixed-variant: '#115E59'
  secondary-fixed: '#CCFBF1'
  secondary-fixed-dim: '#99F6E4'
  on-secondary-fixed: '#134E4A'
  on-secondary-fixed-variant: '#115E59'
  tertiary-fixed: '#DBEAFE'
  tertiary-fixed-dim: '#BFDBFE'
  on-tertiary-fixed: '#1E3A8A'
  on-tertiary-fixed-variant: '#1D4ED8'
  background: '#F8FAFC'
  on-background: '#0F172A'
  surface-variant: '#E2E8F0'

typography:
  display-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px

  headline-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px

  headline-lg-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px

  headline-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 18px
    fontWeight: '600'
    lineHeight: 26px

  headline-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 16px
    fontWeight: '600'
    lineHeight: 24px

  body-lg:
    fontFamily: Inter
    fontSize: 15px
    fontWeight: '400'
    lineHeight: 24px

  body-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px

  body-sm:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '400'
    lineHeight: 18px

  label-md:
    fontFamily: Inter
    fontSize: 13px
    fontWeight: '500'
    lineHeight: 18px

  label-sm:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px

  tabular-data:
    fontFamily: JetBrains Mono
    fontSize: 13px
    fontWeight: '500'
    lineHeight: 18px

  tabular-sm:
    fontFamily: JetBrains Mono
    fontSize: 12px
    fontWeight: '400'
    lineHeight: 16px

rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px

spacing:
  gutter: 1rem
  gutter-desktop: 1.5rem
  margin: 1rem
  margin-desktop: 2rem
  space-xs: 0.25rem
  space-sm: 0.5rem
  space-md: 0.75rem
  space-lg: 1rem
  space-xl: 1.5rem
  space-2xl: 2rem
---

# RT Platform Design System

## 1. Brand & Style

RT Platform adalah aplikasi web administrasi RT multi-tenant. Satu platform digunakan oleh banyak RT, dan data setiap RT harus terisolasi.

Karakter visual:

**Corporate Utilitarian yang tenang**

Praktis, kredibel, profesional, mudah dipahami, dan tidak ramai.

Target pengguna:

- Pengurus RT, terutama Ketua dan Sekretaris, dari usia produktif hingga lansia.
- Warga yang membutuhkan kepastian status layanan, tagihan, dan surat.
- Super Admin platform yang mengelola tenant dan Admin RT.

### Prinsip desain

#### Tertib & presisi
Data tabular rapi, grid jelas, hierarki informasi konsisten, dan status mudah dikenali.

#### Apa yang harus dikerjakan sekarang?
Dashboard membantu pengguna menentukan tindakan berikutnya, bukan sekadar memamerkan angka.

#### Integritas data & privasi
Data kependudukan seperti NIK, No. KK, dan No. HP dimasking di server.

Server tidak mengirim nilai penuh ke browser kecuali pengguna meminta dan memiliki kewenangan.

Menyembunyikan nilai menggunakan CSS atau JavaScript bukan perlindungan keamanan.

#### Legibilitas fungsional
Kontras tinggi, hierarki tipografi tegas, label jelas, dan status semantik tidak menimbulkan keraguan.

#### Realistis untuk Blade + Tailwind
Komponen harus sederhana, reusable, dan realistis untuk Laravel Blade + Tailwind tanpa membutuhkan SPA.

### Yang dihindari

- Gradien dekoratif.
- Glassmorphism.
- Kartu berlebihan.
- Ilustrasi acak.
- Tampilan "dashboard AI generik".
- Foto dekoratif.
- Statistik yang tidak membantu tindakan pengguna.
- Animasi berlebihan.
- Komponen yang terlalu kompleks untuk kebutuhan administrasi RT.

---

# 2. Colors

Gunakan satu palet: **slate netral + teal sipil**.

Jangan menambah warna brand baru di luar token warna yang telah ditentukan.

## Dasar

- Canvas: `#F8FAFC`
- Panel/kartu: `#FFFFFF`
- Border: `#E2E8F0`
- Border input: `#CBD5E1`
- Teks utama: `#0F172A`
- Teks sekunder: `#475569`
- Placeholder/muted: `#64748B`

`#94A3B8` tidak digunakan sebagai warna teks karena kontrasnya tidak mencukupi untuk teks normal.

## Merek

- Primary: `#0F766E`
- Hover/pressed/nav aktif: `#115E59`
- Latar aksen: `#F0FDFA`

## Status

| Status | Titik | Teks | Latar | Tepi |
|---|---|---|---|---|
| Menunggu / Diajukan | `#D97706` | `#92400E` | `#FEF3C7` | `#FDE68A` |
| Diproses | `#2563EB` | `#1D4ED8` | `#EFF6FF` | `#BFDBFE` |
| Disetujui / Lunas / Selesai | `#16A34A` | `#166534` | `#DCFCE7` | `#BBF7D0` |
| Perlu Revisi | `#EA580C` | `#9A3412` | `#FFEDD5` | `#FED7AA` |
| Ditolak / Bahaya | `#E11D48` | `#9F1239` | `#FFE4E6` | `#FECDD3` |

Warna tidak boleh menjadi satu-satunya pembeda status.

Badge status selalu menggunakan:

- titik indikator;
- teks status;
- bentuk yang konsisten.

Kontras teks normal harus memenuhi minimal **4,5:1**.

---

# 3. Typography

### Judul

Gunakan **Plus Jakarta Sans** untuk:

- judul halaman;
- heading section;
- judul kartu;
- judul dialog;
- elemen heading lainnya.

### Isi dan kontrol

Gunakan **Inter** untuk:

- body text;
- form;
- label;
- tabel;
- helper text;
- tombol;
- navigasi.

Teks isi minimal 14px.

Ukuran 12px hanya digunakan untuk metadata atau informasi sekunder.

### Data tabular

Gunakan **JetBrains Mono** untuk:

- NIK;
- No. KK;
- kode aktivasi;
- nomor surat;
- nominal rupiah;
- kode blok;
- data yang membutuhkan alignment numerik.

Nominal uang rata kanan dan menggunakan `tabular-nums`.

---

# 4. Layout & Spacing

## Shell Admin RT

- Sidebar: `260px`.
- Sidebar: putih.
- Border kanan: `#E2E8F0`.
- Header: `64px`.
- Workspace: fluid.
- Maksimal workspace: `1600px`.

Di bawah `1024px`, sidebar berubah menjadi drawer.

Offset sidebar hanya berlaku pada breakpoint `lg` ke atas.

Tenant pada sidebar adalah label statis:

`RT 04 / RW 08 · Kel. Sukamaju`

Admin RT tidak memiliki tenant switcher.

Hanya Super Admin yang memiliki pemilih tenant.

### Menu Admin RT

**Overview**

- Dashboard

**Administrasi**

- Data Warga
- Data Keluarga
- Data Rumah & Peta

**Layanan**

- Surat
- Pengaduan

**Keuangan**

- Iuran

**Informasi**

- Pengumuman
- Kegiatan

**Sistem**

- Log Aktivitas
- Pengaturan RT

---

## Shell Warga

Shell Warga sepenuhnya terpisah dari Shell Admin.

Tidak menggunakan sidebar.

Struktur:

- Top bar
- Konten utama
- Bottom navigation

Bottom navigation memiliki 5 item:

1. Beranda
2. Surat
3. Iuran
4. Pengaduan
5. Lainnya

Konten maksimal `640px` dan berada di tengah pada desktop.

Target sentuh minimal `44px`.

Ukuran teks input minimal `16px`.

Shell Warga tidak boleh menampilkan:

- menu admin;
- tombol admin;
- pencarian admin;
- navigasi admin;
- fitur pengelolaan warga.

---

## Shell Publik

Digunakan untuk halaman tanpa login, seperti:

- lokasi rumah publik;
- halaman error publik.

Karakteristik:

- satu kolom;
- mobile-first;
- tanpa menu aplikasi;
- logo kecil;
- hanya menampilkan informasi yang memang bersifat publik.

---

## Shell Super Admin

Struktur mengikuti shell admin tetapi konteksnya adalah platform.

Menu:

- Dashboard
- Tenant
- Admin RT
- Log Audit

Super Admin memiliki tenant context selector.

Super Admin secara default **tidak melihat data warga tenant**.

---

# 5. Responsive Rules

Breakpoint:

- `sm`: 640px
- `md`: 768px
- `lg`: 1024px
- `xl`: 1280px

Aturan:

- `sm`: kartu tunggal, modal dapat berubah menjadi sheet.
- `md`: tabel mulai tampil.
- `lg`: sidebar Admin RT tetap.
- `xl`: drawer detail dapat berdampingan dengan tabel.
- Di bawah `768px`, tabel berubah menjadi daftar kartu.

Jarak antarbaris data:

`space-sm = 8px`

---

# 6. Elevation & Depth

Gunakan tonal layering dan border dengan kontras rendah.

Hindari bayangan tebal.

## Level 0

Canvas:

`#F8FAFC`

## Level 1

Kartu/tabel/form:

- background `#FFFFFF`;
- border `1px #E2E8F0`;
- shadow `0 1px 2px rgba(15,23,42,0.04)`.

## Level 2

Popover/dropdown:

- border `#CBD5E1`;
- shadow `0 4px 6px -1px rgba(15,23,42,0.07)`.

## Level 3

Modal/dialog/drawer:

- border `#94A3B8`;
- shadow `0 20px 25px -5px rgba(15,23,42,0.1)`;
- scrim `rgba(15,23,42,0.5)`.

`#94A3B8` diperbolehkan sebagai border/depth, tetapi tidak digunakan sebagai teks normal.

---

# 7. Shapes

- Tombol/input/checkbox: `6px`
- Kartu/panel/tabel: `8px`
- Badge: `4px` atau pill penuh
- Modal/alert: `8px`

---

# 8. Tables

Tabel maksimal memiliki **6 kolom terlihat**.

Informasi sekunder dipindahkan ke:

- detail drawer;
- halaman detail;
- atau kartu pada mobile.

Tidak boleh ada kolom yang sengaja dipotong/truncated sehingga informasi penting tidak terbaca.

## Tabel padat

Header:

- tinggi `38px`;
- background `#F8FAFC`;
- `label-sm`;
- border bawah `#CBD5E1`.

Baris:

- tinggi `44px`;
- border bawah `#E2E8F0`;
- hover `#F1F5F9`;
- selected `#F0FDFA`.

Alignment:

- teks: kiri;
- nominal: kanan;
- status: tengah.

Zebra hanya digunakan pada tabel keuangan jika memang meningkatkan keterbacaan.

---

# 9. Status Badges

Badge:

- tinggi `24px`;
- padding `0 8px`;
- titik `6px`;
- teks `label-sm`.

## Surat

| Database | UI |
|---|---|
| `draft` | Draf |
| `submitted` | Diajukan |
| `processing` | Diproses |
| `revision_required` | Perlu Revisi |
| `approved` | Disetujui |
| `rejected` | Ditolak |
| `completed` | Selesai |

## Iuran

| Database | UI |
|---|---|
| `unpaid` | Belum Dibayar |
| `pending_verification` | Menunggu Verifikasi |
| `paid` | Lunas |
| `cancelled` | Dibatalkan |

**Terlambat** bukan status tersimpan.

Terlambat adalah penanda turunan berdasarkan jatuh tempo.

## Pengumuman

- Draf
- Terbit
- Arsip

## Akun warga

- Belum punya akun
- Kode aktif
- Aktif
- Dinonaktifkan

## Pengaduan

Status sementara:

- Baru
- Diproses
- Selesai
- Ditolak

Status final harus mengikuti keputusan bisnis dan `DATABASE.md`.

## Status warga

Status final harus mengikuti `DATABASE.md`.

Jangan mengubah lifecycle database hanya karena label UI.

---

# 10. Sensitive Data Masking

Data sensitif:

- NIK;
- No. KK;
- No. HP.

## Format

NIK/KK:

`•••• •••• •••• 0001`

Nomor HP:

`0812-••••-3210`

Gunakan `tabular-data`.

Ikon salin dinonaktifkan sampai nilai penuh ditampilkan.

## State

### State 1: Termasking

Default pada:

- daftar;
- detail;
- form;
- ringkasan;
- dialog.

### State 2: Tampil sementara

Nilai penuh ditampilkan selama maksimal `30 detik`.

Tampilkan countdown.

Setelah waktu habis, otomatis kembali ke masked.

### State 3: Ditolak

Tampilkan:

`Anda tidak memiliki izin melihat data ini`

## Aturan server

Nilai penuh tidak boleh berada pada:

- HTML awal;
- `data-*`;
- response daftar;
- payload yang tidak diperlukan.

Klik ikon mata memanggil endpoint terpisah.

Server harus memeriksa:

- autentikasi;
- role;
- permission;
- tenant context;
- resource ownership/authorization.

Setiap business action reveal dicatat dalam audit log.

Frontend tidak boleh menjadi mekanisme keamanan.

---

# 11. Document Privacy

Dokumen:

- KTP;
- KK;
- bukti pembayaran;
- dokumen administrasi lainnya.

Tidak ditampilkan sebagai thumbnail otomatis.

Tombol **Lihat** menggunakan URL bertanda tangan dengan masa berlaku pendek.

Akses dokumen dicatat pada audit log.

Dokumen privat tidak boleh dapat diakses melalui URL publik biasa.

---

# 12. Input & Forms

Label selalu berada di atas input.

Jangan menggunakan floating label sebagai pola utama.

Required field ditandai `*`.

### Ukuran

Admin:

`38px`

Warga:

`44px`

Input:

- border `#CBD5E1`;
- focus `2px #0F766E`;
- focus offset `1px`.

Helper text:

`body-sm`

warna:

`#475569`

Error:

- pesan per field;
- ringkasan error di bagian atas form.

Input yang sudah diisi harus dipertahankan ketika validasi gagal.

### Field standar

- Nama Lengkap Sesuai KTP
- Nomor Induk Kependudukan (NIK)
- Nomor Kartu Keluarga (KK)
- Nomor Rumah / Unit
- Status Hubungan Dalam Keluarga (SHDK)

---

# 13. Filter & Tabs

Search harus memiliki label.

Filter harus memiliki label.

Filter bar dapat terdiri dari:

- search;
- dropdown;
- date filter;
- status filter;
- chip filter aktif;
- Reset.

Tab aktif:

- background putih;
- teks `#0F172A`;
- shadow mikro.

---

# 14. Timeline

Timeline menggunakan:

- garis vertikal `2px #E2E8F0`;
- node `10px`.

Setiap event menampilkan:

- tanggal;
- jam;
- actor;
- action;
- catatan bila diperlukan.

Tanggal dan waktu menggunakan font tabular.

---

# 15. Pagination

Format:

`Menampilkan 1–20 dari 342 warga`

Pilihan:

- 20;
- 50;
- 100.

Chevron dinonaktifkan pada batas halaman.

---

# 16. Confirmation Dialog

Tiga varian.

## Biasa

Menampilkan:

- ringkasan;
- Batal;
- tombol aksi.

## Destruktif

Digunakan untuk tindakan seperti:

- mencabut tautan publik;
- menghapus data;
- tindakan irreversible lainnya.

Untuk tindakan yang benar-benar tidak dapat dibalik, pengguna harus mengetik nama/label objek sebagai konfirmasi.

## Butuh alasan

Reason wajib untuk:

- menolak surat;
- meminta revisi surat;
- menolak bukti pembayaran;
- tindakan lain yang memerlukan penjelasan kepada warga.

Alasan ditampilkan kepada warga jika relevan.

---

# 17. File Upload

State:

1. Idle
2. Selected
3. Progress
4. Success
5. Failed
6. Delete/remove

Tampilkan:

- tipe file;
- ukuran file;
- batas ukuran;
- error jaringan;
- error validasi.

Tidak ada preview otomatis untuk dokumen identitas.

File upload selalu dianggap sebagai input tidak tepercaya.

---

# 18. One-Time Activation Code

Panel kode aktivasi:

- menggunakan `tabular-data`;
- kode ditampilkan besar;
- tombol Salin;
- masa berlaku;
- peringatan:

`Hanya ditampilkan sekali`

Setelah panel ditutup, nilai kode tidak boleh ditampilkan kembali.

Kode harus:

- single-use;
- memiliki expiry;
- dapat direvoke;
- dibatasi percobaannya;
- tidak disimpan dalam bentuk plaintext yang dapat dibaca ulang.

Nilai kode tidak boleh dimasukkan ke audit log.

---

# 19. Global Data States

Setiap layar data wajib memiliki:

### Loading

Skeleton yang merepresentasikan struktur konten.

### Empty: belum ada data

Digunakan ketika dataset memang belum memiliki record.

### Empty: hasil pencarian kosong

Digunakan ketika pencarian/filter tidak menemukan hasil.

### Empty: tidak ada tugas

Digunakan ketika tidak ada pekerjaan yang membutuhkan tindakan pengguna.

### Error

Pesan ramah tanpa:

- stack trace;
- SQL;
- filesystem path;
- internal ID;
- detail teknis sensitif.

### No Permission

Dua bentuk:

- full-page;
- inline.

---

# 20. Success Feedback

Satu tindakan hanya memiliki satu feedback utama.

Gunakan:

- toast;

**atau**

- success screen/state.

Jangan menampilkan toast dan success modal untuk tindakan yang sama.

---

# 21. Full-Page Stepper

Form panjang menggunakan full-page stepper.

Jangan menggunakan modal besar sebagai pengganti halaman untuk proses kompleks.

Ketika pengguna keluar sebelum selesai, tampilkan dialog:

`Perubahan belum disimpan`

Data yang sudah diisi harus dipertahankan ketika terjadi validation error.

---

# 22. Avatar

Avatar warga menggunakan lingkaran dengan inisial.

Tidak menggunakan foto warga.

---

# 23. Public House Location

Halaman lokasi rumah publik hanya boleh menampilkan informasi yang memang ditetapkan sebagai publik.

Informasi yang boleh:

- label rumah;
- alamat jalan;
- RT/RW;
- kelurahan;
- peta;
- pin lokasi;
- tombol navigasi.

Tidak boleh menampilkan:

- nama kepala keluarga;
- nama penghuni;
- NIK;
- KK;
- HP;
- daftar anggota keluarga;
- dokumen;
- informasi pembayaran;
- data internal RT.

Public location menggunakan token acak yang panjang.

Token diperlakukan sebagai credential publik dan tidak boleh menggunakan ID rumah berurutan.

Regenerate token harus menginvalidasi token lama.

---

# 24. Content Restrictions

Jangan menampilkan atau mengklaim integrasi yang tidak tersedia:

- Dukcapil;
- WhatsApp;
- QRIS;
- payment gateway;
- Google Calendar;
- panic button;
- "Tersinkronisasi Cloud".

Status verifikasi hanya menggunakan:

`Diverifikasi admin`

## Data yang tidak diperlukan

Jangan menampilkan:

- golongan darah;
- BPJS;
- status vaksin;
- hak suara pemilu;
- DTKS/status kemiskinan;
- catatan perilaku sosial;
- kontak darurat pribadi;
- statistik demografi;
- foto warga.

Jangan menggunakan label yang menstigma seseorang pada nama, misalnya:

`(Janda)`

---

# 25. Authentication & Information Disclosure

Pesan error untuk:

- login;
- aktivasi;
- public location link.

harus generik dan tidak membedakan penyebab internal secara berlebihan.

Tujuannya mencegah:

- account enumeration;
- activation-code enumeration;
- public-token enumeration.

Contoh prinsip:

Jangan:

`Kode aktivasi ditemukan tetapi sudah expired.`

Gunakan pesan generik yang tidak membocorkan status internal kode.

---

# 26. Tenant Isolation UI Rules

Tenant context Admin RT harus berasal dari session/context yang telah diautorisasi server.

UI tidak boleh menyediakan tenant switcher kepada Admin RT.

Frontend tidak boleh dipercaya untuk menentukan tenant.

Jangan menganggap perubahan parameter seperti:

`tenant_id=2`

sebagai bukti bahwa pengguna boleh mengakses tenant tersebut.

Authorization dan tenant isolation wajib ditegakkan backend.

---

# 27. Duplicate NIK

Pengecekan duplikat NIK hanya dilakukan dalam tenant/RT yang sedang dikelola.

Sistem tidak boleh mengungkap apakah NIK yang sama ada di tenant lain.

Contoh pesan tidak boleh berbentuk:

> NIK sudah terdaftar di RT lain.

Gunakan pesan yang tidak membocorkan keberadaan data lintas tenant.

---

# 28. Accessibility

Semua:

- input;
- search;
- filter;
- tombol ikon;
- kontrol interaktif.

harus memiliki accessible name/label yang jelas.

Ikon tanpa teks harus memiliki nama aksesibel.

Fokus keyboard harus terlihat jelas.

Target sentuh Shell Warga minimal `44px`.

Kontras teks normal minimal `4,5:1`.

Status tidak boleh hanya dibedakan berdasarkan warna.

Gunakan kombinasi:

- warna;
- titik/status icon;
- teks.

---

# 29. Date, Time & Currency

Tanggal:

`DD/MM/YYYY`

Contoh:

`12/09/2026`

Jam:

format 24 jam WIB.

Contoh:

`14:30 WIB`

Nominal:

`Rp 125.000`

Tidak menggunakan desimal untuk nominal rupiah bulat.

Contoh nomor surat:

`048/SP-RT04/IX/2026`

---

# 30. Language

Gunakan Bahasa Indonesia yang jelas, natural, dan konsisten untuk pengguna administrasi RT.

Satu konsep menggunakan satu istilah.

Contoh:

Gunakan selalu:

`Perlu Revisi`

Jangan bergantian dengan:

- Perlu Perbaikan
- Dikembalikan
- Revisi Diperlukan
- Perlu Koreksi

kecuali memang memiliki makna bisnis yang berbeda.

---

# 31. Design Implementation Rules

Implementasi production menggunakan:

- Laravel Blade;
- Tailwind CSS;
- Vite.

Tailwind CDN hanya diperbolehkan untuk prototype, bukan production.

Gunakan local/self-hosted font assets bila font tersebut menjadi bagian dari design system.

Jangan menggunakan image URL eksternal untuk logo.

Logo RT Platform menggunakan SVG lokal.

Icon menggunakan inline SVG atau library icon yang kompatibel dengan Blade.

Shared layout:

- `layouts/app.blade.php` untuk Admin RT;
- `layouts/resident.blade.php` untuk Warga;
- `layouts/public.blade.php` untuk halaman publik.

Komponen reusable harus digunakan untuk:

- badge;
- button;
- input;
- table;
- dialog;
- drawer;
- pagination;
- masking field;
- file upload;
- timeline;
- empty state;
- error state;
- permission state.

---

# 32. Source of Truth

Urutan sumber kebenaran proyek:

1. Instruksi eksplisit pemilik proyek
2. `SECURITY.md`
3. `DATABASE.md`
4. `ARCHITECTURE.md`
5. `USER-FLOWS.md`
6. `PRD.md`
7. `DESIGN.md`
8. Implementasi existing
9. Asumsi AI

Jika terdapat konflik:

- jangan menebak;
- jangan mengubah requirement secara diam-diam;
- dokumentasikan konflik;
- gunakan source of truth dengan prioritas lebih tinggi;
- jika keputusan memang belum ada, tandai sebagai TBD.

`DESIGN.md` mengatur **visual, UX, accessibility, dan aturan presentasi data**.

`SECURITY.md` tetap menjadi sumber otoritatif untuk **authorization, tenant isolation, data protection, file security, audit, dan security controls**.

`DATABASE.md` menjadi sumber otoritatif untuk **field, enum, relationship, lifecycle, dan struktur data**.

---

# 33. Unresolved Business Decisions

Hal berikut tidak boleh ditebak oleh designer, Stitch, maupun coding agent sebelum keputusan bisnis final dibuat:

1. Status warga final.
2. Target iuran: warga, KK, atau rumah.
3. Channel reset password.
4. Status final pengaduan.
5. Definisi bisnis rumah `Berpenghuni` dan `Kosong`.
6. Aturan edit/delete pengaduan setelah dikirim.
7. Kebijakan archive vs delete data warga.

Jika belum diputuskan, UI harus menggunakan desain netral dan tidak mengunci implementasi pada asumsi tertentu.

---

# 34. Design Acceptance Checklist

Setiap screen harus memenuhi:

- [ ] Menggunakan palette resmi.
- [ ] Tidak menambahkan warna brand baru.
- [ ] NIK/KK/HP masked secara default.
- [ ] Nilai penuh tidak dikirim dalam response yang tidak diperlukan.
- [ ] Tidak ada foto warga.
- [ ] Tidak ada gradient dekoratif.
- [ ] Tidak ada glassmorphism.
- [ ] Tidak ada integrasi fiktif.
- [ ] Tidak ada data sensitif yang tidak diperlukan.
- [ ] Shell sesuai role.
- [ ] Tenant label Admin RT statis.
- [ ] Super Admin memiliki tenant context selector.
- [ ] Tabel maksimal 6 kolom.
- [ ] Mobile table berubah menjadi cards.
- [ ] Input memiliki label.
- [ ] Search/filter memiliki label.
- [ ] Focus state terlihat.
- [ ] Touch target warga minimal 44px.
- [ ] Status menggunakan dot + text.
- [ ] Status tidak hanya dibedakan berdasarkan warna.
- [ ] Format tanggal `DD/MM/YYYY`.
- [ ] Format waktu 24 jam WIB.
- [ ] Format uang `Rp 125.000`.
- [ ] Loading state tersedia.
- [ ] Empty state tersedia.
- [ ] Error state tersedia.
- [ ] Permission denied tersedia.
- [ ] Validation mempertahankan input.
- [ ] Destructive action membutuhkan confirmation.
- [ ] Action yang membutuhkan alasan menggunakan mandatory reason.
- [ ] Tidak ada toast + success modal untuk tindakan yang sama.
- [ ] Dokumen sensitif tidak menggunakan public URL.
- [ ] Public house page tidak membocorkan data penghuni.
- [ ] Tidak ada informasi lintas tenant.
- [ ] Copy data sensitif disabled sebelum reveal.
- [ ] Reveal sensitif bersifat sementara dan tercatat di audit.
- [ ] Tidak ada stack trace/SQL/path internal di UI.
- [ ] Accessible name tersedia untuk icon-only control.
- [ ] Tidak ada requirement baru yang muncul hanya karena kebutuhan visual.