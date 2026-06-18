<?php

namespace App\Models\IMS;

use App\Models\IMS\Asset;
use App\Models\IMS\AssetEntry;
use App\Models\IMS\BukuDaftar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BukuDaftarEntry extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'buku_daftar_id',
        'asset_entry_id',
    ];

    public function asset()
    {
        return $this->hasOne(Asset::class);
    }

    public function bukuDaftar()
    {
        return $this->belongsTo(BukuDaftar::class);
    }

    public function assetEntry()
    {
        return $this->belongsTo(AssetEntry::class);
    }
}
