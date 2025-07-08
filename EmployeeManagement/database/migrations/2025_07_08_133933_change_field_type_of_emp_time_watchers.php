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
        Schema::table('employee_time_watchers', function (Blueprint $table) {
            $table->dateTime('entry')->change();
            $table->dateTime('leave')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_time_watchers', function (Blueprint $table) {
            $table->string('entry')->change();
            $table->string('leave')->change();
        });
    }
};
