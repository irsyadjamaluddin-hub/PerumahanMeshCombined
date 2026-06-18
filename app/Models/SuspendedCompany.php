<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuspendedCompany extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'suspended_company';

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
                'nama_syarikat',
                'kementerian',
                'tempoh_bulanan',
                'bil_rujukan',
                'sebab',
                'date_start',
                'date_end',
                'created_at',
                'updated_at',
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
