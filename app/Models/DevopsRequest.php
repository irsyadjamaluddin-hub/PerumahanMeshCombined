<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevopsRequest extends Model
{
    use HasFactory;

    protected $table = 'devops_requests';

    protected $fillable = [
        'ic_no',
        'jabatan',
        'bahagian_unit',
        'nama_projek',
        'penyelaras_projek',
        'jawatan',
        'emel',
        'tel_no',
        'perkhidmatan',
        'huraian',
        'tarikh_diperlukan',
        'uploaded_doc',
        'status',
    ];

    public function drfremarks() {
        return $this->hasMany(DrfRemark::class);
    }

    
    public function drfdocuments() {
        return $this->hasMany(DrfDocument::class);
    }
    
}
