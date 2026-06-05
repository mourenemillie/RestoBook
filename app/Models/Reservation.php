<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'restaurant_id',
        'table_id',
        'reservation_date',
        'reservation_time',
        'num_guests',
        'status',
        'notes'
    ];
    
public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
    }