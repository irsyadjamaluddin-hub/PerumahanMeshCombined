<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use App\Models\DAPerumahandata;
use App\Models\Employment;
use App\Models\Iqdata;
use App\Models\Menunggudata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DAPerumahanController extends Controller
{
    public function indexpenghuni()
    {
        $dapenghuni= DAPerumahandata::select('daperumahandata.*')->get();
        // $dapenghuni = DAPerumahandata::select('daperumahandata.*')->take(10)->get();
        return view('daperumahan.indexpenghuni', compact('dapenghuni'));
    }

    public function editpenghuni($id) {
        $icNos = Auth::user()->ic_no;
    
        $employments = Employment::all()
                        ->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);

        $dapenghuni= DAPerumahandata::findOrFail($id);
        $nama_penghuni = $dapenghuni->nama_penghuni;
        $rumah2_penghuni = DAPerumahandata::where('nama_penghuni', $nama_penghuni)->get();
        
        
        return view('daperumahan.editpenghuni', compact('dapenghuni', 'rumah2_penghuni'));
    }

    public function updatepenghuni(DAPerumahandata $dapenghuni) {
        $icNos = Auth::user()->ic_no;
        
        $dapenghuni->update([
            'rujukan_jpm'=> request('rujukan_jpm'),
            'nama_penghuni' => request('nama_penghuni'),
            'jawatan' => request('jawatan'),
            'mob2' => request('mob2'),
            'lokasi' => request('lokasi'),
            'kampung' => request('kampung'),
            'tarikh_mendiami' => request('tarikh_mendiami')
        ]);
        
        return redirect()->route('daperumahan.daperumahan.indexpenghuni')
        ->with('success_message', 'Penghuni telah di tukar!');
    }


    public function indexpemilik()
    {
        $dapemilik= DAPerumahandata::select('daperumahandata.*')->get();
        return view('daperumahan.indexpemilik', compact('dapemilik'));
    }

    // nama penghuni, nokp, lokasi, mukim, rujukan fail

    public function showpemilik($id) {
        $icNos = Auth::user()->ic_no;

        $dapemilik = DAPerumahandata::findOrFail($id);
        
        $nama_pemilik = $dapemilik->nama_pemilik;
        $rumah2_pemilik = DAPerumahandata::where('nama_pemilik', $nama_pemilik)->get();

        return view('daperumahan.showpemilik', compact('dapemilik', 'rumah2_pemilik'));
        
    }

    public function createpemilik() {
        $statusList = [
            'AVAILABLE',
            'DIDIAMI'
        ];
        return view('daperumahan.createpemilik', compact('statusList'));
    }

    public function storepemilik() {
        request()->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;
        if (request()->hasFile('image')) {
            $imagePath = request()->file('image')->store('images', 'public');
        }

        DAPerumahandata::create([
            'rujukan_fail' => request('rujukan_fail'),
            'nama_pemilik' => request('nama_pemilik'),
            'no_kp1' => request('no_kp1'),
            'gantinama' => request('gantinama'),
            'gelaran' => request('gelaran'),
            'alamat_persuratan' => request('alamat_persuratan'),
            'lokasi' => request('lokasi'),
            'kampung' => request('kampung'),
            'mukim' => request('mukim'),
            'mob1' => request('mob1'),
            'kelas' => request('kelas'),
            'kadar_sewa_awal' => request('kadar_sewa_awal'),
            'kadar_sewa_minima' => request('kadar_sewa_minima'),
            'kadar_sewa_potongan_sebulan' => request('kadar_sewa_potongan_sebulan'),
            'tarikh_mula_disewa' => request('tarikh_mula_disewa'),
            'bermula' => request('bermula'),
            'berakhir' => request('berakhir'),
            'image' => $imagePath,
            'status_rumah' => request('status_rumah')
        ]);

        return redirect()->route('daperumahan.daperumahan.indexpemilik')
        ->with('success_message', 'Pemilik created successfully!');
        
    }
    
    public function editpemilik($id) {
        $icNos = Auth::user()->ic_no;
    
        $employments = Employment::all()
                        ->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);
        
        $dapemilik= DAPerumahandata::findOrFail($id);
        $nama_pemilik = $dapemilik->nama_pemilik;
        $rumah2_pemilik = DAPerumahandata::where('nama_pemilik', $nama_pemilik)->get();

        $statusList = [
            'AVAILABLE',
            'DIDIAMI'
        ];
        
        return view('daperumahan.editpemilik', compact('dapemilik', 'rumah2_pemilik', 'statusList'));
    }

    public function updatepemilik(DAPerumahandata $dapemilik) {
        $icNos = Auth::user()->ic_no;
        
        $request = request();

        $request->validate([
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_image' => 'nullable|array'
        ]);

        $nama_pemilik = $dapemilik->nama_pemilik;
        $rumah2_pemilik = DAPerumahandata::where('nama_pemilik', $nama_pemilik)->get();

        foreach ($rumah2_pemilik as $rumah_pemilik) {
            $ids[] = $rumah_pemilik->id;
        }

        // nama penghuni, nokp2, lokasi, mukim, rujukan fail
        $jpm_index = 0;
        foreach ($request->rujukan_jpm as $jpm_baru) {
            DAPerumahandata::where('id', $ids[$jpm_index])->update([
                'rujukan_jpm' => $jpm_baru
            ]);
            $jpm_index++;
        }

        $penghuni_index=0;
        foreach ($request->nama_penghuni as $penghuni_baru) {
            DAPerumahandata::where('id', $ids[$penghuni_index])->update([
                'nama_penghuni' => $penghuni_baru
            ]);
            $penghuni_index++;
        }

        $kp2_index=0;
        foreach ($request->no_kp2 as $kp2_baru) {
            DAPerumahandata::where('id', $ids[$kp2_index])->update([
                'no_kp2' => $kp2_baru
            ]);
            $kp2_index++;
        }

        $lokasi_index=0;
        foreach ($request->lokasi as $lokasi_baru) {
            DAPerumahandata::where('id', $ids[$lokasi_index])->update([
                'lokasi' => $lokasi_baru
            ]);
            $lokasi_index++;
        }

        $mukim_index=0;
        foreach ($request->mukim as $mukim_baru) {
            DAPerumahandata::where('id', $ids[$mukim_index])->update([
                'mukim' => $mukim_baru
            ]);
            $mukim_index++;
        }

        $status_index=0;
        foreach ($request->status_rumah as $status_baru) {
            DAPerumahandata::where('id', $ids[$status_index])->update([
                'status_rumah' => $status_baru
            ]);
            $status_index++;
        }

        // REMOVE IMAGE
        if ($request->has('remove_image')) {
            foreach ($request->remove_image as $index => $remove) {
                if ($remove && isset($rumah2_pemilik[$index])) {
                    $rumah_pemilik = $rumah2_pemilik[$index];
                    if ($rumah_pemilik->image && Storage::disk('public')->exists($rumah_pemilik->image)) {
                        Storage::disk('public')->delete($rumah_pemilik->image);
                    }
                    $rumah_pemilik->image = null;
                    $rumah_pemilik->save();
                }
            }
        }

        // UPDATE IMAGE
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $index => $image) {
                if (isset($rumah2_pemilik[$index])) {
                    $rumah_pemilik = $rumah2_pemilik[$index];
                    if ($rumah_pemilik->image && Storage::disk('public')->exists($rumah_pemilik->image)) {
                        Storage::disk('public')->delete($rumah_pemilik->image);
                    }

                    $rumah_pemilik->image = $image->store('images', 'public');
                    $rumah_pemilik->save();
                }
            }
        }

        DAPerumahandata::where('nama_pemilik', $nama_pemilik)->update([
            'nama_pemilik' => request('nama_pemilik')
        ]);

        $dapemilik->update([
            'nama_pemilik' => request('nama_pemilik')
        ]);
        
        
        return redirect()->route('daperumahan.daperumahan.indexpemilik')
        ->with('success_message', 'Data Pemilik telah di tukar!');
    }
    
    public function indexiq()
    {
        $daiq= Iqdata::select('iqdata.*')->get();
        return view('daperumahan.indexiq', compact('daiq'));
    }

    public function editiq($id) {
        $icNos = Auth::user()->ic_no;
    
        $employments = Employment::all()
                        ->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);
        

        $daiq= Iqdata::findOrFail($id);
        
        
        return view('daperumahan.editiq', compact('daiq'));
    }

    public function updateiq(Iqdata $daiq) {
        $icNos = Auth::user()->ic_no;

        $daiq->update([
            'rujukan_fail'=> request('rujukan_fail'),
            'daerah' => request('daerah'),
            'nama_penghuni' => request('nama_penghuni'),
            'jawatan_penghuni' => request('jawatan_penghuni'),
            'no_tel' => request('no_tel'),
            'alamat_1' => request('alamat_1'),
            'tarikh_mendiami' => request('tarikh_mendiami')
        ]);
        
        return redirect()->route('daperumahan.daperumahan.indexiq')
        ->with('success_message', 'IQ telah di tukar!');
    }

    public function indexmenunggu()
    {
        $damenunggu= Menunggudata::select('menunggudata.*')->get();
        return view('daperumahan.indexmenunggu', compact('damenunggu'));
    }

    public function createmenunggu() {

        $bhgPemohon = [
            'II',
            'III',
            'IV',
            'V'
        ];
        
        $daerahList = [
            'BRUNEI MUARA',
            'TUTONG',
            'TEMBURONG',
            'BELAIT'
        ];


        
        return view('daperumahan.createmenunggu', compact('bhgPemohon', 'daerahList'));
    }

    public function storemenunggu() {

        Menunggudata::create([
            'nama_pemohon'=> request('nama_pemohon'),
            'bhg_pemohon' => request('bhg_pemohon'),
            'jawatan_pemohon' => request('jawatan_pemohon'),
            'tanggagaji_pemohon' => request('tanggagaji_pemohon'),
            'jenis_perkhidmatan' => request('jenis_perkhidmatan'),
            'tempat_bertugas_pemohon' => request('tempat_bertugas_pemohon'),
            'kategori_permohonan' => request('kategori_permohonan'),
            'daerah' => request('daerah'),
            'kelayakan_perumahan' => request('kelayakan_perumahan'),
            'kelayakan_kelas' => request('kelayakan_kelas'),
            'tarikh_diterima' => request('tarikh_diterima'),
        ]);

        return redirect()->route('daperumahan.daperumahan.indexmenunggu')
        ->with('success_message', 'Pemohon created successfully!');
    }

    public function editmenunggu($id) {
        $icNos = Auth::user()->ic_no;
    
        $employments = Employment::all()
                        ->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);
        

        $damenunggu= Menunggudata::findOrFail($id);

        $bhgPemohon = [
            'II',
            'III',
            'IV',
            'V'
        ];

        $daerahList = [
            'BRUNEI MUARA',
            'TUTONG',
            'TEMBURONG',
            'BELAIT'
        ];
        
        
        return view('daperumahan.editmenunggu', compact('damenunggu', 'bhgPemohon', 'daerahList'));
    }

    public function updatemenunggu(Menunggudata $damenunggu) {
        $icNos = Auth::user()->ic_no;
        
        $damenunggu->update([
            'nama_pemohon'=> request('nama_pemohon'),
            'bhg_pemohon' => request('bhg_pemohon'),
            'jawatan_pemohon' => request('jawatan_pemohon'),
            'jenis_perkhidmatan' => request('jenis_perkhidmatan'),
            'kategori_permohonan' => request('kategori_permohonan'),
            'daerah' => request('daerah'),
            'tarikh_diterima' => request('tarikh_diterima')
        ]);
        
        return redirect()->route('daperumahan.daperumahan.indexmenunggu')
        ->with('success_message', 'Pemohon telah di tukar!');
    }
}
