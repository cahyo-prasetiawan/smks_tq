<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Produk extends Model
{
    protected $guarded = []; // Izinkan semua kolom diisi

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'integer',
    ];

     protected static function booted(): void
    {
        // Event saat data AKAN dihapus (deleting)
        static::deleting(function ($produk) {
            
            // Cek apakah ada data gambar
            if ($produk->image) {
                // Hapus file fisik dari disk 'public'
                Storage::disk('public')->delete($produk->image);
            }

            // Jika Anda menggunakan RichEditor dan menyimpan gambar di dalam konten (body),
            // Anda mungkin butuh logika tambahan di sini untuk scanning folder konten,
            // tapi untuk gambar utama (cover), kode di atas sudah cukup.
        });
        
        // Opsional: Event saat data DIUPDATE (ganti gambar)
        // Filament biasanya menangani ini otomatis, tapi jika tidak, bisa pakai event 'updating'.
    }
}
