<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acting extends Model
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
    protected $table = 'actings';

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
                  'ic_no',
                  'name',
                  'acting_post',
                  'acting_salary_scale',
                  'acting_start_date',
                  'acting_end_date',
                  'acting_reason',
                  //'acting_period',
                  'acting_filename',
                  'acting_file',
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
        return $this->belongsTo('App\Models\SalaryScale','acting_salary_scale');
    }

    public function reasonActing()
    {
        return $this->belongsTo('App\Models\ReasonActing','acting_reason');
    }




}
