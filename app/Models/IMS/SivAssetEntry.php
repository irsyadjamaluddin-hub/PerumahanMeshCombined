<?php

namespace App\Models\IMS;

use App\Models\IMS\Siv;
use App\Models\IMS\AssetEntry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SivAssetEntry extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'siv_id',
        'asset_entry_id',
    ];

    public function siv()
    {
        return $this->belongsTo(Siv::class, 'siv_id');
    }

    public function assetEntry()
    {
        return $this->belongsTo(AssetEntry::class);
    }
}
