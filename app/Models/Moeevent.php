<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moeevent extends Model
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
    protected $table = 'moeevent';

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
        'event',
        'event_id',
        'nama',
        'icno',
        'jabatan',
        'jawatan',
        'gender',
        'no_tel',
        'created_at',
        'updated_at',
        'email',
        'status',
        'attend',
        'bhg',
      
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

    public function Department()
    {
        return $this->belongsTo('App\Models\Department','jabatan');
    }

    public function Perkaraevent()
    {
        return $this->belongsTo('App\Models\Perkaraevent','event');
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




