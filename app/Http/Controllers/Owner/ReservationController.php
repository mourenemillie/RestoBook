<?php

namespace App\Http\Controllers\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $restaurant = \App\Models\Restaurant::where('user_id', Auth::id())->first();
        
        if (!$restaurant) {
            return redirect()->route('owner.dashboard')->with('error', 'Restoran tidak ditemukan.');
        }

        $reservations = \App\Models\Reservation::where('restaurant_id', $restaurant->id)
            ->latest()
            ->get();

        return view('owner.reservasi', compact('reservations'));
    }
public function show($id)
{
    $restaurant = \App\Models\Restaurant::where('user_id', Auth::id())->first();
    $reservation = \App\Models\Reservation::with('user')->where('restaurant_id', $restaurant->id)->findOrFail($id);

    return view('owner.detail-reservasi', compact('reservation'));
}
public function hadir($id)
{
    $restaurant = \App\Models\Restaurant::where('user_id', Auth::id())->first();
    $reservation = \App\Models\Reservation::where('restaurant_id', $restaurant->id)->findOrFail($id);

    $reservation->update([
        'status' => 'completed'
    ]);

    return back();
}

public function tidakHadir($id)
{
    $restaurant = \App\Models\Restaurant::where('user_id', Auth::id())->first();
    $reservation = \App\Models\Reservation::where('restaurant_id', $restaurant->id)->findOrFail($id);

    $reservation->update([
        'status' => 'cancelled'
    ]);

    return back()->with('success', 'Reservasi dibatalkan.');
}

}