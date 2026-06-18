<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSMApproval extends Model
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
    protected $table = 'ssm_approval';

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
        'ap_name',
        'ap_icno',
        'ap_jawatan',
        'ap_notel',
        'ap_workplace',
        'ap_approvername',
        'ap_approvericno',
        'ap_catatan',
        'ap_status',
        'ap_created_at',
        'ap_created_by',
        'ap_updated_at',
        'ap_updatedby',
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
            //$model->id = 'AP' . $model->id;
        });
    }

}
