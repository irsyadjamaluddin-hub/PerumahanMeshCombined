<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Housing2Zone extends Model
{
    protected $table = 'housing2_zones';

    protected $fillable = ['nama', 'ketua_staff_id'];

    public function ketuaStaff()
    {
        return $this->belongsTo(Housing2Staff::class, 'ketua_staff_id');
    }

    public function mukims()
    {
        return $this->hasMany(Housing2ZoneMukim::class, 'zone_id');
    }
}
