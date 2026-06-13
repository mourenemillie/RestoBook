<?php

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