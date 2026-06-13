<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantListController extends Controller
{
    public function index()
    {
        // Mengambil seluruh restoran yang statusnya aktif
        $restaurants = Restaurant::where('status', 'active')->get();
        return view('customer.restaurants.index', compact('restaurants'));
    }
}
