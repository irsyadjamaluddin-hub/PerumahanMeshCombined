<?php

namespace App\Models\IMS;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\IMS\Siv;
use App\Models\IMS\Role;
use App\Models\IMS\UserRole;
use App\Models\IMS\StaffBoard;
use App\Models\IMS\BinCardEntry;
use App\Models\IMS\PurchaseOrder;
// use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $connection = 'ims';

    protected $fillable = [
        'full_name',
        'username',
        'email',
        'password',
        'signature',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function userRoles()
    {
        return $this->hasMany(UserRole::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function hasRole($role)
    {
        $userRoles = Auth::user()->userRoles;

        if(count($userRoles) > 0){

            foreach ($userRoles as $userRole) {

                if($userRole->role->name == $role) {

                    return true;

                }

            }

        }

        return false;

    }

    public function binCardEntry()
    {
        return $this->belongsTo(BinCardEntry::class);
    }

    public function sivs()
    {
        return $this->hasMany(Siv::class);
    }

    public function staffBoards()
    {
        return $this->hasMany(StaffBoard::class, 'staff_id');
    }

}
