<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
<<<<<<< HEAD
    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     * SINKRONISASI: Menambahkan 'snap_token' agar sukses menyimpan token Midtrans ke database.
     */
=======
   
>>>>>>> ac62f328756ae709eeec56ca0e97b1cff3d92f39
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
<<<<<<< HEAD
        'snap_token' // <-- WAJIB TAMBAHKAN INI AGAR BISA UPDATE TOKEN MIDTRANS
    ];

    /**
     * Relasi ke model User (Pemilik reservasi).
     */
=======
        'snap_token' 
    ];

  
>>>>>>> ac62f328756ae709eeec56ca0e97b1cff3d92f39
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

<<<<<<< HEAD
    /**
     * Relasi ke model Restaurant.
     * SINKRONISASI: Diperlukan oleh Reservation::with('restaurant') di Controller index().
     */
=======

>>>>>>> ac62f328756ae709eeec56ca0e97b1cff3d92f39
    public function restaurant()
    {
        return $this->belongsTo(\App\Models\Restaurant::class);
    }

<<<<<<< HEAD
    /**
     * Relasi ke model Table (Meja yang dipesan).
     */
=======
   
>>>>>>> ac62f328756ae709eeec56ca0e97b1cff3d92f39
    public function table()
    {
        return $this->belongsTo(\App\Models\Table::class);
    }

<<<<<<< HEAD
    /**
     * Relasi Many-to-Many ke model Menu melalui tabel pivot 'reservation_menu'.
     * SINKRONISASI: Diperlukan oleh fungsi $reservation->menus()->attach(...) di Controller store().
     */
=======
   
>>>>>>> ac62f328756ae709eeec56ca0e97b1cff3d92f39
    public function menus()
    {
        return $this->belongsToMany(\App\Models\Menu::class, 'reservation_menu')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}