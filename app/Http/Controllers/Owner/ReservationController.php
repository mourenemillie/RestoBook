<?php

namespace App\Http\Controllers\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reservation;

class ReservationController extends Controller
{
   public function index(Request $request)
{
    $query = \App\Models\Reservation::latest();

    if ($request->status == 'pending') {
        $query->where('status', 'pending');
    }

    if ($request->status == 'completed') {
        $query->where('status', 'completed');
    }

    if ($request->status == 'cancelled') {
        $query->where('status', 'cancelled');
    }

    $reservations = $query->get();

    return view('owner.reservasi', compact('reservations'));
}
public function show($id)
{
    $reservation = \App\Models\Reservation::with('user')->findOrFail($id);

    return view('owner.detail-reservasi', compact('reservation'));
}
public function hadir($id)
{
    $reservation = \App\Models\Reservation::findOrFail($id);

    $reservation->update([
        'status' => 'completed'
    ]);

    return back();
}

public function tidakHadir($id)
{
    $reservation = \App\Models\Reservation::findOrFail($id);

    $reservation->update([
        'status' => 'cancelled'
    ]);

    return back();
}
}