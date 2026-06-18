<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSMTatatertib extends Model
{
    use HasFactory;

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
    protected $table = 'ssm_tatatertib';

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
        'tt_name',
        'tt_icno',
        'tt_surat_rujukan',
        'tt_perkara',
        'tt_jawatan',
        'tt_tempat_bertugas',
        'tt_email',
        'tt_notel',
        'tt_file',
        'status',
        'created_by',
        'updated_by',
        'ut_at',
        'ut_by',
        'kt_at',
        'kt_by',
        'selesai_at',
        'selesai_by'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tt_file' => 'array',
    ];

    // Define relationships
    public function icnos()
    {
        return $this->hasMany(SSMTatatertibicno::class, 'tt_id');
    }

    public function ssmkod()
    {
        return $this->belongsTo(SSMKod::class, 'kiv_by', 'ic_no');
    }

    public function selesaikod()
    {
        return $this->belongsTo(SSMKod::class, 'selesai_by', 'ic_no');
    }

    public function ssmtatatertibicnos()
    {
        return $this->hasMany(SSMTatatertibicno::class, 'tt_id', 'id');
    }

    public function ssmtatatertibcatatan()
    {
        return $this->hasMany(SSMTatatertibCatatan::class, 'tt_id', 'id');
    }

    public function catatan()
    {
        return $this->hasMany(SSMTatatertibCatatan::class, 'tt_id');
    }
}
