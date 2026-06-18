<?php

namespace App\Models\IMS;

use App\Models\IMS\BukuDaftar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BukuDaftarType extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'name',
    ];

    public function bukuDaftar()
    {
        return $this->hasOne(BukuDaftar::class);
    }
}
