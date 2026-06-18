<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CCASenarai extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cca_senarais';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'kelab_cca_id',
        'nama_cca',
        'nama_cca_khusus',
        'komponen',
        // 'kaitan',
        'tahun',
        'jantina_stat',
        'jumlah_stat',
        'created_by_ic_no',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function namacca()
    {
        return $this->belongsTo('App\Models\CCA_Name','nama_cca', 'code');
    }

    public function namacca2()
    {
        return $this->belongsTo('App\Models\CCA_Name2','nama_cca', 'code');
    }
}
