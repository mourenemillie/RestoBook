<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();

        return view('admin.settings', [
            'user' => \Illuminate\Support\Facades\Auth::user(),
            'settings' => $settings
        ]);
    }

    public function update(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        // Validasi untuk Profil
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update Profil User
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        $user->save();

        // Update Global Settings
        $allowedSettings = [
            'app_name', 'contact_email', 'contact_phone', 'timezone', 'currency'
        ];

        foreach ($allowedSettings as $key) {
            if ($request->has($key)) {
                \App\Models\Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->input($key)]
                );
            }
        }

        return redirect()->route('admin.settings')->with('success', 'Semua pengaturan berhasil diperbarui!');
    }
}
