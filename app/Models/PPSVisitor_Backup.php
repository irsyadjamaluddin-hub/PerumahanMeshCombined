<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPSVisitor_Backup extends Model
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
    protected $table = 'ppsvisitor_backup';

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

        'pps_id',

        'exam_sept',
        'exam_oct',
        'exam_nov',
        'exam_dec',
        'exam_jan',

        'scholarship_sept',
        'scholarship_oct',
        'scholarship_nov',
        'scholarship_dec',
        'scholarship_jan',

        'swasta_sept',
        'swasta_oct',
        'swasta_nov',
        'swasta_dec',
        'swasta_jan',

        'kewangan_ge_sept',
        'kewangan_ge_oct',
        'kewangan_ge_nov',
        'kewangan_ge_dec',
        'kewangan_ge_jan',

        'kewangan_pht_sept',
        'kewangan_pht_oct',
        'kewangan_pht_nov',
        'kewangan_pht_dec',
        'kewangan_pht_jan',

        'jss_sept',
        'jss_oct',
        'jss_nov',
        'jss_dec',
        'jss_jan',

        'jppe_sept',
        'jppe_oct',
        'jppe_nov',
        'jppe_dec',
        'jppe_jan',

        'perumahan_sept',
        'perumahan_oct',
        'perumahan_nov',
        'perumahan_dec',
        'perumahan_jan',

        'kewangan_b_sept',
        'kewangan_b_oct',
        'kewangan_b_nov',
        'kewangan_b_dec',
        'kewangan_b_jan',

        'lncp_dec',
        'sbpp_jan',
        'jb_jan',
        'jss_ps_jan',
        'jpp_jan',        

        'created_at',
        'updated_at'
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

    public $incrementing = false;

    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */



    public function getCreatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }


    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

}
