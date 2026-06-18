<?php

namespace App\Models\IMS;

use App\Models\IMS\Srv;
use App\Models\IMS\Vendor;
use App\Models\IMS\Invoice;
use App\Models\IMS\DeliveryOrder;
use App\Models\IMS\PurchaseOrder;
use App\Models\IMS\BukuDaftarType;
use App\Models\IMS\BukuDaftarEntry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BukuDaftar extends Model
{
    use HasFactory;

    protected $connection = 'ims';

    protected $fillable = [
        'buku_daftar_type_id',
        'vendor_id',
        'purchase_order_id',
        'delivery_order_id',
        'invoice_id',
        'remarks',
        'srv_id',
    ];

    // bukuDaftarEntries.asset.assetEntries

    public function bukuDaftarEntries()
    {
        return $this->hasMany(BukuDaftarEntry::class);
    }

    public function bukuDaftarType()
    {
        return $this->belongsTo(BukuDaftarType::class);
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
