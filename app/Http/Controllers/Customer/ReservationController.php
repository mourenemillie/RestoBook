<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = [
            [
                'restaurant' => 'Sate Padang Begadang',
                'date' => '2026-05-05',
                'time' => '19:00',
                'guests' => 4,
                'status' => 'Confirmed',
            ],
            [
                'restaurant' => 'Bakso Son Haji Sony',
                'date' => '2026-05-08',
                'time' => '18:30',
                'guests' => 2,
                'status' => 'Pending',
            ],
            [
                'restaurant' => 'Kopi Lampung Hub',
                'date' => '2026-05-12',
                'time' => '20:00',
                'guests' => 3,
                'status' => 'Cancelled',
            ],
        ];

        return view('customer.reservations', compact('reservations'));
    }
    public function create($restaurant)
{
    $restaurant = \App\Models\Restaurant::findOrFail($restaurant);

    return view('customer.create-reservation', compact('restaurant'));
}
}
