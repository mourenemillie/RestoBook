<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboard;
use App\Http\Controllers\Owner\ReservationController as OwnerReservationController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\ReservationController as CustomerReservationController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\RestaurantController as AdminRestaurantController;
use App\Http\Controllers\Owner\SettingController as OwnerSettingController;
use App\Http\Controllers\Owner\TableController as OwnerTableController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route Landing Page (Sekarang mengarah ke folder restaurant/index)
Route::get('/', function () {
    if (auth()->check()) {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'owner' => redirect()->route('owner.dashboard'),
            default => redirect()->route('home'),
        };
    }

    // Mengubah dari view('landing') menjadi view('restaurant.index')
    return view('restaurant.index'); 
});

// Route Detail Restoran (Baru ditambahkan)
Route::get('/restaurant/detail', function () {
    return view('restaurant.show');
})->name('restaurant.show');

// --- AUTH ROUTES ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// --- ADMIN ROUTES ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');
});

// --- OWNER ROUTES ---
Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {
    Route::patch('/reservasi/{id}/hadir',
    [OwnerReservationController::class, 'hadir'])
    ->name('owner.reservasi.hadir');
Route::patch('/reservasi/{id}/tidak-hadir',
    [OwnerReservationController::class, 'tidakHadir'])
    ->name('owner.reservasi.tidak-hadir');
    Route::get('/reservasi/{id}', [OwnerReservationController::class, 'show'])
    ->name('owner.reservasi.show');
    Route::get('/dashboard', [OwnerDashboard::class, 'index'])->name('owner.dashboard');
    Route::get('/reservasi', [OwnerReservationController::class, 'index'])->name('owner.reservasi');
    Route::get('/kelola-meja', [OwnerTableController::class, 'index'])
    ->name('owner.kelola-meja');
    Route::post('/kelola-meja', [OwnerTableController::class, 'store'])
    ->name('owner.kelola-meja.store');
    Route::get('/kelola-meja/create', [OwnerTableController::class, 'create'])
    ->name('owner.kelola-meja.create');
    Route::get('/kelola-meja/{id}/edit', [OwnerTableController::class, 'edit'])
    ->name('owner.kelola-meja.edit');
Route::put('/kelola-meja/{id}', [OwnerTableController::class, 'update'])
    ->name('owner.kelola-meja.update');
    Route::get('/settings', function () {
        return view('owner.settings');
    })->name('owner.settings');
});

// --- CUSTOMER ROUTES ---
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/reservations', [CustomerReservationController::class, 'index'])->name('customer.reservations');
    Route::get('/reservasi/create/{restaurant}', [CustomerReservationController::class, 'create'])
    ->name('customer.reservations.create');
    Route::post('/reservasi/store', [CustomerReservationController::class, 'store'])
    ->name('customer.reservations.store');
});

