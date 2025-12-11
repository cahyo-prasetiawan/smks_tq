<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Profil;

class VisiPage extends Component
{
      public function mount()
    {
        // Ambil data profil pertama dan simpan ke properti $this->profil
        $this->profil = Profil::first();
    }

    public function render()
    {
        return view('livewire.visi-page',[
            'profil' => $this->profil,
        ]) 
        ->layout('components.layouts.app', [
            'title' => 'Visi & Misi - SMKS IT Tanwirul Qulub',
            ]);
    }
}
