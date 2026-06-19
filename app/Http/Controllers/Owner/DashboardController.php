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
        $totalMeja = Table::where('restaurant_id', $restaurantId)->count();
        
        // Hitung meja yang sedang terpakai saat ini (asumsi durasi makan 2 jam)
        $reservedTableIds = Reservation::where('restaurant_id', $restaurantId)
            ->where('reservation_date', now()->toDateString())
            ->whereIn('status', ['pending', 'paid', 'approved'])
            ->get()
            ->filter(function($res) {
                $resTime = \Carbon\Carbon::parse($res->reservation_time);
                // Meja dianggap terpakai jika waktu sekarang berada dalam rentang waktu reservasi hingga 2 jam ke depan
                return now()->between($resTime, $resTime->copy()->addHours(2));
            })
            ->pluck('table_id')
            ->unique();
            
        $mejaTersedia = $totalMeja - $reservedTableIds->count();
        
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