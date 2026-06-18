<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSMPermohonanSalinan extends Model
{
     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ssm_permohonansalinan';

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
        'permohonan_type',
        'permohonan_date',
        'permohonan_file',
        'permohonan_catatan',
        'created_at',
        'created_by',
        'updated_at',
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
    protected $casts = [
        'permohonan_file' => 'array',
    ];


    protected static function booted()
    {
        static::creating(function ($model) {
            // Customize the ID format as needed
            // $model->id = 'DC' . $model->id;
        });
    }

    public function icnos()
    {
        return $this->hasMany(SSMPermohonanicno::class, 'permohonan_id');
    }

    public function ssmkod()
    {
        return $this->belongsTo(SSMKod::class, 'kiv_by', 'ic_no');
    }

    public function selesaikod()
    {
        return $this->belongsTo(SSMKod::class, 'selesai_by', 'ic_no');
    }

}
