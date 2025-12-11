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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
        $table->string('name');             // Nama Produk
        $table->string('slug')->unique();   // URL ramah SEO
        $table->string('category');         // Kategori (Las, Busana, dll)
        $table->decimal('price', 12, 0)->nullable();    // Harga (angka saja)
        $table->string('unit')->nullable(); // Satuan (misal: /m, /stel)
        $table->string('image')->nullable();// Foto Produk
        $table->text('description')->nullable(); // Deskripsi singkat
        $table->boolean('is_active')->default(true); // Status tayang
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
