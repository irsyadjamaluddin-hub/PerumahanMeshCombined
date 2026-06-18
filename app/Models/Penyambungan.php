<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyambungan extends Model
{
    protected $table = 'penyambungan';
    
    protected $fillable = [
        'no_kad_pintar',
        'tarikh_mula',
        'tarikh_hingga',
        'lain',
    ];

    protected $casts = [
        'tarikh_mula' => 'date',
        'tarikh_hingga' => 'date',
    ];

    /**
     * Relationship to Teacher
     */
    public function teacher()
    {
        return $this->belongsTo(PemegangJawatanTeach::class, 'no_kad_pintar', 'No Kad Pintar');
    }
}