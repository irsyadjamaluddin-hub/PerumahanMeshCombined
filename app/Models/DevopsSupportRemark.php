<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevopsSupportRemark extends Model
{
    protected $table = 'devops_support_remarks';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'request_id', // foreign key to devops_support_requests.id
        'remark'
    ];

    // Each remark belongs to one request
    public function request()
    {
        return $this->belongsTo(DevopsSupportRequest::class, 'request_id', 'id');
    }
}
