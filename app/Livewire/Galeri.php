<?php

namespace App\Livewire;

use App\Models\Galery;
use Livewire\Component;
use Livewire\WithPagination;

class Galeri extends Component
{
    use WithPagination;

    public function render()
    {    
        // Ambil 4 galeri terbaru yang aktif
        // Urutkan berdasarkan tanggal kegiatan terbaru
       // Ambil semua data aktif, urutkan terbaru, bagi 12 per halaman
        $galleries = Galery::query()
            ->where('is_active', true)
            ->orderBy('event_date', 'desc')
            ->paginate(12);

        return view('livewire.galeri', [
            'galleries' => $galleries
        ])->layout('components.layouts.app', [
            'title' => 'Semua Galeri - SMKS IT Tanwirul Qulub',
            'description' => 'Dokumentasi lengkap Workshop siswa dan Kegiatan sekolah.']);
    }
}
