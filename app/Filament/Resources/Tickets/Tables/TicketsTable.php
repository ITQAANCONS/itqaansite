<?php

namespace App\Filament\Resources\Tickets\Tables;

use App\Models\Ticket;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('last_reply_at', 'desc')
            ->columns([
                TextColumn::make('subject')->label('الموضوع')->weight('bold')
                    ->description(fn ($record) => $record->user?->name)
                    ->searchable()->limit(50),

                TextColumn::make('status')->label('الحالة')->badge()
                    ->formatStateUsing(fn ($state) => Ticket::STATUSES[$state] ?? $state)
                    ->color(fn ($state) => match ($state) {
                        'open' => 'warning', 'answered' => 'success', 'closed' => 'gray', default => 'gray',
                    }),

                TextColumn::make('priority')->label('الأولوية')->badge()
                    ->formatStateUsing(fn ($state) => Ticket::PRIORITIES[$state] ?? $state)
                    ->color(fn ($state) => $state === 'high' ? 'danger' : ($state === 'low' ? 'gray' : 'info')),

                TextColumn::make('assignee.name')->label('مُسند إلى')->placeholder('—')->toggleable(),

                TextColumn::make('last_reply_at')->label('آخر رد')->since()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')->label('الحالة')->options(Ticket::STATUSES),
                SelectFilter::make('priority')->label('الأولوية')->options(Ticket::PRIORITIES),
            ])
            ->recordActions([
                ViewAction::make()->label('عرض'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
