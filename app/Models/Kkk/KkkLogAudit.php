<?php

namespace App\Models\Kkk;

use Illuminate\Database\Eloquent\Model;

class KkkLogAudit extends Model
{
    protected $table = 'kkk_log_audit';

    public $timestamps = false;

    protected $fillable = ['rekod_id', 'peminjaman_id', 'pengguna_nama', 'tindakan', 'butiran', 'created_at'];

    protected $casts = ['created_at' => 'datetime'];

    protected static function booted()
    {
        static::creating(function (self $log) {
            $log->created_at ??= now();
        });
    }

    public function rekod()
    {
        return $this->belongsTo(KkkRekod::class, 'rekod_id');
    }

    public function peminjaman()
    {
        return $this->belongsTo(KkkPeminjaman::class, 'peminjaman_id');
    }

    /** School names this entry concerns — from the borang, or from a legacy rekod entry. */
    public function namaSekolah(): ?string
    {
        if ($this->peminjaman) {
            return $this->peminjaman->items->map(fn ($i) => $i->sekolah?->nama)->filter()->unique()->implode(', ') ?: null;
        }

        return $this->rekod?->sekolah?->nama;
    }
}
