<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Berita;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Title; // Untuk judul tab browser dinamis

class ShowBerita extends Component
{
    public $slug;
    public $berita;
    public $relatedNews;

    public function mount($slug)
    {
        $this->slug = $slug;

        // 1. Ambil data berita. Jika slug salah, otomatis 404 Not Found.
        $this->berita = Berita::where('slug', $slug)->firstOrFail();

        // 2. Logika Hitung Views (Hanya nambah jika sesi baru)
        $sessionKey = 'viewed_berita_' . $this->berita->id;
        if (!Session::has($sessionKey)) {
            $this->berita->increment('views');
            Session::put($sessionKey, true);
        }

        // 3. Ambil Berita Lainnya untuk Sidebar (Kecuali yang sedang dibuka)
        $this->relatedNews = Berita::where('id', '!=', $this->berita->id)
            ->latest() // Urutkan terbaru
            ->take(4)  // Ambil 4 biji
            ->get();
    }

    public function render()
    {
       return view('livewire.show-berita')
            ->layout('components.layouts.app', [
            'title' => $this->berita->title . ' - SMKS IT Tanwirul Qulub',
            ]);
    }
}
