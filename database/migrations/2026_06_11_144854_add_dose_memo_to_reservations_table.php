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
            $table->decimal('dose_value', 8, 2)->nullable()->after('memo');
            $table->string('dose_unit')->nullable()->after('dose_value');
            $table->text('dose_memo')->nullable()->after('dose_unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['dose_value', 'dose_unit', 'dose_memo']);
        });
    }
};
