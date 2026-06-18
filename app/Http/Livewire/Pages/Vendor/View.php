<?php

namespace App\Http\Livewire\Pages\Vendor;

use App\Models\IMS\User;
use App\Models\IMS\Vendor;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\ValidationException;

class View extends Component
{
    use WithPagination;

    protected $finalQuery;

    public $allVendors;
    public $deletedVendors;

    public $sortBy;
    public $sortOrder;

    public $searchInput;
    public $searchResults;

    public $name;
    public $phoneNo;
    public $email;
    public $address;

    public $updatedName;
    public $updatedPhoneNo;
    public $updatedEmail;
    public $updatedAddress;

    protected $rules = [

        'name' => 'required|min:6|unique:Vendors,name',
        'phoneNo' => 'required|min:7|max:7',
        'email' => 'required|email|unique:Vendors,email',
        'address' => 'required|min:6',

    ];

    public function mount()
    {
        $this->allVendors = Vendor::where('deleted', 'no')->get();
        $this->deletedVendors = Vendor::where('deleted', 'yes')->get();

        $this->sortOrder = "desc";
        $this->sortBy = "created_at";
    }

    public function clearSearch()
    {
        $this->searchInput = null;
        $this->searchResults = null;
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
            $query = $this->finalQuery = Vendor::with('lejarSimpanan', 'bukuDaftar');
        }

        // Search Bar
        if (isset($this->searchInput)) {

            $explodedKeyWord = explode(" ", $this->searchInput);

            foreach ($explodedKeyWord as $keyWord) {
                $query->orWhere(function ($query) use ($keyWord) {
                    $query->where('name', 'like', "%$keyWord%");
                });
            }
        }

        // Filter for non-deleted
        $query->whereNull('deleted')->orWhere('deleted', 'no');

        if($this->sortBy == "name" && $this->sortOrder == "asc"){

            $this->finalQuery = $query->orderBy('name');

        } elseif($this->sortBy == "name" && $this->sortOrder == "desc") {

            $this->finalQuery = $query->orderByDesc('name');
        }

    }

    public function vendorSearch()
    {
        $this->applyFilters();
        $this->resetPage();
    }

    public function createVendor()
    {
        $this->validate();

        Vendor::create([
            'name' => $this->name,
            'address' => $this->address,
            'tel_no' => $this->phoneNo,
            'email' => $this->email,
        ]);

        // ---------------------------------------------------------------
        // SUCCESS MESSAGE
        // ---------------------------------------------------------------

        $prevData = [
            'message' => 'Success',
            'description' => 'New vendor created successfully!',
        ];

        return redirect()->route('ims.viewVendor')->with('success', $prevData);
    }

    public function updateVendor($vendorId)
    {
        $currentVendor = $this->allVendors->where('id', $vendorId)->first();

        $validationFailed = false;

        // -------------------------------------------------------------------------------
        // Name
        // -------------------------------------------------------------------------------
        if(true){

            // Check if $updateName and name di DB not match
            if(isset($this->updatedName) && !empty($this->updatedName)){

                if($this->updatedName !== $currentVendor->name){

                    $rules = [
                        'updatedName' => 'min:7',
                    ];

                    try {

                        $this->validate($rules);

                        $currentVendor->update(['name' => $this->updatedName]);

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

        // -------------------------------------------------------------------------------
        // Phone No.
        // -------------------------------------------------------------------------------
        if(true){

            // Check if $updatedPhoneNo and Phone No di DB not match
            if(isset($this->updatedPhoneNo) && !empty($this->updatedPhoneNo)){

                if($this->updatedPhoneNo !== $currentVendor->tel_no){

                    $rules = [
                        'updatedPhoneNo' => 'min:7|max:7',
                    ];

                    try {

                        $this->validate($rules);

                        $currentVendor->update(['tel_no' => $this->updatedPhoneNo]);

                    } catch (ValidationException $e) {

                        // If validation fails, trigger toast

                        $data = [
                            'position' => 'top-right',
                            'type' => 'warning',
                            'message' => 'Warning',
                            'description' => $e->validator->errors()->first('updatedPhoneNo'),
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
        // Email Address
        // -------------------------------------------------------------------------------
        if(true){

            if(isset($this->updatedEmail) && !empty($this->updatedEmail)){

                if($this->updatedEmail !== $currentVendor->email){

                    $rules = [
                        'updatedEmail' => 'email|unique:Vendors,email',
                    ];

                    try {

                        $this->validate($rules);

                        $currentVendor->update(['email' => $this->updatedEmail]);

                    } catch (ValidationException $e) {

                        // If validation fails, trigger toast

                        $data = [
                            'position' => 'top-right',
                            'type' => 'warning',
                            'message' => 'Warning',
                            'description' => $e->validator->errors()->first('updatedEmail'),
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
        // Address
        // -------------------------------------------------------------------------------
        if(true){

            if(isset($this->updatedAddress) && !empty($this->updatedAddress)){

                if($this->updatedAddress !== $currentVendor->address){

                    $rules = [
                        'updatedAddress' => 'min:6',
                    ];

                    try {

                        $this->validate($rules);

                        $currentVendor->update(['address' => $this->updatedAddress]);

                    } catch (ValidationException $e) {

                        // If validation fails, trigger toast

                        $data = [
                            'position' => 'top-right',
                            'type' => 'warning',
                            'message' => 'Warning',
                            'description' => $e->validator->errors()->first('updatedAddress'),
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

            return redirect()->route('ims.viewVendor')->with('success', $prevData);

        }

    }

    public function deleteVendor($id)
    {
        $vendor = Vendor::find($id);
        $vendor->deleted = "yes";
        $vendor->deleted_at = date('Y-m-d H:i:s');
        $vendor->save();

        // Forward user to same page + toast
        $prevData = [
            'message' => 'Success',
            'description' => 'Vendor successfully deleted!',
        ];

        return redirect()->route('ims.viewVendor')->with('success', $prevData);
    }

    public function restoreVendor($id)
    {
        $vendor = Vendor::find($id);
        $vendor->deleted = "no";
        $vendor->deleted_at = null;
        $vendor->save();

        // Forward user to same page + toast
        $prevData = [
            'message' => 'Success',
            'description' => 'Vendor successfully restored!',
        ];

        return redirect()->route('ims.viewVendor')->with('success', $prevData);
    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function render()
    {
        $this->applyFilters();

        return view('livewire.pages.vendor.view', [
            'vendors' => $this->finalQuery->paginate(5),
        ]);
    }

}
