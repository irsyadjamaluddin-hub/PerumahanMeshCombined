<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSMOthers extends Model
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
    protected $table = 'ssm_others';

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
        'ot_name',
        'ot_icno',
        'ot_jawatan',
        'ot_workplace',
        'ot_email',
        'ot_notel',
        'ot_catatan',
        'ot_status',
        'ot_created_at',
        'ot_created_by',
        'ot_updated_at',
        'ot_updatedby',
        'dinamik_updatedat',
        'dinamik_updatedby',
        'diteliti_updatedat',
        'diteliti_updatedby',
        'selesai_updatedat',
        'selesai_updatedby'
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

    protected static function booted()
    {
        static::creating(function ($model) {
            // Customize the ID format as needed
            // $model->id = 'OT' . $model->id;
        });
    }
}
