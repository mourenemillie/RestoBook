# ⚡ Quick Reference & Cheat Sheet RestoBook

Dokumen singkat untuk referensi cepat saat development.

---

## 🚀 Setup Quick Start

```bash
composer install && npm install
cp .env.example .env && php artisan key:generate
php artisan migrate:fresh --seed
npm run dev
php artisan serve
```

---

## 📁 Key File Locations

| File/Folder | Purpose |
|------------|---------|
| `app/Http/Controllers/` | Controllers untuk all features |
| `app/Models/` | Database models |
| `routes/web.php` | Web routes |
| `database/migrations/` | Schema changes |
| `database/seeders/` | Initial data |
| `resources/views/` | Blade templates |
| `config/` | Configuration files |
| `storage/logs/` | Error logs |
| `.env` | Environment variables |

---

## 🗄️ Database Models

```
User → Restaurant → Tables
           ↓
          Menu
           ↓
    Reservation → Booking
```

**Key Tables:**
- `users` - Users with roles (admin, owner, customer)
- `restaurants` - Restaurant data
- `tables` - Dining tables per restaurant
- `menus` - Menu items
- `reservations` - Customer bookings
- `bookings` - Payment records
- `settings` - Configuration

---

## 🔑 Key Controllers

### Public
- `RestaurantController` - Landing, detail, browse

### Admin  
- `Admin/DashboardController` - Analytics & stats
- `Admin/UserController` - User management
- `Admin/RestaurantController` - Approve restaurants
- `Admin/SettingController` - System settings

### Owner
- `Owner/DashboardController` - Owner stats
- `Owner/ReservationController` - Manage reservations
- `Owner/TableController` - Manage tables
- `Owner/MenuController` - Manage menus
- `Owner/SettingController` - Restaurant settings

### Customer
- `Customer/HomeController` - Customer dashboard
- `Customer/ReservationController` - Make reservations

### Utility
- `BookingController` - Payment handling
- `AuthController` - Login/Register/OAuth

---

## 🔐 Routes Structure

### Public
```
GET  /                          Landing
GET  /restaurant/{id}/detail     Detail
```

### Auth
```
GET|POST /login                 Login
GET|POST /register              Register
GET /auth/google                OAuth
GET /auth/google/callback       OAuth callback
```

### Customer
```
GET  /home                      Dashboard
GET  /restaurants/all           Browse
GET  /reservations              History
POST /reservasi/store           Create reservation
```

### Owner (`prefix: /owner`)
```
GET  /dashboard                 Stats
GET  /reservasi                 List reservations
GET  /kelola-meja               Manage tables
GET  /tambah-menu               Manage menus
GET  /settings                  Settings
```

### Admin (`prefix: /admin`)
```
GET  /dashboard                 Analytics
GET  /users                     Manage users
GET  /restaurants               Manage restaurants
GET  /settings                  System settings
```

### Booking
```
POST /restaurant/booking        Create booking
GET  /booking/checkout/{code}   Checkout page
GET  /booking/success/{code}    Success page
POST /midtrans/notification     Payment webhook
```

---

## 🔄 Common Workflows

### Create Reservation
1. User submit form (date, time, guests, menus)
2. Create Reservation record
3. Generate booking code
4. Create Booking record
5. Redirect to checkout
6. Process Midtrans payment
7. Webhook updates status

### Approve Restaurant
1. Owner submit restaurant info
2. Status = 'pending'
3. Admin review
4. PATCH /admin/restaurants/{id}/approve
5. Status = 'active'
6. Send email to owner
7. Owner can setup

### Manage Menu
1. Owner POST /owner/tambah-menu/store
2. Validate input
3. Upload image
4. Save to database
5. Display in restaurant detail

---

## 📊 Key Data Models

### User
```php
$user->role              // 'admin', 'owner', 'customer'
$user->restaurants       // Owner's restaurants
$user->reservations      // Customer's reservations
```

### Restaurant
```php
$restaurant->owner       // User who owns
$restaurant->tables      // All tables
$restaurant->menus       // All menu items
$restaurant->status      // 'pending', 'active', 'rejected'
```

### Reservation
```php
$reservation->status     // 'pending', 'confirmed', 'rejected', etc
$reservation->booking_code  // Unique code
$reservation->restaurant // Related restaurant
$reservation->table      // Assigned table
$reservation->menus      // Selected items (pivot)
```

---

## 🛠️ Common Commands

```bash
# Database
php artisan migrate
php artisan migrate:fresh --seed
php artisan migrate:rollback

# Cache
php artisan cache:clear
php artisan config:cache

# Development
php artisan serve
php artisan tinker
php artisan test

# Make
php artisan make:model ModelName -m
php artisan make:controller ControllerName --resource
php artisan make:migration migration_name

# Queue
php artisan queue:work
php artisan queue:failed
```

---

## 💾 Environment Variables

```env
APP_NAME=RestoBook
APP_DEBUG=true              # false in production
APP_ENV=local               # production in prod
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=restobook
DB_USERNAME=root
DB_PASSWORD=

GOOGLE_CLIENT_ID=...
GOOGLE_CLIENT_SECRET=...

MIDTRANS_SERVER_KEY=...
MIDTRANS_CLIENT_KEY=...
MIDTRANS_IS_PRODUCTION=false

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=...
MAIL_PASSWORD=...
```

---

## 📝 Common Validations

```php
'name' => 'required|string|max:255',
'email' => 'required|email|unique:users',
'password' => 'required|min:8|confirmed',
'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
'date' => 'required|date|after:today',
'price' => 'required|numeric|min:0|max:999999.99',
'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
'status' => 'required|in:active,inactive,pending',
'role' => 'required|in:admin,owner,customer',
```

---

## 🔗 Important Relationships

```php
// One-to-Many
User -> hasMany(Restaurant)
Restaurant -> hasMany(Table)
Restaurant -> hasMany(Menu)
Restaurant -> hasMany(Reservation)

// Many-to-One
Restaurant -> belongsTo(User)
Reservation -> belongsTo(User)
Reservation -> belongsTo(Restaurant)

// Many-to-Many
Reservation <-> Menu (via reservation_menu pivot)
```

---

## 🐛 Debug Shortcuts

```php
dd($variable);              // Dump & die
dump($variable);            // Dump only
Log::info('Message', [$data]);
\DB::enableQueryLog();
dd(\DB::getQueryLog());

// In routes
Route::get('/debug', function() {
    dd(Auth::user(), DB::connection()->getPDO());
});
```

---

## 📱 Status Values

### Reservation Status
```
pending     → Waiting approval
confirmed   → Owner approved
rejected    → Owner rejected
checked_in  → Customer attended
no_show     → Customer didn't come
```

### Restaurant Status
```
pending     → Waiting admin approval
active      → Approved, can receive reservations
rejected    → Application rejected
```

### Booking Status
```
pending     → Payment not processed
success     → Payment successful
failed      → Payment failed/rejected
```

---

## 🎯 Middleware Shortcuts

```php
// Check authentication
middleware('auth')

// Check role
middleware('role:admin')
middleware('role:owner')
middleware('role:customer')

// Combine
middleware(['auth', 'role:owner'])

// Guest only
middleware('guest')

// Email verified
middleware('verified')
```

---

## 📤 Response Shortcuts

```php
// Redirect
return redirect('/home');
return redirect()->route('home');
return back();
return back()->with('success', 'Message');

// JSON
return response()->json(['success' => true]);
return response()->json(['error' => 'Failed'], 400);

// View
return view('page', ['data' => $data]);
```

---

## 🔑 Authentication Shortcuts

```php
// Check if authenticated
Auth::check()
Auth::user()
auth()->user()
\Auth::user()

// Check role
Auth::user()->role === 'admin'
Auth::user()->role === 'owner'

// Login
Auth::login($user)
Auth::loginUsingId(1)

// Logout
Auth::logout()

// Guard
Auth::guard('web')->user()
```

---

## 📊 Query Shortcuts

```php
// Get
User::find(1)
User::where('role', 'admin')->first()
User::all()
User::paginate(15)

// Where
User::where('status', 'active')
User::whereIn('role', ['admin', 'owner'])
User::whereBetween('age', [18, 65])

// Order
User::orderBy('name', 'asc')
User::latest('created_at')
User::oldest('created_at')

// Count
User::count()
User::where('role', 'admin')->count()

// Aggregate
User::max('id')
Reservation::sum('total_price')
Reservation::avg('guests')
```

---

## 🚨 Common Error Fixes

| Error | Fix |
|-------|-----|
| Call to undefined method | Check method exists in Model/Controller |
| Undefined variable | Check variable is set before use |
| Foreign key constraint | Check FK relationships in migration |
| CSRF token mismatch | Add `@csrf` in forms |
| File not found | Check file exists in `resources/views/` |
| Route not found | Check `php artisan route:list` |
| Column not found | Run migrations: `php artisan migrate` |
| Permission denied | Fix permissions: `chmod -R 775 storage/` |

---

## 💡 Performance Tips

1. **Eager load**: `User::with('restaurants')->get()`
2. **Use chunks**: `User::chunk(100, function($users) {...})`
3. **Cache queries**: `Cache::remember('key', 3600, fn => User::all())`
4. **Index columns**: Add `->index()` untuk frequently queried columns
5. **Limit results**: Use `->take(10)->get()` bukan `->get()`
6. **Select specific columns**: `->select(['id', 'name'])`

---

## 🔒 Security Tips

1. **Always validate**: `$request->validate([...])`
2. **Hash passwords**: `bcrypt($password)`
3. **Use prepared statements**: Eloquent does this automatically
4. **CSRF protection**: Add `@csrf` in forms
5. **Sanitize output**: `{{ $variable }}` (auto-escaped in Blade)
6. **Authorization**: Check `Auth::user()->role`
7. **Rate limiting**: Add throttle middleware untuk sensitive routes

---

## 📚 File Quick Access

**Configuration:**
- Database: `config/database.php`
- Auth: `config/auth.php`
- Mail: `config/mail.php`
- Services: `config/services.php`

**Migrations:**
- Users: `2014_10_12_000000_create_users_table.php`
- Restaurants: `2026_03_04_165455_create_restaurants_table.php`
- Menus: `2026_03_04_165519_create_menus_table.php`
- Reservations: `2026_03_04_165550_create_reservations_table.php`
- Bookings: `2026_05_25_005308_create_bookings_table.php`

**Tests:**
- Feature: `tests/Feature/`
- Unit: `tests/Unit/`

---

## 🎓 Learning Resources

- **Laravel Docs**: https://laravel.com/docs
- **Eloquent ORM**: https://laravel.com/docs/eloquent
- **Controllers**: https://laravel.com/docs/controllers
- **Blade Templates**: https://laravel.com/docs/blade
- **Validation**: https://laravel.com/docs/validation
- **Midtrans Docs**: https://docs.midtrans.com

---

## ⏰ Development Checklist

Before committing code:
- [ ] Test locally
- [ ] Check Laravel standards (`./vendor/bin/pint`)
- [ ] Run tests (`php artisan test`)
- [ ] Check for errors (`php artisan test --coverage`)
- [ ] Validate input
- [ ] Add proper error handling
- [ ] Add logging untuk tracking
- [ ] Update migrations jika ada schema changes
- [ ] Update relationships di models
- [ ] Add auth/authorization checks
- [ ] Test pada semua roles

---

## 🆘 When Stuck

1. **Check the logs** → `storage/logs/laravel.log`
2. **Read the error** → Understand what went wrong
3. **Search documentation** → [INDEX.md](INDEX.md)
4. **Use debugbar** → See queries & requests
5. **Try tinker** → Test code interactively
6. **Ask ChatGPT/Google** → Share exact error message

---

## 📞 Support Docs

- Setup: [DOKUMENTASI.md](DOKUMENTASI.md)
- Architecture: [ARSITEKTUR.md](ARSITEKTUR.md)
- Features: [FITUR_DETIL.md](FITUR_DETIL.md)
- Troubleshooting: [TROUBLESHOOTING.md](TROUBLESHOOTING.md)
- Index: [INDEX.md](INDEX.md)

---

**Last Updated**: 2026-06-14

Print this page atau save sebagai bookmark untuk quick access! 🚀
