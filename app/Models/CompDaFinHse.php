<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompDaFinHse extends Model
{
    use HasFactory;

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
    protected $table = 'comp_da_finhse';

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
        'competency_info_id',
        'indv_icno',
        'finhse_competencies',
        'finhse_rcl',
        'finhse_evd',
        'finhse_icl',
        'finhse_outcome',
        'finhse_otj',
        'finhse_st',
        'finhse_ft',
        'r_finhse_evd',
        'r_finhse_outcome',
        'r_finhse_otj',
        'r_finhse_st',
        'r_finhse_ft'
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
}
