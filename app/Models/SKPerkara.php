<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SKPerkara extends Model
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
    protected $table = 'skperkara';

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
                'label',
                'created_at',
                // newly add
                'tarikh_bermula',
                'tarikh_berakhir',
                'status',
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
    
    public function slipkedatangans() {
      return $this->hasMany(SlipKedatangan::class);
    }


}
