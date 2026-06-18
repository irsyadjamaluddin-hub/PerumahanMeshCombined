<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;


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

use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;
use DateTime;
use Carbon\Carbon;
use Log;
use Flash;

use App\Mail\EmailRegister;
use App\Mail\EmailApproverRegister;
use App\Mail\EmailApprover2Register;
use App\Mail\EmailVerifiedAccount;
use App\Mail\EmailApprovedAccount;

use App\Mail\ContohEmail;
use App\Mail\ContohEmailDua;

// New
use App\Models\Day;
// use App\Models\Biodata;
// use App\Models\Contact;
use App\Models\Gender;
use App\Models\Race;
use App\Models\Religion;
use App\Models\Citizenship;
// use App\Models\User;
use App\Models\MaritalStatus;
use App\Models\ICColor;
// use App\Models\Department;
use App\Models\Ministry;
use App\Models\Bahagian;
use App\Models\Unit;
use App\Models\Country;
// use App\Models\EmploymentStatus;
use App\Models\MileageStatus;
use App\Models\AllowanceCategory;
use App\Models\Division;
use App\Models\EducationLevel;
use App\Models\Education;
// use App\Models\Employment;
use App\Models\Designation;
use App\Models\District;
use App\Models\SkimPerkhidmatan;
use App\Models\SalaryScale;
use App\Models\RolePeranan;
use App\Models\Cluster;
use App\Models\ServiceStatus;
// use App\Models\Salary;
use App\Models\Performance;
use App\Models\Medal;
use App\Models\Grade;
use App\Models\Certificate;
use App\Models\Exam;
use App\Models\ExamList;
use App\Models\Programme;
use App\Models\ProgrammeList;
use App\Models\Paperwork;
use App\Models\Course;
use App\Models\VaccinationInfo;
use App\Models\VaccinationDose;
use App\Models\VaccinationBooster;
use App\Models\Vulnerable;
use App\Models\EmergencyRelationship;
use App\Models\ART;
use App\Models\File;
use App\Models\SSM;
use App\Models\Bersara;

// use Illuminate\Support\Facades\Crypt;

class StagingController extends Controller
{
    public function updateuser(Request $request)
    {
        // dd($request);

        // hiding required
        // $request->validate([

        // ]);

        // dd('here');

        $icNos = Auth::user()->ic_no;

        $telMobile = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('telephone_mobile');

        try {

            $now = Carbon::now();
            // $biodata =  Biodata::select('biodatas.*')
            //     ->where('ic_no', $request->ic_no)
            //     ->update([

            //         // 'name' => $request->name_user,
            //         'dob' => $request->dob,
            //         'gender_id' => $request->gender_id,
            //         'marital_status_id' => $request->marital_status_id,
            //         'race_id' => $request->race_id,
            //         'race_other' => $request->input('race_other'),
            //         'religion_id' => $request->religion_id,
            //         'religion_other' => $request->input('religion_other'),
            //         'place_of_birth' => $request->place_of_birth,
            //         'bersara_date' => $request->bersara_date,
            //         'updated_at' => $now,
            //     ]);

            // $now = Carbon::now();

            // $contact = Contact::updateOrCreate(
            //     [
            //         'ic_no' => $request->input('ic_no'),
            //     ],

            //     [
            //         'address' => $request->input('address'),
            //         'telephone_mobile' => $request->input('telephone_mobile'),
            //         'updated_at' => $now,
            //     ]
            // );

            if ($request->ic_file != '') {

                $file1 = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
                    ->where('ic_no', $request->input('ic_no'))
                    ->value('ic_file');

                Storage::disk('public')->delete($file1);

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],

                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'ic_filename' => $request->ic_file->getClientOriginalName(),
                        'ic_file' => $request->file('ic_file')->store('ic', 'public'),
                        'updated_at' => $now,
                    ]
                );

            } else {

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],

                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'updated_at' => $now,
                    ]
                );

            }

            if ($request->apptletter_file != '') {

                $file3 = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
                    ->where('ic_no', $request->input('ic_no'))
                    ->value('apptletter_file');

                Storage::disk('public')->delete($file3);

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],

                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'apptletter_filename' => $request->apptletter_file->getClientOriginalName(),
                        'apptletter_file' => $request->file('apptletter_file')->store('apptletter', 'public'),
                        'updated_at' => $now,
                    ]
                );

            } else {

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],

                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'updated_at' => $now,
                    ]
                );

            }

            if ($request->workreport_filenew !== '') {

                $file4 = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
                    ->where('ic_no', $request->input('ic_no'))
                    ->value('workreport_file');

                Storage::disk('public')->delete($file4);

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],
                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'workreport_filename' => $request->workreport_file->getClientOriginalName(),
                        'workreport_file' => $request->file('workreport_file')->store('workreport', 'public'),
                        'updated_at' => $now,
                    ]
                );

            } else {

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],

                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'updated_at' => $now,
                    ]
                );

            }

            if ($request->passport_file != '') {

                $file5 = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
                    ->where('ic_no', $request->input('ic_no'))
                    ->value('passport_file');

                Storage::disk('public')->delete($file5);

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],

                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'passport_filename' => $request->passport_file->getClientOriginalName(),
                        'passport_file' => $request->file('passport_file')->store('passport', 'public'),
                        'updated_at' => $now,
                    ]
                );

            } else {

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],

                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'updated_at' => $now,
                    ]
                );

            }

            $employment = Employment::updateOrCreate(
                [
                    'ic_no' => $request->input('ic_no'),
                ],

                [
                    'current_designation_date' => $request->input('current_designation_date'),
                    'current_designation_id' => $request->input('current_designation_id'),
                    'current_service_place' => $request->current_service_place,

                ]
            );

            $userID = Auth::user()->id;
            $userEmail = Auth::user()->email;
            $icNos = Auth::user()->ic_no;
            $dateTime = Carbon::now();
            Log::info('User ID ' . $userID . ' updated his/her profile. Email: ' . $userEmail . '. Date/time: ' . $dateTime);

            // Whatsapp API Start
            $data = [
                'phone' => "+673". $telMobile, // Receivers phone if country code is not included
                // 'phone' => $book123->phone_number, //Receiver phone if country code is included
                'template' => 'receiver_ssm_applicant', // Template name
                'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
                'language' =>  ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
                // "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=>"aaa" ], ["type"=>"text","text"=>"ssss" ]]]],
            ];
        
            $json = json_encode($data); // Encode data to JSON
            // URL for request POST /message
            $token = '7hpe9bwi2bl1k5ja';
            $instanceId = '448643';
            $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
            // Make a POST request
            $options = stream_context_create(['http' => [
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $json
                ]
            ]);

            // Send a request
            $result = file_get_contents($url, false, $options);
            //Whatsapp API End

            $staticphoneno = "8282800";

            // Whatsapp API Start
            $data = [
                'phone' => "+673". $staticphoneno, // Receivers phone if country code is not included
                // 'phone' => $book123->phone_number, //Receiver phone if country code is included
                'template' => 'receiver_ssm_admin', // Template name
                'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
                'language' =>  ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
                // "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=>"aaa" ], ["type"=>"text","text"=>"ssss" ]]]],
            ];

            $json = json_encode($data); // Encode data to JSON
            // URL for request POST /message
            $token = '7hpe9bwi2bl1k5ja';
            $instanceId = '448643';
            $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
            // Make a POST request
            $options = stream_context_create(['http' => [
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $json
                ]
            ]);

            // Send a request
            $result = file_get_contents($url, false, $options);
            //Whatsapp API End

            return redirect()->route('ssms.ssm.index', $icNos);
            //  ->with('success_message', 'Information was successfully updated!');


        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }

        return redirect()->route('ssms.ssm.index')->with('success_message', 'SSM Application successfully submited!');

    }

    public function editUser($encryptedId){

        // dd('hey');

        $icNos = Auth::user()->ic_no;

        $id =Crypt ::decryptString($encryptedId);

        $ssms = SSM::all()->where('id', '=', $id)->first();

        $icNos = $ssms->ic_no;

        $biodata = Biodata::select('biodatas.*')
            ->where('ic_no', $icNos)
            ->first();

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);
        $contacts = Contact::all()
            ->where('ic_no', '=', $icNos);
        $employments = SSM::all()
            ->where('ic_no', '=', $icNos);
        $educations = Education::all()
            ->where('ic_no', '=', $icNos);
        $performances = Performance::all()
            ->where('ic_no', '=', $icNos);
        $medals = Medal::all()
            ->where('ic_no', '=', $icNos);
        $salarys = Salary::all()
            ->where('ic_no', '=', $icNos);
        $certificates = Certificate::all()
            ->where('ic_no', '=', $icNos);
        $exams = Exam::all()
            ->where('ic_no', '=', $icNos);
        $programmes = Programme::all()
            ->where('ic_no', '=', $icNos);
        $paperworks = Paperwork::all()
            ->where('ic_no', '=', $icNos);
        $courses = Course::all()
            ->where('ic_no', '=', $icNos);

        $files = File::all()
            ->where('ic_no', '=', $icNos);

        $ssms = SSM::all()
            ->where('ic_no', '=', $icNos);

        $bersaras = Bersara::all()
            ->where('ic_no', '=', $icNos);

        $school = Employment::leftjoin('departments', 'emp_employment_infos.school_id', '=', 'departments.code')
            ->select('departments.label as school_name')
            ->where('emp_employment_infos.ic_no', $icNos)
            ->first();
            
        $genders = Gender::pluck('label', 'id')->all();

        return view('ssms.edituser-staging', compact('biodata', 'school', 'salarys', 'biodatas', 'contacts', 'employments', 'educations', 'performances', 'medals', 'certificates', 'exams', 'programmes', 'paperworks', 'courses', 'files', 'ssms', 'bersaras', 'genders'));
    }

    public function createUser()
    {

        // if(Auth::user()->hasRole('ROLE_USER') || Auth::user()->hasRole('ROLE_ADMIN') ){
        $users = Auth::user()->name;
        $icNos = Auth::user()->ic_no;
        $usersEmail = Auth::user()->email;
        $genders = Gender::pluck('label', 'id')->all();
        $races = Race::pluck('label', 'id')->all();
        $raceOther = Race::pluck('label', 'id')->all();
        $religions = Religion::pluck('label', 'id')->all();
        $religionOther = Race::pluck('label', 'id')->all();
        $citizenships = Citizenship::pluck('label', 'id')->all();
        $maritalstatuss = MaritalStatus::pluck('label', 'id')->all();
        $employmentstatuss = EmploymentStatus::pluck('label', 'id')->all();
        $allowancecategorys = AllowanceCategory::pluck('label', 'id')->all();
        $divisions = Division::pluck('label', 'id')->all();
        $iccolors = ICColor::pluck('label', 'id')->all();
        $departments = Department::pluck('label', 'id')->all();
        //$ministrys = Ministry::pluck('label','id')->all();
        $bahagians = Bahagian::pluck('label', 'code')->all();
        $units = Unit::pluck('label', 'code')->all();
        $countrys = Country::pluck('label', 'id')->all();
        $educations = EducationLevel::pluck('label', 'id')->all();
        $designations = Designation::pluck('label', 'id')->all();
        $currentDesignations = Designation::pluck('label', 'id')->all();
        $districts = District::pluck('label', 'id')->all();
        $skimPerkhidmatans = SkimPerkhidmatan::pluck('label', 'id')->all();
        $salaryScales = SalaryScale::pluck('label', 'code')->all();
        $roles = RolePeranan::pluck('label', 'id')->all();
        $clusters = Cluster::pluck('cluster_name', 'id')->all();
        $serviceStatuss = ServiceStatus::pluck('label', 'id')->all();

        $vaccinationinfos = VaccinationInfo::pluck('label', 'id')->all();
        $vaccinationdoses = VaccinationDose::pluck('label', 'id')->all();
        $vaccinationboosters = VaccinationBooster::pluck('label', 'id')->all();
        $vulnerable = Vulnerable::pluck('label', 'id')->all();

        $relationEmergencys = EmergencyRelationship::pluck('label', 'id')->all();


        $biodata = Biodata::select(['biodatas.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->first();
        $bruhimsNos = Biodata::select(['biodatas.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('bruhims_no');
        $vaccine = Biodata::select(['biodatas.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('vac_info');
        $telOffice = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('telephone_office');
        $telHome = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('telephone_home');
        $telMobile = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('telephone_mobile');
        //contact info added by laila
        $address = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('address');
        $postcode = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('postcode');
        $country = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('country_id');
        $personalEmail = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('personal_email');
        $nameEmergency = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('name_ec');
        $telEmergency = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('tel_ec');
        $relationEmergency = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('rs_ec');


        $retirementDate = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('retirement_date');
        $eduId = Education::select(['emp_education_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('education_id');
        $eduName = Education::select(['emp_education_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('education_name');
        $eduFile = Education::select(['emp_education_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('file_name');
        $eduFilePath = Education::select(['emp_education_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('file');
        $gradDate = Education::select(['emp_education_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('graduation_date');

        // $ministry = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
        // 				->where('ic_no', $icNos)
        // 				->value('ministry_id');

        $ministry = Employment::leftjoin('ministrys', 'emp_employment_infos.ministry_id', '=', 'ministrys.code')
            ->select('ministrys.label as ministry_name')
            ->where('emp_employment_infos.ic_no', $icNos)
            ->first();

        $department = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('department_id');

        $school = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('school_id');

        $bahagian = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('bahagian_id');

        $cluster = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('cluster_id');

        $bahagianOther = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('bahagian_other');
        $unit = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('unit_id');
        $unitOther = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('unit_other');
        $serviceDate = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('service_begin_date');
        $employmentStatus = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('employment_status_id');
        $role = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('role');
        $designation = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('designation_id');
        $currentDesignation = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('current_designation_id');
        $district = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('district_work_id');
        $roleDateStart = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('current_designation_date');
        $skimPerguruan = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('skim_perguruan');
        $skimPerkhidmatan = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('skim_perkhidmatan_id');
        $jpaRefNo = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('jpa_reference_no');
        $deptRefNo = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('dept_reference_no');
        $ssmRefNo = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('ssm_reference_no');

        $salaryScale = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('salary_scale');


        //Salary Part Start
        $salary = Salary::select(['emp_salary_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('salary');
        $division = Salary::select(['emp_salary_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('division_id');
        $allowanceCat = Salary::select(['emp_salary_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('allowance_category_id');
        $incrementDate2 = Salary::select(['emp_salary_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('increment_date');
        $salaryScale2 = Salary::select(['emp_salary_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('salaryscale_id');


        $personnelFail = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('personnel_file');
        $designationPlace = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('first_service_place');

        $designationCurrentPlace = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('current_service_place');

        // $serviceStatus = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
        // 				->where('ic_no', $icNos)
        // 				->value('service_status_id');

        $serviceStatus = Employment::leftjoin('service_statuss', 'emp_employment_infos.service_status_id', '=', 'service_statuss.code')
            ->select('service_statuss.label as service_status_name')
            ->where('emp_employment_infos.ic_no', $icNos)
            ->first();

        $employments = Employment::all()
            ->where('ic_no', '=', $icNos);




        //performances
        $performances = Performance::all()
            ->where('ic_no', '=', $icNos);
        $grades = Grade::pluck('label', 'id')->all();
        $gradId = Performance::select(['performances.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('grade_id');

        //medals
        $medals = Medal::all()
            ->where('ic_no', '=', $icNos);

        //certificate
        $certificates = Certificate::all()
            ->where('ic_no', '=', $icNos);

        //exam
        //exam
        $exams = Exam::all()
            ->where('ic_no', '=', $icNos);
        $examawam = ExamList::pluck('label', 'id')->all();
        $examId = Exam::select(['emp_exam_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('name');
        $examgradId = Exam::select(['emp_exam_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('grade_id');




        //programme
        $programmes = Programme::all()
            ->where('ic_no', '=', $icNos);
        $progs = ProgrammeList::pluck('label', 'id')->all();
        $progId = Programme::select(['emp_programme_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('name');

        //paperwork
        $paperworks = Paperwork::all()
            ->where('ic_no', '=', $icNos);

        //course
        $courses = Course::all()
            ->where('ic_no', '=', $icNos);


        //file
        $fileId = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('emp_file_id');
        $icFile = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('ic_filename');
        $icFilePath = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('ic_file');

    

        $apptletterFile = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('apptletter_filename');
        $apptletterFilePath = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('apptletter_file');

        $workreportFile = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('workreport_filename');
        $workreportFilePath = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('workreport_file');

        $passportFile = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('passport_filename');
        $passportFilePath = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('passport_file');

        // dd('e');

        return view('ssms.create-staging', compact(
            'biodata',
            'genders',
            'races',
            'raceOther',
            'religions',
            'religionOther',
            'citizenships',
            'maritalstatuss',
            'iccolors',
            'departments',
            'bahagians',
            'units',
            'countrys',
            'users',
            'usersEmail',
            'icNos',
            'address',
            'postcode',
            'country',
            'personalEmail',
            'nameEmergency',
            'telEmergency',
            'relationEmergency',
            'relationEmergencys',
            'employmentstatuss',
            'allowancecategorys',
            'divisions',
            'telOffice',
            'telHome',
            'telMobile',
            'educations',
            'eduId',
            'eduName',
            'eduFile',
            'eduFilePath',
            'gradDate', //'ministrys', 
            'designations',
            'districts',
            'skimPerkhidmatans',
            'school',
            'clusters',
            'cluster',
            'serviceStatuss',
            'serviceStatus',
            'personnelFail',
            'vulnerable',
            'designationPlace',
            'designationCurrentPlace',
            'employments',
            'incrementDate2',
            'salaryScale2',
            'vaccinationinfos',
            'vaccinationdoses',
            'vaccinationboosters',
            'ministry',
            'department',
            'bahagian',
            'bahagianOther',
            'unit',
            'unitOther',
            'serviceDate',
            'employmentStatus',
            'role',
            'designation',
            'district',
            'roleDateStart',
            'skimPerguruan',
            'skimPerkhidmatan',
            'jpaRefNo',
            'deptRefNo',
            'ssmRefNo',
            'salaryScale',
            'salaryScales',
            'salary',
            'division',
            'allowanceCat',
            'roles',
            'currentDesignation',
            'currentDesignations',
            'retirementDate',
            'performances',
            'grades',
            'gradId',
            'medals',
            'certificates',
            'exams',
            'examawam',
            'examId',
            'examgradId',
            'programmes',
            'progs',
            'progId',
            'paperworks',
            'courses',
            'icFile',
            'icFilePath',
            'apptletterFile',
            'apptletterFilePath',
            'workreportFile',
            'workreportFilePath',
            'passportFile',
            'passportFilePath'
        ));
        // }
        // else
        // 
        // return redirect()->back();
        // }
    }

    public function update(Request $request)
    {
        // dd($request);

        $icNos = Auth::user()->ic_no;

        // start of rule validation
        $file = File::select(['emp_file_infos.workreport_file','emp_file_infos.ic_file','emp_file_infos.apptletter_file','emp_file_infos.passport_file', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $request->input('ic_no'))
            ->first();

        $existingFile = $file ? $file->workreport_file : null;
        $existingApptLetterFile = $file ? $file->apptletter_file : null;
        $existingPassportFile = $file ? $file->passport_file : null;
        $existingICFile = $file ? $file->ic_file : null;
        
        $rules = [];
        
        if (!$existingFile) {
            $rules['workreport_filenew'] = 'required|file';
        }
        
        if (!$existingApptLetterFile) {
            $rules['workreport_file'] = 'required|file';
        }
        
        if (!$existingPassportFile) {
            $rules['workreport_file'] = 'required|file';
        }
        
        if (!$existingICFile) {
            $rules['workreport_file'] = 'required|file';
        }
        
        $request->validate($rules);

        // end of rule validation
        
        $icNos = Auth::user()->ic_no;
        $ssm = new SSM;
        $ssm->ic_no = $icNos;
        $ssm->name = $request->name;
        $ssm->address = $request->address;
        $ssm->dob = $request->dob;
        $ssm->place_of_birth = $request->place_of_birth;
        $ssm->gender_id = $request->gender_id;
        $ssm->current_designation_id = $request->current_designation_id;
        $ssm->current_service_place = $request->current_service_place;
        $ssm->current_designation_date = $request->current_designation_date;
        $ssm->bersara_date = $request->bersara_date;
        $ssm->telephone_mobile = $request->telephone_mobile;
        $ssm->martial_status_id = $request->martial_status_id;
        $ssm->race_id = $request->race_id;
        $ssm->race_other = $request->race_other;
        $ssm->religion_id = $request->religion_id;
        
        if ($request->hasFile('ic_filenew')) {
            $file = $request->file('ic_filenew');
            $ssm->ic_file = $file->store('ic', 'public');
            $ssm->ic_filename = $file->getClientOriginalName();
        } else { 
            $ssm->ic_file = $request->ic_file;
            $ssm->ic_filename = $request->ic_filename;
        }

        // if ($request->hasFile('apptletter_filenew')) {
        //     $file = $request->file('apptletter_filenew');
        //     $ssm->apptletter_filename = $file->getClientOriginalName();
        //     $ssm->apptletter_file = $file->store('apptletter', 'public');
        // }else{
        //     $ssm->apptletter_file = $request->apptletter_file;
        //     $ssm->apptletter_filename = $request->apptletter_filename;
        // }

        if ($request->hasFile('apptletter_filenew')) {
            $file = $request->file('apptletter_filenew');
            $ssm->apptletter_filename = $file->getClientOriginalName();
            $ssm->apptletter_file = $file->store('apptletter', 'public');
        } else {
            $ssm->apptletter_file = $request->input('apptletter_file');
            $ssm->apptletter_filename = $request->input('apptletter_filename');
        }


        if ($request->hasFile('workreport_filenew')) {
            $file = $request->file('workreport_filenew');
            $ssm->workreport_filename = $file->getClientOriginalName();
            $ssm->workreport_file = $file->store('workreport', 'public');
        }else{
            $ssm->workreport_file = $request->workreport_file;
            $ssm->workreport_filename = $request->workreport_filename;
        } 

        if ($request->hasFile('passport_filenew')) {
            $file = $request->file('passport_filenew');
            $ssm->passport_filename = $file->getClientOriginalName();
            $ssm->passport_file = $file->store('passport', 'public');
        }else{
            $ssm->passport_file = $request->passport_file;
            $ssm->passport_filename = $request->passport_filename;
        } 

        $ssm->save();

        $telMobile = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('telephone_mobile');

        try {
            $now = Carbon::now();
            $biodata =  Biodata::select('biodatas.*')
                ->where('ic_no', $request->ic_no)
                ->update([
                    // 'name' => $request->name_user,
                    'dob' => $request->dob,
                    'gender_id' => $request->gender_id,
                    'marital_status_id' => $request->marital_status_id,
                    'race_id' => $request->race_id,
                    'race_other' => $request->input('race_other'),
                    'religion_id' => $request->religion_id,
                    'religion_other' => $request->input('religion_other'),
                    'place_of_birth' => $request->place_of_birth,
                    'bersara_date' => $request->bersara_date,
                    'updated_at' => $now,
                ]);

            $now = Carbon::now();

    

            $contact = Contact::updateOrCreate(
                [
                    'ic_no' => $request->input('ic_no'),
                ],

                [
                    'address' => $request->input('address'),
                    'telephone_mobile' => $request->input('telephone_mobile'),
                    'updated_at' => $now,
                ]
            );


            if ($request->ic_filenew != '') {

                // $file1 = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
                //     ->where('ic_no', $request->input('ic_no'))
                //     ->value('ic_file');

                // Storage::disk('public')->delete($file1);

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],

                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'ic_filename' => $request->ic_filenew->getClientOriginalName(),
                        'ic_file' => $request->file('ic_filenew')->store('ic', 'public'),
                        'updated_at' => $now,
                    ]
                );
            } else {

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],

                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'updated_at' => $now,
                    ]
                );
            }

       

            if ($request->apptletter_filenew != '') {

                // $file3 = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
                //     ->where('ic_no', $request->input('ic_no'))
                //     ->value('apptletter_file');

                // Storage::disk('public')->delete($file3);

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],

                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'apptletter_filename' => $request->apptletter_filenew->getClientOriginalName(),
                        'apptletter_file' => $request->file('apptletter_filenew')->store('apptletter', 'public'),
                        'updated_at' => $now,
                    ]
                );
            } else {

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],

                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'updated_at' => $now,
                    ]
                );
            }

            if ($request->workreport_filenew !== '') {

                // $file4 = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
                //     ->where('ic_no', $request->input('ic_no'))
                //     ->value('workreport_file');

                // Storage::disk('public')->delete($file4);

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],
                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'workreport_filename' => $request->workreport_filenew->getClientOriginalName(),
                        'workreport_file' => $request->file('workreport_filenew')->store('workreport', 'public'),
                        'updated_at' => $now,
                    ]
                );

            } else {

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],

                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'updated_at' => $now,
                    ]
                );
            }


            if ($request->passport_filenew != '') {

                // $file5 = File::select(['emp_file_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
                //     ->where('ic_no', $request->input('ic_no'))
                //     ->value('passport_file');

                // Storage::disk('public')->delete($file5);

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],

                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'passport_filename' => $request->passport_filenew->getClientOriginalName(),
                        'passport_file' => $request->file('passport_filenew')->store('passport', 'public'),
                        'updated_at' => $now,
                    ]
                );
            } else {

                $file = File::updateOrCreate(
                    [
                        'ic_no' => $request->input('ic_no'),
                    ],

                    [
                        'emp_file_id' => $request->input('emp_file_id'),
                        'updated_at' => $now,
                    ]
                );
            }





            $employment = Employment::updateOrCreate(
                [
                    'ic_no' => $request->input('ic_no'),
                ],

                [
                    'current_designation_date' => $request->input('current_designation_date'),
                    'current_designation_id' => $request->input('current_designation_id'),
                    'current_service_place' => $request->current_service_place,

                ]
            );
        

            $userID = Auth::user()->id;
            $userEmail = Auth::user()->email;
            $icNos = Auth::user()->ic_no;
            $dateTime = Carbon::now();
            Log::info('User ID ' . $userID . ' updated his/her profile. 
        Email: ' . $userEmail . '. Date/time: ' . $dateTime);


        // Whatsapp API Start
        $data = [
            'phone' => "+673". $telMobile, // Receivers phone if country code is not included
            // 'phone' => $book123->phone_number, //Receiver phone if country code is included
            'template' => 'receiver_ssm_applicant', // Template name
            'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
            'language' =>  ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
            // "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=>"aaa" ], ["type"=>"text","text"=>"ssss" ]]]],
         ];
        
        $json = json_encode($data); // Encode data to JSON
        // URL for request POST /message
        $token = '7hpe9bwi2bl1k5ja';
        $instanceId = '448643';
        $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
        // Make a POST request
        $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        // Send a request
        $result = file_get_contents($url, false, $options);
        //Whatsapp API End

                // send static to number person 1
        $staticphoneno = "+6738282800";

        // Whatsapp API Start
        $data = [
            'phone' => $staticphoneno, // Receivers phone if country code is not included
            // 'phone' => $book123->phone_number, //Receiver phone if country code is included
            'template' => 'receiver_ssm_admin', // Template name
            'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
            'language' =>  ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
            // "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=>"aaa" ], ["type"=>"text","text"=>"ssss" ]]]],
         ];
        $json = json_encode($data); // Encode data to JSON
        // URL for request POST /message
        $token = '7hpe9bwi2bl1k5ja';
        $instanceId = '448643';
        $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
        // Make a POST request
        $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        // Send a request
        $result = file_get_contents($url, false, $options);
        //Whatsapp API End

        // send static number to 2nd person
        $staticphoneno1 = "+6738866078";
     


        // Whatsapp API Start
        $data = [
            'phone' => $staticphoneno1, // Receivers phone if country code is not included
            // 'phone' => $book123->phone_number, //Receiver phone if country code is included
            'template' => 'receiver_ssm_admin', // Template name
            'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
            'language' =>  ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
            // "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=>"aaa" ], ["type"=>"text","text"=>"ssss" ]]]],
         ];
        $json = json_encode($data); // Encode data to JSON
        // URL for request POST /message
        $token = '7hpe9bwi2bl1k5ja';
        $instanceId = '448643';
        $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
        // Make a POST request
        $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        // Send a request
        $result = file_get_contents($url, false, $options);
        //Whatsapp API End

        // send static to number person 3
        $staticphoneno2 = "+6738844679";


        // Whatsapp API Start
        $data = [
            'phone' => $staticphoneno2, // Receivers phone if country code is not included
            // 'phone' => $book123->phone_number, //Receiver phone if country code is included
            'template' => 'receiver_ssm_admin', // Template name
            'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
            'language' =>  ['code' => 'en', 'policy' => 'deterministic'], // Language parameters
            // "params"=> [["type"=>"body","parameters"=>[["type"=>"text","text"=>"aaa" ], ["type"=>"text","text"=>"ssss" ]]]],
         ];
        $json = json_encode($data); // Encode data to JSON
        // URL for request POST /message
        $token = '7hpe9bwi2bl1k5ja';
        $instanceId = '448643';
        $url = 'http://moe.proxy.mesh/' . $instanceId . '/sendTemplate?token=' . $token;
        // Make a POST request
        $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        // Send a request
        $result = file_get_contents($url, false, $options);
        //Whatsapp API End


            return redirect()->route('ssms.ssm.index', $icNos);
            //  ->with('success_message', 'Information was successfully updated!');


        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }

        return redirect()->route('ssms.ssm.index')
            ->with('success_message', 'SSM Application successfully submited!');
    }
    
    public function newLanding()
    {
        return view('staging.landing');
    }

    public function emailOneShow()
    {
        return view('staging.email-v1');
    }

    public function emailOneSend()
    {   
        $email = "azib.sabtu@moe.gov.bn";
        $name = "Muhammad Azib Imanuddin bin Awang Haji Sabtu";
        $jabatan = "Jabatan Pentadbiran dan Perkhidmatan-Perkhidmatan";

        Mail::to($email)->send(new ContohEmail($name, $jabatan));

        dd('sent bui');
    }

    public function emailTwoShow()
    {
        return view('staging.email-v2');
    }

    public function emailTwoSend()
    {   
        $approverName = "Hajah Surnia Kharida binti Haji Awang Moktar";
        $email = "azib.sabtu@moe.gov.bn";
        $newUserName = "Muhammad Azib Imanuddin bin Awang Haji Sabtu";
        $newUserDepartment = "Jabatan Pentadbiran dan Perkhidmatan-Perkhidmatan";
        $id = "KJ432JH4K2342";

        Mail::to($email)->send(new ContohEmailDua($approverName, $newUserName, $newUserDepartment, $id));

        dd('sent bui');

    }

    // ----------------------------------------------------------------------------
    // Login
    // ----------------------------------------------------------------------------

    public function loginIndex()
    {
        return view('staging.login');
    }

    public function loginSubmit(Request $request)
    {
        // Validate the input for IC number and password
        $request->validate([
            'ic_no' => 'required',
            'password' => 'required',
        ]);

        // Find user by IC number
        $user = User::where('ic_no', $request->ic_no)->first();

        if ($user) {
            // Check if both approval responses are satisfied
            if ($user->approval_response === 'Accept Registration' && $user->approval_response2 === 'Approve') {
                // Check if the password matches
                if (Hash::check($request->password, $user->password)) {
                    // Login the user
                    auth()->login($user);
                    return redirect('/home');
                } else {
                    // Incorrect password
                    return redirect('/stag/login')->with('verification_message', 'Wrong password.');
                }
            } elseif (empty($user->approval_response)) {
                // The account needs verification from the verifier
                return redirect('/stag/login')->with('verification_message', 'Your account needs verification from your verifier.');
            } elseif ($user->approval_response === 'Accept Registration') {
                // The account is pending approval from the MESH TEAM
                return redirect('/stag/login')->with('verification_message', 'Your account is pending approval from the MESH TEAM.');
            } else {
                // The account is not approved yet
                return redirect('/stag/login')->with('verification_message', 'Your account needs approval.');
            }
        } else {
            // User not found
            return redirect('/stag/login')->with('verification_message', 'IC number does not exist.');
        }

    }

    // ----------------------------------------------------------------------------
    // Register
    // ----------------------------------------------------------------------------

    public function regIndex()
    {
        return view('staging.register');
    }

    public function regSubmit(Request $request)
    {

        // Comments @ 21/10/2024:
        // 1. Check if IC and Email already exists in DB.


        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'ic_no' => ['required', 'string', 'max:20','regex:/^\\d+$/', 'unique:users,ic_no'], //only digits
            'password' => [
                'required',
                'string',
                'min:13', // Ensure at least 15 characters
                'regex:/[a-z]/', // Ensure at least one lowercase letter
                'regex:/[A-Z]/', // Ensure at least one uppercase letter
                'regex:/[0-9]/', // Ensure at least one number
                'regex:/[\W_]/', // Ensure at least one special character
                'confirmed' // Ensure the password confirmation matches
            ],
            'employment_status_id' => 'required',
            'department_id' => 'required',
            'bahagian_id' => 'required',
            '_id' => 'required|integer',
            'telephone_mobile' => 'required|string|max:20',
            'ap1_name' => 'required|string|max:255', // Add validation for ap1_name
            'ap1_email' => ['required', 'string', 'email', 'max:100', 'regex:/^[a-zA-Z0-9._%+-]+@(moe\.gov\.bn|edu\.moe\.bn|moe\.edu\.bn)$/'],
        
        ], [
            'department_id.required' => 'This field is required.',
            'employment_status_id.required' => 'This field is required.',
            'bahagian_id.required' => 'This field is required.',
            '_id.required' => 'This field is required.',
            'telephone_mobile.required' => 'This field is required.',

            'ap1_name.required' => 'This field is required.',
            'ap1_email.required' => 'This field is required.',
            'ap1_email.email' => 'You need to use a valid email address.',
            'password.regex' => 'The password must be at least 13 characters long, contain an uppercase letter, a lowercase letter, a number, and a special character.',
            'ap1_email.regex' => "The approver's email format is invalid.",
            'ap2_email.regex' => 'The approver 2 email format is invalid.',
            'ic_no.regex'=> 'The IC number must contain only digits'
        ]);
        $validatedData = $request->all(); // Get all input data

        // / Log the password hash for debugging purposes


        // Create User
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'ic_no' => $validatedData['ic_no'],
            'password' => $validatedData['password'], // Ensure password is hashed
            'bahagian_id' => $validatedData['bahagian_id'],
            'division_id' => $validatedData['division_id'],
            'telephone_mobile' => $validatedData['telephone_mobile'],
            'ap1_name' => $validatedData['ap1_name'],
            'ap1_email' => $validatedData['ap1_email'],
            'remember_token' => Str::random(50),
        ]);


        // Assign ROLE_USER to the new user
        $role = Role::select('id')->where('name', 'ROLE_USER')->first();
        $user->roles()->attach($role);

        // Create Biodata
        $biodata = Biodata::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'ic_no' => $validatedData['ic_no'],
            'bahagian_id' => $validatedData['bahagian_id'],
        ]);

        // Create Employment
        $employment = Employment::create([
            'ic_no' => $validatedData['ic_no'],
            'ministry_id' => '1',
            'service_status_id' => '1',
            'department_id' => $validatedData['department_id'],
            'employment_status_id' => $validatedData['employment_status_id'],
            'bahagian_id' => $validatedData['bahagian_id'],
            'division_id' => $validatedData['division_id'],
        ]);

        // Create Salary
        $salary = Salary::create([
            'ic_no' => $validatedData['ic_no'],
            'division_id' => $validatedData['division_id'],
        ]);

        // Create Contacts
        $contacts = Contact::create([
            'ic_no' => $validatedData['ic_no'],
            'telephone_mobile' => $validatedData['telephone_mobile'],
        ]);

        // Prepare email data
        $email_data = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ];

        $notf_userEmail = $request->email;
        $notf_Nama = $request->name;

        $notf_approverEmail = $request->ap1_email;
        $notf_NamaApprover = $request->ap1_name;

        // $notf_approverEmail2 = $request->ap2_email;
        // $notf_NamaApprover2 = $request->ap2_name;



       $data1 = User::select('users.*')
       ->orderBy('created_at', 'DESC')
       ->first();

       
       $notf_id = Crypt::encrypt($data1->id);


       $departmentId = $request->department_id;
        $notf_jabatan = Department::where('id', $departmentId)->pluck('label')->first();

        //Mail::to($notf_userEmail)->send(new EmailRegister($notf_Nama, $notf_jabatan));

        //Mail::to($notf_approverEmail)->send(new EmailApproverRegister($notf_NamaApprover,$notf_Nama, $notf_jabatan, $notf_id));

        //Mail::to($notf_approverEmail2)->send(new EmailApprover2Register($notf_NamaApprover2,$notf_Nama, $notf_jabatan, $notf_id));

      return redirect()->route('registerform')
            ->with('success_message', 'Registration submitted! ');
    }

    // ----------------------------------------------------------------------------
    // Approve User Account (From Email)
    // ----------------------------------------------------------------------------

    public function stagApprove($encryptedId)
    {   
        try{
            //decrypt the incoming ID
            $id =Crypt::decrypt($encryptedId);
        } catch (DecryptException $e){
            \Log::error('Decryption failed: '. $e->getMessage());
            return abort(404);
        }

        $registerverify = User::all()->where('id', '=', $id);
    
        // get the user by id
        $data = User::findorFail($id);

        $icNo = $data->ic_no;

        $employments = Employment::where('ic_no', $icNo)->get();
    
        // return view('approververify', compact('registerverify','employments'));

        return view('staging.approve', compact('registerverify','employments'));
    }

    public function stagApproveUpdate(Request $request)
    {   

        $now = Carbon::now();

        // Find the user by ID and update
        User::where('id', $request->id)->update([
            'approval_response' => $request->input('approval_response'),
            'approve_at' => $now,
            'email_verified_at' => $now,
        ]);

        // Get the updated user details
        $updatedUser = User::find($request->id);

        //  initialize success message
        $successMessage= '';

        if($updatedUser->approval_response === 'Accept Registration'){

            $notf_accountapproved= $updatedUser->email;

            $notf_Nama = $updatedUser->name;
    
            // Get the department ID and label
            $departmentId = $updatedUser->department_id; // Assuming this is the correct relationship
            $notf_jabatan = Department::where('id', $departmentId)->pluck('label')->first();
    
            Mail::to($notf_accountapproved)->send(new EmailVerifiedAccount($notf_Nama, $notf_jabatan));

            $successMessage= 'The requested account has been succesfully verified';
        
        } else {
            
            $successMessage= 'The requested account has been succesfully declined';

        }

        return redirect()->back()->with('success_message', $successMessage);
    }

}
