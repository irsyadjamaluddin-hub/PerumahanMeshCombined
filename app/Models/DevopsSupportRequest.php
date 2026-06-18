<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevopsSupportRequest extends Model
{
    // Force table with dbo schema (SQL Server)
    protected $table = 'dbo.devops_support_requests';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Fields that can be mass assigned
    protected $fillable = [
        'name',
        'email',
        'contact',
        'department',
        'unit',
        'perkara',
        'huraian',
        'priority',
        'status',
    ];

    // Default attributes
    protected $attributes = [
        'status' => 'Tertunda',
    ];

    // Constants for allowed values
    public const STATUS_ALLOWED   = ['Tertunda','Sedang Diproses','Selesai','Ditangguh'];
    public const PRIORITY_ALLOWED = ['Rendah','Sederhana','Tinggi'];

    // Relationships
    public function attachments()
    {
        return $this->hasMany(DevopsSupportAttachment::class, 'request_id', 'id');
    }

    public function remarks()
    {
        return $this->hasMany(DevopsSupportRemark::class, 'request_id', 'id');
    }

    // Virtual fields
    protected $appends = ['ticket_id', 'status_label', 'priority_label'];

    public function getTicketIdAttribute(): string
    {
        return 'DSD' . $this->id;
    }

    public function getStatusLabelAttribute(): string
    {
        return (string) $this->status;
    }

    public function getPriorityLabelAttribute(): string
    {
        return (string) $this->priority;
    }

    // Badge helpers (for UI)
    public function getStatusBadgeClass(): string
    {
        return match ($this->status) {
            'Tertunda'        => 'secondary',
            'Sedang Diproses' => 'warning',
            'Selesai'         => 'success',
            'Ditangguh'       => 'dark',
            default           => 'light',
        };
    }

    public function getPriorityBadgeClass(): string
    {
        return match ($this->priority) {
            'Tinggi'    => 'danger',
            'Sederhana' => 'warning',
            'Rendah'    => 'success',
            default     => 'secondary',
        };
    }

    // Mutators (normalize input values)
    public function setPriorityAttribute($value): void
    {
        $map = [
            'low'    => 'Rendah',
            'medium' => 'Sederhana',
            'high'   => 'Tinggi',
        ];
        $key = strtolower(trim((string) $value));
        $this->attributes['priority'] = $map[$key] ?? $value;
    }

    public function setStatusAttribute($value): void
    {
        $map = [
            ''            => 'Tertunda',
            'open'        => 'Tertunda',
            'pending'     => 'Tertunda',
            'in progress' => 'Sedang Diproses',
            'completed'   => 'Selesai',
            'on hold'     => 'Ditangguh',
        ];
        $key = strtolower(trim((string) $value));
        $this->attributes['status'] = $map[$key] ?? $value;
    }

    // Query scopes
    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopePriority($query, string $priority)
    {
        return $query->where('priority', $priority);
    }

    // Casts
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
