<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
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
    protected $table = 'emp_salary_infos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'ic_no';
    
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
            'ic_no',
            'salaryscale_id',
            'increment_date',
            'division_id',
            'salary',
            'allowance_category_id',
			'updated_at',
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
	public function division()
    {
        return $this->belongsTo('App\Models\Division','division_id');
    }
	
	public function allowancecategory()
    {
        return $this->belongsTo('App\Models\AllowanceCategory','allowance_category_id');
    }
	
	public function salaryScale()
    {
        return $this->belongsTo('App\Models\SalaryScale','salaryscale_id');
    }
	
	
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
