<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;

class SettingController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::where('user_id', Auth::id())->first();

        return view('owner.settings', compact('restaurant'));
    }

    public function update(Request $request)
    {
        $restaurant = Restaurant::where('user_id', Auth::id())->first();

       $restaurant->update([
    'name' => $request->name,
    'phone' => $request->phone,
    'address' => $request->address,
    'open_time' => $request->open_time,
    'close_time' => $request->close_time,
]);

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}