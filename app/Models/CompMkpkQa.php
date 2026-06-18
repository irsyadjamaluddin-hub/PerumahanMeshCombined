<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompMkpkQa extends Model
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
    protected $table = 'comp_mkpk_qa';

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
        'mkpkqa_competencies',
        'mkpkqa_rcl',

        'mkpkqa_evd',
        'r_mkpkqa_evd',

        'mkpkqa_icl',

        'mkpkqa_outcome',
        'r_mkpkqa_outcome',

        'mkpkqa_otj',
        'r_mkpkqa_otj',

        'mkpkqa_st',
        'r_mkpkqa_st',

        'mkpkqa_ft',
        'r_mkpkqa_ft'

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
