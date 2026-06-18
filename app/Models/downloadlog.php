<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadLog extends Model
{
    // Table name (optional if it matches plural of model)
    protected $table = 'download_logs';

    // Primary key
    protected $primaryKey = 'id';

    // Columns that are mass assignable
    protected $fillable = [
        'file',
        'action',
        'ip_address',
        'user_agent',
        'user_id',
        'session_id',
        'created_at',
        'updated_at',
    ];

    // Eloquent timestamps (true since table has created_at & updated_at)
    public $timestamps = true;

    /**
     * Quick stats helper
     */
    public static function statsFor(string $file): array
    {
        return [
            'views'      => static::where('file', $file)->where('action', 'view')->count(),
            'downloads'  => static::where('file', $file)->where('action', 'download')->count(),
            'unique_ips' => static::where('file', $file)->distinct('ip_address')->count('ip_address'),
            'today'      => [
                'views'     => static::where('file', $file)->where('action', 'view')->whereDate('created_at', today())->count(),
                'downloads' => static::where('file', $file)->where('action', 'download')->whereDate('created_at', today())->count(),
            ],
        ];
    }
}
