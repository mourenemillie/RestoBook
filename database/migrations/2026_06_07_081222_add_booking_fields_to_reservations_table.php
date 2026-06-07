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
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('booking_code')->nullable()->after('id');
            $table->decimal('total_price', 10, 2)->nullable()->after('num_guests');
            $table->string('payment_proof')->nullable()->after('total_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['booking_code', 'total_price', 'payment_proof']);
        });
    }
};
