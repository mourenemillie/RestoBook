<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     * SINKRONISASI: Menambahkan 'snap_token' agar sukses menyimpan token Midtrans ke database.
     */
    protected $fillable = [
        'booking_code',
        'user_id',
        'restaurant_id',
        'table_id',
        'reservation_date',
        'reservation_time',
        'num_guests',
        'total_price',
        'status',
        'notes',
        'end_time',
        'snap_token' // <-- WAJIB TAMBAHKAN INI AGAR BISA UPDATE TOKEN MIDTRANS
    ];

    /**
     * Relasi ke model User (Pemilik reservasi).
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Relasi ke model Restaurant.
     * SINKRONISASI: Diperlukan oleh Reservation::with('restaurant') di Controller index().
     */
    public function restaurant()
    {
        return $this->belongsTo(\App\Models\Restaurant::class);
    }

    /**
     * Relasi ke model Table (Meja yang dipesan).
     */
    public function table()
    {
        return $this->belongsTo(\App\Models\Table::class);
    }

    /**
     * Relasi Many-to-Many ke model Menu melalui tabel pivot 'reservation_menu'.
     * SINKRONISASI: Diperlukan oleh fungsi $reservation->menus()->attach(...) di Controller store().
     */
    public function menus()
    {
        return $this->belongsToMany(\App\Models\Menu::class, 'reservation_menu')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}