<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\OwnerDashboardController;
use App\Http\Controllers\Owner\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('owner')->name('owner.')->group(function () {

    // Dashboard Owner
    Route::get('/dashboard', [OwnerDashboardController::class, 'index'])
        ->name('dashboard');

    // Halaman Reservasi
    Route::get('/reservasi', [ReservationController::class, 'index'])
        ->name('reservasi');

});