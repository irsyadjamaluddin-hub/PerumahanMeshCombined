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
    public $incrementing = true;
    protected $keyType = 'int';

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
        'kadar_sewa_potongan_sebulan',
        'sewa_sebulan',
        'sewa_sebulan_perabot',
        'tarikh_mula_disewa',
        'bermula',
        'berakhir',
        'no_kp2',
        'gelaran2',
        'nama_penghuni',
        'jawatan',
        'salinan_kpd',
        'tempat_bertugas',
        'mob2',
        'tarikh_mendiami',
        'tarikh_mula_mendiami',
        'tarikh_kosong',
        'tarikh_mengosongkan',
        'rujukan_jpm',
        'notis_bermula',
        'notis_berakhir',
        'automatik',
        'perabot_dihentikan_sementara',
        'kadar_sewa_perabot_lama',
        'kadar_sewa_perabot_terkini',
        'catatan_perabot',
        'kali_ke',
        'status_rumah',
        'status_permohonan',
        'image',
        'daerah',
        'catatan_pemilik',
        'catatan_penghuni',
        'tarikh_lahir_penghuni',
        'tarikh_bersara_penghuni',
        'status_rumahtangga',
        'tangga_gaji',
        'gaji_terkini',
        'bahagian',
        'taraf_kelamin',
        'tarikh_lantikan',
        'status_lantikan',
        'tarikh_jawatan',
        'nama_penuh_pasangan',
        'tempat_bertugas_pasangan',
        'nama_kementerian',
        'kemudahan_kerajaan',
        'alamat_rumah_sewa',
        'alamat_perumahan_kerjaaniq',
        'blok',
        'pembekalan_perabot',
        'jenis_iq',
        'jumlah_bilik',
        'jumlah_tandas',
        'no_kp_penghuni',
        'jawatan_penghuni',
        'tanggungan',
        'nama_pemohon',
        'no_kp_pemohon',
        'tarikh_lahir',
        'tarikh_bersara',
        'nama_tanggungan',
        'no_tell',
        'alamat_tinggal',
        'tempat_pemohon',
        'jawatan_pemohon',
        'bhg_pemohon',
        'bahagian_tanggagaji',
        'tarikh_permohonan',
        'kelayakan_perumahan',
        'tarikh_diterima',
        'nama_pasangan',
        'kemudahan_kerja',
    
        // File fields Senarai Penghuni 
        'borang_maklumat',
        'kad_pengenalan',
        'slip_gaji',
        'sijil_nikah',
        'surat_lantikan',
        'surat_penetapan',
        'dokumen_anak',
        'surat_bantuan',
        'dokumen_tawaran',
        'dokumen_mendiami',
        'dokumen_pengakuan',
        'dokumen_kosong',
        'dokumen_lain',

    // File fields Senarai Penghuni IQ
        'borang_maklumat_spiq',
        'gambar_spiq',
        'kad_pengenalan_spiq',
        'slip_gaji_spiq',
        'surat_lantikan_spiq',
        'surat_penetapan_spiq',
        'dokumen_anak_spiq',
        'surat_bantuan_spiq',
        'dokumen_tawaran_spiq',
        'dokumen_mendiami_spiq',
        'dokumen_pengakuan_spiq',
        'dokumen_kosong_spiq',
        'dokumen_lain_spiq',

    // File fields Senarai Pemilik
        'borang_penyambungan',
        'dokumen_perjanjian',
        'laporan_teknikal',
        'insurans',
        'resit_pemadam_kebakaran',
        'kpp_pemilik',
        'surat_op',
        'geran_tanah',
        'gambar_rumah',
        'pengesah_penomboran',
        'senarai_perabot',
        'memorandum_perabot',
        'surat_abci',
        'sale_purchase_agreement',
        'permohonan_kerajaan',
        'dokumen_lain_spmlk',
    ];
    
        public function rumahPemilik()
{
    return $this->hasMany(RumahPemilik::class);
}

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
    public function getTarikhMendiamiFormattedAttribute()
    {
        if (empty($this->tarikh_mendiami)) {
            return null;
        }

        try {
            return \Carbon\Carbon::parse($this->tarikh_mendiami)->format('d/m/y');
        } catch (\Exception $e) {
            return $this->tarikh_mendiami;
        }
    }

}