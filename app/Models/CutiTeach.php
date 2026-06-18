<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CutiTeach extends Model
{
    protected $table = 'cuti_teach';

    protected $casts = [
        'tarikh_mula_khas' => 'date',
        'tarikh_hingga_khas' => 'date',

        'tarikh_mula_ctg' => 'date',
        'tarikh_hingga_ctg' => 'date',

        'tarikh_melapor_khas' => 'date',
        'tarikh_melapor_ctg' => 'date',

    ];

    protected $fillable = [
        'no_kad_pintar',
        'jenis_cuti',

        'tarikh_mula_khas',
        'tarikh_hingga_khas',

        'tarikh_mula_ctg',
        'tarikh_hingga_ctg',

        'jumlah_khas',
        'justifikasi_khas',
        'kategori_khas',
        'status_khas',

        'jumlah_ctg',
        'justifikasi_ctg',
        'kategori_ctg',
        'status_ctg',

        'tarikh_melapor_khas',
        'tarikh_melapor_ctg' 
    ];

        /**
     * Relationship to Teacher
     */
    public function teacher()
    {
        return $this->belongsTo(PemegangJawatanTeach::class, 'no_kad_pintar', 'No Kad Pintar');
    }
}