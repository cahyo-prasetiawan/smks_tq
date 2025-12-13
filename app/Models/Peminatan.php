<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class peminatan extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'video_url', 'image', 'facilities', 'nomer_penanggung_jawab'];

    protected $casts = [
        'facilities' => 'array',
    ];

     protected static function booted(): void
    {
        // Event saat data AKAN dihapus (deleting)
        static::deleting(function ($peminatan) {
            
            // Cek apakah ada data gambar
            if ($peminatan->image) {
                // Hapus file fisik dari disk 'public'
                Storage::disk('public')->delete($peminatan->image);
            }

            // Jika Anda menggunakan RichEditor dan menyimpan gambar di dalam konten (body),
            // Anda mungkin butuh logika tambahan di sini untuk scanning folder konten,
            // tapi untuk gambar utama (cover), kode di atas sudah cukup.
        });
        
        // Opsional: Event saat data DIUPDATE (ganti gambar)
        // Filament biasanya menangani ini otomatis, tapi jika tidak, bisa pakai event 'updating'.
    }
}
