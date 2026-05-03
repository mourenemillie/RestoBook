<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function index()
    {
        return view('owner.reservasi', [
            'reservations' => [
                [
                    'name' => 'Aris Setiawan',
                    'time' => '19:00 WIB',
                    'guest' => '4 Orang',
                    'status' => 'Menunggu'
                ],
                [
                    'name' => 'Siska Wijaya',
                    'time' => '18:30 WIB',
                    'guest' => '2 Orang',
                    'status' => 'Dikonfirmasi'
                ],
                [
                    'name' => 'Dewo Prakoso',
                    'time' => '17:00 WIB',
                    'guest' => '6 Orang',
                    'status' => 'Selesai'
                ],
            ]
        ]);
    }
}