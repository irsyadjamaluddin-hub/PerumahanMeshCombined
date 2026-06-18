<?php

namespace App\Models\IMS;

use App\Models\IMS\UserRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'name',
    ];

    public function userRoles()
    {
        return $this->hasMany(UserRole::class);
    }
}
