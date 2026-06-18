<?php

namespace App\Models\IMS;

use App\Models\IMS\Asset;
use App\Models\IMS\MainAssetCategoryCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssetCategoryCode extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'main_asset_category_code_id',
        'code',
        'name',
    ];

    public function asset()
    {
        return $this->hasOne(Asset::class);
    }

    public function mainAssetCategoryCode()
    {
        return $this->belongsTo(MainAssetCategoryCode::class);
    }

}
