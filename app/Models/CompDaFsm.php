<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompDaFsm extends Model
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
    protected $table = 'comp_da_fsm';

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
        'fsm_competencies',
        'fsm_rcl',
        'fsm_evd',
        'fsm_icl',
        'fsm_outcome',
        'fsm_otj',
        'fsm_st',
        'fsm_ft',
        'r_fsm_evd',
        'r_fsm_outcome',
        'r_fsm_otj',
        'r_fsm_st',
        'r_fsm_ft'
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
