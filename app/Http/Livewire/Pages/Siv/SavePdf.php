<?php

namespace App\Http\Livewire\Pages\Siv;

use Livewire\Component;

class SavePdf extends Component
{   
    public function mount()
    {
     
    }

    public function render()
    {
        return view('livewire.pages.siv.save-pdf')->layout('livewire.layouts.no-layout');
    }
}
