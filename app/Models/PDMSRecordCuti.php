<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDMSRecordCuti extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pdms_rekod_cuti';

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
        'jenis_cuti',
        'jumlah_hari',
        'tarikh_mula',
        'tarikh_akhir',
        'remark',
        'updated_by',
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

}
