<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSMBakicuti extends Model
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
    protected $table = 'ssm_bakicuti';

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
        'bc_name',
        'bc_icno',
        'bc_jawatan',
        'bc_notel',
        'bc_workplace',
        'bc_days',
        'bc_daysjpp',
        'bc_file',
        'bc_date',
        'bc_catatanuser',
        'bc_catatanadmin',
        'bc_created_at',
        'bc_updated_at',
        'bc_updated_by',
        'bc_status',
        'bc_hd_at',
        'bc_hd_by',
        'bc_selesai_at',
        'bc_selesai_by',
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
    protected $casts = [
        'bc_file' => 'array',
    ];

}
