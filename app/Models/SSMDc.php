<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSMDc extends Model
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
    protected $table = 'ssm_dc';

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
        'dc_name',
        'dc_icno',
        'dc_jawatan',
        'dc_email',
        'dc_notel',
        'dc_datedelete',
        'dc_dateaduan',
        'dc_catatan',
        'dc_file',
        'dc_filename',
        'dc_status',
        'dc_created_at',
        'dc_created_by',
        'dc_updated_at',
        'dc_updatedby',
        'dinamik_updatedat',
        'dinamik_updatedby',
        'padamselesai_updatedat',
        'padamselesai_updatedby',
        'selesai_updatedat',
        'selesai_updatedby',
        'proses_updatedat',
        'proses_updatedby'
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
        'dc_file' => 'array',
        'dc_filename' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            // Customize the ID format as needed
            // $model->id = 'DC' . $model->id;
        });
    }

}
