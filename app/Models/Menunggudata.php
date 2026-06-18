<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menunggudata extends Model
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
    protected $table = 'menunggudata';

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
      'tarikh_diterima',
      'nama_pemohon',
      'no_kp_pemohon',
      'tarikh_lahir',
      'tarikh_bersara',
      'taraf_kelamin',
      'nama_tanggungan',
      'alamat_persuratan',
      'no_tell',
      'alamat_tinggal',
      'tempat_pemohon',
      'jawatan_pemohon',
      'bhg_pemohon',
      'bahagian_tanggagaji',
      'gaji_terkini',
      'tarikh_lantikan',
      'status_lantikan',
      'tarikh_jawatan',
      'nama_pasangan',
      'tempat_bertugas_pasangan',
      'nama_kementerian',
      'kemudahan_kerja',
      'tarikh_permohonan',
      'status_permohonan',
      'kelayakan_perumahan',
      'kelas',
      'daerah',
      // File fields
      'kad_pengenalan_sm',
      'sijil_nikah_sm',
      'slip_gaji_sm',
      'surat_lantikan_sm',
      'surat_penetapan_sm',
      'dokumen_anak_sm',
      'pas_pembantu_rumah_sm',
      'surat_bantuan_sm',
      'surat_kebenaran_perumahan_sm',
      'borang_permohonan_sm',
      'dokumen_lain_sm',
  ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
      // Define date columns for automatic type casting
      protected $dates = [
       
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

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
  

}
