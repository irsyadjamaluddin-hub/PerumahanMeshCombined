<?php

namespace App\Models\IMS;

use App\Models\IMS\LejarSimpanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'name',
        'address',
        'tel_no',
        'email',
    ];

    public function lejarSimpanan()
    {
        return $this->hasOne(LejarSimpanan::class);
    }

    public function bukuDaftar()
    {
        return $this->hasOne(LejarSimpanan::class);
    }
}
