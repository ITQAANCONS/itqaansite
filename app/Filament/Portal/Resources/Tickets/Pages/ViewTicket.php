<?php

namespace App\Filament\Portal\Resources\Tickets\Pages;

use App\Filament\Portal\Resources\Tickets\TicketResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('subject')->label('الموضوع'),
            TextEntry::make('status')->label('الحالة')->badge()
                ->formatStateUsing(fn ($state) => \App\Models\Ticket::STATUSES[$state] ?? $state),
            TextEntry::make('created_at')->label('تاريخ الفتح')->dateTime('Y-m-d H:i'),
        ]);
    }
}
