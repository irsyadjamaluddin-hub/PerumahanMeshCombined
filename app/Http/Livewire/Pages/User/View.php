<?php

namespace App\Http\Livewire\Pages\User;

use App\Models\IMS\Role;
use App\Models\IMS\User;
use Livewire\Component;
use Livewire\WithPagination;

class View extends Component
{
    use WithPagination;

    protected $finalQuery;

    public $roles;
    public $roleId;

    public $allUsers;

    public $sortBy;
    public $sortOrder;

    public $searchInput;
    public $searchResults;

    public function mount()
    {
        $this->roles = Role::all();
        $this->allUsers = User::all();

        // $this->roleId = 'all';

        $this->sortOrder = "desc";
        $this->sortBy = "created_at";
    }

    public function clearSearch()
    {
        $this->searchInput = null;
        $this->searchResults = null;
    }

    public function filterByRole($id)
    {
        $this->roleId = $id;
        $this->applyFilters();
        $this->resetPage();
    }

    public function sortByName()
    {
        $this->sortBy = "name";

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
            $query = $this->finalQuery = User::with('userRoles', 'roles');
        }

        if(isset($this->roleId)){

            if($this->roleId !== "all"){

                $this->finalQuery = $query->whereHas('userRoles', function($query){
                    $query->where('role_id', $this->roleId);
                });

            }

        } else {

            $this->roleId = "all";

        }

        // Search Bar
        if (isset($this->searchInput)) {

            $explodedKeyWord = explode(" ", $this->searchInput);

            foreach ($explodedKeyWord as $keyWord) {
                $query->orWhere(function ($query) use ($keyWord) {
                    $query->where('full_name', 'like', "%$keyWord%");
                });
            }
        }

        if($this->sortBy == "name" && $this->sortOrder == "asc"){

            $this->finalQuery = $query->orderBy('full_name');

        } elseif($this->sortBy == "name" && $this->sortOrder == "desc") {

            $this->finalQuery = $query->orderByDesc('full_name');
        }

    }

    public function userSearch()
    {
        $this->applyFilters();
    }

    // Q: Why not delete?
    // A: Forms filled by deleted user might be buggy/gone.
    public function disableUser($id)
    {
        $user = User::find($id);
        $user->disabled = 1;
        $user->save();

        // Forward user to same page + toast
        $prevData = [
            'message' => 'Success',
            'description' => 'User successfully disabled!',
        ];

        return redirect()->route('ims.viewUser')->with('success', $prevData);

    }

    public function enableUser($id)
    {
        $user = User::find($id);
        $user->disabled = 0;
        $user->save();

        // Forward user to same page + toast
        $prevData = [
            'message' => 'Success',
            'description' => 'User successfully enabled!',
        ];

        return redirect()->route('ims.viewUser')->with('success', $prevData);
    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function render()
    {
        $this->applyFilters();

        return view('livewire.pages.user.view', [
            'users' => $this->finalQuery->paginate(5),
        ]);
    }
}
