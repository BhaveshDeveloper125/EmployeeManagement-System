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
        Schema::table('extra_user_data', function (Blueprint $table) {
            $table->string('unused_leaves')->nullable()->after('leaves');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('extra_user_data', function (Blueprint $table) {
            $table->string('unused_leaves')->nullable()->after('leaves');
        });
    }
};
