<?php

namespace App\Http\Livewire\Pages\Statistics;

use Livewire\Component;

class View extends Component
{
    public $data;

    public function mount()
    {
        $this->data = [
            'labels' => ['January', 'February', 'March', 'April', 'May'],
            'data1' => [65, 59, 40, 81, 56],
            'data2' => [57, 23, 80, 97, 94],
        ];
    }

    public function render()
    {
        return view('livewire.pages.statistics.view');
    }
}
