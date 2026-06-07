<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class BookingController extends Controller
{
    public function index()
    {
        return view('restaurant.index'); 
    }

    public function create()
    {
        return view('restaurant.show'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'restaurant_name'  => 'required|string',
            'booking_date'     => 'required|date',
            'number_of_people' => 'required|string',
            'booking_time'     => 'required|string',
            'table_area'       => 'required|string',
        ]);

        $guestCount = (int) filter_var($request->number_of_people, FILTER_SANITIZE_NUMBER_INT);
        if ($guestCount <= 0) { 
            $guestCount = 2; 
        } 

        $baksoPrice = 25000;
        $esJerukPrice = 8000;
        $serviceFee = 2000;
        
        $totalPrice = (($baksoPrice + $esJerukPrice) * $guestCount) + $serviceFee;

        $bookingCode = 'BKS-' . strtoupper(Str::random(5));
        $restaurantId = 1;
        $tableId = 1;
        
        if (!\App\Models\Restaurant::find($restaurantId)) {
            \App\Models\Restaurant::updateOrCreate(['id' => $restaurantId], [
                'user_id' => auth()->id() ?? \App\Models\User::first()->id ?? \App\Models\User::factory()->create()->id,
                'name' => 'Bakso Son Haji Sony',
                'address' => 'Jl. Wolter Monginsidi',
                'city' => 'Bandar Lampung',
                'phone' => '081234567890',
                'status' => 'active'
            ]);
        }
        
        if (!\App\Models\Table::find($tableId)) {
            \App\Models\Table::updateOrCreate(['id' => $tableId], [
                'restaurant_id' => $restaurantId,
                'table_number' => 'M1',
                'capacity' => 4,
                'status' => 'available'
            ]);
        }

        DB::table('reservations')->insert([
            'booking_code'     => $bookingCode,
            'user_id'          => auth()->id() ?? 1,
            'restaurant_id'    => $restaurantId,
            'table_id'         => $tableId,
            'reservation_date' => $request->booking_date,
            'reservation_time' => $request->booking_time,
            'num_guests'       => $guestCount,
            'notes'            => 'Area: ' . $request->table_area . ' - ' . $request->restaurant_name,
            'total_price'      => $totalPrice,
            'status'           => 'pending',
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        return redirect()->route('booking.checkout', $bookingCode);
    }

    public function checkout($booking_code)
    {
        $booking = DB::table('reservations')->where('booking_code', $booking_code)->first();

        if (!$booking) {
            abort(404, 'Reservasi tidak valid atau tidak ditemukan.');
        }

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

            try {
                $snapToken = Snap::getSnapToken($params);
                
                DB::table('reservations')->where('booking_code', $booking_code)->update([
                    'snap_token' => $snapToken
                ]);

                $booking->snap_token = $snapToken;
            } catch (\Exception $e) {
                return redirect()->route('restaurant.show', ['id' => $booking->restaurant_id])->withErrors('Gagal memproses pembayaran: Pastikan MIDTRANS_SERVER_KEY sudah disetting dengan benar di server. Detail Error: ' . $e->getMessage());
            }
        }

        return view('restaurant.payment', compact('booking'));
    }

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

    public function success($booking_code)
    {
        $booking = DB::table('reservations')->where('booking_code', $booking_code)->first();
        if (!$booking) { 
            abort(404); 
        }
        
        return view('restaurant.success', compact('booking')); 
    }
}