# 🏗️ Arsitektur & Alur Data RestoBook

Dokumen ini menjelaskan arsitektur sistem RestoBook secara detail termasuk alur data dan bagaimana komponen-komponen saling berinteraksi.

---

## Arsitektur Umum

### Layering Architecture

```
┌─────────────────────────────────────────┐
│         PRESENTATION LAYER              │
│  Blade Templates, HTML, CSS, JavaScript │
│  - Auth Views                           │
│  - Admin Dashboard Views                │
│  - Owner Dashboard Views                │
│  - Customer Views                       │
└──────────────┬──────────────────────────┘
               │ HTTP Requests/Responses
┌──────────────▼──────────────────────────┐
│         ROUTING LAYER                   │
│  - routes/web.php                       │
│  - routes/api.php                       │
│  - Middleware Stack                     │
└──────────────┬──────────────────────────┘
               │ Route Matching
┌──────────────▼──────────────────────────┐
│      APPLICATION LAYER                  │
│  Controllers                            │
│  - HTTP\Controllers\*                   │
│  - Business Logic & Request Handling    │
└──────────────┬──────────────────────────┘
               │ Model Operations
┌──────────────▼──────────────────────────┐
│         DOMAIN LAYER                    │
│  Models (Eloquent ORM)                  │
│  - User, Restaurant, Table, Menu        │
│  - Reservation, Booking, Setting        │
│  - Relationships & Validations          │
└──────────────┬──────────────────────────┘
               │ Database Queries
┌──────────────▼──────────────────────────┐
│      DATA PERSISTENCE LAYER             │
│  - Database: MySQL                      │
│  - Migrations                           │
│  - Schema Management                    │
└─────────────────────────────────────────┘
```

---

## Database Schema

### 1. Users Table

```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255),
    phone VARCHAR(15),
    role ENUM('admin', 'owner', 'customer'),
    google_id VARCHAR(255),
    two_factor_secret TEXT NULL,
    two_factor_recovery_codes TEXT NULL,
    remember_token VARCHAR(100),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Fields Penting:**
- `role`: Menentukan tipe akses user
- `google_id`: Untuk Google OAuth integration
- `email_verified_at`: Flag email sudah terverifikasi

---

### 2. Restaurants Table

```sql
CREATE TABLE restaurants (
    id BIGINT PRIMARY KEY,
    user_id BIGINT FOREIGN KEY (users.id),
    name VARCHAR(255),
    description TEXT,
    address TEXT,
    phone VARCHAR(15),
    image VARCHAR(255),
    status ENUM('pending', 'active', 'rejected'),
    city VARCHAR(100),
    operational_hours JSON,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Fields Penting:**
- `user_id`: FK ke restaurant owner
- `status`: Workflow approval restaurant
- `operational_hours`: JSON format jam buka-tutup

---

### 3. Tables Table

```sql
CREATE TABLE tables (
    id BIGINT PRIMARY KEY,
    restaurant_id BIGINT FOREIGN KEY (restaurants.id),
    table_number VARCHAR(10),
    capacity INT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Relasi:**
- Satu restaurant bisa punya banyak meja
- Gunakan untuk validasi kapasitas reservasi

---

### 4. Menus Table

```sql
CREATE TABLE menus (
    id BIGINT PRIMARY KEY,
    restaurant_id BIGINT FOREIGN KEY (restaurants.id),
    name VARCHAR(255),
    category VARCHAR(100),
    description TEXT,
    price DECIMAL(8,2),
    image VARCHAR(255),
    is_available BOOLEAN DEFAULT true,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Fitur:**
- Multi-category menu support
- Toggle availability
- Price tracking untuk history

---

### 5. Reservations Table

```sql
CREATE TABLE reservations (
    id BIGINT PRIMARY KEY,
    booking_code VARCHAR(20) UNIQUE,
    user_id BIGINT FOREIGN KEY (users.id),
    restaurant_id BIGINT FOREIGN KEY (restaurants.id),
    table_id BIGINT FOREIGN KEY (tables.id),
    reservation_date DATE,
    time TIME,
    guests INT,
    total_price DECIMAL(10,2),
    status ENUM('pending', 'confirmed', 'rejected', 'checked_in', 'no_show'),
    notes TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Status Flow:**
```
pending ─→ confirmed ─→ checked_in
         ─→ rejected
         ─→ no_show
```

---

### 6. Bookings Table

```sql
CREATE TABLE bookings (
    id BIGINT PRIMARY KEY,
    booking_code VARCHAR(20) UNIQUE FOREIGN KEY (reservations.booking_code),
    restaurant_name VARCHAR(255),
    booking_date DATE,
    table_area VARCHAR(100),
    total_price DECIMAL(10,2),
    status ENUM('pending', 'success', 'failed'),
    transaction_id VARCHAR(100),
    payment_method VARCHAR(50),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Integrasi:**
- Track Midtrans transaction
- Record payment method
- Status workflow untuk payment

---

### 7. Settings Table

```sql
CREATE TABLE settings (
    id BIGINT PRIMARY KEY,
    key VARCHAR(255) UNIQUE,
    value LONGTEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Contoh Keys:**
- `app_name`: Nama aplikasi
- `app_description`: Deskripsi app
- `maintenance_mode`: Boolean
- `contact_email`: Email kontak

---

## Model Relationships

### User Model
```php
class User extends Model {
    // As Restaurant Owner
    public function restaurants() {
        return $this->hasMany(Restaurant::class);
    }
    
    // As Customer
    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
```

### Restaurant Model
```php
class Restaurant extends Model {
    public function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function tables() {
        return $this->hasMany(Table::class);
    }
    
    public function menus() {
        return $this->hasMany(Menu::class);
    }
    
    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
```

### Reservation Model
```php
class Reservation extends Model {
    public function customer() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }
    
    public function table() {
        return $this->belongsTo(Table::class);
    }
    
    public function booking() {
        return $this->hasOne(Booking::class, 'booking_code', 'booking_code');
    }
    
    public function menus() {
        return $this->belongsToMany(Menu::class, 'reservation_menu');
    }
}
```

---

## Request-Response Flow

### Contoh: Membuat Reservasi

```
┌─────────────────────────────────────────────────────────────┐
│ STEP 1: CUSTOMER SUBMIT FORM                                │
└─────────────────────────────────────────────────────────────┘
Form Data:
{
    restaurant_id: 1,
    reservation_date: "2026-06-15",
    time: "19:00",
    guests: 4,
    table_id: 2,
    menu_ids: [1, 3, 5],
    special_notes: "Ada alergi seafood"
}
    ↓
POST /reservasi/store

┌─────────────────────────────────────────────────────────────┐
│ STEP 2: ROUTE & MIDDLEWARE                                  │
└─────────────────────────────────────────────────────────────┘
- Route matching di routes/web.php
- Middleware check: 'auth', 'role:customer'
- CSRF token verification
    ↓
[Customer/ReservationController]::store()

┌─────────────────────────────────────────────────────────────┐
│ STEP 3: CONTROLLER LOGIC                                    │
└─────────────────────────────────────────────────────────────┘
public function store(Request $request) {
    // 1. Validate input
    $validated = $request->validate([
        'restaurant_id' => 'required|exists:restaurants',
        'reservation_date' => 'required|date|after:today',
        'time' => 'required|date_format:H:i',
        'guests' => 'required|integer|min:1',
        'table_id' => 'required|exists:tables',
        'menu_ids' => 'required|array',
    ]);
    
    // 2. Generate booking code
    $bookingCode = 'BK' . time();
    
    // 3. Create reservation
    $reservation = Reservation::create([
        'user_id' => Auth::id(),
        'booking_code' => $bookingCode,
        'restaurant_id' => $validated['restaurant_id'],
        'table_id' => $validated['table_id'],
        'reservation_date' => $validated['reservation_date'],
        'time' => $validated['time'],
        'guests' => $validated['guests'],
        'status' => 'pending',
    ]);
    
    // 4. Attach menu items
    $reservation->menus()->attach($validated['menu_ids']);
    
    // 5. Calculate total price
    $totalPrice = Menu::whereIn('id', $validated['menu_ids'])->sum('price');
    
    // 6. Create booking
    Booking::create([
        'booking_code' => $bookingCode,
        'restaurant_name' => $reservation->restaurant->name,
        'total_price' => $totalPrice,
        'status' => 'pending',
    ]);
    
    // 7. Redirect to checkout
    return redirect()->route('booking.checkout', $bookingCode);
}
    ↓

┌─────────────────────────────────────────────────────────────┐
│ STEP 4: DATABASE PERSISTENCE                                │
└─────────────────────────────────────────────────────────────┘
INSERT INTO reservations (...)
INSERT INTO reservation_menu (reservation_id, menu_id) ...
INSERT INTO bookings (...)
    ↓

┌─────────────────────────────────────────────────────────────┐
│ STEP 5: RENDER RESPONSE                                     │
└─────────────────────────────────────────────────────────────┘
Redirect to: /booking/checkout/BK1718...

┌─────────────────────────────────────────────────────────────┐
│ STEP 6: CHECKOUT PAGE                                       │
└─────────────────────────────────────────────────────────────┘
BookingController::checkout()
- Fetch booking data
- Generate Midtrans token
- Render Snap payment UI
    ↓

┌─────────────────────────────────────────────────────────────┐
│ STEP 7: PAYMENT PROCESS                                     │
└─────────────────────────────────────────────────────────────┘
- User pilih payment method di Snap
- Payment processed by Midtrans
- Midtrans send webhook notification
    ↓

┌─────────────────────────────────────────────────────────────┐
│ STEP 8: WEBHOOK NOTIFICATION                                │
└─────────────────────────────────────────────────────────────┘
POST /midtrans/notification
Payload:
{
    transaction_status: "settlement",
    order_id: "BK1718...",
    transaction_id: "12345678901234",
    payment_type: "bank_transfer"
}

BookingController::handleNotification()
- Verify signature
- Update booking status
- Update reservation status to "confirmed"
- Send email notification to customer
- Send email notification to owner
    ↓

┌─────────────────────────────────────────────────────────────┐
│ STEP 9: SUCCESS PAGE                                        │
└─────────────────────────────────────────────────────────────┘
/booking/success/BK1718...
- Display confirmation
- Show booking code
- Show reservation details
```

---

## Authentication Flow

### Login Process

```
┌─────────────────────────────────────────────────┐
│ 1. User visit /login                            │
└──────────────────┬──────────────────────────────┘
                   ↓
┌─────────────────────────────────────────────────┐
│ 2. Show login form                              │
│    - Email input                                │
│    - Password input                             │
│    - Remember me checkbox                       │
│    - Google OAuth button                        │
└──────────────────┬──────────────────────────────┘
                   ↓
        ┌──────────┴──────────┐
        ↓                     ↓
   [Email Login]      [Google OAuth]
        │                     │
        ↓                     ↓
┌──────────────────┐  ┌────────────────────┐
│ POST /login      │  │ GET /auth/google   │
│                  │  │                    │
│ Validate input   │  │ Redirect to Google │
│ Find user        │  │ Ask for permission │
│ Check password   │  │ Get user info      │
│ Create session   │  │                    │
└────────┬─────────┘  └────────┬───────────┘
         │                     │
         └──────────┬──────────┘
                    ↓
        ┌────────────────────────┐
        │ Middleware check role  │
        │ - Admin → /admin       │
        │ - Owner → /owner       │
        │ - Customer → /home     │
        └────────────────────────┘
```

### Google OAuth Flow

```
┌─────────────────────────────────────┐
│ 1. User click "Login with Google"   │
└──────────────┬──────────────────────┘
               ↓
┌─────────────────────────────────────┐
│ 2. Redirect to Google Login          │
│    /auth/google                      │
└──────────────┬──────────────────────┘
               ↓
┌─────────────────────────────────────┐
│ 3. User authenticate di Google       │
│    Grant permissions                 │
└──────────────┬──────────────────────┘
               ↓
┌─────────────────────────────────────┐
│ 4. Google redirect ke callback       │
│    /auth/google/callback?code=XXX    │
└──────────────┬──────────────────────┘
               ↓
┌─────────────────────────────────────┐
│ 5. Handle callback                  │
│    - Exchange code untuk token      │
│    - Get user info dari Google      │
│    - Check if user exists           │
└──────────────┬──────────────────────┘
               ↓
        ┌──────┴──────┐
        ↓             ↓
   [User exists] [New User]
        │             │
        ↓             ↓
   [Login]       [Create]
                      │
                      ↓
               [Set default role]
                [customer]
                      │
                      ↓
        ┌────────────────────────┐
        │ Create session         │
        │ Redirect to dashboard  │
        └────────────────────────┘
```

---

## Payment Flow Integration

### Midtrans Snap Integration

```
┌──────────────────────────────────────┐
│ CUSTOMER SIDE                        │
└──────────────────────────────────────┘

1. Reservasi dibuat
   → booking_code: BK123456
   → total_price: 500000
   → status: pending

2. Customer go to checkout page
   GET /booking/checkout/BK123456

3. Backend generate Snap token
   $midtrans = new Snap();
   $token = $midtrans->getSnapToken([
       'transaction_details' => [
           'order_id' => 'BK123456',
           'gross_amount' => 500000
       ],
       ...
   ]);

4. Frontend display Snap UI
   snap.pay(token, ...)

5. User select payment method
   - Bank Transfer
   - E-wallet (QRIS, OVO, Dana, etc)
   - Credit Card
   - etc

6. Payment processed by Midtrans

┌──────────────────────────────────────┐
│ MIDTRANS SIDE                        │
└──────────────────────────────────────┘

1. Transaction created
   status: pending

2. Customer complete payment
   - For bank transfer: customer transfer uang
   - For e-wallet: customer confirm di app
   - For CC: customer input card details

3. Payment confirmed
   status: settlement/capture

4. Send webhook notification
   POST /midtrans/notification
   with transaction data

┌──────────────────────────────────────┐
│ SERVER SIDE                          │
└──────────────────────────────────────┘

1. Receive webhook notification
   POST /midtrans/notification

2. Verify signature
   - Ensure request from Midtrans
   - Check hash validation

3. Update database
   - Update booking status → 'success'
   - Update reservation status → 'confirmed'
   - Save transaction_id

4. Send notifications
   - Email ke customer
   - Email ke owner
   - Update dashboard

5. Response to Midtrans
   status: 200 OK
```

---

## Approval Workflow

### Restaurant Owner Approval

```
STEP 1: Owner Register
┌──────────────────────┐
│ Register Form        │
│ - Name, Email, Pwd   │
│ - Role: Owner        │
└──────┬───────────────┘
       ↓
   Database: User created
   status: needs verification

STEP 2: Owner Submit Verification
┌──────────────────────────────────┐
│ Submit Restaurant Info           │
│ - Restaurant name, address       │
│ - Description, phone, logo       │
│ - Operational hours              │
└──────┬───────────────────────────┘
       ↓
   Database: Restaurant created
   status: pending

STEP 3: Admin Review
┌──────────────────────────────────┐
│ Admin Dashboard                  │
│ GET /admin/restaurants           │
│ - List pending restaurants       │
│ - View owner details             │
│ - View restaurant info           │
└──────┬───────────────────────────┘
       ↓
    ┌──┴──┐
    ↓     ↓
 [Approve] [Reject]
    │       │
    ↓       ↓
PATCH /admin/restaurants/{id}/approve
PATCH /admin/restaurants/{id}/reject

STEP 4: Approve Path
┌──────────────────────────────────┐
│ Update restaurant status         │
│ status: active                   │
│                                  │
│ Send email ke owner:             │
│ "Restaurant approved!"           │
│ "You can now setup menus & tables│
└──────┬───────────────────────────┘
       ↓
   Owner can now login & setup

STEP 5: Reject Path
┌──────────────────────────────────┐
│ Update restaurant status         │
│ status: rejected                 │
│                                  │
│ Send email ke owner:             │
│ "Restaurant rejected"            │
│ Reason: "..."                    │
└──────┬───────────────────────────┘
       ↓
   Owner can resubmit or contact support
```

---

## Integration Points

### 1. Google OAuth
- **Library**: Laravel Socialite
- **Endpoint**: `/auth/google`, `/auth/google/callback`
- **Data Retrieved**: name, email, avatar
- **Use**: Auto-create account, skip email verification

### 2. Midtrans Payment
- **Library**: midtrans/midtrans-php
- **Endpoints**:
  - Generate token: Snap::getSnapToken()
  - Webhook: POST /midtrans/notification
  - Status check: Snap::getStatus()
- **Transaction Types**: Settlement, Pending, Expired, Denied

### 3. Email Notification
- **Services**: Laravel Mail with SMTP
- **Templates**: auth, reservation, booking, notifications
- **Events**: User register, reservation created, payment success, etc

---

## Middleware Stack

### Authentication Middleware
```
- Guest middleware: hanya non-auth users
- Auth middleware: hanya authenticated users
- Verified middleware: hanya users dengan verified email
```

### Role Middleware
```
- role:admin → Hanya admin
- role:owner → Hanya owner
- role:customer → Hanya customer
```

### CSRF Protection
```
- Semua POST, PUT, DELETE requests
- Token di session
- Validate di middleware
```

---

## Caching Strategy

### Data yang perlu di-cache
1. **Restaurant Listing** - Cache 1 jam
2. **Menu Items** - Cache 2 jam  
3. **Settings** - Cache 24 jam
4. **User Role** - Cache sesuai session

### Cache Keys
```
restaurants.all
restaurants.{id}.menus
restaurants.{id}.tables
settings.{key}
user.{id}.role
```

---

## Performance Optimization

### Database Optimization
- Use indexes pada frequently queried columns
- Use eager loading (with) untuk relationships
- Implement pagination untuk large datasets

### Query Optimization
```php
// Bad: N+1 problem
$restaurants = Restaurant::all();
foreach ($restaurants as $r) {
    echo $r->owner->name; // Query setiap kali
}

// Good: Eager loading
$restaurants = Restaurant::with('owner')->get();
```

### Caching
- Cache restaurant listings
- Cache menu items
- Cache settings

---

**Last Updated**: 2026-06-14
