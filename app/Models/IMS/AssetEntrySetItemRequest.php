<?php

namespace App\Models\IMS;

use App\Models\IMS\AssetCategoryCode;
use App\Models\IMS\AssetEntryRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetEntrySetItemRequest extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'asset_entry_request_id',
        'name',
        'moe_reference',
        'serial_no',
        'asset_category_code_id',
    ];

    public function assetEntryRequest()
    {
        return $this->belongsTo(AssetEntryRequest::class);
    }

    public function assetCategoryCode()
    {
        return $this->belongsTo(AssetCategoryCode::class);
    }
}
