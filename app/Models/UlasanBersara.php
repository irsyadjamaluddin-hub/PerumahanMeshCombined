<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UlasanBersara extends Model
{
    protected $table = 'ulasan_bersara';

    protected $fillable = [
        'spj_id',
        'tarikh',
        'ulasan_text',
    ];

    protected $casts = [
        'tarikh' => 'date',
    ];

    public function spj()
    {
        return $this->belongsTo(SPJ::class, 'spj_id', 'ID');
    }
}