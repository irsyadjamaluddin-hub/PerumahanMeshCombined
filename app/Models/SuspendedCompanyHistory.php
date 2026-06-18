<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuspendedCompanyHistory extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'suspended_company_history';

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
                'ic_no',
                'nama_syarikat',
                'kementerian',
                'bil_rujukan',
                'sebab',
                'sebab_delete',
                'date_start',
                'date_end',
                'created_at',
                ];

    protected $dates = ['date_start', 'date_end'];

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

    public $timestamps = false;

}
