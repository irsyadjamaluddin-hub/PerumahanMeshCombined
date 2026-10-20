<?php

namespace App\Models\Kkk;

use Illuminate\Database\Eloquent\Model;

/** One "Borang Permohonan Peminjaman Dokumen KKK" and its progress through the form's signature blocks. */
class KkkPeminjaman extends Model
{
    protected $table = 'kkk_peminjaman';

    protected $fillable = [
        'no_borang', 'jenis', 'tujuan', 'tujuan_lain', 'tarikh_permohonan', 'status',
        'pemohon_nama', 'pemohon_jawatan',
        'dibenarkan_nama', 'dibenarkan_jawatan', 'tarikh_dibenarkan', 'sebab_ditolak',
        'dikeluarkan_nama', 'dikeluarkan_jawatan', 'tarikh_dikeluarkan',
        'diterima_nama', 'diterima_jawatan', 'tarikh_diterima',
        'dikembalikan_nama', 'dikembalikan_jawatan', 'tarikh_dikembalikan',
        'diterima_stor_nama', 'diterima_stor_jawatan', 'tarikh_diterima_stor', 'catatan_semakan',
    ];

    protected $casts = [
        'jenis' => 'array',
        'tarikh_permohonan' => 'date',
        'tarikh_dibenarkan' => 'date',
        'tarikh_dikeluarkan' => 'date',
        'tarikh_diterima' => 'date',
        'tarikh_dikembalikan' => 'date',
        'tarikh_diterima_stor' => 'date',
    ];

    public const JENIS = ['Yuran', 'Kantin', 'Rampaian'];

    public const TUJUAN = ['semakan' => 'Semakan', 'pengauditan' => 'Pengauditan', 'lain' => 'Lain-lain'];

    /** Workflow order, following the borang top to bottom. Label (ms/en) and badge colours. */
    public const META = [
        'dipohon' => ['label' => ['Dipohon', 'Requested'], 'bg' => '#ECEBF2', 'fg' => '#4A4766', 'dot' => '#B9B5AB'],
        'dibenarkan' => ['label' => ['Dibenarkan', 'Approved'], 'bg' => '#E3ECF5', 'fg' => '#1F4A73', 'dot' => '#2F5D8A'],
        'dikeluarkan' => ['label' => ['Dikeluarkan', 'Issued'], 'bg' => '#FBEAD6', 'fg' => '#8A4308', 'dot' => '#C9761F'],
        'dipinjam' => ['label' => ['Dipinjam', 'On loan'], 'bg' => '#FFF4C2', 'fg' => '#6B5A00', 'dot' => '#D4C820'],
        'dikembalikan' => ['label' => ['Dikembalikan', 'Returned'], 'bg' => '#ECE6F5', 'fg' => '#4F3680', 'dot' => '#6E52A3'],
        'selesai' => ['label' => ['Selesai', 'Completed'], 'bg' => '#DDEFE4', 'fg' => '#175636', 'dot' => '#1E6B45'],
        'ditolak' => ['label' => ['Ditolak', 'Rejected'], 'bg' => '#FBE3E1', 'fg' => '#8C1D18', 'dot' => '#B3261E'],
    ];

    /** Statuses where the documents are physically out of the store. */
    public const DI_LUAR_STOR = ['dikeluarkan', 'dipinjam', 'dikembalikan'];

    public function items()
    {
        return $this->hasMany(KkkPeminjamanItem::class, 'peminjaman_id')->orderBy('bil');
    }

    public static function nextNoBorang(): string
    {
        $prefix = 'KKK/PJM/'.now()->year.'/';
        $last = static::where('no_borang', 'like', $prefix.'%')->orderByDesc('no_borang')->value('no_borang');

        return $prefix.str_pad((int) substr((string) $last, strlen($prefix)) + 1, 4, '0', STR_PAD_LEFT);
    }

    public function meta(string $locale = 'ms'): array
    {
        $m = self::META[$this->status] ?? self::META['dipohon'];

        return ['label' => $m['label'][$locale === 'en' ? 1 : 0], 'bg' => $m['bg'], 'fg' => $m['fg'], 'dot' => $m['dot']];
    }

    public function tujuanLabel(): string
    {
        return $this->tujuan === 'lain' ? (string) $this->tujuan_lain : self::TUJUAN[$this->tujuan] ?? $this->tujuan;
    }
}
