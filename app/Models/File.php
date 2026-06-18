<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
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
    protected $table = 'emp_file_infos';

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
			'emp_file_id',
			'ic_filename',
			'ic_file',
            'drivelicense_filename',
            'drivelicense_file',
            'apptletter_filename',
            'apptletter_file',
            'workreport_filename',
            'workreport_file',
            'passport_filename',
            'passport_file',
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
