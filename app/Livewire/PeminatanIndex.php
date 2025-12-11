<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Peminatan;
use App\Models\Berita;

class PeminatanIndex extends Component
{
    public $berita;

    public function render()
    {
        $peminatans = Peminatan::all();
        $this->berita = Berita::all();

        return view('livewire.peminatan-index', [
            'peminatans' => $peminatans
        ])->layout('components.layouts.app', [
             'title' => 'Semua Peminatan - SMKS IT Tanwirul Qulub',
            ]);

    }
}
