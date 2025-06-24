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
        Schema::table('set_times', function (Blueprint $table) {
            $table->time('from')->default('09:00:00')->change();
            $table->time('to')->default('05:00:00')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('set_times', function (Blueprint $table) {
            $table->time('from')->default('09:00:00');
            $table->time('to')->default('05:00:00');
        });
    }
};
