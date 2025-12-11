<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk;
use Livewire\WithPagination;

class ProdukIndex extends Component
{
    // Wajib: Mengaktifkan Pagination
    use WithPagination; 

    // Properti publik untuk filter dan pencarian
    public $search = '';
    public $filterCategory = null;
    protected $paginationTheme = 'tailwind'; // Menggunakan style pagination Tailwind

    /**
     * Dipanggil saat input pencarian berubah.
     * Mengatur ulang halaman ke-1 agar filter berfungsi dengan benar.
     */
    public function updatingSearch()
    {
        $this->resetPage(); 
    }

    /**
     * Dipanggil saat filter kategori dari sidebar diklik.
     */
    public function setCategoryFilter($category)
    {
        $this->filterCategory = $category;
        $this->resetPage();
    }

    /**
     * Method untuk mereset semua filter (pencarian dan kategori).
     */
    public function clearFilters()
    {
        $this->filterCategory = null;
        $this->search = '';
        $this->resetPage();
    }

    /**
     * Method utama untuk mengambil data dan merender view.
     */
    public function render()
    {
        // 1. Query Utama (Paginated Products)
        $products = Produk::where('is_active', true)
            // Filter berdasarkan pencarian (nama, deskripsi)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                      ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            // Filter berdasarkan kategori yang dipilih
            ->when($this->filterCategory, function ($query) {
                $query->where('category', $this->filterCategory);
            })
            ->latest()
            ->paginate(9); // 9 item per halaman (agar rapi 3x3)

        // 2. Data Sidebar (Latest Products)
        $latestProducts = Produk::where('is_active', true)
            ->latest()
            ->take(4)
            ->get();

        // 3. Data Sidebar (Categories untuk tombol filter)
        $categories = Produk::select('category')->distinct()->pluck('category');

        return view('livewire.produk-index', [
            'products' => $products,
            'latestProducts' => $latestProducts,
            'categories' => $categories,
        ]);
    }
}
