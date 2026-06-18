<?php

namespace App\Http\Livewire\Pages\StoreInventory;

use App\Models\IMS\User;
use App\Models\IMS\Invoice;

use Livewire\Component;
use App\Models\IMS\BukuDaftar;
use App\Models\IMS\BinCardEntry;
use Livewire\WithPagination;
use App\Models\IMS\LejarSimpanan;
use App\Models\IMS\PurchaseOrder;
use App\Models\IMS\AssetCategoryCode;
use Illuminate\Support\Facades\DB;
use App\Models\IMS\MainAssetCategoryCode;

class View extends Component
{
    use WithPagination;

    protected $finalQuery;

    public $dateFrom;
    public $dateTo;

    public $categoryCodeId;
    public $categorySearchInput;
    public $categorySearchResults;

    public $users;
    public $assetCategoryCodes;
    public $mainAssetCategoryCodes;

    public $sortBy;
    public $sortOrder;

    public $lejarSimpanans;
    public $purchaseOrders;
    public $invoices;

    public $bukuDaftars;

    public function mount()
    {
        $this->mainAssetCategoryCodes = MainAssetCategoryCode::all();
        $this->mainAssetCategoryCodes = MainAssetCategoryCode::all();
        $this->assetCategoryCodes = AssetCategoryCode::all();
        $this->purchaseOrders = PurchaseOrder::all();
        $this->lejarSimpanans = LejarSimpanan::all();
        $this->bukuDaftars = BukuDaftar::all();
        $this->invoices = Invoice::all();
        $this->users = User::all();

        $this->sortOrder = "desc";
        $this->sortBy = "created_at";
    }

    public function filterByCategoryCodes($categoryCodeId)
    {
        $this->categoryCodeId = $categoryCodeId;
        $this->applyFilters();
        $this->resetPage();
    }

    public function filterByDate()
    {
        $this->applyFilters();
        $this->resetPage();
    }

    public function sortByLastUpdated()
    {
        $this->sortBy = "created_at";

        if($this->sortOrder == "asc"){
            $this->sortOrder = "desc";
        } else {
            $this->sortOrder = "asc";
        }

        $this->applyFilters();
    }

    public function applyFilters()
    {
        // Check FinalQuery
        if(isset($this->finalQuery)){
            $query = $this->finalQuery;
        } else {
            $query = $this->finalQuery = BinCardEntry::with('binCard.asset.assetCategoryCode.mainAssetCategoryCode', 'bincard.asset.assetEntries')->where('out_quantity', '=', null);
        }

        // Category Code Filter
        if (isset($this->categoryCodeId) && $this->categoryCodeId !== "all") {
            $query->whereHas('binCard', function ($query) {
                $query->whereHas('asset', function ($query) {
                    $query->where('asset_category_code_id', $this->categoryCodeId);
                });
            });
        }

        // SortBy Filter
        if (isset($this->dateFrom) && isset($this->dateTo)) {
            $query->whereBetween('created_at', [$this->dateFrom, $this->dateTo]);
        }

        if($this->sortBy == "created_at" && $this->sortOrder == "asc"){

            $this->finalQuery = $query->orderBy('created_at');

        } elseif($this->sortBy == "created_at" && $this->sortOrder == "desc") {

            $this->finalQuery = $query->orderByDesc('created_at');
        }

    }

    public function searchCategoryCode()
    {
        $explodedName = explode(" ", $this->categorySearchInput);
        $categoryCodes = AssetCategoryCode::query();

        foreach ($explodedName as $input) {
            $categoryCodes->orWhere(function ($query) use ($input) {
                $query->where('name', 'like', "%$input%")
                    ->orWhere('code', 'like', "%$input%");
            });
        }

        $this->categorySearchResults = $categoryCodes->take(10)->get();
    }

    public function clearSearchCategory()
    {
        $this->categorySearchInput = null;
        $this->categorySearchResults = null;
    }

    public function clearAllFilters()
    {
        $this->categoryCodeId = null;
        $this->dateFrom = null;
        $this->dateTo = null;

        $this->applyFilters();
    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function render()
    {
        $this->applyFilters();

        return view('livewire.pages.store-inventory.view', [
            'binCardEntries' => $this->finalQuery->paginate(5),
        ]);
    }

}
