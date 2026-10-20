<?php

namespace App\Models\Kkk;

use Illuminate\Database\Eloquent\Model;

class KkkPengesahanPenerimaan extends Model
{
    protected $table = 'kkk_pengesahan_penerimaan';

    protected $fillable = [
        'kluster', 'nama_sekolah', 'kategori', 'jenis', 'tempoh', 'tahun',
        'nama_penghantar', 'jawatan', 'no_tel',
    ];

    protected $casts = ['tahun' => 'integer'];
}
