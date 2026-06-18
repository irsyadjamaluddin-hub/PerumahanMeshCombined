<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryBook extends Model{

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
    protected $table = 'inventory_book';

    /**
     * The database primary key value.
     *
     * @var string
     */
    // protected $primaryKey = 'dis_id';
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'sekolah',
        'subjek',
        'judul',
        'pengarang',
        'isbn',
        'penerbit',
        'peringkat',
        'jenisbuku',
        'tahunterbitan',
        'status',
        'catatan',
        'rasional',
        'sukatanpelajaran',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'file'
    ];

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

    public $incrementing = false;

    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */



    /**
     * Get updated_at in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getUpdatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }

    public function getDataAttribute($value)
    {
        return json_decode($value, true);
    }

    public function kategori()
    {
        return $this->belongsTo(InventoryBookKategori::class, 'kategori_id');
    }

}
