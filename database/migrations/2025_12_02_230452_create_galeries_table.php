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
        Schema::create('galeries', function (Blueprint $table) {
           $table->id();
        $table->string('title');
        $table->string('slug');
        $table->string('image');
        
        // Kita simpan nama kategorinya langsung (String)
        // Isinya bisa: 'Akademik', 'Kegiatan', 'Teknik Las', 'RPL', dll.
        $table->string('category'); 
        
        // Untuk layout Bento Grid
        $table->enum('grid_size', ['large', 'medium', 'wide'])->default('medium');
        
        $table->date('event_date');
        $table->text('description')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeries');
    }
};
