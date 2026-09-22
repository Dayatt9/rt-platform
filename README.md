# RT Platform

Platform administrasi dan layanan digital untuk RT.

RT Platform dirancang untuk membantu RT mengelola data warga, keluarga, rumah, layanan administrasi, iuran, pengumuman, kegiatan, dan pengaduan dalam satu sistem.

Platform menggunakan konsep **multi-tenant**, sehingga satu aplikasi dapat digunakan oleh banyak RT dengan data masing-masing tetap terisolasi.

---

## 1. Project Overview

Saat ini banyak kegiatan administrasi RT masih tersebar di berbagai tempat:

* Buku catatan
* Excel
* Word
* WhatsApp
* File komputer
* Aplikasi peta

RT Platform menghubungkan informasi tersebut dalam satu sistem.

Contoh hubungan data:

```text
Warga
  ↓
Keluarga / KK
  ↓
Rumah
  ↓
Lokasi Rumah
  ↓
Layanan RT
  ├── Surat
  ├── Pengaduan
  ├── Iuran
  ├── Pengumuman
  └── Kegiatan
```

Tujuannya bukan sekadar memindahkan Excel ke browser, tetapi membuat data dan proses administrasi RT saling terhubung.

---

## 2. Main Users

### Super Admin

Mengelola platform dan tenant RT.

### Admin RT

Digunakan oleh pengurus RT seperti:

* Ketua RT
* Sekretaris

Admin RT mengelola data dan layanan RT.

### Warga

Mengakses informasi dan layanan yang tersedia untuk warga.

### Public User

Tidak perlu login untuk mengakses informasi publik tertentu, seperti tautan lokasi rumah yang memang dibagikan.

Public user tidak boleh melihat data pribadi warga.

---

## 3. Main Features

MVP mencakup:

* Multi-tenant RT
* Authentication
* Authorization
* Data warga
* Data keluarga / KK
* Data rumah
* Peta lokasi rumah
* Tautan lokasi rumah
* Pengurusan surat
* Pengaduan warga
* Iuran RT
* Pengumuman
* Kegiatan warga
* Dashboard
* Aktivasi akun warga
* Audit log dasar
* Import data warga dari Excel/CSV

---

## 4. Multi-Tenant

Satu instalasi aplikasi dapat digunakan oleh banyak RT.

Contoh:

```text
RT 001
 ├── Warga
 ├── KK
 ├── Rumah
 ├── Surat
 └── Iuran

RT 002
 ├── Warga
 ├── KK
 ├── Rumah
 ├── Surat
 └── Iuran
```

Data RT 001 dan RT 002 harus tetap terisolasi.

User dari RT 001 tidak boleh mengakses data RT 002.

Tenant isolation merupakan salah satu requirement keamanan utama.

---

## 5. Technology Stack

### Backend

* Laravel
* PHP

### Frontend

* Blade
* Tailwind CSS

### Database

* PostgreSQL

### Map

* Leaflet

### Production

* Ubuntu Linux
* Nginx
* PostgreSQL
* HTTPS

### Development

* PHP
* Composer
* Node.js
* PostgreSQL
* Git

---

## 6. Project Structure

Struktur utama proyek:

```text
rt-platform/
│
├── AGENTS.md
├── README.md
│
├── docs/
│   ├── PRD.md
│   ├── USER-FLOWS.md
│   ├── DATABASE.md
│   ├── ARCHITECTURE.md
│   ├── SECURITY.md
│   └── DESIGN.md
│
├── app/
├── database/
├── resources/
├── routes/
├── tests/
└── ...
```

---

## 7. Documentation

Dokumentasi proyek:

| File              | Fungsi                         |
| ----------------- | ------------------------------ |
| `PRD.md`          | Requirement dan tujuan produk  |
| `USER-FLOWS.md`   | Alur pengguna                  |
| `DATABASE.md`     | Struktur dan relasi database   |
| `ARCHITECTURE.md` | Arsitektur teknis              |
| `SECURITY.md`     | Aturan keamanan                |
| `DESIGN.md`       | Aturan UI/UX                   |
| `AGENTS.md`       | Aturan untuk AI coding agent   |
| `README.md`       | Gambaran umum dan setup proyek |

Dokumentasi harus diperbarui ketika keputusan penting proyek berubah.

---

## 8. Core Data Relationship

Hubungan utama sistem:

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

Hubungan warga dan rumah:

```text
House
 ├── Household / KK
 │    ├── Resident
 │    ├── Resident
 │    └── ...
 │
 └── Household / KK
      ├── Resident
      └── ...
```

Satu rumah dapat memiliki lebih dari satu KK/household.

Satu KK dapat memiliki banyak warga.

---

## 9. Resident Accounts

Tidak semua warga harus memiliki akun.

Data warga dapat dibuat terlebih dahulu oleh Admin RT.

Jika warga membutuhkan akses aplikasi:

```text
Resident
    ↓
Admin verification
    ↓
One-time activation code
    ↓
Resident activation
    ↓
Create credentials
    ↓
Active account
```

Kode aktivasi harus:

* satu kali penggunaan
* memiliki masa berlaku
* dapat dicabut
* disimpan secara aman

---

## 10. Public House Location

Setiap rumah dapat memiliki lokasi pada peta.

Admin dapat membagikan tautan lokasi publik.

Contoh:

```text
rtku.id/l/8Xk29a
```

Halaman publik hanya menampilkan informasi yang memang diperbolehkan untuk publik.

Informasi seperti:

* NIK
* nomor KK
* nomor telepon
* detail keluarga

tidak boleh ditampilkan pada halaman publik.

Navigasi dapat diteruskan ke aplikasi peta eksternal.

---

## 11. Development Principles

Project dikembangkan dengan prinsip:

* Security first
* Tenant isolation
* Simple architecture
* Maintainable code
* Incremental development
* Clear user flows
* Minimal unnecessary dependencies
* Consistent UI
* Backend authorization

Frontend tidak dianggap sebagai lapisan keamanan.

Semua akses penting harus diverifikasi di backend.

---

## 12. Development Workflow

Workflow utama:

```text
Requirement
    ↓
User Flow
    ↓
Database / Architecture
    ↓
Design
    ↓
Implementation
    ↓
Testing
    ↓
Security Review
    ↓
Release
```

Untuk perubahan besar, dokumentasi terkait harus diperbarui.

---

## 13. AI-Assisted Development

Project dapat menggunakan AI coding agent untuk membantu implementasi.

AI agent harus membaca:

* `AGENTS.md`
* dokumentasi terkait
* kode yang sudah ada

sebelum melakukan perubahan signifikan.

AI agent tidak boleh:

* mengubah arsitektur tanpa alasan
* menghapus fitur tanpa izin
* melewati authorization
* mengubah tenant isolation
* mengekspos data warga
* mengarang requirement
* mengklaim testing yang belum dilakukan

AI digunakan sebagai development assistant, bukan sebagai pengambil keputusan produk.

---

## 14. Security

Security requirements utama dijelaskan di:

`docs/SECURITY.md`

Beberapa prinsip utama:

* Password harus di-hash.
* Tenant harus terisolasi.
* Authorization harus dilakukan di backend.
* Input harus divalidasi.
* File upload harus dianggap tidak tepercaya.
* Data sensitif tidak boleh ditampilkan secara publik.
* Production harus menggunakan HTTPS.
* Secret tidak boleh disimpan di repository.
* Perubahan penting harus dapat diaudit.

---

## 15. Testing

Feature dianggap belum selesai hanya karena halaman dapat dibuka.

Testing harus mencakup:

* normal workflow
* invalid input
* unauthorized access
* tenant isolation
* edge cases
* relevant automated tests

Contoh pengujian tenant isolation:

```text
Admin RT 001
    ↓
Request data RT 002
    ↓
ACCESS DENIED
```

---

## 16. Current Scope

Fokus awal:

```text
Foundation
    ↓
Authentication
    ↓
Multi-Tenancy
    ↓
Resident Management
    ↓
Household Management
    ↓
House Management
    ↓
House Map
    ↓
Administrative Services
    ↓
Complaints
    ↓
Dues
    ↓
Announcements
    ↓
Activities
    ↓
Audit & Security
```

Fitur berikut belum menjadi fokus MVP:

* Payment gateway
* WhatsApp automation
* Push notification
* Native mobile application
* AI features
* Government integration
* Advanced analytics
* Custom navigation system

---

## 17. Project Status

Current status:

**Planning and system design**

Completed documentation:

* [x] PRD
* [x] User Flows
* [x] Database Design
* [x] Architecture
* [x] Security
* [x] Design Guidelines
* [x] AI Agent Guidelines
* [x] Project README

Next major stage:

```text
Finalize Diagrams
      ↓
Review Documentation
      ↓
Design UI in Stitch / Figma
      ↓
Initialize Laravel Project
      ↓
Configure PostgreSQL
      ↓
Implement Authentication
      ↓
Implement Multi-Tenancy
      ↓
Begin MVP Features
```

---

## 18. Project Ownership

Product decisions, requirements, priorities, and final UI/UX decisions belong to the project owner.

Technical tools and AI assistants are used to support development.

Important architectural and security decisions should be documented rather than relying only on conversation history.

---

## 19. License

License: TBD

The project's licensing model has not yet been finalized.
