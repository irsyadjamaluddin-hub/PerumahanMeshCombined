<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDMSRecordProfile extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pdms_rekod_profile';

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
        'no_ic',
        'ic_colour',
        'name',
        'no_fail_jabatan',
        'jawatan_sekarang',
        'jenis_perkhidmatan',
        'bahagian',
        'tanggagaji',
        'no_fail_jpa',
        'jantina',
        'tarikh_lahir',
        'tarikh_bersara',
        'tempat_lahir',
        'ugama',
        'bangsa',
        'kerakyatan',
        'bilangan_sijil_kerakyatan',
        'tarikh_sijil',
        'taraf_kelamin',
        'tarikh_mula_berkhidmat',
        'alamat_rumah',
        'alamat_lain',
        'telefon_rumah',
        'telefon_mobile',
        'tarikh_lantikan_sekarang',
        'tempat_bertugas',
        'jabatan',
        'kementerian',
        'tarikh_penepatan_jawatan',
        'status',
        'skim_perkhidmatan',
        'skim_perguruan',
        'pemohon',
        'penyata_fail',
        'tarikh_diserahkan',
        'sekolah_maktab',
        'daerah',
        'created_at',
        'created_by',
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
