<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ART extends Model
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
    protected $table = 'emp_art_infos';

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
        'art_result',
        'art_image',
        'date_test',
        'updated_at',
        'remark'
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

    public function department()
    {
        return $this->belongsTo('App\Models\Department','department_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Biodata','ic_no');
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
