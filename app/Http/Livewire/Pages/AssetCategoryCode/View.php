<?php

namespace App\Http\Livewire\Pages\AssetCategoryCode;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\IMS\AssetCategoryCode;
use Illuminate\Validation\ValidationException;

class View extends Component
{
    use WithPagination;

    protected $finalQuery;

    public $ACCs;
    // public $deletedACCs;

    public $code;
    public $name;

    public $sortBy;
    public $sortOrder;

    public $searchInput;
    public $searchResults;

    public $updatedCode;
    public $updatedName;

    protected $rules = [
        'code' => 'required|min:1|max:10|unique:asset_category_codes,code',
        'name' => 'required|min:1|unique:asset_category_codes,name',
    ];

    public function mount()
    {
        // $this->deletedACCs = AssetCategoryCode::where('deleted', 'yes')->get();

        $this->sortOrder = "desc";
        $this->sortBy = "created_at";

        $this->ACCs = AssetCategoryCode::all();
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

    public function sortByCode()
    {
        $this->sortBy = "code";

        if($this->sortOrder == "asc"){
            $this->sortOrder = "desc";
        } else {
            $this->sortOrder = "asc";
        }

        $this->applyFilters();
    }

    public function clearSearch()
    {
        $this->searchInput = null;
        $this->searchResults = null;
    }

    public function restoreACC($id)
    {
        $ACC = AssetCategoryCode::find($id);
        $ACC->deleted = "no";
        $ACC->deleted_at = null;
        $ACC->save();

        // Forward user to same page + toast
        $prevData = [
            'message' => 'Success',
            'description' => 'ACC successfully restored!',
        ];

        return redirect()->route('ims.viewAssetCategoryCode')->with('success', $prevData);
    }

    public function accSearch()
    {
        $this->applyFilters();
        $this->resetPage();
    }

    public function applyFilters()
    {
        // Check FinalQuery
        if(isset($this->finalQuery)){
            $query = $this->finalQuery;
        } else {
            $query = $this->finalQuery = AssetCategoryCode::with('mainAssetCategoryCode');
        }

        // Search Bar
        if (isset($this->searchInput)) {

            $explodedKeyWord = explode(" ", $this->searchInput);

            foreach ($explodedKeyWord as $keyWord) {

                $query->orWhere(function ($query) use ($keyWord) {
                    $query
                        ->where('name', 'like', "%$keyWord%")
                        ->orWhere('code', 'like', "%$keyWord%");
                });

            }

        }

        // Filter for non-deleted
        $query->where('deleted', 'no');

        if($this->sortBy == "name" && $this->sortOrder == "asc"){

            $this->finalQuery = $query->orderBy('name');

        } elseif($this->sortBy == "name" && $this->sortOrder == "desc") {

            $this->finalQuery = $query->orderByDesc('name');

        } elseif($this->sortBy == "code" && $this->sortOrder == "asc") {

            $this->finalQuery = $query->orderBy('code');

        } elseif($this->sortBy == "code" && $this->sortOrder == "desc") {

            $this->finalQuery = $query->orderByDesc('code');

        }

    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function deleteACC($id)
    {
        $ACC = AssetCategoryCode::find($id);
        $ACC->deleted = "yes";
        $ACC->deleted_at = date('Y-m-d H:i:s');
        $ACC->save();

        // Forward user to same page + toast
        $prevData = [
            'message' => 'Success',
            'description' => 'ACC successfully deleted!',
        ];

        return redirect()->route('ims.viewAssetCategoryCode')->with('success', $prevData);
    }

    public function createACC()
    {
        $this->validate();

        // Check if fields are not null
        if(
            isset($this->code) && (!empty($this->code)) &&
            isset($this->name) && (!empty($this->name))
        ){

            AssetCategoryCode::create([
                'code' => $this->code,
                'name' => $this->name,
            ]);

        }

        // ---------------------------------------------------------------
        // SUCCESS MESSAGE
        // ---------------------------------------------------------------

        $prevData = [
            'message' => 'Success',
            'description' => 'New ACC created successfully!',
        ];

        return redirect()->route('ims.viewAssetCategoryCode')->with('success', $prevData);
    }

    public function updateReceiver($id)
    {
        // -------------------------------------------------------------------------------
        // If fields are empty, do nothing
        // -------------------------------------------------------------------------------
        if(
            (isset($this->updatedCode) && (!empty($this->updatedCode))) ||
            (isset($this->updatedName) && (!empty($this->updatedName)))
        ){

            $currentACC = $this->ACCs->where('id', $id)->first();

            $validationFailed = false;

            // -------------------------------------------------------------------------------
            // Code
            // -------------------------------------------------------------------------------
            if(true){

                if(isset($this->updatedCode) && !empty($this->updatedCode)){

                    // Check if $updateName and name di DB not match
                    if($this->updatedCode !== $currentACC->code){

                        $rules = [
                            'updatedCode' => 'required|min:1|max:10|unique:asset_category_codes,code',
                        ];

                        try {

                            $this->validate($rules);

                            $currentACC->update(['code' => $this->updatedCode]);

                        } catch (ValidationException $e) {

                            // If validation fails, trigger toast

                            $data = [
                                'position' => 'top-right',
                                'type' => 'warning',
                                'message' => 'Warning',
                                'description' => $e->validator->errors()->first('updatedCode'),
                            ];

                            $this->dispatchBrowserEvent('toast-show', $data);

                            $validationFailed = true;
                        }

                        // Prevent code from being run-through if validate fails
                        // $this->validate($rules);

                    }

                }

            }

            // -------------------------------------------------------------------------------
            // Name
            // -------------------------------------------------------------------------------
            if(true){

                if(isset($this->updatedName) && !empty($this->updatedName)){

                    // Check if $updateName and name di DB not match
                    if($this->updatedName !== $currentACC->name){

                        $rules = [
                            'updatedName' => 'required|min:1|unique:asset_category_codes,name',
                        ];

                        try {

                            $this->validate($rules);

                            $currentACC->update(['name' => $this->updatedName]);

                        } catch (ValidationException $e) {

                            // If validation fails, trigger toast

                            $data = [
                                'position' => 'top-right',
                                'type' => 'warning',
                                'message' => 'Warning',
                                'description' => $e->validator->errors()->first('updatedName'),
                            ];

                            $this->dispatchBrowserEvent('toast-show', $data);

                            $validationFailed = true;
                        }

                        // Prevent code from being run-through if validate fails
                        // $this->validate($rules);

                    }

                }

            }

            if (!$validationFailed) {

                // ---------------------------------------------------------------
                // SUCCESS MESSAGE
                // ---------------------------------------------------------------

                $prevData = [
                    'message' => 'Success',
                    'description' => 'Vendor details updated successfully!',
                ];

                return redirect()->route('ims.viewAssetCategoryCode')->with('success', $prevData);

            }

        } else {

            return redirect()->route('ims.viewAssetCategoryCode');

        }

    }

    public function render()
    {
        $this->applyFilters();

        return view('livewire.pages.asset-category-code.view', [
            'accs' => $this->finalQuery->paginate(10),
            'deletedACCs' => AssetCategoryCode::where('deleted', 'yes')->paginate(10),
            'currentPage' => $this->finalQuery->paginate(10)->currentPage(),
        ]);
    }
}
