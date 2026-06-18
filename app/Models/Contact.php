<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
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
    protected $table = 'emp_contact_infos';

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
            'address',
            'postcode',
            'country_id',
			'telephone_office',
			'telephone_home',
			'telephone_mobile',
            'personal_email',
            'name_ec',
            'tel_ec',
            'rs_ec',
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

    public function country()
    {
        return $this->belongsTo('App\Models\Country','country_id');
    }

    public function emergencyRelationsip()
    {
        return $this->belongsTo('App\Models\EmergencyRelationship','rs_ec');
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
