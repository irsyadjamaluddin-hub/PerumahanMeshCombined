<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompMkpkDm extends Model
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
    protected $table = 'comp_mkpk_dm';

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
        'dm_competencies',
        'dm_rcl',

        'dm_evd',
        'r_dm_evd',

        'dm_icl',

        'dm_outcome',
        'r_dm_outcome',

        'dm_otj',
        'r_dm_otj',

        'dm_st',
        'r_dm_st',

        'dm_ft',
        'r_dm_ft'

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
