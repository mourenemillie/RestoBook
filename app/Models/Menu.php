<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

   protected $fillable = [
    'restaurant_id',
    'name',
    'category',
    'description',
    'price',
    'image',
    'is_available',
];

    protected $casts = [
        'is_available' => 'boolean',
        'price'        => 'integer',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}