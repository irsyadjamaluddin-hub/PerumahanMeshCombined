<?php

namespace App\Http\Livewire\Pages;

use App\Models\IMS\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginV2 extends Component
{
    public $email;
    public $password;

    public $email_message;
    public $password_message;

    public $hello = "hello";

    protected $rules = [

        'email' => 'required|email',
        'password' => 'required|min:6',

    ];

    public function mount()
    {

    }

    public function updated($propertyName) {

        $this->validateOnly($propertyName);
    }

    public function login()
    {

        $this->email_message = null;
        $this->password_message = null;

        $validatedData = $this->validate();

        $user = User::where("email", $this->email)->first();

        if($user !== null){

            if(Hash::check($this->password, $user->password)){

                Auth::guard('ims')->attempt([
                    'email' => $this->email,
                    'password' => $this->password
                ]);

                return redirect()->intended('dashboard');

            } else {

                $this->password_message = "Incorrect password. please try again.";

            }

        } else {

            $this->email_message = "A user with this email does not exist.";

        }

    }

    public function render()
    {
        return view('livewire.pages.login-v2');
    }
}
