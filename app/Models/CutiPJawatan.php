<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutiPJawatan extends Model
{

    public $timestamps = true;

    protected $table = 'cuti_pjawatan';

    protected $primaryKey = 'id'; // default

    protected $fillable = [
        'pemegang_jawatan_id',
        'jenis_cuti',
        'tarikh_mula',
        'tarikh_tamat',
        'jumlah',
        'sebab',
        'kategori',
        'catatan',
        'tarikh_lapor',
      
              ];
			  
    protected $dates = [];

    public $incrementing = true;

}
