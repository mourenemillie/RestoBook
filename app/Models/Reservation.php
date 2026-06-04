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
        'guest_count',
        'status'
    ];
}