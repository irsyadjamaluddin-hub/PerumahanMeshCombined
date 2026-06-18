<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
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
    protected $table = 'emp_education_infos';

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
			'education_id',
			'education_name',
			'graduation_date',
            'file_name',
            'file',
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
	 
	public function educationLevel()
    {
        return $this->belongsTo('App\Models\EducationLevel','education_id');
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
