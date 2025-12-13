<?php

namespace App\Livewire;

use App\Models\Slider;
use Livewire\Component;
use App\Models\Peminatan;
use Livewire\Attributes\Title;
use App\Models\Galery;
use App\Models\Berita;
use App\Models\Produk;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;
    
    public $search = '';
    public $filterCategory = null;
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        // Ambil data slider yang aktif
        $sliders = Slider::where('is_active', true)
            ->latest() // Urutkan dari yang terbaru
            ->get();
       
        $peminatans = Peminatan::all();

        $galleries = Galery::query()
        ->where('is_active', true)
        ->orderBy('event_date', 'desc')
        ->take(4)
        ->get();

        $beritas = Berita::where('is_active', true)
        ->latest('published_at')
        ->take(3)
        ->get();

        $produk = Produk::where('is_active', true)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                      ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->when($this->filterCategory, function ($query) {
                $query->where('category', $this->filterCategory);
            })
            ->latest()
            ->paginate(8);

        return view('livewire.home', [
            'sliders' => $sliders,
            'peminatans' => $peminatans,
            'galleries' => $galleries,
            'beritas' => $beritas,
            'produk' => $produk,
            // Kita konsisten pakai nama 'tefaUnits' agar sesuai dengan component blade
        ])->layout('components.layouts.app', [
            'title' => 'Beranda - SMKS IT Tanwirul Qulub',
            'description' => 'Selamat datang di SMK Digital, sekolah menengah kejuruan terdepan yang mengintegrasikan teknologi digital dalam setiap aspek pembelajaran dan pengembangan keterampilan siswa.',
        ]);
    }

    // Method untuk mengatur filter kategori dari sidebar
    // Method yang dipanggil saat search berubah, wajib ada agar pagination reset
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Method untuk mengatur filter kategori dari sidebar
    public function setCategoryFilter($category)
    {
        $this->filterCategory = $category;
        $this->resetPage();
    }

    // Method untuk reset semua filter
    public function clearFilters()
    {
        $this->filterCategory = null;
        $this->search = '';
        $this->resetPage();
    }
}
