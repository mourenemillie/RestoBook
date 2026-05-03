<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->role === 'owner') {
                return redirect('/owner/dashboard');
            } else {
                return redirect('/home');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Tampilkan form register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:25',
            'role' => 'required|in:customer,owner',
            'password' => 'required|min:8|confirmed',
            'terms' => 'accepted',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login!');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}