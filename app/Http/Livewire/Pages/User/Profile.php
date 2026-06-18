<?php

namespace App\Http\Livewire\Pages\User;

use Carbon\Carbon;
use App\Models\IMS\Role;
use App\Models\IMS\User;
use Livewire\Component;

use App\Models\IMS\UserRole;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class Profile extends Component
{
    use WithFileUploads;

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

    public $profilePic;

    public function mount()
    {
        $this->userId = auth()->guard('ims')->user()->id;

        $this->roles = Role::all();
        $this->unselectedRoles = Role::all()->pluck('id')->toArray();

        $this->currentUser = User::where('id', $this->userId)->first();

        $this->userRoles = UserRole::all();

        // Default Values
        $this->full_name = $this->currentUser->full_name;
        $this->username = $this->currentUser->username;
        $this->email = $this->currentUser->email;
        $this->signature = $this->currentUser->signature;

        $this->currentRoles = UserRole::where('user_id', $this->userId)->get();

        foreach($this->currentRoles as $currentRole){

            array_push($this->selectedRoles, $currentRole->role_id);

            $keyToRemove = array_search($currentRole->role_id, $this->unselectedRoles);

            if ($keyToRemove !== false) {
                unset($this->unselectedRoles[$keyToRemove]);
            }

        }

        $this->originalRoles = $this->selectedRoles;

    }

    public function updatedProfilePic()
    {
        $this->validate([
            'profilePic' => 'image|max:10240',
        ]);
    }

    public function testSave()
    {
        // $this->profilePic->store('profile-pics');
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
                // Delete Old Signature from Public/Signatures
                // -----------------------------------------------------------------------

                $oldSignaturePath = public_path('signatures/' . $this->signature);

                $currentUser = User::where('id', $this->userId)->first();

                // Check if the file exists before attempting to delete from public/signatures
                if (isset($currentUser->signature) && $currentUser->signature !== null) {

                    if (file_exists($oldSignaturePath)) {
                        unlink($oldSignaturePath);
                    }

                }

                // -----------------------------------------------------------------------
                // Update New Signature Name to DB
                // -----------------------------------------------------------------------

                User::where('id', $this->userId)->update(['signature' => $fileName]);

            }

        }

        // -------------------------------------------------------------------------------
        // Profile Pic (IN PROGRESS)
        // -------------------------------------------------------------------------------
        if(true){

            if(isset($this->profilePic) && !empty($this->profilePic)){

                $rules = [
                    'profilePic' => 'image|max:10240',
                ];

                try {

                    $this->validate($rules);

                    // Delete old picture
                    Storage::delete('public/profile-pics/' . auth()->user()->profile_pic);

                    // Save new picture
                    $imgName = "profile_" . auth()->guard('ims')->user()->id . time() . "." . $this->profilePic->extension();
                    $this->profilePic->storeAs('profile-pics', $imgName, 'public');

                    // Save new picture name to database
                    User::where('id', $this->userId)->update(['profile_pic' => $imgName]);

                } catch (ValidationException $e) {

                    // If validation fails, trigger toast

                    $data = [
                        'position' => 'top-right',
                        'type' => 'warning',
                        'message' => 'Warning',
                        'description' => $e->validator->errors()->first('profilePic'),
                    ];

                    $this->dispatchBrowserEvent('toast-show', $data);

                }

                // Prevent code from being run-through if validate fails
                $this->validate($rules);


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

            return redirect()->route('ims.myProfile')->with('success', $prevData);
        }

    }

    public function render()
    {
        return view('livewire.pages.user.profile');
    }
}
