<?php

namespace App\Models\IMS;

use App\Models\IMS\User;
use App\Models\IMS\Receiver;
use App\Models\IMS\SivAssetEntry;
use App\Models\IMS\ReceiverLocation;
use App\Models\IMS\BorangPenyerahans;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siv extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'reference_for_request',
        'request_accepted',
        'deploy_to',
        'receiver_id',
        'receiver_date',
        'receiver_location_id',
        'receiver_signature',
        'tt_id',
        'tt_signed',
        'tt_signature_date',
        'storekeeper_id',
        'storekeeper_signed',
        'storekeeper_signature_date',
        'supervisor_id',
        'supervisor_verified',
        'supervisor_verification_date',
        'remarks',
    ];

    public function receiver()
    {
        return $this->belongsTo(Receiver::class);
    }

    public function receiverLocation()
    {
        return $this->belongsTo(ReceiverLocation::class);
    }

    public function sivAssetEntries()
    {
        return $this->hasMany(SivAssetEntry::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function internalUser()
    {
        // return $this->belongsTo(User::class, 'receiver_id')->where('deploy_to', 'internal');

        return $this->belongsTo(User::class, 'receiver_id')
            ->join('sivs', 'users.id', '=', 'sivs.receiver_id') // Joining the users table with the sivs table
            ->where('sivs.deploy_to', 'internal');
    }

    public function externalUser()
    {
        // return $this->belongsTo(Receiver::class, 'receiver_id')->where('deploy_to', 'external');

        return $this->belongsTo(Receiver::class, 'receiver_id')
            ->join('sivs', 'receivers.id', '=', 'sivs.receiver_id') // Joining the users table with the sivs table
            ->where('sivs.deploy_to', 'external');
    }

    public function techteam()
    {
        return $this->belongsTo(User::class, 'tt_id');
    }

    public function storekeeper()
    {
        return $this->belongsTo(User::class, 'storekeeper_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function mmsd()
    {
        return $this->belongsTo(User::class, 'mmsd_id');
    }

    public function borangPenyerahan()
    {
        return $this->hasOne(BorangPenyerahans::class);
    }

}
