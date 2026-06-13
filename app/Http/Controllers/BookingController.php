<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Str; 
use Midtrans\Config;
use Midtrans\Snap;
use Exception;

class BookingController extends Controller
{
    /**
     * Inisialisasi Konfigurasi SDK Midtrans secara terpusat
     */
    public function __construct()
    {
        // Menggunakan trim() dan fallback ganda (config midtrans atau services) agar terjamin terbaca
        Config::$serverKey = trim(config('midtrans.server_key') ?? config('services.midtrans.server_key'));
        Config::$isProduction = (bool) (config('midtrans.is_production') ?? config('services.midtrans.is_production') ?? false);
        Config::$isSanitized = (bool) (config('midtrans.is_sanitized') ?? config('services.midtrans.is_sanitized') ?? true);
        Config::$is3ds = (bool) (config('midtrans.is_3ds') ?? config('services.midtrans.is_3ds') ?? true);

        // 🛠️ PERBAIKAN UTAMA: Mematikan pengecekan SSL Peer khusus di Localhost agar terbebas dari cURL Error 60
        Config::$curlOptions = [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ];
    }

    /**
     * Memproses Invoice Checkout Midtrans Berdasarkan Kode Booking Real.
     */
    public function checkout($booking_code)
    {
        // SINKRONISASI RELASI: Wajib me-load 'table' agar tidak crash saat render nomor meja di view
        $booking = Reservation::with(['restaurant', 'user', 'table'])
            ->where('booking_code', $booking_code)
            ->firstOrFail();

        try {
            $snapToken = $booking->snap_token;

            // Jika token kosong atau tidak valid, buat baru ke Midtrans
            if (!$snapToken || Str::contains(strtolower($snapToken), ['error', 'unauthorized']) || strlen($snapToken) < 10) {
                $user = $booking->user;

                $params = [
                    'transaction_details' => [
                        'order_id' => $booking->booking_code . '-' . time(), 
                        'gross_amount' => (int) $booking->total_price,
                    ],
                    'customer_details' => [
                        'first_name' => $user ? $user->name : 'Customer RestoBook',
                        'email' => $user ? $user->email : 'customer@restobook.com',
                        'phone' => $user ? $user->phone ?? '08123456789' : '08123456789',
                    ],
                    'item_details' => [
                        [
                            'id' => 'RESV-' . $booking->restaurant_id,
                            'price' => (int) $booking->total_price,
                            'quantity' => 1,
                            'name' => 'Reservasi Meja di ' . Str::limit($booking->restaurant->name, 20),
                        ]
                    ]
                ];

                $snapToken = Snap::getSnapToken($params);
                
                $booking->update([
                    'snap_token' => $snapToken
                ]);
            }

            // Mengirimkan variabel $booking dan $snapToken asli ke halaman payment
            return view('customer.payment', compact('booking', 'snapToken'));

        } catch (Exception $e) {
            // Jika terjadi error koneksi gateway, bersihkan token agar user bisa refresh halaman untuk mencoba lagi
            $booking->update(['snap_token' => null]);
            return redirect()->route('home')->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Webhook Notification Gateway Midtrans (Asinkronus IPN)
     */
    public function handleNotification(Request $request)
    {
        $serverKey = trim(config('midtrans.server_key') ?? config('services.midtrans.server_key'));
        $baseOrderId = explode('-', $request->order_id)[0];
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        if ($hashed == $request->signature_key) {
            $transaction = $request->transaction_status;

            if ($transaction == 'capture' || $transaction == 'settlement') {
                Reservation::where('booking_code', $baseOrderId)->update([
                    'status' => 'confirmed', 
                    'updated_at' => now()
                ]);
            } elseif (in_array($transaction, ['cancel', 'deny', 'expire'])) {
                Reservation::where('booking_code', $baseOrderId)->update([
                    'status' => 'cancelled', 
                    'updated_at' => now()
                ]);
            }
            
            return response()->json(['status' => 'success', 'message' => 'Notification handled successfully']);
        }
        
        return response()->json(['status' => 'error', 'message' => 'Invalid Signature Key'], 403);
    }

    /**
     * Halaman Pembayaran Sukses
     */
    public function success($booking_code)
    {
        // SINKRONISASI RELASI: Tambahkan 'table' juga di halaman sukses agar cetak nota struk tidak error
        $booking = Reservation::with(['restaurant', 'table'])
            ->where('booking_code', $booking_code)
            ->firstOrFail();
            
        return view('customer.success', compact('booking')); 
    }
}