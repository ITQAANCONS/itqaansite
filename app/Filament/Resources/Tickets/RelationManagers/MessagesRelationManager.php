<?php

namespace App\Filament\Resources\Tickets\RelationManagers;

use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MessagesRelationManager extends RelationManager
{
    protected static string $relationship = 'messages';

    protected static ?string $title = 'المحادثة';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('body')->label('الرد')->required()->rows(4)->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'asc')
            ->columns([
                TextColumn::make('author.name')
                    ->label('من')
                    ->badge()
                    ->color(fn ($record) => $record->author?->isStaff() ? 'info' : 'gray')
                    ->formatStateUsing(fn ($state, $record) => $state . ($record->author?->isStaff() ? ' (الفريق)' : '')),
                TextColumn::make('body')->label('الرسالة')->wrap(),
                TextColumn::make('created_at')->label('الوقت')->dateTime('Y-m-d H:i'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('رد')
                    ->mutateDataUsing(function (array $data) {
                        $data['user_id'] = auth()->id();
                        return $data;
                    }),
            ])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
