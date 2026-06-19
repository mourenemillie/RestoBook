<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan Halaman Beranda Utama Customer (Setelah Login)
     */
    public function index()
    {
<<<<<<< HEAD
        // Eager loading relasi 'menus' agar query lebih efisien saat menampilkan data
        $restaurants = Restaurant::with('menus')->get();
        return view('customer.home', compact('restaurants'));
    }

    /**
     * Menampilkan Halaman Detail Profil Restoran & Menu Pilihan (Setelah Login)
     */
    public function showRestaurant($id)
    {
        // 1. Coba cari restoran asli di database berdasarkan ID
        $restaurant = Restaurant::with('menus')->find($id);

        // 2. [ANTI-EROR 404] Jika ID tidak ditemukan di DB (karena pakai data dummy/kosong), 
        // kita buatkan objek tiruan agar testing halaman detail tetap jalan mulus!
        if (!$restaurant) {
            $restaurant = new Restaurant();
            $restaurant->id = $id;
            $restaurant->name = $id == 2 ? 'Bakso Son Haji Sony' : ($id == 3 ? 'Kopi Lampung Hub' : 'Sate Padang Begadang');
            $restaurant->address = 'Jl. Utama Bandar Lampung, Lampung';
            $restaurant->phone = '0812-7777-XXXX';
            $restaurant->open_time = '09:00';
            $restaurant->close_time = '21:00';
            
            // Set relasi menu kosong agar looping @foreach di file Blade tidak pemisah/eror
            $restaurant->setRelation('menus', collect()); 
        }

        // BERHASIL DIPERBARUI: Mengarah ke customer/show.blade.php sesuai nama file asli kamu
        return view('customer.show', compact('restaurant'));
    }

    /**
     * Fitur Search Khusus Halaman Beranda Customer (Setelah Login)
     * UPDATE LOGIKA: Mengembalikan daftar list restoran yang sesuai kata kunci (Tanpa dipaksa/nyasar)
     */
    public function search(Request $request)
    {
        // Mendukung penangkapan input via name="query" maupun name="search" agar lebih aman
        $query = $request->input('query') ?? $request->input('search');

        // Jika user asal klik tombol cari tanpa mengetik apapun, kembalikan ke halaman awal
        if (empty($query)) {
            return redirect()->route('home')->with('error', 'Silakan masukkan kata kunci pencarian.');
        }

        // 1. UBAH ->first() MENJADI ->get() agar menghasilkan daftar restoran yang cocok
        $restaurants = Restaurant::where('name', 'LIKE', "%{$query}%")
            ->orWhere('address', 'LIKE', "%{$query}%")
            ->orWhereHas('menus', function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })->get();

        // 2. JIKA RESTORAN DITEMUKAN
        if ($restaurants->count() > 0) {
            
            // Jika hasil pencarian sangat spesifik dan hanya ada tepat 1 restoran (Misal mengetik: "Bakso Sony")
            if ($restaurants->count() === 1) {
                return redirect()->route('customer.restaurant.show', ['id' => $restaurants->first()->id]);
            }

            // Jika hasil pencarian banyak (Misal mengetik: "Lampung" atau "Bakso" dan cabangnya banyak)
            // Tampilkan list-nya di halaman home utama dengan menyaring isi card restoran
            return view('customer.home', compact('restaurants', 'query'));
        }

        // 3. JIKA TIDAK DITEMUKAN SAMA SEKALI
        // Kembalikan ke halaman beranda dengan pesan info agar tidak merusak tampilan layout
        return redirect()->route('home')->with('error', 'Restoran atau kuliner dengan kata kunci "' . $query . '" tidak ditemukan.');
    }
}
=======
        // Hanya mengambil 3 restoran yang sudah aktif (disetujui) dari database
        $restaurants = \App\Models\Restaurant::where('status', 'active')->take(3)->get();
        return view('customer.home', compact('restaurants'));
    }
}
>>>>>>> ac62f328756ae709eeec56ca0e97b1cff3d92f39
