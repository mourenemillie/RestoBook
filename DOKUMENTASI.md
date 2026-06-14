# Dokumentasi Lengkap RestoBook

> **RestoBook** adalah platform manajemen reservasi restaurant berbasis web yang memungkinkan pelanggan untuk memesan meja dan restaurant untuk mengelola operasional mereka secara online.

---

## Daftar Isi

1. [Overview Proyek](#overview-proyek)
2. [Persyaratan Sistem](#persyaratan-sistem)
3. [Panduan Setup](#panduan-setup)
4. [Struktur Proyek](#struktur-proyek)
5. [Arsitektur Sistem](#arsitektur-sistem)
6. [Model & Database](#model--database)
7. [Fitur-Fitur Utama](#fitur-fitur-utama)
8. [Routes & API](#routes--api)
9. [Alur Kerja Sistem](#alur-kerja-sistem)
10. [Panduan Development](#panduan-development)

---

## Overview Proyek

### Tujuan
RestoBook adalah solusi end-to-end untuk sistem reservasi restaurant yang menghubungkan:
- **Pelanggan** → Mencari dan memesan meja di restaurant
- **Owner Restaurant** → Mengelola restoran, menu, meja, dan reservasi
- **Administrator** → Monitoring sistem, approval restaurant, dan konfigurasi global

### Fitur Utama
 Sistem autentikasi (Email & Google OAuth)  
 Manajemen restaurant dan profil  
 Sistem reservasi dengan payment online  
 Dashboard untuk setiap role (Admin, Owner, Customer)  
 Integrasi Midtrans untuk pembayaran  
 Manajemen menu dan meja  
 Notifikasi dan status tracking  

### Role & Akses
- **Admin**: Full access ke sistem, approval restaurant, manage users
- **Owner**: Kelola restaurant, menu, meja, reservasi
- **Customer**: Lihat restaurant, buat reservasi, payment

---

## Persyaratan Sistem

### Minimum Requirements
| Requirement | Version |
|------------|---------|
| **PHP** | 8.2+ |
| **Laravel** | 12.0+ |
| **MySQL** | 5.7+ atau MariaDB 10.3+ |
| **Node.js** | 18+ (untuk build assets) |
| **Composer** | Latest |

### Dependencies
```json
{
  "laravel/framework": "^12.0",
  "laravel/socialite": "^5.27",      // Google OAuth
  "midtrans/midtrans-php": "^2.6",   // Payment Gateway
  "laravel/tinker": "^2.10.1"        // REPL
}
```

---

## Panduan Setup

### 1️⃣ Clone Repository
```bash
git clone <repository-url>
cd restobook
```

### 2️⃣ Install Dependencies
```bash
composer install
npm install
```

### 3️⃣ Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dan atur:
```env
APP_NAME=RestoBook
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=restobook
DB_USERNAME=root
DB_PASSWORD=

# Google OAuth
GOOGLE_CLIENT_ID=your_client_id
GOOGLE_CLIENT_SECRET=your_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

# Midtrans Payment
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=noreply@restobook.local
```

### 4️⃣ Setup Database
```bash
php artisan migrate
php artisan db:seed
```

### 5️⃣ Build Assets
```bash
npm run dev      # Development mode
npm run build    # Production build
```

### 6️⃣ Generate Storage Link
```bash
php artisan storage:link
```

### 7️⃣ Run Development Server
```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

---

## Struktur Proyek

```
restobook/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php              # Autentikasi
│   │   │   ├── RestaurantController.php        # Landing & detail restaurant
│   │   │   ├── BookingController.php           # Booking & payment
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php     # Admin dashboard
│   │   │   │   ├── UserController.php          # Manage users
│   │   │   │   ├── RestaurantController.php    # Approve/reject restaurant
│   │   │   │   └── SettingController.php       # System settings
│   │   │   ├── Owner/
│   │   │   │   ├── DashboardController.php     # Owner dashboard
│   │   │   │   ├── ReservationController.php   # Manage reservasi
│   │   │   │   ├── TableController.php         # Manage meja
│   │   │   │   ├── MenuController.php          # Manage menu
│   │   │   │   └── SettingController.php       # Restaurant settings
│   │   │   └── Customer/
│   │   │       ├── HomeController.php          # Customer home
│   │   │       └── ReservationController.php   # Customer reservasi
│   │   └── Middleware/
│   ├── Models/
│   │   ├── User.php                 # User dengan role
│   │   ├── Restaurant.php           # Data restaurant
│   │   ├── Table.php                # Meja di restaurant
│   │   ├── Menu.php                 # Menu items
│   │   ├── Reservation.php          # Reservasi customer
│   │   ├── Booking.php              # Booking payment
│   │   └── Setting.php              # Configuration
│   └── Providers/
│       └── AppServiceProvider.php
│
├── database/
│   ├── migrations/
│   │   ├── *_create_users_table.php
│   │   ├── *_create_restaurants_table.php
│   │   ├── *_create_tables_table.php
│   │   ├── *_create_menus_table.php
│   │   ├── *_create_reservations_table.php
│   │   ├── *_create_bookings_table.php
│   │   └── ... (migrations lainnya)
│   ├── factories/
│   │   └── UserFactory.php
│   └── seeders/
│       └── DatabaseSeeder.php
│
├── routes/
│   ├── web.php                      # Web routes
│   ├── api.php                      # API routes
│   └── console.php
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── auth/
│   │   ├── admin/
│   │   ├── owner/
│   │   ├── customer/
│   │   └── ...
│   ├── css/
│   └── js/
│
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── database.php
│   ├── mail.php
│   └── ...
│
├── public/
│   ├── index.php
│   ├── css/
│   ├── js/
│   ├── img/
│   └── storage/ → link ke storage/app/public
│
├── storage/
│   ├── app/
│   │   └── public/
│   ├── framework/
│   └── logs/
│
├── tests/
│   ├── Unit/
│   └── Feature/
│
├── .env.example
├── composer.json
├── package.json
├── phpunit.xml
└── vite.config.js
```

---

## Arsitektur Sistem

### 🏗️ Diagram Arsitektur

```
┌─────────────────────────────────────────────────────────────┐
│                     FRONTEND (Blade Templates)              │
│  Admin Panel | Owner Dashboard | Customer Interface         │
└────────────────────┬────────────────────────────────────────┘
                     │
          ┌──────────┴──────────┐
          │                     │
┌─────────▼──────────┐  ┌──────▼────────────┐
│   Web Routes       │  │   Midtrans API    │
│  (routes/web.php)  │  │   Payment Gateway │
└─────────┬──────────┘  └──────────────────┘
          │
          ▼
┌─────────────────────────────────────────┐
│      HTTP Controllers Layer             │
│  ┌────────────────────────────────┐    │
│  │ AuthController                 │    │
│  │ RestaurantController           │    │
│  │ BookingController              │    │
│  │ Admin/* | Owner/* | Customer/* │    │
│  └────────────────────────────────┘    │
└─────────┬───────────────────────────────┘
          │
          ▼
┌─────────────────────────────────────────┐
│      Models Layer (Eloquent ORM)        │
│  User ↔ Restaurant ↔ Table             │
│  Menu ↔ Reservation ↔ Booking          │
│  Setting                                │
└─────────┬───────────────────────────────┘
          │
          ▼
┌─────────────────────────────────────────┐
│      Database Layer (MySQL)             │
│  Tables, Relationships, Constraints     │
└─────────────────────────────────────────┘
```

### 🔄 Request Flow
```
1. User Request → Route Matching
2. Middleware → Check Auth, Role, etc
3. Controller → Handle Logic
4. Model → Database Query via Eloquent
5. View → Render Response to User
```

---

## Model & Database

### 📊 Entity Relationship Diagram

```
┌──────────────┐
│     USER     │
├──────────────┤
│ id (PK)      │
│ name         │
│ email (UNQ)  │
│ password     │
│ phone        │
│ role         │ ────────────┐
│ verified     │             │
│ google_id    │             │
└──────────────┘             │
       │                     │
       ├─────────────┬───────┴──────┐
       │             │              │
       │   1:M       │ 1:M          │
       │             │              │
   ┌───▼──────────────┴─────┐  ┌────▼─────────────┐
   │   RESTAURANT           │  │   RESERVATION    │
   ├───────────────────────┤  ├─────────────────┤
   │ id (PK)               │  │ id (PK)         │
   │ user_id (FK)          │  │ user_id (FK)    │
   │ name                  │  │ restaurant_id   │
   │ description           │  │ (FK)            │
   │ address               │  │ table_id (FK)   │
   │ phone                 │  │ booking_code    │
   │ image                 │  │ reservation_date│
   │ status                │  │ time            │
   │ city                  │  │ guests          │
   │ operational_hours     │  │ total_price     │
   │ created_at            │  │ status          │
   └─┬────────────────────┬┘  │ created_at      │
     │                    │    └────┬───────────┘
     │ 1:M               │ 1:M     │
     │                    │         │
     │                    └─────┬───┘
     │                          │
 ┌───▼────────────┐      ┌──────▼──────────┐
 │     TABLE      │      │    BOOKING      │
 ├────────────────┤      ├─────────────────┤
 │ id (PK)        │      │ id (PK)         │
 │ restaurant_id  │      │ booking_code    │
 │ (FK)           │      │ (UNQ)           │
 │ table_number   │      │ restaurant_name │
 │ capacity       │      │ booking_date    │
 │ created_at     │      │ table_area      │
 └────────────────┘      │ total_price     │
       ▲                 │ status          │
       │ 1:M             │ created_at      │
       │                 └─────────────────┘
       │
 ┌─────┴──────────┐
 │      MENU      │
 ├────────────────┤
 │ id (PK)        │
 │ restaurant_id  │
 │ (FK)           │
 │ name           │
 │ category       │
 │ description    │
 │ price          │
 │ image          │
 │ is_available   │
 └────────────────┘
```

### 📋 User Roles & Permissions

| Role | Akses |
|------|-------|
| **Admin** | Dashboard, Manage Users, Approve Restaurant, Manage Restaurants, Settings |
| **Owner** | Dashboard, Manage Restaurant, Manage Menus, Manage Tables, Manage Reservations |
| **Customer** | Home, Browse Restaurants, Make Reservations, View Booking History |

---

## Fitur-Fitur Utama

### 🔐 1. Autentikasi & User Management

#### Login Biasa
- Registrasi dengan email & password
- Email verification
- Lupa password & reset

#### Google OAuth Login
- Integrasi Google OAuth 2.0
- Auto create account pada login pertama
- Skip email verification untuk Google users

#### Role-Based Access Control
- 3 role: Admin, Owner, Customer
- Middleware untuk protect routes
- Setiap role memiliki dashboard & akses berbeda

**Files:**
- [AuthController.php](app/Http/Controllers/AuthController.php)
- Middleware: [RoleMiddleware.php](app/Http/Middleware/RoleMiddleware.php)

---

### 🏪 2. Restaurant Management

#### Fitur Owner
-  Register sebagai restaurant owner
-  Submit verifikasi restaurant (pending approval)
-  Edit profil restaurant (nama, deskripsi, alamat, foto)
-  Setup jam operasional
-  Dashboard dengan statistik reservasi
-  View semua meja & menu

#### Fitur Admin
-  Review restaurant baru
-  Approve/Reject restaurant
-  Monitor semua restaurant yang aktif
-  Edit info restaurant jika diperlukan
-  Delete restaurant

**Files:**
- [RestaurantController.php](app/Http/Controllers/RestaurantController.php)
- [Owner/DashboardController.php](app/Http/Controllers/Owner/DashboardController.php)
- [Admin/RestaurantController.php](app/Http/Controllers/Admin/RestaurantController.php)

---

### 🍽️ 3. Menu Management

#### Fitur Owner
-  Tambah menu dengan kategori
-  Upload foto menu
-  Set harga per item
-  Edit menu existing
-  Delete menu
-  Toggle available/unavailable status
-  Lihat daftar semua menu

**Files:**
- [Owner/MenuController.php](app/Http/Controllers/Owner/MenuController.php)
- Model: [Menu.php](app/Models/Menu.php)

---

### 🪑 4. Table Management

#### Fitur Owner
-  Tambah meja baru dengan nomor & kapasitas
-  Edit informasi meja
-  Delete meja
-  Lihat daftar meja dengan status ketersediaan
-  Assign meja untuk reservasi

**Files:**
- [Owner/TableController.php](app/Http/Controllers/Owner/TableController.php)
- Model: [Table.php](app/Models/Table.php)

---

### 📅 5. Reservation System

#### Fitur Customer
-  Lihat detail restaurant
-  Lihat menu & harga
-  Buat reservasi dengan:
  - Pilih tanggal reservasi
  - Pilih waktu
  - Jumlah tamu
  - Pilih meja (jika tersedia)
  - Pilih menu items
-  Lihat booking code
-  Lihat riwayat reservasi

#### Fitur Owner
-  Lihat semua reservasi masuk (pending/confirmed/rejected)
-  Review detail reservasi
-  Approve/Reject reservasi
-  Mark tamu hadir/tidak hadir
-  Generate booking code
-  Lihat status pembayaran

**Files:**
- [Customer/ReservationController.php](app/Http/Controllers/Customer/ReservationController.php)
- [Owner/ReservationController.php](app/Http/Controllers/Owner/ReservationController.php)
- Model: [Reservation.php](app/Models/Reservation.php)

---

### 💳 6. Payment & Booking System

#### Integrasi Midtrans
-  Snap Payment Gateway
-  Multiple payment methods (Transfer Bank, E-wallet, CC)
-  Secure transaction
-  Webhook notification handling

#### Alur Pembayaran
1. Customer buat reservasi
2. Redirect ke Midtrans Snap
3. Customer lakukan pembayaran
4. Midtrans kirim notification webhook
5. Status reservation update otomatis
6. Owner dapat approve/reject

**Files:**
- [BookingController.php](app/Http/Controllers/BookingController.php)
- Model: [Booking.php](app/Models/Booking.php)

---

### 📊 7. Dashboard & Analytics

#### Admin Dashboard
- 📈 Total users, restaurants, reservations
- 📅 Reservasi per bulan
- 💰 Total revenue
- ⏳ Pending approvals
- 👥 Recent activities

#### Owner Dashboard
- 📊 Statistik reservasi
- 💰 Revenue dari reservasi
- 👥 Customer count
- 📅 Upcoming reservations
- 📈 Rating & reviews

#### Customer Dashboard
- 🎫 Booking history
- 📅 Upcoming reservations
- 💳 Payment history
- ❤️ Favorite restaurants

**Files:**
- [Admin/DashboardController.php](app/Http/Controllers/Admin/DashboardController.php)
- [Owner/DashboardController.php](app/Http/Controllers/Owner/DashboardController.php)
- [Customer/HomeController.php](app/Http/Controllers/Customer/HomeController.php)

---

## Routes & API

### 🌐 Public Routes

```
GET  /                                      Landing page (daftar restaurant)
GET  /restaurant/{id}/detail                Detail restaurant + menu
```

### 🔐 Authentication Routes

```
GET  /login                                 Login page
POST /login                                 Process login
GET  /register                              Register page
POST /register                              Process register
POST /logout                                Logout
GET  /auth/google                           Redirect ke Google
GET  /auth/google/callback                  Google callback
GET  /email/verify                          Email verification notice
GET  /email/verify/{id}/{hash}              Verify email
POST /email/verification-notification       Resend verification email
```

### 💳 Booking & Payment Routes

```
POST /restaurant/booking                    Create booking
GET  /booking/checkout/{booking_code}       Checkout page
GET  /booking/success/{booking_code}        Success page
POST /midtrans/notification                 Midtrans webhook
```

### 👤 Customer Routes (Authenticated)

```
GET  /home                                  Customer home
GET  /restaurants/all                       Semua restaurant
GET  /reservations                          Riwayat reservasi
POST /reservasi/store                       Create reservation
```

### 🏢 Owner Routes (Authenticated + role:owner)

```
GET  /owner/dashboard                       Owner dashboard
GET  /owner/pending                         Pending approval page
POST /owner/submit-verification             Submit verification

RESERVASI:
GET  /owner/reservasi                       Daftar reservasi
GET  /owner/reservasi/{id}                  Detail reservasi
POST /owner/reservasi/{id}/approve          Approve reservasi
POST /owner/reservasi/{id}/reject           Reject reservasi
POST /owner/reservasi/{id}/checkin          Mark hadir

MEJA:
GET  /owner/kelola-meja                     Daftar meja
POST /owner/kelola-meja/store               Create meja
POST /owner/kelola-meja/{id}/update         Update meja
POST /owner/kelola-meja/{id}/delete         Delete meja

MENU:
GET  /owner/tambah-menu                     Daftar menu
POST /owner/tambah-menu/store               Create menu
POST /owner/tambah-menu/{id}/update         Update menu
POST /owner/tambah-menu/{id}/delete         Delete menu

SETTINGS:
GET  /owner/settings                        Restaurant settings
POST /owner/settings/update                 Update settings
```

### 🛡️ Admin Routes (Authenticated + role:admin)

```
GET  /admin/dashboard                       Admin dashboard
GET  /admin/export                          Export data

USER MANAGEMENT:
GET  /admin/users                           Daftar users
PUT  /admin/users/{id}                      Update user
DELETE /admin/users/{id}                    Delete user

RESTAURANT MANAGEMENT:
GET  /admin/restaurants                     Daftar restaurant
PATCH /admin/restaurants/{id}/approve       Approve restaurant
PATCH /admin/restaurants/{id}/reject        Reject restaurant
PUT  /admin/restaurants/{id}                Update restaurant
DELETE /admin/restaurants/{id}              Delete restaurant

SETTINGS:
GET  /admin/settings                        System settings
POST /admin/settings/update                 Update settings
```

---

## Alur Kerja Sistem

### 👤 Alur Customer

```
1. BROWSE RESTAURANT
   ├─ Kunjungi homepage
   ├─ Lihat daftar semua restaurant
   └─ Klik restaurant untuk detail

2. LIHAT DETAIL RESTAURANT
   ├─ Lihat informasi restaurant
   ├─ Lihat daftar menu & harga
   ├─ Lihat rating & review
   └─ Lihat jam operasional

3. BUAT RESERVASI
   ├─ Pilih tanggal reservasi
   ├─ Pilih waktu
   ├─ Masukkan jumlah tamu
   ├─ Pilih meja (jika ada pilihan)
   ├─ Pilih menu items
   └─ Submit reservasi

4. PEMBAYARAN
   ├─ Redirect ke Midtrans Snap
   ├─ Pilih metode pembayaran
   ├─ Lakukan pembayaran
   └─ Tunggu konfirmasi

5. TUNGGU APPROVAL OWNER
   ├─ Status berubah dari "Pending" ke "Processing"
   ├─ Owner review reservasi
   └─ Status berubah ke "Confirmed" atau "Rejected"

6. DATANG KE RESTAURANT
   ├─ Bawa booking code
   ├─ Owner scan/verifikasi code
   └─ Owner mark "Hadir" atau "Tidak Hadir"

7. HISTORY
   ├─ Lihat riwayat semua reservasi
   ├─ Lihat status & payment
   └─ Bisa review restaurant (jika sudah datang)
```

### 🏢 Alur Owner

```
1. REGISTER
   ├─ Fill form register
   ├─ Pilih role "Owner"
   ├─ Verifikasi email
   └─ Tunggu approval admin

2. SUBMIT RESTAURANT INFO
   ├─ Fill form restaurant
   ├─ Upload logo/foto restaurant
   ├─ Set alamat & lokasi
   └─ Submit untuk approval

3. TUNGGU APPROVAL ADMIN
   ├─ Status restaurant: "Pending"
   ├─ Admin review
   └─ Status berubah "Active" atau "Rejected"

4. SETUP RESTAURANT (setelah active)
   ├─ Tambah meja
   │  ├─ Input nomor meja
   │  ├─ Set kapasitas
   │  └─ Save
   │
   ├─ Tambah menu
   │  ├─ Input nama menu
   │  ├─ Pilih kategori
   │  ├─ Set harga
   │  ├─ Upload foto
   │  └─ Save
   │
   └─ Konfigurasi settings
      ├─ Jam operasional
      ├─ Informasi kontak
      └─ Deskripsi

5. KELOLA RESERVASI
   ├─ Lihat daftar reservasi (Pending/Confirmed/Rejected)
   ├─ Klik reservasi untuk detail
   ├─ Approve reservasi 
   │  └─ Kirim notifikasi ke customer
   ├─ Reject reservasi ❌
   │  └─ Kirim notifikasi + reason
   └─ Mark hadir
      ├─ Scan booking code
      └─ Update status "Hadir"

6. MONITOR DASHBOARD
   ├─ Lihat statistik reservasi
   ├─ Lihat revenue
   ├─ Lihat upcoming reservations
   └─ Lihat customer feedback
```

### 🛡️ Alur Admin

```
1. LOGIN
   ├─ Login dengan credentials admin
   └─ Akses admin dashboard

2. APPROVE RESTAURANT OWNER
   ├─ Lihat daftar pending owners
   ├─ Review informasi owner & restaurant
   ├─ Approve 
   │  ├─ Status restaurant jadi "Active"
   │  ├─ Owner bisa login
   │  └─ Send email notifikasi
   └─ Reject
      ├─ Status jadi "Rejected"
      └─ Send email + reason

3. MANAGE USERS
   ├─ Lihat daftar semua users
   ├─ Edit user information
   │  ├─ Update email, nama, phone
   │  └─ Update role
   └─ Delete user jika diperlukan

4. MANAGE RESTAURANT
   ├─ Lihat semua restaurant aktif
   ├─ Edit restaurant info
   ├─ Suspend restaurant
   └─ Delete restaurant

5. MONITOR SISTEM
   ├─ Lihat dashboard analytics
   ├─ Total users, restaurants, reservasi
   ├─ Revenue tracking
   ├─ Recent activities
   └─ Export data untuk reporting

6. SYSTEM SETTINGS
   ├─ Configure app settings
   ├─ Email configuration
   ├─ Payment settings
   └─ Other global config
```

---

**Last Updated**: 2026-06-14  
**Version**: 1.0.0  
**Maintained By**: Development Team
