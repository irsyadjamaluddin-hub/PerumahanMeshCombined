<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';
    
    // Disable timestamps since the table doesn't have these columns
    public $timestamps = false;

    protected $fillable = [
        'Text163',
        'Tahun',
        'Gred',
        'Percentage',
    ];

    public function spj()
    {
        return $this->belongsTo(SPJ::class, 'Text163', 'Text163');
    }
}