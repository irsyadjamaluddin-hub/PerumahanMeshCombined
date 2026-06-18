<?php

namespace App\Models\IMS;

use App\Models\IMS\Receiver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReceiverLocation extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'name',
    ];

    public function receivers()
    {
        return $this->hasMany(Receiver::class);
    }
}
