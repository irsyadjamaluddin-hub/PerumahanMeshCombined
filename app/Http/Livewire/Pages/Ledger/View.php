<?php

namespace App\Http\Livewire\Pages\Ledger;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IMS\LejarSimpanan;

class View extends Component
{
    use WithPagination;

    protected $finalQuery;

    public $ledgerSearchInput;
    public $ledgerSearchResult;

    public $sortBy;

    public $sortByMoeRef;
    public $sortOrder;

    public function mount()
    {
        $this->sortOrder = "desc";
        $this->sortBy = "created_at";
    }

    public function show($id)
    {
        return redirect()->route('ims.showLedger', [
            'id' => $id
        ]);
    }

    public function clearSearch()
    {
        $this->ledgerSearchInput = null;
    }

    public function sortByDate()
    {
        $this->sortBy = "created_at";

        if($this->sortOrder == "asc"){
            $this->sortOrder = "desc";
        } else {
            $this->sortOrder = "asc";
        }

        $this->applyFilters();
    }

    public function sortByMoeRef()
    {
        $this->sortBy = "moe_reference";

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
            $query = LejarSimpanan::with('lejarSimpananEntries', 'purchaseOrder');
        }

        // Search Bar
        if (isset($this->ledgerSearchInput)) {

            $explodedKeyWord = explode(" ", $this->ledgerSearchInput);

            foreach ($explodedKeyWord as $keyWord) {
                $query->orWhere(function ($query) use ($keyWord) {
                    $query->where('moe_reference', 'like', "%$keyWord%");
                })->orWhere('purchase_order_id', 'like', "%$keyWord%");
            }
        }

        $this->finalQuery = $query->orderBy($this->sortBy, $this->sortOrder);

    }

    public function ledgerSearch()
    {
        $this->applyFilters();
    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function render()
    {
        $this->applyFilters();

        return view('livewire.pages.ledger.view', [
            'lejarSimpanans' => $this->finalQuery->paginate(10),
        ]);
    }
}
