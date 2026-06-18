<?php

namespace App\Models\IMS;

use App\Models\IMS\AssetEntry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Srv extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'srv_no',
        'srv_signature_date',
    ];

    public function assetEntry()
    {
        return $this->hasOne(AssetEntry::class);
    }
}
