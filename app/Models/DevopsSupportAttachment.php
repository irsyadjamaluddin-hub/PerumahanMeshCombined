<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevopsSupportAttachment extends Model
{
    protected $table = 'devops_support_attachments';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'request_id', // foreign key to devops_support_requests.id
        'file_name',
        'file_path'
    ];

    // Each attachment belongs to one request
    public function request()
    {
        return $this->belongsTo(DevopsSupportRequest::class, 'request_id', 'id');
    }
}
