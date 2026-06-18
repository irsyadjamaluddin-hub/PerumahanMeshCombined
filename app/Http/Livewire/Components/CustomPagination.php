<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;

class CustomPagination extends Component
{
    use WithPagination;

    public function render()
    {
        return 'livewire.components.custom-pagination';
    }
}
