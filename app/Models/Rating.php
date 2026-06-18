<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// ====================================================================================================
// Added by Amal 'Izzah (PB)
class Rating extends Model
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
    protected $table = 'rate';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'rateID';
    
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rateID',
        'event',
        'jabatan',
        'rating1',
        'rating2',
        'rating3',
        'feedback'
      
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

    // public function perkaraevent()
    // {
    //     return $this->belongsTo(Perkaraevent::class, 'event');
    // }

    // ====================================================================================================

 
    // public $incrementing = false;
	
    // /**
    //  * Get created_at in array format
    //  *
    //  * @param  string  $value
    //  * @return array
    //  */

    // public function Department()
    // {
    //     return $this->belongsTo('App\Models\Department','jabatan');
    // }

    // public function Perkaraevent()
    // {
    //     return $this->belongsTo('App\Models\Perkaraevent','event');
    // }

  
	
    // public function getCreatedAtAttribute($value)
    // {
    //     return date('j/n/Y g:i A', strtotime($value));
    // }
	
	
    // /**
    //  * Get updated_at in array format
    //  *
    //  * @param  string  $value
    //  * @return array
    //  */
    // public function getUpdatedAtAttribute($value)
    // {
    //     return date('j/n/Y g:i A', strtotime($value));
    // }
}
