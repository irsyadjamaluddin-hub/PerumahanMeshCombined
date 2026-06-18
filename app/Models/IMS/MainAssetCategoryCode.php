<?php

namespace App\Models\IMS;

use App\Models\IMS\AssetCategoryCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainAssetCategoryCode extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'letter',
        'name',
    ];

    public function assetCategoryCode()
    {
        return $this->hasOne(AssetCategoryCode::class);
    }
}
