# 🔧 Troubleshooting & Referensi Cepat RestoBook

Dokumen ini berisi panduan troubleshooting masalah umum dan referensi cepat untuk development.

---

## 📑 Daftar Isi

1. [Troubleshooting Umum](#troubleshooting-umum)
2. [Debugging Tips](#debugging-tips)
3. [Database Issues](#database-issues)
4. [Authentication Issues](#authentication-issues)
5. [Payment Issues](#payment-issues)
6. [Email Issues](#email-issues)
7. [File Upload Issues](#file-upload-issues)
8. [Performance Issues](#performance-issues)
9. [Command References](#command-references)
10. [Useful Code Snippets](#useful-code-snippets)

---

## Troubleshooting Umum

### Error 500 - Internal Server Error

**Penyebab Umum:**
1. Database connection error
2. Undefined variable atau method
3. File not found (missing migration, view, etc)
4. Permission error pada storage directory

**Solusi:**
```bash
# 1. Check error log
tail -f storage/logs/laravel.log

# 2. Enable debug mode
# Edit .env
APP_DEBUG=true

# 3. Check database connection
php artisan tinker
>>> DB::connection()->getPDO()

# 4. Fix permission
chmod -R 775 storage bootstrap/cache

# 5. Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

---

### Error 404 - Not Found

**Penyebab:**
1. Route tidak terdaftar
2. Resource doesn't exist
3. View file not found

**Solusi:**
```bash
# 1. Check routes
php artisan route:list

# 2. Check route specific
php artisan route:list | grep "reservation"

# 3. Verify view files exist
ls -la resources/views/owner/

# 4. Check model relationships
# If accessing $model->relation dan error
# Verify relationship defined di model
```

---

### Error 403 - Unauthorized

**Penyebab:**
1. User role tidak memiliki permission
2. Middleware blocking request
3. Policy check failed

**Solusi:**
```php
// Check role
Auth::user()->role // Should return: admin, owner, customer

// Check middleware di route
Route::middleware(['auth', 'role:owner'])->group(function() {
    // Routes hanya untuk owner
});

// Manual authorization
if (Auth::user()->role !== 'admin') {
    abort(403, 'Unauthorized');
}
```

---

### Blank Page / White Screen

**Penyebab:**
1. PHP parse error (syntax error)
2. Out of memory
3. Infinite loop

**Solusi:**
```bash
# 1. Check PHP error log
cat /var/log/apache2/error.log

# 2. Check Laravel log
tail -f storage/logs/laravel.log

# 3. Enable error display (development only!)
# Edit php.ini
display_errors = On
error_reporting = E_ALL

# 4. Check for infinite loops
# Add die/dd statements untuk trace execution
dd('Reached here');

# 5. Increase PHP memory limit
# Edit .env atau php.ini
memory_limit = 256M
```

---

## Debugging Tips

### Using dd() dan dump()

```php
// dd() - dump and die
dd($variable); // Print dan stop execution

// dump() - dump tanpa stop
dump($variable);

// Multiple dumps
dd($var1, $var2, $var3);

// Dump query
$query = User::where('role', 'owner');
dd($query->toSql(), $query->getBindings());
```

---

### Using Log

```php
use Illuminate\Support\Facades\Log;

// Log levels: emergency, alert, critical, error, warning, notice, info, debug
Log::debug('Debug message', ['user_id' => 1]);
Log::info('User created', ['user' => $user]);
Log::warning('Deprecation warning');
Log::error('Error occurred', ['exception' => $e]);

// View logs
tail -f storage/logs/laravel.log

// Watch logs real-time
php artisan tail
```

---

### Using Laravel Tinker

```bash
php artisan tinker

# Get user
>>> $user = User::find(1);
>>> $user->role

# Get restaurant
>>> $restaurant = Restaurant::first();
>>> $restaurant->menus()->count()

# Test query
>>> User::where('role', 'owner')->count()

# Execute function
>>> auth()->user()

# Create test data
>>> User::factory()->create()

# Exit tinker
>>> exit
```

---

### Using Debugbar

```php
// Install debugbar
composer require barryvdh/laravel-debugbar --dev

// Enable di .env
APP_DEBUG=true

// Debugbar akan muncul di bottom halaman development

// Manual add message
Debugbar::info('Some info');
Debugbar::error('Error message');
Debugbar::addMeasure('operation', $start_time, $end_time);
```

---

## Database Issues

### Migration Failed

```bash
# Error: Migration already exists
# Solution: Check if migration already run
php artisan migrate:status

# Rollback last migration
php artisan migrate:rollback --step=1

# Rollback all
php artisan migrate:rollback

# Run fresh
php artisan migrate:fresh

# Dengan seeder
php artisan migrate:fresh --seed

# Fresh production database (DANGEROUS!)
php artisan migrate:fresh --force
```

---

### Database Connection Error

```bash
# Test connection
php artisan tinker
>>> DB::connection()->getPDO()

# Check .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=restobook
# DB_USERNAME=root
# DB_PASSWORD=

# Restart MySQL
service mysql restart
# atau
systemctl restart mysql

# Check MySQL status
systemctl status mysql
```

---

### Duplicate Entry Error

```php
// Check if record exists before create
$user = User::firstOrCreate(
    ['email' => $email],
    ['name' => $name, 'password' => bcrypt($password)]
);

// Or use updateOrCreate
$user = User::updateOrCreate(
    ['email' => $email],
    ['name' => $name, 'password' => bcrypt($password)]
);

// Or check before insert
if (!User::where('email', $email)->exists()) {
    User::create($data);
}
```

---

### Query Performance Issue

```php
// Bad: N+1 problem
$restaurants = Restaurant::all();
foreach ($restaurants as $r) {
    echo $r->owner->name; // Query setiap iterasi
}

// Good: Eager load
$restaurants = Restaurant::with('owner')->get();

// Multiple relations
$reservations = Reservation::with(['customer', 'restaurant', 'table'])
    ->get();

// Nested relations
$restaurants = Restaurant::with('menus', 'tables', 'reservations.customer')
    ->get();

// Check query count
\DB::enableQueryLog();
$data = Restaurant::with('owner')->get();
dd(count(\DB::getQueryLog()));
```

---

## Authentication Issues

### Google OAuth Not Working

```bash
# 1. Check .env
GOOGLE_CLIENT_ID=your_id
GOOGLE_CLIENT_SECRET=your_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

# 2. Verify Google Console settings
# - Credentials set correctly
# - Redirect URI whitelisted
# - Scopes configured

# 3. Check Socialite configuration
# config/services.php
'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_REDIRECT_URI'),
],

# 4. Clear config cache
php artisan config:cache

# 5. Test redirect
php artisan tinker
>>> Socialite::driver('google')->redirect()
```

---

### Email Verification Not Working

```bash
# 1. Check email configuration .env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@restobook.local

# 2. Test email send
php artisan tinker
>>> Mail::raw('Test email', function($m) {
>>>   $m->to('your@email.com');
>>> });

# 3. Check notification
# Is user marked as verified?
>>> User::first()->email_verified_at

# 4. Resend verification
# Route: POST /email/verification-notification
```

---

### Password Reset Not Working

```bash
# 1. Check database
# Table: password_reset_tokens
>>> DB::table('password_reset_tokens')->get()

# 2. Check email
# Verify reset link in email

# 3. Clear cache
php artisan cache:clear

# 4. Test manually
php artisan tinker
>>> $token = Password::createToken($user);
>>> echo $token;
```

---

## Payment Issues

### Midtrans Connection Failed

```bash
# 1. Check credentials .env
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false

# 2. Verify keys dari Midtrans Dashboard
# Development/Sandbox mode keys

# 3. Test connection
php artisan tinker
>>> $config = \Midtrans\Config::$serverKey
>>> echo $config

# 4. Test payment
>>> $snap = new \Midtrans\Snap();
>>> $token = $snap->getSnapToken([...])
```

---

### Payment Webhook Not Received

```bash
# 1. Check webhook endpoint
# POST /midtrans/notification accessible

# 2. Verify webhook URL di Midtrans Dashboard
# Settings → Webhooks

# 3. Check logs
tail -f storage/logs/laravel.log

# 4. Test webhook manually
curl -X POST http://localhost:8000/midtrans/notification \
  -d '{"order_id":"BK123","transaction_status":"settlement"}'

# 5. Check if route protected
# Remove auth middleware jika needed
Route::post('/midtrans/notification', [BookingController::class, 'handleNotification']);
```

---

### Payment Status Not Updating

```php
// Debug webhook handler
public function handleNotification(Request $request) {
    Log::info('Webhook received', $request->all());
    
    $booking = Booking::where('booking_code', $request->order_id)->first();
    Log::info('Booking found', ['booking' => $booking]);
    
    // Update status
    $booking->status = 'success';
    $booking->save();
    
    Log::info('Booking updated', ['booking' => $booking->fresh()]);
}

// Check logs
tail -f storage/logs/laravel.log
```

---

## Email Issues

### Email Not Sending

```bash
# 1. Check SMTP configuration
# Test connection
php artisan tinker
>>> Mail::mailer('smtp')->raw('Test', function($m) {
>>>   $m->to('test@example.com');
>>> });

# 2. Check firewall/ports
# SMTP usually needs port 587 (TLS) or 465 (SSL)

# 3. Check credentials
# Username & password correct?

# 4. Use Mailtrap for testing
# Free service untuk testing emails

# 5. Check email logs
tail -f storage/logs/laravel.log

# 6. Queue configuration
# If using queue, check queue worker
php artisan queue:work
```

---

### Email HTML Format Issues

```php
// Ensure email uses markdown
Mail::mailable(new VerifyEmail($user))->send();

// In mailable class
public function build() {
    return $this->markdown('emails.verify');
}

// Or use HTML
public function build() {
    return $this->html('<h1>Hello</h1>');
}
```

---

## File Upload Issues

### File Upload Failed

```bash
# 1. Check storage directory permissions
chmod -R 775 storage/app/public

# 2. Check upload_max_filesize
php -i | grep upload_max_filesize
# Edit php.ini if needed

# 3. Check disk configuration config/filesystems.php
'local' => [
    'driver' => 'local',
    'root' => storage_path('app'),
    'url' => env('APP_URL').'/storage',
    'visibility' => 'private',
],

# 4. Create storage link
php artisan storage:link

# 5. Test upload
php artisan tinker
>>> Storage::disk('public')->put('test.txt', 'content')
```

---

### Image Not Displaying

```bash
# 1. Check storage link exists
ls -la public/storage

# 2. Create link if missing
php artisan storage:link

# 3. Check file permissions
ls -la storage/app/public/

# 4. Verify path in database
# SELECT image FROM restaurants LIMIT 1;

# 5. Check URL format
# Should be: /storage/filename.jpg
# Not: storage/filename.jpg
```

---

## Performance Issues

### Slow Page Load

```php
// 1. Enable query logging
\DB::enableQueryLog();

// 2. Run code
$restaurants = Restaurant::with('owner', 'menus', 'tables')
    ->where('status', 'active')
    ->paginate(20);

// 3. Check queries
$queries = \DB::getQueryLog();
dd(count($queries), $queries);

// 4. Optimize with caching
$restaurants = Cache::remember('restaurants.active', 3600, function() {
    return Restaurant::with('owner', 'menus')
        ->where('status', 'active')
        ->get();
});

// 5. Add database indexes
Schema::table('restaurants', function (Blueprint $table) {
    $table->index('status');
    $table->index('user_id');
});
```

---

### High Memory Usage

```bash
# 1. Check memory limit
php -i | grep memory_limit

# 2. Find memory heavy operations
// Bad: Loading all in memory
$users = User::all(); // Load semua ke memory

// Good: Use chunks
User::chunk(100, function ($users) {
    foreach ($users as $user) {
        // Process
    }
});

// 3. Use lazy loading
$users = User::lazy(); // Generator, tidak load semua
foreach ($users as $user) {
    // Process one by one
}

# 4. Increase memory (temporary)
php -d memory_limit=512M artisan command
```

---

## Command References

### Artisan Commands Umum

```bash
# Database
php artisan migrate                 # Run migrations
php artisan migrate:fresh           # Reset & run
php artisan migrate:fresh --seed    # Reset, run, seed
php artisan migrate:rollback        # Undo last
php artisan db:seed                 # Run seeders
php artisan db:seed --class=UserSeeder

# Cache
php artisan cache:clear             # Clear all cache
php artisan cache:forget key_name   # Clear specific
php artisan cache:table             # Create table

# Config
php artisan config:clear            # Clear config cache
php artisan config:cache            # Create cache

# View
php artisan view:clear              # Clear view cache
php artisan view:cache              # Create cache

# Route
php artisan route:clear             # Clear route cache
php artisan route:cache             # Create cache
php artisan route:list              # List all routes

# Model
php artisan make:model ModelName -m      # Model + Migration
php artisan make:model ModelName -mfsc   # Model + Migration + Factory + Seeder + Controller

# Controller
php artisan make:controller ControllerName
php artisan make:controller ControllerName --resource
php artisan make:controller Admin/DashboardController

# Migration
php artisan make:migration create_table_name
php artisan make:migration add_column_to_table_name

# Middleware
php artisan make:middleware MiddlewareName

# Mail
php artisan make:mail MailClassName

# Storage
php artisan storage:link            # Create public link

# Tinker
php artisan tinker                  # Interactive shell

# Testing
php artisan test                    # Run tests
php artisan test tests/Feature/AuthTest.php

# Queue
php artisan queue:work              # Process jobs
php artisan queue:failed            # Show failed jobs
php artisan queue:retry all         # Retry failed

# Telescope (debugging)
php artisan telescope:publish       # Publish assets
php artisan telescope:clear         # Clear data
```

---

### Composer Commands

```bash
composer install                    # Install dependencies
composer update                     # Update packages
composer require package/name       # Add package
composer remove package/name        # Remove package
composer dump-autoload              # Refresh autoloader
composer show                       # List packages
composer check                      # Check security
```

---

### NPM Commands

```bash
npm install                         # Install dependencies
npm update                          # Update packages
npm run dev                         # Dev build with watch
npm run build                       # Production build
npm run lint                        # Lint JavaScript
npm run format                      # Format code
```

---

## Useful Code Snippets

### Authentication Check

```php
// In controller
if (Auth::check()) {
    // User is logged in
    $user = Auth::user();
}

// Check role
if (Auth::user()->role === 'admin') {
    // Admin only
}

// Middleware check
Route::middleware('auth')->group(function() {
    // Authenticated only
});

Route::middleware(['auth', 'role:owner'])->group(function() {
    // Authenticated AND owner only
});
```

---

### Query Helpers

```php
// Get by ID
$user = User::find(1);
$user = User::findOrFail(1);

// Get first/all
$first = User::first();
$all = User::all();

// Where conditions
$users = User::where('role', 'admin')->get();
$users = User::where('role', '!=', 'customer')->get();
$users = User::whereIn('role', ['admin', 'owner'])->get();
$users = User::whereBetween('created_at', [$start, $end])->get();

// Relationships
$restaurants = $user->restaurants;
$owner = $restaurant->owner;

// Count
$count = User::count();
$count = User::where('role', 'admin')->count();

// Pagination
$users = User::paginate(15);
$users = User::where('role', 'admin')->paginate(20);

// Ordering
$users = User::orderBy('name', 'asc')->get();
$users = User::latest('created_at')->get();
$users = User::oldest('created_at')->get();

// Distinct
$roles = User::distinct()->pluck('role');

// Aggregates
$count = User::count();
$max = User::max('id');
$min = User::min('created_at');
$sum = Reservation::sum('total_price');
$avg = Reservation::avg('guests');
```

---

### Creating & Updating

```php
// Create
$user = User::create([
    'name' => 'John',
    'email' => 'john@example.com',
    'password' => bcrypt('password'),
    'role' => 'customer'
]);

// Update
$user->update(['name' => 'Jane']);

// Or
User::find(1)->update(['name' => 'Jane']);

// First or create
$user = User::firstOrCreate(
    ['email' => 'john@example.com'],
    ['name' => 'John', 'role' => 'customer']
);

// Update or create
$user = User::updateOrCreate(
    ['email' => 'john@example.com'],
    ['name' => 'John Doe', 'role' => 'customer']
);

// Mass update
User::where('role', 'customer')->update(['verified' => true]);
```

---

### Error Handling

```php
// Try catch
try {
    $result = SomeClass::doSomething();
} catch (Exception $e) {
    Log::error('Error: ' . $e->getMessage());
    return response()->json(['error' => 'Something went wrong'], 500);
}

// Abort
abort(404); // Not found
abort(403); // Unauthorized
abort(500, 'Server error');
abort_if(!Auth::user()->isAdmin(), 403);
abort_unless(Auth::check(), 401);

// Response with error
return response()->json(['error' => 'Invalid input'], 400);
return back()->with('error', 'Something went wrong');
return redirect('/')->withErrors(['email' => 'Email not found']);
```

---

### File Operations

```php
use Illuminate\Support\Facades\Storage;

// Store file
$path = Storage::disk('public')->put('restaurants', $file);

// Get URL
$url = Storage::disk('public')->url($path);

// Check exists
if (Storage::disk('public')->exists($path)) {
    // File exists
}

// Delete
Storage::disk('public')->delete($path);

// Get content
$content = Storage::disk('public')->get('file.txt');
```

---

### Validation

```php
$validated = $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|unique:users',
    'password' => 'required|min:8|confirmed',
    'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
    'age' => 'integer|between:1,120',
    'date' => 'date|after:today',
    'price' => 'numeric|min:0',
    'image' => 'image|mimes:jpeg,png|max:2048',
    'items' => 'array|min:1',
    'items.*' => 'integer|exists:items,id',
]);

// Custom messages
$messages = [
    'name.required' => 'Nama tidak boleh kosong',
    'email.unique' => 'Email sudah terdaftar',
];
$validated = $request->validate([...], $messages);

// Custom rules
Validator::extend('uppercase', function($attribute, $value) {
    return $value === strtoupper($value);
});
```

---

### Sending Responses

```php
// JSON response
return response()->json(['success' => true, 'data' => $data]);
return response()->json(['error' => 'Not found'], 404);

// Redirect
return redirect('/home');
return redirect()->route('home');
return redirect()->back();
return redirect('/home')->with('success', 'Berhasil!');
return redirect()->back()->withErrors(['email' => 'Email tidak ditemukan']);

// View
return view('home', ['data' => $data]);
return view('dashboard.index', compact('user', 'restaurants'));

// Download
return response()->download('path/to/file.pdf');

// File response
return response()->file('path/to/file.pdf');

// Streaming
return response()->stream(function() {
    echo 'Hello world';
});
```

---

### Logging

```php
use Illuminate\Support\Facades\Log;

Log::debug('Debug message');
Log::info('Info message');
Log::notice('Notice message');
Log::warning('Warning message');
Log::error('Error message');
Log::critical('Critical message');
Log::alert('Alert message');
Log::emergency('Emergency message');

// With context
Log::info('User created', ['user_id' => $user->id, 'email' => $user->email]);

// Channel specific
Log::channel('slack')->error('Error occurred!');
Log::stack(['single', 'slack'])->error('Error!');
```

---

**Last Updated**: 2026-06-14

---

## Tips Tambahan

### Development Best Practices

1. **Selalu validate input** - Jangan percaya user input
2. **Use prepared statements** - Prevent SQL injection
3. **Hash passwords** - Gunakan bcrypt
4. **Log important events** - Track user actions
5. **Use transactions** - For multi-step operations
6. **Cache aggressively** - Reduce database queries
7. **Monitor performance** - Use profiling tools
8. **Security headers** - CSRF, XSS protection
9. **Rate limiting** - Prevent abuse
10. **Test thoroughly** - Unit & feature tests

### Security Checklist

- [ ] Validate semua input
- [ ] Use CSRF tokens
- [ ] Implement rate limiting
- [ ] Hash passwords dengan bcrypt
- [ ] Use HTTPS only
- [ ] Sanitize output (XSS prevention)
- [ ] Implement authorization checks
- [ ] Log security events
- [ ] Use environment variables untuk secrets
- [ ] Keep dependencies updated

---

**Untuk pertanyaan lebih lanjut, silakan baca dokumentasi lengkap di DOKUMENTASI.md**
