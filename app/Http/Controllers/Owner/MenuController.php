<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function create()
    {
        return view('owner.tambah-menu');
    }
    public function edit($id)
    {
        $restaurant = \App\Models\Restaurant::where('user_id', Auth::id())->first();
        $menu = Menu::where('restaurant_id', $restaurant->id)->findOrFail($id);

        return view('owner.edit-menu', compact('menu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required',
            'price' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                ->store('menus', 'public');
        }

        $restaurant = \App\Models\Restaurant::where('user_id', Auth::id())->first();

        Menu::create([
            'restaurant_id' => $restaurant->id,
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'is_available' => $request->boolean('is_available', true),
        ]);

        return redirect()
            ->route('owner.kelola-meja')
            ->with('success', 'Menu berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required',
            'price' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $restaurant = \App\Models\Restaurant::where('user_id', Auth::id())->first();
        $menu = Menu::where('restaurant_id', $restaurant->id)->findOrFail($id);

        $data = [
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'is_available' => $request->boolean('is_available', true),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()
            ->route('owner.kelola-meja')
            ->with('success', 'Menu berhasil diperbarui');
    }

    public function destroy($id)
    {
        $restaurant = \App\Models\Restaurant::where('user_id', Auth::id())->first();
        $menu = Menu::where('restaurant_id', $restaurant->id)->findOrFail($id);

        $menu->delete();

        return redirect()
            ->route('owner.kelola-meja')
            ->with('success', 'Menu berhasil dihapus');
    }
}