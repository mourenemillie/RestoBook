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

        // Calculate total revenue from completed/paid reservations
        $totalRevenue = Reservation::whereIn('status', ['paid', 'completed'])->sum('total_price');

        $pendingRestaurants = Restaurant::with('user')->where('status', 'pending')->get();

        return view('admin.dashboard', compact(
            'totalRestaurants', 'newRestaurantsThisMonth',
            'totalUsers', 'newUsersThisMonth',
            'activeReservations', 'reservationsToday',
            'totalRevenue',
            'pendingRestaurants'
        ));
    }
}
