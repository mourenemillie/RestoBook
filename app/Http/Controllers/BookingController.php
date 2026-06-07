<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class BookingController extends Controller
{
    // 1. Menampilkan Landing Page (Merujuk ke views/restaurant/index.blade.php)
    public function index()
    {
        return view('restaurant.index'); 
    }

    // 2. Menampilkan Form Detail Restoran (Merujuk ke views/restaurant/show.blade.php)
    public function create()
    {
        return view('restaurant.show'); 
    }

    // 3. Memproses Data Pemesanan & Kalkulasi Harga Berdasarkan Jumlah Tamu
    public function store(Request $request)
    {
        $request->validate([
            'restaurant_name'  => 'required|string',
            'booking_date'     => 'required|date|after_or_equal:today',
            'number_of_people' => 'required|string',
            'booking_time'     => 'required|string',
            'table_area'       => 'required|string',
        ]);

        // Mengambil angka murni dari string select (Contoh: "4 Orang" diambil angka 4)
        $guestCount = (int) filter_var($request->number_of_people, FILTER_SANITIZE_NUMBER_INT);
        if ($guestCount <= 0) { 
            $guestCount = 2; // Default fallback jika penyaringan angka gagal
        } 

        // Perhitungan Harga Paket Menu Sesuai Kelipatan Tamu
        $baksoPrice = 25000;
        $esJerukPrice = 8000;
        $serviceFee = 2000;
        
        // Total kalkulasi: ((Bakso + Es Jeruk) * Jumlah Orang) + Biaya Layanan
        $totalPrice = (($baksoPrice + $esJerukPrice) * $guestCount) + $serviceFee;

        // Membuat Kode Booking Acak Unik (Contoh: BKS-ABC12)
        $bookingCode = 'BKS-' . strtoupper(Str::random(5));

        // Memasukkan data pesanan ke dalam tabel database 'reservations'
        DB::table('reservations')->insert([
            'booking_code'     => $bookingCode,
            'user_id'          => auth()->id() ?? 1,
            'restaurant_id'    => 1,
            'table_id'         => 1,
            'reservation_date' => $request->booking_date,
            'reservation_time' => $request->booking_time,
            'num_guests'       => $guestCount,
            'notes'            => 'Area: ' . $request->table_area . ' - ' . $request->restaurant_name,
            'total_price'      => $totalPrice,
            'status'           => 'pending',
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        // Dialihkan ke rute checkout sesuai yang ada di routes/web.php
        return redirect()->route('booking.checkout', $bookingCode);
    }

    // 4. Menampilkan Halaman Checkout Pembayaran (Merujuk ke views/restaurant/payment.blade.php)
    public function checkout($booking_code)
    {
        $booking = DB::table('reservations')->where('booking_code', $booking_code)->first();

        if (!$booking) {
            abort(404, 'Reservasi tidak valid atau tidak ditemukan.');
        }

        // Set Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $snapToken = $booking->snap_token;

        if (!$snapToken) {
            $user = auth()->user();
            $params = [
                'transaction_details' => [
                    'order_id' => $booking->booking_code,
                    'gross_amount' => $booking->total_price,
                ],
                'customer_details' => [
                    'first_name' => $user ? $user->name : 'Guest',
                    'email' => $user ? $user->email : 'guest@example.com',
                    'phone' => $user ? $user->phone : '0800000000',
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            
            DB::table('reservations')->where('booking_code', $booking_code)->update([
                'snap_token' => $snapToken
            ]);

            $booking->snap_token = $snapToken;
        }

        return view('restaurant.payment', compact('booking'));
    }

    // 5. Handle Midtrans Webhook Notification
    public function handleNotification(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' || $request->transaction_status == 'settlement'){
                DB::table('reservations')->where('booking_code', $request->order_id)->update(['status' => 'paid', 'updated_at' => now()]);
            } elseif ($request->transaction_status == 'cancel' || $request->transaction_status == 'deny' || $request->transaction_status == 'expire'){
                DB::table('reservations')->where('booking_code', $request->order_id)->update(['status' => 'cancelled', 'updated_at' => now()]);
            }
        }
        return response()->json(['status' => 'success']);
    }

    // 6. Tampilan Akhir Halaman Sukses (Merujuk ke views/restaurant/success.blade.php)
    public function success($booking_code)
    {
        $booking = DB::table('reservations')->where('booking_code', $booking_code)->first();
        if (!$booking) { 
            abort(404); 
        }
        
        return view('restaurant.success', compact('booking')); 
    }
}