<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Menu;

class TableController extends Controller
{
    public function index()
    {
        $restaurant = \App\Models\Restaurant::where('user_id', auth()->id())->first();

        if (!$restaurant) {
            return redirect()->route('owner.settings')->with('error', 'Restoran belum disetting.');
        }

        $tables = Table::where('restaurant_id', $restaurant->id)->get();
        $menus  = Menu::where('restaurant_id', $restaurant->id)->get();

        // Calculate dynamic table status for today
        $reservationsToday = \App\Models\Reservation::where('restaurant_id', $restaurant->id)
            ->where('reservation_date', now()->toDateString())
            ->whereIn('status', ['paid', 'approved'])
            ->get();

        foreach ($tables as $table) {
            $status = 'available';
            
            foreach ($reservationsToday as $res) {
                if ($res->table_id == $table->id) {
                    $resTime = \Carbon\Carbon::parse($res->reservation_time);
                    $now = now();
                    
                    if ($now->between($resTime, $resTime->copy()->addHours(2))) {
                        $status = 'occupied';
                        break; // currently occupied, highest priority
                    } elseif ($resTime->isFuture()) {
                        $status = 'reserved'; // reserved for later
                    }
                }
            }
            $table->dynamic_status = $status;
        }

        return view('owner.kelola-meja', compact('tables', 'menus'));
    }

    public function store(Request $request)
    {
        Table::create([
            'restaurant_id' => 1,
            'table_number'  => $request->table_number,
            'capacity'      => $request->capacity,
            'status'        => $request->status,
        ]);

        return redirect()->route('owner.kelola-meja')
            ->with('success', 'Meja berhasil ditambahkan');
    }

    public function create()
    {
        return view('owner.tambah-meja');
    }

    public function edit($id)
    {
        $table = Table::findOrFail($id);

        return view('owner.edit-meja', compact('table'));
    }

    public function update(Request $request, $id)
    {
        $table = Table::findOrFail($id);

        $table->update([
            'table_number' => $request->table_number,
            'capacity'     => $request->capacity,
            'status'       => $request->status,
        ]);

        return redirect()->route('owner.kelola-meja')
            ->with('success', 'Meja berhasil diupdate');
    }
}