<?php

namespace App\Http\Livewire\Pages\Ledger;

use App\Models\IMS\User;
use App\Models\IMS\Vendor;
use Livewire\Component;
use App\Models\IMS\AssetEntry;
use Livewire\WithPagination;
use App\Models\IMS\LejarSimpanan;
use App\Models\IMS\AssetCategoryCode;
use App\Models\IMS\AssetEntrySetItem;
use App\Models\IMS\BinCardEntry;

class Show extends Component
{
    use WithPagination;

    public $lejarSimpananId;
    public $lejarSimpanan;
    public $assetEntry;
    public $assetEntrySetItems;
    public $assetCategoryCode;
    public $highlightKey;
    public $createdBy;
    public $binCardEntries;

    public $filterName;

    public function mount($id)
    {
        // Grab and set ID from Route
        $this->lejarSimpananId = $id;

        // Default Values
        $this->filterName = "asc";

        $lejarSimpanan = LejarSimpanan::where('id', $this->lejarSimpananId)->first();

        $this->createdBy = User::where('id', $lejarSimpanan->created_by)->first();

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

        $this->lejarSimpanan = LejarSimpanan::where('id', $this->lejarSimpananId)
            ->with(
                'lejarSimpananEntries.assetEntry.asset',
                'purchaseOrder.user',
                'invoice',
                'vendor',
                'srv')->first();

        return view('livewire.pages.ledger.show');
    }
}
