<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompJppeFmmaw extends Model
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
    protected $table = 'comp_jppe_fmmaw';

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
        'fmmaw_competencies',
        'fmmaw_rcl',

        'fmmaw_evd',
        'r_fmmaw_evd',

        'fmmaw_icl',

        'fmmaw_outcome',
        'r_fmmaw_outcome',

        'fmmaw_otj',
        'r_fmmaw_otj',

        'fmmaw_st',
        'r_fmmaw_st',

        'fmmaw_ft',
        'r_fmmaw_ft'

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
