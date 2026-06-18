<?php

namespace App\Http\Livewire\Pages\Bincard;

use App\Models\IMS\Store;
use App\Models\IMS\BinCard;
use Livewire\Component;
use App\Models\IMS\AssetEntry;
use App\Models\IMS\BinCardEntry;
use Livewire\WithPagination;
use App\Models\IMS\AssetCategoryCode;
use App\Models\IMS\MainAssetCategoryCode;
use Illuminate\Support\Facades\Cache;

class Qrcodelist extends Component
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

    public $selectedAll;
    public $selectedOnes;

    public $binCardIds;
    public $allBinCards;

    public function mount()
    {
        $this->sortBy = "created_at";
        $this->sortOrder = "asc";

        $this->finalQuery = BinCard::with('asset.assetCategoryCode', 'asset.assetEntries', 'binCardEntries');

        // $this->assetEntries = AssetEntry::all();

        // Load asset entries and stores, consider caching if they are static
        $this->assetEntries = Cache::remember('asset_entries', now()->addMinutes(10), function() {
            return AssetEntry::all();
        });

        $this->stores = Store::all();
        $this->mainAssetCategoryCodes = MainAssetCategoryCode::all();
        // $this->assetCategoryCodes = AssetCategoryCode::all();

        $this->assetCategoryCodes = Cache::remember('asset_category_codes', now()->addMinutes(10), function() {
            return AssetCategoryCode::all();
        });

        $this->selectedAll = false;

        $this->applyFilters();

        $this->allBinCards = BinCard::all();

        foreach($this->allBinCards as $binCard){
            $this->selectedOnes[$binCard->id] = false;
        }

    }

    public function selectOne($id)
    {
        if($this->selectedAll == false){

            if($this->selectedOnes[$id] == false){
                $this->selectedOnes[$id] = true;
            } else {
                $this->selectedOnes[$id] = false;
            }

        } elseif($this->selectedAll == true) {

            $this->selectedAll = false;

            if($this->selectedOnes[$id] == false){
                $this->selectedOnes[$id] = true;
            } else {
                $this->selectedOnes[$id] = false;
            }

        } if(count(array_filter($this->selectedOnes)) == count($this->selectedOnes)){

            $this->selectedAll = true;

        }

    }

    public function selectAll()
    {
        // Apply filter to get latest 'result' ($this->finalQuery)
        $this->applyFilters();

        // Select all bincards displayed in result
        if($this->selectedAll == false){

            $this->selectedAll = true;

            // Create an array $this->selectedOnes, will all true value.
            foreach($this->finalQuery->get() as $binCard){
                $this->selectedOnes[$binCard->id] = true;
            }

        } else {

            $this->selectedAll = false;

            // Create an array $this->selectedOnes, will all false value.
            foreach($this->finalQuery->get() as $binCard){
                $this->selectedOnes[$binCard->id] = false;
            }

        }

    }

    public function filterByLocation($locationId)
    {
        $this->locationId = $locationId;
        $this->applyFilters();
        $this->resetPage();

        $this->selectedAll = false;
        $this->selectedOnes = [];

        foreach($this->allBinCards as $binCard){
            $this->selectedOnes[$binCard->id] = false;
        }
    }

    public function filterByCategoryCodes($categoryCodeId)
    {
        $this->categoryCodeId = $categoryCodeId;
        $this->applyFilters();
        $this->resetPage();

        $this->selectedAll = false;
        $this->selectedOnes = [];

        foreach($this->allBinCards as $binCard){
            $this->selectedOnes[$binCard->id] = false;
        }
    }

    public function filterByDate()
    {
        $this->applyFilters();
        $this->resetPage();

        $this->selectedAll = false;
        $this->selectedOnes = [];

        foreach($this->allBinCards as $binCard){
            $this->selectedOnes[$binCard->id] = false;
        }
    }

    public function sortByCreatedAt()
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

    public function confirmAndProceed()
    {
        $selectedCount = 0;

        foreach ($this->selectedOnes as $value) {
            if ($value === true || $value === 'True') {
                $selectedCount++;
            }
        }

        // $this->selectedOnes where value = 'true'
        $trueSelectedOnes = array_filter($this->selectedOnes, function ($value) {
            return $value === true;
        });

        // Check if there are bin-card(s) selected
        if(count($trueSelectedOnes) > 0){

            return redirect()->to(route('ims.showQrCodeList'))->with('trueSelectedOnes', $trueSelectedOnes);

        } else {

            // Show error toast message
            $data = [
                'position' => 'top-right',
                'type' => 'warning',
                'message' => 'No Bin-Card Selected',
                'description' => 'Please select bin-card(s) first!',
            ];

            $this->dispatchBrowserEvent('toast-show', $data);

        }
    }

    public function removeSelected($id)
    {
        // Change Key's Value to 'False'
        $this->selectedOnes[$id] = false;
    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function render()
    {
        $this->applyFilters();

        return view('livewire.pages.bincard.qrcodelist', [
            'binCards' => $this->finalQuery->paginate(20),
        ]);
    }

}
