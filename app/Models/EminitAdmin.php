<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Eminit;
use App\Models\EminitAction;

class EminitAdmin extends Model
{
    protected $table = 'eminit_admin';

    protected $fillable = [
        'eminit_id',
        'no_rujukan',
        'catatan',
        'tindakan_diperlukan',
        'jenis_tindakan',
        'status',
        'created_by',

        // 'created_by',
        // 'forward_to',
    ];

    protected $casts = [
        'tindakan_diperlukan' => 'array',
        'jenis_tindakan'      => 'array',
        // 'forward_to'          => 'array',
    ];

    public function eminit()
    {
        return $this->belongsTo(Eminit::class, 'eminit_id');
    }

    public function actions()
    {
        return $this->hasMany(EminitAction::class, 'eminit_admin_id',
            'id');
    }
    public function latestAdminEntry()
{
    return $this->hasOne(EminitAdmin::class, 'eminit_id')->latestOfMany('created_at');
}
    public function latestActionEntry()
{
    return $this->hasOne(EminitAction::class, 'eminit_admin_id')->latestOfMany('id');
}
}