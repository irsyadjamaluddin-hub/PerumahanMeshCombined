<?php

namespace App\Models\IMS;

use App\Models\IMS\Asset;
use App\Models\IMS\AssetEntry;
use App\Models\IMS\LejarSimpanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LejarSimpananEntry extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'lejar_simpanan_id',
        'asset_entry_id',
    ];

    public function lejarSimpanan()
    {
        return $this->belongsTo(LejarSimpanan::class);
    }

    public function assetEntry()
    {
        return $this->belongsTo(AssetEntry::class);
    }
}
