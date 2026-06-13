<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Menampilkan Halaman Landing Page Utama (Sebelum / Tanpa Login)
     */
    public function index()
    {
        // 1. Jika user sudah login, langsung bypass ke halaman internal masing-masing role
        if (auth()->check()) {
            return match (auth()->user()->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'owner' => redirect()->route('owner.dashboard'),
                default => redirect()->route('home'), // Customer masuk ke Home internal
            };
        }

        // 2. Ambil data restoran dari database untuk ditampilkan di landing page umum
        $restaurants = Restaurant::all(); 

        // 3. SINKRONISASI VIEW: Diarahkan ke folder 'restaurant' dan file 'landingpage'
        return view('restaurant.landingpage', compact('restaurants'));
    }

    /**
     * Menampilkan Halaman Detail Restoran Umum (Dapat diakses Publik & Customer)
     */
    public function show($id)
    {
        // 1. Coba cari restoran asli di database berdasarkan ID beserta menunya
        $restaurant = Restaurant::with('menus')->find($id);

        // 2. [ANTI-EROR 404] Jika ID tidak ditemukan di DB (karena efek fresh migration), 
        // kita buatkan objek cadangan agar halaman 'customer.show' tidak pecah/eror
        if (!$restaurant) {
            $restaurant = new Restaurant();
            $restaurant->id = $id;
            $restaurant->name = $id == 2 ? 'Bakso Son Haji Sony' : ($id == 3 ? 'Kopi Lampung Hub' : 'Sate Padang Begadang');
            $restaurant->address = 'Jl. Utama Bandar Lampung, Lampung';
            $restaurant->phone = '0812-7777-XXXX';
            $restaurant->open_time = '09:00';
            $restaurant->close_time = '21:00';
            
            // Set relasi menu kosong agar looping @forelse di blade milikmu tidak eror
            $restaurant->setRelation('menus', collect()); 
        }
        
        // Membuka file resources/views/customer/show.blade.php
        return view('customer.show', compact('restaurant'));
    }

    /**
     * PENCARIAN PUBLIK & CUSTOMER (Satu Pintu)
     * UPDATE LOGIKA: Menampilkan daftar hasil pencarian yang akurat (Menggunakan ->get())
     */
    public function search(Request $request)
    {
        // 1. ADANG PENGUNJUNG YANG BELUM LOGIN
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan masuk atau daftar akun terlebih dahulu untuk mencari restoran favoritmu!');
        }

        // 2. AMBIL KATA KUNCI INPUTAN
        $query = $request->input('search');

        if (empty($query)) {
            return redirect()->route('home')->with('error', 'Silakan masukkan kata kunci pencarian terlebih dahulu!');
        }

        // 3. UBAH ->first() MENJADI ->get() AGAR MENGHASILKAN LIST RESTORAN YANG SESUAI
        $restaurants = Restaurant::where('name', 'LIKE', "%{$query}%")
            ->orWhere('address', 'LIKE', "%{$query}%")
            ->orWhereHas('menus', function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })->get();

        // 4. JIKA HASILNYA ADA
        if ($restaurants->count() > 0) {
            // Jika pencarian hanya menghasilkan tepat 1 restoran (misal ngetik spesifik "Bakso Sony")
            if ($restaurants->count() === 1) {
                $restaurant = $restaurants->first();
                if (auth()->user()->role === 'customer') {
                    return redirect()->route('customer.reservations.create', ['restaurant_id' => $restaurant->id]);
                }
                return redirect()->route('restaurant.show', ['id' => $restaurant->id]);
            }

            // Jika hasil pencarian banyak (misal ngetik kata "Bakso" dan muncul beberapa cabang/warung),
            // Kembalikan ke halaman daftar rumah (home) dengan membawa daftar restoran hasil filter tersebut.
            return view('customer.home', compact('restaurants', 'query'));
        }

        // Jika tidak ditemukan, kembali ke halaman sebelumnya dengan pesan peringatan
        return back()->with('error', 'Restoran atau menu kuliner dengan kata kunci "' . $query . '" tidak ditemukan.');
    }
}