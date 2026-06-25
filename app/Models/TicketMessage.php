<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketMessage extends Model
{
    protected $fillable = ['ticket_id', 'user_id', 'body'];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function booted(): void
    {
        // Keep the parent ticket in sync: a staff reply marks it answered,
        // a client reply (re)opens it; both bump the last-reply time.
        static::created(function (TicketMessage $message): void {
            $ticket = $message->ticket;
            if (! $ticket) {
                return;
            }

            $isStaff = $message->author?->isStaff() ?? false;

            $ticket->forceFill([
                'last_reply_at' => now(),
                'status' => $ticket->status === 'closed' && $isStaff ? 'closed' : ($isStaff ? 'answered' : 'open'),
            ])->save();
        });
    }
}

