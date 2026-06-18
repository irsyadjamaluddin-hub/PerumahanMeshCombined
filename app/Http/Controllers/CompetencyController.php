<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


use DB;

use App\Models\Employment;
use App\Models\Department;
use App\Models\Biodata;
use App\Models\CompetencyInfo;
use App\Models\CompetencyFile;
use App\Models\CompetencyDomain;
use App\Models\DaDomain;
use App\Models\JpsDomain;
use App\Models\Compfm;
use App\Models\Compfsm;
use App\Models\Compfin;
use App\Models\Comphrd;
use App\Models\Complm;
use App\Models\Compmaw;
use App\Models\Compot;
use App\Models\Compr;
use App\Models\Comptk;
// Start here specialised comptencie
use App\Models\CompDaHrd;
use App\Models\CompDaOt;
use App\Models\CompDaHrm;
use App\Models\CompDaFinMaw;
use App\Models\CompDaFsm;
use App\Models\CompDaResearch;
use App\Models\CompDaFinam;
use App\Models\CompDaHse;
use App\Models\CompDaFinHse;
use App\Models\CompDaHseak;
use App\Models\CompDaFinak;
use App\Models\CompDaTrans;

use App\Models\JPKhasDomain;
use App\Models\CompJpkhasSecc;
use App\Models\CompJpkhasSefc;
use App\Models\CompJpkhasQa;

use App\Models\CcdDomain;
use App\Models\CompCcdPr;

use App\Models\DictDomain;
use App\Models\CompDictItin;
use App\Models\CompDictItsm;
use App\Models\CompDictIto;
use App\Models\CompDictIts;

use App\Models\MkpkDomain;
use App\Models\CompMkpkQa;
use App\Models\CompMkpkCsm;
use App\Models\CompMkpkDm;
use App\Models\CompMkpkHr;
use App\Models\CompMkpkAs;

use App\Models\JppeDomain;
use App\Models\CompJppeE;
use App\Models\CompJppeEm;
use App\Models\CompJppeFmmaw;
use App\Models\CompJppeHrda;

use App\Models\Contact;

use App\Models\Salary;

use Carbon\Carbon;

use Illuminate\Http\Request;

class CompetencyController extends Controller
{

    public function HRDViewIndividual($id)
    {

        $competencies = CompetencyInfo::all()->where('id', '=', $id);

        $competencies1 = CompetencyInfo::all()
            ->where('id', '=', $id)
            ->first();

        $employments = Employment::all()->where(
            'ic_no',
            '=',
            $competencies1->indv_icno
        );

        $dadomains = DaDomain::pluck('label', 'id')->all();
        
        $competencyfiles = CompetencyFile::select('competency_files.*')
        ->where([['competency_infos_id', '=', $id]])
        ->get();
       
        // Start DA Specialised Competencie
        // Start Specialised Competencie
        $compdahrds = CompDaHrd::select('comp_da_hrd.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdaots = CompDaOt::select('comp_da_ot.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahrms = CompDaHrm::select('comp_da_hrm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinmaws = CompDaFinMaw::select('comp_da_finmaw.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafsms = CompDaFsm::select('comp_da_fsm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdaresearchs = CompDaResearch::select('comp_da_research.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinams = CompDaFinam::select('comp_da_finam.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahses = CompDaHse::select('comp_da_hse.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinhses = CompDaFinHse::select('comp_da_finhse.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahseaks = CompDaHseak::select('comp_da_hseak.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinaks = CompDaFinak::select('comp_da_finak.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdatranss = CompDaTrans::select('comp_da_trans.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

            
        return view(
            'competency.HRDViewIndividual',
            compact(
                'competencies',
                'employments',
                'dadomains',
                'competencyfiles',
                'compdahrds',
                'compdaots',
                'compdahrms',
                'compdafinmaws',
                'compdafsms',
                'compdaresearchs',
                'compdafinams',
                'compdahses',
                'compdafinhses',
                'compdahseaks',
                'compdafinaks',
                'compdatranss'
            )
        );
    }    

    public function HRDListCompetency()
    {
        if (Auth::user()->hasRole('ROLE_SUPERADMIN')){
            $competencies = CompetencyInfo::select('competency_infos.*')
                ->orderBy('created_at', 'DESC')
                ->get();

            // $competenciesdomain = CompetencyDomain::pluck('label', 'id')->all();
            return view('competency.HRDListCompetency', compact('competencies'));
        }
    }    

    public function HRDDashboard()
    {
        if (Auth::user()->hasRole('ROLE_SUPERADMIN')){
            $competencies = CompetencyInfo::select('competency_infos.*')
                ->orderBy('created_at', 'DESC')
                ->get();

                $countTotalDA = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
                ->where([['department_id', '8']])->count();        
                $countTotalJPKhas = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
                ->where([['department_id', '19']])->count();        
                $countTotalCCD = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
                ->where([['department_id', '20']])->count();        
                $countTotalDICT = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
                ->where([['department_id', '12']])->count();        
                $countTotalMKPK = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
                ->where([['department_id', '25']])->count();        
                $countTotalJPPE = department::leftJoin('emp_employment_infos', 'departments.id', '=', 'emp_employment_infos.department_id')
                ->where([['department_id', '10']])->count();        

                $countDA = CompetencyInfo::where('indv_dept', 'Jabatan Pentadbiran dan Perkhidmatan-Perkhidmatan')->count();
                $countJPKhas = CompetencyInfo::where('indv_dept', 'Jabatan Pendidikan Khas')->count();
                $countCCD = CompetencyInfo::where('indv_dept', 'Bahagian Komunikasi Korporat')->count();                
                $countDICT = CompetencyInfo::where('indv_dept', 'Jabatan Teknologi Maklumat dan Komunikasi')->count();
                $countMKPK = CompetencyInfo::where('indv_dept', 'Majlis Kebangsaan Pengiktirafan Kelulusan (MKPK)')->count();
                $countJPPE = CompetencyInfo::where('indv_dept', 'Jabatan Perancangan dan Pengurusan Estet')->count();

            return view('competency.HRDDashboard', compact('competencies', 'countDA', 'countJPKhas', 'countCCD', 'countDICT', 'countMKPK', 'countJPPE',
                        'countTotalDA','countTotalJPKhas','countTotalCCD','countTotalDICT','countTotalMKPK','countTotalJPPE'));
        }
    }


    public function individualchart($id)
    {
        $competencies = CompetencyInfo::all()->where('id', '=', $id);

        $competencies1 = CompetencyInfo::all()
            ->where('id', '=', $id)
            ->first();

        $employments = Employment::all()
            ->where('ic_no', '=', $competencies1->indv_icno);

        $dadomains = DaDomain::pluck('label', 'id')->all();
        $jpkhasdomains = JPKhasDomain::pluck('label', 'id')->all();
        $ccddomains = CcdDomain::pluck('label', 'id')->all();        
        $dictdomains = DictDomain::pluck('label', 'id')->all();        
        $mkpkdomains = MkpkDomain::pluck('label', 'id')->all();        
        $jppedomains = JppeDomain::pluck('label', 'id')->all();        

        $competencyfiles = CompetencyFile::select('competency_files.*')
        ->where([['competency_infos_id', '=', $id]])
        ->get();
       
        // Start DA Specialised Competencie
        // Start Specialised Competencie
        $compdahrds = CompDaHrd::select('comp_da_hrd.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdaots = CompDaOt::select('comp_da_ot.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahrms = CompDaHrm::select('comp_da_hrm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinmaws = CompDaFinMaw::select('comp_da_finmaw.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafsms = CompDaFsm::select('comp_da_fsm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdaresearchs = CompDaResearch::select('comp_da_research.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinams = CompDaFinam::select('comp_da_finam.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahses = CompDaHse::select('comp_da_hse.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinhses = CompDaFinHse::select('comp_da_finhse.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahseaks = CompDaHseak::select('comp_da_hseak.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinaks = CompDaFinak::select('comp_da_finak.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdatranss = CompDaTrans::select('comp_da_trans.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();


//Start JPKhas Specialised Competencies
        $compjpkhasseccs = CompJpkhasSecc::select('comp_jpkhas_secc.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();        

        $compjpkhassefcs = CompJpkhasSefc::select('comp_jpkhas_sefc.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();
            
        $compjpkhasqas = CompJpkhasQa::select('comp_jpkhas_qa.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();                

//Start CCD Specialised Competencies
        $compccdprs = CompCcdPr::select('comp_ccd_pr.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

//Start DICT Specialised Competencies
        $compdictitins = CompDictItin::select('comp_dict_itin.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdictitsms = CompDictItsm::select('comp_dict_itsm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();
            
        $compdictitos = CompDictIto::select('comp_dict_ito.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();
            
        $compdictitss = CompDictIts::select('comp_dict_its.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();            
            
//Start MKPK Specialised Competencies
        $compmkpkqas = CompMkpkQa::select('comp_mkpk_qa.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compmkpkcsms = CompMkpkCsm::select('comp_mkpk_csm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compmkpkdms = CompMkpkDm::select('comp_mkpk_dm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();
            
        $compmkpkhrs = CompMkpkHr::select('comp_mkpk_hr.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();
            
        $compmkpkass = CompMkpkAs::select('comp_mkpk_as.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();            

//Start JPPE Specialised Competencies
        $compjppees = CompJppeE::select('comp_jppe_e.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppeems = CompJppeEm::select('comp_jppe_em.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppefmmaws = CompJppeFmmaw::select('comp_jppe_fmmaw.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppehrdas = CompJppeHrda::select('comp_jppe_hrda.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        return view(
            'competency.individualchart',
            compact(
                'competencies',
                'employments',
                'dadomains',
                'jpkhasdomains',
                'ccddomains',
                'dictdomains',
                'mkpkdomains',
                'jppedomains',
                'competencyfiles',
                
                'compdahrds',
                'compdaots',
                'compdahrms',
                'compdafinmaws',
                'compdafsms',
                'compdaresearchs',
                'compdafinams',
                'compdahses',
                'compdafinhses',
                'compdahseaks',
                'compdafinaks',
                'compdatranss',

                'compjpkhasseccs','compjpkhassefcs','compjpkhasqas',

                'compccdprs',

                'compdictitins','compdictitsms','compdictitos','compdictitss',

                'compmkpkqas','compmkpkcsms','compmkpkdms','compmkpkhrs','compmkpkass',

                'compjppees','compjppeems','compjppefmmaws','compjppehrdas'
            )
        );
    }

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function indexcompetency()
    {
        $icNos = Auth::user()->ic_no;

        $competencies = CompetencyInfo::select('competency_infos.*')
            ->where('indv_icno', $icNos)
            ->orderBy('created_at', 'DESC')
            ->get();

        // supervisor Filter
        $competencies1 = CompetencyInfo::select('competency_infos.*')
            ->where('supv_icno', $icNos)
            ->orderBy('created_at', 'DESC')
            ->get();

        // Collabrator Filter

        $competencies2 = CompetencyInfo::select('competency_infos.*')
            ->where('collab_icno', $icNos)
            ->orderBy('created_at', 'DESC')
            ->get();

        // $competenciesdomain = CompetencyDomain::pluck('label', 'id')->all();

        return view(
            'competency.indexcompetency',
            compact('competencies', 'competencies1', 'competencies2')
        );
    }

    public function indexsupervisorcompetency()
    {
        // $competencies = CompetencyInfo::select('competency_infos.*')->orderBy('created_at', 'DESC')->get();

        $icNos = Auth::user()->ic_no;

        $competencies1 = CompetencyInfo::select('competency_infos.*')
            ->where('supv_icno', $icNos)
            ->orderBy('created_at', 'DESC')
            ->get();

        // $competenciesdomain = CompetencyDomain::pluck('label', 'id')->all();

        return view(
            'competency.indexsupervisorcompetency',
            compact('competencies1')
        );
    }

    public function indexadmincompetency()
    {

        if (Auth::user()->hasRole('ROLE_SUPERADMIN')){

        $competencies = CompetencyInfo::select('competency_infos.*')
            ->orderBy('created_at', 'DESC')
            ->get();

        // $competenciesdomain = CompetencyDomain::pluck('label', 'id')->all();

        return view('competency.indexadmincompetency', compact('competencies'));
    }

    if (Auth::user()->hasRole('ROLE_FOCALADMIN_COMPETENCY')){

        $icNos = Auth::user()->ic_no;

        $employments = Employment::select('emp_employment_infos.*')
                    ->where('ic_no', '=', $icNos)->first();

        $dept = $employments->department_id;

        $competencies= CompetencyInfo::leftJoin('biodatas', 'competency_infos.indv_icno', '=', 'biodatas.ic_no' )
        ->select('competency_infos.*', 'biodatas.name')
        ->orderBy('created_at', 'DESC')
        ->where('indv_dept_id', '=', $dept)
        ->get();

    
        return view('competency.indexadmincompetency', compact('competencies'));
    }
}








    public function admincompetencystore(Request $request)
    {
        $request->validate([
            'indv_name' => 'required',
            'indv_icno' => 'required',
           
        ]);

        $icNos = Auth::user()->ic_no;

        $competencie = new CompetencyInfo();
        $competencie->indv_name = $request->indv_name;
        $competencie->indv_icno = $request->indv_icno;
        $competencie->indv_dept = $request->indv_dept;
        $competencie->indv_dept_id = $request->indv_dept_id;
        $competencie->indv_post = $request->indv_post;
        $competencie->indv_div = $request->indv_div;
        $competencie->date = $request->date;
        $competencie->sd_st_rcl = $request->sd_st_rcl;
        $competencie->sd_ca_rcl = $request->sd_ca_rcl;
        $competencie->sd_po_rcl = $request->sd_po_rcl;
        $competencie->pe_cc_rcl = $request->pe_cc_rcl;
        $competencie->pe_lo_rcl = $request->pe_lo_rcl;
        $competencie->pe_tw_rcl = $request->pe_tw_rcl;
        $competencie->pc_dps_rcl = $request->pc_dps_rcl;
        $competencie->pc_df_rcl = $request->pc_df_rcl;
        $competencie->pc_per_rcl = $request->pc_per_rcl;
        $competencie->oc_pmtd_rcl = $request->oc_pmtd_rcl;
        $competencie->oc_cg_rcl = $request->oc_cg_rcl;
        $competencie->oc_qdcf_rcl = $request->oc_qdcf_rcl;
        $competencie->dadomain = json_encode($request->dadomain);
        $competencie->jpkhasdomain = json_encode($request->jpkhasdomain);
        $competencie->ccddomain = json_encode($request->ccddomain);
        $competencie->dictdomain = json_encode($request->dictdomain);
        $competencie->mkpkdomain = json_encode($request->mkpkdomain);
        $competencie->jppedomain = json_encode($request->jppedomain);

        $competencie->created_by_icno = $icNos;

        // Save 'competencies_infos' data
        $competencie->save();

        $data1 = CompetencyInfo::select('competency_infos.*')
            ->orderBy('created_at', 'DESC')
            ->first();

        $data2 = $data1->id;


        // START HERE SPECIALSIED STORE DATA!
        // Store comp_da_hrd
        foreach ($request->moreFields as $key => $value) {
            CompDaHrd::create($value);
        }

        $data3 = CompDaHrd::select('comp_da_hrd.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // store comp_da_ot data
        foreach ($request->moreFields as $key => $value) {
            CompDaOt::create($value);
        }

        $data4 = CompDaOt::select('comp_da_ot.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // Store comp_da_hrm data
        foreach ($request->moreFields as $key => $value) {
            CompDaHrm::create($value);
        }

        $data5 = CompDaHrm::select('comp_da_hrm.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // Store comp_da_finmaw data
        foreach ($request->moreFields as $key => $value) {
            CompDaFinMaw::create($value);
        }

        $data6 = CompDaFinMaw::select('comp_da_finmaw.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // Store comp_da_fsm data
        foreach ($request->moreFields as $key => $value) {
            CompDaFsm::create($value);
        }

        $data7 = CompDaFsm::select('comp_da_fsm.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // Store comp_da_research data
        foreach ($request->moreFields as $key => $value) {
            CompDaResearch::create($value);
        }

        $data8 = CompDaResearch::select('comp_da_research.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // Store comp_da_finam data
        foreach ($request->moreFields as $key => $value) {
            CompDaFinam::create($value);
        }

        $data9 = CompDaFinam::select('comp_da_finam.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // Store comp_da_hse data
        foreach ($request->moreFields as $key => $value) {
            CompDaHse::create($value);
        }

        $data10 = CompDaHse::select('comp_da_hse.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // Store comp_da_finhse data
        foreach ($request->moreFields as $key => $value) {
            CompDaFinHse::create($value);
        }

        $data11 = CompDaFinHse::select('comp_da_finhse.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // Store comp_da_hseak
        foreach ($request->moreFields as $key => $value) {
            CompDaHseak::create($value);
        }

        $data12 = CompDaHseak::select('comp_da_hseak.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // store comp_da_finak
        foreach ($request->moreFields as $key => $value) {
            CompDaFinak::create($value);
        }

        $data13 = CompDaFinak::select('comp_da_finak.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // store comp_da_trans
        foreach ($request->moreFields as $key => $value) {
            CompDaTrans::create($value);
        }

        $data14 = CompDaTrans::select('comp_da_trans.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

//JPKHAS

        // store comp_jpkhas_secc
        foreach ($request->moreFields as $key => $value) {
            CompJpkhasSecc::create($value);
        }        
        $data15 = CompJpkhasSecc::select('comp_jpkhas_secc.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // store comp_jpkhas_sefc
        foreach ($request->moreFields as $key => $value) {
            CompJpkhasSefc::create($value);
        }        
        $data16 = CompJpkhasSefc::select('comp_jpkhas_sefc.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);
            
        // store comp_jpkhas_qa
        foreach ($request->moreFields as $key => $value) {
            CompJpkhasQa::create($value);
        }        
        $data17 = CompJpkhasQa::select('comp_jpkhas_qa.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);            

//CCD            
        // store comp_ccd_pr
        foreach ($request->moreFields as $key => $value) {
            CompCcdPr::create($value);
        }        
        $data18 = CompCcdPr::select('comp_ccd_pr.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);     

//DICT           
        // store comp_dict_itin
        foreach ($request->moreFields as $key => $value) {
            CompDictItin::create($value);
        }        
        $data19 = CompDictItin::select('comp_dict_itin.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // store comp_dict_itsm
        foreach ($request->moreFields as $key => $value) {
            CompDictItsm::create($value);
        }        
        $data20 = CompDictItsm::select('comp_dict_itsm.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // store comp_dict_ito
        foreach ($request->moreFields as $key => $value) {
            CompDictIto::create($value);
        }        
        $data21 = CompDictIto::select('comp_dict_ito.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // store comp_dict_its
        foreach ($request->moreFields as $key => $value) {
            CompDictIts::create($value);
        }        
        $data22 = CompDictIts::select('comp_dict_its.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

//MKPK
        // store comp_mkpk_qa
        foreach ($request->moreFields as $key => $value) {
            CompMkpkQa::create($value);
        }        
        $data23 = CompMkpkQa::select('comp_mkpk_qa.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // store comp_mkpk_csm
        foreach ($request->moreFields as $key => $value) {
            CompMkpkCsm::create($value);
        }        
        $data24 = CompMkpkCsm::select('comp_mkpk_csm.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // store comp_mkpk_dm
        foreach ($request->moreFields as $key => $value) {
            CompMkpkDm::create($value);
        }        
        $data25 = CompMkpkDm::select('comp_mkpk_dm.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

        // store comp_mkpk_hr
        foreach ($request->moreFields as $key => $value) {
            CompMkpkHr::create($value);
        }        
        $data26 = CompMkpkHr::select('comp_mkpk_hr.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);            

        // store comp_mkpk_as
        foreach ($request->moreFields as $key => $value) {
            CompMkpkAs::create($value);
        }        
        $data27 = CompMkpkAs::select('comp_mkpk_as.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);

//JPPE
        // store comp_jppe_e
        foreach ($request->moreFields as $key => $value) {
            CompJppeE::create($value);
        }        
        $data28 = CompJppeE::select('comp_jppe_e.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);            

        // store comp_jppe_em
        foreach ($request->moreFields as $key => $value) {
            CompJppeEm::create($value);
        }        
        $data29 = CompJppeEm::select('comp_jppe_em.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);            

        // store comp_jppe_fmmaw
        foreach ($request->moreFields as $key => $value) {
            CompJppeFmmaw::create($value);
        }        
        $data30 = CompJppeFmmaw::select('comp_jppe_fmmaw.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);            

        // store comp_jppe_hrda
        foreach ($request->moreFields as $key => $value) {
            CompJppeHrda::create($value);
        }        
        $data31 = CompJppeHrda::select('comp_jppe_hrda.*')
            ->where('competency_info_id', null)
            ->update([
                'competency_info_id' => $data2,
            ]);            


        return redirect()
            ->route('competency.competency.indexadmincompetency')
            ->with(
                'success_message',
                'New Competency record was successfully added!'
            );
    }

    public function collabratorcompetencystore(Request $request)
    {
        $request->validate([]);

        $compentencies = CompetencyInfo::select('competency_infos.*')
            ->where('id', $request->id)
            ->update([
                'collab_name' => $request->collab_name,
                'collab_icno' => $request->collab_icno,
            ]);

        return redirect()
            ->route('competency.competency.indexcompetency')
            ->with(
                'success_message',
                'Collabrator record was successfully added!'
            );
    }

    public function editadmincompetency($id)
    {
        $competencies = CompetencyInfo::all()->where('id', '=', $id);

        $competencies1 = CompetencyInfo::all()
            ->where('id', '=', $id)
            ->first();

        $employments = Employment::all()->where(
            'ic_no',
            '=',
            $competencies1->indv_icno
        );

        $dadomains = DaDomain::pluck('label', 'id')->all();
        $jpkhasdomains = JPKhasDomain::pluck('label', 'id')->all();
        $ccddomains = CcdDomain::pluck('label', 'id')->all();
        $dictdomains = DictDomain::pluck('label', 'id')->all();
        $mkpkdomains = MkpkDomain::pluck('label', 'id')->all();        
        $jppedomains = JppeDomain::pluck('label', 'id')->all();        

       
        // Start Specialised Competencie

        $compdahrds = CompDaHrd::select('comp_da_hrd.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdaots = CompDaOt::select('comp_da_ot.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahrms = CompDaHrm::select('comp_da_hrm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinmaws = CompDaFinMaw::select('comp_da_finmaw.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafsms = CompDaFsm::select('comp_da_fsm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdaresearchs = CompDaResearch::select('comp_da_research.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinams = CompDaFinam::select('comp_da_finam.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahses = CompDaHse::select('comp_da_hse.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinhses = CompDaFinHse::select('comp_da_finhse.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahseaks = CompDaHseak::select('comp_da_hseak.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinaks = CompDaFinak::select('comp_da_finak.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdatranss = CompDaTrans::select('comp_da_trans.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        // End Da Specialised Competencie

//Start JPKhas Specialised Competencies
        $compjpkhasseccs = CompJpkhasSecc::select('comp_jpkhas_secc.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjpkhassefcs = CompJpkhasSefc::select('comp_jpkhas_sefc.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();
            
        $compjpkhasqas = CompJpkhasQa::select('comp_jpkhas_qa.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

//Start CCD Specialised Competencies
        $compccdprs = CompCcdPr::select('comp_ccd_pr.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

//Start DICT Specialised Competencies
        $compdictitins = CompDictItin::select('comp_dict_itin.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compdictitsms = CompDictItsm::select('comp_dict_itsm.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();
        
        $compdictitos = CompDictIto::select('comp_dict_ito.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();
        
        $compdictitss = CompDictIts::select('comp_dict_its.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();        

//Start MKPK Specialised Competencies
        $compmkpkqas = CompMkpkQa::select('comp_mkpk_qa.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compmkpkcsms = CompMkpkCsm::select('comp_mkpk_csm.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compmkpkdms = CompMkpkDm::select('comp_mkpk_dm.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compmkpkhrs = CompMkpkHr::select('comp_mkpk_hr.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compmkpkass = CompMkpkAs::select('comp_mkpk_as.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

//Start JPPE Specialised Competencies
        $compjppees = CompJppeE::select('comp_jppe_e.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppeems = CompJppeEm::select('comp_jppe_em.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppefmmaws = CompJppeFmmaw::select('comp_jppe_fmmaw.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppehrdas = CompJppeHrda::select('comp_jppe_hrda.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();


        return view(
            'competency.editadmincompetency',
            compact(
                'competencies',
                'employments',
                'dadomains','jpkhasdomains','ccddomains','dictdomains','mkpkdomains','jppedomains',

                'compdahrds',
                'compdaots',
                'compdahrms',
                'compdafinmaws',
                'compdafsms',
                'compdaresearchs',
                'compdafinams',
                'compdahses',
                'compdafinhses',
                'compdahseaks',
                'compdafinaks',
                'compdatranss',

                'compjpkhasseccs',
                'compjpkhassefcs',
                'compjpkhasqas',

                'compccdprs',

                'compdictitins',
                'compdictitsms',
                'compdictitos',
                'compdictitss',

                'compmkpkqas',
                'compmkpkcsms',
                'compmkpkdms',
                'compmkpkhrs',
                'compmkpkass',

                'compjppees','compjppeems','compjppefmmaws','compjppehrdas'                
            )
        );
    }

    public function editsupervisorcompetency($id)
    {

        $competencies = CompetencyInfo::all()->where('id', '=', $id);

        $competencies1 = CompetencyInfo::all()
            ->where('id', '=', $id)
            ->first();

        $employments = Employment::all()->where(
            'ic_no',
            '=',
            $competencies1->indv_icno
        );

        $dadomains = DaDomain::pluck('label', 'id')->all();
        $jpkhasdomains = JPKhasDomain::pluck('label', 'id')->all();
        $ccddomains = CcdDomain::pluck('label', 'id')->all();
        $dictdomains = DictDomain::pluck('label', 'id')->all();
        $mkpkdomains = MkpkDomain::pluck('label', 'id')->all();
        $jppedomains = JppeDomain::pluck('label', 'id')->all();          

        // Start DA Specialised Competencie
        // Start Specialised Competencie

        $compdahrds = CompDaHrd::select('comp_da_hrd.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdaots = CompDaOt::select('comp_da_ot.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahrms = CompDaHrm::select('comp_da_hrm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinmaws = CompDaFinMaw::select('comp_da_finmaw.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafsms = CompDaFsm::select('comp_da_fsm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdaresearchs = CompDaResearch::select('comp_da_research.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinams = CompDaFinam::select('comp_da_finam.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahses = CompDaHse::select('comp_da_hse.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinhses = CompDaFinHse::select('comp_da_finhse.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahseaks = CompDaHseak::select('comp_da_hseak.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinaks = CompDaFinak::select('comp_da_finak.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdatranss = CompDaTrans::select('comp_da_trans.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

//Start JPKhas Specialised Competencies
        $compjpkhasseccs = CompJpkhasSecc::select('comp_jpkhas_secc.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjpkhassefcs = CompJpkhasSefc::select('comp_jpkhas_sefc.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();
            
        $compjpkhasqas = CompJpkhasQa::select('comp_jpkhas_qa.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

//Start CCD Specialised Competencies
        $compccdprs = CompCcdPr::select('comp_ccd_pr.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

//Start DICT Specialised Competencies
        $compdictitins = CompDictItin::select('comp_dict_itin.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compdictitsms = CompDictItsm::select('comp_dict_itsm.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();
        
        $compdictitos = CompDictIto::select('comp_dict_ito.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();
        
        $compdictitss = CompDictIts::select('comp_dict_its.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();        

//Start MKPK Specialised Competencies
        $compmkpkqas = CompMkpkQa::select('comp_mkpk_qa.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compmkpkcsms = CompMkpkCsm::select('comp_mkpk_csm.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compmkpkdms = CompMkpkDm::select('comp_mkpk_dm.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compmkpkhrs = CompMkpkHr::select('comp_mkpk_hr.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compmkpkass = CompMkpkAs::select('comp_mkpk_as.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

//Start JPPE Specialised Competencies
        $compjppees = CompJppeE::select('comp_jppe_e.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppeems = CompJppeEm::select('comp_jppe_em.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppefmmaws = CompJppeFmmaw::select('comp_jppe_fmmaw.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppehrdas = CompJppeHrda::select('comp_jppe_hrda.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        return view(
            'competency.editsupervisorcompetency',
            compact(
                'competencies',
                'employments',
                'dadomains',
                'jpkhasdomains',
                'ccddomains',
                'dictdomains',
                'mkpkdomains',
                'jppedomains',             
                
                'compdahrds',
                'compdaots',
                'compdahrms',
                'compdafinmaws',
                'compdafsms',
                'compdaresearchs',
                'compdafinams',
                'compdahses',
                'compdafinhses',
                'compdahseaks',
                'compdafinaks',
                'compdatranss',

                'compjpkhasseccs','compjpkhassefcs','compjpkhasqas',

                'compccdprs',

                'compdictitins','compdictitsms','compdictitos','compdictitss',

                'compmkpkqas','compmkpkcsms','compmkpkdms','compmkpkhrs','compmkpkass',

                'compjppees','compjppeems','compjppefmmaws','compjppehrdas'                
            )
        );
    }

    public function editcompetency($id)
    {
        
        $competencies = CompetencyInfo::all()->where('id', '=', $id);

        $competencies1 = CompetencyInfo::all()
            ->where('id', '=', $id)
            ->first();

        $employments = Employment::all()->where(
            'ic_no',
            '=',
            $competencies1->indv_icno
        );

        $dadomains = DaDomain::pluck('label', 'id')->all();
        $jpkhasdomains = JPKhasDomain::pluck('label', 'id')->all();
        $ccddomains = CcdDomain::pluck('label', 'id')->all();        
        $dictdomains = DictDomain::pluck('label', 'id')->all();        
        $mkpkdomains = MkpkDomain::pluck('label', 'id')->all();        
        $jppedomains = JppeDomain::pluck('label', 'id')->all();             
     
        // Start DA Specialised Competencie
        // Start Specialised Competencie
        $compdahrds = CompDaHrd::select('comp_da_hrd.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdaots = CompDaOt::select('comp_da_ot.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahrms = CompDaHrm::select('comp_da_hrm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinmaws = CompDaFinMaw::select('comp_da_finmaw.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafsms = CompDaFsm::select('comp_da_fsm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdaresearchs = CompDaResearch::select('comp_da_research.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinams = CompDaFinam::select('comp_da_finam.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahses = CompDaHse::select('comp_da_hse.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinhses = CompDaFinHse::select('comp_da_finhse.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahseaks = CompDaHseak::select('comp_da_hseak.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinaks = CompDaFinak::select('comp_da_finak.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdatranss = CompDaTrans::select('comp_da_trans.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

//Start JPKhas Specialised Competencies
        $compjpkhasseccs = CompJpkhasSecc::select('comp_jpkhas_secc.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();        

    $compjpkhassefcs = CompJpkhasSefc::select('comp_jpkhas_sefc.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();
        
    $compjpkhasqas = CompJpkhasQa::select('comp_jpkhas_qa.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();                

//Start CCD Specialised Competencies
    $compccdprs = CompCcdPr::select('comp_ccd_pr.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

//Start DICT Specialised Competencies
    $compdictitins = CompDictItin::select('comp_dict_itin.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

    $compdictitsms = CompDictItsm::select('comp_dict_itsm.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();
        
    $compdictitos = CompDictIto::select('comp_dict_ito.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();
        
    $compdictitss = CompDictIts::select('comp_dict_its.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();            
        
//Start MKPK Specialised Competencies
    $compmkpkqas = CompMkpkQa::select('comp_mkpk_qa.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

    $compmkpkcsms = CompMkpkCsm::select('comp_mkpk_csm.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

    $compmkpkdms = CompMkpkDm::select('comp_mkpk_dm.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();
        
    $compmkpkhrs = CompMkpkHr::select('comp_mkpk_hr.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();
        
    $compmkpkass = CompMkpkAs::select('comp_mkpk_as.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();            

//Start JPPE Specialised Competencies
    $compjppees = CompJppeE::select('comp_jppe_e.*')
    ->where([['competency_info_id', '=', $id]])
    ->get();

    $compjppeems = CompJppeEm::select('comp_jppe_em.*')
    ->where([['competency_info_id', '=', $id]])
    ->get();

    $compjppefmmaws = CompJppeFmmaw::select('comp_jppe_fmmaw.*')
    ->where([['competency_info_id', '=', $id]])
    ->get();

    $compjppehrdas = CompJppeHrda::select('comp_jppe_hrda.*')
    ->where([['competency_info_id', '=', $id]])
    ->get();
            
        return view(
            'competency.editcompetency',
            compact(
                'competencies',
                'employments',
                'dadomains',
                'jpkhasdomains',
                'ccddomains',
                'dictdomains',
                'mkpkdomains',
                'jppedomains',
             
                'compdahrds',
                'compdaots',
                'compdahrms',
                'compdafinmaws',
                'compdafsms',
                'compdaresearchs',
                'compdafinams',
                'compdahses',
                'compdafinhses',
                'compdahseaks',
                'compdafinaks',
                'compdatranss',

                'compjpkhasseccs','compjpkhassefcs','compjpkhasqas',

                'compccdprs',

                'compdictitins','compdictitsms','compdictitos','compdictitss',

                'compmkpkqas','compmkpkcsms','compmkpkdms','compmkpkhrs','compmkpkass',

                'compjppees','compjppeems','compjppefmmaws','compjppehrdas'                
            )
        );
    }

    public function editreassessmentcompetency($id)
    {

        $competencies = CompetencyInfo::all()->where('id', '=', $id);

        $competencies1 = CompetencyInfo::all()
            ->where('id', '=', $id)
            ->first();

        $employments = Employment::all()->where(
            'ic_no',
            '=',
            $competencies1->indv_icno
        );

        $dadomains = DaDomain::pluck('label', 'id')->all();
        $dictdomains = DictDomain::pluck('label', 'id')->all();
        $mkpkdomains = MkpkDomain::pluck('label', 'id')->all();
        $jppedomains = JppeDomain::pluck('label', 'id')->all();

    
        // Start DA Specialised Competencie
        // Start Specialised Competencie

        $compdahrds = CompDaHrd::select('comp_da_hrd.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdaots = CompDaOt::select('comp_da_ot.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahrms = CompDaHrm::select('comp_da_hrm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinmaws = CompDaFinMaw::select('comp_da_finmaw.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafsms = CompDaFsm::select('comp_da_fsm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdaresearchs = CompDaResearch::select('comp_da_research.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinams = CompDaFinam::select('comp_da_finam.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahses = CompDaHse::select('comp_da_hse.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinhses = CompDaFinHse::select('comp_da_finhse.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahseaks = CompDaHseak::select('comp_da_hseak.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinaks = CompDaFinak::select('comp_da_finak.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdatranss = CompDaTrans::select('comp_da_trans.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();


//Start DICT Specialised Competencies
        $compdictitins = CompDictItin::select('comp_dict_itin.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdictitsms = CompDictItsm::select('comp_dict_itsm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();
            
        $compdictitos = CompDictIto::select('comp_dict_ito.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();
            
        $compdictitss = CompDictIts::select('comp_dict_its.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();            
            
//Start MKPK Specialised Competencies
        $compmkpkqas = CompMkpkQa::select('comp_mkpk_qa.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compmkpkcsms = CompMkpkCsm::select('comp_mkpk_csm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compmkpkdms = CompMkpkDm::select('comp_mkpk_dm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();
            
        $compmkpkhrs = CompMkpkHr::select('comp_mkpk_hr.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();
            
        $compmkpkass = CompMkpkAs::select('comp_mkpk_as.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();            

//Start JPPE Specialised Competencies
        $compjppees = CompJppeE::select('comp_jppe_e.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppeems = CompJppeEm::select('comp_jppe_em.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppefmmaws = CompJppeFmmaw::select('comp_jppe_fmmaw.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppehrdas = CompJppeHrda::select('comp_jppe_hrda.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();


        return view(
            'competency.editreassessmentcompetency',
            compact(
                'competencies',
                'employments',
                'dadomains',
                'dictdomains','mkpkdomains','jppedomains',
             
                
                'compdahrds',
                'compdaots',
                'compdahrms',
                'compdafinmaws',
                'compdafsms',
                'compdaresearchs',
                'compdafinams',
                'compdahses',
                'compdafinhses',
                'compdahseaks',
                'compdafinaks',
                'compdatranss',

                'compdictitins','compdictitsms','compdictitos','compdictitss',

                'compmkpkqas','compmkpkcsms','compmkpkdms','compmkpkhrs','compmkpkass',

                'compjppees','compjppeems','compjppefmmaws','compjppehrdas'
            )
        );
    }

    public function updatereassessmentcompetency(Request $request)
    {
        $now = Carbon::now();

        $compentencies = CompetencyInfo::select('competency_infos.*')
            ->where('id', $request->id)
            ->update([
                'r_sd_st_evd' => $request->r_sd_st_evd,
                'r_sd_ca_evd' => $request->r_sd_ca_evd,
                'r_sd_po_evd' => $request->r_sd_po_evd,
                'r_sd_st_outcome' => $request->r_sd_st_outcome,
                'r_sd_ca_outcome' => $request->r_sd_ca_outcome,
                'r_sd_po_outcome' => $request->r_sd_po_outcome,
                'r_sd_st_sl' => $request->r_sd_st_sl,
                'r_sd_ca_sl' => $request->r_sd_ca_sl,
                'r_sd_po_sl' => $request->r_sd_po_sl,
                'r_sd_st_ft' => $request->r_sd_st_ft,
                'r_sd_ca_ft' => $request->r_sd_ca_ft,
                'r_sd_po_ft' => $request->r_sd_po_ft,
                'r_sd_st_otj' => $request->r_sd_st_otj,
                'r_sd_ca_otj' => $request->r_sd_ca_otj,
                'r_sd_po_otj' => $request->r_sd_po_otj,

                'r_pe_cc_evd' => $request->r_pe_cc_evd,
                'r_pe_lo_evd' => $request->r_pe_lo_evd,
                'r_pe_tw_evd' => $request->r_pe_tw_evd,
                'r_pe_cc_outcome' => $request->r_pe_cc_outcome,
                'r_pe_lo_outcome' => $request->r_pe_lo_outcome,
                'r_pe_tw_outcome' => $request->r_pe_tw_outcome,
                'r_pe_cc_sl' => $request->r_pe_cc_sl,
                'r_pe_lo_sl' => $request->r_pe_lo_sl,
                'r_pe_tw_sl' => $request->r_pe_tw_sl,
                'r_pe_cc_ft' => $request->r_pe_cc_ft,
                'r_pe_lo_ft' => $request->r_pe_lo_ft,
                'r_pe_tw_ft' => $request->r_pe_tw_ft,
                'r_pe_cc_otj' => $request->r_pe_cc_otj,
                'r_pe_lo_otj' => $request->r_pe_lo_otj,
                'r_pe_tw_otj' => $request->r_pe_tw_otj,

                'r_pc_dps_evd' => $request->r_pc_dps_evd,
                'r_pc_df_evd' => $request->r_pc_dps_evd,
                'r_pc_per_evd' => $request->r_pc_per_evd,
                'r_pc_dps_outcome' => $request->r_pc_dps_outcome,
                'r_pc_df_outcome' => $request->r_pc_df_outcome,
                'r_pc_per_outcome' => $request->r_pc_per_outcome,
                'r_pc_dps_sl' => $request->r_pc_dps_sl,
                'r_pc_df_sl' => $request->r_pc_df_sl,
                'r_pc_per_sl' => $request->r_pc_per_sl,
                'r_pc_dps_ft' => $request->r_pc_dps_ft,
                'r_pc_df_ft' => $request->r_pc_df_ft,
                'r_pc_per_ft' => $request->r_pc_per_ft,
                'r_pc_dps_otj' => $request->r_pc_dps_otj,
                'r_pc_df_otj' => $request->r_pc_df_otj,
                'r_pc_per_otj' => $request->r_pc_per_otj,

                'r_oc_pmtd_evd' => $request->r_oc_pmtd_evd,
                'r_oc_cg_evd' => $request->r_oc_cg_evd,
                'r_oc_qdcf_evd' => $request->r_oc_qdcf_evd,
                'r_oc_pmtd_outcome' => $request->r_oc_pmtd_outcome,
                'r_oc_cg_outcome' => $request->r_oc_cg_outcome,
                'r_oc_qdcf_outcome' => $request->r_oc_qdcf_outcome,
                'r_oc_pmtd_sl' => $request->r_oc_pmtd_sl,
                'r_oc_cg_sl' => $request->r_oc_cg_sl,
                'r_oc_qdcf_sl' => $request->r_oc_qdcf_sl,
                'r_oc_pmtd_ft' => $request->r_oc_pmtd_ft,
                'r_oc_cg_ft' => $request->r_oc_cg_ft,
                'r_oc_qdcf_ft' => $request->r_oc_qdcf_ft,
                'r_oc_pmtd_otj' => $request->r_oc_pmtd_otj,
                'r_oc_cg_otj' => $request->r_oc_cg_otj,
                'r_oc_qdcf_otj' => $request->r_oc_qdcf_otj,
                'updated_at' => $now,
            ]);

                    // to store comp_da_hrd table 

        
       if( !empty($r_hrd_evd) || !empty($r_hrd_outcome) || !empty($r_hrd_otj) || !empty($r_hrd_st) || !empty($r_hrd_ft)){
 
            //     
            for($i = 0; $i < count($request->r_hrd_evd); $i ++) 
            
            {
                DB::table('comp_da_hrd')->where('id',$request->id[$i])->update(
                
        
                    /** If a record exists it will be updated with following */
                    [ 

                    'r_hrd_evd'=>$request->r_hrd_evd[$i],
                    'r_hrd_outcome'=>$request->r_hrd_outcome[$i],  
                    'r_hrd_otj'=>$request->r_hrd_otj[$i],
                    'r_hrd_st'=>$request->r_hrd_st[$i], 
                    'r_hrd_ft'=>$request->r_hrd_ft[$i]  
                    
                    ]
                );
            }
        }


    if( !empty($r_ot_evd) || !empty($r_ot_outcome) || !empty($r_ot_otj) || !empty($r_ot_st) || !empty($r_ot_ft)){
    //     
        for($i = 0; $i < count($request->r_ot_outcome ); $i ++) {
        DB::table('comp_da_ot')
        ->where('id',$request->id[$i])
            ->update(
            
    
                /** If a record exists it will be updated with following */
                [ 

                'r_ot_evd'=>$request->r_ot_evd[$i],
                'r_ot_outcome'=>$request->r_ot_outcome[$i],  
                'r_ot_otj'=>$request->r_ot_otj[$i],
                'r_ot_st'=>$request->r_ot_st[$i], 
                'r_ot_ft'=>$request->r_ot_ft[$i]  
                
                ]
            );
        }

    
    // If a matching record (quote_id + product_id) is not found then a new record will be inserted combining both arguments to the `updateOrInsert` method.
    



//Start DICT Specialised Competencies
//     foreach ($request->id as $key => $value) {
//         $data = array(                 
//             'r_itin_evd'=>$request->r_itin_evd[$key],
//             'r_itin_outcome'=>$request->r_itin_outcome[$key],  
//             'r_itin_otj'=>$request->r_itin_otj[$key],
//             'r_itin_st'=>$request->r_itin_st[$key], 
//             'r_itin_ft'=>$request->r_itin_ft[$key],                 
//         );         
//         CompDictItin::where('id',$request->id[$key])
//         ->update($data);
//     }

//     foreach ($request->id as $key => $value) {
//         $data = array(                 
//             'r_itsm_evd'=>$request->r_itsm_evd[$key],
//             'r_itsm_outcome'=>$request->r_itsm_outcome[$key],  
//             'r_itsm_otj'=>$request->r_itsm_otj[$key],
//             'r_itsm_st'=>$request->r_itsm_st[$key], 
//             'r_itsm_ft'=>$request->r_itsm_ft[$key],                 
//         );         
//         CompDictItsm::where('id',$request->id[$key])
//         ->update($data);
//     }

//     foreach ($request->id as $key => $value) {
//         $data = array(                 
//             'r_ito_evd'=>$request->r_ito_evd[$key],
//             'r_ito_outcome'=>$request->r_ito_outcome[$key],  
//             'r_ito_otj'=>$request->r_ito_otj[$key],
//             'r_ito_st'=>$request->r_ito_st[$key], 
//             'r_ito_ft'=>$request->r_ito_ft[$key],                 
//         );         
//         CompDictIto::where('id',$request->id[$key])
//         ->update($data);
//     }

//     foreach ($request->id as $key => $value) {
//         $data = array(                 
//             'r_its_evd'=>$request->r_its_evd[$key],
//             'r_its_outcome'=>$request->r_its_outcome[$key],  
//             'r_its_otj'=>$request->r_its_otj[$key],
//             'r_its_st'=>$request->r_its_st[$key], 
//             'r_its_ft'=>$request->r_its_ft[$key],                 
//         );         
//         CompDictIts::where('id',$request->id[$key])
//         ->update($data);
//     }

// //Start MKPK Specialised Competencies

//     foreach ($request->id as $key => $value) {
//         $data = array(                 
//             'r_mkpkqa_evd' => $request->r_mkpkqa_evd[$key],
//             'r_mkpkqa_outcome' => $request->r_mkpkqa_outcome[$key],
//             'r_mkpkqa_otj' => $request->r_mkpkqa_otj[$key],
//             'r_mkpkqa_st' => $request->r_mkpkqa_st[$key],
//             'r_mkpkqa_ft' => $request->r_mkpkqa_ft[$key],
//         );
//         CompMkpkQa::where('id',$request->id[$key])
//         ->update($data);
//     }
    
//     foreach ($request->id as $key => $value) {
//         $data = array(                 
//             'r_csm_evd' => $request->r_csm_evd[$key],
//             'r_csm_outcome' => $request->r_csm_outcome[$key],
//             'r_csm_otj' => $request->r_csm_otj[$key],
//             'r_csm_st' => $request->r_csm_st[$key],
//             'r_csm_ft' => $request->r_csm_ft[$key],
//         );                   
//         CompMkpkCsm::where('id',$request->id[$key])
//         ->update($data); 
//     }
    
//     foreach ($request->id as $key => $value) {
//         $data = array(                 
//             'r_dm_evd' => $request->r_dm_evd[$key],
//             'r_dm_outcome' => $request->r_dm_outcome[$key],
//             'r_dm_otj' => $request->r_dm_otj[$key],
//             'r_dm_st' => $request->r_dm_st[$key],
//             'r_dm_ft' => $request->r_dm_ft[$key],
//         );                   
//         CompMkpkDm::where('id',$request->id[$key])
//         ->update($data); 
//     }


//     foreach ($request->id as $key => $value) {
//         $data = array(                 
//             'r_hr_evd' => $request->r_hr_evd[$key],
//             'r_hr_outcome' => $request->r_hr_outcome[$key],
//             'r_hr_otj' => $request->r_hr_otj[$key],
//             'r_hr_st' => $request->r_hr_st[$key],
//             'r_hr_ft' => $request->r_hr_ft[$key],
//         );                   
//         CompMkpkHr::where('id',$request->id[$key])
//         ->update($data); 
//     }


//     foreach ($request->id as $key => $value) {
//         $data = array(                 
//             'r_as_evd' => $request->r_as_evd[$key],
//             'r_as_outcome' => $request->r_as_outcome[$key],
//             'r_as_otj' => $request->r_as_otj[$key],
//             'r_as_st' => $request->r_as_st[$key],
//             'r_as_ft' => $request->r_as_ft[$key],
//         );                   
//         CompMkpkAs::where('id',$request->id[$key])
//         ->update($data); 
//     }


// //Start JPPE Specialised Competencies

//     foreach ($request->id as $key => $value) {
//         $data = array(                 
//             'r_e_evd' => $request->r_e_evd[$key],
//             'r_e_outcome' => $request->r_e_outcome[$key],
//             'r_e_otj' => $request->r_e_otj[$key],
//             'r_e_st' => $request->r_e_st[$key],
//             'r_e_ft' => $request->r_e_ft[$key],
//         );                   
//         CompJppeE::where('id',$request->id[$key])
//         ->update($data); 
//     }

//     foreach ($request->id as $key => $value) {
//         $data = array(                 
//             'r_em_evd' => $request->r_em_evd[$key],
//             'r_em_outcome' => $request->r_em_outcome[$key],
//             'r_em_otj' => $request->r_em_otj[$key],
//             'r_em_st' => $request->r_em_st[$key],
//             'r_em_ft' => $request->r_em_ft[$key],
//         );                   
//         CompJppeEm::where('id',$request->id[$key])
//         ->update($data); 
//     }

//     foreach ($request->id as $key => $value) {
//         $data = array(                 
//             'r_fmmaw_evd' => $request->r_fmmaw_evd[$key],
//             'r_fmmaw_outcome' => $request->r_fmmaw_outcome[$key],
//             'r_fmmaw_otj' => $request->r_fmmaw_otj[$key],
//             'r_fmmaw_st' => $request->r_fmmaw_st[$key],
//             'r_fmmaw_ft' => $request->r_fmmaw_ft[$key],
//         );                   
//         CompJppeFmmaw::where('id',$request->id[$key])
//         ->update($data); 
//     }
  

//     foreach ($request->id as $key => $value) {
//         $data = array(                 
//             'r_hrda_evd' => $request->r_hrda_evd[$key],
//             'r_hrda_outcome' => $request->r_hrda_outcome[$key],
//             'r_hrda_otj' => $request->r_hrda_otj[$key],
//             'r_hrda_st' => $request->r_hrda_st[$key],
//             'r_hrda_ft' => $request->r_hrda_ft[$key],
//         );                   
//         CompJppeHrda::where('id',$request->id[$key])
//         ->update($data); 
//     }

        return redirect()
            ->route('competency.competency.indexcompetency')
            ->with(
                'success_message',
                'Competency record was successfully updated!'
            );
    }  
    }  

      public function supportdocument($id)
    {
    
        $competencies = CompetencyInfo::all()->where('id', '=', $id);

        $competencyfiles = CompetencyFile::select('competency_files.*')
        ->where([['competency_infos_id', '=', $id]])
        ->get();

        return view('competency.supportdocument', compact('competencyfiles','competencies'));
    }

    public function supportdocumentsupv($id)
    {
    
        $competencies = CompetencyInfo::all()->where('id', '=', $id);

        $competencyfiles = CompetencyFile::select('competency_files.*')
        ->where([['competency_infos_id', '=', $id]])
        ->get();

        return view('competency.supportdocumentsupv', compact('competencyfiles','competencies'));
    }

    public function supportdocumentstore(Request $request)
    {
        $now = Carbon::now();

          // storing data for dokumen file

        $id = $request->id;
        $catatan = $request->catatan;
        $filename = $request->file;
        $file = $request->file('file');
        $icNos = Auth::user()->ic_no;

        if ($request->catatan != '' || $request->file != '') {
            for (
                $count_100 = 0;
                $count_100 < count($catatan);
                $count_100++
            ) {
                $data_100 = [
                    'competency_infos_id' => $id,
                    'catatan' => $catatan[$count_100],
                    'filename' => $filename[$count_100]->getClientOriginalName(),
                    'file' => $file[$count_100]->store('competencyfile', 'public'),
                    'created_by_ic_no' => $icNos[$count_100],
                    'created_at' => $now
                
                ];

                $insert_data_100[] = $data_100;
            }
            CompetencyFile::insert($insert_data_100);
        }

        return redirect()->back()
            ->with(
                'success_message',
                'File was successfully uploaded!'
            );
    }



    public function collabrator($id)
    {
        $competencies = CompetencyInfo::all()->where('id', '=', $id);

        return view('competency.collabrator', compact('competencies'));
    }

    public function updatecompetency(Request $request)
    {
        $now = Carbon::now();

        $icNos = Auth::user()->ic_no;
        $competencies = CompetencyInfo::select('competency_infos.*')
            ->orderBy('created_at', 'DESC')
            ->get();


        $telMobile = Contact::select(['emp_contact_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
            ->where('ic_no', $request->supv_icno)
            ->value('telephone_mobile');

            // Whatsapp API Start
        $data = [
            'phone' => "+673". $telMobile, // Receivers phone if country code is not included
            // 'phone' => $book123->phone_number, //Receiver phone if country code is included
            'template' => 'moe_cms1', // Template name
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
           

        $compentencies = CompetencyInfo::select('competency_infos.*')
            ->where('id', $request->id)
            ->update([
                'supv_icno' => $request->supv_icno,
                'supv_name' => $request->supv_name,
                'supv_dept' => $request->supv_dept,
                'supv_div' => $request->supv_div,
                'supv_post' => $request->supv_post,
                'date' => $request->date,
                'remarks' => $request->remarks,

                'sd_st_evd' => $request->sd_st_evd,
                'sd_st_icl' => $request->sd_st_icl,
                'sd_st_otj' => $request->sd_st_otj,
                'sd_st_sl' => $request->sd_st_sl,
                'sd_st_ft' => $request->sd_st_ft,


                'sd_ca_evd' => $request->sd_ca_evd,
                'sd_ca_icl' => $request->sd_ca_icl,
                'sd_ca_otj' => $request->sd_ca_otj,
                'sd_ca_sl' => $request->sd_ca_sl,
                'sd_ca_ft' => $request->sd_ca_ft,


                'sd_po_evd' => $request->sd_po_evd,
                'sd_po_icl' => $request->sd_po_icl,
                'sd_po_otj' => $request->sd_po_otj,
                'sd_po_sl' => $request->sd_po_sl,
                'sd_po_ft' => $request->sd_po_ft,


                'pe_cc_evd' => $request->pe_cc_evd,
                'pe_cc_icl' => $request->pe_cc_icl,
                'pe_cc_otj' => $request->pe_cc_otj,
                'pe_cc_sl' => $request->pe_cc_sl,
                'pe_cc_ft' => $request->pe_cc_ft,


                'pe_lo_evd' => $request->pe_lo_evd,
                'pe_lo_icl' => $request->pe_lo_icl,
                'pe_lo_otj' => $request->pe_lo_otj,
                'pe_lo_sl' => $request->pe_lo_sl,
                'pe_lo_ft' => $request->pe_lo_ft,


                'pe_tw_evd' => $request->pe_tw_evd,
                'pe_tw_icl' => $request->pe_tw_icl,
                'pe_tw_otj' => $request->pe_tw_otj,
                'pe_tw_sl' => $request->pe_tw_sl,
                'pe_tw_ft' => $request->pe_tw_ft,


                'pc_dps_evd' => $request->pc_dps_evd,
                'pc_dps_icl' => $request->pc_dps_icl,
                'pc_dps_otj' => $request->pc_dps_otj,
                'pc_dps_sl' => $request->pc_dps_sl,
                'pc_dps_ft' => $request->pc_dps_ft,


                'pc_df_evd' => $request->pc_df_evd,
                'pc_df_icl' => $request->pc_df_icl,
                'pc_df_otj' => $request->pc_df_otj,
                'pc_df_sl' => $request->pc_df_sl,
                'pc_df_ft' => $request->pc_df_ft,


                'pc_per_evd' => $request->pc_per_evd,
                'pc_per_icl' => $request->pc_per_icl,
                'pc_per_otj' => $request->pc_per_otj,
                'pc_per_sl' => $request->pc_per_sl,
                'pc_per_ft' => $request->pc_per_ft,


                'oc_pmtd_evd' => $request->oc_pmtd_evd,
                'oc_pmtd_icl' => $request->oc_pmtd_icl,
                'oc_pmtd_otj' => $request->oc_pmtd_otj,
                'oc_pmtd_sl' => $request->oc_pmtd_sl,
                'oc_pmtd_ft' => $request->oc_pmtd_ft,


                'oc_cg_evd' => $request->oc_cg_evd,
                'oc_cg_icl' => $request->oc_cg_icl,
                'oc_cg_otj' => $request->oc_cg_otj,
                'oc_cg_sl' => $request->oc_cg_sl,
                'oc_cg_ft' => $request->oc_cg_ft,


                'oc_qdcf_evd' => $request->oc_qdcf_evd,
                'oc_qdcf_icl' => $request->oc_qdcf_icl,
                'oc_qdcf_otj' => $request->oc_qdcf_otj,
                'oc_qdcf_sl' => $request->oc_qdcf_sl,
                'oc_qdcf_ft' => $request->oc_qdcf_ft,


                'updated_at' => $now,
            ]);

     
             
            
        // Start DA Specialised Competencie

        // to store comp_da_hrd table
        $compdahrds = CompDaHrd::select('comp_da_hrd.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'hrd_evd' => $request->hrd_evd,                
                'hrd_icl' => $request->hrd_icl,
                'hrd_otj' => $request->hrd_otj,   
                'hrd_st' => $request->hrd_st,  
                'hrd_ft' => $request->hrd_ft,    
            ]);

        $compdaots = CompDaOt::select('comp_da_ot.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'ot_evd' => $request->ot_evd,                
                'ot_icl' => $request->ot_icl,
                'ot_otj' => $request->ot_otj,   
                'ot_st' => $request->ot_st,  
                'ot_ft' => $request->ot_ft,   
            ]);

        $compdahrms = CompDaHrm::select('comp_da_hrm.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'hrm_evd' => $request->hrm_evd,                
                'hrm_icl' => $request->hrm_icl,
                'hrm_otj' => $request->hrm_otj,   
                'hrm_st' => $request->hrm_st,  
                'hrm_ft' => $request->hrm_ft,   
            ]);

        $compdafinmaws = CompDaFinMaw::select('comp_da_finmaw.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'finmaw_evd' => $request->finmaw_evd,                
                'finmaw_icl' => $request->finmaw_icl,
                'finmaw_otj' => $request->finmaw_otj,   
                'finmaw_st' => $request->finmaw_st,  
                'finmaw_ft' => $request->finmaw_ft,   
            ]);

        $compdafsms = CompDaFsm::select('comp_da_fsm.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'fsm_evd' => $request->fsm_evd,                
                'fsm_icl' => $request->fsm_icl,
                'fsm_otj' => $request->fsm_otj,   
                'fsm_st' => $request->fsm_st,  
                'fsm_ft' => $request->fsm_ft,   
            ]);

        $compdaresearchs = CompDaResearch::select('comp_da_research.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'research_evd' => $request->research_evd,                
                'research_icl' => $request->research_icl,
                'research_otj' => $request->research_otj,   
                'research_st' => $request->research_st,  
                'research_ft' => $request->research_ft,   
            ]);

        $compdafinams = CompDaFinam::select('comp_da_finam.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'finam_evd' => $request->finam_evd,                
                'finam_icl' => $request->finam_icl,
                'finam_otj' => $request->finam_otj,   
                'finam_st' => $request->finam_st,  
                'finam_ft' => $request->finam_ft,   
            ]);

        $compdahses = CompDaHse::select('comp_da_hse.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'hse_evd' => $request->hse_evd,                
                'hse_icl' => $request->hse_icl,
                'hse_otj' => $request->hse_otj,   
                'hse_st' => $request->hse_st,  
                'hse_ft' => $request->hse_ft,   
            ]);

        $compdafinhses = CompDaFinHse::select('comp_da_finhse.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'finhse_evd' => $request->finhse_evd,                
                'finhse_icl' => $request->finhse_icl,
                'finhse_otj' => $request->finhse_otj,   
                'finhse_st' => $request->finhse_st,  
                'finhse_ft' => $request->finhse_ft,   
            ]);

        $compdahseaks = CompDaHseak::select('comp_da_hseak.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'hseak_evd' => $request->hseak_evd,                
                'hseak_icl' => $request->hseak_icl,
                'hseak_otj' => $request->hseak_otj,   
                'hseak_st' => $request->hseak_st,  
                'hseak_ft' => $request->hseak_ft,   
            ]);

        $compdafinaks = CompDaFinak::select('comp_da_finak.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'finak_evd' => $request->finak_evd,                
                'finak_icl' => $request->finak_icl,
                'finak_otj' => $request->finak_otj,   
                'finak_st' => $request->finak_st,  
                'finak_ft' => $request->finak_ft,   
            ]);

        $compdatranss = CompDaTrans::select('comp_da_trans.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'trans_evd' => $request->trans_evd,                
                'trans_icl' => $request->trans_icl,
                'trans_otj' => $request->trans_otj,   
                'trans_st' => $request->trans_st,  
                'trans_ft' => $request->trans_ft,   
            ]);

//Start JPKhas Specialised Competencies
        $compjpkhasseccs = CompJpkhasSecc::select('comp_jpkhas_secc.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'secc_evd' => $request->secc_evd,
            'secc_icl' => $request->secc_icl,
            'secc_otj' => $request->secc_otj,
            'secc_st' => $request->secc_st,
            'secc_ft' => $request->secc_ft,
        ]);

        $compjpkhassefcs = CompJpkhasSefc::select('comp_jpkhas_sefc.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'sefc_evd' => $request->sefc_evd,
            'sefc_icl' => $request->sefc_icl,
            'sefc_otj' => $request->sefc_otj,
            'sefc_st' => $request->sefc_st,
            'sefc_ft' => $request->sefc_ft,
        ]);
            
        $compjpkhasqas = CompJpkhasQa::select('comp_jpkhas_qa.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'qa_evd' => $request->qa_evd,
            'qa_icl' => $request->qa_icl,
            'qa_otj' => $request->qa_otj,
            'qa_st' => $request->qa_st,
            'qa_ft' => $request->qa_ft,
        ]);


//Start CCD Specialised Competencies
        $compccdprs = CompCcdPr::select('comp_ccd_pr.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'pr_evd' => $request->pr_evd,
            'pr_icl' => $request->pr_icl,
            'pr_otj' => $request->pr_otj,
            'pr_st' => $request->pr_st,
            'pr_ft' => $request->pr_ft,
        ]);

//Start DICT Specialised Competencies
        $compdictitins = CompDictItin::select('comp_dict_itin.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'itin_evd' => $request->itin_evd,
            'itin_icl' => $request->itin_icl,
            'itin_otj' => $request->itin_otj,
            'itin_st' => $request->itin_st,
            'itin_ft' => $request->itin_ft,
        ]);

        $compdictitsms = CompDictItsm::select('comp_dict_itsm.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'itsm_evd' => $request->itsm_evd,
            'itsm_icl' => $request->itsm_icl,
            'itsm_otj' => $request->itsm_otj,
            'itsm_st' => $request->itsm_st,
            'itsm_ft' => $request->itsm_ft,
        ]);

        $compdictitos = CompDictIto::select('comp_dict_ito.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'ito_evd' => $request->ito_evd,
            'ito_icl' => $request->ito_icl,
            'ito_otj' => $request->ito_otj,
            'ito_st' => $request->ito_st,
            'ito_ft' => $request->ito_ft,
        ]);

        $compdictitss = CompDictIts::select('comp_dict_its.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'its_evd' => $request->its_evd,
            'its_icl' => $request->its_icl,
            'its_otj' => $request->its_otj,
            'its_st' => $request->its_st,
            'its_ft' => $request->its_ft,
        ]);

//Start MKPK Specialised Competencies
        $compmkpkqas = CompMkpkQa::select('comp_mkpk_qa.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'mkpkqa_evd' => $request->mkpkqa_evd,
            'mkpkqa_icl' => $request->mkpkqa_icl,
            'mkpkqa_otj' => $request->mkpkqa_otj,
            'mkpkqa_st' => $request->mkpkqa_st,
            'mkpkqa_ft' => $request->mkpkqa_ft,
        ]);

        $compmkpkcsms = CompMkpkCsm::select('comp_mkpk_csm.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'csm_evd' => $request->csm_evd,
            'csm_icl' => $request->csm_icl,
            'csm_otj' => $request->csm_otj,
            'csm_st' => $request->csm_st,
            'csm_ft' => $request->csm_ft,
        ]);

        $compmkpkdms = CompMkpkDm::select('comp_mkpk_dm.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'dm_evd' => $request->dm_evd,
            'dm_icl' => $request->dm_icl,
            'dm_otj' => $request->dm_otj,
            'dm_st' => $request->dm_st,
            'dm_ft' => $request->dm_ft,
        ]);

        $compmkpkhrs = CompMkpkHr::select('comp_mkpk_hr.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'hr_evd' => $request->hr_evd,
            'hr_icl' => $request->hr_icl,
            'hr_otj' => $request->hr_otj,
            'hr_st' => $request->hr_st,
            'hr_ft' => $request->hr_ft,
        ]);

        $compmkpkass = CompMkpkAs::select('comp_mkpk_as.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'as_evd' => $request->as_evd,
            'as_icl' => $request->as_icl,
            'as_otj' => $request->as_otj,
            'as_st' => $request->as_st,
            'as_ft' => $request->as_ft,
        ]);

//Start JPPE Specialised Competencies
        $compjppees = CompJppeE::select('comp_jppe_e.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'e_evd' => $request->e_evd,
            'e_icl' => $request->e_icl,
            'e_otj' => $request->e_otj,
            'e_st' => $request->e_st,
            'e_ft' => $request->e_ft,
        ]);

        $compjppeems = CompJppeEm::select('comp_jppe_em.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'em_evd' => $request->em_evd,
            'em_icl' => $request->em_icl,
            'em_otj' => $request->em_otj,
            'em_st' => $request->em_st,
            'em_ft' => $request->em_ft,
        ]);        

        $compjppefmmaws = CompJppeFmmaw::select('comp_jppe_fmmaw.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'fmmaw_evd' => $request->fmmaw_evd,
            'fmmaw_icl' => $request->fmmaw_icl,
            'fmmaw_otj' => $request->fmmaw_otj,
            'fmmaw_st' => $request->fmmaw_st,
            'fmmaw_ft' => $request->fmmaw_ft,
        ]);        

        $compjppehrdas = CompJppeHrda::select('comp_jppe_hrda.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'hrda_evd' => $request->hrda_evd,
            'hrda_icl' => $request->hrda_icl,
            'hrda_otj' => $request->hrda_otj,
            'hrda_st' => $request->hrda_st,
            'hrda_ft' => $request->hrda_ft,
        ]);


        return redirect()
            ->route('competency.competency.indexcompetency')
            ->with(
                'success_message',
                'Competency record was successfully updated!'
            );
    }

    public function updateadmincompetency(Request $request)
    {
        $now = Carbon::now();


        $compentencies = CompetencyInfo::select('competency_infos.*')
            ->where('id', $request->id)
            ->update([
                'sd_st_rcl' => $request->sd_st_rcl,
                'sd_ca_rcl' => $request->sd_ca_rcl,
                'sd_po_rcl' => $request->sd_po_rcl,

                'pe_cc_rcl' => $request->pe_cc_rcl,
                'pe_lo_rcl' => $request->pe_lo_rcl,
                'pe_tw_rcl' => $request->pe_tw_rcl,

                'pc_dps_rcl' => $request->pc_dps_rcl,
                'pc_df_rcl' => $request->pc_df_rcl,
                'pc_per_rcl' => $request->pc_per_rcl,

                'oc_pmtd_rcl' => $request->oc_pmtd_rcl,
                'oc_cg_rcl' => $request->oc_cg_rcl,
                'oc_qdcf_rcl' => $request->oc_qdcf_rcl,

                'dadomain' => json_encode($request->dadomain),
                'jpkhasdomain' => json_encode($request->jpkhasdomain),
                'ccddomain' => json_encode($request->ccddomain),
                'dictdomain' => json_encode($request->dictdomain),
                'mkpkdomain' => json_encode($request->mkpkdomain),
                'jppedomain' => json_encode($request->jppedomain),

                'updated_at' => $now,
            ]);


        // to store comp_da_hrd table

        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $hrd_competencies = $request->hrd_competencies;
        $hrd_rcl = $request->hrd_rcl;

        if ($request->hrd_competencies != '' || $request->hrd_rcl != '') {
            for (
                $count_1 = 0;
                $count_1 < count($hrd_competencies);
                $count_1++
            ) {
                $data_1 = [
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                    'hrd_competencies' => $hrd_competencies[$count_1],
                    'hrd_rcl' => $hrd_rcl[$count_1],
                   
                ];

                $insert_data_1[] = $data_1;
            }
            CompDaHrd::insert($insert_data_1);
        }

        // to store comp_da_ot table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $ot_competencies = $request->ot_competencies;
        $ot_rcl = $request->ot_rcl;

        if ($request->ot_competencies != '' || $request->ot_rcl != '') {
            for ($count_2 = 0; $count_2 < count($ot_competencies); $count_2++) {
                $data_2 = [
                    'ot_competencies' => $ot_competencies[$count_2],
                    'ot_rcl' => $ot_rcl[$count_2],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_2[] = $data_2;
            }
            CompDaOt::insert($insert_data_2);
        }

        // to store comp_da_hrm table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $hrm_competencies = $request->hrm_competencies;
        $hrm_rcl = $request->hrm_rcl;

        if ($request->hrm_competencies != '' || $request->hrm_rcl != '') {
            for (
                $count_3 = 0;
                $count_3 < count($hrm_competencies);
                $count_3++
            ) {
                $data_3 = [
                    'hrm_competencies' => $hrm_competencies[$count_3],
                    'hrm_rcl' => $hrm_rcl[$count_3],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_3[] = $data_3;
            }
            CompDaHrm::insert($insert_data_3);
        }

        // to store comp_da_finmaw table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $finmaw_competencies = $request->finmaw_competencies;
        $finmaw_rcl = $request->finmaw_rcl;

        if ($request->finmaw_competencies != '' || $request->finmaw_rcl != '') {
            for (
                $count_4 = 0;
                $count_4 < count($hrd_competencies);
                $count_4++
            ) {
                $data_4 = [
                    'finmaw_competencies' => $finmaw_competencies[$count_4],
                    'finmaw_rcl' => $finmaw_rcl[$count_4],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_4[] = $data_4;
            }
            CompDaFinMaw::insert($insert_data_4);
        }

        // to store comp_da_fsm table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $fsm_competencies = $request->fsm_competencies;
        $fsm_rcl = $request->fsm_rcl;

        if ($request->fsm_competencies != '' || $request->fsm_rcl != '') {
            for (
                $count_5 = 0;
                $count_5 < count($fsm_competencies);
                $count_5++
            ) {
                $data_5 = [
                    'fsm_competencies' => $fsm_competencies[$count_5],
                    'fsm_rcl' => $fsm_rcl[$count_5],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_5[] = $data_5;
            }
            CompDaFsm::insert($insert_data_5);
        }

        // to store comp_da_research table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $research_competencies = $request->research_competencies;
        $research_rcl = $request->research_rcl;

        if (
            $request->research_competencies != '' ||
            $request->research_rcl != ''
        ) {
            for (
                $count_6 = 0;
                $count_6 < count($research_competencies);
                $count_6++
            ) {
                $data_6 = [
                    'research_competencies' => $research_competencies[$count_6],
                    'research_rcl' => $research_rcl[$count_6],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_6[] = $data_6;
            }
            CompDaResearch::insert($insert_data_6);
        }

        // to store comp_da_finam table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $finam_competencies = $request->finam_competencies;
        $finam_rcl = $request->finam_rcl;

        if ($request->finam_competencies != '' || $request->finam_rcl != '') {
            for (
                $count_7 = 0;
                $count_7 < count($finam_competencies);
                $count_7++
            ) {
                $data_7 = [
                    'finam_competencies' => $finam_competencies[$count_7],
                    'finam_rcl' => $finam_rcl[$count_7],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_7[] = $data_7;
            }
            CompDaFinam::insert($insert_data_7);
        }

        // to store comp_da_hse table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $hse_competencies = $request->hse_competencies;
        $hse_rcl = $request->hse_rcl;

        if ($request->hse_competencies != '' || $request->hse_rcl != '') {
            for (
                $count_8 = 0;
                $count_8 < count($hse_competencies);
                $count_8++
            ) {
                $data_8 = [
                    'hse_competencies' => $hse_competencies[$count_8],
                    'hse_rcl' => $hse_rcl[$count_8],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_8[] = $data_8;
            }
            CompDaHse::insert($insert_data_8);
        }

        // to store comp_da_finhse table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $finhse_competencies = $request->finhse_competencies;
        $finhse_rcl = $request->finhse_rcl;

        if ($request->finhse_competencies != '' || $request->finhse_rcl != '') {
            for (
                $count_9 = 0;
                $count_9 < count($finhse_competencies);
                $count_9++
            ) {
                $data_9 = [
                    'finhse_competencies' => $finhse_competencies[$count_9],
                    'finhse_rcl' => $finhse_rcl[$count_9],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_9[] = $data_9;
            }
            CompDaFinHse::insert($insert_data_9);
        }

        // to store comp_da_hseak table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $hseak_competencies = $request->hseak_competencies;
        $hseak_rcl = $request->hseak_rcl;

        if ($request->hseak_competencies != '' || $request->hseak_rcl != '') {
            for (
                $count_10 = 0;
                $count_10 < count($hseak_competencies);
                $count_10++
            ) {
                $data_10 = [
                    'hseak_competencies' => $hseak_competencies[$count_10],
                    'hseak_rcl' => $hseak_rcl[$count_10],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_10[] = $data_10;
            }
            CompDaHseaK::insert($insert_data_10);
        }

        // to store comp_da_finak table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $finak_competencies = $request->finak_competencies;
        $finak_rcl = $request->finak_rcl;

        if ($request->finak_competencies != '' || $request->finak_rcl != '') {
            for (
                $count_11 = 0;
                $count_11 < count($finak_competencies);
                $count_11++
            ) {
                $data_11 = [
                    'finak_competencies' => $finak_competencies[$count_11],
                    'finak_rcl' => $finak_rcl[$count_11],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_11[] = $data_11;
            }
            CompDaFinak::insert($insert_data_2);
        }

        // to store comp_da_trans table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $trans_competencies = $request->trans_competencies;
        $trans_rcl = $request->trans_rcl;

        if ($request->trans_competencies != '' || $request->trans_rcl != '') {
            for (
                $count_12 = 0;
                $count_12 < count($trans_competencies);
                $count_12++
            ) {
                $data_12 = [
                    'trans_competencies' => $trans_competencies[$count_12],
                    'trans_rcl' => $trans_rcl[$count_12],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_12[] = $data_12;
            }
            CompDaTrans::insert($insert_data_12);
        }
        // End DA Specialised Competencie

// LYANNA        
        // to store comp_jpkhas_secc table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $secc_competencies = $request->secc_competencies;
        $secc_rcl = $request->secc_rcl;

        if ($request->secc_competencies != '' || $request->secc_rcl != '') {
            for (
                $count_13 = 0;
                $count_13 < count($secc_competencies);
                $count_13++
            ) {
                $data_13 = [
                    'secc_competencies' => $secc_competencies[$count_13],
                    'secc_rcl' => $secc_rcl[$count_13],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_13[] = $data_13;
            }
            CompJpkhasSecc::insert($insert_data_13);
        }

        // to store comp_jpkhas_sefc table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $sefc_competencies = $request->sefc_competencies;
        $sefc_rcl = $request->sefc_rcl;

        if ($request->sefc_competencies != '' || $request->sefc_rcl != '') {
            for (
                $count_14 = 0;
                $count_14 < count($sefc_competencies);
                $count_14++
            ) {
                $data_14 = [
                    'sefc_competencies' => $sefc_competencies[$count_14],
                    'sefc_rcl' => $sefc_rcl[$count_14],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_14[] = $data_14;
            }
            CompJpkhasSefc::insert($insert_data_14);
        }

        // to store comp_jpkhas_qa table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $qa_competencies = $request->qa_competencies;
        $qa_rcl = $request->qa_rcl;

        if ($request->qa_competencies != '' || $request->qa_rcl != '') {
            for (
                $count_15 = 0;
                $count_15 < count($qa_competencies);
                $count_15++
            ) {
                $data_15 = [
                    'qa_competencies' => $qa_competencies[$count_15],
                    'qa_rcl' => $qa_rcl[$count_15],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_15[] = $data_15;
            }
            CompJpkhasQa::insert($insert_data_15);
        }

        // to store comp_ccd_pr table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $pr_competencies = $request->pr_competencies;
        $pr_rcl = $request->pr_rcl;

        if ($request->pr_competencies != '' || $request->pr_rcl != '') {
            for (
                $count_16 = 0;
                $count_16 < count($pr_competencies);
                $count_16++
            ) {
                $data_16 = [
                    'pr_competencies' => $pr_competencies[$count_16],
                    'pr_rcl' => $pr_rcl[$count_16],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_16[] = $data_16;
            }
            CompCcdPr::insert($insert_data_16);
        }

        // to store comp_dict_itin table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $itin_competencies = $request->itin_competencies;
        $itin_rcl = $request->itin_rcl;

        if ($request->itin_competencies != '' || $request->itin_rcl != '') {
            for (
                $count_17 = 0;
                $count_17 < count($itin_competencies);
                $count_17++
            ) {
                $data_17 = [
                    'itin_competencies' => $itin_competencies[$count_17],
                    'itin_rcl' => $itin_rcl[$count_17],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_17[] = $data_17;
            }
            CompDictItin::insert($insert_data_17);
        }

        // to store comp_dict_itsm table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $itsm_competencies = $request->itsm_competencies;
        $itsm_rcl = $request->itsm_rcl;

        if ($request->itsm_competencies != '' || $request->itsm_rcl != '') {
            for (
                $count_18 = 0;
                $count_18 < count($itsm_competencies);
                $count_18++
            ) {
                $data_18 = [
                    'itsm_competencies' => $itsm_competencies[$count_18],
                    'itsm_rcl' => $itsm_rcl[$count_18],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_18[] = $data_18;
            }
            CompDictItsm::insert($insert_data_18);
        }

        // to store comp_dict_ito table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $ito_competencies = $request->ito_competencies;
        $ito_rcl = $request->ito_rcl;

        if ($request->ito_competencies != '' || $request->ito_rcl != '') {
            for (
                $count_19 = 0;
                $count_19 < count($ito_competencies);
                $count_19++
            ) {
                $data_19 = [
                    'ito_competencies' => $ito_competencies[$count_19],
                    'ito_rcl' => $ito_rcl[$count_19],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_19[] = $data_19;
            }
            CompDictIto::insert($insert_data_19);
        }

        // to store comp_dict_its table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $its_competencies = $request->its_competencies;
        $its_rcl = $request->its_rcl;

        if ($request->its_competencies != '' || $request->its_rcl != '') {
            for (
                $count_20 = 0;
                $count_20 < count($its_competencies);
                $count_20++
            ) {
                $data_20 = [
                    'its_competencies' => $its_competencies[$count_20],
                    'its_rcl' => $its_rcl[$count_20],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_20[] = $data_20;
            }
            CompDictIts::insert($insert_data_20);
        }

// to store comp_mkpk_qa table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $mkpkqa_competencies = $request->mkpkqa_competencies;
        $mkpkqa_rcl = $request->mkpkqa_rcl;

        if ($request->mkpkqa_competencies != '' || $request->mkpkqa_rcl != '') {
            for (
                $count_21 = 0;
                $count_21 < count($mkpkqa_competencies);
                $count_21++
            ) {
                $data_21 = [
                    'mkpkqa_competencies' => $mkpkqa_competencies[$count_21],
                    'mkpkqa_rcl' => $mkpkqa_rcl[$count_21],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_21[] = $data_21;
            }
            CompMkpkQa::insert($insert_data_21);
        }

// to store comp_mkpk_csm table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $csm_competencies = $request->csm_competencies;
        $csm_rcl = $request->csm_rcl;

        if ($request->csm_competencies != '' || $request->csm_rcl != '') {
            for (
                $count_22 = 0;
                $count_22 < count($csm_competencies);
                $count_22++
            ) {
                $data_22 = [
                    'csm_competencies' => $csm_competencies[$count_22],
                    'csm_rcl' => $csm_rcl[$count_22],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_22[] = $data_22;
            }
            CompMkpkCsm::insert($insert_data_22);
        }

// to store comp_mkpk_dm table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $dm_competencies = $request->dm_competencies;
        $dm_rcl = $request->dm_rcl;

        if ($request->dm_competencies != '' || $request->dm_rcl != '') {
            for (
                $count_23 = 0;
                $count_23 < count($dm_competencies);
                $count_23++
            ) {
                $data_23 = [
                    'dm_competencies' => $dm_competencies[$count_23],
                    'dm_rcl' => $dm_rcl[$count_23],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_23[] = $data_23;
            }
            CompMkpkDm::insert($insert_data_23);
        }

// to store comp_mkpk_hr table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $hr_competencies = $request->hr_competencies;
        $hr_rcl = $request->hr_rcl;

        if ($request->hr_competencies != '' || $request->hr_rcl != '') {
            for (
                $count_24 = 0;
                $count_24 < count($hr_competencies);
                $count_24++
            ) {
                $data_24 = [
                    'hr_competencies' => $hr_competencies[$count_24],
                    'hr_rcl' => $hr_rcl[$count_24],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_24[] = $data_24;
            }
            CompMkpkHr::insert($insert_data_24);
        }

// to store comp_mkpk_as table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $as_competencies = $request->as_competencies;
        $as_rcl = $request->as_rcl;

        if ($request->as_competencies != '' || $request->as_rcl != '') {
            for (
                $count_25 = 0;
                $count_25 < count($as_competencies);
                $count_25++
            ) {
                $data_25 = [
                    'as_competencies' => $as_competencies[$count_25],
                    'as_rcl' => $as_rcl[$count_25],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_25[] = $data_25;
            }
            CompMkpkAs::insert($insert_data_25);
        }

// to store comp_jppe_e table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $e_competencies = $request->e_competencies;
        $e_rcl = $request->e_rcl;

        if ($request->e_competencies != '' || $request->e_rcl != '') {
            for (
                $count_26 = 0;
                $count_26 < count($e_competencies);
                $count_26++
            ) {
                $data_26 = [
                    'e_competencies' => $e_competencies[$count_26],
                    'e_rcl' => $e_rcl[$count_26],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_26[] = $data_26;
            }
            CompJppeE::insert($insert_data_26);
        }

// to store comp_jppe_em table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $em_competencies = $request->em_competencies;
        $em_rcl = $request->em_rcl;

        if ($request->em_competencies != '' || $request->em_rcl != '') {
            for (
                $count_27 = 0;
                $count_27 < count($em_competencies);
                $count_27++
            ) {
                $data_27 = [
                    'em_competencies' => $em_competencies[$count_27],
                    'em_rcl' => $em_rcl[$count_27],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_27[] = $data_27;
            }
            CompJppeEm::insert($insert_data_27);
        }

// to store comp_jppe_fmmaw table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $fmmaw_competencies = $request->fmmaw_competencies;
        $fmmaw_rcl = $request->fmmaw_rcl;

        if ($request->fmmaw_competencies != '' || $request->fmmaw_rcl != '') {
            for (
                $count_28 = 0;
                $count_28 < count($fmmaw_competencies);
                $count_28++
            ) {
                $data_28 = [
                    'fmmaw_competencies' => $fmmaw_competencies[$count_28],
                    'fmmaw_rcl' => $fmmaw_rcl[$count_28],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_28[] = $data_28;
            }
            CompJppeFmmaw::insert($insert_data_28);
        }

// to store comp_jppe_hrda table
        $id = $request->id;
        $indv_icno = $request->indv_icno;
        $hrda_competencies = $request->hrda_competencies;
        $hrda_rcl = $request->hrda_rcl;

        if ($request->hrda_competencies != '' || $request->hrda_rcl != '') {
            for (
                $count_29 = 0;
                $count_29 < count($hrda_competencies);
                $count_29++
            ) {
                $data_29 = [
                    'hrda_competencies' => $hrda_competencies[$count_29],
                    'hrda_rcl' => $hrda_rcl[$count_29],
                    'competency_info_id' => $id,
                    'indv_icno' => $indv_icno,
                ];

                $insert_data_29[] = $data_29;
            }
            CompJppeHrda::insert($insert_data_29);
        }

        return redirect()
            ->route('competency.competency.indexadmincompetency')
            ->with(
                'success_message',
                'Competency record was successfully updated!'
            );
    }

     public function updatesupervisorcompetency(Request $request)
    {
        $now = Carbon::now();

        $compentencies = CompetencyInfo::select('competency_infos.*')
            ->where('id', $request->id)
            ->update([
                'sd_st_evd' => $request->sd_st_evd,
                'sd_ca_evd' => $request->sd_ca_evd,
                'sd_po_evd' => $request->sd_po_evd,
                'sd_st_outcome' => $request->sd_st_outcome,
                'sd_ca_outcome' => $request->sd_ca_outcome,
                'sd_po_outcome' => $request->sd_po_outcome,
                'sd_st_sl' => $request->sd_st_sl,
                'sd_ca_sl' => $request->sd_ca_sl,
                'sd_po_sl' => $request->sd_po_sl,
                'sd_st_ft' => $request->sd_st_ft,
                'sd_ca_ft' => $request->sd_ca_ft,
                'sd_po_ft' => $request->sd_po_ft,
                'sd_st_otj' => $request->sd_st_otj,
                'sd_ca_otj' => $request->sd_ca_otj,
                'sd_po_otj' => $request->sd_po_otj,

                'pe_cc_evd' => $request->pe_cc_evd,
                'pe_lo_evd' => $request->pe_lo_evd,
                'pe_tw_evd' => $request->pe_tw_evd,
                'pe_cc_outcome' => $request->pe_cc_outcome,
                'pe_lo_outcome' => $request->pe_lo_outcome,
                'pe_tw_outcome' => $request->pe_tw_outcome,
                'pe_cc_sl' => $request->pe_cc_sl,
                'pe_lo_sl' => $request->pe_lo_sl,
                'pe_tw_sl' => $request->pe_tw_sl,
                'pe_cc_ft' => $request->pe_cc_ft,
                'pe_lo_ft' => $request->pe_lo_ft,
                'pe_tw_ft' => $request->pe_tw_ft,
                'pe_cc_otj' => $request->pe_cc_otj,
                'pe_lo_otj' => $request->pe_lo_otj,
                'pe_tw_otj' => $request->pe_tw_otj,

                'pc_dps_evd' => $request->pc_dps_evd,
                'pc_df_evd' => $request->pc_dps_evd,
                'pc_per_evd' => $request->pc_per_evd,
                'pc_dps_outcome' => $request->pc_dps_outcome,
                'pc_df_outcome' => $request->pc_df_outcome,
                'pc_per_outcome' => $request->pc_per_outcome,
                'pc_dps_sl' => $request->pc_dps_sl,
                'pc_df_sl' => $request->pc_df_sl,
                'pc_per_sl' => $request->pc_per_sl,
                'pc_dps_ft' => $request->pc_dps_ft,
                'pc_df_ft' => $request->pc_df_ft,
                'pc_per_ft' => $request->pc_per_ft,
                'pc_dps_otj' => $request->pc_dps_otj,
                'pc_df_otj' => $request->pc_df_otj,
                'pc_per_otj' => $request->pc_per_otj,

                'oc_pmtd_evd' => $request->oc_pmtd_evd,
                'oc_cg_evd' => $request->oc_cg_evd,
                'oc_qdcf_evd' => $request->oc_qdcf_evd,
                'oc_pmtd_outcome' => $request->oc_pmtd_outcome,
                'oc_cg_outcome' => $request->oc_cg_outcome,
                'oc_qdcf_outcome' => $request->oc_qdcf_outcome,
                'oc_pmtd_sl' => $request->oc_pmtd_sl,
                'oc_cg_sl' => $request->oc_cg_sl,
                'oc_qdcf_sl' => $request->oc_qdcf_sl,
                'oc_pmtd_ft' => $request->oc_pmtd_ft,
                'oc_cg_ft' => $request->oc_cg_ft,
                'oc_qdcf_ft' => $request->oc_qdcf_ft,
                'oc_pmtd_otj' => $request->oc_pmtd_otj,
                'oc_cg_otj' => $request->oc_cg_otj,
                'oc_qdcf_otj' => $request->oc_qdcf_otj,
                'updated_at' => $now,
            ]);


            
         

        // Start DA Specialised Competencie

        // to store comp_da_hrd table
        $compdahrds = CompDaHrd::select('comp_da_hrd.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'hrd_evd' => $request->hrd_evd,
                'hrd_outcome' => $request->hrd_outcome,
                'hrd_otj' => $request->hrd_otj,
                'hrd_st' => $request->hrd_st,
                'hrd_ft' => $request->hrd_ft,
            ]);

        $compdaots = CompDaOt::select('comp_da_ot.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'ot_evd' => $request->ot_evd,
                'ot_outcome' => $request->ot_outcome,
                'ot_otj' => $request->ot_otj,
                'ot_st' => $request->ot_st,
                'ot_ft' => $request->ot_ft,
            ]);

        $compdahrms = CompDaHrm::select('comp_da_hrm.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'hrm_evd' => $request->hrm_evd,
                'hrm_outcome' => $request->hrm_outcome,
                'hrm_otj' => $request->hrm_otj,
                'hrm_st' => $request->hrm_st,
                'hrm_ft' => $request->hrm_ft,
            ]);

        $compdafinmaws = CompDaFinMaw::select('comp_da_finmaw.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'finmaw_evd' => $request->finmaw_evd,
                'finmaw_outcome' => $request->finmaw_outcome,
                'finmaw_otj' => $request->finmaw_otj,
                'finmaw_st' => $request->finmaw_st,
                'finmaw_ft' => $request->finmaw_ft,
            ]);

        $compdafsms = CompDaFsm::select('comp_da_fsm.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'fsm_evd' => $request->fsm_evd,
                'fsm_outcome' => $request->fsm_outcome,
                'fsm_otj' => $request->fsm_otj,
                'fsm_st' => $request->fsm_st,
                'fsm_ft' => $request->fsm_ft,
            ]);

        $compdaresearchs = CompDaResearch::select('comp_da_research.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'research_evd' => $request->research_evd,
                'research_outcome' => $request->research_outcome,
                'research_otj' => $request->research_otj,
                'research_st' => $request->research_st,
                'research_ft' => $request->research_ft,
            ]);

        $compdafinams = CompDaFinam::select('comp_da_finam.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'finam_evd' => $request->finam_evd,
                'finam_outcome' => $request->finam_outcome,
                'finam_otj' => $request->finam_otj,
                'finam_st' => $request->finam_st,
                'finam_ft' => $request->finam_ft,
            ]);

        $compdahses = CompDaHse::select('comp_da_hse.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'hse_evd' => $request->hse_evd,
                'hse_outcome' => $request->hse_outcome,
                'hse_otj' => $request->hse_otj,
                'hse_st' => $request->hse_st,
                'hse_ft' => $request->hse_ft,
            ]);

        $compdafinhses = CompDaFinHse::select('comp_da_finhse.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'finhse_evd' => $request->finhse_evd,
                'finhse_outcome' => $request->finhse_outcome,
                'finhse_otj' => $request->finhse_otj,
                'finhse_st' => $request->finhse_st,
                'finhse_ft' => $request->finhse_ft,
            ]);

        $compdahseaks = CompDaHseak::select('comp_da_hseak.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'hseak_evd' => $request->hseak_evd,
                'hseak_outcome' => $request->hseak_outcome,
                'hseak_otj' => $request->hseak_otj,
                'hseak_st' => $request->hseak_st,
                'hseak_ft' => $request->hseak_ft,
            ]);

        $compdafinaks = CompDaFinak::select('comp_da_finak.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'finak_evd' => $request->finak_evd,
                'finak_outcome' => $request->finak_outcome,
                'finak_otj' => $request->finak_otj,
                'finak_st' => $request->finak_st,
                'finak_ft' => $request->finak_ft,
            ]);

        $compdatranss = CompDaTrans::select('comp_da_trans.*')
            ->where('competency_info_id', $request->id)
            ->update([
                'trans_evd' => $request->trans_evd,
                'trans_outcome' => $request->trans_outcome,
                'trans_otj' => $request->trans_otj,
                'trans_st' => $request->trans_st,
                'trans_ft' => $request->trans_ft,
            ]);

//Start JPKhas Specialised Competencies
        $compjpkhasseccs = CompJpkhasSecc::select('comp_jpkhas_secc.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'secc_evd' => $request->secc_evd,
            'secc_outcome' => $request->secc_outcome,
            'secc_otj' => $request->secc_otj,
            'secc_st' => $request->secc_st,
            'secc_ft' => $request->secc_ft,
        ]);

        $compjpkhassefcs = CompJpkhasSefc::select('comp_jpkhas_sefc.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'sefc_evd' => $request->sefc_evd,
            'sefc_outcome' => $request->sefc_outcome,
            'sefc_otj' => $request->sefc_otj,
            'sefc_st' => $request->sefc_st,
            'sefc_ft' => $request->sefc_ft,
        ]);
            
        $compjpkhasqas = CompJpkhasQa::select('comp_jpkhas_qa.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'qa_evd' => $request->qa_evd,
            'qa_outcome' => $request->qa_outcome,
            'qa_otj' => $request->qa_otj,
            'qa_st' => $request->qa_st,
            'qa_ft' => $request->qa_ft,
        ]);


//Start CCD Specialised Competencies
        $compccdprs = CompCcdPr::select('comp_ccd_pr.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'pr_evd' => $request->pr_evd,
            'pr_outcome' => $request->pr_outcome,
            'pr_otj' => $request->pr_otj,
            'pr_st' => $request->pr_st,
            'pr_ft' => $request->pr_ft,
        ]);

//Start DICT Specialised Competencies
        $compdictitins = CompDictItin::select('comp_dict_itin.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'itin_evd' => $request->itin_evd,
            'itin_outcome' => $request->itin_outcome,
            'itin_otj' => $request->itin_otj,
            'itin_st' => $request->itin_st,
            'itin_ft' => $request->itin_ft,
        ]);

        $compdictitsms = CompDictItsm::select('comp_dict_itsm.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'itsm_evd' => $request->itsm_evd,
            'itsm_outcome' => $request->itsm_outcome,
            'itsm_otj' => $request->itsm_otj,
            'itsm_st' => $request->itsm_st,
            'itsm_ft' => $request->itsm_ft,
        ]);

        $compdictitos = CompDictIto::select('comp_dict_ito.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'ito_evd' => $request->ito_evd,
            'ito_outcome' => $request->ito_outcome,
            'ito_otj' => $request->ito_otj,
            'ito_st' => $request->ito_st,
            'ito_ft' => $request->ito_ft,
        ]);

        $compdictitss = CompDictIts::select('comp_dict_its.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'its_evd' => $request->its_evd,
            'its_outcome' => $request->its_outcome,
            'its_otj' => $request->its_otj,
            'its_st' => $request->its_st,
            'its_ft' => $request->its_ft,
        ]);

//Start MKPK Specialised Competencies
        $compmkpkqas = CompMkpkQa::select('comp_mkpk_qa.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'mkpkqa_evd' => $request->mkpkqa_evd,
            'mkpkqa_outcome' => $request->mkpkqa_outcome,
            'mkpkqa_otj' => $request->mkpkqa_otj,
            'mkpkqa_st' => $request->mkpkqa_st,
            'mkpkqa_ft' => $request->mkpkqa_ft,
        ]);

        $compmkpkcsms = CompMkpkCsm::select('comp_mkpk_csm.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'csm_evd' => $request->csm_evd,
            'csm_outcome' => $request->csm_outcome,
            'csm_otj' => $request->csm_otj,
            'csm_st' => $request->csm_st,
            'csm_ft' => $request->csm_ft,
        ]);

        $compmkpkdms = CompMkpkDm::select('comp_mkpk_dm.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'dm_evd' => $request->dm_evd,
            'dm_outcome' => $request->dm_outcome,
            'dm_otj' => $request->dm_otj,
            'dm_st' => $request->dm_st,
            'dm_ft' => $request->dm_ft,
        ]);

        $compmkpkhrs = CompMkpkHr::select('comp_mkpk_hr.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'hr_evd' => $request->hr_evd,
            'hr_outcome' => $request->hr_outcome,
            'hr_otj' => $request->hr_otj,
            'hr_st' => $request->hr_st,
            'hr_ft' => $request->hr_ft,
        ]);

        $compmkpkass = CompMkpkAs::select('comp_mkpk_as.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'as_evd' => $request->as_evd,
            'as_outcome' => $request->as_outcome,
            'as_otj' => $request->as_otj,
            'as_st' => $request->as_st,
            'as_ft' => $request->as_ft,
        ]);

//Start JPPE Specialised Competencies
        $compjppees = CompJppeE::select('comp_jppe_e.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'e_evd' => $request->e_evd,
            'e_outcome' => $request->e_outcome,
            'e_otj' => $request->e_otj,
            'e_st' => $request->e_st,
            'e_ft' => $request->e_ft,
        ]);

        $compjppeems = CompJppeEm::select('comp_jppe_em.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'em_evd' => $request->em_evd,
            'em_outcome' => $request->em_outcome,
            'em_otj' => $request->em_otj,
            'em_st' => $request->em_st,
            'em_ft' => $request->em_ft,
        ]);        

        $compjppefmmaws = CompJppeFmmaw::select('comp_jppe_fmmaw.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'fmmaw_evd' => $request->fmmaw_evd,
            'fmmaw_outcome' => $request->fmmaw_outcome,
            'fmmaw_otj' => $request->fmmaw_otj,
            'fmmaw_st' => $request->fmmaw_st,
            'fmmaw_ft' => $request->fmmaw_ft,
        ]);        

        $compjppehrdas = CompJppeHrda::select('comp_jppe_hrda.*')
        ->where('competency_info_id', $request->id)
        ->update([
            'hrda_evd' => $request->hrda_evd,
            'hrda_outcome' => $request->hrda_outcome,
            'hrda_otj' => $request->hrda_otj,
            'hrda_st' => $request->hrda_st,
            'hrda_ft' => $request->hrda_ft,
        ]);

        return redirect()
            ->route('competency.competency.indexcompetency')
            ->with(
                'success_message',
                'Competency record was successfully updated!'
            );
    }


    public function search(Request $request, $id)
    {
        $idd = $request->ic_search;

        $icNos = Auth::user()->ic_no;

        $biodatasearchs = Biodata::all()->where('ic_no', '=', $idd);

        $employmentsearchs = Employment::all()->where('ic_no', '=', $idd);

        $biodatas = Biodata::all()->where('ic_no', '=', $icNos);

        $employments = Employment::all()->where('ic_no', '=', $icNos);

        $competencies = CompetencyInfo::all()->where('indv_icno', '=', $icNos);

        $dadomains = DaDomain::pluck('label', 'id')->all();
        $jpkhasdomains = JPKhasDomain::pluck('label', 'id')->all();
        $ccddomains = CcdDomain::pluck('label', 'id')->all();
        $dictdomains = DictDomain::pluck('label', 'id')->all();
        $mkpkdomains = MkpkDomain::pluck('label', 'id')->all();
        $jppedomains = JppeDomain::pluck('label', 'id')->all();        

        
        // Start DA Specialised Competencie
        // Start Specialised Competencie
        $compdahrds = CompDaHrd::select('comp_da_hrd.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdaots = CompDaOt::select('comp_da_ot.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahrms = CompDaHrm::select('comp_da_hrm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinmaws = CompDaFinMaw::select('comp_da_finmaw.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafsms = CompDaFsm::select('comp_da_fsm.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdaresearchs = CompDaResearch::select('comp_da_research.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinams = CompDaFinam::select('comp_da_finam.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahses = CompDaHse::select('comp_da_hse.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinhses = CompDaFinHse::select('comp_da_finhse.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdahseaks = CompDaHseak::select('comp_da_hseak.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdafinaks = CompDaFinak::select('comp_da_finak.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

        $compdatranss = CompDaTrans::select('comp_da_trans.*')
            ->where([['competency_info_id', '=', $id]])
            ->get();

//Start JPKhas Specialised Competencies
        $compjpkhasseccs = CompJpkhasSecc::select('comp_jpkhas_secc.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjpkhassefcs = CompJpkhasSefc::select('comp_jpkhas_sefc.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();
            
        $compjpkhasqas = CompJpkhasQa::select('comp_jpkhas_qa.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

//Start CCD Specialised Competencies
        $compccdprs = CompCcdPr::select('comp_ccd_pr.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();        

//Start DICT Specialised Competencies
        $compdictitins = CompDictItin::select('comp_dict_itin.*')
        ->where([['competency_info_id', '=', $id]])
        ->get(); 

        $compdictitsms = CompDictItsm::select('comp_dict_itsm.*')
        ->where([['competency_info_id', '=', $id]])
        ->get(); 

        $compdictitos = CompDictIto::select('comp_dict_ito.*')
        ->where([['competency_info_id', '=', $id]])
        ->get(); 

        $compdictitss = CompDictIts::select('comp_dict_its.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();      

//Start MKPK Specialised Competencies
        $compmkpkqas = CompMkpkQa::select('comp_mkpk_qa.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compmkpkcsms = CompMkpkCsm::select('comp_mkpk_csm.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compmkpkdms = CompMkpkDm::select('comp_mkpk_dm.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();
            
        $compmkpkhrs = CompMkpkHr::select('comp_mkpk_hr.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();
            
        $compmkpkass = CompMkpkAs::select('comp_mkpk_as.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();            

//Start JPPE Specialised Competencies
        $compjppees = CompJppeE::select('comp_jppe_e.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppeems = CompJppeEm::select('comp_jppe_em.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppefmmaws = CompJppeFmmaw::select('comp_jppe_fmmaw.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();

        $compjppehrdas = CompJppeHrda::select('comp_jppe_hrda.*')
        ->where([['competency_info_id', '=', $id]])
        ->get();


        return view(
            'competency.editcompetencysearch',
            compact(
                'biodatas',
                'id',
                'employments',
                'biodatasearchs',
                'employmentsearchs',
                'competencies',
                'dadomains',
                'jpkhasdomains',
                'ccddomains',
                'dictdomains',
                'mkpkdomains', 'jppedomains',                
               
                'compdahrds',
                'compdaots',
                'compdahrms',
                'compdafinmaws',
                'compdafsms',
                'compdaresearchs',
                'compdafinams',
                'compdahses',
                'compdafinhses',
                'compdahseaks',
                'compdafinaks',
                'compdatranss',

                'compjpkhasseccs',
                'compjpkhassefcs',
                'compjpkhasqas',

                'compccdprs',

                'compdictitins',
                'compdictitsms',
                'compdictitos',
                'compdictitss',

                'compmkpkqas','compmkpkcsms','compmkpkdms','compmkpkhrs','compmkpkass',

                'compjppees','compjppeems','compjppefmmaws','compjppehrdas'
            )
        );
    }

    public function adminsearchIC(Request $request)
    {
        $id = $request->ic_search;

        $biodatas = Biodata::all()->where('ic_no', '=', $id);

        $employments = Employment::all()->where('ic_no', '=', $id);

        $salarys = Salary::all()->where('ic_no', '=', $id);

        $dadomains = DaDomain::pluck('label', 'id')->all();
        $jpkhasdomains = JPKhasDomain::pluck('label', 'id')->all();
        $ccddomains = CcdDomain::pluck('label', 'id')->all();
        $dictdomains = DictDomain::pluck('label', 'id')->all();
        $mkpkdomains = MkpkDomain::pluck('label', 'id')->all();
        $jppedomains = JppeDomain::pluck('label', 'id')->all();

        $competencies = CompetencyInfo::all()->where('id', '=', $id);

        return view(
            'competency.adminindividualcompetencysearch',
            compact(
                'biodatas',
                'employments',
                'salarys',
                'dadomains',
                'jpkhasdomains',
                'ccddomains',
                'dictdomains',
                'mkpkdomains',
                'jppedomains',
                'competencies'
            )
        );
    }

    public function collabratorsearchIC($id, Request $request)
    {
        $id1 = $request->ic_search;

        $biodatas = Biodata::all()->where('ic_no', '=', $id1);

        $competencies = CompetencyInfo::all()->where('id', '=', $id);

        return view(
            'competency.collabratorcompetencysearch',
            compact('biodatas', 'competencies')
        );
    }

    public function supervisorcompetency()
    {

        return view('competency.supervisorcompetency');
    }

    public function adminIndividualcompetency()
    {
        // $competenciesdomain = CompetencyDomain::pluck('label', 'id')->all();

        return view('competency.adminIndividualcompetency');
    }

    public function destroyadmincompetency($id)
    {
        try {
            $competencies = CompetencyInfo::where('id', $id)->delete();

            return redirect()
                ->route('competency.competency.indexadmincompetency')
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }

    public function destroycompetncy($id)
    {
        try {
            $competencies = CompetencyInfo::where('id', $id)->delete();

            return redirect()
                ->route('competency.competency.indexcompetency')
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }

    public function destroysupervisorcompetency($id)
    {
        try {
            $competencies = CompetencyInfo::where('id', $id)->delete();

            return redirect()
                ->route('competency.competency.indexsupervisorcompetency')
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }


    // Destroy File
    
    public function destroycompetencyfile($id)
    {
        try {
         
            $competencyfiles = CompetencyFile::where('id', $id)->delete();

            return redirect()
                ->route('competency.competency.indexcompetency')
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
       
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }

// Destroy DA

    public function destroycompdahrd($id)
    {
        try {
         
            $compdahrds = CompDaHrd::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
       
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }
    public function destroycompdaot($id)
    {
        try {
            $compdaots = CompDaOt::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }

    public function destroycompdahrm($id)
    {
        try {
            $compdahrms = CompDaHrm::where('id', $id)->delete();

            return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }

    public function destroycompdafinmaw($id)
    {
        try {
            $compdafinmaws = CompDaFiMaw::where('id', $id)->delete();

          return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }

    public function destroycompdafsm($id)
    {
        try {
            $compdafsms = CompDaFsm::where('id', $id)->delete();

          return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }

    public function destroycompdaresearch($id)
    {
        try {
            $compdaresearchs = CompDaResearch::where('id', $id)->delete();

            return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }

    public function destroycompdafinam($id)
    {
        try {
            $compdafinams = CompDaFinam::where('id', $id)->delete();

           return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }

    public function destroycompdahse($id)
    {
        try {
            $compdahses = CompDaHse::where('id', $id)->delete();

            return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }
    public function destroycompdafinhse($id)
    {
        try {
            $compdafinhses = CompDaFinHse::where('id', $id)->delete();

            return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }

    public function destroycompdahseak($id)
    {
        try {
            $compdahseaks = CompDaHseak::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }

    public function destroycompdafinak($id)
    {
        try {
            $compdafinaks = CompDaFinak::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }

    public function destroycompdatrans($id)
    {
        try {
            $compdatranss = CompDaTrans::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }

// LYANNA    
    public function destroycompjpkhassecc($id)
    {
        try {
            $compjpkhasseccs = CompJpkhasSecc::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }

    public function destroycompjpkhassefc($id)
    {
        try {
            $compjpkhassefcs = CompJpkhasSefc::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }    

    public function destroycompjpkhasqa($id)
    {
        try {
            $compjpkhasqas = CompJpkhasQa::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }    

    public function destroycompccdpr($id)
    {
        try {
            $compccdprs = CompCcdPr::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    } 

    public function destroycompdictitin($id)
    {
        try {
            $compdictitins = CompDictItin::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }     

    public function destroycompdictitsm($id)
    {
        try {
            $compdictitsms = CompDictItsm::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    } 

    public function destroycompdictito($id)
    {
        try {
            $compdictitos = CompDictIto::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }     

    public function destroycompdictits($id)
    {
        try {
            $compdictitss = CompDictIts::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }    

    public function destroycompmkpkqa($id)
    {
        try {
            $compmkpkqas = CompMkpkQa::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }    

    public function destroycompmkpkcsm($id)
    {
        try {
            $compmkpkcsms = CompMkpkCsm::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }    

    public function destroycompmkpkdm($id)
    {
        try {
            $compmkpkdms = CompMkpkDm::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    }    

    public function destroycompmkpkhr($id)
    {
        try {
            $compmkpkhrs = CompMkpkHr::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    } 

    public function destroycompmkpkas($id)
    {
        try {
            $compmkpkass = CompMkpkAs::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    } 

    public function destroycompjppees($id)
    {
        try {
            $compjppees = CompJppeE::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    } 

    public function destroycompjppeems($id)
    {
        try {
            $compjppeems = CompJppeEm::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    } 

    public function destroycompjppefmmaws($id)
    {
        try {
            $compjppefmmaws = CompJppeFmmaw::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    } 

    public function destroycompjppehrdas($id)
    {
        try {
            $compjppehrdas = CompJppeHrda::where('id', $id)->delete();

             return redirect()->back()
                ->with(
                    'success_message',
                    'Competency was successfully deleted!'
                );
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->withErrors([
                    'unexpected_error' =>
                        'Unexpected error occurred while trying to process your request!',
                ]);
        }
    } 

 
}