<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTrackingGiven extends Model
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
    protected $table = 'tasktrackingstaff_taskgiven';

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
        'ref_id',
        'task_ic_no_giver',
        'task_int_ext',
        'task_perkara',
        'task_kod',
        'task_tindakan',
        'task_catatan',
        'task_file',
        'task_userstatus',
        'task_staffstatus',
        'task_catatanuser',
        'task_catatanuser_submit_at',
        'task_catatanstaff',
        'task_catatanstaff_submit_at',
        'created_at',
        'updated_at',
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
    public function taskCreated()
    {
        return $this->belongsTo(TaskTrackingCreate::class, 'ref_id', 'id');
    }

    public function taskStatus()
    {
        return $this->belongsTo(TaskTrackingStatusTindakan::class, 'task_userstatus', 'text');
    }

    public function staffkodgiver()
    {
        return $this->belongsTo(TaskTrackingStaffKod::class, 'task_ic_no_giver', 'ic_no');
    }

    public function staffkodreceiver()
    {
        return $this->belongsTo(TaskTrackingStaffKod::class, 'task_kod', 'ic_no');
    }

    public function getTaskFileAttribute($value)
    {
        return json_decode($value, true);
    }
}
