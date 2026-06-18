<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSMKod extends Model
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
    protected $table = 'ssm_kod';

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
        'ic_no',
        'nama',
        'kod',
        'created_at',
        'created_by'
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

    public function permohonanicno()
    {
        return $this->hasMany(SSMPermohonanicno::class, 'kod', 'ic_no');
    }

    public function permohonanicnoSelesai()
    {
        return $this->hasMany(SSMPermohonanicno::class, 'kod', 'ic_no')
                    ->where('status', 'selesai');
    }

}
