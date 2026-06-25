<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company', 'source', 'stage',
        'value', 'assigned_to', 'next_follow_up', 'notes', 'project_request_id',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'next_follow_up' => 'date',
    ];

    public const STAGES = [
        'new'       => 'جديد',
        'contacted' => 'تم التواصل',
        'qualified' => 'مؤهّل',
        'proposal'  => 'عرض سعر',
        'won'       => 'ناجح',
        'lost'      => 'خاسر',
    ];

    public const SOURCES = [
        'website_request' => 'طلب من الموقع',
        'contact'         => 'نموذج تواصل',
        'manual'          => 'إضافة يدوية',
        'referral'        => 'ترشيح',
    ];

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function projectRequest(): BelongsTo
    {
        return $this->belongsTo(ProjectRequest::class);
    }

    public function scopeOpen($query)
    {
        return $query->whereNotIn('stage', ['won', 'lost']);
    }
}
