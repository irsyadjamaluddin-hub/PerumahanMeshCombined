<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
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
    protected $table = 'biodatas';

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
            'email'
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
     * Get the gender for this model.
     */
	public function iccolor()
    {
        return $this->belongsTo('App\Models\ICColor','ic_color_id');
    }
	
	public function gender()
    {
        return $this->belongsTo('App\Models\Gender','gender_id');
    }
	
	public function maritalstatus()
    {
        return $this->belongsTo('App\Models\MaritalStatus','marital_status_id');
    }
	
	public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }
	
	public function department()
    {
        return $this->belongsTo('App\Models\Department','department_id');
    }

	
	public function unit()
    {
        return $this->belongsTo('App\Models\Unit','unit_id');
    }

    public function cluster()
    {
        return $this->belongsTo('App\Models\Cluster','cluster_id');
    }

    public function servicestatus()
    {
        return $this->belongsTo('App\Models\ServiceStatus','service_status_id');
    }
    
	public function division()
    {
        return $this->belongsTo('App\Models\Division','division_id');
    }
	
	public function allowancecategory()
    {
        return $this->belongsTo('App\Models\AllowanceCategory','allowance_category_id');
    }
	
	public function employmentstatus()
    {
        return $this->belongsTo('App\Models\EmploymentStatus','employment_status_id');
    }
	
	public function race()
    {
        return $this->belongsTo('App\Models\Race','race_id');
    }
	
	public function religion()
    {
        return $this->belongsTo('App\Models\Religion','religion_id');
    }
	
	public function citizenship()
    {
        return $this->belongsTo('App\Models\Citizenship','citizenship_id');
    }
	
	public function ministry()
    {
        return $this->belongsTo('App\Models\Ministry','ministry_id');
    }
	
	public function employments()
    {
        return $this->hasMany('App\Models\Employment','ic_no','ic_no');
    }
	
	public function performances()
    {
        return $this->hasMany('App\Models\Performance','ic_no','ic_no');
    }
	
	public function contacts()
    {
        return $this->hasMany('App\Models\Contact','ic_no','ic_no');
    }

    public function vaccineinfo()
    {
        return $this->belongsTo('App\Models\VaccinationInfo','vac_info');
    }

    public function vaccinedos()
    {
        return $this->belongsTo('App\Models\VaccinationDose','vac_dose');
    }
	
    public function vaccinebooster()
    {
        return $this->belongsTo('App\Models\VaccinationBooster','vac_boost');
    }

    public function vulnerable()
    {
        return $this->belongsTo('App\Models\Vulnerable','vulnerable_id');
    }


	
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
