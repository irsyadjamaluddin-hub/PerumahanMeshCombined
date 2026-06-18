<?php

namespace App\Http\Livewire\Pages\Siv;

use App\Models\IMS\Siv;
use App\Models\IMS\User;
use Livewire\Component;
use Livewire\WithPagination;

class ViewRequest extends Component
{
    use WithPagination;

    protected $finalQuery;

    public $searchInput;

    public $sortBy;

    public $sortByMoeRef;
    public $sortOrder;

    public $users;

    public function mount()
    {
        $this->sortOrder = "desc";
        $this->sortBy = "created_at";

        $this->users = User::all();
    }

    // public function successToast()
    // {
    //     $data = [
    //         'position' => 'top-right',
    //         'type' => 'success',
    //         'message' => 'Success Toast',
    //         'description' => 'This is an example toast notification',
    //     ];

    //     $this->dispatchBrowserEvent('toast-show', $data);
    // }

    // public function warningToast()
    // {
    //     $data = [
    //         'position' => 'top-right',
    //         'type' => 'warning',
    //         'message' => 'Warning Toast',
    //         'description' => 'This is an example toast notification',
    //     ];

    //     $this->dispatchBrowserEvent('toast-show', $data);
    // }

    public function show($id)
    {
        return redirect()->route('ims.showRequestSiv', [
            'id' => $id
        ]);
    }

    public function process($id)
    {
        return redirect()->route('ims.processRequestSiv', [
            'id' => $id
        ]);
    }

    public function clearSearch()
    {
        $this->searchInput = null;
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

    public function applyFilters()
    {
        // dd(Siv::with('receiver', 'user')->get());

        if(isset($this->finalQuery)){
            $query = $this->finalQuery;
        } else {
            // $query = Siv::with('receiver', 'user')->where('request_accepted', 'no');
            $query = Siv::with('receiver', 'user');
        }

        // Search Bar
        if (isset($this->searchInput)) {

            $explodedKeyWord = explode(" ", $this->searchInput);

            $query->where(function ($query) use ($explodedKeyWord) {
                foreach ($explodedKeyWord as $keyWord) {
                    $query->orWhereHas('externalUser', function ($query) use ($keyWord) {
                        $query->where('name', 'like', "%$keyWord%");
                    })
                    ->orWhereHas('receiverLocation', function ($query) use ($keyWord) {
                        $query->where('name', 'like', "%$keyWord%");
                    })
                    ->orWhereHas('internalUser', function ($query) use ($keyWord) {
                        $query->where('full_name', 'like', "%$keyWord%");
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

        return view('livewire.pages.siv.view-request', [
            'sivs' => $this->finalQuery->paginate(10),
        ]);
    }
}
