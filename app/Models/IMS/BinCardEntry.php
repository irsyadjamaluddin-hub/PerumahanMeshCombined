<?php

namespace App\Models\IMS;

use App\Models\IMS\User;
use App\Models\IMS\BinCard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BinCardEntry extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'bin_card_id',
        'date',
        'description',
        'in_quantity',
        'out_quantity',
        'balance_quantity',
        'officer_in_charge_id',
        'remarks',
    ];

    public function binCard()
    {
        return $this->belongsTo(BinCard::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
