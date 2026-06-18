<?php

namespace App\Models\IMS;

use App\Models\IMS\User;
use App\Models\IMS\LejarSimpanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $connection = 'ims';
    protected $table = 'purchase_orders';

    protected $fillable = [
        'po_no',
        'po_date',
        'quotation_no',
        'contact_person_id',
    ];

    public function lejarSimpanan()
    {
        return $this->hasOne(LejarSimpanan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'contact_person_id');
    }

}
