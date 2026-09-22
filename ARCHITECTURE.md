# Architecture

## RT Digital Platform

# 1. Purpose

Dokumen ini mendefinisikan struktur teknis platform RT Digital Platform.

Architecture harus mendukung:

* Multi-tenancy.
* Role-based access control.
* Data isolation.
* Maintainability.
* Security.
* Scalability yang wajar untuk SaaS skala kecil hingga menengah.
* Pengembangan bertahap.

---

# 2. Technology Stack

## Backend

* Laravel
* PHP
* Composer

## Frontend

* Laravel Blade
* Tailwind CSS
* JavaScript seperlunya

## Database

* PostgreSQL

## Map

* Leaflet
* Map tile/provider yang dipilih kemudian

## Web Server

* Nginx

## Production OS

* Ubuntu Linux

## Version Control

* Git
* GitHub

---

# 3. High-Level Architecture

```text
Browser
   │
   ▼
Nginx
   │
   ▼
Laravel Application
   │
   ├── Authentication
   ├── Authorization
   ├── Tenant Context
   ├── Controllers
   ├── Form Requests / Validation
   ├── Services / Business Logic
   ├── Policies
   ├── Models
   └── Jobs
          │
          ▼
      PostgreSQL
```

External services:

```text
Laravel
 ├── Map Provider
 ├── File Storage
 └── Notification Provider (future)
```

---

# 4. Application Structure

Laravel application harus mengikuti separation of concerns.

Konseptual:

```text
Request
  ↓
Route
  ↓
Middleware
  ↓
Controller
  ↓
Validation
  ↓
Authorization
  ↓
Service / Business Logic
  ↓
Model / Repository where necessary
  ↓
Database
```

Controller tidak boleh menjadi tempat seluruh business logic.

---

# 5. Multi-Tenant Architecture

Setiap RT merupakan tenant.

Contoh:

```text
Tenant A
 ├── Residents
 ├── Houses
 ├── Households
 └── Letters

Tenant B
 ├── Residents
 ├── Houses
 ├── Households
 └── Letters
```

Tenant context berasal dari authenticated user atau platform-level context.

Untuk request dari Admin RT atau Resident:

```text
Authenticated User
       ↓
User Tenant
       ↓
Tenant Context
       ↓
Authorized Data Query
```

---

# 6. Tenant Isolation Strategy

MVP menggunakan shared database dengan shared schema.

Contoh:

```text
residents
---------
id
tenant_id
name
...
```

```text
houses
---------
id
tenant_id
...
```

Setiap query data tenant harus mempertimbangkan `tenant_id`.

Tenant isolation harus diterapkan pada backend.

Frontend tidak boleh menjadi mekanisme utama isolasi.

---

# 7. Authentication

Authentication menggunakan Laravel authentication mechanism.

Flow:

```text
Login
 ↓
Credential Validation
 ↓
Session
 ↓
Authenticated User
 ↓
Role / Tenant Resolution
```

Password harus disimpan menggunakan password hashing yang aman.

Password plaintext tidak boleh disimpan.

---

# 8. Authorization

Authorization menggunakan role dan policy.

Role:

```text
super_admin
admin_rt
resident
```

Authorization harus mempertimbangkan:

1. Authentication.
2. Role.
3. Tenant.
4. Resource ownership.
5. Action permission.

Contoh:

```text
Resident A
 ↓
Request Letter A
 ↓
Allowed
```

Tetapi:

```text
Resident A
 ↓
Request Letter B
 ↓
Denied
```

Jika Letter B milik resident lain.

---

# 9. Role Architecture

## Super Admin

Platform-level access.

Tidak terikat pada satu tenant secara normal.

## Admin RT

Tenant-level access.

Hanya dapat mengelola tenant sendiri.

## Resident

Tenant-level access dengan resource restrictions.

Resident hanya dapat mengakses data yang memang berkaitan dengan account-nya.

---

# 10. Route Structure

Route harus dikelompokkan berdasarkan authentication dan role.

Konseptual:

```text
/auth
/admin
/resident
/public
```

Contoh:

```text
/login

/admin/dashboard
/admin/residents
/admin/households
/admin/houses
/admin/letters
/admin/complaints
/admin/dues
/admin/announcements
/admin/activities

/resident/dashboard
/resident/letters
/resident/complaints
/resident/dues

/public/house/{public_token}
```

Route structure dapat berubah selama implementasi jika terdapat alasan arsitektural yang jelas.

---

# 11. Service Layer

Business logic kompleks sebaiknya dipisahkan dari Controller.

Contoh:

```text
ResidentService
HouseholdService
HouseService
LetterService
ComplaintService
DuesService
ActivationService
ImportService
```

Tidak semua operasi harus dipaksa menggunakan service jika logic sangat sederhana.

Tujuannya adalah maintainability, bukan membuat 47 class untuk menyimpan satu `if`.

---

# 12. Validation

Input divalidasi sebelum business logic dijalankan.

Contoh:

```text
HTTP Request
 ↓
Form Request / Validation
 ↓
Validated Data
 ↓
Authorization
 ↓
Business Logic
```

Validation harus mencakup:

* Required fields.
* Data types.
* Length.
* Format.
* File types.
* Numeric ranges.
* Business rules.

---

# 13. Database Access

Laravel Eloquent digunakan untuk operasi database.

Query harus:

* Tenant-aware.
* Menghindari N+1 query jika relevan.
* Menggunakan transaction untuk operasi multi-step.
* Menggunakan parameter binding / ORM.
* Tidak membuat raw SQL tanpa alasan.

---

# 14. Transactions

Database transaction digunakan untuk operasi yang harus berhasil atau gagal secara keseluruhan.

Contoh:

```text
Create Household
 ↓
Create Household Memberships
 ↓
Update Related Data
 ↓
Commit
```

Jika salah satu operasi gagal:

```text
Rollback
```

---

# 15. File Handling

File upload diproses melalui application layer.

Flow:

```text
Upload
 ↓
Validate Type
 ↓
Validate Size
 ↓
Generate Safe Filename / Identifier
 ↓
Store
 ↓
Save Metadata
```

File sensitif tidak boleh diletakkan pada public directory tanpa protection.

---

# 16. Map Architecture

House menyimpan:

```text
latitude
longitude
```

Frontend menggunakan Leaflet untuk menampilkan peta.

Map provider/tile provider belum dikunci.

Aplikasi tidak membuat sistem navigasi sendiri pada MVP.

Navigasi dilakukan menggunakan aplikasi peta eksternal.

---

# 17. Public House Link

Public house link menggunakan public token atau identifier yang tidak mengekspos ID internal secara langsung jika diperlukan.

Flow:

```text
Public Token
 ↓
Resolve House
 ↓
Check Public Visibility
 ↓
Return Allowed Public Information
```

Public endpoint harus menggunakan whitelist informasi.

Bukan mengambil seluruh record house/resident lalu menyembunyikan field di frontend.

---

# 18. Dashboard Architecture

Dashboard mengambil data agregat yang diperlukan.

Contoh:

```text
Pending Letters
Pending Complaints
Residents
Households
Houses
Dues
Recent Activity
```

Dashboard tidak boleh melakukan query berlebihan untuk setiap card.

Query aggregation harus diperhatikan saat data bertambah.

---

# 19. Import Architecture

Import file besar tidak boleh membuat request HTTP terlalu berat.

MVP dapat dimulai dengan synchronous processing untuk file kecil.

Jika ukuran data meningkat:

```text
Upload
 ↓
Validate
 ↓
Queue Job
 ↓
Process
 ↓
Import Result
```

Queue dapat diperkenalkan ketika diperlukan.

---

# 20. Audit Architecture

Aktivitas penting dicatat ke `audit_logs`.

Audit dilakukan pada action penting seperti:

* Login.
* Failed login.
* Create.
* Update.
* Delete.
* Approval.
* Rejection.
* Account activation.
* Activation code generation.

Audit log harus tidak dapat dimodifikasi sembarangan oleh user biasa.

---

# 21. Error Handling

Application harus memiliki error handling yang konsisten.

Kategori:

```text
Validation Error
Authentication Error
Authorization Error
Not Found
Business Rule Error
Server Error
```

Production response tidak boleh membocorkan:

* Stack trace.
* Database credentials.
* Internal paths.
* Sensitive data.

---

# 22. Environment Configuration

Configuration sensitif menggunakan environment variables.

Contoh:

```text
APP_KEY
APP_ENV
APP_URL

DB_HOST
DB_DATABASE
DB_USERNAME
DB_PASSWORD

MAP_PROVIDER_KEY
STORAGE_CONFIGURATION
```

Secret tidak boleh disimpan langsung dalam source code.

`.env` tidak boleh di-commit ke repository.

---

# 23. Development Environment

Development awal dapat menggunakan:

```text
Ubuntu / WSL2
PHP
Composer
Node.js
PostgreSQL
Git
```

Local development tidak harus identik dengan production, tetapi perbedaan penting harus terdokumentasi.

---

# 24. Production Architecture

Konseptual:

```text
Internet
   │
   ▼
HTTPS
   │
   ▼
Nginx
   │
   ▼
Laravel Application
   │
   ├── PostgreSQL
   ├── File Storage
   └── Queue Worker if needed
```

Production environment menggunakan Ubuntu Linux.

---

# 25. Backup Architecture

Minimal:

```text
PostgreSQL
   ↓
Scheduled Backup
   ↓
Separate Storage
```

Backup tidak boleh hanya berada pada server/database yang sama.

Restore procedure harus diuji secara berkala.

---

# 26. Git Workflow

Repository menggunakan Git.

Branch strategy dapat dimulai sederhana:

```text
main
develop
feature/*
```

Setiap perubahan besar sebaiknya:

```text
Create Branch
 ↓
Implement
 ↓
Test
 ↓
Review
 ↓
Merge
```

---

# 27. Testing Architecture

Testing minimal:

* Authentication tests.
* Authorization tests.
* Tenant isolation tests.
* Resident CRUD tests.
* Household relationship tests.
* Letter workflow tests.
* Complaint workflow tests.
* Dues workflow tests.
* Activation code tests.

Security-sensitive logic wajib memiliki automated tests.

---

# 28. Scalability Direction

MVP tidak perlu over-engineering.

Mulai dengan:

```text
Laravel
+
PostgreSQL
+
Nginx
```

Jika kebutuhan meningkat, architecture dapat dikembangkan dengan:

* Queue workers.
* Redis.
* Object storage.
* Separate application servers.
* Database optimization.
* Caching.
* Monitoring.

Perubahan tersebut dilakukan berdasarkan kebutuhan nyata.

---

# 29. Architecture Principles

1. Keep architecture simple.
2. Prefer Laravel conventions.
3. Separate business logic from presentation.
4. Enforce tenant isolation server-side.
5. Validate input.
6. Authorize every protected resource.
7. Use database transactions where necessary.
8. Avoid premature optimization.
9. Avoid unnecessary services or abstractions.
10. Document architectural changes.

---

# 30. Document Status

Version: 1.0

Status: Draft

Architecture dapat berubah berdasarkan hasil implementasi, testing, dan kebutuhan produk.
