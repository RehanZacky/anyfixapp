# AnyFix Service — Platform Manajemen Perbaikan & Booking On-Demand

**AnyFix Service** adalah platform full-stack layanan perbaikan dan pemeliharaan perangkat elektronik dan peralatan rumah tangga (*laptop, smartphone, komputer, TV, printer, jaringan Wi-Fi, dll.*) yang menghubungkan pelanggan (*customer*), teknisi tersertifikasi (*technician*), dan pengelola sistem (*admin*).

---

## 🏛️ Arsitektur Sistem

Sistem dirancang dengan arsitektur multi-tier yang terpusat pada **Laravel Backend & REST API**:

```text
┌─────────────────────────────────────────────────────────────┐
│                    Customer Web Portal                      │
│             (Laravel Blade + Tailwind CSS + Alpine)         │
└──────────────────────────────┬──────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────┐
│               Laravel REST API & Business Logic             │
│            (Sanctum Token Auth, Policies, FormRequests)     │
└──────────────┬───────────────────────────────┬──────────────┘
               │                               │
               ▼                               ▼
┌──────────────────────────────┐ ┌─────────────────────────────┐
│       Admin Dashboard        │ │      Technician Portal      │
│     (Metrics, CRUD, Assign)  │ │   (Jobs, Quotation, Status) │
└──────────────┬───────────────┘ └─────────────┬───────────────┘
               │                               │
               ▼                               ▼
┌─────────────────────────────────────────────────────────────┐
│                     MySQL Database Engine                   │
│             (13 Tables, Strict Integrity, Audit Trail)      │
└─────────────────────────────────────────────────────────────┘
                               ▲
                               │ Future REST API Client
┌──────────────────────────────┴──────────────────────────────┐
│                    Android Mobile App                       │
│           (Kotlin, MVVM, Retrofit - Folder Terpisah)        │
└─────────────────────────────────────────────────────────────┘
```

---

## 🛠️ Tech Stack

* **Backend & API:** PHP 8.2+, Laravel 12, Laravel Sanctum, Eloquent ORM.
* **Database:** MySQL / MariaDB dengan *Foreign Key Cascade*, *Unique Constraints*, dan *Indexes*.
* **Frontend Web:** Laravel Blade, Tailwind CSS, Alpine.js, Vite.
* **Testing:** PHPUnit, Laravel Feature Tests & RefreshDatabase.

---

## 👥 Peran Pengguna (*Roles*)

1. **Customer:** Mencari layanan, memesan servis dengan deskripsi & foto kerusakan, menentukan alamat & jadwal, melihat rincian estimasi suku cadang & jasa (*quotation*), melakukan approval/reject penawaran, pembayaran simulasi (*mock payment*), tracking status timeline, dan memberikan ulasan teknisi.
2. **Technician:** Menerima penugasan order, mengubah status pengerjaan, melakukan diagnosa, membuat rincian item penawaran (*parts & labor*), dan memantau pendapatan/statistik servis.
3. **Admin:** Mengelola kategori & katalog layanan, menugaskan teknisi pada order pelanggan, memonitor grafik transaksi & performa teknisi, serta mengelola akun pengguna.

---

## 🔄 Workflow Status Pengerjaan (*Controlled Workflow*)

Status transisi divalidasi ketat di sisi server:
$$\text{pending} \longrightarrow \text{confirmed} \longrightarrow \text{technician\_assigned} \longrightarrow \text{technician\_on\_the\_way} \longrightarrow \text{diagnosing} \longrightarrow \text{waiting\_customer\_approval} \longrightarrow \text{repairing} \longrightarrow \text{completed}$$

Setiap tahapan perubahan status otomatis tercatat pada tabel `service_status_histories` sebagai *audit trail*.

---

## 🔑 Akun Demo Pengujian (Seksi 67)

Semua akun di bawah menggunakan password: **`password123`**

| Role | Email | Deskripsi |
| :--- | :--- | :--- |
| **Super Admin** | `admin@anyfix.com` | Akses penuh dashboard analitik & manajemen |
| **Teknisi** | `budi.technician@anyfix.com` | Spesialis Laptop & Smartphone (Rating: 4.90) |
| **Teknisi** | `eko.technician@anyfix.com` | Spesialis PC, Jaringan & TV (Rating: 4.85) |
| **Teknisi** | `hendra.technician@anyfix.com` | Spesialis Printer & Home Appliances (Rating: 4.75) |
| **Customer** | `andi.customer@anyfix.com` | Contoh pelanggan dengan order selesai & berulasan |
| **Customer** | `siti.customer@anyfix.com` | Contoh pelanggan dengan order aktif (*diagnosing*) |
| **Customer** | `dian.customer@anyfix.com` | Contoh pelanggan dengan order baru (*pending*) |

---

## 🚀 Panduan Menjalankan Proyek Lokal

### Prasyarat
* PHP >= 8.2 (ekstensi `pdo_mysql`, `mbstring`, `openssl`, `curl` aktif)
* Composer 2.x
* Node.js >= 18.x & npm
* MySQL / MariaDB Server (misal via XAMPP / Laragon)

### Langkah Instalasi
1. Masuk ke direktori `backend/`:
   ```bash
   cd backend
   ```
2. Pastikan file `.env` sudah sesuai (default database `anyfix_db`):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=anyfix_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate:fresh --seed
   ```
4. Build asset frontend:
   ```bash
   npm run build
   ```
5. Jalankan server lokal:
   ```bash
   php artisan serve
   ```
6. Buka di browser: `http://127.0.0.1:8000`
