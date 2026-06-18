<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelabCcasTeachers extends Model
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
    protected $table = 'kelab_ccas_teachers_add';

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
        'kelab_cca_id',
        'add_nama_guru',
        'add_ic_no_guru',
        'add_guru_position',
        'add_jantina',
        'add_no_tel_guru',
        'add_email',
        'created_at',
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
    protected $casts = [];


    public function schools()
    {
        return $this->belongsTo('App\Models\School', 'school_name');
    }

    // Define the relationship back to the CCA model
    public function cca()
    {
        return $this->belongsTo(CCA::class, 'kelab_cca_id');
    }
}