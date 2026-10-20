<?php

namespace App\Models\Kkk;

use Illuminate\Database\Eloquent\Model;

/** One "Bil / Nama Sekolah / Tempoh dan Tahun KKK" row of a borang. */
class KkkPeminjamanItem extends Model
{
    protected $table = 'kkk_peminjaman_item';

    protected $fillable = ['peminjaman_id', 'bil', 'sekolah_id', 'penggal', 'tahun_kewangan'];

    public function peminjaman()
    {
        return $this->belongsTo(KkkPeminjaman::class, 'peminjaman_id');
    }

    public function sekolah()
    {
        return $this->belongsTo(KkkSekolah::class, 'sekolah_id');
    }

    public function tempoh(): string
    {
        return match ((int) $this->penggal) {
            1 => 'Penggal 1 (Januari - Jun) '.$this->tahun_kewangan,
            2 => 'Penggal 2 (Julai - Disember) '.$this->tahun_kewangan,
            default => 'Tahun '.$this->tahun_kewangan,
        };
    }
}
