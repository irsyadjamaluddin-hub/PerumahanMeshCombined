<?php

namespace App\Models\IMS;

use App\Models\IMS\Srv;
use App\Models\IMS\User;
use App\Models\IMS\Vendor;
use App\Models\IMS\Invoice;
use App\Models\IMS\DeliveryOrder;
use App\Models\IMS\PurchaseOrder;
use App\Models\IMS\AssetEntryRequest;
use App\Models\IMS\BorangPenyerahans;
use Illuminate\Database\Eloquent\Model;
use App\Models\IMS\LejarSimpananEntryRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LejarSimpananRequest extends Model
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
        'sk_id',
        'sk_confirmed',
    ];

    public function lejarSimpananEntryRequests()
    {
        return $this->hasMany(LejarSimpananEntryRequest::class);
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

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function storekeeper()
    {
        return $this->belongsTo(User::class, 'sk_id', 'id');
    }

    public function borangPenyerahan()
    {
        return $this->belongsTo(BorangPenyerahans::class, 'borang_penyerahan_id', 'id');
    }


}
