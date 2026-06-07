<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::orderBy('created_at', 'desc')->get();
        return view('admin.restaurants', compact('restaurants'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:pending,active,rejected',
        ]);

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.restaurants')->with('success', 'Data restoran berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->route('admin.restaurants')->with('success', 'Restoran berhasil dihapus!');
    }
}
