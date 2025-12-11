<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Berita extends Model
{
   protected $guarded = [];

    protected $casts = [
       'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::deleting(function ($berita) {
            
            // 1. HAPUS GAMBAR UTAMA (Cover)
            if ($berita->image) {
                Storage::disk('public')->delete($berita->image);
            }

            // 2. HAPUS GAMBAR DI DALAM KONTEN (RichEditor)
            if (!empty($berita->content)) {
                // Gunakan DOMDocument untuk membedah HTML
                $dom = new \DOMDocument();
                
                // Gunakan @ untuk menyembunyikan warning jika HTML tidak valid sempurna
                @$dom->loadHTML($berita->content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

                // Ambil semua tag <img>
                $images = $dom->getElementsByTagName('img');

                foreach ($images as $img) {
                    $src = $img->getAttribute('src');

                    // Cek apakah gambar tersebut berasal dari server kita (bukan link luar/google)
                    // URL biasanya: http://localhost:8000/storage/berita/konten/foto.jpg
                    if (Str::contains($src, '/storage/')) {
                        
                        // Kita perlu mengambil path relatif: "berita/konten/foto.jpg"
                        // Hapus bagian domain dan '/storage/'
                        $path = parse_url($src, PHP_URL_PATH); // Ambil path-nya saja: /storage/berita/konten/foto.jpg
                        $relativePath = str_replace('/storage/', '', $path); // Hapus '/storage/': berita/konten/foto.jpg

                        // Hapus file fisik
                        if (Storage::disk('public')->exists($relativePath)) {
                            Storage::disk('public')->delete($relativePath);
                        }
                    }
                }
            }
        });
    }
}
