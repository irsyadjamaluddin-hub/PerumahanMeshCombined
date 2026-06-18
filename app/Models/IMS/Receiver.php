<?php

namespace App\Models\IMS;

use App\Models\IMS\Siv;
use App\Models\IMS\ReceiverLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receiver extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'name',
        'receiver_location_id',
        'phone_no',
        'email',
    ];

    public function receiverLocation()
    {
        return $this->belongsTo(ReceiverLocation::class);
    }

    public function siv()
    {
        return $this->hasOne(Siv::class);
    }
}
