<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return match (auth()->user()->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'owner' => redirect()->route('owner.dashboard'),
                default => redirect()->route('home'),
            };
        }

        $restaurants = \App\Models\Restaurant::where('status', 'active')->take(6)->get();
        return view('restaurant.index', compact('restaurants'));
    }

    public function show($id)
    {
        $restaurant = \App\Models\Restaurant::with('menus')->findOrFail($id);
        return view('restaurant.show', compact('restaurant'));
    }
}
