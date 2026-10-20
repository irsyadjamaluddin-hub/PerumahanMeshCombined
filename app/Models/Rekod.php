<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Rekod extends Model
{
    use HasFactory;

    protected $fillable = ['jenis', 'jenis_permohonan', 'status', 'data'];

    protected $casts = ['data' => 'array'];

    /** Value of a field by its human label. */
    public function field(string $label, string $fallback = '—'): string
    {
        $value = $this->data[Str::slug($label, '_')] ?? null;

        return filled($value) ? (string) $value : $fallback;
    }

    /** Label shown as the record's title in lists and headers. */
    public function tajuk(): string
    {
        foreach (['Nama', 'Nama Penuh Pemilik', 'Nama Penuh Penghuni', 'Nama Penuh Pemohon', 'Alamat Perumahan Kerajaan (IQ)'] as $label) {
            $value = $this->data[Str::slug($label, '_')] ?? null;
            if (filled($value)) {
                return $value;
            }
        }

        return 'Rekod #'.$this->id;
    }

    public function scopeJenis($query, string $jenis)
    {
        return $query->where('jenis', $jenis);
    }

    public function scopeCari($query, ?string $term)
    {
        return blank($term) ? $query : $query->whereRaw('LOWER(data) LIKE ?', ['%'.strtolower($term).'%']);
    }
}
