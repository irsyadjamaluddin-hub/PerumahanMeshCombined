<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/StatusRumah.php
class StatusRumah extends Model
{
    protected $table = 'status_rumah';
    protected $fillable = ['status'];
    public $timestamps = false;
}

