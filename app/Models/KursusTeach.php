<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KursusTeach extends Model
{
    protected $table = 'kursus_teach';

    protected $casts = [
        'tarikh_mula_pendek' => 'date',
        'tarikh_hingga_pendek' => 'date',

        'tarikh_mula_panjang' => 'date',
        'tarikh_hingga_panjang' => 'date',

        'tarikh_mula_mentoring' => 'date',
        'tarikh_hingga_mentoring' => 'date',

        'tarikh' => 'date'
    ];

    protected $fillable = [
        'no_kad_pintar',
        'jenis_program',

        'nama_kursus',
        'nama_penganjur',
        'negeri',

        'peringkat',
        'bidang',
        'nama_institusi',

        'nama_mentor',
        'nama_sekolah',

        'siri',
        'modul',

        'mod_latihan',
        'kaedah_peruntukan',
        'jenis_ldp',

        'sesi',

        'tarikh_mula_pendek',
        'tarikh_hingga_pendek',

        'tarikh_mula_panjang',
        'tarikh_hingga_panjang',

        'tarikh_mula_mentoring',
        'tarikh_hingga_mentoring',

        'tarikh'
    ];

        /**
     * Relationship to Teacher
     */
    public function teacher()
    {
        return $this->belongsTo(PemegangJawatanTeach::class, 'no_kad_pintar', 'No Kad Pintar');
    }
}