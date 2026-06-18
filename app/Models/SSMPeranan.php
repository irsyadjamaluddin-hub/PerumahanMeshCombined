<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSMPeranan extends Model
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
    protected $table = 'ssm_peranan';

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
        'pe_name',
        'pe_icno',
        'pe_jawatan',
        'pe_email',
        'pe_notel',
        'pe_peranan',
        'pe_catatan',
        'pe_status',
        'pe_created_at',
        'pe_created_by',
        'pe_updated_at',
        'pe_updatedby',
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
            // $model->id = 'PE' . $model->id;
        });
    }
}
