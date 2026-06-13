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
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE reservations DROP CONSTRAINT IF EXISTS reservations_status_check');
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE reservations ADD CONSTRAINT reservations_status_check CHECK (status::text = ANY (ARRAY['pending'::character varying, 'paid'::character varying, 'completed'::character varying, 'cancelled'::character varying, 'failed'::character varying, 'approved'::character varying, 'rejected'::character varying]::text[]))");
    }

    public function down(): void
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE reservations DROP CONSTRAINT IF EXISTS reservations_status_check');
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE reservations ADD CONSTRAINT reservations_status_check CHECK (status::text = ANY (ARRAY['pending'::character varying, 'paid'::character varying, 'completed'::character varying, 'cancelled'::character varying, 'failed'::character varying]::text[]))");
    }
};
