<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $restaurants = \App\Models\Restaurant::take(3)->get();
    return view('customer.home', compact('restaurants'));
}
}
