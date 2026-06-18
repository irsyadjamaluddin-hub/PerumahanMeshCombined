<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use App\Models\Biodata;
use App\Models\Department;
use App\Models\Employment;
use App\Models\EmploymentStatus;
use App\Models\Salary;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;
use DateTime;
use Carbon\Carbon;
use Log;
use Flash;
use Session;
use \Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/logout';
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

  

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'ic_no' => ['required', 'string', 'max:8', 'unique:users'],

          
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {   
        
        $user = User::Create([
            'name' => $data['name'],
            'email' => $data['email'],
			'ic_no' => $data['ic_no'],
            'password' => $data['password'],
            'bahagian_id' => $data['bahagian_id'],
            'division_id' => $data['division_id'],
            'telephone_mobile' => $data['telephone_mobile'],
           
			'remember_token' => Str::random(50),

        ]);

        // /** The id of role name ROLE_USER is assigned into new user registering   **/
		$role = Role::select('id')->where('name', 'ROLE_USER')->first();
		$user->roles()->attach($role);

        $biodata = Biodata::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'ic_no' => $data['ic_no'],
            'bahagian_id' => $data['bahagian_id'],
            
        ]);

        $employment = Employment::create([
			'ic_no' => $data['ic_no'],
            'ministry_id' => '1',
            'service_status_id' => '1',
            'department_id'=>$data['department_id'],
            'employment_status_id' => $data['employment_status_id'],
            'bahagian_id' => $data['bahagian_id'],
            'division_id' => $data['division_id'],
           
        ]);
		
        $salary = Salary::create([
            'ic_no' => $data['ic_no'],        	
            'division_id' => $data['division_id'],
        ]);
		
        $contacts = Contact::create([
            'ic_no' => $data['ic_no'],
            'telephone_mobile' => $data['telephone_mobile'],
        ]);

		$email_data = array(
        'name' => $data['name'],
        //'name' => 'amirin.mohammad@moe.gov.bn',
        'email' => $data['email'],
        //'email' => 'amirin.mohammad@moe.gov.bn',
		);
		
		

        

		
		//Mail::to($email_data['email'])->send(new MailtrapExample());
		//Mail::to($email_data['email'])->send(new MailtrapExample());
		
		$dateTime = Carbon::now();
                Log::notice('Email notification has been sent to '.$email_data['email'].' Date/time: '.$dateTime);
		
        return $user; 

     
    }

  
}
