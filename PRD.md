# Product Requirements Document

## RT Digital Platform

# 1. Product Overview

RT Digital Platform adalah platform administrasi dan layanan digital untuk RT yang mengintegrasikan data warga, KK, rumah, lokasi rumah, administrasi surat, pengaduan, iuran, pengumuman, dan kegiatan dalam satu sistem.

Platform dirancang sebagai **multi-tenant platform**, sehingga banyak RT dapat menggunakan satu sistem dengan data yang terisolasi antar-RT.

Tujuan utama platform bukan menggantikan seluruh proses administrasi RT secara paksa, tetapi mengurangi ketergantungan pada buku, Excel, Word, WhatsApp, dan aplikasi peta yang berdiri sendiri.

---

# 2. Problem

Administrasi RT dapat menggunakan banyak alat berbeda:

* Buku catatan
* Excel
* Word
* WhatsApp
* File pada komputer pribadi
* Aplikasi peta

Masalah muncul ketika informasi tersebar di banyak tempat.

Contoh:

* Data warga berada di Excel.
* Pengumuman berada di WhatsApp.
* Surat dibuat menggunakan Word.
* Pengaduan disampaikan melalui chat.
* Lokasi rumah dicari melalui aplikasi peta.
* Riwayat perubahan data sulit ditelusuri.

Platform menyatukan proses tersebut dalam satu sistem terstruktur.

---

# 3. Product Goal

Platform harus membantu RT:

1. Mengelola data warga secara terstruktur.
2. Menghubungkan warga dengan KK dan rumah.
3. Menyimpan lokasi rumah pada peta.
4. Mengelola layanan administrasi RT.
5. Mengelola pengaduan warga.
6. Mengelola iuran.
7. Menyampaikan pengumuman dan kegiatan.
8. Menyediakan dashboard untuk aktivitas yang membutuhkan perhatian.
9. Menyediakan audit trail untuk aktivitas penting.
10. Memisahkan data antar-RT secara aman.

---

# 4. Product Principles

Platform mengikuti prinsip:

* Sederhana untuk pengguna non-teknis.
* Data terpusat.
* Setiap data memiliki konteks yang jelas.
* Privasi warga menjadi prioritas.
* Fitur publik hanya menampilkan informasi yang memang ditujukan untuk publik.
* Administrasi harus dapat ditelusuri.
* Multi-tenant isolation wajib.
* Sistem tidak boleh bergantung pada satu perangkat atau satu orang.
* Fitur dibuat berdasarkan kebutuhan nyata RT, bukan sekadar menambah banyak menu.

---

# 5. Target Users

## 5.1 Super Admin Platform

Bertanggung jawab terhadap platform secara keseluruhan.

Fungsi:

* Membuat tenant RT.
* Mengelola tenant.
* Membuat dan mengelola Admin RT.
* Memantau status tenant.
* Mengelola konfigurasi platform.

---

## 5.2 Admin RT

Digunakan oleh Ketua RT dan Sekretaris.

Role aplikasi:

```text
admin_rt
```

Position:

```text
ketua_rt
sekretaris
```

Fungsi:

* Mengelola data warga.
* Mengelola KK.
* Mengelola rumah.
* Mengelola lokasi rumah.
* Memproses surat.
* Mengelola pengaduan.
* Mengelola iuran.
* Membuat pengumuman.
* Mengelola kegiatan.
* Melihat dashboard.
* Melihat aktivitas penting.
* Mengelola akun warga.

---

## 5.3 Warga

Fungsi:

* Melihat pengumuman.
* Melihat kegiatan.
* Mengajukan surat.
* Mengirim pengaduan.
* Melihat iuran.
* Mengelola profil yang diperbolehkan.
* Mengakses informasi rumah yang relevan.

Tidak semua warga wajib memiliki akun.

---

## 5.4 Public / Guest

Pengguna tanpa login.

Fungsi terbatas:

* Membuka public house location link.
* Melihat informasi rumah yang memang ditetapkan sebagai publik.
* Membuka navigasi menggunakan aplikasi peta eksternal.

Tidak boleh melihat:

* NIK.
* Nomor KK.
* Nomor telepon.
* Data anggota keluarga.
* Informasi administratif pribadi.

---

# 6. Core Data Model

Hubungan utama:

```text
Tenant
 ├── Users
 ├── Residents
 ├── Households
 ├── Houses
 ├── Letters
 ├── Complaints
 ├── Dues
 ├── Announcements
 ├── Activities
 └── Audit Logs
```

Hubungan warga:

```text
House
 ├── Household
 │    ├── Resident
 │    ├── Resident
 │    └── Resident
 │
 └── Household
      └── Resident
```

Satu rumah dapat memiliki beberapa KK/household.

Satu KK dapat memiliki banyak warga.

Resident dan User Account adalah entitas berbeda.

---

# 7. MVP Features

## 7.1 Multi-Tenancy

Sistem harus dapat melayani banyak RT dalam satu platform.

Setiap tenant memiliki data terisolasi.

Admin RT hanya dapat mengakses data tenant miliknya.

---

## 7.2 Authentication & Authorization

Sistem menyediakan:

* Login.
* Logout.
* Password management.
* Role-based access control.
* Tenant-based authorization.
* Account activation untuk warga.

Role:

```text
super_admin
admin_rt
resident
```

---

## 7.3 Resident Management

Admin RT dapat:

* Melihat warga.
* Menambah warga.
* Mengubah data warga.
* Mengubah status warga.
* Melihat detail warga sesuai permission.
* Mengimpor data warga dari Excel/CSV.

Status warga:

```text
active
moved_out
deceased
inactive
```

Resident tidak otomatis memiliki account.

---

## 7.4 Household / KK Management

Admin RT dapat:

* Membuat KK.
* Mengubah KK.
* Menghubungkan warga dengan KK.
* Menentukan kepala keluarga.
* Mengelola anggota KK.

Satu rumah dapat memiliki beberapa KK.

---

## 7.5 House Management

Admin RT dapat:

* Menambah rumah.
* Mengubah rumah.
* Menentukan nomor rumah.
* Menentukan alamat.
* Menentukan koordinat.
* Melihat rumah pada peta.
* Mengaktifkan/nonaktifkan public visibility.

Satu rumah memiliki satu marker lokasi.

---

## 7.6 Public House Location

Sistem dapat menghasilkan link publik untuk rumah.

Contoh:

```text
rtku.id/l/8Xk29a
```

Link dapat dibuka tanpa login.

Informasi publik dibatasi sesuai konfigurasi.

Pengguna dapat melanjutkan navigasi menggunakan aplikasi peta eksternal.

---

## 7.7 Resident Account Activation

Admin dapat membuat activation code untuk resident yang telah diverifikasi.

Flow:

```text
Admin memilih resident
        ↓
Generate activation code
        ↓
Code diberikan kepada resident
        ↓
Resident membuka halaman aktivasi
        ↓
Memasukkan code
        ↓
Verifikasi
        ↓
Membuat credential
        ↓
Account aktif
```

Activation code:

* One-time.
* Memiliki expiration.
* Dapat direvoke.
* Tidak disimpan sebagai plaintext.

---

## 7.8 Letter Management

Jenis surat harus dapat dikonfigurasi.

Contoh:

* Surat Pengantar.
* Surat Keterangan Domisili.
* Surat Keterangan Usaha.
* Surat Keterangan Tidak Mampu.
* Surat Pengantar Nikah.

Warga dapat:

* Memilih jenis surat.
* Mengisi formulir.
* Mengunggah dokumen jika diperlukan.
* Mengirim pengajuan.
* Melihat status.

Admin dapat:

* Melihat pengajuan.
* Memproses pengajuan.
* Meminta revisi.
* Menyetujui.
* Menolak.
* Menyelesaikan pengajuan.

Status:

```text
draft
submitted
processing
revision_required
approved
rejected
completed
```

---

## 7.9 Complaint / Report Management

Warga dapat mengirim pengaduan/laporan.

Admin dapat:

* Melihat laporan.
* Memproses laporan.
* Mengubah status.
* Menyelesaikan laporan.

Status:

```text
submitted
processing
resolved
rejected
closed
```

---

## 7.10 Dues Management

Admin dapat membuat iuran.

Contoh:

* Kebersihan.
* Keamanan.
* Kegiatan.
* Iuran khusus.

Warga dapat:

* Melihat kewajiban iuran.
* Melaporkan pembayaran.
* Mengunggah bukti pembayaran jika diperlukan.

Admin dapat:

* Memverifikasi pembayaran.
* Menolak pembayaran.
* Melihat status iuran.

Payment gateway tidak termasuk MVP.

---

## 7.11 Announcements

Admin dapat membuat pengumuman.

Warga dapat melihat pengumuman yang dipublikasikan.

Pengumuman dapat memiliki:

* Judul.
* Isi.
* Waktu publikasi.
* Waktu berakhir.
* Status.

---

## 7.12 Activities

Admin dapat membuat kegiatan RT.

Informasi kegiatan:

* Judul.
* Deskripsi.
* Lokasi.
* Waktu mulai.
* Waktu selesai.
* Status.

---

## 7.13 Dashboard

Dashboard Admin RT menampilkan informasi yang membutuhkan perhatian.

Contoh:

* Total warga.
* Total rumah.
* Total KK.
* Pengajuan surat pending.
* Pengaduan pending.
* Iuran.
* Data yang perlu diperbarui.
* Aktivitas terbaru.

Dashboard warga dapat menampilkan:

* Pengumuman.
* Kegiatan.
* Status surat.
* Iuran.
* Pengaduan.

---

## 7.14 Audit Log

Sistem mencatat aktivitas penting.

Contoh:

* Login.
* Failed login.
* Perubahan data warga.
* Pengajuan surat.
* Approval.
* Rejection.
* Aktivasi akun.
* Perubahan data administratif penting.

Audit log tidak dimaksudkan untuk mencatat setiap klik pengguna.

---

## 7.15 Import Data

Import resident mendukung:

```text
Excel
CSV
```

Flow:

```text
Upload
↓
Preview
↓
Validation
↓
Duplicate Detection
↓
Error Report
↓
Confirmation
↓
Import
```

Data tidak boleh langsung masuk production tanpa proses validasi.

---

# 8. Resident Lifecycle

Resident tidak langsung dihapus ketika:

* pindah
* meninggal
* tidak aktif

Status digunakan untuk mempertahankan informasi administratif yang diperlukan.

Permanent deletion bukan mekanisme normal.

Detail histori alamat tidak termasuk MVP.

---

# 9. Account Lifecycle

Resident dan account memiliki lifecycle terpisah.

Contoh:

```text
Resident ada
↓
Belum memiliki account
↓
Admin membuat activation code
↓
Resident aktivasi
↓
Account active
```

Account dapat:

```text
active
disabled
```

Resident dapat tetap ada walaupun account dinonaktifkan.

---

# 10. Non-Functional Requirements

## Security

* Tenant isolation.
* Backend authorization.
* Password hashing.
* HTTPS pada production.
* Input validation.
* File upload validation.
* Audit logging.
* Public/private data separation.
* Backup database.

## Performance

Sistem harus tetap responsif untuk penggunaan normal RT dan dapat dikembangkan untuk banyak tenant.

## Maintainability

Kode harus terstruktur dan mengikuti konvensi Laravel.

## Usability

Interface harus dapat digunakan oleh pengguna non-teknis.

## Reliability

Data administrasi penting harus memiliki mekanisme backup dan recovery.

---

# 11. UI/UX Direction

Produk harus terasa:

* Praktis.
* Tenang.
* Terpercaya.
* Jelas.
* Familiar bagi pengguna Indonesia.
* Tidak terlalu teknis.
* Tidak terasa seperti dashboard startup.

Hindari:

* Excessive gradients.
* Glassmorphism.
* Neon colors.
* Excessive shadows.
* Terlalu banyak rounded cards.
* Terlalu banyak pill buttons.
* Decorative charts.
* Ilustrasi yang tidak memiliki fungsi.
* Generic AI-generated dashboard aesthetic.

---

# 12. Technology Direction

MVP:

```text
Backend      : Laravel
Frontend     : Blade
CSS          : Tailwind CSS
Database     : PostgreSQL
Map          : Leaflet
Web Server   : Nginx
OS Production: Ubuntu Linux
Version Ctrl : Git + GitHub
```

Development dapat menggunakan:

```text
PHP
Composer
Node.js
PostgreSQL
WSL2 Ubuntu
```

Docker tidak wajib untuk tahap awal.

---

# 13. Explicitly Out of MVP

Fitur berikut tidak termasuk MVP:

* Payment gateway.
* WhatsApp automation.
* Push notification.
* Native mobile application.
* AI assistant.
* Government integration.
* Advanced analytics.
* Custom navigation system.
* Complex address history.
* Advanced notification infrastructure.

Fitur tersebut dapat dipertimbangkan pada fase berikutnya.

---

# 14. Future Roadmap

Kemungkinan pengembangan:

* WhatsApp notification.
* Push notification.
* Payment gateway.
* Mobile application.
* Advanced reporting.
* Government integration.
* AI-assisted administration.
* Advanced analytics.
* More flexible notification system.

---

# 15. Success Criteria

MVP dianggap berhasil jika:

1. Satu platform dapat digunakan oleh beberapa RT.
2. Data antar-RT tidak dapat saling diakses.
3. Admin dapat mengelola warga, KK, dan rumah.
4. Rumah dapat ditampilkan pada peta.
5. Warga dapat mengajukan layanan administrasi.
6. Admin dapat memproses layanan tersebut.
7. Warga dapat mengirim pengaduan.
8. Admin dapat mengelola iuran.
9. Admin dapat menyampaikan pengumuman dan kegiatan.
10. Aktivitas penting dapat ditelusuri melalui audit log.
11. Data warga dapat diimpor secara aman.
12. Resident dapat mengaktifkan account menggunakan activation code.

---

# 16. Open Decisions

Keputusan berikut harus diselesaikan sebelum implementasi final:

* Exact resident fields.
* Exact household fields.
* Exact house fields.
* Dues target: resident, household, atau house.
* Payment proof requirements.
* Final letter types.
* Letter templates.
* Automatic PDF generation.
* Ketua RT vs Sekretaris permissions.
* Resident data retention.
* Public house information.
* Notification mechanism.
* Moving within the same RT.
* New household creation.
* Household changes.
* Duplicate handling during import.
* Map provider.
* Primary key strategy.
* File storage strategy.
* Production hosting.

---

# 17. Document Status

Version: 1.0

Status: Draft

PRD adalah sumber utama untuk product requirements. Perubahan besar terhadap scope harus diperbarui di dokumen ini.