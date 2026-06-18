<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Toast extends Component
{
    public $toastMessage;
    public $toastDescription;

    public function mount()
    {
        if(session('success')){

            // -------------------------------------------------------------
            // Data from $prevData (success)
            // -------------------------------------------------------------

            $this->toastMessage = session('success.message');
            $this->toastDescription = session('success.description');
        
        } elseif(session('warning')){

            $this->toastMessage = session('warning.message');
            $this->toastDescription = session('warning.description');

        }
    }

    public function successToast()
    {   
        $data = [
            'position' => 'top-right',
            'type' => 'success',
            'message' => $this->toastMessage,
            'description' => $this->toastDescription,
        ];

        $this->dispatchBrowserEvent('toast-show', $data);
    }

    public function warningToast()
    {   
        $data = [
            'position' => 'top-right',
            'type' => 'warning',
            'message' => 'Warning',
            'description' => $this->toastDescription,
        ];

        $this->dispatchBrowserEvent('toast-show', $data);
    }

    public function render()
    {
        return view('livewire.components.toast');
    }
}
