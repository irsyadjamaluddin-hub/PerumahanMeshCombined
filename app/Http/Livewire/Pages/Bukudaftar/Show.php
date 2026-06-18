<?php

namespace App\Http\Livewire\Pages\Bukudaftar;

use App\Models\IMS\User;
use Livewire\Component;
use App\Models\IMS\AssetEntry;
use App\Models\IMS\BukuDaftar;
use App\Models\IMS\BinCardEntry;
use Livewire\WithPagination;
use App\Models\IMS\LejarSimpanan;
use App\Models\IMS\AssetCategoryCode;
use App\Models\IMS\AssetEntrySetItem;

class Show extends Component
{
    use WithPagination;

    public $bukuDaftarId;
    public $bukuDaftar;
    public $assetEntry;
    public $assetEntrySetItems;
    public $assetCategoryCode;
    public $highlightKey;
    public $binCardEntries;

    public $filterName;

    public $createdBy;

    public function mount($id)
    {
        // Grab and set ID from Route
        $this->bukuDaftarId = $id;

        // Default Values
        $this->filterName = "asc";

        $bukuDaftar = BukuDaftar::where('id', $this->bukuDaftarId)->first();

        $this->createdBy = User::where('id', $bukuDaftar->created_by)->first();

    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function highlightAssetEntries($key)
    {

        if($this->highlightKey == $key){
            $this->highlightKey = null;
        } else {
            $this->highlightKey = null;
            $this->highlightKey = $key;
        }
    }

    public function changeFilterName()
    {
        if($this->filterName == "asc"){
            $this->filterName = "desc";
        } else {
            $this->filterName = "asc";
        }
    }

    public function render()
    {
        $this->assetEntry = AssetEntry::all();
        $this->assetEntrySetItems = AssetEntrySetItem::all();
        $this->assetCategoryCode = AssetCategoryCode::all();
        $this->binCardEntries = BinCardEntry::all();

        $this->bukuDaftar = BukuDaftar::where('id', $this->bukuDaftarId)
            ->with(
                'bukuDaftarEntries.assetEntry.asset',
                'purchaseOrder.user',
                'invoice',
                'vendor',
                'bukuDaftarType')->first();

        return view('livewire.pages.bukudaftar.show');
    }

}
