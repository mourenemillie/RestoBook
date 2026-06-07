<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('restaurants', function ($table) {
        $table->time('open_time')->nullable();
        $table->time('close_time')->nullable();
    });
}

public function down()
{
    Schema::table('restaurants', function ($table) {
        $table->dropColumn(['open_time', 'close_time']);
    });
}
};
