<?php

namespace App\Models\IMS;

use App\Models\IMS\Srv;
use App\Models\IMS\User;
use App\Models\IMS\Vendor;
use App\Models\IMS\Invoice;
use App\Models\IMS\DeliveryOrder;
use App\Models\IMS\PurchaseOrder;
use App\Models\IMS\LejarSimpananEntry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LejarSimpanan extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'vendor_id',
        'purchase_order_id',
        'delivery_order_id',
        'invoice_id',
        'remarks',
        'srv_id',
        'moe_reference',
        'created_by',
    ];

    public function lejarSimpananEntries()
    {
        return $this->hasMany(LejarSimpananEntry::class);
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function deliveryOrder()
    {
        return $this->belongsTo(DeliveryOrder::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function srv()
    {
        return $this->belongsTo(Srv::class);
    }


}
