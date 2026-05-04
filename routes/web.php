<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboard;
use App\Http\Controllers\Owner\ReservationController as OwnerReservationController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\ReservationController as CustomerReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES (Landing Page) ---
Route::get('/', function () {
    if (auth()->check()) {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'owner' => redirect()->route('owner.dashboard'),
            default => redirect()->route('home'),
        };
    }
    return view('restaurant.index'); 
});

// --- RESTAURANT FLOW ROUTES (Akses Publik/Tamu) ---
Route::prefix('restaurant')->name('restaurant.')->group(function () {
    // Halaman Detail Restoran
    Route::get('/detail', function () {
        return view('restaurant.show');
    })->name('show');

    // Halaman Pemesanan Meja (Figma: Booking)
    Route::get('/booking', function () {
        return view('restaurant.booking');
    })->name('booking');

    // Halaman Pembayaran (Figma: Payment)
    Route::get('/payment', function () {
        return view('restaurant.payment');
    })->name('payment');
});

// --- AUTH ROUTES ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// --- ADMIN ROUTES ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::get('/users', function () {
        return view('admin.users');
    })->name('users');
});

// --- OWNER ROUTES ---
Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [OwnerDashboard::class, 'index'])->name('dashboard');
    Route::get('/reservasi', [OwnerReservationController::class, 'index'])->name('reservasi');
    Route::get('/settings', function () {
        return view('owner.settings');
    })->name('settings');
});

// --- CUSTOMER ROUTES ---
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/reservations', [CustomerReservationController::class, 'index'])->name('customer.reservations');
});

// --- PROFILE ROUTES ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});