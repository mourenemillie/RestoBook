<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;

class OwnerDashboardController extends Controller
{
    public function index()
    {
        $chartData = collect(['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'])
            ->map(fn($d) => [
                'label' => $d,
                'val' => rand(20, 120)
            ]);

        return view('dashboard.owner', [
            'totalTamu' => 142,
            'reservasiAktif' => 28,
            'mejaTersedia' => 15,
            'totalMeja' => 40,
            'batalHariIni' => 3,

            'reservations' => [
                [
                    'name' => 'Ahmad Fauzi',
                    'time' => '19:00 WIB',
                    'guest' => '4 Orang',
                    'status' => 'Menunggu'
                ],
                [
                    'name' => 'Budi Santoso',
                    'time' => '20:30 WIB',
                    'guest' => '2 Orang',
                    'status' => 'Dikonfirmasi'
                ],
                [
                    'name' => 'Citra Kirana',
                    'time' => '18:15 WIB',
                    'guest' => '6 Orang',
                    'status' => 'Selesai'
                ],
            ],

            'tables' => [],
            'chartData' => $chartData->toArray(),
        ]);
    }
}