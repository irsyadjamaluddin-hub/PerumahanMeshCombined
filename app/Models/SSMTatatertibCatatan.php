<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SSMTatatertibCatatan extends Model
{
    use HasFactory;

    protected $table = 'ssm_tatatertib_catatan';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'tt_id',
        'tt_no_catatan',
        'tt_catatan',
        'tt_catatan_date',
        'catatan_created_at',
        'catatan_updated_at'
    ];

    // Define the relationship with ssm_tatatertib table
    public function ssmtatatertib()
    {
        return $this->belongsTo(SSMTatatertib::class, 'tt_id', 'id');
    }

    public $timestamps = false;

}
