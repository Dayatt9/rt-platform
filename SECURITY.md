# Security Requirements

## RT Digital Platform

# 1. Security Goals

Platform harus:

* Melindungi data warga.
* Memisahkan data antar-RT.
* Mencegah akses tanpa authorization.
* Melindungi account.
* Melindungi file.
* Mencatat aktivitas administratif penting.
* Meminimalkan data yang terekspos ke publik.

---

# 2. Security Principles

Prinsip utama:

1. Deny by default.
2. Least privilege.
3. Backend authorization.
4. Tenant isolation.
5. Data minimization.
6. Secure storage.
7. Secure logging.
8. Auditability.
9. Defense in depth.
10. Never trust client-side controls.

---

# 3. Authentication

Authentication wajib untuk area private.

Password:

* Harus menggunakan secure password hashing.
* Tidak boleh disimpan plaintext.
* Tidak boleh muncul di log.
* Tidak boleh dikirim melalui URL.

Session harus menggunakan mekanisme secure framework.

---

# 4. Account Activation

Activation code:

* One-time.
* Expiring.
* Revocable.
* Securely stored.
* Tidak disimpan plaintext.
* Tidak boleh digunakan setelah berhasil diaktifkan.

Activation code bukan password.

NIK juga bukan password.

---

# 5. Authorization

Setiap protected request harus melewati authorization.

Authorization harus memeriksa:

```text
User
 ↓
Role
 ↓
Tenant
 ↓
Resource Ownership
 ↓
Action Permission
```

Frontend hiding bukan authorization.

Contoh:

```text
Admin RT 01
    ↓
Resident RT 02
    ↓
DENY
```

Walaupun Admin mengetahui ID resident tersebut.

---

# 6. Multi-Tenant Isolation

Tenant isolation adalah security requirement kritis.

Setiap data tenant harus memiliki hubungan yang dapat divalidasi ke tenant.

Contoh:

```text
Current Tenant = RT 01

Requested Resident
Tenant = RT 02

Result = DENY
```

Isolation harus diuji menggunakan automated tests.

Minimal test:

```text
Admin RT A cannot read Tenant B data.
Admin RT A cannot update Tenant B data.
Admin RT A cannot delete Tenant B data.
Resident A cannot read Resident B private data.
```

---

# 7. Role Permissions

## Super Admin

Platform-level access sesuai kebutuhan.

## Admin RT

Tenant-level administrative access.

Tidak boleh mengakses tenant lain.

## Resident

Access terbatas pada:

* Data pribadi yang diperbolehkan.
* Pengajuan sendiri.
* Pengaduan sendiri.
* Iuran yang berkaitan dengan dirinya.
* Informasi publik/tenant yang memang ditujukan kepada warga.

---

# 8. Sensitive Data

Data sensitif meliputi:

* NIK.
* Nomor KK.
* Nomor telepon.
* Tanggal lahir.
* Hubungan keluarga.
* Data account.
* Dokumen administratif.

Sensitive data harus:

* Hanya diakses oleh role yang membutuhkan.
* Tidak tersedia melalui public endpoint.
* Tidak ditampilkan pada URL.
* Tidak dicatat dalam application log sembarangan.

---

# 9. Public Data Protection

Public house link harus menggunakan whitelist.

Public endpoint hanya mengembalikan field yang memang diperbolehkan.

Contoh:

```text
Allowed:
House Number
General Address
Map Location
```

Tidak boleh:

```text
NIK
KK Number
Phone
Family Members
Resident Account
Private Notes
```

Jangan mengandalkan frontend untuk menyembunyikan field sensitif.

---

# 10. Input Validation

Semua input dari user harus divalidasi.

Validation mencakup:

* Required fields.
* Type.
* Length.
* Format.
* Range.
* Business rules.

Input tidak boleh dipercaya hanya karena berasal dari UI resmi.

---

# 11. SQL Injection

Database access harus menggunakan:

* Eloquent.
* Query Builder.
* Parameter binding.

Raw SQL harus digunakan hanya jika diperlukan dan harus menggunakan parameter binding.

User input tidak boleh digabung langsung ke SQL query.

---

# 12. XSS Protection

Output user-generated content harus di-escape sesuai konteks.

Contoh konten:

* Pengumuman.
* Pengaduan.
* Deskripsi kegiatan.
* Catatan surat.

HTML dari user tidak boleh dirender tanpa sanitization yang tepat.

---

# 13. CSRF Protection

Form state-changing pada web application harus menggunakan CSRF protection dari framework.

CSRF protection tidak boleh dinonaktifkan tanpa alasan yang terdokumentasi.

---

# 14. File Upload Security

File upload harus:

* Memiliki size limit.
* Memiliki type validation.
* Tidak menggunakan nama file asli sebagai identifier storage.
* Tidak langsung dianggap aman hanya karena extension.
* Disimpan pada lokasi yang sesuai.
* File sensitif tidak boleh dapat diakses publik tanpa authorization.

---

# 15. File Access

Private file harus melalui authorization.

Contoh:

```text
Resident A
 ↓
Request Private Document A
 ↓
Authorize
 ↓
Allow
```

Tetapi:

```text
Resident A
 ↓
Request Document B
 ↓
Deny
```

Direct predictable file URLs harus dihindari untuk private files.

---

# 16. Session Security

Production harus menggunakan:

* HTTPS.
* Secure cookies.
* HttpOnly cookies.
* Appropriate SameSite configuration.
* Session expiration sesuai kebutuhan.

Logout harus mengakhiri session yang sesuai.

---

# 17. HTTPS

Production wajib menggunakan HTTPS.

HTTP harus diarahkan ke HTTPS jika konfigurasi deployment memungkinkan.

Credentials dan sensitive data tidak boleh dikirim melalui plaintext HTTP.

---

# 18. Rate Limiting

Rate limiting harus diterapkan pada endpoint yang rentan disalahgunakan, terutama:

* Login.
* Activation.
* Password reset.
* Public endpoints jika diperlukan.
* API endpoints jika tersedia.

---

# 19. Audit Logging

Aktivitas penting harus dicatat.

Contoh:

```text
LOGIN
LOGIN_FAILED
CREATE
UPDATE
DELETE
APPROVE
REJECT
ACTIVATE_ACCOUNT
GENERATE_ACTIVATION_CODE
```

Audit log harus mencatat:

* User.
* Tenant.
* Action.
* Resource.
* Timestamp.
* Relevant change information.

Jangan mencatat:

* Password.
* Plaintext activation code.
* Sensitive authentication secrets.

---

# 20. Data Retention

Data resident yang pindah atau meninggal tidak langsung dihapus.

Retention policy final harus ditentukan berdasarkan kebutuhan administrasi dan aturan yang berlaku.

Data yang tidak diperlukan tidak boleh disimpan tanpa alasan.

---

# 21. Backup Security

Backup harus:

* Dilakukan secara terjadwal.
* Disimpan pada lokasi terpisah.
* Memiliki access control.
* Dipertimbangkan untuk encryption.
* Diuji restore-nya.

Backup juga mengandung data sensitif sehingga harus diperlakukan sebagai data private.

---

# 22. Secrets Management

Secret tidak boleh berada di source code.

Contoh secret:

```text
Database Password
Application Key
API Key
Storage Credentials
Notification Credentials
```

Gunakan environment configuration atau secret management yang sesuai.

`.env` tidak boleh di-commit.

---

# 23. Error Handling

Production error response tidak boleh membocorkan:

* Stack trace.
* SQL query.
* Database credentials.
* Internal filesystem path.
* Secret.
* Data tenant lain.

User mendapatkan pesan error yang sesuai kebutuhan.

Detail teknis disimpan pada server log dengan aman.

---

# 24. Dependency Security

Dependency harus:

* Menggunakan versi yang masih didukung.
* Diperbarui secara berkala.
* Diperiksa vulnerability-nya.
* Tidak menambahkan package tanpa kebutuhan yang jelas.

---

# 25. Authorization Testing

Automated tests wajib mencakup:

```text
Tenant A → Tenant A = ALLOW
Tenant A → Tenant B = DENY

Resident A → Own Data = ALLOW
Resident A → Resident B Data = DENY

Admin → Tenant Data = ALLOW
Unauthorized Role → Admin Action = DENY
```

---

# 26. Security Incident Principle

Jika ditemukan kebocoran atau unauthorized access:

1. Identifikasi affected resource.
2. Batasi akses.
3. Preserve relevant logs.
4. Investigate.
5. Rotate affected credentials/secrets.
6. Fix vulnerability.
7. Test.
8. Document incident.

---

# 27. Security Review Checklist

Sebelum fitur dianggap selesai:

```text
[ ] Authentication checked
[ ] Authorization checked
[ ] Tenant isolation checked
[ ] Input validation checked
[ ] Sensitive data exposure checked
[ ] File access checked
[ ] Audit logging checked
[ ] Error handling checked
[ ] Rate limiting checked where needed
[ ] Tests added
```

---

# 28. Security Principles for AI Coding Agents

AI coding agent tidak boleh:

* Bypass authorization untuk mempercepat development.
* Menghapus tenant isolation.
* Menaruh secret dalam source code.
* Menonaktifkan security middleware tanpa alasan.
* Membuat public endpoint untuk private data.
* Menyimpan password plaintext.
* Menampilkan sensitive data pada debug output.

Security requirements lebih penting daripada convenience.

---

# 29. Document Status

Version: 1.0

Status: Draft

Security requirements harus ditinjau ulang sebelum production deployment.
