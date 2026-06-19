#  Index Dokumentasi RestoBook

Selamat datang ke dokumentasi komprehensif RestoBook! Dokumen ini berisi semua yang Anda butuhkan untuk memahami, mengembangkan, dan memelihara sistem RestoBook.

---

##  Struktur Dokumentasi

```
 Documentation
├── 📄 INDEX.md (Anda di sini)
├── 📄 DOKUMENTASI.md (Dokumentasi Utama)
├── 📄 ARSITEKTUR.md (Arsitektur & Alur Data)
├── 📄 FITUR_DETIL.md (Penjelasan Fitur)
└── 📄 TROUBLESHOOTING.md (Troubleshooting & Referensi)
```

---

## 📖 Panduan Navigasi

### Untuk Pemula / Developer Baru

**Start here:**
1. Baca [DOKUMENTASI.md](DOKUMENTASI.md) section:
   - Overview Proyek
   - Persyaratan Sistem
   - Panduan Setup
   - Struktur Proyek

2. Pahami alur kerja di [DOKUMENTASI.md](DOKUMENTASI.md) section:
   - Alur Kerja Sistem

3. Pelajari fitur-fitur utama di [FITUR_DETIL.md](FITUR_DETIL.md)

4. Jika ada error, lihat [TROUBLESHOOTING.md](TROUBLESHOOTING.md)

---

### Untuk Full-Stack Developer

**Recommended reading order:**
1. [DOKUMENTASI.md](DOKUMENTASI.md) - Full overview
2. [ARSITEKTUR.md](ARSITEKTUR.md) - System architecture
3. [FITUR_DETIL.md](FITUR_DETIL.md) - Feature implementation details
4. Keep [TROUBLESHOOTING.md](TROUBLESHOOTING.md) as reference

---

### Untuk Backend Developer

**Focus on:**
1. [ARSITEKTUR.md](ARSITEKTUR.md) - Database schema & relationships
2. [ARSITEKTUR.md](ARSITEKTUR.md) - Request-response flow
3. [FITUR_DETIL.md](FITUR_DETIL.md) - Business logic details
4. [TROUBLESHOOTING.md](TROUBLESHOOTING.md) - Debugging tips

---

### Untuk Frontend Developer

**Focus on:**
1. [DOKUMENTASI.md](DOKUMENTASI.md) - UI Routes & Page structure
2. [FITUR_DETIL.md](FITUR_DETIL.md) - Section "Customer Interface" & individual features
3. [DOKUMENTASI.md](DOKUMENTASI.md) - Routes section
4. [TROUBLESHOOTING.md](TROUBLESHOOTING.md) - Front-end debugging

---

### Untuk DevOps / System Admin

**Focus on:**
1. [DOKUMENTASI.md](DOKUMENTASI.md) - Setup & Deployment
2. [TROUBLESHOOTING.md](TROUBLESHOOTING.md) - Performance & Database issues
3. [DOKUMENTASI.md](DOKUMENTASI.md) - Environment variables
4. [TROUBLESHOOTING.md](TROUBLESHOOTING.md) - Command references

---

## 📑 Konten Ringkas Per File

### DOKUMENTASI.md
**Dokumen utama berisi:**
-  Overview proyek & tujuan
-  Persyaratan sistem
-  Panduan setup lengkap
-  Struktur proyek
-  Model & database basic
-  Fitur-fitur utama (ringkas)
-  Routes & API list
-  Alur kerja untuk setiap role
-  Panduan development

**Gunakan untuk:** Onboarding, referensi setup, overview fitur

---

### ARSITEKTUR.md
**Berisi:**
-  Arsitektur sistem (layering)
-  Database schema detail
-  Entity relationship diagram
-  Model relationships (Eloquent)
-  Request-response flow dengan contoh
-  Authentication flow
-  Google OAuth flow
-  Payment flow integration
-  Approval workflow
-  Integration points (Google, Midtrans, Email)
-  Middleware stack
-  Caching strategy
-  Performance optimization

**Gunakan untuk:** Deep understanding sistem, database design, payment integration

---

### FITUR_DETIL.md
**Berisi penjelasan detail tentang:**
1. **Autentikasi & User Management**
   - User registration
   - Login (email & Google OAuth)
   - Email verification
   - Password reset
   - User roles & permissions

2. **Restaurant Management**
   - Register as owner
   - Submit restaurant info
   - Admin approve/reject
   - Restaurant dashboard

3. **Menu Management**
   - Add menu
   - Edit menu
   - Delete menu
   - View menu list
   - Toggle availability

4. **Table Management**
   - Add table
   - Edit table
   - Delete table
   - View table list

5. **Reservation System**
   - Customer create reservation
   - View reservation details (owner)
   - Approve reservation
   - Reject reservation
   - Mark attendance

6. **Payment & Booking**
   - Checkout page
   - Midtrans payment gateway
   - Payment webhook handler
   - Payment success page

7. **Dashboards**
   - Admin dashboard
   - Owner dashboard
   - Customer interface

**Gunakan untuk:** Implementasi fitur, API details, user flows

---

### TROUBLESHOOTING.md
**Berisi:**
-  Troubleshooting masalah umum
-  Debugging tips (dd, log, tinker, debugbar)
-  Database issues & solutions
-  Authentication issues
-  Payment issues (Midtrans)
-  Email issues
-  File upload issues
-  Performance issues
-  Artisan command references
-  Useful code snippets
-  Best practices & security checklist

**Gunakan untuk:** Troubleshooting, development reference, code snippets

---

## 🚀 Quick Start

### Setup untuk Development

```bash
# 1. Clone repository
git clone <repository-url>
cd restobook

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Configure database
# Edit .env dan set database credentials

# 5. Run migrations
php artisan migrate:fresh --seed

# 6. Build assets
npm run dev

# 7. Start server
php artisan serve

# 8. Access aplikasi
# Open: http://localhost:8000
```

**Lebih detail**: Lihat [DOKUMENTASI.md](DOKUMENTASI.md) section "Panduan Setup"

---

### Test Akun untuk Development

```
Admin Account:
- Email: admin@restobook.local
- Password: password123

Owner Account:
- Email: owner@restobook.local
- Password: password123

Customer Account:
- Email: customer@restobook.local
- Password: password123
```

---

## 🔍 Cari Informasi Spesifik

### Tentang Database

**Tabel mana yang ada?**
→ Lihat [ARSITEKTUR.md](ARSITEKTUR.md) section "Database Schema"

**Bagaimana relasi antar model?**
→ Lihat [ARSITEKTUR.md](ARSITEKTUR.md) section "Model Relationships"

**Bagaimana struktur tabel specific?**
→ Lihat [ARSITEKTUR.md](ARSITEKTUR.md) section "Database Schema"

---

### Tentang Fitur

**Bagaimana cara user buat reservasi?**
→ Lihat [FITUR_DETIL.md](FITUR_DETIL.md) section "5.1 Customer Create Reservation"

**Bagaimana payment processing?**
→ Lihat [ARSITEKTUR.md](ARSITEKTUR.md) section "Payment Flow Integration"

**Bagaimana approval workflow restaurant?**
→ Lihat [ARSITEKTUR.md](ARSITEKTUR.md) section "Approval Workflow"

---

### Tentang Routes

**Route apa saja yang available?**
→ Lihat [DOKUMENTASI.md](DOKUMENTASI.md) section "Routes & API"

**Endpoint untuk create reservation?**
→ Lihat [FITUR_DETIL.md](FITUR_DETIL.md) section "5.1 Customer Create Reservation"

**Admin endpoints apa?**
→ Lihat [DOKUMENTASI.md](DOKUMENTASI.md) section "Routes & API" → Admin Routes

---

### Tentang Troubleshooting

**Aplikasi blank page?**
→ Lihat [TROUBLESHOOTING.md](TROUBLESHOOTING.md) section "Blank Page / White Screen"

**Payment tidak working?**
→ Lihat [TROUBLESHOOTING.md](TROUBLESHOOTING.md) section "Payment Issues"

**Database connection error?**
→ Lihat [TROUBLESHOOTING.md](TROUBLESHOOTING.md) section "Database Connection Error"

---

### Tentang Development

**Gimana query optimization?**
→ Lihat [TROUBLESHOOTING.md](TROUBLESHOOTING.md) section "Query Performance Issue"

**Useful code snippets?**
→ Lihat [TROUBLESHOOTING.md](TROUBLESHOOTING.md) section "Useful Code Snippets"

**Artisan command apa saja?**
→ Lihat [TROUBLESHOOTING.md](TROUBLESHOOTING.md) section "Command References"

---

## 📱 User Workflows

### I'm a Customer

**Mau tahu:**
1. Bagaimana cara booking restaurant? → [DOKUMENTASI.md](DOKUMENTASI.md) "Alur Customer"
2. Bagaimana proses pembayaran? → [ARSITEKTUR.md](ARSITEKTUR.md) "Payment Flow"
3. Track reservation? → [FITUR_DETIL.md](FITUR_DETIL.md) "9.3 View Reservations"

---

### I'm a Restaurant Owner

**Mau tahu:**
1. Setup restaurant? → [DOKUMENTASI.md](DOKUMENTASI.md) "Alur Owner" step 2-4
2. Manage reservations? → [FITUR_DETIL.md](FITUR_DETIL.md) "5. Reservation System"
3. Add menu & tables? → [FITUR_DETIL.md](FITUR_DETIL.md) "3. Menu" & "4. Table Management"

---

### I'm an Admin

**Mau tahu:**
1. Approve restaurants? → [DOKUMENTASI.md](DOKUMENTASI.md) "Alur Admin" step 2
2. Manage users? → [FITUR_DETIL.md](FITUR_DETIL.md) "7.2 User Management"
3. Dashboard analytics? → [FITUR_DETIL.md](FITUR_DETIL.md) "7.1 Dashboard Overview"

---

### I'm a Developer

**Mau tahu:**
1. Architecture? → [ARSITEKTUR.md](ARSITEKTUR.md) full file
2. How to implement feature X? → [FITUR_DETIL.md](FITUR_DETIL.md) find section X
3. Debug issue? → [TROUBLESHOOTING.md](TROUBLESHOOTING.md) find section "Debugging Tips"
4. Best practices? → [TROUBLESHOOTING.md](TROUBLESHOOTING.md) section "Development Best Practices"

---

## 🎓 Learning Path

### Fase 1: Understanding (1-2 hari)
- [ ] Baca [DOKUMENTASI.md](DOKUMENTASI.md) full
- [ ] Understand alur kerja dari 3 roles
- [ ] Familiarize dengan struktur proyek

### Fase 2: Setup (1 hari)
- [ ] Follow setup guide di [DOKUMENTASI.md](DOKUMENTASI.md)
- [ ] Test dengan akun development
- [ ] Explore UI & features

### Fase 3: Deep Dive (2-3 hari)
- [ ] Baca [ARSITEKTUR.md](ARSITEKTUR.md)
- [ ] Understand database schema & relationships
- [ ] Study request-response flow

### Fase 4: Feature Implementation (ongoing)
- [ ] Refer ke [FITUR_DETIL.md](FITUR_DETIL.md) untuk details
- [ ] Use [TROUBLESHOOTING.md](TROUBLESHOOTING.md) sebagai reference
- [ ] Study code snippets & best practices

### Fase 5: Troubleshooting (as needed)
- [ ] Check [TROUBLESHOOTING.md](TROUBLESHOOTING.md) first
- [ ] Use debugging tips
- [ ] Refer ke artisan commands

---

## 📞 Support & Resources

### Official Documentation
- **Laravel**: https://laravel.com/docs
- **Midtrans**: https://docs.midtrans.com
- **Google OAuth**: https://developers.google.com/identity
- **Bootstrap**: https://getbootstrap.com/docs

### Internal Files
- **Controllers**: Lihat `app/Http/Controllers/`
- **Models**: Lihat `app/Models/`
- **Routes**: Lihat `routes/web.php` & `routes/api.php`
- **Migrations**: Lihat `database/migrations/`

### Error Messages
- **Check logs**: `tail -f storage/logs/laravel.log`
- **Debug mode**: Set `APP_DEBUG=true` di `.env`
- **Use debugbar**: Install `barryvdh/laravel-debugbar`

---

##  Checklist Sebelum Deploy

- [ ] Update `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Verify database connection
- [ ] Setup SSL certificate
- [ ] Configure proper mail service
- [ ] Setup Midtrans production keys
- [ ] Setup Google OAuth production keys
- [ ] Run migrations dengan `--force` flag
- [ ] Run `php artisan config:cache`
- [ ] Setup automated backups
- [ ] Configure logging & monitoring

Lihat detail di [DOKUMENTASI.md](DOKUMENTASI.md) section "Deployment"

---

## 🎯 Next Steps

**Tidak tahu mau mulai dari mana?**

1. **Jika baru pertama kali**: Mulai dari [DOKUMENTASI.md](DOKUMENTASI.md)
2. **Jika sudah familiar**: Langsung ke [ARSITEKTUR.md](ARSITEKTUR.md)
3. **Jika implement fitur baru**: Lihat [FITUR_DETIL.md](FITUR_DETIL.md) → cari fitur relevant
4. **Jika ada error**: Langsung ke [TROUBLESHOOTING.md](TROUBLESHOOTING.md)

---

## 📊 Statistics

| Metric | Value |
|--------|-------|
| **Total Files** | 5 (Index + 4 docs) |
| **Total Lines** | ~3500+ |
| **Total Sections** | 50+ |
| **Code Snippets** | 100+ |
| **Features Documented** | 10+ |
| **Troubleshooting Topics** | 20+ |

---

## 🔄 Versioning

**Dokumentasi Version:** 1.0.0  
**Last Updated:** 2026-06-14  
**RestoBook Version:** 1.0.0

---

## 📝 Notes

- Semua links dalam dokumentasi adalah internal links (Markdown links)
- Bisa diakses offline (semua file dalam format `.md`)
- Dapat di-convert ke HTML, PDF, atau format lain jika diperlukan
- Search dalam IDE untuk cepat menemukan informasi

---

## 🙏 Thank You

Terima kasih telah membaca dokumentasi RestoBook!

Semoga dokumentasi ini membantu Anda dalam:
-  Memahami sistem secara keseluruhan
-  Mengembangkan fitur baru
-  Troubleshooting masalah
-  Onboarding tim baru
-  Maintenance jangka panjang

**Happy Coding! 🚀**

---

**Questions or Updates?**  
Silakan update dokumentasi ini seiring dengan perkembangan aplikasi. Pastikan dokumentasi selalu up-to-date dengan kode yang ada.

---

[← Back to README.md](README.md)
