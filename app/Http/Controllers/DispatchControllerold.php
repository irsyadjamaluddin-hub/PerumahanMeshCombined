<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use App\Models\VaccinationDose;

use App\Models\Dispatch;
use App\Models\Mecuser;

use Illuminate\Http\Request;
use App\Models\Dispatchfile;

use App\Models\DispatchPassMec;


use App\Models\Kepada;
use App\Models\Jenis;
use App\Models\Action;
use App\Models\Daripada;
use App\Models\Correspondence;

use Log;
use Carbon\Carbon;

class DispatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dispatchs = Dispatch::select('dispatch_infos.*')
            ->orderBy('created_at', 'DESC')
            ->get();
            
        $kepada = Kepada::pluck('label', 'id')->all();

 $kpds = Kepada::pluck('label', 'id')->all();



        return view('dispatchs.index', compact('dispatchs','kepada','kpds'));
    }

    public function indexadmin()
    {


        $dispatchs = Dispatch::select('dispatch_infos.*')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('dispatchs.indexadmin', compact('dispatchs'));
    }



    public function indextindakan()
    {
        // $icNos = Auth::user()->ic_no;

        $dispatchs = Dispatch::select('dispatch_infos.*')

            ->get();

        $dispatchpassmecs = DispatchPassMec::select('dispatch_pass_mecs.*')
            ->orderBy('created_at', 'DESC')
            ->get();







        return view('dispatchs.indextindakan', compact( 'dispatchs',  'dispatchpassmecs' ));
    }

    public function terima($id)
    {
        $dispatchs = Dispatch::findOrFail($id);
        $dispatchs->update(['dispatch_recieved_at' => now()]);

        return redirect()->route('dispatchs.dis.indexadmin')
            ->with('success_message', 'Dispatch Recieved successfully');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();

        return view('dispatchs.create', compact('kepada', 'jenis', 'daripada'));
    }

    public function createmec()
    {
        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();

        $tindakan = Mecuser::pluck('unit', 'id')->all();


        return view('dispatchs.createmec', compact('kepada', 'jenis', 'daripada', 'tindakan'));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $icNos = Auth::user()->ic_no;

        $Dispatch = new Dispatch;

        $Dispatch->ic_no = $icNos;
        $Dispatch->jns = $request->jns;
        $Dispatch->daripada = $request->daripada;
        $Dispatch->kpd = json_encode($request->kpd);
        $Dispatch->up = $request->up;
        $Dispatch->perkara = $request->perkara;
        $Dispatch->rp = $request->rp;
        $Dispatch->rm = $request->rm;
        $Dispatch->lamp = $request->lamp->getClientOriginalName();
        $Dispatch->dis_filename = $request->file('lamp')->store('Dispatch', 'public');
        $Dispatch->catt = $request->catt;

        // Save 'Dispatch' data
        $Dispatch->save();

        return redirect()->route('dispatchs.dis.index')
            ->with('success_message', 'New dispatch record was successfully added!');
    }

    public function store2(Request $request)
    {

        foreach ($request->moreFields as $key => $value) {
            mecuser::create($value);
        }

        return redirect()->route('dispatchs.dis.mecuser')
            ->with('success_message', 'New Data record was successfully added!');
    }

    public function storemec(Request $request)
    {
        $icNos = Auth::user()->ic_no;

        $Dispatch = new Dispatch;

        $Dispatch->ic_no = $icNos;
        $Dispatch->jns = $request->jns;
        $Dispatch->daripada = $request->daripada;
        $Dispatch->kpd = $request->kpd;
        $Dispatch->up = $request->up;
        $Dispatch->perkara = $request->perkara;
        $Dispatch->rp = $request->rp;
        $Dispatch->rm = $request->rm;
        $Dispatch->lamp = $request->lamp->getClientOriginalName();
        $Dispatch->dis_filename = $request->file('lamp')->store('Dispatch', 'public');
        $Dispatch->catt = $request->catt;
        $Dispatch->date_process = $request->date_process;
        $Dispatch->date_close = $request->date_close;
        $Dispatch->no_folio = $request->no_folio;
        $Dispatch->catatan_admin = $request->catatan_admin;
        $Dispatch->tindakan = $request->tindakan;

        // Save 'Dispatch' data
        $Dispatch->save();

        return redirect()->route('dispatchs.dis.indextindakan')
            ->with('success_message', 'New dispatch record was successfully added!');
    }

    public function edit($id)
    {

        $dispatchs = Dispatch::all()
            ->where('id', '=', $id);

        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();


        return view('dispatchs.edit', compact('dispatchs', 'kepada', 'jenis', 'daripada'));
    }

    public function editadmin($id)
    {
        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();

        $tindakan = Mecuser::pluck('unit', 'id')->all();

        $dispatchs = Dispatch::all()
            ->where('id', '=', $id);

        $dispatchfiles = Dispatchfile::select('dispatch_files.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['dispatch_infos_id', '=', $id]
            ])
            ->get();

        return view('dispatchs.editadmin', compact('tindakan', 'kepada', 'jenis', 'daripada', 'dispatchs', 'dispatchfiles'));
    }


    public function show($id)
    {

        // $dispatchs = Dispatch::all()->where('id', '=', $id)->first();




        $dispatchs = Dispatch::all()->where('id', '=', $id);



        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();

        $dispatchfiles = Dispatchfile::select('dispatch_files.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['dispatch_infos_id', '=', $id]
            ])
            ->get();




        return view('dispatchs.show', compact('dispatchs', 'kepada', 'jenis', 'daripada', 'dispatchfiles'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function showadmin($id)
    {

        // $dispatchs = Dispatch::all()->where('id', '=', $id)->first();




        $dispatchs = Dispatch::all()->where('id', '=', $id);


        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();


        $dispatchfiles = Dispatchfile::select('dispatch_files.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['dispatch_infos_id', '=', $id]
            ])
            ->get();



        return view('dispatchs.showadmin', compact('dispatchs', 'kepada', 'jenis', 'daripada', 'dispatchfiles'));
    }



    public function showtindakan($id)
    {

        // $dispatchs = Dispatch::all()->where('id', '=', $id)->first();




        $dispatchs = Dispatch::all()->where('id', '=', $id);


        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();


        $dispatchfiles = Dispatchfile::select('dispatch_files.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['dispatch_infos_id', '=', $id]
            ])
            ->get();

        $dispatchpassmecs = DispatchPassMec::all()->where('id', '=', $id);

        $dispatchpassmecs = DispatchPassMec::select('dispatch_pass_mecs.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['dispatch_infos_id', '=', $id]
            ])
            ->get();





        return view('dispatchs.showtindakan', compact('dispatchs', 'kepada', 'jenis', 'daripada', 'dispatchfiles', 'dispatchpassmecs'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */


    public function edittindakan($id)
    {
        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();
        $tindakan = Mecuser::pluck('unit', 'id')->all();


        $dispatchs = Dispatch::all()->where('id', '=', $id);


        $dispatchfiles = Dispatchfile::select('dispatch_files.*')
            ->orderBy('created_at', 'DESC')
            ->where([
                ['dispatch_infos_id', '=', $id]
            ])
            ->get();

        $dispatchpassmecs = DispatchPassMec::select('dispatch_pass_mecs.*')
            ->orderBy('created_at', 'DESC')
            ->get();


        return view('dispatchs.edittindakan', compact('dispatchs', 'kepada', 'jenis', 'daripada', 'dispatchfiles', 'tindakan', 'dispatchpassmecs'));
    }

    public function PegawaiT(Dispatch $dispatch)
    {
        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();


        return view('dispatchs.pegawaiT', compact('kepada', 'jenis', 'daripada'));
    }

    public function kakitangan(Dispatch $dispatch)
    {
        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();


        return view('dispatchs.kakitangan', compact('kepada', 'jenis', 'daripada'));
    }

    public function mecuser()
    {
        $kepada = Kepada::pluck('label', 'id')->all();

        $jenis = Jenis::pluck('label', 'id')->all();

        $daripada = Daripada::pluck('label', 'id')->all();

        $mecusers = Mecuser::select('dispatch_mecusers.*')
            ->orderBy('created_at', 'DESC')
            ->get();


        return view('dispatchs.mecuser', compact('kepada', 'jenis', 'daripada', 'mecusers'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([]);

        $now = Carbon::now();

        if ($request->lamp == '') {

            $dispatchs =  Dispatch::select('dispatch_infos.*')
                ->where('id', $request->id)
                ->update([
                    'jns'         =>      $request->jns,
                    'daripada'      =>      $request->daripada,
                    'kpd'      =>      $request->kpd,
                    'up'      =>      $request->up,
                    'perkara'      =>      $request->perkara,
                    'rp' => $request->rp,
                    'rm' => $request->rm,
                    'catt' => $request->catt,
                    'updated_at' => $now
                ]);
        } else {

            $dispatchs1 = Dispatch::select(['dispatch_infos.*', \DB::raw('DATEDIFF("d",GETDATE(), created_at) as length')])
                ->where('id', $request->id)
                ->value('lamp');

            Storage::disk('public')->delete($dispatchs1);

            $dispatch =  Dispatch::select('dispatch_infos.*')
                ->where('id', $request->id)
                ->update([
                    'jns'         =>      $request->jns,
                    'daripada'      =>      $request->daripada,
                    'kpd'      =>      $request->kpd,
                    'up'      =>      $request->up,
                    'perkara'      =>      $request->perkara,
                    'rp' => $request->rp,
                    'rm' => $request->rm,
                    'catt' => $request->catt,
                    'dis_filename' => $request->lamp->getClientOriginalName(),
                    'lamp' => $request->file('lamp')->store('dispatch', 'public'),
                    'updated_at' => $now

                ]);
        }






        return redirect()->route('dispatchs.dis.index')
            ->with('success_message', 'Data record was successfully updated!');
    }



    public function updateadmin(Request $request)
    {
        // storing data for dokumen file
        $now = Carbon::now();
        $id = $request->id;
        $filename = $request->file;
        $file = $request->file('file');
        $no_folio_dokumen = $request->no_folio_dokumen;
        $despatch = $request->despatch;
        $daripada = $request->daripada;
        $tarikh_surat = $request->tarikh_surat;
        $tindakan = $request->tindakan;
        $icNos = Auth::user()->ic_no;

        if ($request->file != '' || $request->filename != '' || $request->no_folio_dokumen != '' || $request->despatch != '') {

            for ($count_1 = 0; $count_1 < count($file); $count_1++) {

                $data_1 = array(

                    'dispatch_infos_id' => $id,
                    'no_folio_dokumen' => $no_folio_dokumen[$count_1],
                    'despatch' => $despatch[$count_1],
                    'daripada' => $daripada[$count_1],
                    'tarikh_surat' => $tarikh_surat[$count_1],
                    'tindakan' => $tindakan[$count_1],
                    'filename' => $filename[$count_1]->getClientOriginalName(),
                    'file' => $file[$count_1]->store('dispatch', 'public'),
                    'created_by_ic_no' => $icNos[$count_1],
                    'created_at' => $now

                );

                $insert_data_1[] = $data_1;
            }

            // Save 'kadarkenaikangaji' data
            Dispatchfile::insert($insert_data_1);
        }

        // store data for admin
        $dispatchs =  Dispatch::select('dispatch_infos.*')
            ->where('id', $request->id)
            ->update([
                'date_process' => $request->date_process,
                'date_close'         =>      $request->date_close,
                'no_folio'         =>      $request->no_folio,
                'catatan_admin'         =>      $request->catatan_admin,
                'tindakan'         =>      $request->tindakan,
                'date_admin_submit' => $now,
                'updated_at' => $now
            ]);




        $dispatchpassmecs = DispatchPassMec::updateOrCreate(
            [
                'dispatch_infos_id' => $request->input('id'),

            ],

            [

                'ulasan_pass' => $request->input('catatan_admin'),
                'tindakan_pass' => $request->input('tindakan'),
                'no_folio' => $request->input('no_folio'),
                'created_by' => $icNos,
                'updated_at' => $now,
            ]
        );



        return redirect()->route('dispatchs.dis.indexadmin')
            ->with('success_message', 'Data record was successfully updated!');
    }



    public function updatetindakan(Request $request)
    {
        // storing data for dokumen file
        $now = Carbon::now();
        $id = $request->id;
        $filename = $request->file;
        $file = $request->file('file');
        $no_folio_dokumen = $request->no_folio_dokumen;
        $despatch = $request->despatch;
        $daripada = $request->daripada;
        $tarikh_surat = $request->tarikh_surat;
        $tindakan = $request->tindakan;
        $icNos = Auth::user()->ic_no;

        if ($request->file != '' || $request->filename != '' || $request->no_folio_dokumen != '' || $request->despatch != '') {

            for ($count_1 = 0; $count_1 < count($file); $count_1++) {

                $data_1 = array(

                    'dispatch_infos_id' => $id,
                    'no_folio_dokumen' => $no_folio_dokumen[$count_1],
                    'despatch' => $despatch[$count_1],
                    'daripada' => $daripada[$count_1],
                    'tarikh_surat' => $tarikh_surat[$count_1],
                    'tindakan' => $tindakan[$count_1],
                    'filename' => $filename[$count_1]->getClientOriginalName(),
                    'file' => $file[$count_1]->store('dispatch', 'public'),
                    'created_by_ic_no' => $icNos[$count_1],
                    'created_at' => $now

                );

                $insert_data_1[] = $data_1;
            }

            // Save 'kadarkenaikangaji' data
            Dispatchfile::insert($insert_data_1);
        }

        // store data for pengarah & pegawai MEC
        // $dispatch =  Dispatch::select('dispatch_infos.*')
        //     ->where('id', $request->id)
        //     ->update([
        //         'tindakan_mec' => json_encode($request->tindakan_mec),
        //         'tindakan_pt' => json_encode($request->tindakan_pt),
        //         'ulasan_mec'         =>      $request->ulasan_mec,
        //         'ulasan_pt'         =>      $request->ulasan_pt,
        //         'date_mec_submit' => $now,
        //         'created_mec_by' => $icNos


        $dispatchpassmecs = DispatchPassMec::Create(


            [

                'dispatch_infos_id' => $request->input('dispatch_infos_id'),
                'tindakan_action_pass' => json_encode($request->input('tindakan_action_pass')),
                'ulasan_pass' => $request->input('ulasan_pass'),
                'tindakan_pass' => $request->input('tindakan_pass'),
                'no_folio' => $request->input('no_folio'),
                'created_by' => $icNos,

                'updated_at' => $now,
            ]
        );








        return redirect()->route('dispatchs.dis.indextindakan')
            ->with('success_message', 'Data record was successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $dispatchs = Dispatch::where('id', $id)->delete();

            return redirect()->route('dispatchs.dis.index')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroyadmin($id)
    {
        try {

            $dispatchs = Dispatch::where('id', $id)->delete();

            return redirect()->route('dispatchs.dis.indexadmin')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroyfile($id)
    {
        try {

            $dispatchfiles = Dispatchfile::where('id', $id)->delete();

            return redirect()->route('dispatchs.dis.indexadmin')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroymecuser($id)
    {
        try {

            $mecusers = Mecuser::where('id', $id)->delete();

            return redirect()->route('dispatchs.dis.mecuser')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    public function destroytindakan($id)
    {
        try {
            $dispatchs = Dispatch::where('id', $id)->delete();

            return redirect()->route('dispatchs.dis.indextindakan')
                ->with('success_message', 'Data was successfully deleted!');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



    public function verify($id)
    {

        return view('verify');
    }
}