<?php

namespace App\Http\Livewire\Pages\Siv;

use App\Models\IMS\Siv;
use App\Models\IMS\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IMS\LejarSimpanan;

class View extends Component
{
    use WithPagination;

    protected $finalQuery;

    public $users;
    public $searchInput;
    public $searchResult;

    public $sortBy;
    public $sortOrder;

    public function mount()
    {
        $this->sortOrder = "desc";
        $this->sortBy = "updated_at";

        $this->users = User::all();
    }

    public function show($id)
    {
        return redirect()->route('ims.showSiv', [
            'id' => $id
        ]);
    }

    public function process($id)
    {
        return redirect()->route('ims.processSiv', [
            'id' => $id
        ]);
    }


    public function clearSearch()
    {
        $this->searchInput = null;
    }

    public function sortByDate()
    {
        $this->sortBy = "updated_at";

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
            $query = Siv::with('receiver')->where('request_accepted', 'yes');
        }

        // Search Bar
        if (isset($this->searchInput)) {

            $explodedKeyWord = explode(" ", $this->searchInput);

            $query->where(function ($query) use ($explodedKeyWord) {
                foreach ($explodedKeyWord as $keyWord) {
                    $query->orWhere('siv_no', 'like', "%$keyWord%");

                    // Add condition to check full_name of the related user when deploy_to is 'internal'
                    $query->orWhereHas('internalUser', function ($query) use ($keyWord) {
                        $query->where('full_name', 'like', "%$keyWord%");
                    });

                    // Add condition to check full_name of the related user when deploy_to is 'external'
                    $query->orWhereHas('externalUser', function ($query) use ($keyWord) {
                        $query->where('name', 'like', "%$keyWord%");
                    });

                    // Add condition to check full_name of the related user when deploy_to is 'external'
                    $query->orWhereHas('receiverLocation', function ($query) use ($keyWord) {
                        $query->where('name', 'like', "%$keyWord%");
                    });
                }
            });
        }

        $this->finalQuery = $query->orderBy($this->sortBy, $this->sortOrder);

    }

    public function search()
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

        return view('livewire.pages.siv.view', [
            'sivs' => $this->finalQuery->paginate(10),
        ]);
    }

}
