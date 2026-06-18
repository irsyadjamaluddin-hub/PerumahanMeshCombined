<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTrackingCreate extends Model
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
    protected $table = 'tasktrackingstaff_taskcreated';

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
        'task_ic_no',
        'task_date',
        'task_kategori',
        'task_jabatan',
        'task_staffstatus',
        'created_at',
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

    // Define the relationship
    public function tasksGiven()
    {
        return $this->hasMany(TaskTrackingGiven::class, 'ref_id', 'id');
    }

    public function staffkod()
    {
        return $this->belongsTo(TaskTrackingStaffKod::class, 'task_jabatan', 'department_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'task_jabatan', 'code');
    }

}
