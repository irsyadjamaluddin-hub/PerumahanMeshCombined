<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
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
    protected $table = 'dispatch_infos';

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
        'admin_id',
        'admin_dept',
        'ic_no',
        'place',
        'department',
        'jns',
        'daripada',
        'dis_filename',
        'dis_filename1',
        'dis_filename2',
        'kpd',
        'salinankpd',
        'statusmemo',
        'dpl',
        'spl',

        'up',
        'perkara',
        'rp',
        'rm',
        'lamp',
        'lamp1',
        'lamp2',
        'catt',
        // for admin data
        'dispatch_recieved_at',
        'date_process',
        'date_close',
        'no_folio',
        'catatan_admin',
        'tindakan',
        'date_admin_submit',

        //for mec data ( pengarah & pegawai tindakan)
        'tindakan_mec',
        'tindakan_pt',
        'ulasan_mec',
        'ulasan_pt',
        'date_mec_submit',
        'created_mec_by',
        'updated_at'
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
        'dis_filename' => 'array',
        'lamp' => 'array',
        'dis_filename1' => 'array',
        'lamp1' => 'array',
    ];


    public $incrementing = false;

    /**
     * Get created_at in array format
     *
     * @param  string  $value
     * @return array
     */

    public function untukperhatian()
    {
        return $this->belongsTo('App\Models\Untukperhatian', 'up');
    }


    public function kepada()
    {
        return $this->belongsTo('App\Models\Kepada', 'kpd');
    }

    public function daripada()
    {
        return $this->belongsTo('App\Models\Daripada', 'daripada');
    }

    public function jenis()
    {
        return $this->belongsTo('App\Models\Jenis', 'jns');
    }

    
    public function tindakan()
    {
        return $this->belongsTo('App\Models\Mecuser','tindakan');
    }

    public function tindakanpass()
    {
        return $this->belongsTo('App\Models\Mecuser','tindakan_pass');
    }


    public function getCreatedAtAttribute($value)
    {
        return date('j/n/Y g:i A', strtotime($value));
    }


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
}
