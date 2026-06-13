<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservation_menu', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ID Reservasi dan ID Menu
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            // Menyimpan jumlah porsi makanan yang dipesan user
            $table->integer('quantity')->default(1); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation_menu');
    }
};