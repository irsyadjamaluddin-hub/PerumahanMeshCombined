<?php

namespace App\Http\Livewire\Pages\Siv;

use Livewire\Component;

class DownloadPdf extends Component
{

    public $rando;

    public function mount($id)
    {
        dd($id);
        $this->rando = "savd7823gdvfjhsd";
    }

    public function render()
    {
        return view('livewire.pages.siv.download-pdf');
    }
}
