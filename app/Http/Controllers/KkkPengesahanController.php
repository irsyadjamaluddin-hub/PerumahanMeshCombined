<?php

namespace App\Http\Controllers;

use App\Models\Kkk\KkkPengesahanPenerimaan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * (KKK1) Pengesahan Penerimaan Kunci Kira-Kira — public form a school fills in
 * when it hands in its Laporan Kunci Kira-Kira. Same layout as
 * /borangpermohonanperanan. Dropdown options: config/kkk_pengesahan.php.
 */
class KkkPengesahanController extends Controller
{
    public function create()
    {
        $opsyen = config('kkk_pengesahan');

        return view('kkk.pengesahan-penerimaan', compact('opsyen'));
    }

    public function store(Request $request)
    {
        $opsyen = config('kkk_pengesahan');
        $lain = $opsyen['lain_lain'];
        $sekolahKluster = $opsyen['sekolah'][$request->input('kluster')] ?? [];

        $data = $request->validate([
            'kluster'           => ['required', Rule::in(array_keys($opsyen['sekolah']))],
            'nama_sekolah'      => ['required', Rule::in(array_merge($sekolahKluster, [$lain]))],
            'nama_sekolah_lain' => ['nullable', 'required_if:nama_sekolah,' . $lain, 'string', 'max:200'],
            'kategori'          => ['required', Rule::in($opsyen['kategori'])],
            'jenis'             => ['required', Rule::in($opsyen['jenis'])],
            'tempoh'            => ['required', Rule::in($opsyen['tempoh'])],
            'tahun'             => ['required', 'integer', 'between:' . $opsyen['tahun_dari'] . ',' . $opsyen['tahun_hingga']],
            'nama_penghantar'   => ['required', 'string', 'max:150'],
            'jawatan'           => ['required', 'string', 'max:150'],
            'no_tel'            => ['required', 'regex:/^[0-9]{7}$/'],
        ], [
            'required'                       => 'Ruangan :attribute perlu diisi.',
            'nama_sekolah_lain.required_if'  => 'Sila nyatakan nama sekolah.',
            'nama_sekolah.in'                => 'Sila pilih sekolah daripada senarai kluster yang dipilih.',
            'no_tel.regex'                   => 'Nombor telefon mestilah 7 digit.',
        ], [
            'kluster'         => 'Kluster',
            'nama_sekolah'    => 'Nama Sekolah',
            'kategori'        => 'Kategori Kunci Kira-Kira',
            'jenis'           => 'Jenis Kunci Kira-Kira',
            'tempoh'          => 'Tempoh Kunci Kira-Kira',
            'tahun'           => 'Tahun',
            'nama_penghantar' => 'Nama Penghantar Laporan',
            'jawatan'         => 'Jawatan',
            'no_tel'          => 'Nombor Telefon',
        ]);

        if ($data['nama_sekolah'] === $lain) {
            $data['nama_sekolah'] = trim($data['nama_sekolah_lain']);
        }
        unset($data['nama_sekolah_lain']);

        KkkPengesahanPenerimaan::create($data);

        return redirect()->route('kkk.pengesahan')
            ->with('success_message', 'Terima kasih. Pengesahan penerimaan Kunci Kira-Kira telah dihantar.');
    }
}
