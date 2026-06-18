<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompDaHseak extends Model
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
    protected $table = 'comp_da_hseak';

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
        'hseak_competencies',
        'hseak_rcl',
        'hseak_evd',
        'hseak_icl',
        'hseak_outcome',
        'hseak_otj',
        'hseak_st',
        'hseak_ft',
        'r_hseak_evd',
        'r_hseak_outcome',
        'r_hseak_otj',
        'r_hseak_st',
        'r_hseak_ft'
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
