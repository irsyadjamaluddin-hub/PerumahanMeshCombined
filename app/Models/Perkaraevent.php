<?php

namespace App\Models;

use App\Models\Biodata;  //======================= NEWLY ADDED ================

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkaraevent extends Model
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
    protected $table = 'perkaraevent';

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
        'eventlabel',
        'eventdate',
        'eventdateend',
        'eventtime',
        'eventvenue',
        'icno',
        'jabatan',
        'nama',
        'created_at',
        'updated_at',
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

 
    public $incrementing = false;
	
    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */

    public function Department()
    {
        // return $this->belongsTo('App\Models\Department','jabatan');
        return $this->belongsTo(Department::class, 'jabatan', 'id');
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

    public function participant()
    {
        return $this->belongsTo(moeevent::class, 'id', 'id');
    }


    public function biodata()
    {
    return $this->belongsTo(Biodata::class, 'icno', 'ic_no');
    }
}
