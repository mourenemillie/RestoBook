<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboard;
use App\Http\Controllers\Owner\ReservationController;
use App\Http\Controllers\Customer\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Landing Page
Route::get('/', function () {
    return view('landing');
});

// 2. Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Super Admin
Route::middleware(['auth', 'role:superadmin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
});

// 4. Owner
Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {

    Route::get('/dashboard', [OwnerDashboard::class, 'index'])->name('owner.dashboard');

    Route::get('/reservasi', [ReservationController::class, 'index'])
        ->name('owner.reservasi');

    // 🔥 tombol reservasi
    Route::post('/reservasi/checkin', function () {
        return back()->with('success', 'Berhasil Check-In');
    })->name('owner.reservasi.checkin');

    Route::post('/reservasi/noshow', function () {
        return back()->with('success', 'Tandai No-Show');
    })->name('owner.reservasi.noshow');

    // Settings
    Route::get('/settings', function () {
        return view('owner.settings');
    })->name('owner.settings');
});

// 5. Customer
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// 6. Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});