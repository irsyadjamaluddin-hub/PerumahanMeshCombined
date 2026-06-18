<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevopsSupportAdmin extends Model
{
    protected $table = 'devops_support_admin';

    protected $fillable = [
        'ic_no',
        'email',
        'tel_no',
    ];
}
