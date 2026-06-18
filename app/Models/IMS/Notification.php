<?php

namespace App\Models\IMS;

use App\Models\IMS\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'read',
        'reference_type',
        'reference_id',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
