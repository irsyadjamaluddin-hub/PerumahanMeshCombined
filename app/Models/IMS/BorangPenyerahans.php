<?php

namespace App\Models\IMS;

use App\Models\IMS\Siv;
use App\Models\IMS\User;
use App\Models\IMS\Receiver;
use App\Models\IMS\ReceiverLocation;
use App\Models\IMS\LejarSimpananRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BorangPenyerahans extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'siv_id',
        'bp_no',
        'tt_processed',
        'tt_response',
        'mmsd_processed',
        'mmsd_response',
        'supervisor_processed',
        'receiver_processed',
        'pdf_name',
    ];

    public function siv()
    {
        return $this->belongsTo(Siv::class);
    }

    public function lejarSimpananRequests()
    {
        return $this->hasMany(LejarSimpananRequest::class);
    }

}
