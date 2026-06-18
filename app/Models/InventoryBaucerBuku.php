<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryBaucerBuku extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inventory_baucer_buku_info';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'rujukan_srv',
        'bil',
        'jadual_buku',
        'isbn',
        'unit',
        'kuantiti_do',
        'kuantiti_diterima',
        'harga_kos_seunit',
        'harga_jumlah',
        'catatan',
        'created_at',
        'updated_at'
    ];

    public function pembekal()
    {
        return $this->belongsTo(InventoryBaucerPembekal::class, 'rujukan_srv', 'rujukan_srv');
    }
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
