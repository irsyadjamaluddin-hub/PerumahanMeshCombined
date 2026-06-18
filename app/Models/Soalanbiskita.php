<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soalanbiskita extends Model
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
    protected $table = 'soalanbiskitas';

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
                  'kpd_jabatan',
                  'tajuk',
                  'aduan',
                  'nama',
                  'emel',
                  'no_tel',
                  'status',
                  'mesej',
                  'created_at',
                  'updated_at'
                  
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

    public function sbdepartment()
    {
        return $this->belongsTo('App\Models\Soalanbiskita','kpd_jabatan');
    }
}
