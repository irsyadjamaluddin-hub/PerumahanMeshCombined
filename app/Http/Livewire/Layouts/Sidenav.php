<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Sidenav extends Component
{
    public function render()
    {
        return view('livewire.layouts.sidenav');
    }
}
