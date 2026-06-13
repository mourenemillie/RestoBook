<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'restaurant_id',
        'table_number',
        'capacity'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}