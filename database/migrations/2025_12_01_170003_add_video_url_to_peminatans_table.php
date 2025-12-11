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
        Schema::table('peminatans', function (Blueprint $table) {
              // Menambahkan kolom video_url setelah kolom description
            // nullable() artinya boleh dikosongkan jika belum ada videonya
            $table->string('video_url')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminatans', function (Blueprint $table) {
            //
        });
    }
};
