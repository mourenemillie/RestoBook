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

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'open_time' => $request->open_time,
            'close_time' => $request->close_time,
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('restaurants', 'public');
            $data['image'] = $path;
        }

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            auth()->user()->update(['avatar' => $avatarPath]);
        }

        $restaurant->update($data);

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}