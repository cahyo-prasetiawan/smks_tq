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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('image');
        $table->string('category'); // Akademik, Unit Produksi, Prestasi, dll
        $table->text('content')->nullable(); // Isi berita singkat
        $table->date('published_at');
        $table->boolean('is_active')->default(true);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
