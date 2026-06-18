<?php

namespace App\Http\Livewire\Pages\User;

use Carbon\Carbon;
use App\Models\IMS\Role;
use App\Models\IMS\User;
use Livewire\Component;

use App\Models\IMS\UserRole;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Validation\ValidationException;

class Update extends Component
{
    public $userId;

    public $roles;
    public $userRoles;

    public $full_name;
    public $username;
    public $email;

    public $signature;
    public $newPassword;

    public $currentUser;
    public $currentRoles;

    public $originalRoles = [];
    public $selectedRoles = [];
    public $unselectedRoles = [];

    public function mount($id)
    {
        $this->userId = $id;
        $this->roles = Role::all();
        $this->unselectedRoles = Role::all()->pluck('id')->toArray();

        $this->currentUser = User::where('id', $id)->first();

        $this->userRoles = UserRole::all();

        // Default Values
        $this->full_name = $this->currentUser->full_name;
        $this->username = $this->currentUser->username;
        $this->email = $this->currentUser->email;
        $this->signature = $this->currentUser->signature;

        $this->currentRoles = UserRole::where('user_id', $id)->get();

        foreach($this->currentRoles as $currentRole){

            array_push($this->selectedRoles, $currentRole->role_id);

            $keyToRemove = array_search($currentRole->role_id, $this->unselectedRoles);

            if ($keyToRemove !== false) {
                unset($this->unselectedRoles[$keyToRemove]);
            }

        }

        $this->originalRoles = $this->selectedRoles;

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

    public function clearPassword(){

        $this->newPassword = null;

    }

    public function updateUser($newSignature, $dataUrl)
    {
        // -------------------------------------------------------------------------------
        // Full Name (DONE)
        // -------------------------------------------------------------------------------
        if(true){

            // Check if $full_name and fullName di DB not match
            if($this->full_name !== $this->currentUser->full_name){

                $rules = [
                    'full_name' => 'min:7',
                ];

                try {

                    $this->validate($rules);

                    User::where('id', $this->userId)->update(['full_name' => $this->full_name]);

                } catch (ValidationException $e) {

                    // If validation fails, trigger toast

                    $data = [
                        'position' => 'top-right',
                        'type' => 'warning',
                        'message' => 'Warning',
                        'description' => $e->validator->errors()->first('full_name'),
                    ];

                    $this->dispatchBrowserEvent('toast-show', $data);

                }

                // Prevent code from being run-through if validate fails
                $this->validate($rules);

            }

        }

        // -------------------------------------------------------------------------------
        // Username (DONE)
        // -------------------------------------------------------------------------------
        if(true){

            // Check if $full_name and fullName di DB not match
            if($this->username !== $this->currentUser->username){

                $rules = [
                    'username' => 'min:2|max:10|unique:Users,username',
                ];

                try {

                    $this->validate($rules);

                    User::where('id', $this->userId)->update(['username' => $this->username]);

                } catch (ValidationException $e) {

                    // If validation fails, trigger toast

                    $data = [
                        'position' => 'top-right',
                        'type' => 'warning',
                        'message' => 'Warning',
                        'description' => $e->validator->errors()->first('username'),
                    ];

                    $this->dispatchBrowserEvent('toast-show', $data);

                }

                // Prevent code from being run-through if validate fails
                $this->validate($rules);

            }

        }

        // -------------------------------------------------------------------------------
        // Email (DONE)
        // -------------------------------------------------------------------------------
        if(true){

            // Check if $email and email di DB match
            if($this->email !== $this->currentUser->email){

                $rules = [
                    'email' => [
                        'email',

                        // Unique email address, excluding current user's email
                        Rule::unique('users')->ignore($this->userId),
                    ],
                ];

                try {

                    $this->validate($rules);

                    User::where('id', $this->userId)->update(['email' => $this->email]);

                } catch (ValidationException $e) {

                    // If validation fails, trigger toast

                    $data = [
                        'position' => 'top-right',
                        'type' => 'warning',
                        'message' => 'Warning',
                        'description' => $e->validator->errors()->first('email'),
                    ];

                    $this->dispatchBrowserEvent('toast-show', $data);

                }

                // Prevent code from being run-through if validate fails
                $this->validate($rules);

            }

        }

        // -------------------------------------------------------------------------------
        // Password (DONE)
        // -------------------------------------------------------------------------------
        if(true){

            // Check if new password field is filled.
            if(isset($this->newPassword) && $this->newPassword !== ''){

                $rules = [
                    'newPassword' => 'min:6',
                ];

                try {

                    $this->validate($rules);

                    if (!Hash::check($this->newPassword, $this->currentUser->password)) {

                        User::where('id', $this->userId)->update(['password' => bcrypt($this->newPassword)]);

                    }

                } catch (ValidationException $e) {

                    // If validation fails, trigger toast

                    $data = [
                        'position' => 'top-right',
                        'type' => 'warning',
                        'message' => 'Warning',
                        'description' => $e->validator->errors()->first('newPassword'),
                    ];

                    $this->dispatchBrowserEvent('toast-show', $data);

                }

                // Prevent code from being run-through if validate fails
                $this->validate($rules);

            }

        }

        // -------------------------------------------------------------------------------
        // Signature (DONE)
        // -------------------------------------------------------------------------------
        if(true){

            if($newSignature == true){

                // -----------------------------------------------------------------------
                // Save New Signature Image to Public/Signatures
                // -----------------------------------------------------------------------

                $base64Data = preg_replace('#^data:image/\w+;base64,#i', '', $dataUrl);
                $imageData = base64_decode($base64Data);
                $directoryPath = public_path('signatures/');

                // Create the directory if it doesn't exist
                if (!is_dir($directoryPath)) {
                    mkdir($directoryPath, 0755, true);
                }

                $dateTimeNow = Carbon::now()->format('YmdHis');
                $fileName = "staff_" . $this->userId . "_" . $dateTimeNow . ".png";
                $filePath = $directoryPath . $fileName;

                // Save the image to the specified location
                file_put_contents($filePath, $imageData);

                // -----------------------------------------------------------------------
                // Update New Signature Name to DB
                // -----------------------------------------------------------------------

                User::where('id', $this->userId)->update(['signature' => $fileName]);

                $currentUser = User::where('id', $this->userId)->first();

                // -----------------------------------------------------------------------
                // Delete Old Signature from Public/Signatures
                // -----------------------------------------------------------------------

                $oldSignaturePath = public_path('signatures' . DIRECTORY_SEPARATOR . $this->signature);

                // dd($oldSignaturePath);

                // Check if the file exists before attempting to delete from public/signatures
                if (isset($currentUser->signature) && $currentUser->signature !== null) {

                    if (file_exists($oldSignaturePath) && is_file($oldSignaturePath)) {
                        unlink($oldSignaturePath);
                    }

                }

            }

        }

        // -------------------------------------------------------------------------------
        // User Roles (DONE)
        // -------------------------------------------------------------------------------
        if(true){

            // Make sure there are at least one $selectedRoles
            if(count($this->selectedRoles) > 0) {

                // Remove all userRoles
                UserRole::where('user_id', $this->userId)->delete();

                // Insert new userRoles from $selectedRoles
                foreach($this->selectedRoles as $selectedRole){

                    UserRole::create([
                        'user_id' => $this->userId,
                        'role_id' => $selectedRole,
                    ]);

                }

            } else {

                $data = [
                    'position' => 'top-right',
                    'type' => 'warning',
                    'message' => 'Warning',
                    'description' => 'Please assign at least one role in User Roles',
                ];

                $this->dispatchBrowserEvent('toast-show', $data);

                return;

            }

        }

        // -------------------------------------------------------------------------------
        // DONE
        // -------------------------------------------------------------------------------
        if(true){

            // ---------------------------------------------------------------
            // SUCCESS MESSAGE
            // ---------------------------------------------------------------

            $prevData = [
                'message' => 'Success',
                'description' => 'User detail(s) updated successfully!',
            ];

            return redirect()->route('ims.viewUser')->with('success', $prevData);
        }

    }


    public function render()
    {
        return view('livewire.pages.user.update');
    }
}
