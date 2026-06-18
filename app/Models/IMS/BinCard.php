<?php

namespace App\Models\IMS;

use App\Models\IMS\Asset;
use App\Models\IMS\Store;
use App\Models\IMS\BinCardEntry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BinCard extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'bin_no',
        'store_id',
        'asset_id ',
        'vocb_no',
        'qr_code',
    ];

    public function binCardEntries()
    {
        return $this->hasMany(BinCardEntry::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
