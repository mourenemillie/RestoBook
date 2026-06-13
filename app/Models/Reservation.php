<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
   
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
        'snap_token' 
    ];

  
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }


    public function restaurant()
    {
        return $this->belongsTo(\App\Models\Restaurant::class);
    }

   
    public function table()
    {
        return $this->belongsTo(\App\Models\Table::class);
    }

   
    public function menus()
    {
        return $this->belongsToMany(\App\Models\Menu::class, 'reservation_menu')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}