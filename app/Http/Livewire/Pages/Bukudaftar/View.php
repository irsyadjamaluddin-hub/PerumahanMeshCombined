<?php

namespace App\Http\Livewire\Pages\Bukudaftar;

use Livewire\Component;
use App\Models\IMS\BukuDaftar;
use Livewire\WithPagination;

class View extends Component
{
    use WithPagination;

    protected $finalQuery;

    public $bukuDaftarSearchInput;
    public $bukuDaftarSearchResult;

    public $sortBy;

    public $sortByMoeRef;
    public $sortOrder;

    public function mount()
    {
        $this->sortOrder = "asc";
        $this->sortBy = "created_at";
    }

    public function show($id)
    {
        return redirect()->route('ims.showBukuDaftar', [
            'id' => $id
        ]);
    }

    public function clearSearch()
    {
        $this->bukuDaftarSearchInput = null;
    }

    public function bukuDaftarSearch()
    {
       $this->applyFilters();
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
            $query = BukuDaftar::with('bukuDaftarEntries', 'purchaseOrder');
        }

        // Search Bar
        if (isset($this->bukuDaftarSearchInput)) {

            $explodedKeyWord = explode(" ", $this->bukuDaftarSearchInput);

            foreach ($explodedKeyWord as $keyWord) {
                $query->orWhere(function ($query) use ($keyWord) {
                    $query->where('moe_reference', 'like', "%$keyWord%");
                })->orWhere('purchase_order_id', 'like', "%$keyWord%");
            }
        }

        $this->finalQuery = $query->orderBy($this->sortBy, $this->sortOrder);

    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function render()
    {
       $this->applyFilters();

        return view('livewire.pages.bukudaftar.view', [
            'bukuDaftars' => $this->finalQuery->paginate(10),
        ]);
    }

}
