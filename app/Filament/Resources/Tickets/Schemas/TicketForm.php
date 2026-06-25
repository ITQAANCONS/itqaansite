<?php

namespace App\Filament\Resources\Tickets\Schemas;

use App\Models\Ticket;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('subject')->label('الموضوع')->required()->columnSpanFull(),
                Select::make('status')->label('الحالة')->options(Ticket::STATUSES)->default('open')->required(),
                Select::make('priority')->label('الأولوية')->options(Ticket::PRIORITIES)->default('normal')->required(),
                Select::make('assigned_to')->label('مُسند إلى')
                    ->options(fn () => User::where('type', User::TYPE_STAFF)->pluck('name', 'id'))
                    ->searchable()->placeholder('غير مُسند'),
            ]);
    }
}
