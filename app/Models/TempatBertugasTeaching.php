<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempatBertugasTeaching extends Model
{
    protected $table = 'tempat_bertugas_teaching';
    
    protected $fillable = [
        'no_kad_pintar',
        'tarikh_mula',
        'tempat_bertugas',
        'tarikh_hingga',
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