<?php

<<<<<<< HEAD
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Jalur belakang khusus untuk menerima laporan pembayaran dari Midtrans
Route::post('/midtrans-callback', [BookingController.php, 'handleNotification']);
=======
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::post('/midtrans/notification', [BookingController::class, 'handleNotification'])->name('midtrans.notification');
>>>>>>> ac62f328756ae709eeec56ca0e97b1cff3d92f39
