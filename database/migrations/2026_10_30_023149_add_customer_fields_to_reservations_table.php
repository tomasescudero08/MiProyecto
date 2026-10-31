<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Asegúrate de agregar los campos que faltaban
            if (!Schema::hasColumn('reservations', 'room_id')) {
                $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            }
            if (!Schema::hasColumn('reservations', 'customer_name')) {
                $table->string('customer_name')->nullable();
            }
            if (!Schema::hasColumn('reservations', 'customer_email')) {
                $table->string('customer_email')->nullable();
            }
            if (!Schema::hasColumn('reservations', 'customer_phone')) {
                $table->string('customer_phone')->nullable();
            }
            if (!Schema::hasColumn('reservations', 'special_requests')) {
                $table->text('special_requests')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['room_id', 'customer_name', 'customer_email', 'customer_phone', 'special_requests']);
        });
    }
};
