<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempatBertugas extends Model
{
    protected $table = 'tempat_bertugas';

    protected $fillable = [
        'spj_id',
        'tarikh_mula_diatur',
        'tempat_bertugas',
        'tarikh_hingga',
    ];

    protected $casts = [
        'tarikh_mula_diatur' => 'date',
        'tarikh_hingga' => 'date',
    ];

    public function spj()
    {
        return $this->belongsTo(SPJ::class, 'spj_id');
    }
}