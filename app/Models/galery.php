<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class galery extends Model
{
   protected $guarded = [];

    protected $casts = [
        'event_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Helper untuk class CSS di Blade nanti
    public function getGridClassAttribute()
    {
        return match ($this->grid_size) {
            'large' => 'md:col-span-2 md:row-span-2', // Kotak Besar Kiri
            'wide'  => 'md:col-span-2',               // Persegi Panjang Bawah
            default => '',                            // Kotak Kecil Biasa
        };
    }

     protected static function booted(): void
    {
        // Event saat data AKAN dihapus (deleting)
        static::deleting(function ($galleries) {
            
            // Cek apakah ada data gambar
            if ($galleries->image) {
                // Hapus file fisik dari disk 'public'
                Storage::disk('public')->delete($galleries->image);
            }

            // Jika Anda menggunakan RichEditor dan menyimpan gambar di dalam konten (body),
            // Anda mungkin butuh logika tambahan di sini untuk scanning folder konten,
            // tapi untuk gambar utama (cover), kode di atas sudah cukup.
        });
        
        // Opsional: Event saat data DIUPDATE (ganti gambar)
        // Filament biasanya menangani ini otomatis, tapi jika tidak, bisa pakai event 'updating'.
    }
}
