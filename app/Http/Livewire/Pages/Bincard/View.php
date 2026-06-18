<?php

namespace App\Http\Livewire\Pages\Bincard;

use App\Models\IMS\Asset;
use App\Models\IMS\Store;
use App\Models\IMS\BinCard;
use Livewire\Component;
use App\Models\IMS\AssetEntry;
use App\Models\IMS\BinCardEntry;
use Livewire\WithPagination;
use App\Models\IMS\AssetCategoryCode;
use App\Models\IMS\MainAssetCategoryCode;

class View extends Component
{
    use WithPagination;

    protected $finalQuery;
    public $assetEntries;
    public $stores;
    public $mainAssetCategoryCodes;
    public $assetCategoryCodes;

    public $locationId;
    public $categoryCodeId;

    public $dateFrom;
    public $dateTo;

    public $currentLastUpdatedOrder;

    public $searchInput;
    public $searchResults;

    public $categorySearchInput;
    public $categorySearchResults;

    public $minPercent;

    public $sortBy;
    public $sortOrder;

    public function mount()
    {
        $this->sortBy = "created_at";
        $this->sortOrder = "asc";

        $this->finalQuery = BinCard::with('asset.assetCategoryCode', 'asset.assetEntries', 'binCardEntries');

        $this->assetEntries = AssetEntry::all();
        $this->stores = Store::all();
        $this->mainAssetCategoryCodes = MainAssetCategoryCode::all();
        $this->assetCategoryCodes = AssetCategoryCode::all();

        $this->minPercent = 0.3;

    }

    public function filterByLocation($locationId)
    {
        $this->locationId = $locationId;
        $this->applyFilters();
        $this->resetPage();
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
        if(isset($this->finalQuery)){
            $query = $this->finalQuery;
        } else {
            $query = BinCard::with('asset.assetCategoryCode', 'asset.assetEntries', 'binCardEntries');
        }

        // Search Bar
        if (isset($this->searchInput)) {

            $explodedName = explode(" ", $this->searchInput);

            foreach ($explodedName as $name) {
                $query->orWhere(function ($query) use ($name) {
                    $query->whereHas('asset', function ($subquery) use ($name) {
                        $subquery->where('name', 'like', "%$name%");
                    })->orWhere('bin_no', 'like', "%$name%");
                });
            }

        }

        // Filters
        if (isset($this->locationId) && $this->locationId !== "all") {
            $query->where('store_id', $this->locationId);
        }

        if (isset($this->categoryCodeId) && $this->categoryCodeId !== "all") {
            $query->whereHas('asset', function ($query) {
                $query->where('asset_category_code_id', $this->categoryCodeId);
            });
        }

        if (isset($this->dateFrom) && isset($this->dateTo)) {
            $query->whereHas('binCardEntries', function ($query) {
                $query->whereBetween('created_at', [$this->dateFrom, $this->dateTo]);
            });
        }

        if($this->sortBy == "created_at" && $this->sortOrder == "asc"){

            $this->finalQuery = $query->orderByDesc(BinCardEntry::select('bin_card_entries.created_at')
                ->whereColumn('bin_card_entries.bin_card_id', 'bin_cards.id')
                ->latest()
                ->take(1)
            );

        } elseif($this->sortBy == "created_at" && $this->sortOrder == "desc") {

            $this->finalQuery = $query->orderBy(BinCardEntry::select('bin_card_entries.created_at')
                ->whereColumn('bin_card_entries.bin_card_id', 'bin_cards.id')
                ->latest()
                ->take(1)

            );
        }
    }

    public function searchBinCard()
    {
        $this->applyFilters();
    }

    public function show($id)
    {
        return redirect()->route('ims.showBinCard', [
            'id' => $id
        ]);
    }

    public function clearSearch()
    {
        $this->searchInput = null;
        $this->searchResults = null;
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
        $this->locationId = null;
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

        return view('livewire.pages.bincard.view', [
            'binCards' => $this->finalQuery->paginate(20),
        ]);
    }
}
