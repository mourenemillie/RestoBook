<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

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
public function store(Request $request)
{
    Reservation::create([
        'user_id' => Auth::id(),
        'restaurant_id' => 1,
        'table_id' => 2,
        'reservation_date' => $request->reservation_date,
        'reservation_time' => $request->reservation_time,
        'num_guests' => $request->num_guests,
        'status' => 'pending'
    ]);

    return redirect('/home')
        ->with('success', 'Reservasi berhasil dibuat!');
}
}
