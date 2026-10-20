<?php

namespace App\Models\Kkk;

use Illuminate\Database\Eloquent\Model;

class KkkRekod extends Model
{
    protected $table = 'kkk_rekod';

    protected $fillable = [
        'sekolah_id', 'tahun_kewangan', 'penggal', 'kategori',
        'tarikh_diterima', 'tarikh_tfv', 'status',
        'kerani_nama', 'pegawai_nama', 'catatan', 'locked',
    ];

    protected $casts = [
        'tarikh_diterima' => 'date',
        'tarikh_tfv' => 'date',
        'locked' => 'boolean',
    ];

    /** Status metadata: label (ms/en), badge colours — mirrors Status.dc.html exactly. */
    public const META = [
        'belum_diterima' => ['label' => ['Belum diterima', 'Not received'], 'bg' => '#ECEBF2', 'fg' => '#4A4766', 'dot' => '#B9B5AB'],
        'diterima' => ['label' => ['Diterima', 'Received'], 'bg' => '#E3ECF5', 'fg' => '#1F4A73', 'dot' => '#2F5D8A'],
        'dalam_kuiri' => ['label' => ['Dalam kuiri', 'In query'], 'bg' => '#FBEAD6', 'fg' => '#8A4308', 'dot' => '#C9761F'],
        'jawapan_diterima' => ['label' => ['Jawapan diterima', 'Reply received'], 'bg' => '#ECE6F5', 'fg' => '#4F3680', 'dot' => '#6E52A3'],
        'selesai' => ['label' => ['Selesai · TFV', 'Completed · TFV'], 'bg' => '#DDEFE4', 'fg' => '#175636', 'dot' => '#1E6B45'],
    ];

    public function sekolah()
    {
        return $this->belongsTo(KkkSekolah::class, 'sekolah_id');
    }

    public function kuiri()
    {
        return $this->hasMany(KkkKuiri::class, 'rekod_id')->orderBy('pusingan');
    }

    /**
     * The status engine — computed from dates only, per Logik.dc.html:
     * TFV set -> selesai; latest kuiri round unanswered -> dalam_kuiri;
     * latest kuiri round answered -> jawapan_diterima; diterima set -> diterima;
     * else -> belum_diterima.
     */
    public function computeStatus(): string
    {
        if ($this->tarikh_tfv) {
            return 'selesai';
        }

        $terakhir = $this->kuiri()->reorder('pusingan', 'desc')->first();

        if ($terakhir) {
            return $terakhir->tarikh_jawapan ? 'jawapan_diterima' : 'dalam_kuiri';
        }

        return $this->tarikh_diterima ? 'diterima' : 'belum_diterima';
    }

    public function refreshStatus(): void
    {
        $this->status = $this->computeStatus();
        $this->save();
    }

    /**
     * Which row of the Pencapaian slide a status counts under:
     * tfv (True & Fair View), kueri, belum (received, not yet examined)
     * or tidak (Tidak diterima). Unknown statuses from older data that
     * mention a query count as kueri; anything else received as belum.
     */
    public static function kumpulanPencapaian(?string $status): string
    {
        return match (true) {
            $status === 'selesai' => 'tfv',
            $status === 'belum_diterima' || $status === null => 'tidak',
            in_array($status, ['dalam_kuiri', 'jawapan_diterima'], true) || str_contains($status, 'kuiri') => 'kueri',
            default => 'belum',
        };
    }

    public function meta(string $locale = 'ms'): array
    {
        $m = self::META[$this->status] ?? self::META['belum_diterima'];

        return ['label' => $m['label'][$locale === 'en' ? 1 : 0], 'bg' => $m['bg'], 'fg' => $m['fg'], 'dot' => $m['dot']];
    }
}
