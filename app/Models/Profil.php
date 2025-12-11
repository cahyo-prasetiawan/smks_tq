<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; 

class Profil extends Model
{
    protected $guarded = [];

    protected $casts = [
        'misi' => 'array',
    ];

    protected function misi(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => is_array($value) ? implode('|', $value) : $value,
            get: fn (string $value) => explode('|', $value),
        );
    }

    // Mutator untuk Kolom Visi (Juga untuk pencegahan Rich Editor/lainnya)
    protected function visi(): Attribute
    {
        return Attribute::make(
            // Pastikan jika nilai adalah array, diubah menjadi string.
            set: fn ($value) => is_array($value) ? implode(' ', $value) : $value,
            // Mutator GET tidak perlu dilakukan jika visi selalu string
        );
    }

     protected static function booted(): void
    {
        // Event saat data AKAN dihapus (deleting)
        static::updating(function ($profil) {
    // Cek apakah kolom 'logo' telah diubah
    if ($profil->isDirty('logo') && ($profil->getOriginal('logo') !== null)) {
        
        // Dapatkan path logo lama
        $oldLogoPath = $profil->getOriginal('logo');
        
        // Hapus file lama
        Storage::disk('public')->delete($oldLogoPath);
    }
});
        
        // Opsional: Event saat data DIUPDATE (ganti gambar)
        // Filament biasanya menangani ini otomatis, tapi jika tidak, bisa pakai event 'updating'.
    }
}
