<?php

namespace App\Http\Controllers\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $restaurant = \App\Models\Restaurant::where('user_id', Auth::id())->first();
        
        if (!$restaurant) {
            return redirect()->route('owner.dashboard')->with('error', 'Restoran tidak ditemukan.');
        }

        $query = \App\Models\Reservation::where('restaurant_id', $restaurant->id)->latest();

        $tab = $request->get('tab', 'persetujuan');

        if ($tab == 'kedatangan') {
            $query->whereIn('status', ['approved', 'completed', 'cancelled']);
        } else {
            $query->whereIn('status', ['pending', 'rejected']);
        }

        $reservations = $query->get();

        return view('owner.reservasi', compact('reservations', 'tab'));
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

public function approve($id)
{
    $restaurant = \App\Models\Restaurant::where('user_id', Auth::id())->first();
    $reservation = \App\Models\Reservation::where('restaurant_id', $restaurant->id)->findOrFail($id);
    $reservation->update(['status' => 'approved']);
    return back()->with('success', 'Reservasi diterima!');
}

public function reject($id)
{
    $restaurant = \App\Models\Restaurant::where('user_id', Auth::id())->first();
    $reservation = \App\Models\Reservation::where('restaurant_id', $restaurant->id)->findOrFail($id);
    $reservation->update(['status' => 'rejected']);
    return back()->with('success', 'Reservasi ditolak!');
}
}