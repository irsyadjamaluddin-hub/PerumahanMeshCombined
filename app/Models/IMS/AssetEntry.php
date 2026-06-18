<?php

namespace App\Models\IMS;

use App\Models\IMS\Srv;
use App\Models\IMS\Asset;
use App\Models\IMS\AssetStatus;
use App\Models\IMS\SivAssetEntry;
use App\Models\IMS\BukuDaftarEntry;
use App\Models\IMS\AssetEntrySetItem;
use App\Models\IMS\LejarSimpananEntry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetEntry extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'asset_id',
        'serial_no',
        'moe_reference',
        'asset_status_id',
        'unit_price',
        'srv_id',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function assetStatus()
    {
        return $this->belongsTo(AssetStatus::class);
    }

    public function assetEntrySetItems()
    {
        return $this->hasMany(AssetEntrySetItem::class);
    }

    public function lejarSimpananEntry()
    {
        return $this->hasOne(LejarSimpananEntry::class);
    }

    public function bukuDaftarEntry()
    {
        return $this->hasOne(BukuDaftarEntry::class);
    }

    public function sivAssetEntry()
    {
        return $this->hasOne(SivAssetEntry::class);
    }
}
