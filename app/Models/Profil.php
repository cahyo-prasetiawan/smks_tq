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

    protected static function booted()
{
    static::updating(function ($profil) {
        // Daftar kolom gambar yang ingin dipantau
        $imageFields = ['logo', 'foto_pengasuh', 'foto_kepala_sekolah', 'banner_sekolah'];

        foreach ($imageFields as $field) {
            // 1. Cek apakah kolom tersebut berubah (isDirty)
            // 2. Pastikan nilai lamanya tidak kosong (null)
            if ($profil->isDirty($field) && $profil->getOriginal($field) !== null) {
                
                $oldPath = $profil->getOriginal($field);

                // Hapus file lama dari disk public
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        }
    });

    // Opsional: Hapus semua gambar jika data profil dihapus (Delete)
    static::deleting(function ($profil) {
        $imageFields = ['logo', 'foto_pengasuh', 'foto_kepala_sekolah', 'banner_sekolah'];
        
        foreach ($imageFields as $field) {
            if ($profil->$field) {
                Storage::disk('public')->delete($profil->$field);
            }
        }
    });
    }
}
