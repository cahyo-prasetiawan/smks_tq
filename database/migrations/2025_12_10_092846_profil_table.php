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
        Schema::create('profils', function (Blueprint $table) {
        $table->id();
        $table->string('nama')->nullable();
        $table->string('npsn')->nullable();
        $table->string('email')->nullable();
        $table->string('telepon')->nullable();
        $table->text('alamat')->nullable();
        $table->text('visi')->nullable();
        $table->json('misi')->nullable();
        $table->string('logo')->nullable(); // Upload Logo
        $table->string('video_url')->nullable(); // Link Video Profil
        $table->string('facebook')->nullable();
        $table->string('instagram')->nullable();
        $table->string('youtube')->nullable();
        $table->string('tiktok')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
