<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;

class DashboardController extends Controller
{
    public function index()
    {
        $restaurant = \App\Models\Restaurant::where('user_id', auth()->id())->first();

        if (!$restaurant) {
            return redirect()->route('owner.settings')->with('error', 'Restoran belum disetting.');
        }

        $restaurantId = $restaurant->id;

        $totalReservasi = Reservation::where('restaurant_id', $restaurantId)->count();
        $reservasiAktif = Reservation::where('restaurant_id', $restaurantId)->whereIn('status', ['pending', 'paid', 'approved'])->count();
        $reservasiBatal = Reservation::where('restaurant_id', $restaurantId)->whereIn('status', ['cancelled', 'rejected'])->count();
        $mejaTersedia = Table::where('restaurant_id', $restaurantId)->where('status', 'available')->count();
        $totalMeja = Table::where('restaurant_id', $restaurantId)->count();
        
        $reservations = Reservation::where('restaurant_id', $restaurantId)
            ->latest()
            ->take(5)
            ->get();

        return view('owner.dashboard', compact(
            'totalReservasi', 'reservasiAktif', 'reservasiBatal', 
            'mejaTersedia', 'totalMeja', 'reservations'
        ));
    }
}