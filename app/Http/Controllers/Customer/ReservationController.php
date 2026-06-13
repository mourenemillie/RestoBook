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
        $reservations = \App\Models\Reservation::with(['restaurant', 'table'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.reservations', compact('reservations'));
    }
    public function create($restaurant)
{
    $restaurant = \App\Models\Restaurant::with('menus')->findOrFail($restaurant);

    return view('restaurant.booking', compact('restaurant'));
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
