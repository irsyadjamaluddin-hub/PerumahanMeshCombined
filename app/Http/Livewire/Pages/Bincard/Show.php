<?php

namespace App\Http\Livewire\Pages\Bincard;

use App\Models\IMS\Siv;
use App\Models\IMS\User;
use App\Models\IMS\Vendor;
use App\Models\IMS\BinCard;
use Livewire\Component;
use App\Models\IMS\Receiver;
use App\Models\IMS\AssetEntry;
use App\Models\IMS\BinCardEntry;
use Livewire\WithPagination;
use App\Models\IMS\SivAssetEntry;
use App\Models\IMS\BukuDaftarEntry;
use App\Models\IMS\LejarSimpanan;
use App\Models\IMS\LejarSimpananEntry;

class Show extends Component
{
    use WithPagination;

    public $assetEntries;
    private $finalQuery;
    public $currentSort;

    public $binCardId;
    public $binCard;
    public $vendor;
    public $user;
    public $receivers;
    public $lejarSimpanans;
    public $lejarSimpananEntry;
    public $bukuDaftarEntry;
    public $minPercent;

    public function mount($id)
    {
        // Grab and set ID from Route
        $this->binCardId = $id;
        $this->binCard = BinCard::where('id', $id)->with('binCardEntries', 'asset.assetCategoryCode', 'asset.assetEntries.lejarSimpananEntry.lejarSimpanan', 'store')->first();
        $this->vendor = Vendor::all();
        $this->user = User::all();
        $this->assetEntries = AssetEntry::all();
        $this->lejarSimpananEntry = LejarSimpananEntry::all();
        $this->lejarSimpanans = LejarSimpanan::all();
        $this->bukuDaftarEntry = BukuDaftarEntry::with('bukuDaftar.bukuDaftarType')->get();

        $this->receivers = Receiver::with('receiverLocation')->get();

        $this->currentSort = "desc";

        $this->minPercent = 0.3;
    }

    public function sortByDate()
    {
        if($this->currentSort == "asc"){
            $this->currentSort = "desc";
        } else {
            $this->currentSort = "asc";
        }
    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function render()
    {
        $this->finalQuery = BinCardEntry::where('bin_card_id', $this->binCardId)->orderBy('created_at', $this->currentSort);

        return view('livewire.pages.bincard.show', [
            'binCardEntries' =>  $this->finalQuery->paginate(10),
        ]);
    }
}
