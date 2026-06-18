<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawtanKosong extends Model
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
    protected $table = 'jawatankosong';

    /**
     * The database primary key value.
     *
     * @var string
     */
    // protected $primaryKey = 'dis_id';
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'dept_id',
        'dept_label',
        'jawatan',
        'tanggagajii',
        'bhg',
        'jum_kosong',
        'catatan',
        'status',
        'created_at',
        'updated_at',
        'ic_no1',
        'name1',
        'ic_no2',
        'name2',
        'ic_no3',
        'name3'
        
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

    public function kepada()
    {
        return $this->belongsTo('App\Models\Kepada', 'kpd');
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

    public function getDataAttribute($value)
{
    return json_decode($value, true);
}

public function tanggagaji()
{
    return $this->belongsTo('App\Models\SalaryScale','tanggagaji');
}

public function bahagian()
{
    return $this->belongsTo('App\Models\Division','bhg');
}

public function Jawatan()
{
    return $this->belongsTo('App\Models\Jawatanlist','jawatan');
}
}
