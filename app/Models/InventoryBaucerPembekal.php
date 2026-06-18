<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryBaucerPembekal extends Model
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
    protected $table = 'inventory_baucer_pembekal_info';

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
        'nama_syarikat_pembekal',
        'jenis_barang',
        'po_norujukan',
        'po_tarikh',
        'do_norujukan',
        'do_tarikh',
        'lokasi_penerimaan',
        'fail_tandatangan',
        'fail_tandatangan_path',
        'created_by',
        'created_at',
        'updated_at'
    ];

    public function bukus()
    {
        return $this->hasMany(InventoryBaucerBuku::class, 'rujukan_srv', 'rujukan_srv');
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
