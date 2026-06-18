<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iqdata extends Model
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
    protected $table = 'iqdata';

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
        'daerah',
        'rujukan_fail',
        'alamat_1',
        'kelas_1',
        'kadar_sewa_1',
        'kadar_sewa_penuh',
        'alamat_2',
        'nama_tuan_rumah_sewa',
        'kelas_2',
        'gelaran_1',
        'nama_penghuni',
        'no_kp_penghuni',
        'tarikh_lahir',
        'nama_suami_isteri',
        'no_kp_suami_isteri',
        'no_tel',
        'no_fail_peribadi',
        'bahagian_tanggagaji',
        'jawatan_penghuni',
        'salinan_kpd',
        'tempat_bertugas',
        'tarikh_mendiami',
        'tarikh_mengosongkan',
        'wg',
        'catatan'
     
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
