<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Hanya mengambil 3 restoran yang sudah aktif (disetujui) dari database
        $restaurants = \App\Models\Restaurant::where('status', 'active')->take(3)->get();
        return view('customer.home', compact('restaurants'));
    }
}
