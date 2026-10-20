<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Housing2Staff extends Model
{
    protected $table = 'housing2_staff';

    protected $fillable = ['kod', 'nama', 'no_kpp', 'tugas'];
}
