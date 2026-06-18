<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perjawatan extends Model
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
    protected $table = 'perjawatans';

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
        'name',
        'nofolio',
        'ic_no',
        'dob',
        'department',
        'salary_scale',
        'place',
        'appt_date',
        'promoted_date',
        'employmentstatuss',
        'created_by_ic_no'

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


    public function salaryScale()
    {
        return $this->belongsTo('App\Models\SalaryScale', 'salary_scale');
    }


    public function EmploymentStatus()
    {
        return $this->belongsTo('App\Models\EmploymentStatus', 'employmentstatuss');
    }

    public function Department()
    {
        return $this->belongsTo('App\Models\Department', 'department');
    }
}
