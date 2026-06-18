<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SPISKPI extends Model
{
    protected $table = 'spis_kpi';

    protected $casts = [
        'blueprint_link' => 'array',
        'kra' => 'array',
    ];

    protected $fillable = [
        'owner',
        'title',
        'blueprint_link',
        'goal',
        'strategic_objective',
        'kra',
        'status'
    ];
}