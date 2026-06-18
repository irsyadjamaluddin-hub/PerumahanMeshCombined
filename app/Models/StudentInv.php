<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInv extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student_inv';

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
        'level',
        'school_name',
        'pra_sekolah',
        'year',
        'tahun_1',
        'tahun_2',
        'tahun_3',
        'tahun_4',
        'tahun_5',
        'tahun_6',
        'tahun_7',
        'tahun_8',
        'tahun_9',
        'tahun_10',
        'tahun_11',
        'prau_1',
        'prau_2',
        'edited_by',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];


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
