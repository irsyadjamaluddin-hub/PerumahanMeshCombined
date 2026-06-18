<?php
namespace App\Models;
use App\Models\EminitAdmin;

use Illuminate\Database\Eloquent\Model;

class EminitAction extends Model
{
    protected $table = 'eminit_action';

    protected $fillable = [
        'eminit_admin_id',
        'no_rujukan',
        'catatan',
        'tindakanby_diperlukan',
        'tindakan_diperlukan',
        'jenis_tindakan',
        'created_by',
        'created_at',
        'updated_at',
        'tindakan_file',

    ];

    protected $casts = [
        'tindakan_diperlukan' => 'array',
        'jenis_tindakan'      => 'array',
        'tindakan_file'     => 'array',
        // 'forward_to'          => 'array',
    ];

    public function admin()
    {
        return $this->belongsTo(EminitAdmin::class, 'eminit_admin_id', 'id');
    }
    public function latestActionEntry()
{
    return $this->hasOne(EminitAction::class, 'eminit_admin_id')->latestOfMany('created_at');
}
    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

}