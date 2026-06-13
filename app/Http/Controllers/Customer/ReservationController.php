<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    /**
     * Menampilkan riwayat daftar reservasi milik customer yang sedang login.
     */
    public function index()
    {
        $reservations = Reservation::with('restaurant')
            ->where('user_id', Auth::id())
            ->orderBy('reservation_date', 'desc')
            ->get();

        return view('customer.reservations_index', compact('reservations'));
    }

    /**
     * Menampilkan formulir pembuatan reservasi beserta data meja dan menu restoran.
     * FIXED: Parameter disinkronkan secara ketat dengan nama token di web.php ({restaurant_id})
     */
    public function create($restaurant_id)
    {
        // Memuat data restoran bersama relasi menu dan meja yang berstatus tersedia
        $restaurant = Restaurant::with(['menus', 'tables' => function($query) {
            $query->where('status', 'available');
        }])->findOrFail($restaurant_id);

        return view('customer.reservations', compact('restaurant'));
    }

    /**
     * Memproses penyimpanan data reservasi utama dan mengalihkan ke sistem pembayaran.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Data Form secara ketat sesuai skema database
        $request->validate([
            'restaurant_id'    => 'required|exists:restaurants,id',
            'table_id'         => 'required|exists:tables,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
            'num_guests'       => 'required|integer|min:1',
            'notes'            => 'nullable|string|max:500',
            'menus'            => 'nullable|array',
        ]);

        // 2. Hitung Total Harga dari Kombinasi Pre-order Menu Hidangan
        $totalPrice = 0;
        $appServiceFee = 2000; // Biaya Layanan Aplikasi

        if ($request->has('menus')) {
            foreach ($request->menus as $menuItem) {
                // Memastikan checkbox menu tersebut aktif dipilih oleh user
                if (isset($menuItem['id'])) {
                    $menu = Menu::find($menuItem['id']);
                    
                    // Sinkronisasi penuh dengan parameter name="menus[id][qty]" dari form view
                    $quantity = isset($menuItem['qty']) ? (int)$menuItem['qty'] : 1;
                    
                    // PENGAMAN: Pastikan data menu benar-benar ada di DB sebelum mengambil properti price
                    if ($menu) {
                        $totalPrice += $menu->price * $quantity;
                    }
                }
            }
        }

        // Akumulasi kalkulasi total akhir transaksi
        $grandTotal = $totalPrice + $appServiceFee;

        // 3. Simpan entitas data transaksi utama ke tabel reservations
        $reservation = Reservation::create([
            'booking_code'     => 'BK-' . strtoupper(Str::random(8)),
            'user_id'          => Auth::id(),
            'restaurant_id'    => $request->restaurant_id,
            'table_id'         => $request->table_id,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'num_guests'       => $request->num_guests,
            'total_price'      => $grandTotal,
            'notes'            => $request->notes,
            'status'           => 'pending'
        ]);

        // 4. Simpan relasi detail item menu yang dipesan ke tabel pivot (bila didukung skema)
        if ($request->has('menus') && method_exists($reservation, 'menus')) {
            foreach ($request->menus as $menuItem) {
                if (isset($menuItem['id'])) {
                    $quantity = isset($menuItem['qty']) ? (int)$menuItem['qty'] : 1;
                    $reservation->menus()->attach($menuItem['id'], ['quantity' => $quantity]);
                }
            }
        }

        // 5. Redireksi ke endpoint alur potong kompas Invoice Checkout Midtrans
        return redirect()->route('booking.checkout', $reservation->booking_code)
            ->with('success', 'Reservasi berhasil diproses! Silakan selesaikan pembayaran invoice Anda.');
    }
}