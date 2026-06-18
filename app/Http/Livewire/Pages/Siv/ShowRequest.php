<?php

namespace App\Http\Livewire\Pages\Siv;

use App\Models\IMS\BukuDaftarEntry;
use App\Models\IMS\LejarSimpananEntry;
use App\Models\IMS\Siv;
use Livewire\Component;
use Livewire\WithPagination;

class ShowRequest extends Component
{
    use WithPagination;

    public $siv;
    public $sivId;
    public $filterName;
    public $bukuDaftarEntry;
    public $lejarSimpananEntry;

    public function mount($id)
    {
        // Grab and set ID from Route
        $this->sivId = $id;

        // Default Values
        $this->filterName = "asc";

        $this->lejarSimpananEntry = LejarSimpananEntry::with('lejarSimpanan')->get();
        $this->bukuDaftarEntry = BukuDaftarEntry::with('bukuDaftar')->get();

        $this->siv = Siv::where('id', $this->sivId)
            ->with('sivAssetEntries', 'receiver.receiverLocation')->first();
    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function render()
    {
        return view('livewire.pages.siv.show-request');
    }
}
