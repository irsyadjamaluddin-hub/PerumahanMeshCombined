<?php

namespace App\Models\IMS;

use App\Models\IMS\BinCard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'name',
    ];

    public function binCards()
    {
        return $this->hasMany(BinCard::class);
    }
}
