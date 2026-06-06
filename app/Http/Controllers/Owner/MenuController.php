<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function create()
    {
        return view('owner.tambah-menu');
    }
    public function edit($id)
{
    $menu = Menu::findOrFail($id);

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

        Menu::create([
            'restaurant_id' => 1,
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
    $menu = Menu::findOrFail($id);

    $menu->update([
        'name' => $request->name,
        'category' => $request->category,
        'description' => $request->description,
        'price' => $request->price,
        'is_available' => $request->is_available,
    ]);

    return redirect()
        ->route('owner.kelola-meja')
        ->with('success', 'Menu berhasil diperbarui');
}
}