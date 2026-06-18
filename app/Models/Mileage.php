<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mileage extends Model
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
    protected $table = 'mileages';

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
			'name',
			'ic_no',
			'ic_color_id',
			'dob',
			'marital_status_id',
			'postal_address',
			'postal_code',
			'country_id',
			'telephone_office',
			'telephone_home',
			'telephone_mobile',
			'email',
			'service_begin_date',
			'department_id',
			'unit_id',
			'employment_status_id',
			'designation_id',
			'salary_scale',
			'salary',
			'division_id',
			'allowance_category_id',
			'vehicle_type',
			'registration_plate',
			'duties_performed',
			'locations_of_duty',
			'monthly_mileage',
			'driving_licence_class_id',
			'driving_licence_expiry_date',
			'registration_date',
			'registration_no',
			'roadtax_expiry_date',
			'form_claim_date',
			'hod_name',
			'hod_designation',
			'hod_role',
			'hod_approve_date',
			'maw_name',
			'maw_designation',
			'maw_role',
			'maw_remarks',
			'maw_approve_date',
			'maw_second_name',
			'maw_second_designation',
			'maw_second_role',
			'maw_second_remarks',
			'maw_second_approve_date',
            'maw_endorser_name',
			'maw_endorser_designation',
			'maw_endorser_role',
			'maw_endorser_remarks',
			'maw_endorser_approve_date',
			'da_name',
			'da_remarks',
			'da_approve_date',
			'mileage_status_id',
			'file_1',
			'file_2',
			'file_3',
			'file_4',
			'file_5',
			'file_6',
			'file_7',
			'file_8',
			'file_9',
			'file_10',
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
     * Get the maritalStatus for this model.
     */
	public function maritalStatus()
    {
        return $this->belongsTo('App\Models\MaritalStatus','marital_status_id');
    }
	
	public function icColor()
    {
        return $this->belongsTo('App\Models\ICColor','ic_color_id');
    }
	
	public function department()
    {
        return $this->belongsTo('App\Models\Department','department_id');
    }
	
	public function unit()
    {
        return $this->belongsTo('App\Models\Unit','unit_id');
    }
	
	public function mileageStatus()
    {
        return $this->belongsTo('App\Models\MileageStatus','mileage_status_id');
    }
	
	public function designation()
    {
        return $this->belongsTo('App\Models\Designation','designation_id');
    }
	
	public function hodDesignation()
    {
        return $this->belongsTo('App\Models\Designation','hod_designation');
    }
	
	public function mawDesignation()
    {
        return $this->belongsTo('App\Models\Designation','maw_designation');
    }
	
	public function mawSecondDesignation()
    {
        return $this->belongsTo('App\Models\Designation','maw_second_designation');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }

    public function employmentStatus()
    {
        return $this->belongsTo('App\Models\EmploymentStatus','employment_status_id');
    }

    public function division()
    {
        return $this->belongsTo('App\Models\Division','division_id');
    }

    public function allowanceCategory()
    {
        return $this->belongsTo('App\Models\AllowanceCategory','allowance_category_id');
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
