<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GajiMatrix extends Model
{
    protected $table = 'gaji_matrix';
    
    protected $fillable = [
        'no_kad_pintar',
        'tahun',
        'tarikh_kenaikan',
        'gaji',
        'percentage',
        'tahap',
        'lain',
        'subjek',
    ];

    protected $casts = [
        'tarikh_kenaikan' => 'date',
    ];

    /**
     * Relationship to Teacher
     */
    public function teacher()
    {
        return $this->belongsTo(PemegangJawatanTeach::class, 'no_kad_pintar', 'No Kad Pintar');
    }
}