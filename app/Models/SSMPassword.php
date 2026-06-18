<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSMPassword extends Model
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
    protected $table = 'ssm_password';

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
        'ps_name',
        'ps_icno',
        'ps_jawatan',
        'ps_workplace',
        'ps_email',
        'ps_notel',
        'ps_otp',
        'ps_catatan',
        'ps_status',
        'ps_created_at',
        'ps_created_by',
        'ps_updated_at',
        'ps_updatedby',
        'hd_updatedat',
        'hd_updatedby',
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
            // $model->id = 'PS' . $model->id;
        });
    }
}
