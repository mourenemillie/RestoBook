<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\Registered;

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
            'phone' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
            'role' => 'required|in:customer,owner',
            'password' => 'required|min:8|confirmed',
            'terms' => 'accepted',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        if ($request->role === 'owner') {
            $restaurant = Restaurant::create([
                'user_id' => $user->id,
                'name' => $request->restaurant_name ?? 'Restoran Baru',
                'address' => $request->location ?? 'Belum diisi',
                'phone' => $request->phone,
                'status' => 'pending', 
                'is_submitted' => false,
                'city' => 'Bandar Lampung',
                'open_time' => '09:00:00',
                'close_time' => '22:00:00',
                'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=400&h=300&fit=crop', // Foto default
            ]);
        }

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan langsung login.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Redirect to Google
    public function redirectToGoogle(Request $request)
    {
        if ($request->has('role')) {
            session(['google_register_role' => $request->role]);
        }
        return Socialite::driver('google')->stateless()->redirect();
    }

    // Handle Google Callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            $user = User::where('google_id', $googleUser->id)->orWhere('email', $googleUser->email)->first();

            if ($user) {
                $user->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                ]);
                
                if (!$user->hasVerifiedEmail()) {
                    $user->markEmailAsVerified();
                }

                Auth::login($user);
            } else {
                $role = session('google_register_role', 'customer');
                session()->forget('google_register_role');

                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'password' => null,
                    'role' => $role,
                ]);
                $user->markEmailAsVerified();

                if ($role === 'owner') {
                    \App\Models\Restaurant::create([
                        'user_id' => $user->id,
                        'name' => $googleUser->name . ' Restaurant',
                        'address' => 'Belum diisi',
                        'phone' => '000000000000',
                        'status' => 'pending', 
                        'is_submitted' => false,
                        'city' => 'Bandar Lampung',
                        'open_time' => '09:00:00',
                        'close_time' => '22:00:00',
                        'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=400&h=300&fit=crop',
                    ]);
                }

                Auth::login($user);
            }

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->role === 'owner') {
                return redirect('/owner/dashboard');
            } else {
                return redirect('/home');
            }

        } catch (\Exception $e) {
            \Log::error('Google Login Error: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
            return redirect('/login')->withErrors(['email' => 'Gagal login menggunakan Google. Silakan coba lagi. Error: ' . $e->getMessage()]);
        }
    }
}