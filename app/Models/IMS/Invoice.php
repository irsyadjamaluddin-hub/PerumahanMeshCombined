<?php

namespace App\Models\IMS;

use App\Models\IMS\BukuDaftar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'invoice_no',
        'invoice_issuance_date',
    ];

    public function lejarSimpanan()
    {
        return $this->hasOne(LejarSimpanan::class);
    }

    public function bukuDaftar()
    {
        return $this->hasOne(BukuDaftar::class);
    }
}
