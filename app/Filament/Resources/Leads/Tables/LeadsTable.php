<?php

namespace App\Filament\Resources\Leads\Tables;

use App\Models\Lead;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->groups([
                Group::make('stage')->label('المرحلة')
                    ->getTitleFromRecordUsing(fn ($record) => Lead::STAGES[$record->stage] ?? $record->stage),
            ])
            ->columns([
                TextColumn::make('name')->label('الاسم')->weight('bold')
                    ->description(fn ($record) => $record->company)->searchable(),

                TextColumn::make('stage')->label('المرحلة')->badge()
                    ->formatStateUsing(fn ($state) => Lead::STAGES[$state] ?? $state)
                    ->color(fn ($state) => match ($state) {
                        'new' => 'gray', 'contacted' => 'info', 'qualified' => 'warning',
                        'proposal' => 'primary', 'won' => 'success', 'lost' => 'danger', default => 'gray',
                    }),

                TextColumn::make('source')->label('المصدر')->badge()->color('gray')
                    ->formatStateUsing(fn ($state) => Lead::SOURCES[$state] ?? $state)->toggleable(),

                TextColumn::make('value')->label('القيمة')->money('SAR')->placeholder('—')->toggleable(),

                TextColumn::make('assignee.name')->label('المسؤول')->placeholder('—')->toggleable(),

                TextColumn::make('next_follow_up')->label('المتابعة القادمة')->date('Y-m-d')->placeholder('—')
                    ->color(fn ($record) => $record->next_follow_up && $record->next_follow_up->isPast() ? 'danger' : null)
                    ->sortable(),

                TextColumn::make('created_at')->label('أُضيف')->since()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('stage')->label('المرحلة')->options(Lead::STAGES),
                SelectFilter::make('source')->label('المصدر')->options(Lead::SOURCES),
            ])
            ->recordActions([
                EditAction::make()->label('تعديل'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
