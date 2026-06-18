<?php

namespace App\Http\Livewire\Pages\Receiver;

use Livewire\Component;
use App\Models\IMS\Receiver;
use Livewire\WithPagination;
use App\Models\IMS\ReceiverLocation;
use Illuminate\Validation\ValidationException;

class View extends Component
{
    use WithPagination;

    protected $finalQuery;

    public $allReceivers;
    public $deletedReceivers;

    public $sortBy;
    public $sortOrder;

    public $searchInput;
    public $searchResults;

    public $name;
    public $phoneNo;
    public $email;
    public $receiverLocationId;
    public $receiverLocations;
    public $receiverLocationInput;
    public $receiverLocationSearchResults;

    public $updatedName;
    public $updatedPhoneNo;
    public $updatedEmail;
    public $updatedAddress;

    public $currentLocationId;
    public $updateLocationId;
    public $updatedReceiverLocation;
    public $updateSearchResults;

    protected $rules = [
        'name' => 'required|min:6|unique:Receivers,name',
        'phoneNo' => 'required|min:7|max:7',
        'email' => 'required|email|unique:Receivers,email',
    ];

    public function mount()
    {
        $this->allReceivers = Receiver::where('deleted', 'no')->get();
        $this->deletedReceivers = Receiver::where('deleted', 'yes')->get();

        $this->sortOrder = "desc";
        $this->sortBy = "created_at";

        $this->receiverLocations = ReceiverLocation::all();
    }

    public function clearSearch()
    {
        $this->searchInput = null;
        $this->searchResults = null;
    }

    public function receiverSearch()
    {
        $this->applyFilters();
        $this->resetPage();
    }

    public function createReceiver()
    {
        $this->validate();

        // --------------------------------------------------------------------------
        // Check if user selects existing 'Receiver Location'.
        // --------------------------------------------------------------------------
        // If yes, grad id from $this->receiverLocationId
        // If no, create new receiverLocation and grab the id.
        // --------------------------------------------------------------------------

        if(($this->receiverLocationId !== null) && isset($this->receiverLocationId)){

            Receiver::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone_no' => $this->phoneNo,
                'receiver_location_id' => $this->receiverLocationId,
            ]);

        } else {

            $createReceiverLocation = ReceiverLocation::create([
                'name' => $this->receiverLocationInput,
            ]);

            Receiver::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone_no' => $this->phoneNo,
                'receiver_location_id' => $createReceiverLocation->id,
            ]);

        }

        // ---------------------------------------------------------------
        // SUCCESS MESSAGE
        // ---------------------------------------------------------------

        $prevData = [
            'message' => 'Success',
            'description' => 'New receiver created successfully!',
        ];

        return redirect()->route('ims.viewReceiver')->with('success', $prevData);
    }

    public function searchLocation()
    {
        $explodedName = explode(" ", $this->receiverLocationInput);
        $receiverLocations = ReceiverLocation::query();

        foreach ($explodedName as $input) {
            $receiverLocations->orWhere(function ($query) use ($input) {
                $query->where('name', 'like', "%$input%");
            });
        }

        $this->receiverLocationSearchResults = $receiverLocations->take(10)->get();
    }

    public function clearSearchLocation()
    {
        $this->receiverLocationId = null;
        $this->receiverLocationInput = null;
        $this->receiverLocationSearchResults = null;
    }

    public function selectLocation($id, $name)
    {
        $this->receiverLocationId = $id;

        // --------------------------------------------------------------------------
        // If user selected existing location, set input as location name
        // Else, retain user input.
        // --------------------------------------------------------------------------

        if(($this->receiverLocationId !== null) && isset($this->receiverLocationId)){

            $this->receiverLocationInput = $name;

        }

    }

    public function applyFilters()
    {
        // Check FinalQuery
        if(isset($this->finalQuery)){
            $query = $this->finalQuery;
        } else {
            $query = $this->finalQuery = Receiver::with('receiverLocation', 'siv');
        }

        // Search Bar
        if (isset($this->searchInput)) {

            $explodedKeyWord = explode(" ", $this->searchInput);

            foreach ($explodedKeyWord as $keyWord) {
                // $query->orWhere(function ($query) use ($keyWord) {
                //     $query->where('name', 'like', "%$keyWord%");
                // });

                $query->orWhere(function ($query) use ($keyWord) {
                    $query->where('name', 'like', "%$keyWord%")
                        ->orWhereHas('receiverLocation', function ($query) use ($keyWord) {
                            $query->where('name', 'like', "%$keyWord%");
                        });
                });
            }

        }

        // Filter for non-deleted
        $query->where('deleted', 'no');

        if($this->sortBy == "name" && $this->sortOrder == "asc"){

            $this->finalQuery = $query->orderBy('name');

        } elseif($this->sortBy == "name" && $this->sortOrder == "desc") {

            $this->finalQuery = $query->orderByDesc('name');
        }

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

    public function updateReceiver($id)
    {
        // -------------------------------------------------------------------------------
        // If fields are empty, do nothing
        // -------------------------------------------------------------------------------
        if(
            isset($this->updatedName) && (!empty($this->updatedName)) ||
            isset($this->updatedPhoneNo) && (!empty($this->updatedPhoneNo)) ||
            isset($this->updatedEmail) && (!empty($this->updatedEmail)) ||
            isset($this->updatedReceiverLocation) && (!empty($this->updatedReceiverLocation)) ||
            isset($this->updateLocationId) && (!empty($this->updateLocationId))
        ){

            $currentReceiver = $this->allReceivers->where('id', $id)->first();

            $validationFailed = false;

            // -------------------------------------------------------------------------------
            // Name
            // -------------------------------------------------------------------------------
            if(true){

                // Check if $updateName and name di DB not match
                if(isset($this->updatedName) && !empty($this->updatedName)){

                    if($this->updatedName !== $currentReceiver->name){

                        $rules = [
                            'updatedName' => 'min:7',
                        ];

                        try {

                            $this->validate($rules);

                            $currentReceiver->update(['name' => $this->updatedName]);

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

                    if($this->updatedPhoneNo !== $currentReceiver->phone_no){

                        $rules = [
                            'updatedPhoneNo' => 'min:7|max:7',
                        ];

                        try {

                            $this->validate($rules);

                            $currentReceiver->update(['phone_no' => $this->updatedPhoneNo]);

                        } catch (ValidationException $e) {

                            // dd($e);

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

                    if($this->updatedEmail !== $currentReceiver->email){

                        $rules = [
                            'updatedEmail' => 'email|unique:Vendors,email',
                        ];

                        try {

                            $this->validate($rules);

                            $currentReceiver->update(['email' => $this->updatedEmail]);

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
            // Address/Location
            // -------------------------------------------------------------------------------
            if(true){

                // If user select existing 'Receiver Location'
                if(isset($this->updateLocationId) && !empty($this->updateLocationId)){

                    if($this->updateLocationId !== $currentReceiver->receiver_location_id){

                        try {

                            // Update new ID into Receiver (receiver_location_id)
                            $currentReceiver->update(['receiver_location_id' => $this->updateLocationId]);

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

                // If user input new 'Receiver Location'
                elseif(!isset($this->updateLocationId) && isset($this->updatedReceiverLocation)) {

                    $rules = [
                        'updatedReceiverLocation' => 'min:6',
                    ];

                    try {

                        $this->validate($rules);

                        // Create new Receiver Location
                        $createNewLocation = new ReceiverLocation();
                        $createNewLocation->name = $this->updatedReceiverLocation;
                        $createNewLocation->save();

                        // Update new ID into Receiver (receiver_location_id)
                        $currentReceiver->update(['receiver_location_id' => $createNewLocation->id]);

                    } catch (ValidationException $e) {

                        // If validation fails, trigger toast

                        $data = [
                            'position' => 'top-right',
                            'type' => 'warning',
                            'message' => 'Warning',
                            'description' => $e->validator->errors()->first('updatedReceiverLocation'),
                        ];

                        $this->dispatchBrowserEvent('toast-show', $data);
                        $validationFailed = true;
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

                return redirect()->route('ims.viewReceiver')->with('success', $prevData);

            }

        } else {

            return redirect()->route('ims.viewReceiver');

        }

    }

    public function updateSearchLocation()
    {
        $explodedName = explode(" ", $this->updatedReceiverLocation);
        $receiverLocations = ReceiverLocation::query();

        foreach ($explodedName as $input) {
            $receiverLocations->orWhere(function ($query) use ($input) {
                $query->where('name', 'like', "%$input%");
            });
        }

        $this->updateSearchResults = $receiverLocations->take(10)->get();
    }

    public function updateSelectLocation($id, $name)
    {
        $this->updateLocationId = $id;

        // --------------------------------------------------------------------------
        // If user selected existing location, set input as location name
        // Else, retain user input.
        // --------------------------------------------------------------------------

        if(($this->updateLocationId !== null) && isset($this->updateLocationId)){

            $this->updatedReceiverLocation = $name;

        }

    }

    public function updateClearSearchLocation()
    {
        $this->updateLocationId = null;
        $this->updatedReceiverLocation = null;
        $this->updateSearchResults = null;
    }

    public function deleteReceiver($id)
    {
        $receiver = Receiver::find($id);
        $receiver->deleted = "yes";
        $receiver->deleted_at = date('Y-m-d H:i:s');
        $receiver->save();

        // Forward user to same page + toast
        $prevData = [
            'message' => 'Success',
            'description' => 'Receiver successfully deleted!',
        ];

        return redirect()->route('ims.viewReceiver')->with('success', $prevData);
    }

    public function restoreReceiver($id)
    {
        $receiver = Receiver::find($id);
        $receiver->deleted = "no";
        $receiver->deleted_at = null;
        $receiver->save();

        // Forward user to same page + toast
        $prevData = [
            'message' => 'Success',
            'description' => 'Receiver successfully restored!',
        ];

        return redirect()->route('ims.viewReceiver')->with('success', $prevData);
    }

    public function paginationView()
    {
        return 'livewire.components.custom-pagination';
    }

    public function render()
    {
        $this->applyFilters();

        return view('livewire.pages.receiver.view', [
            'receivers' => $this->finalQuery->paginate(5),
        ]);
    }

}
