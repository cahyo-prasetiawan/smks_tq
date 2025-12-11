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
        Schema::create('visitors', function (Blueprint $table) {
           $table->id();
        $table->string('ip_address')->nullable(); // Simpan IP agar tidak double count per hari
        $table->string('user_agent')->nullable(); // Info Browser/HP
        $table->date('visit_date'); // Tanggal kunjungan
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
