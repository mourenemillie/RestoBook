<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::post('/midtrans/notification', [BookingController::class, 'handleNotification'])->name('midtrans.notification');