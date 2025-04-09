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
            $table->string('wifiName')->nullable();
            $table->string('BSSID')->nullable();
            $table->string('ipv4')->nullable();
            $table->string('ipv6')->nullable();
            $table->string('broadcast')->nullable();
            $table->string('gateway')->nullable();
            $table->string('submask')->nullable();
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
