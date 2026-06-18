<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDMSRecordPerkhidmatan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pdms_rekod_perkhidmatan';

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
        'no_fail',
        'no_ic',
        'id_rekod',
        'jenis_maklumat',
        'jawatan',
        'tarikh_mula',
        'tarikh_hingga',
        'gaji_bulan',
        'rujukan',
        'catitan',
        'created_at',
        'updated_at',
        'updated_by',
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

}
