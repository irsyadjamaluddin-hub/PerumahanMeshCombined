<?php

namespace App\Models\IMS;

use App\Models\IMS\AssetEntryRequest;
use App\Models\IMS\LejarSimpananRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LejarSimpananEntryRequest extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'lejar_simpanan_id',
        'asset_entry_id',
    ];

    public function lejarSimpananRequest()
    {
        return $this->belongsTo(LejarSimpananRequest::class);
    }

    public function assetEntryRequest()
    {
        return $this->belongsTo(AssetEntryRequest::class);
    }
}
