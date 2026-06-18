<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EminitAdminPushNotif extends Model
{
    use HasFactory;

    /**
     * Table name
     */
    protected $table = 'eminit_adminpushnotif';

    /**
     * Primary key
     */
    protected $primaryKey = 'id';

    /**
     * Primary key type
     */
    protected $keyType = 'int';

    /**
     * Auto incrementing ID
     */
    public $incrementing = true;

    /**
     * Enable Laravel timestamps
     */
    public $timestamps = true;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'ic_no',
        'email',
        'no_tel',
        'department_id',
    ];

    /**
     * Cast attributes
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

   

    public function department()
    {
        // If dispatch_mecusers.department_id references departments.id:
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
