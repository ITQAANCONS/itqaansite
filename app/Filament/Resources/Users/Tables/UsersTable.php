<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->label('الاسم')
                    ->weight('bold')
                    ->description(fn ($record) => $record->email)
                    ->searchable(),

                TextColumn::make('type')
                    ->label('النوع')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === User::TYPE_CLIENT ? 'عميل' : 'عضو فريق')
                    ->color(fn ($state) => $state === User::TYPE_CLIENT ? 'info' : 'primary'),

                TextColumn::make('roles.name')
                    ->label('الأدوار')
                    ->badge()
                    ->separator(',')
                    ->placeholder('—'),

                IconColumn::make('is_active')
                    ->label('مفعّل')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->dateTime('Y-m-d')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('النوع')
                    ->options([User::TYPE_STAFF => 'عضو فريق', User::TYPE_CLIENT => 'عميل']),
                SelectFilter::make('roles')
                    ->label('الدور')
                    ->relationship('roles', 'name'),
            ])
            ->recordActions([
                EditAction::make()->label('تعديل'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
