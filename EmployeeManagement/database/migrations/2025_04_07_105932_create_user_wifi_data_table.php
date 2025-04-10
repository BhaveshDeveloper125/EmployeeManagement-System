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
        Schema::create('user_wifi_data', function (Blueprint $table) {
            $table->id();
            $table->string('wifi_name')->nullable();
            $table->string('ssid')->nullable();
            $table->string('ip')->nullable();
            $table->string('gateway')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_wifi_data');
    }
};
