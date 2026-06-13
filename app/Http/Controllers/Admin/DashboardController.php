<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRestaurants = Restaurant::count();
        $newRestaurantsThisMonth = Restaurant::whereMonth('created_at', now()->month)->count();

        $totalUsers = User::count();
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)->count();

        $activeReservations = Reservation::whereIn('status', ['pending', 'paid', 'approved'])->count();
        $reservationsToday = Reservation::whereDate('created_at', now()->today())->count();

        $pendingRestaurants = Restaurant::with('user')->where('status', 'pending')->get();
        $allRestaurants = Restaurant::withCount('reservations')->get();

        return view('admin.dashboard', compact(
            'totalRestaurants', 'newRestaurantsThisMonth',
            'totalUsers', 'newUsersThisMonth',
            'activeReservations', 'reservationsToday',
            'pendingRestaurants', 'allRestaurants'
        ));
    }
    public function export()
    {
        $restaurants = Restaurant::with('user')->get();
        $csvFileName = 'laporan_restoran_' . date('Ymd_His') . '.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['ID', 'Nama Restoran', 'Pemilik', 'Lokasi', 'Status', 'Tanggal Daftar']);

        ob_start();
        foreach ($restaurants as $restaurant) {
            fputcsv($handle, [
                $restaurant->id,
                $restaurant->name,
                $restaurant->user->name ?? 'N/A',
                $restaurant->city ?? 'Bandar Lampung',
                $restaurant->status,
                $restaurant->created_at->format('Y-m-d')
            ]);
        }
        fclose($handle);
        $content = ob_get_clean();

        return response($content, 200, $headers);
    }
}
