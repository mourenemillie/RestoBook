<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

<<<<<<< HEAD
    /**
     * Relasi Aman ke Model Meja (Satu restoran memiliki banyak meja)
     */
    public function tables()
    {
        // Fitur Deteksi Otomatis Nama Model Meja agar tidak memicu Class Not Found
        if (class_exists(\App\Models\Table::class)) {
            return $this->hasMany(\App\Models\Table::class);
        }
        
        // Jika di proyekmu nama modelnya diganti menjadi RestoTable, Laravel otomatis membaca yang ini
        return $this->hasMany(\App\Models\RestoTable::class);
    }
}
=======
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }
}
>>>>>>> ac62f328756ae709eeec56ca0e97b1cff3d92f39
