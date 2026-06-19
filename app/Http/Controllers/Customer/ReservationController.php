<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = \App\Models\Reservation::with(['restaurant', 'table'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.reservations', compact('reservations'));
    }
    public function create($restaurant)
    {
        $restaurant = \App\Models\Restaurant::with('menus', 'tables')->findOrFail($restaurant);
        return view('restaurant.booking', compact('restaurant'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'table_id' => 'required',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'number_of_people' => 'required|integer|min:1',
        ]);

        if ($request->table_id !== 'none') {
            // Validasi Double Booking
            $conflict = Reservation::where('table_id', $request->table_id)
                ->where('reservation_date', $request->booking_date)
                ->where('reservation_time', $request->booking_time)
                ->whereIn('status', ['pending', 'paid', 'approved'])
                ->exists();

            if ($conflict) {
                return back()->withInput()->withErrors(['table_id' => 'Meja ini sudah dipesan pada tanggal dan jam tersebut. Silakan pilih meja atau waktu lain.']);
            }
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $request->restaurant_id,
            'table_id' => $request->table_id !== 'none' ? $request->table_id : null,
            'reservation_date' => $request->booking_date,
            'reservation_time' => $request->booking_time,
            'num_guests' => $request->number_of_people,
            'status' => 'pending',
            'notes' => $request->table_id === 'none' ? 'Request meja dengan kapasitas ' . $request->number_of_people . ' orang (tidak tersedia di daftar).' : null
        ]);

        return redirect('/home')
            ->with('success', 'Reservasi berhasil dibuat!');
    }

    public function getAvailableTables(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'date' => 'required|date',
            'time' => 'required',
            'capacity' => 'required|integer|min:1'
        ]);

        // Cari meja di restoran ini yang kapasitasnya mencukupi
        $tables = \App\Models\Table::where('restaurant_id', $request->restaurant_id)
            ->where('capacity', '>=', $request->capacity)
            ->get();

        $availableTables = [];

        foreach ($tables as $table) {
            // Cek apakah meja ini sudah dipesan di tanggal dan jam yang sama
            $isBooked = \App\Models\Reservation::where('table_id', $table->id)
                ->where('reservation_date', $request->date)
                ->where('reservation_time', $request->time)
                ->whereIn('status', ['pending', 'paid', 'approved'])
                ->exists();

            if (!$isBooked) {
                $availableTables[] = $table;
            }
        }

        return response()->json([
            'success' => true,
            'tables' => $availableTables
        ]);
    }
}
