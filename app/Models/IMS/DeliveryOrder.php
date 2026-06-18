<?php

namespace App\Models\IMS;

use App\Models\IMS\User;
use App\Models\IMS\LejarSimpanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryOrder extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'do_no',
        'do_issuance_date',
        'do_signer',
        'do_signing_date',
    ];

    public function lejarSimpanan()
    {
        return $this->hasOne(LejarSimpanan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'do_signer');
    }
}
