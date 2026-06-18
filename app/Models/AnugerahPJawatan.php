<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnugerahPJawatan extends Model
{

    public $timestamps = true;

    protected $table = 'anugerah_pjawatan';

    protected $primaryKey = 'id'; // default

    protected $fillable = [
        'pemegang_jawatan_id',
        'tahun',
        'nama_anugerah',
        'peringkat',
        'penganjur',
        'catatan',
      
              ];
			  
    protected $dates = [];

    public $incrementing = true;

}
