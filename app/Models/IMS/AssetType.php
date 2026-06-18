<?php

namespace App\Models\IMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'name',
    ];
}
