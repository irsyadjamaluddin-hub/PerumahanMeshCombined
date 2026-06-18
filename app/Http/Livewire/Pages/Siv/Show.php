<?php

namespace App\Http\Livewire\Pages\Siv;

use App\Models\IMS\BorangPenyerahans;
use App\Models\IMS\Siv;
use App\Models\IMS\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IMS\BukuDaftarEntry;
use App\Models\IMS\LejarSimpananEntry;

class Show extends Component
{
    use WithPagination;

    public $siv;
    public $users;
    public $sivId;
    public $filterName;
    public $bukuDaftarEntry;
    public $lejarSimpananEntry;
    public $borangPenyerahan;

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

        $this->users = User::all();

        $this->borangPenyerahan = BorangPenyerahans::where('siv_id', $this->sivId)->first();

    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function render()
    {
        return view('livewire.pages.siv.show');
    }
}
