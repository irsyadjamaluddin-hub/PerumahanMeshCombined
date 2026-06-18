<?php

namespace App\Models\IMS;

use App\Models\IMS\AssetEntry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetStatus extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'name',
    ];

    public function assetEntry()
    {
        return $this->hasOne(AssetEntry::class);
    }
}
