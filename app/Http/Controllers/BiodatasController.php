<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;


use App\Http\Controllers\Controller;

use App\Models\Day;
use App\Models\Biodata;
use App\Models\Contact;
use App\Models\Gender;
use App\Models\Race;
use App\Models\Religion;
use App\Models\Citizenship;
use App\Models\User;
use App\Models\MaritalStatus;
use App\Models\ICColor;
use App\Models\Department;
use App\Models\Ministry;
use App\Models\Bahagian;
use App\Models\Unit;
use App\Models\Country;
use App\Models\EmploymentStatus;
use App\Models\MileageStatus;
use App\Models\AllowanceCategory;
use App\Models\Division;
use App\Models\EducationLevel;
use App\Models\Education;
use App\Models\Employment;
use App\Models\Designation;
use App\Models\District;
use App\Models\SkimPerkhidmatan;
use App\Models\SalaryScale;
use App\Models\RolePeranan;
use App\Models\RoleUser;
use App\Models\Cluster;
use App\Models\ServiceStatus;
use App\Models\Salary;
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
use App\Models\School;
use App\Models\File;

use Log;
use Carbon\Carbon;

class BiodatasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Biodata applications.
     *
     * @return Illuminate\View\View
     */
	
	public function index()
    {
		if(Auth::user()->hasRole('ROLE_SUPERADMIN') ||	Auth::user()->hasRole('ROLE_DA')) 
		{
			$user = Auth::user()->email;
			$genders = Gender::pluck('label','id')->all();
			
			$biodatas = Biodata::select(['biodatas.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
			->latest('created_at')
			->with('gender')
			->paginate(25);
		   
			return view('biodatas.index', compact('biodatas', 'genders'));
		}
		
		if(Auth::user()->hasRole('ROLE_HOD')) 
		{
			$user = Auth::user()->email;
			$hod_ic = Auth::user()->ic_no;
			$sameDepartment = Biodata::select(['biodatas.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $hod_ic)
							->value('department_id');
							//dd($sameDepartment);
			
			$genders = Gender::pluck('label','id')->all();
			
			$biodatas = Biodata::select(['biodatas.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
			->where('department_id', $sameDepartment)
			->where('department_id', '!=', null)
			->latest('created_at')
			->with('gender')
			->paginate(25);
		   
			return view('biodatas.index', compact('biodatas', 'genders'));
		}
		
		if(Auth::user()->hasRole('ROLE_USER')) {
			$user = Auth::user()->email;
			$genders = Gender::pluck('label','id')->all();
			
			$biodatas = Biodata::select(['biodatas.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
			->latest('created_at')
			->where('email', $user)
			->with('gender')
			->paginate(25);
		   
			return view('biodatas.index', compact('biodatas', 'genders'));
		}
		else
		{
		return redirect()->back();
		}
    }
	
	public function show($id)
    {
		
		
			
			$icNos = Auth::user()->ic_no;

			$biodata = Biodata::select('biodatas.*')
						->where('ic_no', $icNos)
						->first();

			if (!$biodata) {
				return redirect()->route('biodatas.biodata.create');
			}

			$biodatas = Biodata::all()
						->where('ic_no', '=', $id);

			$bersara_date =  \Carbon\Carbon::parse($biodata->dob)->addYears(60);

			$contacts = Contact::all()
						->where('ic_no', '=', $icNos);
			$employments = Employment::all()
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

			
			$school = Employment::leftjoin('departments', 'emp_employment_infos.school_id', '=', 'departments.code')
						->select('departments.label as school_name')
						->where('emp_employment_infos.ic_no', $icNos)
						->first();

$files = File::all()
						->where('ic_no', '=', $icNos);
			
			return view('biodatas.show', compact('biodata', 'bersara_date','school', 'salarys', 'biodatas', 'id', 'contacts', 'employments', 'educations', 'performances', 'medals', 'certificates', 'exams', 'programmes', 'paperworks', 'courses' ,'school','files'));
		
    }
	
	
	    public function destroy($id)
    {
        try {
            $biodata = Biodata::findOrFail($id);
            $biodata->delete();

            return redirect()->route('biodatas.biodata.index')
                             ->with('success_message', 'Information was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
	
	    /**
     * Show the form for creating a new Biodata Application.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {   
		$users = Auth::user()->name;
		$icNos = Auth::user()->ic_no;
		$usersEmail = Auth::user()->email;
		$genders = Gender::pluck('label','id')->all();
		$maritalstatuss = MaritalStatus::pluck('label','id')->all();
		$employmentstatuss = EmploymentStatus::pluck('label','id')->all();
		$allowancecategorys = AllowanceCategory::pluck('label','id')->all();
		$divisions = Division::pluck('label','id')->all();
		$iccolors = ICColor::pluck('label','id')->all();
		$departments = Department::pluck('label','id')->all();
		$countrys = Country::pluck('label','id')->all();
		
        return view('biodatas.create', compact('genders', 'maritalstatuss', 'iccolors', 'departments', 'countrys', 'users', 'usersEmail', 'icNos',
		'employmentstatuss', 'allowancecategorys', 'divisions'));
    }

    /**
     * Store a new biodata in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            //dd($data);
            Biodata::create($data);
			
			$userID = Auth::user()->id;
			$userEmail = Auth::user()->email;
			$dateTime = Carbon::Now();
			Log::info('User ID '.$userID.' has successfully been created. Email: '.$userEmail.'. Date/time: '.$dateTime);

            return redirect()->route('biodatas.biodata.index')
                             ->with('success_message', 'Information was successfully created!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
	
	/**
     * Show the form for editing the specified biodata.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
	
		// if(Auth::user()->hasRole('ROLE_USER') || Auth::user()->hasRole('ROLE_ADMIN') ){
			$users = Auth::user()->name;
			$icNos = Auth::user()->ic_no;
			$usersEmail = Auth::user()->email;
			$genders = Gender::pluck('label','id')->all();
			$races = Race::pluck('label','id')->all();
			$raceOther= Race::pluck('label','id')-> all();
			$religions = Religion::pluck('label','id')->all();
			$religionOther= Race::pluck('label','id')-> all();
			$citizenships = Citizenship::pluck('label','id')->all();
			$maritalstatuss = MaritalStatus::pluck('label','id')->all();
			$employmentstatuss = EmploymentStatus::pluck('label','id')->all();
			$allowancecategorys = AllowanceCategory::pluck('label','id')->all();
			$divisions = Division::pluck('label','id')->all();
			$iccolors = ICColor::pluck('label','id')->all();
			$departments = Department::pluck('label','id')->all();
				$schools = School::pluck('label', 'id')->all();
			//$ministrys = Ministry::pluck('label','id')->all();
			$bahagians = Bahagian::pluck('label','code')->all();
			$units = Unit::pluck('label','code')->all();
			$countrys = Country::pluck('label','id')->all();
			$educations = EducationLevel::pluck('label','id')->all();
			$designations = Designation::pluck('label','id')->all();
			$currentDesignations = Designation::pluck('label','id')->all();
			$districts = District::pluck('label','id')->all();
			$skimPerkhidmatans = SkimPerkhidmatan::pluck('label','id')->all();
			$salaryScales = SalaryScale::pluck('label','code')->all();
			$roles = RolePeranan::pluck('label','id')->all();
			$clusters = Cluster::pluck('cluster_name','id')->all();
			$serviceStatuss = ServiceStatus::pluck('label','id')->all();

			$vaccinationinfos = VaccinationInfo::pluck('label','id')->all();
			$vaccinationdoses = VaccinationDose::pluck('label','id')->all();
			$vaccinationboosters = VaccinationBooster::pluck('label','id')->all();
			$vulnerable = Vulnerable::pluck('label','id')->all();

			$relationEmergencys = EmergencyRelationship::pluck('label','id')->all();
			
			
			$biodata = Biodata::select(['biodatas.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
						->where('ic_no', $icNos)
						->first();
			$bruhimsNos = Biodata::select(['biodatas.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('bruhims_no');
			$vaccine = Biodata::select(['biodatas.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('vac_info');
			$telOffice = Contact::select(['emp_contact_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('telephone_office');
			$telHome = Contact::select(['emp_contact_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('telephone_home');
			$telMobile = Contact::select(['emp_contact_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('telephone_mobile');
			//contact info added by laila
			$address = Contact::select(['emp_contact_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('address');
			$postcode = Contact::select(['emp_contact_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('postcode');
			$country= Contact::select(['emp_contact_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('country_id');
			$personalEmail= Contact::select(['emp_contact_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('personal_email');
			$nameEmergency= Contact::select(['emp_contact_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('name_ec');
			$telEmergency= Contact::select(['emp_contact_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('tel_ec');
			$relationEmergency= Contact::select(['emp_contact_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('rs_ec');


			$retirementDate = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('retirement_date');				
			$eduId = Education::select(['emp_education_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('education_id');
			$eduName = Education::select(['emp_education_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('education_name');
			$eduFile = Education::select(['emp_education_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('file_name');	
			$eduFilePath = Education::select(['emp_education_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('file');			
			$gradDate = Education::select(['emp_education_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('graduation_date');

			// $ministry = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
			// 				->where('ic_no', $icNos)
			// 				->value('ministry_id');

			$ministry = Employment::leftjoin('ministrys', 'emp_employment_infos.ministry_id', '=', 'ministrys.code')
							->select('ministrys.label as ministry_name')
							->where('emp_employment_infos.ic_no', $icNos)
							->first();

			$department = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('department_id');

		$school = Employment::select(['emp_employment_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
			->where('ic_no', $icNos)
			->value('school_id');

			$bahagian = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('bahagian_id');

			$cluster = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('cluster_id');

			
							
			$bahagianOther = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('bahagian_other');
			$unit = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('unit_id');
			$unitOther = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('unit_other');
			$serviceDate = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('service_begin_date');
			$employmentStatus = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('employment_status_id');
			$role = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('role');
			$designation = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('designation_id');
			$currentDesignation = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('current_designation_id');
			$district = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('district_work_id');
			$roleDateStart = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('current_designation_date');
			$skimPerguruan = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('skim_perguruan');
			$skimPerkhidmatan = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('skim_perkhidmatan_id');
			$jpaRefNo = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('jpa_reference_no');
			$deptRefNo = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('dept_reference_no');
			$ssmRefNo = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('ssm_reference_no');
			$salaryScale = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('salary_scale');

			//Salary Part Start
			$salary = Salary::select(['emp_salary_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('salary');
			$division = Salary::select(['emp_salary_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('division_id');
			$allowanceCat = Salary::select(['emp_salary_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('allowance_category_id');
			$incrementDate2 = Salary::select(['emp_salary_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('increment_date');
			$salaryScale2 = Salary::select(['emp_salary_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('salaryscale_id');


			$personnelFail = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('personnel_file');
			$designationPlace = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('first_service_place');
			
			$designationCurrentPlace = Employment::select(['emp_employment_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
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
			$grades = Grade::pluck('label','id')->all();
			$gradId = Performance::select(['performances.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
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
			$examId = Exam::select(['emp_exam_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
			->where('ic_no', $icNos)
			->value('name');
			$examgradId = Exam::select(['emp_exam_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
			->where('ic_no', $icNos)
			->value('grade_id');

		


			//programme
			$programmes = Programme::all()
			->where('ic_no', '=', $icNos);
			$progs = ProgrammeList::pluck('label', 'id')->all();
			$progId = Programme::select(['emp_programme_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
			->where('ic_no', $icNos)
			->value('name');

			//paperwork
			$paperworks = Paperwork::all()
			->where('ic_no', '=', $icNos);

			//course
			$courses = Course::all()
			->where('ic_no', '=', $icNos);

			//file
			$fileId = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('emp_file_id');
			$icFile = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('ic_filename');	
			$icFilePath = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('ic_file');	

			$drivelicenseFile = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('drivelicense_filename');	
			$drivelicenseFilePath = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('drivelicense_file');
							
			$apptletterFile = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('apptletter_filename');	
			$apptletterFilePath = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('apptletter_file');	

			$workreportFile = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('workreport_filename');	
			$workreportFilePath = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('workreport_file');	


			$passportFile = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('passport_filename');	

			$passportFilePath = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $icNos)
							->value('passport_file');			
			
							
			return view('biodatas.edit', compact('biodata', 'genders', 'races', 'raceOther', 'religions','religionOther', 'citizenships', 'maritalstatuss', 'iccolors', 'departments', 'bahagians', 'units', 'countrys', 'users', 'usersEmail', 'icNos',
			'address', 'postcode', 'country', 'personalEmail', 'nameEmergency', 'telEmergency', 'relationEmergency', 'relationEmergencys',
			'employmentstatuss', 'allowancecategorys', 'divisions', 'telOffice', 'telHome', 'telMobile', 'educations', 'eduId', 'eduName', 'eduFile', 'eduFilePath', 'gradDate', //'ministrys', 
			'designations', 'districts', 'skimPerkhidmatans', 'school', 'clusters', 'cluster', 'serviceStatuss', 'serviceStatus', 'personnelFail', 'vulnerable',
			'designationPlace', 'designationCurrentPlace', 'employments', 'incrementDate2', 'salaryScale2', 'vaccinationinfos', 'vaccinationdoses', 'vaccinationboosters',
			'ministry', 'department', 'bahagian', 'bahagianOther', 'unit', 'unitOther', 'serviceDate', 'employmentStatus', 'role', 'designation', 'district', 'roleDateStart', 'skimPerguruan', 'skimPerkhidmatan', 'school',
			'schools',
			'jpaRefNo', 'deptRefNo', 'ssmRefNo', 'salaryScale', 'salaryScales', 'salary', 'division', 'allowanceCat', 'roles', 'currentDesignation', 'currentDesignations', 'retirementDate',
			'performances', 'grades', 'gradId', 'medals', 'certificates', 'exams', 'examawam', 'examId','examgradId', 'programmes', 'progs', 'progId', 'paperworks', 'courses',  'fileId', 'icFile', 'icFilePath',
			'drivelicenseFile', 'drivelicenseFilePath', 'apptletterFile', 'apptletterFilePath', 'workreportFile', 'workreportFilePath', 'passportFile', 'passportFilePath'));
		// }
		// else
		// 
		// return redirect()->back();
		// }
	}
    	
    

    /**
     * Update the specified biodata in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            $now = Carbon::Now();

			$biodata =  Biodata::select('biodatas.*')
			->where('ic_no', $request->ic_no)
				->update([
					
						'bruhims_no' => $request->bruhims_no,
						'name' => $request->name_user,
						'email' => $request->email,
						'dob' => $request->dob,
						'age' => $request->age,
						'ic_color_id' => $request->ic_color_id,
						'gender_id' => $request->gender_id,
						'marital_status_id' => $request->marital_status_id,
						'vulnerable_id' => $request->vulnerable_id,	
						'race_id' => $request->race_id,
						'race_other' => $request->input('race_other'),
						'religion_id' => $request->religion_id,
						'religion_other' => $request->input('religion_other'),
						'citizenship_id' => $request->citizenship_id,
						'place_of_birth' => $request->place_of_birth,
		
						'bersara_date' => $request->bersara_date,
						'vac_dose' => $request->vac_dose,
						'vac_info' => $request->vac_info,
						'vac_boost' => $request->vac_boost,
						'updated_at' => $now,
				]);
			
			$now = Carbon::Now();	

		
			
			$user = User::updateOrCreate([
				'ic_no' => $request->input('ic_no'),
				
			],
			
			[
				'name' => $request->input('name_user'),
				'updated_at' => $now,
			]);
						
			$contact = Contact::updateOrCreate([
				'ic_no' => $request->input('ic_no'),
			],
			
			[
				'address' => $request->input('address'),
				'postcode' => $request->input('postcode'),
				'country_id' => $request->input('country'),
				'telephone_home' => $request->input('telephone_home'),
				'telephone_mobile' => $request->input('telephone_mobile'),
				'telephone_office' => $request->input('telephone_office'),
				'personal_email' => $request->input('personal_email'),
				'name_ec' => $request->input('name_ec'),
				'tel_ec' => $request->input('tel_ec'),
				'rs_ec' => $request->input('rs_ec'),
				'updated_at' => $now,
			]);

			
			if($request->file != ''){

				$education1 = Education::select(['emp_education_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $request->input('ic_no'))
							->value('file');

				Storage::disk('public')->delete($education1);
			
				$education = Education::updateOrCreate([
					'ic_no' => $request->input('ic_no'),
				],
				
				[
					'education_id' => $request->input('education_id'),
					'education_name' => $request->input('education_name'),
					'graduation_date' => $request->input('graduation_date'),
					'file_name' => $request->file->getClientOriginalName(),
					'file' => $request->file('file')->store('education', 'public'),
					'updated_at' => $now,
				]);

				
				

			}

			else{

				$education = Education::updateOrCreate([
					'ic_no' => $request->input('ic_no'),
				],
				
				[
					'education_id' => $request->input('education_id'),
					'education_name' => $request->input('education_name'),
					'graduation_date' => $request->input('graduation_date'),
					'updated_at' => $now,
				]);


			}

				if($request->ic_file != ''){

				$file1 = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $request->input('ic_no'))
							->value('ic_file');

				Storage::disk('public')->delete($file1);

				$file = File::updateOrCreate([
					'ic_no' => $request->input('ic_no'),
				],
				
				[
					'emp_file_id' => $request->input('emp_file_id'),
					'ic_filename' => $request->ic_file->getClientOriginalName(),
					'ic_file' => $request->file('ic_file')->store('ic', 'public'),
					'updated_at' => $now,
				]);

			}
			else{

				$file = File::updateOrCreate([
					'ic_no' => $request->input('ic_no'),
				],
				
				[
					'emp_file_id' => $request->input('emp_file_id'),
					'updated_at' => $now,
				]);


			}

			if($request->drivelicense_file != ''){

				$file2 = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $request->input('ic_no'))
							->value('drivelicense_file');

				Storage::disk('public')->delete($file2);

				$file = File::updateOrCreate([
					'ic_no' => $request->input('ic_no'),
				],
				
				[
					'emp_file_id' => $request->input('emp_file_id'),
					'drivelicense_filename' => $request->drivelicense_file->getClientOriginalName(),
					'drivelicense_file' => $request->file('drivelicense_file')->store('drivelicense', 'public'),
					'updated_at' => $now,
				]);

			}
			else{

				$file = File::updateOrCreate([
					'ic_no' => $request->input('ic_no'),
				],
				
				[
					'emp_file_id' => $request->input('emp_file_id'),
					'updated_at' => $now,
				]);


			}

			if($request->apptletter_file != ''){

				$file3 = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $request->input('ic_no'))
							->value('apptletter_file');

				Storage::disk('public')->delete($file3);

				$file = File::updateOrCreate([
					'ic_no' => $request->input('ic_no'),
				],
				
				[
					'emp_file_id' => $request->input('emp_file_id'),
					'apptletter_filename' => $request->apptletter_file->getClientOriginalName(),
					'apptletter_file' => $request->file('apptletter_file')->store('apptletter', 'public'),
					'updated_at' => $now,
				]);

			}
			else{

				$file = File::updateOrCreate([
					'ic_no' => $request->input('ic_no'),
				],
				
				[
					'emp_file_id' => $request->input('emp_file_id'),
					'updated_at' => $now,
				]);


			}

			if($request->workreport_file != ''){

				$file4 = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $request->input('ic_no'))
							->value('workreport_file');

				Storage::disk('public')->delete($file4);
			
				$file = File::updateOrCreate([
					'ic_no' => $request->input('ic_no'),
				],
				
				[
					'emp_file_id' => $request->input('emp_file_id'),
					'workreport_filename' => $request->workreport_file->getClientOriginalName(),
					'workreport_file' => $request->file('workreport_file')->store('workreport', 'public'),
					'updated_at' => $now,
				]);

			}
			else{

				$file = File::updateOrCreate([
					'ic_no' => $request->input('ic_no'),
				],
				
				[
					'emp_file_id' => $request->input('emp_file_id'),
					'updated_at' => $now,
				]);


			}

			if($request->passport_file != ''){

				$file5 = File::select(['emp_file_infos.*',\DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
							->where('ic_no', $request->input('ic_no'))
							->value('passport_file');

				Storage::disk('public')->delete($file5);
			
				$file = File::updateOrCreate([
					'ic_no' => $request->input('ic_no'),
				],
				
				[
					'emp_file_id' => $request->input('emp_file_id'),
					'passport_filename' => $request->passport_file->getClientOriginalName(),
					'passport_file' => $request->file('passport_file')->store('passport', 'public'),
					'updated_at' => $now,
				]);

			}
			else{

				$file = File::updateOrCreate([
					'ic_no' => $request->input('ic_no'),
				],
				
				[
					'emp_file_id' => $request->input('emp_file_id'),
					'updated_at' => $now,
				]);


			}



			
			
			
			$employment = Employment::updateOrCreate([
				'ic_no' => $request->input('ic_no'),
			],
			
			[
				'ministry_id' => '1',
				// 'department_id' => $request->input('department_id'),
				'school_id' => $request->input('school_id'),
				'bahagian_id' => $request->input('bahagian_id'),
				'bahagian_other' => $request->input('bahagian_other'),
				'unit_id' => $request->unit_name,
				'unit_other' => $request->input('unit_other'),
				'district_work_id' => $request->input('district_work_id'),
				'service_begin_date' => $request->input('service_begin_date'),
				'retirement_date' => $request->input('retirement_date'),
				'role' => $request->input('role'),
				'current_designation_date' => $request->input('current_designation_date'),
				'designation_id' => $request->input('designation_id'),
				'current_designation_id' => $request->input('current_designation_id'),
				'employment_status_id' => $request->input('employment_status_id'),
				'division_id' => $request->input('division_id'),
				'salary_scale' => $request->input('salary_scale'),
				'salary' => $request->input('salary'),
				'allowance_category_id' => $request->input('allowance_category_id'),
				'skim_perguruan' => $request->input('skim_perguruan'),
				'skim_perkhidmatan_id' => $request->input('skim_perkhidmatan_id'),
				'ssm_reference_no' => $request->input('ssm_reference_no'),
				'dept_reference_no' => $request->input('dept_reference_no'),
				'updated_at' => $now,
				'cluster_id' => $request->cluster_id,
				'service_status_id' => '1',
				'personnel_file' => $request->personnel_file,
				'first_service_place' => $request->first_service_place,
				'current_service_place' => $request->current_service_place,

			]);

			//UPDATE FOR SALARY
			$salary = Salary::updateOrCreate([
				'ic_no' => $request->input('ic_no'),
			],
			
			[
				// 'salaryscale_id' => $request->salaryscale_id,
				'increment_date' => $request->increment_date,
				'division_id' => $request->division_id,
				'salary' => $request->salary,
				'allowance_category_id' => $request->allowance_category_id,
				'updated_at' => $now,
			]);
			//UPDATE FOR SALARY ends


		

	
			$userID = Auth::user()->id;
			$userEmail = Auth::user()->email;

			$usersEmail =  User::select('users.*')
            ->where('id', $user->id)
                ->update([
                    
                        'email' => $request->email,
                        'updated_at' => $now,
                ]);
		
			$icNos = Auth::user()->ic_no;
			$dateTime = Carbon::Now();
			Log::info('User ID '.$userID.' updated his/her profile. 
			Email: '.$userEmail.'. Date/time: '.$dateTime);

            return redirect()->route('biodatas.biodata.show',$icNos)
                             ->with('success_message', 'Information was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }
	

    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $data = $request->validate([
			'ic_no'	=> 'required',
			'bruhims_no' => 'nullable',
			'name_user'	=> 'nullable',
			'dob'	=> 'nullable',
			'ic_color_id'	=> 'nullable',
			'gender_id'	=> 'nullable',
			'marital_status_id'	=> 'nullable',
			'postal_address'	=> 'nullable',
			'postal_code'	=> 'nullable',
			'country_id'	=> 'nullable',
			'telephone_office'	=> 'nullable',
			'telephone_home'	=> 'nullable',
			'telephone_mobile'	=> 'nullable',
			'email'	=> 'nullable',
			'personal_email'	=> 'nullable',
			'vulnerable'	=> 'nullable',

			// Ekma Add
			'vac_info'	=> 'nullable',
			'vac_dose'	=> 'nullable',
			'vac_boost'	=> 'nullable',
			'postal_address'	=> 'nullable',
			'postal_code'	=> 'nullable',
			'country_id'	=> 'nullable',
			'telephone_office'	=> 'nullable',
			'telephone_home'	=> 'nullable',
			'telephone_mobile'	=> 'nullable',
			'email'	=> 'nullable',
			'personal_email'	=> 'nullable',
			'vulnerable'	=> 'nullable',

			'ministry_id'	=> 'nullable',
			'department_id'	=> 'nullable',
			'bahagian_id'	=> 'nullable',
			'bahagian_other'	=> 'nullable',
			'unit_id'	=> 'nullable',
			'unit_other'	=> 'nullable',
			'district_work_id'	=> 'nullable',
			'service_begin_date'	=> 'nullable',
			'retirement_date'	=> 'nullable',
			'role'	=> 'nullable',
			'current_designation_date'	=> 'nullable',
			'designation_id'	=> 'nullable',
			'current_designation_id'	=> 'nullable',
			'employment_status_id'	=> 'nullable',
			'division_id'	=> 'nullable',
			'salary_scale'	=> 'nullable',
			'salary'	=> 'nullable',
			'allowance_category_id'	=> 'nullable',
			'skim_perguruan'	=> 'nullable',
			'skim_perkhidmatan_id'	=> 'nullable',
			'ssm_reference_no'	=> 'nullable',
			'dept_reference_no'	=> 'nullable',
			'personnel_file'	=> 'nullable',
			
			'race_id'	=> 'nullable',
			'religion_id'	=> 'nullable',
			'citizenship_id'	=> 'nullable',
			'place_of_birth'	=> 'nullable',
			'education_id'	=> 'nullable',
			'education_name'	=> 'nullable',
			'graduation_date'	=> 'nullable',

			'salaryscale_id'	=> 'nullable',
			'increment_date'	=> 'nullable',
			'division_id'	=> 'nullable',
			'salary'	=> 'nullable',
			'allowance_category_id'	=> 'nullable'

			

        ]);



	
		
		//dd($data);



        return $data;
    }
 /**
     * Moves the attached file to the server.
     *
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    // protected function moveFile($file)
    // {
    //     if (!$file->isValid()) {
    //         return '';
    //     }
        
    //     $path = 'uploads';
    //     $saved = $file->store('public/' . $path, config('filesystems.default'));

    //     return substr($saved, 7);
    // }
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }
        
        $path = 'uploads';
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }

}

    