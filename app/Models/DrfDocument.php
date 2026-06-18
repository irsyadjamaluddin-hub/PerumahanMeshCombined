<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrfDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'devops_request_id',
        'doc_name',
        'doc_path',
        'doc_size',
        'doc_mime',
    ];

    public function devopsrequest() {
        return $this->belongsTo(DevopsRequest::class);
    }
}
