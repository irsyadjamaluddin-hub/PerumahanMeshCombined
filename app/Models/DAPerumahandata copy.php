<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAPerumahandata extends Model
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
    protected $table = 'daperumahandata';

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
        'rujukan_fail',
        'mukim',
        'no_kp1',
        'gantinama',
        'gelaran',
        'nama_pemilik',
        'alamat_persuratan',
        'lokasi',
        'kampung',
        'mob1',
        'kelas',
        'kadar_sewa_awal',
        'kadar_sewa_minima',
        'tarikh_menerima_kadar_sewa_minima',
        'kadar_sewa_potongan_sebulan',
        'tarikh_mula_disewa',
        'bermula',
        'berakhir',
        'lokasi2_datamaklumat',
        'no_kp2',
        'gelaran2',
        'nama_penghuni',
        'jawatan',
        'salinan_kpd',
        'tempat_bertugas',
        'mob2',
        'tarikh_mendiami',
        'tarikh_kosong',
        'rujukan_jpm',
        'tarikh_surat_jpm_hijrah',
        'tarikh_surat_jpm_masehi',
        'notis_bermula',
        'notis_berakhir',
        'automatik',
        'nama_pemilik_berpindahdari',
        'lokasi_berpindahdari',
        'kelas_rsberpindahdari',
        'kadar_sewa_lokasi_berpindah',
        'potongan_sewa_berpindah',
        'catatan',
        'perabot_dihentikan_sementara',
        'kadar_sewa_perabot_lama',
        'kadar_sewa_perabot_terkini',
        'catatan_perabot',
        'surat_permberitahuan',
        'kali_ke',
        'image',
        'status_rumah',

        'tarikh_menerima_kadar_sewa_minima',
        'tarikh_mula_disewa',
        'bermula',
        'berakhir',
        'tarikh_mendiami',
        'tarikh_kosong',
        'tarikh_surat_jpm_hijrah',
        'tarikh_surat_jpm_masehi',
        'notis_bermula',
        'notis_berakhir'
     
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
