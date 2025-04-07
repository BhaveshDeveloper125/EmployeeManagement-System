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
            $table->string('wifiName');
            $table->string('BSSID');
            $table->string('ipv4');
            $table->string('ipv6');
            $table->string('broadcast');
            $table->string('gateway');
            $table->string('submask');
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
