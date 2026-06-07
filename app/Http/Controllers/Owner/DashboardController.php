<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;

class DashboardController extends Controller
{
    public function index()
    {
        $totalReservasi = Reservation::count();

        $reservasiAktif = Reservation::where('status', 'pending')->count();

        $reservasiBatal = Reservation::where('status', 'cancelled')->count();

        $mejaTersedia = Table::where('status', 'available')->count();

        $totalMeja = Table::count();
        $reservations = Reservation::latest()
    ->take(5)
    ->get();

return view('owner.dashboard', [
    'totalReservasi' => $totalReservasi,
    'reservasiAktif' => $reservasiAktif,
    'reservasiBatal' => $reservasiBatal,
    'mejaTersedia' => $mejaTersedia,
    'totalMeja' => $totalMeja,
    'reservations' => $reservations,
]);
    }
}