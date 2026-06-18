<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrfRemark extends Model
{
    use HasFactory;

    protected $table = 'drf_remarks';

    protected $fillable = [
        'remark',
    ];
    
    public function devopsrequest() {
        return $this->belongsTo(DevopsRequest::class);
    }
    
}
