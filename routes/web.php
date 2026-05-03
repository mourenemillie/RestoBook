<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboard;
use App\Http\Controllers\Owner\ReservationController; // Tambahan dari Zulfa
use App\Http\Controllers\Customer\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda dapat mendaftarkan semua rute web untuk aplikasi Anda.
|
*/

// 1. Halaman Utama (Landing Page UI buatan Ilham)
Route::get('/', function () {
    return view('landing');
});

// 2. Auth Routes (Sistem Autentikasi buatan Kamu)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// 3. Super Admin Routes
Route::middleware(['auth', 'role:superadmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
});

// 4. Owner Routes
Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {
    // Dashboard Owner
    Route::get('/dashboard', [OwnerDashboard::class, 'index'])->name('owner.dashboard');
    
    // Halaman Reservasi 
    Route::get('/reservasi', [ReservationController::class, 'index'])->name('owner.reservasi');

    // Rute Settings Owner
    Route::get('/settings', function () {
        return view('owner.settings');
    })->name('owner.settings');
});

// 5. Customer Routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    // Halaman setelah customer login (Explore dll)
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});


// 6. Rute Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});