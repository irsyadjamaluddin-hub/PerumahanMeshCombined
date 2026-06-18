<?php

namespace App\Http\Livewire\Pages\User;

use Carbon\Carbon;
use App\Models\IMS\Role;
use App\Models\IMS\User;
use Livewire\Component;
use App\Models\IMS\UserRole;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    public $roles;

    public $full_name;
    public $username;
    public $email;
    public $password;

    public $selectedRoles = [];
    public $unselectedRoles = [];

    protected $rules = [

        'full_name' => 'required|min:6',
        'username' => 'required|min:2|max:10|unique:Users,username',
        'email' => 'required|email|unique:Users,email',
        'password' => 'required|min:6',

    ];

    public function mount()
    {
        $this->roles = Role::all();
        $this->unselectedRoles = Role::all()->pluck('id')->toArray();
    }

    public function noSignature()
    {
        $data = [
            'position' => 'top-right',
            'type' => 'warning',
            'message' => 'Warning',
            'description' => 'No signature detected. Please sign.',
        ];

        $this->dispatchBrowserEvent('toast-show', $data);
    }

    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);
    }

    public function selectRole($id)
    {
        array_push($this->selectedRoles, $id);

        $keyToRemove = array_search($id, $this->unselectedRoles);

        if ($keyToRemove !== false) {
            unset($this->unselectedRoles[$keyToRemove]);
        }
    }

    public function removeRole($id)
    {
        $keyToRemove = array_search($id, $this->selectedRoles);

        if ($keyToRemove !== false) {
            unset($this->selectedRoles[$keyToRemove]);
        }

        array_push($this->unselectedRoles, $id);
    }

    public function createUser($dataUrl)
    {

        $this->validate();

        // ------------------------------------------------------------------------
        // Check If At Least 1 User-Role is Selected
        // ------------------------------------------------------------------------

        if(count($this->selectedRoles) > 0){

            // ------------------------------------------------------------------------
            // Create User
            // ------------------------------------------------------------------------
            if(true){

                $createUser = User::create([
                    'full_name' => $this->full_name,
                    'username' => $this->username,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                ]);

            }

            // ------------------------------------------------------------------------
            // Save Signature (IMG) to Storage and Data to Database
            // ------------------------------------------------------------------------

            if(true){

                // Extract the Base64 data by removing the prefix
                $base64Data = preg_replace('#^data:image/\w+;base64,#i', '', $dataUrl);

                // Decode the Base64 data
                $imageData = base64_decode($base64Data);

                // Define the directory path where you want to save the image
                $directoryPath = public_path('signatures/');

                // Create the directory if it doesn't exist
                if (!is_dir($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                }

                $dateTimeNow = Carbon::now()->format('YmdHis');

                $fileName = "staff_" . $createUser->id . "_" . $dateTimeNow . ".png";

                // Define the file path for the image
                $filePath = $directoryPath . $fileName;

                // Save the image to the specified location
                file_put_contents($filePath, $imageData);

            }

            // ------------------------------------------------------------------------
            // Update User (Signature)
            // ------------------------------------------------------------------------

            if(true){

                $updateUser = User::find($createUser->id);

                if ($updateUser) {
                    $updateUser->signature = $fileName;
                    $updateUser->save();
                }

            }

            // ------------------------------------------------------------------------
            // Save User Roles
            // ------------------------------------------------------------------------

            if(true){

                foreach($this->selectedRoles as $selectedRole){

                    $createUserRole = UserRole::create([
                        'user_id' => $createUser->id,
                        'role_id' => $selectedRole,
                    ]);

                }

            }

            // ---------------------------------------------------------------
            // SUCCESS MESSAGE
            // ---------------------------------------------------------------

            $prevData = [
                'message' => 'Success',
                'description' => 'New user created successfully!',
            ];

            return redirect()->route('ims.viewUser')->with('success', $prevData);

        } else {

            $data = [
                'position' => 'top-right',
                'type' => 'warning',
                'message' => 'Warning',
                'description' => 'Please assign at least one role.',
            ];

            $this->dispatchBrowserEvent('toast-show', $data);

        }

    }

    public function render()
    {
        return view('livewire.pages.user.create');
    }
}
