<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            // Kolom Tambahan Khusus untuk Identifikasi & Integrasi Payment Gateway
            $table->string('booking_code')->unique(); // Tambahan: Wajib untuk invoice Midtrans
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->foreignId('table_id')->constrained()->onDelete('cascade');
            
            $table->date('reservation_date');
            $table->time('reservation_time');
            $table->time('end_time')->nullable();
            $table->integer('num_guests');
            
            // Kolom Tambahan untuk Menyimpan Total Uang (Harga Menu + Biaya Aplikasi)
            $table->decimal('total_price', 12, 2)->default(0); // Tambahan: Wajib untuk menyimpan grand total
            
            $table->enum('status', ['pending','confirmed','cancelled','completed'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};