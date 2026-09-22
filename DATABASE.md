# Database Design

## RT Digital Platform

# 1. Database Goals

Database harus:

* Mendukung multi-tenancy.
* Memisahkan data antar-RT.
* Menghindari duplicate data.
* Memodelkan hubungan warga, KK, dan rumah secara benar.
* Mempertahankan data administratif yang diperlukan.
* Mendukung lifecycle warga.
* Menyediakan auditability.
* Menjaga data sensitif.

---

# 2. Core Entities

Entitas utama:

```text
tenants
users
residents
households
household_members
houses
letter_types
letters
complaints
dues
dues_payments
announcements
activities
activation_codes
audit_logs
```

---

# 3. Entity Relationship

Relasi utama:

```text
Tenant
 │
 ├── Users
 ├── Residents
 ├── Houses
 ├── Households
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
 └── Household
       └── Household Member
              └── Resident
```

Satu house dapat memiliki banyak household.

Satu household dapat memiliki banyak resident.

---

# 4. tenants

Mewakili satu RT.

Field awal:

```text
id
name
province
regency
district
village
rt_number
rw_number
address
status
created_at
updated_at
```

Status:

```text
active
inactive
```

---

# 5. users

Mewakili account yang dapat login.

Field awal:

```text
id
tenant_id nullable
resident_id nullable
name
email
password
role
position nullable
status
last_login_at
created_at
updated_at
```

Role:

```text
super_admin
admin_rt
resident
```

Position untuk admin:

```text
ketua_rt
sekretaris
```

Resident account menggunakan `resident_id`.

Tidak semua resident harus memiliki user account.

---

# 6. residents

Mewakili data warga.

Field awal:

```text
id
tenant_id
nik
name
gender
birth_date
phone
status
created_at
updated_at
```

Status:

```text
active
moved_out
deceased
inactive
```

Resident tidak dihapus secara normal hanya karena pindah atau meninggal.

Exact resident fields masih perlu finalisasi.

---

# 7. households

Mewakili KK/household.

Field awal:

```text
id
tenant_id
kk_number
house_id
status
created_at
updated_at
```

Status:

```text
active
inactive
```

Satu house dapat memiliki lebih dari satu household.

---

# 8. household_members

Menghubungkan resident dengan household.

Field awal:

```text
id
household_id
resident_id
family_role
is_head
joined_at
left_at nullable
status
created_at
updated_at
```

Family role:

```text
kepala_keluarga
suami
istri
anak
orang_tua
saudara
lainnya
```

`is_head` menandai kepala keluarga.

Tabel ini digunakan untuk mencegah duplikasi resident.

---

# 9. houses

Mewakili rumah/bangunan fisik.

Field awal:

```text
id
tenant_id
house_number
address
latitude
longitude
public_visibility
status
created_at
updated_at
```

Status:

```text
active
inactive
```

Satu physical house memiliki satu marker lokasi.

Satu house dapat memiliki beberapa household.

---

# 10. Resident / Household / House Relationship

```text
House
  1
  │
  └── N Household
           │
           └── N Household Member
                    │
                    └── 1 Resident
```

Resident dan house tidak boleh dipaksa menjadi hubungan langsung satu-ke-satu.

Hubungan administratif utama:

```text
Resident
   ↓
Household Membership
   ↓
Household
   ↓
House
```

---

# 11. activation_codes

Digunakan untuk aktivasi account resident.

Field:

```text
id
tenant_id
resident_id
code_hash
expires_at
used_at nullable
revoked_at nullable
created_by
created_at
```

Rules:

* One-time.
* Expiring.
* Revocable.
* Tidak menyimpan plaintext code.
* Tidak dapat digunakan setelah activation.

---

# 12. letter_types

Jenis surat yang dapat dikonfigurasi.

Field:

```text
id
tenant_id nullable
name
description
requirements
template_reference nullable
status
created_at
updated_at
```

Contoh:

```text
Surat Pengantar
Surat Keterangan Domisili
Surat Keterangan Usaha
Surat Keterangan Tidak Mampu
Surat Pengantar Nikah
```

---

# 13. letters

Pengajuan surat.

Field awal:

```text
id
tenant_id
letter_type_id
resident_id
submitted_by
status
request_data
notes
processed_by nullable
processed_at nullable
completed_at nullable
created_at
updated_at
```

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

`request_data` dapat menyimpan field spesifik dari jenis surat.

Struktur final perlu ditentukan setelah template surat final dibuat.

---

# 14. complaints

Pengaduan/laporan.

Field:

```text
id
tenant_id
resident_id
title
description
category
status
assigned_to nullable
resolved_at nullable
created_at
updated_at
```

Status:

```text
submitted
processing
resolved
rejected
closed
```

---

# 15. dues

Definisi iuran.

Field awal:

```text
id
tenant_id
name
description
amount
period_start
period_end
target_type
status
created_by
created_at
updated_at
```

Contoh:

```text
Iuran Kebersihan
Iuran Keamanan
Iuran Kegiatan
Iuran Khusus
```

Target masih TBD:

```text
resident
household
house
```

---

# 16. dues_payments

Pencatatan pembayaran.

Field awal:

```text
id
due_id
resident_id nullable
household_id nullable
house_id nullable
amount
payment_date
proof_file nullable
status
verified_by nullable
verified_at nullable
notes
created_at
updated_at
```

Status:

```text
pending_verification
paid
rejected
cancelled
```

Struktur final harus mengikuti keputusan target iuran.

---

# 17. announcements

Pengumuman RT.

Field:

```text
id
tenant_id
title
content
published_by
status
published_at
expires_at nullable
created_at
updated_at
```

Status:

```text
draft
published
archived
```

---

# 18. activities

Kegiatan RT.

Field:

```text
id
tenant_id
title
description
location
start_at
end_at
status
created_by
created_at
updated_at
```

---

# 19. audit_logs

Aktivitas penting sistem.

Field:

```text
id
tenant_id nullable
user_id nullable
action
entity_type
entity_id
old_values nullable
new_values nullable
ip_address nullable
user_agent nullable
created_at
```

Contoh action:

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

Password, plaintext activation code, dan data rahasia lain tidak boleh masuk audit log.

---

# 20. Multi-Tenant Rules

Data bisnis tenant harus dapat dikaitkan dengan tenant.

Contoh:

```text
tenant_id
```

Backend harus memastikan:

```text
current_user.tenant_id
==
requested_data.tenant_id
```

atau menggunakan mekanisme authorization equivalent.

ID record saja tidak cukup untuk menentukan authorization.

Contoh yang tidak aman:

```text
/residents/123
```

Jika resident `123` milik tenant lain, request tetap harus ditolak.

---

# 21. Sensitive Data

Data sensitif:

```text
NIK
KK Number
Phone
Birth Date
Family Relationship
Account Data
```

Data tersebut:

* Tidak boleh tersedia melalui public house link.
* Tidak boleh dikirim melalui public API.
* Hanya dapat diakses sesuai permission.
* Tidak boleh muncul pada log biasa.
* Harus dipertimbangkan dalam backup dan retention policy.

---

# 22. Lifecycle Rules

Resident:

```text
active
moved_out
deceased
inactive
```

Resident tidak langsung dihapus ketika status berubah.

Household dan house juga sebaiknya menggunakan status atau soft delete sesuai kebutuhan bisnis.

Permanent deletion harus dibatasi.

---

# 23. Import Data

Import tidak boleh langsung masuk database production.

Flow:

```text
Upload
 ↓
Parse
 ↓
Preview
 ↓
Validation
 ↓
Duplicate Detection
 ↓
Error Report
 ↓
Admin Confirmation
 ↓
Import
```

Potential duplicate detection menggunakan data seperti:

```text
NIK
KK Number
```

dengan aturan final yang ditentukan kemudian.

---

# 24. Indexing

Index awal yang kemungkinan diperlukan:

```text
users.tenant_id
users.email
users.resident_id

residents.tenant_id
residents.nik
residents.status

households.tenant_id
households.kk_number
households.house_id

household_members.household_id
household_members.resident_id

houses.tenant_id
houses.house_number

letters.tenant_id
letters.resident_id
letters.status

complaints.tenant_id
complaints.status

dues.tenant_id
dues.status

audit_logs.tenant_id
audit_logs.user_id
```

Unique constraint harus mengikuti business rules final.

---

# 25. Primary Key

Belum dikunci.

Pilihan:

```text
BIGINT
```

atau:

```text
UUID
```

Keputusan final dilakukan sebelum migration production dibuat.

---

# 26. File Storage

File yang mungkin disimpan:

* Dokumen pengajuan surat.
* Bukti pembayaran.
* Dokumen pendukung lainnya.

File storage strategy belum final.

File tidak boleh disimpan sembarangan pada public directory jika mengandung data sensitif.

---

# 27. Open Database Decisions

Sebelum migration final:

1. Exact resident fields.
2. Exact household fields.
3. Exact house fields.
4. NIK unique global atau per tenant.
5. KK number unique dalam tenant.
6. Target iuran.
7. Aturan resident pada beberapa household.
8. Pindah rumah dalam RT yang sama.
9. Pindah RT.
10. Pembentukan KK baru.
11. Perubahan anggota KK.
12. Retention resident.
13. Final letter types.
14. Letter template.
15. PDF generation.
16. Ketua RT vs Sekretaris permission.
17. Public house information.
18. Notification mechanism.
19. Map provider.
20. Primary key.
21. File storage.

---

# 28. Database Principles

Prinsip utama:

```text
Resident ≠ User Account
Resident ≠ House
House ≠ Household
Household ≠ Resident
```

Model database harus mengikuti hubungan dunia nyata, bukan sekadar membuat tabel sesedikit mungkin.

---

# 29. Document Status

Version: 1.0

Status: Draft

Database belum dianggap final sampai open database decisions diselesaikan dan ERD ditinjau kembali.
