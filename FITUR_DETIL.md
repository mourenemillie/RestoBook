# Panduan Fitur Detil RestoBook

Dokumen ini memberikan penjelasan detail tentang setiap fitur dan modul dalam sistem RestoBook.

---

## 📑 Daftar Fitur

1. [Autentikasi & User Management](#1-autentikasi--user-management)
2. [Restaurant Management](#2-restaurant-management)
3. [Menu Management](#3-menu-management)
4. [Table Management](#4-table-management)
5. [Reservation System](#5-reservation-system)
6. [Payment & Booking](#6-payment--booking)
7. [Admin Dashboard](#7-admin-dashboard)
8. [Owner Dashboard](#8-owner-dashboard)
9. [Customer Interface](#9-customer-interface)

---

## 1. Autentikasi & User Management

### 1.1 User Registration

**Endpoint**: `GET /register` (view), `POST /register` (process)

**Fitur:**
- Form registrasi dengan email & password
- Password confirmation validation
- CAPTCHA protection
- Email verification setelah registrasi

**Form Fields:**
```html
- Name (required, min:3)
- Email (required, unique, email format)
- Password (required, min:8, with confirmation)
- Role (radio: admin/owner/customer)
```

**Proses:**
1. Validasi form input
2. Hash password dengan bcrypt
3. Create user record
4. Send email verification link
5. Redirect ke email verification notice

**Email Template:**
```
Selamat datang di RestoBook!

Klik link dibawah untuk memverifikasi email Anda:
[Verification Link]

Link berlaku selama 60 menit.
```

---

### 1.2 User Login

**Endpoint**: `GET /login` (view), `POST /login` (process)

**Fitur:**
- Email & password login
- Remember me checkbox
- Session management
- Failed login tracking
- Rate limiting (max 5 attempts per minute)

**Validation:**
```php
'email' => 'required|email|exists:users',
'password' => 'required|min:8',
'remember' => 'boolean'
```

**Proses:**
1. Find user by email
2. Verify password
3. Create session
4. Check if email verified
   - If not verified: redirect ke verification notice
   - If verified: redirect sesuai role
5. Set remember token jika dipilih

**Redirect berdasarkan role:**
```
- Admin → /admin/dashboard
- Owner → /owner/dashboard
- Customer → /home
```

---

### 1.3 Google OAuth Login

**Endpoint**: `GET /auth/google` (redirect), `GET /auth/google/callback` (handle)

**Setup:**
```
1. Register app di Google Console
2. Set redirect URI: http://localhost:8000/auth/google/callback
3. Copy Client ID & Client Secret ke .env
```

**Proses:**
1. User click "Login with Google"
2. Redirect ke Google OAuth page
3. User authorize app
4. Google redirect ke callback URL dengan code
5. Exchange code untuk access token
6. Get user info (name, email, avatar)
7. Check if user exists:
   - **Jika ada**: Login
   - **Jika baru**: Create account dengan role 'customer'
8. Redirect ke dashboard

**Data Disimpan:**
```
- name (dari Google profile)
- email (dari Google)
- google_id (untuk future logins)
- avatar (optional)
- email_verified_at (auto verified)
```

---

### 1.4 Email Verification

**Endpoint**: `GET /email/verify` (notice), `GET /email/verify/{id}/{hash}` (verify), `POST /email/verification-notification` (resend)

**Proses Verification:**
1. User menerima email dengan verification link
2. Link format: `/email/verify/{user_id}/{hash}`
3. Hash generate dari email & user_id
4. User click link
5. System verify hash
6. Set `email_verified_at` timestamp
7. Redirect ke login dengan success message

**Resend Verification:**
- Endpoint: `POST /email/verification-notification`
- Rate limit: 6 requests per minute
- Validation: user harus authenticated tapi belum verified
- Send email baru dengan link baru

---

### 1.5 Password Reset

**Endpoints:**
- `GET /forgot-password` (form)
- `POST /forgot-password` (send reset link)
- `GET /reset-password/{token}` (form)
- `POST /reset-password` (process)

**Proses:**
1. User click "Forgot password"
2. Input email address
3. System check email exists
4. Generate token
5. Save token ke database dengan expiry (60 menit)
6. Send email dengan reset link
7. User klik link di email
8. Form muncul untuk input password baru
9. Hash password baru
10. Clear token
11. Redirect ke login

**Security:**
- Token hanya berlaku 60 menit
- One-time use (token dihapus setelah digunakan)
- Token random & secure

---

### 1.6 User Roles & Permissions

#### Admin
```
Permissions:
View semua users
Create new user
Edit user
Delete user
View semua restaurants
Approve/Reject restaurants
Edit restaurant info
Delete restaurant
View system settings
Update settings
Export data
View analytics

Routes:
/admin/dashboard
/admin/users
/admin/restaurants
/admin/settings
/admin/export
```

#### Owner
```
Permissions:
 Edit own restaurant
 Manage restaurant menus
 Manage restaurant tables
 View own reservations
 Approve/Reject reservations
 Mark attendance
 View own analytics
 Update restaurant settings

Routes:
/owner/dashboard
/owner/reservasi
/owner/kelola-meja
/owner/tambah-menu
/owner/settings
```

#### Customer
```
Permissions:
 Browse restaurants
 View restaurant details & menus
 Create reservations
 View own reservations
 Make payments
 View booking history
 Edit profile

Routes:
/home
/restaurants/all
/restaurant/{id}/detail
/reservations
/bookings
```

---

## 2. Restaurant Management

### 2.1 Register as Owner

**Endpoint**: `POST /register` dengan `role='owner'`

**Proses:**
1. Form register di halaman publik
2. Pilih role "owner"
3. Create user account
4. Create default restaurant record (status: pending)
5. Redirect ke owner pending page
6. User submit restaurant details

---

### 2.2 Submit Restaurant Info

**Endpoint**: `POST /owner/submit-verification`

**Form Fields:**
```
- Restaurant Name (required, string)
- Description (required, text, min:20)
- Address (required, string)
- Phone (required, regex)
- City (required, enum)
- Operational Hours (required, JSON)
  {
    "Monday": { "open": "09:00", "close": "22:00" },
    "Tuesday": { "open": "09:00", "close": "22:00" },
    ...
  }
- Logo/Image (required, file, max:5MB)
```

**Validasi:**
```php
'name' => 'required|string|max:255',
'description' => 'required|string|min:20',
'address' => 'required|string',
'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
'city' => 'required|in:' . implode(',', $cities),
'operational_hours' => 'required|json',
'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
```

**Proses:**
1. Validate input
2. Upload image ke storage/public/restaurants/
3. Save restaurant info
4. Update status ke 'pending'
5. Send notification email ke admin
6. Redirect dengan success message

**Email ke Admin:**
```
Subject: Verifikasi Restaurant Baru

Owner telah submit restaurant baru:
- Name: [Restaurant Name]
- Owner: [Owner Name] ([Email])
- City: [City]

Silakan review di: /admin/restaurants
```

---

### 2.3 Admin Approve Restaurant

**Endpoint**: `PATCH /admin/restaurants/{id}/approve`

**Proses:**
1. Admin review restaurant details
2. Validate information
3. Click "Approve" button
4. Update status ke 'active'
5. Send email ke owner

**Email ke Owner:**
```
Subject: Restaurant Approved! 🎉

Selamat! Restaurant Anda telah di-approve.

Langkah selanjutnya:
1. Login ke owner dashboard
2. Setup meja untuk restaurant
3. Tambah menu items
4. Konfigurasi settings

Booking akan dimulai setelah setup selesai.

Regards,
RestoBook Team
```

---

### 2.4 Admin Reject Restaurant

**Endpoint**: `PATCH /admin/restaurants/{id}/reject`

**Form:**
```
- Reject Reason (required, text)
```

**Proses:**
1. Admin pilih restaurant
2. Input reason for rejection
3. Click "Reject" button
4. Update status ke 'rejected'
5. Save rejection reason
6. Send email ke owner

**Email ke Owner:**
```
Subject: Restaurant Application Rejected

Mohon maaf, restaurant application Anda ditolak.

Reason: [Rejection Reason]

Anda dapat submit ulang atau hubungi support untuk informasi lebih lanjut.

Regards,
RestoBook Team
```

---

### 2.5 Restaurant Dashboard

**Endpoint**: `GET /owner/dashboard`

**Menampilkan:**
- 📊 Total reservasi bulan ini
- 💰 Revenue bulan ini
- 👥 New customers bulan ini
- 📅 Upcoming reservations (3 hari ke depan)
- ⭐ Recent reviews
- 📈 Reservasi trend (chart)
- 📱 Quick actions (Add menu, Add table, View reservations)

**Data Queries:**
```php
// Reservasi bulan ini
$thisMonth = Reservation::where('restaurant_id', $restaurantId)
    ->whereMonth('created_at', now()->month)
    ->count();

// Revenue
$revenue = Reservation::where('restaurant_id', $restaurantId)
    ->whereMonth('created_at', now()->month)
    ->sum('total_price');

// Upcoming reservations
$upcoming = Reservation::where('restaurant_id', $restaurantId)
    ->where('reservation_date', '>=', now()->date())
    ->where('reservation_date', '<=', now()->addDays(3)->date())
    ->with(['customer', 'table'])
    ->orderBy('reservation_date')
    ->get();
```

---

## 3. Menu Management

### 3.1 Add Menu

**Endpoint**: `GET /owner/tambah-menu` (form), `POST /owner/tambah-menu/store` (save)

**Form Fields:**
```
- Menu Name (required, string, max:100)
- Category (required, enum: appetizer, main, dessert, drink)
- Description (required, text, min:10)
- Price (required, numeric, min:0)
- Image (required, file, max:2MB)
- Is Available (checkbox, default:true)
```

**Validasi:**
```php
'name' => 'required|string|max:100',
'category' => 'required|in:appetizer,main,dessert,drink',
'description' => 'required|string|min:10',
'price' => 'required|numeric|min:0|max:999999.99',
'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
```

**Proses:**
1. Validate input
2. Upload image
3. Create menu record
4. Return json response atau redirect dengan success

**Response:**
```json
{
    "success": true,
    "message": "Menu added successfully",
    "data": {
        "id": 1,
        "name": "Menu name",
        "category": "main",
        "price": 75000,
        "image": "/storage/menus/filename.jpg"
    }
}
```

---

### 3.2 Edit Menu

**Endpoint**: `POST /owner/tambah-menu/{id}/update`

**Form Fields:** Same as Add Menu (image optional)

**Proses:**
1. Fetch menu record
2. Validate ownership (menu harus milik restaurant owner)
3. Validate input
4. Update menu details
5. Update image jika ada
6. Return success response

---

### 3.3 Delete Menu

**Endpoint**: `POST /owner/tambah-menu/{id}/delete` or `DELETE /owner/tambah-menu/{id}`

**Proses:**
1. Fetch menu record
2. Validate ownership
3. Delete image file dari storage
4. Delete menu record
5. Return success response

**Soft Delete Consideration:**
- Jika ada reservations yang reference menu ini
- Gunakan soft delete untuk historical tracking
- Atau archive instead of delete

---

### 3.4 View Menu List

**Endpoint**: `GET /owner/tambah-menu`

**Menampilkan:**
- Table dengan columns:
  - Menu Name
  - Category
  - Price
  - Available Status (toggle)
  - Actions (Edit, Delete)
- Search/filter by category
- Pagination (25 per halaman)

**Query:**
```php
$menus = Menu::where('restaurant_id', $restaurantId)
    ->when($category, function($q) use ($category) {
        $q->where('category', $category);
    })
    ->when($search, function($q) use ($search) {
        $q->where('name', 'like', "%{$search}%");
    })
    ->orderBy('created_at', 'desc')
    ->paginate(25);
```

---

### 3.5 Toggle Menu Availability

**Endpoint**: `POST /owner/tambah-menu/{id}/toggle-availability`

**Request:**
```json
{
    "is_available": true/false
}
```

**Proses:**
1. Update menu `is_available` field
2. Return json response

**Response:**
```json
{
    "success": true,
    "is_available": true,
    "message": "Menu status updated"
}
```

---

## 4. Table Management

### 4.1 Add Table

**Endpoint**: `GET /owner/kelola-meja` (form), `POST /owner/kelola-meja/store` (save)

**Form Fields:**
```
- Table Number (required, string, max:10)
- Capacity (required, integer, min:1, max:20)
```

**Validasi:**
```php
'table_number' => 'required|string|max:10|unique:tables,table_number,NULL,id,restaurant_id,' . $restaurantId,
'capacity' => 'required|integer|min:1|max:20',
```

**Proses:**
1. Validate input
2. Check duplicate table number dalam restaurant
3. Create table record
4. Return success response

---

### 4.2 Edit Table

**Endpoint**: `POST /owner/kelola-meja/{id}/update`

**Form Fields:** Same as Add Table

**Proses:**
1. Fetch table record
2. Validate ownership
3. Validate input (check duplicate exclude current)
4. Update table
5. Return success response

---

### 4.3 Delete Table

**Endpoint**: `POST /owner/kelola-meja/{id}/delete`

**Proses:**
1. Fetch table record
2. Validate ownership
3. Check if table punya active reservations
   - Jika ya: Return error, show warning
   - Jika tidak: Proceed delete
4. Delete table record

**Error Response:**
```json
{
    "success": false,
    "message": "Cannot delete table with active reservations",
    "data": {
        "active_reservations": 2
    }
}
```

---

### 4.4 View Table List

**Endpoint**: `GET /owner/kelola-meja`

**Menampilkan:**
- Table dengan columns:
  - Table Number
  - Capacity
  - Status (Available/Booked)
  - Next Reservation
  - Actions (Edit, Delete)
- Summary: Total tables, Available, Booked

**Real-time Status:**
```php
foreach ($tables as $table) {
    $today = now()->toDateString();
    $todayReservations = Reservation::where('table_id', $table->id)
        ->whereDate('reservation_date', $today)
        ->where('status', '!=', 'rejected')
        ->orderBy('time')
        ->get();
    
    $table->status = $todayReservations->isEmpty() ? 'available' : 'booked';
    $table->next_reservation = $todayReservations->first();
}
```

---

## 5. Reservation System

### 5.1 Customer Create Reservation

**Endpoint**: `GET /restaurant/{id}/detail` (view), `POST /reservasi/store` (create)

**Step 1: View Restaurant Detail**
```
GET /restaurant/{id}/detail
├─ Restaurant info
├─ Menu list
├─ Available dates (next 30 days)
└─ Operational hours
```

**Step 2: Fill Reservation Form**
```
Form Fields:
- Reservation Date (datepicker, min: today, max: 30 days)
- Reservation Time (timepicker, based on operational hours)
- Number of Guests (spinner, min:1, max: max table capacity)
- Table Selection (if multiple available)
- Menu Items (multiselect checkboxes)
- Special Notes (textarea, optional)
```

**Validasi:**
```php
'reservation_date' => 'required|date|after_or_equal:today|before_or_equal:' . now()->addDays(30),
'time' => 'required|date_format:H:i|between:' . $operationalHours,
'guests' => 'required|integer|min:1',
'table_id' => 'required|exists:tables,id',
'menu_ids' => 'required|array|min:1',
'menu_ids.*' => 'exists:menus,id',
'notes' => 'nullable|string|max:500',
```

**Proses:**
1. Validate input
2. Check table availability pada tanggal & waktu tersebut
3. Generate booking code: `BK` + timestamp
4. Create reservation record
5. Attach menu items (pivot table)
6. Calculate total price (sum menu prices)
7. Create booking record
8. Redirect ke checkout

---

### 5.2 View Reservation Details (Owner)

**Endpoint**: `GET /owner/reservasi/{id}`

**Menampilkan:**
```
Reservation Details:
├─ Customer Info
│  ├─ Name, Email, Phone
│  └─ Number of previous visits
├─ Booking Info
│  ├─ Booking Code
│  ├─ Date & Time
│  ├─ Number of Guests
│  ├─ Table Number
│  └─ Total Price
├─ Menu Items
│  └─ List dengan quantities
├─ Special Notes
└─ Status & Timeline
   ├─ Created at
   ├─ Confirmed/Rejected at
   └─ Current status
```

**Actions:**
- Approve (if pending)
- Reject (if pending)
- Mark Attended (if confirmed & past time)
- Mark No-Show (if confirmed & past time)
- Cancel (if not completed)

---

### 5.3 Approve Reservation

**Endpoint**: `POST /owner/reservasi/{id}/approve`

**Proses:**
1. Fetch reservation
2. Validate status = 'pending'
3. Update status ke 'confirmed'
4. Send email ke customer:
   ```
   Subject: Reservasi Confirmed! 
   
   Reservasi Anda telah di-confirm!
   
   Details:
   - Restaurant: [Name]
   - Date: [Date]
   - Time: [Time]
   - Guests: [Number]
   - Table: [Number]
   - Booking Code: [Code]
   - Total Price: [Price]
   
   Silakan datang tepat waktu!
   ```
5. Return success response

---

### 5.4 Reject Reservation

**Endpoint**: `POST /owner/reservasi/{id}/reject`

**Request:**
```json
{
    "reason": "Fully booked on that date"
}
```

**Proses:**
1. Fetch reservation
2. Validate status = 'pending'
3. Update status ke 'rejected'
4. Save rejection reason
5. Process refund via Midtrans
6. Send email ke customer:
   ```
   Subject: Reservasi Rejected ❌
   
   Mohon maaf, reservasi Anda ditolak.
   
   Reason: [Rejection Reason]
   
   Refund akan diproses dalam 1-3 hari kerja.
   
   Silakan coba booking tanggal lain.
   ```
7. Return success response

---

### 5.5 Mark Attendance

**Endpoint**: `POST /owner/reservasi/{id}/checkin`

**Proses:**
1. Owner scan booking code OR click button
2. System verify booking code valid & not already checked in
3. Update status ke 'checked_in'
4. Send email ke customer (optional)
5. Return success

**Alternative: QR Code Scanning**
```
- Generate QR code dari booking code
- Owner scan dengan device/app
- System auto update status
```

---

## 6. Payment & Booking

### 6.1 Checkout Page

**Endpoint**: `GET /booking/checkout/{booking_code}`

**Menampilkan:**
```
Checkout Summary:
├─ Restaurant Info
├─ Booking Details
│  ├─ Date, Time, Guests
│  ├─ Table Number
│  └─ Menu Items
├─ Price Breakdown
│  ├─ Menu Price
│  ├─ Tax (if any)
│  └─ Total
└─ Payment Button (Powered by Midtrans)
```

**Generate Midtrans Token:**
```php
$snapToken = Snap::getSnapToken([
    'transaction_details' => [
        'order_id' => $booking->booking_code,
        'gross_amount' => $booking->total_price,
    ],
    'customer_details' => [
        'first_name' => $customer->name,
        'email' => $customer->email,
        'phone' => $customer->phone,
    ],
    'items_details' => [
        [
            'id' => 'RESERVATION_' . $reservation->id,
            'price' => $booking->total_price,
            'quantity' => 1,
            'name' => 'Restaurant Reservation'
        ]
    ],
]);
```

---

### 6.2 Midtrans Payment Gateway

**Integration:**
- Library: midtrans/midtrans-php
- Mode: Snap (Embedded payment form)
- Payment Methods:
  - Bank Transfer
  - E-wallet (QRIS, OVO, Dana, LinkAja, etc)
  - Credit Card
  - Virtual Account

**Frontend Integration:**
```html
<script src="https://app.midtrans.com/snap/snap.js"></script>

<script type="text/javascript">
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            // Payment success
            window.location.href = '/booking/success/{{ $bookingCode }}';
        },
        onPending: function(result){
            // Payment pending
            console.log(result);
        },
        onError: function(result){
            // Payment error
            alert('Payment failed');
        },
        onClose: function(){
            alert('You closed the popup without finishing the payment');
        }
    });
</script>
```

---

### 6.3 Payment Webhook Handler

**Endpoint**: `POST /midtrans/notification`

**Proses:**
```php
public function handleNotification(Request $request) {
    $payload = $request->all();
    
    // Verify signature
    $serverKey = config('midtrans.server_key');
    $signature = $payload['signature_key'];
    $hash = hash('sha512', 
        $payload['order_id'] . 
        $payload['status_code'] . 
        $payload['gross_amount'] . 
        $serverKey
    );
    
    if ($hash !== $signature) {
        return response('Invalid signature', 403);
    }
    
    // Get booking
    $booking = Booking::where('booking_code', $payload['order_id'])->first();
    
    if (!$booking) {
        return response('Order not found', 404);
    }
    
    // Update status based on transaction status
    $transactionStatus = $payload['transaction_status'];
    
    switch ($transactionStatus) {
        case 'capture':
        case 'settlement':
            $booking->status = 'success';
            $booking->transaction_id = $payload['transaction_id'];
            $booking->payment_method = $payload['payment_type'];
            $booking->save();
            
            // Update reservation status
            $reservation = Reservation::where(
                'booking_code', 
                $booking->booking_code
            )->first();
            $reservation->status = 'confirmed';
            $reservation->save();
            
            // Send email notifications
            // ...
            break;
            
        case 'pending':
            $booking->status = 'pending';
            $booking->save();
            break;
            
        case 'deny':
        case 'expire':
        case 'cancel':
            $booking->status = 'failed';
            $booking->save();
            
            // Process refund if needed
            // ...
            break;
    }
    
    return response('OK', 200);
}
```

---

### 6.4 Payment Success Page

**Endpoint**: `GET /booking/success/{booking_code}`

**Menampilkan:**
```
Success Confirmation:
├─  Payment Success message
├─ Booking Details
│  ├─ Booking Code (big)
│  ├─ Restaurant Name
│  ├─ Date & Time
│  ├─ Guests & Table
│  └─ Total Paid
├─ What's Next?
│  └─ "Owner akan confirm reservasi Anda dalam 2 jam"
└─ Action Buttons
   ├─ View Reservation
   ├─ Back to Home
   └─ Download Receipt (PDF)
```

---

## 7. Admin Dashboard

### 7.1 Dashboard Overview

**Endpoint**: `GET /admin/dashboard`

**Menampilkan:**
```
KPIs:
├─ Total Users
├─ Total Restaurants (Active/Pending/Rejected)
├─ Total Reservations (This Month)
└─ Total Revenue (This Month)

Charts:
├─ Reservations Trend (30 hari)
├─ Revenue Trend (30 hari)
├─ Users by Role
└─ Restaurants by Status

Recent Activities:
├─ New users (last 5)
├─ New restaurants (pending)
├─ New reservations (last 5)
└─ Recent payments

Quick Actions:
├─ Approve pending restaurants
├─ Manage users
├─ View all restaurants
└─ Export data
```

---

### 7.2 User Management

**Endpoint**: `GET /admin/users`

**Menampilkan:**
- Table dengan columns:
  - User ID
  - Name
  - Email
  - Role
  - Created At
  - Status (Active/Inactive)
  - Actions (Edit, Delete, View)

**Search & Filter:**
- By name/email
- By role (Admin, Owner, Customer)
- By status
- By registration date range

**Edit User:**
- Endpoint: `PUT /admin/users/{id}`
- Fields: Name, Email, Role, Status
- Cannot edit own role/status

**Delete User:**
- Endpoint: `DELETE /admin/users/{id}`
- Soft delete (set deleted_at)
- Preserve historical data
- Send notification email

---

### 7.3 Restaurant Management

**Endpoint**: `GET /admin/restaurants`

**Menampilkan:**
- Table dengan columns:
  - Restaurant Name
  - Owner Name
  - City
  - Status (Pending/Active/Rejected)
  - Created At
  - Actions (Approve, Reject, Edit, Delete)

**Approve Restaurant:**
- Endpoint: `PATCH /admin/restaurants/{id}/approve`
- Update status ke 'active'
- Send email ke owner

**Reject Restaurant:**
- Endpoint: `PATCH /admin/restaurants/{id}/reject`
- Form: Rejection reason
- Update status ke 'rejected'
- Send email ke owner

**Edit Restaurant:**
- Endpoint: `PUT /admin/restaurants/{id}`
- Fields: Name, Description, Address, Phone, City
- Cannot edit owner

---

## 8. Owner Dashboard

Sudah dijelaskan di section Restaurant Management

---

## 9. Customer Interface

### 9.1 Browse Restaurants

**Endpoint**: `GET /` or `GET /restaurants/all`

**Menampilkan:**
```
Restaurant Listing:
├─ Search bar
├─ Filter/Sort options
│  ├─ City filter
│  ├─ Rating sort
│  └─ Price range
└─ Restaurant Cards (Grid)
   ├─ Restaurant Image
   ├─ Name & Rating
   ├─ Location
   ├─ Price Range
   └─ CTA Button (View Details)
```

**Query dengan pagination:**
```php
$restaurants = Restaurant::where('status', 'active')
    ->when($city, fn($q) => $q->where('city', $city))
    ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
    ->when($sort === 'rating', fn($q) => $q->orderBy('rating', 'desc'))
    ->when($sort === 'price', fn($q) => $q->orderBy('avg_price', 'asc'))
    ->orderBy('created_at', 'desc')
    ->paginate(12);
```

---

### 9.2 Restaurant Detail & Menu

**Endpoint**: `GET /restaurant/{id}/detail`

**Menampilkan:**
```
Restaurant Header:
├─ Large banner image
├─ Restaurant name
├─ Rating & review count
├─ Location & phone
└─ Operational hours

Menu Section:
├─ Category tabs (Appetizer, Main, Dessert, Drink)
├─ Menu items grid
│  ├─ Image, name, description
│  ├─ Price
│  └─ Add to order button

Make Reservation Section:
├─ Reservation form
├─ Price summary
└─ Proceed to checkout button

Reviews Section:
├─ Average rating display
├─ Individual reviews with ratings
└─ Pagination
```

---

### 9.3 View Reservations

**Endpoint**: `GET /reservations`

**Menampilkan:**
```
Reservations List:
├─ Filter by status (All, Pending, Confirmed, Completed)
├─ Search by restaurant name
└─ Cards/Table view

Each Reservation shows:
├─ Restaurant name
├─ Booking code
├─ Date & time
├─ Guests & table
├─ Status badge
├─ Total price
└─ Actions (View details, Cancel)
```

**Queries:**
```php
$reservations = Reservation::where('user_id', Auth::id())
    ->when($status !== 'all', fn($q) => $q->where('status', $status))
    ->when($search, fn($q) => $q->whereHas('restaurant', 
        fn($r) => $r->where('name', 'like', "%{$search}%")))
    ->with(['restaurant', 'table'])
    ->orderBy('reservation_date', 'desc')
    ->paginate(10);
```

---

**Last Updated**: 2026-06-14
