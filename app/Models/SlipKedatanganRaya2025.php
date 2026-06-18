<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlipKedatanganRaya2025 extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'slipkedatangan_raya2025';

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
        'jabatan',
        'nama',
        'jawatan',
        'nomborIc',
        'gender',
        'telefon',
        'remark',
        'created_at'
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

    public function departments()
    {
        return $this->belongsTo('app\Models\Department', 'department_id');
    }
}
