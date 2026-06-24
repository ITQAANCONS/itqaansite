<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                IconColumn::make('read_at')
                    ->label('مقروءة')
                    ->boolean()
                    ->state(fn ($record) => $record->read_at !== null),

                TextColumn::make('name')
                    ->label('الاسم')
                    ->weight('bold')
                    ->description(fn ($record) => $record->email)
                    ->searchable(),

                TextColumn::make('subject')
                    ->label('الموضوع')
                    ->placeholder('—')
                    ->limit(40)
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('الهاتف')
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('التاريخ')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->recordActions([
                ViewAction::make()->label('عرض'),
                Action::make('whatsapp')
                    ->label('واتساب')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('success')
                    ->url(fn ($record) => 'https://wa.me/' . $record->whatsapp_number)
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => filled($record->whatsapp_number)),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
