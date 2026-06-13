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
use App\Http\Controllers\Owner\MenuController;
use App\Http\Controllers\BookingController;

// Route Landing Page
Route::get('/', [RestaurantController::class, 'index'])->name('landing');

// Route Detail Restoran
Route::get('/restaurant/{id}/detail', [RestaurantController::class, 'show'])->name('restaurant.show');

// booking dan pembayaran
Route::post('/restaurant/booking', [BookingController::class, 'store'])->name('restaurant.booking');
Route::get('/booking/checkout/{booking_code}', [BookingController::class, 'checkout'])->name('booking.checkout');
Route::get('/booking/success/{booking_code}', [BookingController::class, 'success'])->name('booking.success');

// auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

//google login
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/login')->with('success', 'Email berhasil diverifikasi! Silakan login.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi telah dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    
    Route::patch('/restaurants/{id}/approve', [AdminRestaurantController::class, 'approve'])->name('admin.restaurants.approve');
    Route::patch('/restaurants/{id}/reject', [AdminRestaurantController::class, 'reject'])->name('admin.restaurants.reject');
    Route::get('/restaurants', [AdminRestaurantController::class, 'index'])->name('admin.restaurants');
    Route::put('/restaurants/{id}', [AdminRestaurantController::class, 'update'])->name('admin.restaurants.update');
    Route::delete('/restaurants/{id}', [AdminRestaurantController::class, 'destroy'])->name('admin.restaurants.destroy');
    
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings');
    Route::post('/settings/update', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update');
});

// owner routes
Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {
    Route::get('/dashboard', [OwnerDashboard::class, 'index'])->name('owner.dashboard');
    Route::get('/reservasi', [OwnerReservationController::class, 'index'])->name('owner.reservasi');
    Route::get('/reservasi/{id}', [OwnerReservationController::class, 'show'])->name('owner.reservasi.show');
    Route::patch('/reservasi/{id}/hadir', [OwnerReservationController::class, 'hadir'])->name('owner.reservasi.hadir');
    Route::patch('/reservasi/{id}/tidak-hadir', [OwnerReservationController::class, 'tidakHadir'])->name('owner.reservasi.tidak-hadir');
    Route::patch('/reservasi/{id}/approve', [OwnerReservationController::class, 'approve'])->name('owner.reservasi.approve');
    Route::patch('/reservasi/{id}/reject', [OwnerReservationController::class, 'reject'])->name('owner.reservasi.reject');
    Route::get('/kelola-meja', [OwnerTableController::class, 'index'])->name('owner.kelola-meja');
    Route::post('/kelola-meja', [OwnerTableController::class, 'store'])->name('owner.kelola-meja.store');
    Route::get('/kelola-meja/create', [OwnerTableController::class, 'create'])->name('owner.kelola-meja.create');
    Route::get('/kelola-meja/{id}/edit', [OwnerTableController::class, 'edit'])->name('owner.kelola-meja.edit');
    Route::put('/kelola-meja/{id}', [OwnerTableController::class, 'update'])->name('owner.kelola-meja.update');
    Route::get('/settings', [OwnerSettingController::class, 'index'])->name('owner.settings');
    Route::post('/settings/update', [OwnerSettingController::class, 'update'])->name('owner.settings.update');
    Route::get('/tambah-menu', [MenuController::class, 'create'])->name('owner.tambah-menu');
    Route::post('/tambah-menu', [MenuController::class, 'store'])->name('owner.tambah-menu.store');

    // Menu routes
    Route::get('/menu/create',       [MenuController::class, 'create'])->name('owner.menu.create');
    Route::post('/menu',             [MenuController::class, 'store'])->name('owner.menu.store');
    Route::get('/menu/{id}/edit',    [MenuController::class, 'edit'])->name('owner.menu.edit');
    Route::put('/menu/{id}',         [MenuController::class, 'update'])->name('owner.menu.update');
    Route::delete('/menu/{id}',      [MenuController::class, 'destroy'])->name('owner.menu.destroy');
});

// cutomer routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/restaurants/all', [\App\Http\Controllers\Customer\RestaurantListController::class, 'index'])->name('customer.restaurants.index');
    Route::get('/reservations', [CustomerReservationController::class, 'index'])->name('customer.reservations');
    Route::get('/reservasi/create/{restaurant}', [CustomerReservationController::class, 'create'])->name('customer.reservations.create');
    Route::post('/reservasi/store', [CustomerReservationController::class, 'store'])->name('customer.reservations.store');
});