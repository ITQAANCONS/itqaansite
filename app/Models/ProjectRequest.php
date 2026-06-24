<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'company', 'project_type', 'services',
        'description', 'budget', 'timeline', 'has_brand', 'status',
        'admin_notes', 'read_at',
    ];

    protected $casts = [
        'services' => 'array',
        'read_at'  => 'datetime',
    ];

    public const STATUSES = ['new', 'in_review', 'contacted', 'closed'];

    /** International phone digits for wa.me links. */
    public function getWhatsappNumberAttribute(): string
    {
        $digits = preg_replace('/\D+/', '', (string) $this->phone);
        // Saudi local numbers starting with 0 → prefix country code 966.
        if (str_starts_with($digits, '0')) {
            $digits = '966' . ltrim($digits, '0');
        }
        return $digits;
    }
}
