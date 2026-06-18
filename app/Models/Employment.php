<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
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
    protected $table = 'emp_employment_infos';

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
            'ministry_id',
            'department_id',
            'bahagian_id',
            'bahagian_other',
            'unit_id',
            'unit_other',
            'school_id',
            'cluster_id',
            'district_work_id',
            'service_begin_date',
            'first_service_place',
            'retirement_date',
            'current_designation_date',
            'current_service_place',
            'service_status_id',
            'role',
            'role_date_start',
            'designation_id',
            'current_designation_id',
            'employment_status_id',
            'division_id',
            'salary_scale',
            'salary',
            'allowance_category_id',
            'skim_perguruan',
            'skim_perkhidmatan_id',
            'ssm_reference_no',
            'dept_reference_no',
            'code _service',
            'personnel_file',
            'first_service_place',
            'currrent_service_place',
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
	public function department()
    {
        return $this->belongsTo('App\Models\Department','department_id');
    }
	
	
	public function employmentstatus()
    {
        return $this->belongsTo('App\Models\EmploymentStatus','employment_status_id');
    }
	
	public function designation()
    {
        return $this->belongsTo('App\Models\Designation','designation_id');
    }
	
	public function currentDesignation()
    {
        return $this->belongsTo('App\Models\Designation','current_designation_id');
    }
	 
	public function division()
    {
        return $this->belongsTo('App\Models\Division','division_id');
    }
	
	public function allowancecategory()
    {
        return $this->belongsTo('App\Models\AllowanceCategory','allowance_category_id');
    }
	
	public function ministry()
    {
        return $this->belongsTo('App\Models\Ministry','ministry_id');
    }
	
	public function bahagian()
    {
        return $this->belongsTo('App\Models\Bahagian','bahagian_id');
    }
	
	public function district()
    {
        return $this->belongsTo('App\Models\District','district_work_id');
    }
	
	public function skimperkhidmatan()
    {
        return $this->belongsTo('App\Models\SkimPerkhidmatan','skim_perkhidmatan_id');
    }
	
	public function unit()
    {
        return $this->belongsTo('App\Models\Unit','unit_id');
    }
	
	public function salaryScale()
    {
        return $this->belongsTo('App\Models\SalaryScale','salary_scale');
    }
	
	public function rolePeranan()
    {
        return $this->belongsTo('App\Models\RolePeranan','role');
    }

    public function serviceStatus()
    {
        return $this->belongsTo('App\Models\ServiceStatus','service_status_id');
    }


    public function school()
    {
        return $this->belongsTo('App\Models\School', 'school_id');
    }
    
    public function cluster()
    {
        return $this->belongsTo('App\Models\Cluster','cluster_id');
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
