<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SejarahJawatanTeaching extends Model
{
    protected $table = 'sejarah_jawatan_teaching';
    
    protected $fillable = [
        'no_kad_pintar',
        'jawatan',
        'tarikh_lantikan',
        'peruntukan',
        'tempat_bertugas',
    ];

    protected $casts = [
        'tarikh_lantikan' => 'date',
    ];

    /**
     * Relationship to Teacher
     */
    public function teacher()
    {
        return $this->belongsTo(PemegangJawatanTeach::class, 'no_kad_pintar', 'No Kad Pintar');
    }
}