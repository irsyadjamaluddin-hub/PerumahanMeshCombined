<?php

namespace App\Models\IMS;

use App\Models\IMS\Srv;
use App\Models\IMS\BinCard;
use App\Models\IMS\AssetEntry;
use App\Models\IMS\AssetCategoryCode;
use App\Models\IMS\AssetEntryRequest;
use App\Models\IMS\LejarSimpananEntry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'name',
        'asset_type_id',
        'initial_quantity',
        'unit_price',
        'srv_id',
        'asset_category_code_id',
    ];

    public function assetEntryRequest()
    {
        return $this->hasOne(AssetEntryRequest::class);
    }

    public function assetEntries()
    {
        return $this->hasMany(AssetEntry::class);
    }

    // Used to retrieve very far relationship (e.g from BinCardEntries to Vendor)
    public function assetEntry()
    {
        return $this->hasOne(AssetEntry::class);
    }

    public function binCard()
    {
        return $this->hasOne(BinCard::class);
    }

    public function assetCategoryCode()
    {
        return $this->belongsTo(AssetCategoryCode::class);
    }

}
