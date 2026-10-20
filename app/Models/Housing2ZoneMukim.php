<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Housing2ZoneMukim extends Model
{
    protected $table = 'housing2_zone_mukims';

    protected $fillable = ['zone_id', 'daerah', 'mukim', 'rs_staff_id', 'iq_staff_id'];

    public function zone()
    {
        return $this->belongsTo(Housing2Zone::class, 'zone_id');
    }

    public function rsStaff()
    {
        return $this->belongsTo(Housing2Staff::class, 'rs_staff_id');
    }

    public function iqStaff()
    {
        return $this->belongsTo(Housing2Staff::class, 'iq_staff_id');
    }
}
