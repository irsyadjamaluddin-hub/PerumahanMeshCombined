<?php

namespace App\Models\IMS;

use App\Models\IMS\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffBoard extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'message',
        'meridiem',
        'date',
        'status',
        'staff_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
