<?php

namespace App\Http\Livewire\Pages\Ledger;

use App\Models\IMS\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IMS\LejarSimpanan;
use App\Models\IMS\AssetCategoryCode;
use App\Models\IMS\AssetEntryRequest;
use App\Models\IMS\LejarSimpananRequest;
use App\Models\IMS\AssetEntrySetItemRequest;

class ProcessRequest extends Component
{
    use WithPagination;

    public $lejarSimpananId;
    public $lejarSimpanan;
    public $assetEntry;
    public $assetEntrySetItems;
    public $assetCategoryCode;
    public $highlightKey;
    public $createdBy;
    public $originalLejarSimpanan;

    public $filterName;

    public function mount($id)
    {
        // Grab and set ID from Route
        $this->lejarSimpananId = $id;

        // Default Values
        $this->filterName = "asc";

        $lejarSimpanan = LejarSimpananRequest::where('id', $this->lejarSimpananId)->first();

        $this->originalLejarSimpanan = LejarSimpanan::where('purchase_order_id', $lejarSimpanan->purchase_order_id )->first();

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
        $this->assetEntry = AssetEntryRequest::all();
        $this->assetEntrySetItems = AssetEntrySetItemRequest::all();
        $this->assetCategoryCode = AssetCategoryCode::all();

        $this->lejarSimpanan = LejarSimpananRequest::where('id', $this->lejarSimpananId)
            ->with(
                'lejarSimpananEntryRequests.assetEntryRequest.asset',
                'purchaseOrder.user',
                'invoice',
                'vendor',
                'srv')->first();

        return view('livewire.pages.ledger.process-request');
    }
}
