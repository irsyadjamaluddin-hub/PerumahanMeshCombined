<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSM extends Model
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
    protected $table = 'ssms';

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
        'name',
        'address',
        'dob',
        'place_of_birth',
        'gender_id',
        'current_designation_id',
        'current_service_place',
        'current_designation_date',
        'bersara_date',
        'telephone_mobile',
        'email',
        'martial_status_id',
        'race_id',
        'race_other',
        'religion_id',
        'ic_file',
        'ic_filename',
        'apptletter_filename',
        'apptletter_file',
        'workreport_filename',
        'workreport_file',
        'passport_filename',
        'passport_file',
        'status_ssm',
        'position_id',
        'password',
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
