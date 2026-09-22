# User Flows

## RT Digital Platform

# 1. Authentication Flow

## Login

```text
User
 ↓
Open Login
 ↓
Enter Credential
 ↓
System Validation
 ↓
Success
 ↓
Redirect according to Role
```

Role:

```text
super_admin
admin_rt
resident
```

Jika gagal:

```text
Invalid Credential
 ↓
Show Error
 ↓
User Can Retry
```

---

# 2. Super Admin: Create RT

```text
Super Admin
 ↓
Open Tenant Management
 ↓
Create RT
 ↓
Enter RT Information
 ↓
Create Tenant
 ↓
Create Admin RT
 ↓
Assign Admin to Tenant
 ↓
Tenant Active
```

---

# 3. Admin RT: First-Time Setup

```text
Admin Login
 ↓
First-Time Setup
 ↓
Review RT Information
 ↓
Import Resident Data
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
 ↓
Dashboard Ready
```

---

# 4. Resident Import Flow

```text
Admin
 ↓
Upload Excel / CSV
 ↓
System Parses File
 ↓
Preview Data
 ↓
Validate Fields
 ↓
Detect Duplicate
 ↓
Display Errors
 ↓
Admin Fixes / Confirms
 ↓
Import
 ↓
Residents Created / Updated
```

System tidak boleh langsung memasukkan file ke production database tanpa validation.

---

# 5. Resident Management Flow

## Add Resident

```text
Admin
 ↓
Data Warga
 ↓
Tambah Warga
 ↓
Fill Form
 ↓
Validate
 ↓
Save
 ↓
Resident Created
```

## Edit Resident

```text
Admin
 ↓
Data Warga
 ↓
Select Resident
 ↓
Edit
 ↓
Validate
 ↓
Save
 ↓
Audit Log
```

---

# 6. Resident Status Flow

## Resident Moves Out

```text
Resident Active
 ↓
Resident Moves Out
 ↓
Admin Updates Status
 ↓
Status = moved_out
 ↓
Current Household Relationship Updated
 ↓
Account Disabled if Necessary
```

Resident record is retained.

## Resident Deceased

```text
Resident Active
 ↓
Admin Updates Status
 ↓
Status = deceased
 ↓
Account Disabled
 ↓
Resident Record Retained
```

---

# 7. Household / KK Flow

## Create Household

```text
Admin
 ↓
Household / KK
 ↓
Create KK
 ↓
Enter KK Number
 ↓
Select House
 ↓
Add Members
 ↓
Select Head of Household
 ↓
Save
```

## Add Member

```text
Household
 ↓
Add Member
 ↓
Search Existing Resident
 ↓
Select Resident
 ↓
Set Family Role
 ↓
Save
```

The system should prefer linking an existing resident rather than creating duplicate resident records.

---

# 8. House Flow

## Create House

```text
Admin
 ↓
Rumah & Peta
 ↓
Tambah Rumah
 ↓
Enter House Number
 ↓
Enter Address
 ↓
Set Map Location
 ↓
Configure Public Visibility
 ↓
Save
```

## Edit Location

```text
Admin
 ↓
Select House
 ↓
Edit Location
 ↓
Set New Coordinates
 ↓
Save
 ↓
Audit Log
```

---

# 9. Public House Location Flow

```text
Public User
 ↓
Open Public House Link
 ↓
System Validates Link
 ↓
Display Allowed Public Information
 ↓
User Selects Navigation
 ↓
External Map Application
```

Public user does not need an account.

Sensitive resident information is never shown.

---

# 10. Resident Account Activation

```text
Admin
 ↓
Select Verified Resident
 ↓
Generate Activation Code
 ↓
System Stores Code Securely
 ↓
Admin Gives Code to Resident
 ↓
Resident Opens Activation Page
 ↓
Enter Activation Code
 ↓
System Validates Code
 ↓
Required Verification
 ↓
Create Credential
 ↓
Account Active
```

Activation code conditions:

```text
One-time
Expiring
Revocable
Securely stored
```

---

# 11. Letter Request Flow

```text
Resident
 ↓
Pengajuan Surat
 ↓
Select Letter Type
 ↓
Display Requirements
 ↓
Fill Form
 ↓
Upload Required Documents
 ↓
Review
 ↓
Submit
 ↓
Status = submitted
```

---

# 12. Letter Processing Flow

```text
Submitted
 ↓
Admin Reviews
 ↓
Valid?
 ├── No → Revision Required
 │          ↓
 │       Resident Revises
 │          ↓
 │       Submit Again
 │
 └── Yes
       ↓
    Processing
       ↓
    Approved / Rejected
```

Jika approved:

```text
Approved
 ↓
Processing Completion
 ↓
Completed
```

---

# 13. Letter Status

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

Transition harus dikontrol oleh role dan business rules.

---

# 14. Complaint Flow

```text
Resident
 ↓
Pengaduan
 ↓
Create Report
 ↓
Enter Title
 ↓
Enter Description
 ↓
Submit
 ↓
Status = submitted
 ↓
Admin Reviews
 ↓
Processing
 ↓
Resolved / Rejected
 ↓
Closed
```

---

# 15. Dues Flow

## Admin Creates Dues

```text
Admin
 ↓
Iuran
 ↓
Create Dues
 ↓
Set Name
 ↓
Set Amount
 ↓
Set Period
 ↓
Set Target
 ↓
Publish
```

Target masih membutuhkan keputusan final:

```text
resident
household
house
```

---

# 16. Dues Payment Flow

```text
Resident
 ↓
View Dues
 ↓
Select Outstanding Dues
 ↓
Report Payment
 ↓
Enter Payment Information
 ↓
Upload Proof if Required
 ↓
Submit
 ↓
pending_verification
 ↓
Admin Reviews
 ↓
Approved → paid
       or
Rejected
```

Payment gateway tidak termasuk MVP.

---

# 17. Announcement Flow

```text
Admin
 ↓
Announcements
 ↓
Create
 ↓
Write Content
 ↓
Save Draft
 ↓
Publish
 ↓
Resident Can View
```

Pengumuman dapat memiliki expiration date.

---

# 18. Activity Flow

```text
Admin
 ↓
Activities
 ↓
Create Activity
 ↓
Enter Details
 ↓
Publish
 ↓
Resident Views Activity
```

Informasi:

```text
Title
Description
Location
Start Time
End Time
Status
```

---

# 19. Admin Dashboard Flow

Saat Admin login:

```text
Login
 ↓
Dashboard
 ↓
Display Important Information
```

Prioritas informasi:

```text
Pending Letters
Pending Complaints
Dues
Data Requiring Attention
Recent Activities
```

Dashboard bukan sekadar kumpulan angka.

Tujuannya membantu Admin mengetahui apa yang harus dikerjakan.

---

# 20. Resident Dashboard Flow

Saat resident login:

```text
Login
 ↓
Resident Dashboard
```

Informasi utama:

```text
Announcements
Activities
Letter Status
Dues
Complaints
Relevant House Information
```

---

# 21. Account Status Flow

```text
No Account
 ↓
Activation Code
 ↓
Active
 ↓
Disabled
```

Resident dapat tetap memiliki record meskipun account disabled.

---

# 22. Authorization Flow

Setiap request yang membutuhkan data tenant:

```text
Request
 ↓
Authenticate
 ↓
Identify User
 ↓
Identify Tenant
 ↓
Check Role
 ↓
Check Permission
 ↓
Check Tenant Ownership
 ↓
Allow / Deny
```

Frontend hiding bukan security mechanism.

Authorization wajib dilakukan pada backend.

---

# 23. Error Handling Flow

Jika validation gagal:

```text
Submit
 ↓
Validation Failed
 ↓
Show Specific Error
 ↓
User Corrects Data
 ↓
Submit Again
```

Jika unauthorized:

```text
Request
 ↓
Authorization Failed
 ↓
403 / Appropriate Response
```

Jika unauthenticated:

```text
Request
 ↓
Authentication Failed
 ↓
Redirect / Return Authentication Error
```

Error message tidak boleh membocorkan informasi sensitif.

---

# 24. Critical User Journeys

## Journey A: RT Baru

```text
Super Admin
 ↓
Create RT
 ↓
Create Admin
 ↓
Admin Login
 ↓
Import Residents
 ↓
Create / Review Households
 ↓
Map Houses
 ↓
Platform Ready
```

## Journey B: Warga Mengajukan Surat

```text
Resident
 ↓
Login
 ↓
Select Letter
 ↓
Fill Form
 ↓
Submit
 ↓
Admin Review
 ↓
Revision / Approval
 ↓
Completed
```

## Journey C: Warga Melaporkan Masalah

```text
Resident
 ↓
Create Complaint
 ↓
Submit
 ↓
Admin Reviews
 ↓
Processing
 ↓
Resolved
 ↓
Closed
```

## Journey D: Warga Aktivasi Akun

```text
Verified Resident
 ↓
Admin Generates Code
 ↓
Resident Receives Code
 ↓
Activation
 ↓
Credential Creation
 ↓
Account Active
```

## Journey E: Public House Location

```text
Public User
 ↓
Open Link
 ↓
View Allowed House Information
 ↓
Open External Navigation
```

---

# 25. Flow Design Rules

1. User harus selalu mengetahui status proses.
2. Form harus melakukan validation.
3. Action penting harus memiliki confirmation.
4. Data sensitif tidak boleh muncul di public flow.
5. Status transition harus mengikuti role.
6. User tidak boleh dapat mengakses tenant lain.
7. Error harus memberikan informasi yang dapat ditindaklanjuti.
8. Sistem harus menghindari duplicate data.
9. Proses administratif penting harus dapat ditelusuri.
10. Flow harus tetap dapat digunakan oleh pengguna non-teknis.

---

# 26. Flows Requiring Further Definition

Flow berikut membutuhkan keputusan bisnis lebih lanjut:

* Perubahan KK.
* Pemecahan KK.
* Penggabungan KK.
* Pindah rumah dalam RT yang sama.
* Pindah RT.
* Pembuatan KK baru.
* Detail verifikasi aktivasi account.
* Target iuran.
* Mekanisme pembayaran.
* Template surat.
* PDF surat.
* Notification mechanism.
* Permission Ketua RT dan Sekretaris.
* Public house information.

---

# 27. Document Status

Version: 1.0

Status: Draft

User flow harus diperbarui jika proses bisnis berubah.
