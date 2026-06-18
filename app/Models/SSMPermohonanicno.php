<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSMPermohonanicno extends Model
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
    protected $table = 'ssm_permohonanicno';

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
        'icno_pemohon',
        'permohonan_icno',
        'kod',
        'status',
        'submitted_at',
        'catatantindakan',
        'catatankivadmin',
        'ic_no_kivadmin',
        'created_at',
        'created_by'
    ];

    public function ssmkod()
    {
        return $this->belongsTo(SSMKod::class, 'kod', 'ic_no');
    }

    public function ssmkodindex()
    {
        return $this->belongsTo(SSMKod::class, 'kod', 'ic_no');
    }

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

}
