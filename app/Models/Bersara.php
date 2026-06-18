<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bersara extends Model
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
    protected $table = 'bersaras';

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
                  'bersara_post',
                  'penamatan',
                  'peruntukanbersara',
                  'end_date_bersara',
                  'date_cuti_bersara',
                  'date_bersara',
                  'ulasan'
     
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
    
    public function retirementposition()
    {
        return $this->belongsTo('App\Models\Retirementposition','bersara_post');
    }

    public function retirementposition1()
    {
        return $this->belongsTo('App\Models\Retirementposition','peruntukanbersara');
    }

    public function terminationtype()
    {
        return $this->belongsTo('App\Models\Terminationtype','penamatan');
    }




}
