<?php

namespace App\Models\IMS;

use App\Models\IMS\AssetEntry;
use App\Models\IMS\AssetCategoryCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetEntrySetItem extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'name',
        'asset_id',
        'serial_no',
        'category_code_id',
    ];

    public function assetEntry()
    {
        return $this->belongsTo(AssetEntry::class);
    }

    public function assetCategoryCode()
    {
        return $this->belongsTo(AssetCategoryCode::class);
    }

}
