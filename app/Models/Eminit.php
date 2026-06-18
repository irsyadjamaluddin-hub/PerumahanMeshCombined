<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EminitAdmin;
use App\Models\Department;

class Eminit extends Model
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
    protected $table = 'eminit';

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
        'jenis',            // int (jenis.id)
        'daripada',         // int (department_id)
        'memo_daripada',
        'kpd',              // array<int>
        'untukperhatian',   // string (label)
        'perkara',
        'rujukan_tp',
        'eminit_file',      // array<filemeta>
        'catatan',
        'salinan_kepada',   // array<int>
        'salinan',          // external recipients (text)
        'salinan_dokumen',  // array<filemeta>
        'no_rujukan',
        'ic_no',
        'created_at',
        'updated_at',

        
    ];

    protected $casts = [

        'kpd'             => 'array',
        'eminit_file'     => 'array',
        'salinan_kepada'  => 'array',
        'salinan_dokumen' => 'array',
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

     public function memoDepartment()
     {
         return $this->belongsTo(\App\Models\Department::class, 'memo_daripada');
     }
     

    public function adminEntries()
{
    return $this->hasMany(EminitAdmin::class, 'eminit_id');
}
    public function admins()
{
    return $this->hasMany(\App\Models\EminitAdmin::class, 'eminit_id');
}

public function latestAdminEntry()
{
    return $this->hasOne(EminitAdmin::class, 'eminit_id')->latestOfMany('id');
}
    public function latestActionEntry()
{
    return $this->hasOne(EminitAction::class, 'eminit_admin_id')->latestOfMany('id');
}
public function actions()
{
    return $this->hasManyThrough(
        EminitAction::class,   // final
        EminitAdmin::class,    // through
        'eminit_id',           // EminitAdmin.eminit_id
        'eminit_admin_id',     // EminitAction.eminit_admin_id
        'id',                  // Eminit.id
        'id'                   // EminitAdmin.id
    );
}

    public function latestAction()
{
    // return $this->hasOneThrough(
    //     EminitAction::class,
    //     EminitAdmin::class,
    //     'eminit_id',
    //     'eminit_admin_id',
    //     'id',
    //     'id'
    // )->latestOfMany('id'); // or 'created_at'
        return $this->hasOneThrough(
        \App\Models\EminitAction::class,
        \App\Models\EminitAdmin::class,
        'eminit_id',
        'eminit_admin_id',
        'id',
        'id'
    )->orderByDesc('eminit_action.id'); // picks the most recent by ID
}

}
