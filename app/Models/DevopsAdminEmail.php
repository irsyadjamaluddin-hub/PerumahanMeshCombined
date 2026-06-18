<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevopsAdminEmail extends Model
{
    use HasFactory;

    protected $table = 'devops_admin_emails';
    
    protected $fillable = [
        'ic_no',
        'email',
        'tel_no',
    ];
}
