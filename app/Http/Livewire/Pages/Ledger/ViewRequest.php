<?php

namespace App\Http\Livewire\Pages\Ledger;

use App\Models\IMS\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IMS\LejarSimpanan;
use App\Models\IMS\LejarSimpananRequest;

class ViewRequest extends Component
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
        return redirect()->route('ims.showLedgerRequest', [
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
            $query = LejarSimpananRequest::with('createdBy', 'storekeeper', 'borangPenyerahan');
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

    public function process($id)
    {
        return redirect()->route('ims.processLedgerRequest', [
            'id' => $id
        ]);
    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function render()
    {
        $this->applyFilters();

        return view('livewire.pages.ledger.view-request', [
            'ledgerRequests' => $this->finalQuery->paginate(10),
        ]);

    }
}
