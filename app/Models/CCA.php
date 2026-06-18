<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CCA extends Model
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
    protected $table = 'kelab_ccas';

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
        'school_name',
        'kluster',
        'nama_guru',
        'ic_no_guru',
        'guru_position',
        'jantina',
        'no_tel_guru',
        'email',
        'nama_guru1',
        'ic_no_guru1',
        'guru_position1',
        'jantina1',
        'no_tel_guru1',
        'email1',
        'nama_guru2',
        'ic_no_guru2',
        'guru_position2',
        'jantina2',
        'no_tel_guru2',
        'email2',
        'jum_lelaki_pra',
        'jum_perempuan_pra',
        'jum_lelaki_1',
        'jum_perempuan_1',
        'jum_lelaki_2',
        'jum_perempuan_2',
        'jum_lelaki_3',
        'jum_perempuan_3',
        'jum_lelaki_4',
        'jum_perempuan_4',
        'jum_lelaki_5',
        'jum_perempuan_5',
        'jum_lelaki_6',
        'jum_perempuan_6',
        'jum_lelaki_7',
        'jum_perempuan_7',
        'jum_lelaki_8',
        'jum_perempuan_8',
        'jum_lelaki_9',
        'jum_perempuan_9',
        'jum_lelaki_10',
        'jum_perempuan_10',
        'jum_lelaki_11',
        'jum_perempuan_11',
        'jum_lelaki_12',
        'jum_perempuan_12',
        'jum_lelaki_13',
        'jum_perempuan_13',
        'hari_pra',
        'hari_tahun_1',
        'hari_tahun_2',
        'hari_tahun_3',
        'hari_tahun_4',
        'hari_tahun_5',
        'hari_tahun_6',
        'hari_tahun_7',
        'hari_tahun_8',
        'hari_tahun_9',
        'hari_tahun_10',
        'hari_tahun_11',
        'hari_tahun_12',
        'hari_tahun_13',
        'jam_mula_pra',
        'jam_mula_tahun1',
        'jam_mula_tahun2',
        'jam_mula_tahun3',
        'jam_mula_tahun4',
        'jam_mula_tahun5',
        'jam_mula_tahun6',
        'jam_mula_tahun7',
        'jam_mula_tahun8',
        'jam_mula_tahun9',
        'jam_mula_tahun10',
        'jam_mula_tahun11',
        'jam_mula_tahun12',
        'jam_mula_tahun13',
        'jam_berakhir_pra',
        'jam_berakhir_tahun1',
        'jam_berakhir_tahun2',
        'jam_berakhir_tahun3',
        'jam_berakhir_tahun4',
        'jam_berakhir_tahun5',
        'jam_berakhir_tahun6',
        'jam_berakhir_tahun7',
        'jam_berakhir_tahun8',
        'jam_berakhir_tahun9',
        'jam_berakhir_tahun10',
        'jam_berakhir_tahun11',
        'jam_berakhir_tahun12',
        'jam_berakhir_tahun13',
        'nama_cca',
        'komponen',
        'kaitan',
        'class',
        'jantina_stat',
        'created_by_ic_no',
        'created_at',
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


    public function schools()
    
    {
        return $this->belongsTo('App\Models\School', 'school_name');
    }

    // Define the relationship to the teachers table
        public function teachers()
        {
            return $this->hasMany(KelabCcasTeachers::class, 'kelab_cca_id');
        }

}
