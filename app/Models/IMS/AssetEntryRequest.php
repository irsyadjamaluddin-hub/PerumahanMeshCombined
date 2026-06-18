<?php

namespace App\Models\IMS;

use App\Models\IMS\Asset;
use App\Models\IMS\AssetStatus;
use Illuminate\Database\Eloquent\Model;
use App\Models\IMS\AssetEntrySetItemRequest;
use App\Models\IMS\LejarSimpananEntryRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetEntryRequest extends Model
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

    public function assetEntrySetItemRequests()
    {
        return $this->hasMany(AssetEntrySetItemRequest::class);
    }

    public function lejarSimpananEntryRequest()
    {
        return $this->hasOne(LejarSimpananEntryRequest::class);
    }
}
