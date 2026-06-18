<?php

namespace App\Http\Controllers;

use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;


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
use App\Models\ART;
use App\Models\File;
use App\Models\SSM;
use App\Models\Bersara;


use Log;
use Carbon\Carbon;


class SSMController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


 


    public function index()
    {

        $icNos = Auth::user()->ic_no;

        $ssms = SSM::select('ssms.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['ic_no', '=', $icNos]
            ])
            ->get();

        $ssmsone = SSM::select('ssms.*')
            ->orderBy('created_at', 'DESC')
            ->where([
            ['ic_no', '=', $icNos]
            ])
            ->first();


        // $ssms = SSM::all()
        //     ->where('ic_no', '=', $icNos)


        $departments = Department::pluck('label', 'id')->all();
        return view('ssms.index', compact('ssms', 'departments','ssmsone'));
    }

    public function indexall()
    {

        $icNos = Auth::user()->ic_no;
        
        $user = User::all()
        ->where('ic_no', '=', $icNos);

        $ssms = SSM::select('ssms.*')
            ->orderBy('created_at', 'DESC')
            ->get();

    
        // $ssms= SSM::leftJoin('emp_file_infos','emp_file_infos.ic_no', '=', 'ssms.ic_no'  )
        //     ->select('ssms.*', 'emp_file_infos.ic_file', 'emp_file_infos.apptletter_file','emp_file_infos.workreport_file','emp_file_infos.passport_file')
        //     ->orderBy('ssms.created_at', 'DESC')
        //     ->get();

        $ssms= SSM::select('ssms.*')
            ->orderBy('ssms.created_at', 'DESC')
            ->get();

        return view('ssms.indexall', compact('ssms','icNos','user'));
    }


    /**
     * Display a listing of the Biodata applications.
     *
     * @return Illuminate\View\View
     */

    public function edituser($encryptedId){
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

            

        return view('ssms.edituser', compact('biodata', 'school', 'salarys', 'biodatas', 'contacts', 'employments', 'educations', 'performances', 'medals', 'certificates', 'exams', 'programmes', 'paperworks', 'courses', 'files', 'ssms', 'bersaras', 'genders'));

    }

    public function editoneuser($id){
        $icNos = Auth::user()->ic_no;


        $ssms = SSM::all()->where('id', '=', $id)->first();

        $icNos = $ssms->ic_no;

        $biodata = Biodata::select('biodatas.*')
            ->where('ic_no', $icNos)
            ->first();

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);
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

        $files = File::all()
            ->where('ic_no', '=', $icNos);

        $bersaras = Bersara::all()
            ->where('ic_no', '=', $icNos);

    
        $school = Employment::leftjoin('departments', 'emp_employment_infos.school_id', '=', 'departments.code')
            ->select('departments.label as school_name')
            ->where('emp_employment_infos.ic_no', $icNos)
            ->first();

            
        $genders = Gender::pluck('label', 'id')->all();

            

        return view('ssms.editoneuser', compact('biodata', 'school', 'salarys', 'biodatas', 'contacts', 'employments', 'educations', 'performances', 'medals', 'certificates', 'exams', 'programmes', 'paperworks', 'courses', 'files', 'ssms', 'bersaras', 'genders'));

        


    }

    public function editadmin($id)
    {
        $icNos = Auth::user()->ic_no;


        $ssms = SSM::all()->where('id', '=', $id)->first();

        $icNos = $ssms->ic_no;

        $biodata = Biodata::select('biodatas.*')
            ->where('ic_no', $icNos)
            ->first();

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);
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

        $files = File::all()
            ->where('ic_no', '=', $icNos);

        // $ssms = SSM::all()
        //     ->where('ic_no', '=', $icNos);

        $bersaras = Bersara::all()
            ->where('ic_no', '=', $icNos);

    
        $school = Employment::leftjoin('departments', 'emp_employment_infos.school_id', '=', 'departments.code')
            ->select('departments.label as school_name')
            ->where('emp_employment_infos.ic_no', $icNos)
            ->first();

            

            

        return view('ssms.editadmin', compact('biodata', 'school', 'salarys', 'biodatas', 'contacts', 'employments', 'educations', 'performances', 'medals', 'certificates', 'exams', 'programmes', 'paperworks', 'courses', 'files', 'ssms', 'bersaras'));

        


    }
    


    public function show()
    {
        $icNos = Auth::user()->ic_no;

        $biodata = Biodata::select('biodatas.*')
            ->where('ic_no', $icNos)
            ->first();

        $bersara_date = \Carbon\Carbon::parse($biodata->dob)->addYears(60);

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);
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

        $ssms = SSM::all()
            ->where('ic_no', '=', $icNos);

        $files = File::all()
            ->where('ic_no', '=', $icNos);

        $school = Employment::leftjoin('departments', 'emp_employment_infos.school_id', '=', 'departments.code')
            ->select('departments.label as school_name')
            ->where('emp_employment_infos.ic_no', $icNos)
            ->first();

        return view('ssms.show', compact('biodata', 'school', 'salarys', 'biodatas', 'contacts', 'employments', 'educations', 'performances', 'medals', 'certificates', 'exams', 'programmes', 'paperworks', 'courses', 'ssms', 'files'));
    }


    public function create()
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



        return view('ssms.create', compact(
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
            $rules['apptletter_filenew'] = 'required|file';
        }
        
        if (!$existingPassportFile) {
            $rules['passport_filenew'] = 'required|file';
        }
        
        if (!$existingICFile) {
            $rules['ic_filenew'] = 'required|file';
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
        }else{
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

            if ($request->workreport_filenew != '') {

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

    public function updateuser(Request $request)
    {

        $icNos = Auth::user()->ic_no;

        $telMobile = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $icNos)
            ->value('telephone_mobile');

        try {
            $now = Carbon::now();

            // ----------------------------------------------------------------
            // Commented on 291024.
            // ----------------------------------------------------------------
            // Why update data when input fields are disabled?
            // ----------------------------------------------------------------

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

            $now = Carbon::now();

            // ----------------------------------------------------------------
            // Commented on 291024.
            // ----------------------------------------------------------------
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

            // ----------------------------------------------------------------
            // Commented on 291024.
            // ----------------------------------------------------------------
            // $employment = Employment::updateOrCreate(
            //     [
            //         'ic_no' => $request->input('ic_no'),
            //     ],

            //     [
            //         'current_designation_date' => $request->input('current_designation_date'),
            //         'current_designation_id' => $request->input('current_designation_id'),
            //         'current_service_place' => $request->current_service_place,

            //     ]
            // );
        

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

        return redirect()->route('ssms.ssm.index')
            ->with('success_message', 'SSM Application successfully submited!');
    }

        public function updateadmin(Request $request)
    {

        $now = Carbon::now();


        $ssm =  SSM::select('ssms.*')
            ->where('id', $request->id)
            ->update([

                'status_ssm' => $request->status_ssm,
                 'tindakan_ssm' => $request->tindakan_ssm,
                'position_id' => $request->position_id,
                'password' => $request->password,
                'updated_at' => $now
            ]);

            $ssmstats = SSM::select('ssms.*') 
                ->where('id', $request->id)
                ->first();

            // $status_ssm = 'fasa1';

            if ($ssmstats->status_ssm == 'Fasa 1 SSM tidak termasuk perkhidmatan Gaji Hari') {


                $ssms = SSM::all()->where('id', '=', $request->id)->first();

                $icNos = $ssms->ic_no;

                $telMobile = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
                    ->where('ic_no', $icNos)
                    ->value('telephone_mobile');

                // Whatsapp API Start
                $data = [
                    'phone' => "+673". $telMobile, // Receivers phone if country code is not included
                    'template' => 'ssm_gh', // Template name
                    'namespace' => '2e93a5e8_dc0a_4951_9777_f6b7dadf7db8', // Namespace of template
                    'language' =>  ['code' => 'ms', 'policy' => 'deterministic'], // Language parameters
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

                if ($ssmstats->status_ssm == 'Selesai') {


                $ssms = SSM::all()->where('id', '=', $request->id)->first();

                $icNos = $ssms->ic_no;

                $telMobile = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
                    ->where('ic_no', $icNos)
                    ->value('telephone_mobile');

                // Whatsapp API Start
                $data = [
                    'phone' => "+673". $telMobile, // Receivers phone if country code is not included
                    'template' => 'ssm_selesai', // Template name
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
            }
          }

        return redirect()->route('ssms.ssm.indexall')
            ->with('success_message', 'SSM record was successfully updated!');
    }




    public function showadmin($id)
    {

        $ssm = SSM::all()->where('id', '=', $id)->first();

        $icNos = $ssm->ic_no;


        $ssms = SSM::all()
            ->where('ic_no', '=', $icNos);

        $biodata = Biodata::select('biodatas.*')
            ->where('ic_no', $icNos)
            ->first();

        $biodatas = Biodata::all()
            ->where('ic_no', '=', $icNos);
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

        $files = File::all()
            ->where('ic_no', '=', $icNos);




        $school = Employment::leftjoin('departments', 'emp_employment_infos.school_id', '=', 'departments.code')
            ->select('departments.label as school_name')
            ->where('emp_employment_infos.ic_no', $icNos)
            ->first();

        return view('ssms.showadmin', compact('biodata', 'school', 'salarys', 'biodatas', 'contacts', 'employments', 'educations', 'performances', 'medals', 'certificates', 'exams', 'programmes', 'paperworks', 'courses', 'files', 'ssm', 'ssms'));
    }




    public function destroy($id)
    {
        try {

            $ssm = SSM::where('id', $id)->delete();

            return redirect()->route('ssms.ssm.indexall')
                ->with('success_message', 'SSM was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }
}
