<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Produk;
use App\Models\Peminatan;

class ShowProduk extends Component
{
    public Produk $product;
    public $relatedProducts;
    public Peminatan $peminatan;

    /**
     * Method mount dipanggil saat komponen diinisialisasi.
     * Digunakan untuk mengambil data berdasarkan slug dari URL.
     */
    public function mount($slug)
    {
        // Cari produk berdasarkan slug, jika tidak ada, tampilkan 404
        $this->product = Produk::where('slug', $slug)->firstOrFail();

       $data = $this->product->category;
    $this->peminatan = Peminatan::where('title', $data)->firstOrFail();
      
    }

    public function render()
    {
        $this->relatedProducts = Produk::where('category', $this->product->category)
                                        // Kecualikan produk yang sedang dilihat
                                        ->where('id', '!=', $this->product->id)
                                        ->where('is_active', true)
                                        ->inRandomOrder() // Ambil secara acak
                                        ->take(4)       // Batasi hingga 4 item
                                        ->get();

        $title = $this->product->name . ' - Produk TEFA';
        $nomer = $this->peminatan->nomer_penanggung_jawab;

        
        return view('livewire.show-produk',[
            'peminatan' => $this->peminatan, // <-- Menggunakan properti kelas $this->peminatan
        ])
            ->title($title)
            ->layoutData(['nomer_penanggung_jawab' => $nomer]);
    }
}
