<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

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
    protected $table = 'bookingsystem';

    /**
     * The database primary key value.
     *
     * @var string
     */
    // protected $primaryKey = 'id';
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'name',
        'nama_pegawai',
        'dept',
        'ic_no',
        'room_no',
        'phone_number',
        'syarikat_jabatan',
        'que_no',
        'start_time',
        'end_time',
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

    public $incrementing = false;

    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */

    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */

    public function dept()
    {
        return $this->belongsTo('App\Models\Department', 'dept');
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }
}
