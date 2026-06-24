<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'subject', 'message', 'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function getWhatsappNumberAttribute(): string
    {
        $digits = preg_replace('/\D+/', '', (string) $this->phone);
        if (str_starts_with($digits, '0')) {
            $digits = '966' . ltrim($digits, '0');
        }
        return $digits;
    }
}
