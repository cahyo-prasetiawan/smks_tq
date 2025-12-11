<?php

namespace App\Livewire;

use App\Models\Berita;
use Livewire\Component;
use Livewire\WithPagination;


class BeritaPage extends Component
{
    use WithPagination;

    // 1. Property untuk menampung input pencarian
    public $search = '';

    // 2. Reset pagination saat user mengetik
    // (Penting: agar jika user ada di halaman 5 lalu mencari, tidak error karena hasil pencarian cuma 1 halaman)
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Ambil data aktif, urutkan terbaru, 9 per halaman
       // 1. QUERY UTAMA (Halaman Berita)
    $beritas = Berita::query()
        // Filter Global: Pastikan HANYA berita aktif yang diambil
        ->where('is_active', true)

        // Logika Pencarian
        ->when($this->search, function($query) {
            $query->where(function($q) { // <--- PENTING: Grouping (Tanda Kurung)
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        })
        ->latest()
        ->paginate(6);

            // 2. QUERY SIDEBAR (Berita Terbaru)
            // Jangan lupa filter is_active juga di sini!
            $latestNews = Berita::where('is_active', true)
                ->latest()
                ->take(4)
                ->get();

            // 3. QUERY SIDEBAR (Berita Populer)
            // Jangan lupa filter is_active juga!
            $popularNews = Berita::where('is_active', true)
                ->orderBy('views', 'desc')
                ->take(3)
                ->get();

        return view('livewire.berita-page', [
            'beritas'     => $beritas,
            'latestNews'  => $latestNews,
            'popularNews' => $popularNews
        ])->layout('components.layouts.app', [
            'title' => 'Berita & Artikel - SMKS IT Tanwirul Qulub',
        ]);

    }
    
    
}
