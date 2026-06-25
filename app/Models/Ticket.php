<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $fillable = [
        'user_id', 'subject', 'status', 'priority', 'assigned_to', 'last_reply_at',
    ];

    protected $casts = [
        'last_reply_at' => 'datetime',
    ];

    public const STATUSES = [
        'open'     => 'مفتوحة',
        'answered' => 'تم الرد',
        'closed'   => 'مغلقة',
    ];

    public const PRIORITIES = [
        'low'    => 'منخفضة',
        'normal' => 'عادية',
        'high'   => 'عاجلة',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(TicketMessage::class)->oldest();
    }
}
