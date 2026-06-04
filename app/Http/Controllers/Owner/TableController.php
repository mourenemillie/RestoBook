<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::all();

        return view('owner.kelola-meja', compact('tables'));
    }

    public function store(Request $request)
    {
        Table::create([
            'restaurant_id' => 1,
            'table_number' => $request->table_number,
            'capacity' => $request->capacity,
            'status' => $request->status
        ]);

        return redirect()->route('owner.kelola-meja')
            ->with('success', 'Meja berhasil ditambahkan');
    }public function edit($id)
{
    $table = Table::findOrFail($id);

    return view('owner.edit-meja', compact('table'));
}

public function update(Request $request, $id)
{
    $table = Table::findOrFail($id);

    $table->update([
        'table_number' => $request->table_number,
        'capacity' => $request->capacity,
        'status' => $request->status,
    ]);

    return redirect()->route('owner.kelola-meja')
        ->with('success', 'Meja berhasil diupdate');
}
    public function create()
{
    return view('owner.tambah-meja');
}
}