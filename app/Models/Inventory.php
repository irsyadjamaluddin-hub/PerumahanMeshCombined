<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
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
    protected $table = 'mesh.inventory';


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
        'nama_sch',
        'unit',
        'jabatan',
        'kluster',
        'no_tel',
        'ic_no',
        'emel',
        'kgp_nama',
        'kgp_emel',
        'kgp_phone_number',
        'kgp_ic_no',
        'kgp_status',
        'kgp_amendmentreasons',
        'bp_catatan',
        'bp_recieve_nama',
        'bp_recieve_icno',
        'bp_recieve_jawatan',
        'bp_recieve_date',
        'bp_disahkan_nama',
        'bp_disahkan_icno',
        'bp_disahkan_date',
        'bp_status',
        'bp_icno',
        'bp_submitted',
        
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
    protected $casts = [
        'bp_icno' => 'array',
        'bp_submitted' => 'boolean',
    ];
    

    public $incrementing = true;

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

    public function getFormattedIdAttribute()
    {
        // Use sprintf to format the "id" as CDD followed by a 6-digit zero-padded number
        return 'CDD' . sprintf('%06d', $this->attributes['id']);
    }

    public function getDataAttribute($value)
{
    return json_decode($value, true);
}

public function Department()
{
    return $this->belongsTo('App\Models\Department','jabatan');
}


public function ppk()
{
    return $this->belongsTo(\App\Models\Ppk::class, 'ppk_id');
}

}
