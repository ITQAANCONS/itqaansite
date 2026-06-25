<?php

namespace App\Filament\Portal\Resources\Tickets\Pages;

use App\Filament\Portal\Resources\Tickets\TicketResource;
use App\Models\TicketMessage;
use Filament\Resources\Pages\CreateRecord;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;

    /** Stash the first message, then attach the ticket to the current client. */
    private ?string $initialMessage = null;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->initialMessage = $data['initial_message'] ?? null;
        unset($data['initial_message']);

        $data['user_id'] = auth()->id();
        $data['status'] = 'open';
        $data['last_reply_at'] = now();

        return $data;
    }

    protected function afterCreate(): void
    {
        if (filled($this->initialMessage)) {
            TicketMessage::create([
                'ticket_id' => $this->record->id,
                'user_id' => auth()->id(),
                'body' => $this->initialMessage,
            ]);
        }

        app(\App\Services\TelegramNotifier::class)
            ->notifyTicket($this->record, (string) $this->initialMessage);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->record]);
    }
}
