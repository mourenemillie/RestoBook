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

        $restaurant = \App\Models\Restaurant::withCount(['menus', 'tables'])->where('user_id', auth()->id())->first();

        $setupProgress = [
            'has_image' => $restaurant && $restaurant->image && $restaurant->image !== 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=400&h=300&fit=crop',
            'has_menus' => $restaurant && $restaurant->menus_count >= 3,
            'menus_count' => $restaurant ? $restaurant->menus_count : 0,
            'has_tables' => $restaurant && $restaurant->tables_count >= 1,
            'tables_count' => $restaurant ? $restaurant->tables_count : 0,
            'is_submitted' => $restaurant ? $restaurant->is_submitted : false,
        ];
        $isSetupComplete = $setupProgress['has_image'] && $setupProgress['has_menus'] && $setupProgress['has_tables'];

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
            'restaurant_status' => $restaurant ? $restaurant->status : 'pending',
            'setupProgress' => $setupProgress,
            'isSetupComplete' => $isSetupComplete,
        ]);
    }

    public function submitVerification()
    {
        $restaurant = \App\Models\Restaurant::where('user_id', auth()->id())->first();
        if ($restaurant) {
            $restaurant->update(['is_submitted' => true]);
        }
        return redirect()->route('owner.pending')->with('success', 'Profil restoran berhasil diajukan untuk verifikasi!');
    }
}