<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KenaikanGaji extends Model
{

    public $timestamps = true;

    protected $table = 'kenaikan_gaji';

    protected $primaryKey = 'id'; // default

    protected $fillable = [
        'pemegang_jawatan_id',
        'tahun',
        'tarikh_kenaikan',
        'gaji',
        'markah_prestasi',
        'gred_prestasi',
        'lain_lain',
        'catatan',
      
    ];

    protected $casts = [
        'tarikh_kenaikan' => 'date',
    ];

    public $incrementing = true;

}
