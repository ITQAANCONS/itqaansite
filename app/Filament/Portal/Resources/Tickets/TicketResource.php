<?php

namespace App\Filament\Portal\Resources\Tickets;

use App\Filament\Portal\Resources\Tickets\Pages\CreateTicket;
use App\Filament\Portal\Resources\Tickets\Pages\ListTickets;
use App\Filament\Portal\Resources\Tickets\Pages\ViewTicket;
use App\Filament\Portal\Resources\Tickets\RelationManagers\MessagesRelationManager;
use App\Models\Ticket;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLifebuoy;

    protected static ?string $navigationLabel = 'الدعم الفني';

    protected static ?string $modelLabel = 'تذكرة';

    protected static ?string $pluralModelLabel = 'تذاكر الدعم';

    /** Clients only ever see their own tickets. */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    // Authorize by ownership in the portal — bypass the Shield Ticket policy
    // (which is meant for staff in the admin panel). Query scoping above keeps
    // clients limited to their own tickets.
    public static function canViewAny(): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return true;
    }

    public static function canView(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return $record->user_id === auth()->id();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('subject')->label('الموضوع')->required()->columnSpanFull(),
            Select::make('priority')->label('الأولوية')->options(Ticket::PRIORITIES)->default('normal'),
            Textarea::make('initial_message')->label('تفاصيل المشكلة / الاستفسار')
                ->required()->rows(5)->columnSpanFull()
                ->dehydrated(false), // not a column — handled on create
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('last_reply_at', 'desc')
            ->columns([
                TextColumn::make('subject')->label('الموضوع')->weight('bold')->searchable(),
                TextColumn::make('status')->label('الحالة')->badge()
                    ->formatStateUsing(fn ($state) => Ticket::STATUSES[$state] ?? $state)
                    ->color(fn ($state) => match ($state) {
                        'open' => 'warning', 'answered' => 'success', 'closed' => 'gray', default => 'gray',
                    }),
                TextColumn::make('last_reply_at')->label('آخر رد')->since(),
            ])
            ->recordActions([
                \Filament\Actions\ViewAction::make()->label('عرض'),
            ]);
    }

    public static function getRelations(): array
    {
        return [MessagesRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTickets::route('/'),
            'create' => CreateTicket::route('/create'),
            'view' => ViewTicket::route('/{record}'),
        ];
    }
}
