<?php

namespace App\Models\IMS;

use App\Models\IMS\AssetEntryRequest;
use App\Models\IMS\BukuDaftarRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BukuDaftarEntryRequest extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'buku_daftar_request_id',
        'asset_entry_request_id',
    ];

    public function bukuDaftarRequest()
    {
        return $this->belongsTo(BukuDaftarRequest::class);
    }

    public function assetEntryRequest()
    {
        return $this->belongsTo(AssetEntryRequest::class);
    }
}
