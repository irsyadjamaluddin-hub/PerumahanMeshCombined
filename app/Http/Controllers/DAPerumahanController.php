<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use App\Models\DAPerumahandata;
use App\Models\Employment;
use App\Models\Iqdata;
use App\Models\Menunggudata;
use App\Models\StatusRumah;
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

        $statusList = [
        'KAHWIN',
        'BUJANG',
        'JANDA',
        'DUDA',
        'BALU'
        ];
        
        return view('daperumahan.editpenghuni', compact('dapenghuni', 'rumah2_penghuni', 'statusList'));
    }

    // public function updatepenghuni(DAPerumahandata $dapenghuni) {
    //     $icNos = Auth::user()->ic_no;
        
    //     $dapenghuni->update([
    //         //'rujukan_jpm'=> request('rujukan_jpm'),
    //         'nama_penghuni' => request('nama_penghuni'),
    //         'no_kp2' => request('no_kp2'),
    //         'tarikh_lahir_penghuni' => request('tarikh_lahir_penghuni'),
    //         'tarikh_bersara_penghuni' => request('tarikh_bersara_penghuni'),
    //         'status_rumahtangga' => request('status_rumahtangga'),
    //         'jawatan' => request('jawatan'),
    //         'bahagian' => request('bahagian'),
    //         'tangga_gaji' => request('tangga_gaji'),
    //         'gaji_terkini' => request('gaji_terkini'),
    //         'tempat_bertugas' => request('tempat_bertugas'),
    //         'mob2' => request('mob2'),
    //         'daerah' => request('daerah'),
    //         'lokasi' => request('lokasi'),
    //         'tarikh_mendiami' => request('tarikh_mendiami'),
    //         'tarikh_kosong' => request('tarikh_kosong'),
    //         'catatan_penghuni' => request('catatan_penghuni'),
    //         'taraf_kelamin' => request('tarf_kelamin')
    //     ]);
        
    //     return redirect()->route('daperumahan.daperumahan.indexpenghuni')
    //     ->with('success_message', 'Penghuni telah di tukar!');
    // }

    public function updatepenghuni(Request $request, DAPerumahandata $dapenghuni)
    {
        
        $request->validate([
            'nama_penghuni' => 'nullable|string|max:255',
            'no_kp_penghuni' => 'nullable|string|max:50',
            'no_kp_pemohon' => 'nullable|string|max:50',
            'tarikh_lahir_penghuni' => 'nullable|date',
            'tarikh_bersara_penghuni' => 'nullable|date',
            'taraf_kelamin' => 'nullable|string',
            'mob2' => 'nullable|string|max:20',
            'tempat_bertugas' => 'nullable|string|max:255',
            'jawatan' => 'nullable|string|max:255',
            'bahagian' => 'nullable|string|max:255',
            'tangga_gaji' => 'nullable|string|max:100',
            'gaji_terkini' => 'nullable|string|max:100',
            'tarikh_lantikan' => 'nullable|date',
            'status_lantikan' => 'nullable|string',
            'tarikh_jawatan' => 'nullable|date',
            'nama_penuh_pasangan' => 'nullable|string|max:255',
            'tempat_bertugas_pasangan' => 'nullable|string|max:255',
            'nama_kementerian' => 'nullable|string|max:255',
            'kemudahan_kerajaan' => 'nullable|string|max:255',
            'alamat_rumah_sewa' => 'nullable|string|max:255',
            'daerah' => 'nullable|string|max:100',
            'kelas' => 'nullable|string|max:100',
            'sewa_sebulan' => 'nullable|string|max:100',
            'sewa_sebulan_perabot' => 'nullable|string|max:100',
            'nama_pemilik' => 'nullable|string|max:255',
            'tarikh_mendiami' => 'nullable|date',
            'tarikh_kosong' => 'nullable|date',
            'status_rumahtangga' => 'nullable|string',
            'borang_maklumat' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'kad_pengenalan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'slip_gaji' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'sijil_nikah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'surat_lantikan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'surat_penetapan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'dokumen_anak' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'surat_bantuan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'dokumen_tawaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'dokumen_mendiami' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'dokumen_pengakuan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'dokumen_kosong' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'dokumen_lain' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $fileFields = [
            'borang_maklumat',
            'kad_pengenalan',
            'slip_gaji',
            'sijil_nikah',
            'surat_lantikan',
            'surat_penetapan',
            'dokumen_anak',
            'surat_bantuan',
            'dokumen_tawaran',
            'dokumen_mendiami',
            'dokumen_pengakuan',
            'dokumen_kosong',
            'dokumen_lain'
        ];

           // get all input data
    $data = $request->except($fileFields);

        // handle files
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('penghuni', 'public');
                $data[$field] = $path;

            // Delete old file if exists
            if ($dapenghuni->$field && \Storage::disk('public')->exists($dapenghuni->$field)) {
                \Storage::disk('public')->delete($dapenghuni->$field);
            }

        } else { 
            $data[$field] = $dapenghuni->$field; // keep old file

        }
    }

        $dapenghuni->update($data);

        return redirect()
            ->route('daperumahan.daperumahan.indexpenghuni')
            ->with('success_message', 'Penghuni telah dikemaskini!');
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
        
        $nama_pemilik = $dapemilik->no_kp1;
        $rumah2_pemilik = DAPerumahandata::where('no_kp1', $nama_pemilik)->get();

        return view('daperumahan.showpemilik', compact('dapemilik', 'rumah2_pemilik'));
        
    }

    public function createpemilik() {
        $statusList = StatusRumah::orderBy('id')->pluck('status')->toArray();
        return view('daperumahan.createpemilik', compact('statusList'));
    }

    // public function storepemilik() {
    //     request()->validate([
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    //     ]);

    //     $imagePath = null;
    //     if (request()->hasFile('image')) {
    //         $imagePath = request()->file('image')->store('images', 'public');
    //     }

    //     DAPerumahandata::create([
    //         'rujukan_fail' => request('rujukan_fail'),
    //         'nama_pemilik' => request('nama_pemilik'),
    //         'no_kp1' => request('no_kp1'),
    //         'gantinama' => request('gantinama'),
    //         'gelaran' => request('gelaran'),
    //         'alamat_persuratan' => request('alamat_persuratan'),
    //         'lokasi' => request('lokasi'),
    //         'kampung' => request('kampung'),
    //         'mukim' => request('mukim'),
    //         'mob1' => request('mob1'),
    //         'kelas' => request('kelas'),
    //         'kadar_sewa_awal' => request('kadar_sewa_awal'),
    //         'kadar_sewa_minima' => request('kadar_sewa_minima'),
    //         'kadar_sewa_potongan_sebulan' => request('kadar_sewa_potongan_sebulan'),
    //         'tarikh_mula_disewa' => request('tarikh_mula_disewa'),
    //         'bermula' => request('bermula'),
    //         'berakhir' => request('berakhir'),
    //         'image' => $imagePath,
    //         'status_rumah' => request('status_rumah')
    //     ]);

    //     return redirect()->route('daperumahan.daperumahan.indexpemilik')
    //     ->with('success_message', 'Pemilik created successfully!');
        
    // }

    public function storepemilik()
{
    // ✅ Validation (kept, but no $validated variable)
    request()->validate([
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // ✅ Image upload
    $imagePath = null;
    if (request()->hasFile('image')) {
        $imagePath = request()->file('image')->store('images', 'public');
    }

    // ✅ Create Pemilik record
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
        'status_rumah' => request('status_rumah'),
        'image' => $imagePath,
    ]);

    return redirect()
        ->route('daperumahan.daperumahan.indexpemilik')
        ->with('success_message', 'Pemilik created successfully!');
}

    public function editpemilik($id) {
        $icNos = Auth::user()->ic_no;
    
        $employments = Employment::all()
                        ->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);
        
        $dapemilik= DAPerumahandata::findOrFail($id);
        $nama_pemilik = $dapemilik->no_kp1;
        $rumah2_pemilik = DAPerumahandata::where('no_kp1', $nama_pemilik)->get();

        $statusList = StatusRumah::orderBy('id')->pluck('status')->toArray();
        
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

        // Make sure $ids is always an array
        $ids = $request->ids ?? [];

        foreach ($ids as $index => $id) {
        
            if (
                empty($request->nama_penghuni[$index]) &&
                empty($request->no_kp2[$index]) &&
                empty($request->jawatan[$index]) &&
                empty($request->tempat_bertugas[$index]) &&
                empty($request->mob2[$index]) &&
                empty($request->tarikh_mendiami[$index]) &&
                empty($request->catatan_penghuni[$index])
            ) {
                continue;
            }
        
            DAPerumahandata::where('id', $id)->update([
                'nama_penghuni'           => $request->nama_penghuni[$index]           ?? null,
                'no_kp2'           => $request->no_kp2[$index]           ?? null,
                'jawatan'          => $request->jawatan[$index]          ?? null,
                'tempat_bertugas'  => $request->tempat_bertugas[$index]  ?? null,
                'mob2'             => $request->mob2[$index]             ?? null,
                'tarikh_mendiami'  => $request->tarikh_mendiami[$index]  ?? null,
                'catatan_penghuni' => $request->catatan_penghuni[$index] ?? null,
            ]);
        }
        


        // foreach ($rumah2_pemilik as $rumah_pemilik) {
        //     $ids[] = $rumah_pemilik->id;
        // }

        // nama penghuni, nokp2, lokasi, mukim, rujukan fail
        // $jpm_index = 0;
        // foreach ($request->rujukan_jpm as $jpm_baru) {
        //     DAPerumahandata::where('id', $ids[$jpm_index])->update([
        //         'rujukan_jpm' => $jpm_baru
        //     ]);
        //     $jpm_index++;
        // }

        // $penghuni_index=0;
        // foreach ((array)$request->nama_penghuni as $penghuni_baru) {
        //     DAPerumahandata::where('id', $ids[$penghuni_index])->update([
        //         'nama_penghuni' => $penghuni_baru
        //     ]);
        //     $penghuni_index++;
        // }

        // $kp2_index=0;
        // foreach ((array)$request->no_kp2 as $kp2_baru) {
        //     DAPerumahandata::where('id', $ids[$kp2_index])->update([
        //         'no_kp2' => $kp2_baru
        //     ]);
        //     $kp2_index++;
        // }

        // $jawatan_index=0;
        // foreach ((array)$request->jawatan as $jawatan_baru) {
        //     DAPerumahandata::where('id', $ids[$jawatan_index])->update([
        //         'jawatan' => $jawatan_baru
        //     ]);
        //     $jawatan_index++;
        // }

        // $tempat_bertugas_index=0;
        // foreach ((array)$request->tempat_bertugas as $tempat_bertugas_baru) {
        //     DAPerumahandata::where('id', $ids[$tempat_bertugas_index])->update([
        //         'tempat_bertugas' => $tempat_bertugas_baru
        //     ]);
        //     $tempat_bertugas_index++;
        // }

        // $mob2_index=0;
        // foreach ((array)$request->mob2 as $mob2_baru) {
        //     DAPerumahandata::where('id', $ids[$mob2_index])->update([
        //         'mob2' => $mob2_baru
        //     ]);
        //     $mob2_index++;
        // }

        // $tarikh_mendiami_index=0;
        // foreach ((array)$request->tarikh_mendiami as $tarikh_mendiami_baru) {
        //     DAPerumahandata::where('id', $ids[$tarikh_mendiami_index])->update([
        //         'tarikh_mendiami' => $tarikh_mendiami_baru
        //     ]);
        //     $tarikh_mendiami_index++;
        // }

        //     $catatan_penghuni_index=0;
        // foreach ((array)$request->catatan_penghuni as $catatan_penghuni_baru) {
        //     DAPerumahandata::where('id', $ids[$catatan_penghuni_index])->update([
        //         'catatan_penghuni' => $catatan_penghuni_baru
        //     ]);
        //     $catatan_penghuni_index++;
        // }

        // $lokasi_index=0;
        // foreach ((array)$request->lokasi as $lokasi_baru) {
        //     DAPerumahandata::where('id', $ids[$lokasi_index])->update([
        //         'lokasi' => $lokasi_baru
        //     ]);
        //     $lokasi_index++;
        // }

        // $mukim_index=0;
        // foreach ((array)$request->mukim as $mukim_baru) {
        //     DAPerumahandata::where('id', $ids[$mukim_index])->update([
        //         'mukim' => $mukim_baru
        //     ]);
        //     $mukim_index++;
        // }

        // $status_index=0;
        // foreach ((array)$request->status_rumah as $status_baru) {
        //     DAPerumahandata::where('id', $ids[$status_index])->update([
        //         'status_rumah' => $status_baru
        //     ]);
        //     $status_index++;
        // }

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

    //     DAPerumahandata::where('nama_pemilik', $nama_pemilik)->update([
    //         'nama_pemilik' => request('nama_pemilik')
    //     ]);

    //     $dapemilik->update([
    //         'rujukan_fail'=> request('rujukan_fail'),
    //         'nama_pemilik' => request('nama_pemilik'),
    //         'no_kp1' => request('no_kp1'),
    //         'alamat_persuratan' => request('alamat_persuratan'),
    //         'mob1' => request('mob1'),
    //         'kelas' => request('kelas'),
    //         'lokasi' => request('lokasi'),
    //         'daerah' => request('daerah'),
    //         'kadar_sewa_awal' => request('kadar_sewa_awal'),
    //         'tarikh_mula_disewa' => request('tarikh_mula_disewa'),
    //         'bermula' => request('bermula'),
    //         'berakhir' => request('berakhir'),
    //         'kadar_sewa_perabot_terkini' => request('kadar_sewa_perabot_terkini'),
    //         'status_rumah' => request('status_rumah'),
    //         'catatan_pemilik' => request('catatan_pemilik')
    //     ]);

    //     return redirect()->route('daperumahan.daperumahan.indexpemilik')
    //     ->with('success_message', 'Data Pemilik telah di tukar!');
    // }

    $request->validate([
        'nama_pemilik' => 'nullable|string|max:255',
        'no_kp1' => 'nullable|string|max:50',
        'alamat_rumah_sewa' => 'nullable|string|max:255',
        'alamat_persuratan' => 'nullable|string|max:255',
        'mob1' => 'nullable|string|max:20',
        'mukim' => 'nullable|string|max:100',
        'daerah' => 'nullable|string|max:100',
        'sewa_sebulan' => 'nullable|string|max:100',
        'kadar_sewa_perabot_terkini' => 'nullable|string|max:100',
        'tarikh_mula_disewa' => 'nullable|date',
        'tarikh_penyambungan_ta' => 'nullable|date',
        'berakhir' => 'nullable|date',
        'status_rumah' => 'nullable|string',
        'status_permohonan' => 'nullable|string',
        'borang_penyambungan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'dokumen_perjanjian' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'laporan_teknikal' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'insurans' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'resit_pemadam_kebakaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'kpp_pemilik' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'geran_tanah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'surat_op' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'gambar_rumah' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'pengesah_penomboran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'senarai_perabot' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'memorandum_perabot' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'surat_abci' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'sale_purchase_agreement' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'permohonan_kerajaan' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'dokumen_lain_spmlk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
    ]);

    $fileFields = [
        'borang_penyambungan', 
        'dokumen_perjanjian', 
        'laporan_teknikal',
        'insurans', 
        'resit_pemadam_kebakaran', 
        'kpp_pemilik',
        'geran_tanah',
        'surat_op',
        'gambar_rumah', 
        'pengesah_penomboran', 
        'senarai_perabot',
        'memorandum_perabot', 
        'surat_abci', 
        'sale_purchase_agreement', 
        'permohonan_kerajaan',
        'dokumen_lain_spmlk' 
    ];

      // get all input data
    $data = $request->except($fileFields);

    // handle files
    foreach ($fileFields as $field) {
        if ($request->hasFile($field)) {
            $path = $request->file($field)->store('pemilik', 'public');
            $data[$field] = $path;

            // Delete old file if exists
            if ($dapemilik->$field && \Storage::disk('public')->exists($dapemilik->$field)) {
                \Storage::disk('public')->delete($dapemilik->$field);
            }

        } else {
            $data[$field] = $dapemilik->$field; // keep old file

        }
    }

    $dapemilik->update($data);
 
    return redirect()->route('daperumahan.daperumahan.indexpemilik')
        ->with('success_message', 'Data Pemilik telah dikemaskini!');
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
        
        $statusList = [
            'KAHWIN',
            'BUJANG',
            'JANDA',
            'DUDA',
            'BALU'
        ];
        return view('daperumahan.editiq', compact('daiq', 'statusList'));
    }

    // public function updateiq(Iqdata $daiq) {
    //     $icNos = Auth::user()->ic_no;

    //     $daiq->update([
    //         'rujukan_fail'=> request('rujukan_fail'),
    //         'daerah' => request('daerah'),
    //         'nama_penghuni' => request('nama_penghuni'),
    //         'no_kp_penghuni' => request('no_kp_penghuni'),
    //         'tarikh_lahir' => request('tarikh_lahir'),
    //         'tarikh_bersara' => request('tarikh_bersara'),
    //         'status_rumahtangga' => request('status_rumahtangga'),
    //         'jawatan_penghuni' => request('jawatan_penghuni'),
    //         'bahagian' => request('bahagian'),
    //         'bahagian_tanggagaji' => request('bahagian_tanggagaji'),
    //         'gaji_terkini' => request('gaji_terkini'),
    //         'tempat_bertugas' => request('tempat_bertugas'),
    //         'no_tel' => request('no_tel'),
    //         'alamat_1' => request('alamat_1'),
    //         'tarikh_mendiami' => request('tarikh_mendiami'),
    //         'tarikh_mengosongkan' => request('tarikh_mengosongkan'),
    //         'catatan' => request('catatan')
    //     ]);
        
    //     return redirect()->route('daperumahan.daperumahan.indexiq')
    //     ->with('success_message', 'IQ telah di tukar!');
    // }

    public function updateiq(Request $request, Iqdata $daiq)
    {
        $request->validate([
            'rujukan_fail' => 'nullable|string|max:255',
            'alamat_perumahan_kerjaaniq' => 'nullable|string|max:255',
            'daerah' => 'nullable|string|max:100',
            'blok' => 'nullable|string|max:100',
            'kelas' => 'nullable|string|max:100',
            'sewa_sebulan' => 'nullable|string|max:100',
            'pembekalan_perabot' => 'nullable|string|max:50',
            'jenis_iq' => 'nullable|string|max:50',
            'jumlah_bilik' => 'nullable|integer',
            'jumlah_tandas' => 'nullable|integer',
            'nama_penghuni' => 'nullable|string|max:255',
            'no_kp_penghuni' => 'nullable|string|max:50',
            'jawatan_penghuni' => 'nullable|string|max:255',
            'tempat_bertugas' => 'nullable|string|max:255',
            'taraf_kelamin' => 'nullable|string|max:50',
            'tanggungan' => 'nullable|string|max:100',
            'tarikh_mendiami' => 'nullable|date',
            'tarikh_mengosongkan' => 'nullable|date',
            'tarikh_bersara' => 'nullable|date',
            'status_rumahtangga' => 'nullable|string|max:100',
            'gambar_iq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'kad_pengenalan_iq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'dokumen_mendiami_iq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'dokumen_kosong_iq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'dokumen_lain_iq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $fileFields = [
            'gambar_iq',
            'kad_pengenalan_iq',
            'dokumen_mendiami_iq',
            'dokumen_kosong_iq',
            'dokumen_lain_iq'
        ];

       // get all input data
    $data = $request->except($fileFields);

    // handle files
    foreach ($fileFields as $field) {
        if ($request->hasFile($field)) {
            // Delete old file if exists
            if ($daiq->$field && Storage::disk('public')->exists($daiq->$field)) {
                Storage::disk('public')->delete($daiq->$field);
            }
            // Store new file
            $data[$field] = $request->file($field)->store('iq', 'public');
        } else {
            $data[$field] = $daiq->$field; // keep old file
        }
    }

    $daiq->update($data);

        return redirect()
            ->route('daperumahan.daperumahan.indexiq')
            ->with('success_message', 'IQ telah dikemaskini!');
    }

    public function indexpenghuniiq()
    {
        $dapenghuniiq= DAPerumahandata::select('daperumahandata.*')->get();
        return view('daperumahan.indexpenghuniiq', compact('dapenghuniiq'));
    }

    public function editpenghuniiq($id) {
        $icNos = Auth::user()->ic_no;
    
        $employments = Employment::all()
                        ->where('ic_no', '=', $icNos);

        $biodatas = Biodata::all()
        ->where('ic_no', '=', $icNos);

        $dapenghuniiq= DAPerumahandata::findOrFail($id);
        $nama_penghuni = $dapenghuniiq->nama_penghuni;
        $rumah2_penghuni = DAPerumahandata::where('nama_penghuni', $nama_penghuni)->get();

        $statusList = [
        'KAHWIN',
        'BUJANG',
        'JANDA',
        'DUDA',
        'BALU'
        ];
        
        return view('daperumahan.editpenghuniiq', compact('dapenghuniiq', 'rumah2_penghuni', 'statusList'));
    }

    public function updatepenghuniiq(Request $request, DAPerumahandata $dapenghuniiq)
    {
        $request->validate([
            'nama_penghuni' => 'required|string|max:255',
            'no_kp_penghuni' => 'nullable|string|max:50',
            'tarikh_lahir_penghuni' => 'nullable|date',
            'tarikh_bersara_penghuni' => 'nullable|date',
            'taraf_kelamin' => 'required|string',
            'nama_tanggungan' => 'nullable|string|max:255',
            'mob2' => 'nullable|string|max:20',
            'tempat_bertugas' => 'nullable|string|max:255',
            'jawatan' => 'nullable|string|max:255',
            'bahagian' => 'nullable|string|max:255',
            'tangga_gaji' => 'nullable|string|max:255',
            'gaji_terkini' => 'nullable|string|max:255',
            'tarikh_lantikan' => 'nullable|date',
            'status_lantikan' => 'nullable|string|max:50',
            'tarikh_jawatan' => 'nullable|date',
            'nama_penuh_pasangan' => 'nullable|string|max:255',
            'no_kp_pemohon' => 'nullable|string|max:50',
            'tempat_bertugas_pasangan' => 'nullable|string|max:255',
            'nama_kementerian' => 'nullable|string|max:255',
            'kemudahan_kerajaan' => 'nullable|string|max:255',
            'alamat_rumah_kerajaan' => 'nullable|string|max:255',
            'daerah' => 'nullable|string|max:50',
            'kelas' => 'nullable|string|max:50',
            'bayaran_sebulan' => 'nullable|string|max:50',
            'dibekal_perabot' => 'nullable|string|max:255',
            'tarikh_mendiami' => 'nullable|date',
            'tarikh_kosong' => 'nullable|date',
            'status_rumahtangga' => 'nullable|string|max:50',
            'borang_maklumat_spiq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'gambar_spiq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kad_pengenalan_spiq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'slip_gaji_spiq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'surat_lantikan_spiq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'surat_penetapan_spiq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_anak_spiq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'surat_bantuan_spiq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_tawaran_spiq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_mendiami_spiq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_pengakuan_spiq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_kosong_spiq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'dokumen_lain_spiq' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $fileFields = [
        'borang_maklumat_spiq',
        'gambar_spiq',
        'kad_pengenalan_spiq',
        'slip_gaji_spiq',
        'surat_lantikan_spiq',
        'surat_penetapan_spiq',
        'dokumen_anak_spiq',
        'surat_bantuan_spiq',
        'dokumen_tawaran_spiq',
        'dokumen_mendiami_spiq',
        'dokumen_pengakuan_spiq',
        'dokumen_kosong_spiq',
        'dokumen_lain_spiq',
    ];

      // get all input data
    $data = $request->except($fileFields);

    // handle files
    foreach ($fileFields as $field) {
        if ($request->hasFile($field)) {
            $path = $request->file($field)->store('penghuni iq', 'public');
            $data[$field] = $path;

            // Delete old file if exists
            if ($dapenghuniiq->$field && \Storage::disk('public')->exists($dapenghuniiq->$field)) {
                \Storage::disk('public')->delete($dapenghuniiq->$field);
            }

        } else { 
            $data[$field] =   $dapenghuniiq->$field; // keep old file

        }
    }
    $dapenghuniiq->update($data);

    return redirect()
        ->route('daperumahan.daperumahan.indexpenghuniiq')
        ->with('success_message', 'Penghuni IQ telah dikemaskini!');
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

    // public function storemenunggu() {

    //     Menunggudata::create([
    //         'nama_pemohon'=> request('nama_pemohon'),
    //         'bhg_pemohon' => request('bhg_pemohon'),
    //         'jawatan_pemohon' => request('jawatan_pemohon'),
    //         'tanggagaji_pemohon' => request('tanggagaji_pemohon'),
    //         'jenis_perkhidmatan' => request('jenis_perkhidmatan'),
    //         'tempat_bertugas_pemohon' => request('tempat_bertugas_pemohon'),
    //         'kategori_permohonan' => request('kategori_permohonan'),
    //         'daerah' => request('daerah'),
    //         'kelayakan_perumahan' => request('kelayakan_perumahan'),
    //         'kelayakan_kelas' => request('kelayakan_kelas'),
    //         'tarikh_diterima' => request('tarikh_diterima'),
    //     ]);

    //     return redirect()->route('daperumahan.daperumahan.indexmenunggu')
    //     ->with('success_message', 'Pemohon created successfully!');
    // }

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
        'tarikh_diterima' => request('tarikh_diterima'), ]); 
       return redirect()->route('daperumahan.daperumahan.indexmenunggu') 
       ->with('success_message', 'Pemohon created successfully!'); }
       

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

//     public function updatemenunggu(Menunggudata $damenunggu) {
//         $icNos = Auth::user()->ic_no;
        
//         $damenunggu->update([
//             'nama_pemohon'=> request('nama_pemohon'),
//             'bhg_pemohon' => request('bhg_pemohon'),
//             'jawatan_pemohon' => request('jawatan_pemohon'),
//             'jenis_perkhidmatan' => request('jenis_perkhidmatan'),
//             'kategori_permohonan' => request('kategori_permohonan'),
//             'daerah' => request('daerah'),
//             'tarikh_diterima' => request('tarikh_diterima')
//         ]);
        
//         return redirect()->route('daperumahan.daperumahan.indexmenunggu')
//         ->with('success_message', 'Pemohon telah di tukar!');
//     }
// }

public function updatemenunggu(Request $request, Menunggudata $damenunggu)
{
    $request->validate([
        'nama_pemohon' => 'nullable|string|max:255',
        'no_kp_pemohon' => 'nullable|string|max:50',
        'tarikh_lahir' => 'nullable|date',
        'tarikh_bersara' => 'nullable|date',
        'taraf_kelamin' => 'nullable|string|max:20',
        'nama_tanggungan' => 'nullable|string|max:255',
        'alamat_persuratan' => 'nullable|string|max:255',
        'no_tell' => 'nullable|string|max:20',
        'alamat_tinggal' => 'nullable|string|max:255',
        'tempat_pemohon' => 'nullable|string|max:255',
        'jawatan_pemohon' => 'nullable|string|max:255',
        'bhg_pemohon' => 'nullable|string|max:255',
        'bahagian_tanggagaji' => 'nullable|string|max:100',
        'gaji_terkini' => 'nullable|string|max:100',
        'tarikh_lantikan' => 'nullable|date',
        'status_lantikan' => 'nullable|string|max:50',
        'tarikh_jawatan' => 'nullable|date',
        'nama_pasangan' => 'nullable|string|max:255',
        'tempat_bertugas_pasangan' => 'nullable|string|max:255',
        'nama_kementerian' => 'nullable|string|max:255',
        'kemudahan_kerja' => 'nullable|string|max:255',
        'tarikh_permohonan' => 'nullable|date',
        'status_permohonan' => 'nullable|string|max:50',
        'kelayakan_perumahan' => 'nullable|string|max:50',
        'kelas' => 'nullable|string|max:100',
        'tarikh_diterima' => 'nullable|date',
        'daerah' => 'nullable|string|max:100',
        'kad_pengenalan_sm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'sijil_nikah_sm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'slip_gaji_sm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'surat_lantikan_sm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'surat_penetapan_sm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'dokumen_anak_sm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'pas_pembantu_rumah_sm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'surat_bantuan_sm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'surat_kebenaran_perumahan_sm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'borang_permohonan_sm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
        'dokumen_lain_sm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
    ]);

        $fileFields = [
            'kad_pengenalan_sm',
            'sijil_nikah_sm',
            'slip_gaj_sm',
            'surat_lantikan_sm',
            'surat_penetapan_sm',
            'dokumen_anak_sm',
            'pas_pembantu_rumah_sm',
            'surat_bantuan_sm',
            'surat_kebenaran_perumahan_sm',
            'borang_permohonan_sm',
            'dokumen_lain_sm'
        ];

      // get all input data
    $data = $request->except($fileFields);

    // handle files
    foreach ($fileFields as $field) {
        if ($request->hasFile($field)) {
            $path = $request->file($field)->store('menunggu', 'public');
            $data[$field] = $path;

            // Delete old file if exists
            if ($damenunggu->$field && \Storage::disk('public')->exists($damenunggu->$field)) {
                \Storage::disk('public')->delete($damenunggu->$field);
            }

        } else {
            $data[$field] = $damenunggu->$field; // keep old file

        }
    }

    $damenunggu->update($data);

    return redirect()
        ->route('daperumahan.daperumahan.indexmenunggu')
        ->with('success_message', 'Pemohon telah dikemaskini!');
}

    public function indexperumahan()
    {
        return view('daperumahan.indexperumahan');
    }

    public function indexrsbaharu()
    {
        return view('daperumahan.indexrsbaharu');
    }

    public function indexrskosong()
    {
        return view('daperumahan.indexrskosong');
    }

    public function indexiqkosong()
    {
        return view('daperumahan.indexiqkosong');
    }

    public function indexarkib()
    {
        return view('daperumahan.indexarkib');
    }
    
}