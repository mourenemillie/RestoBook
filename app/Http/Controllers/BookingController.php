<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

        // Memasukkan data pesanan ke dalam tabel database 'bookings'
        DB::table('bookings')->insert([
            'booking_code'     => $bookingCode,
            'restaurant_name'  => $request->restaurant_name,
            'booking_date'     => $request->booking_date,
            'number_of_people' => $request->number_of_people, // Menyimpan string lengkap "X Orang"
            'booking_time'     => $request->booking_time,
            'table_area'       => $request->table_area,
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
        $booking = DB::table('bookings')->where('booking_code', $booking_code)->first();

        if (!$booking) {
            abort(404, 'Reservasi tidak valid atau tidak ditemukan.');
        }

        // Sudah diselaraskan menggunakan nama tunggal sesuai struktur file view Anda
        return view('restaurant.payment', compact('booking'));
    }

    // 5. Memproses Konfirmasi Struk Pembayaran
    public function paymentProcess(Request $request, $booking_code)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'payment_proof'  => 'required|image|mimes:jpeg,png,jpg|max:5120', // Maksimal file 5MB
        ]);

        $booking = DB::table('bookings')->where('booking_code', $booking_code)->first();
        if (!$booking) { 
            abort(404); 
        }

        // Proses penyimpanan gambar bukti transfer ke folder storage/app/public/proofs
        $fileName = null;
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $fileName = 'proof_' . $booking_code . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/proofs', $fileName);
        }

        // Perbarui status database menjadi 'paid' dan simpan nama file bukti ke database jika diperlukan
        DB::table('bookings')->where('booking_code', $booking_code)->update([
            'status'     => 'paid',
            'updated_at' => now(),
        ]);

        // Diarahkan langsung ke halaman sukses dengan route name yang valid dari routes/web.php
        return redirect()->route('booking.success', $booking_code);
    }

    // 6. Tampilan Akhir Halaman Sukses (Merujuk ke views/restaurant/success.blade.php)
    public function success($booking_code)
    {
        $booking = DB::table('bookings')->where('booking_code', $booking_code)->first();
        if (!$booking) { 
            abort(404); 
        }
        
        return view('restaurant.success', compact('booking')); 
    }
}