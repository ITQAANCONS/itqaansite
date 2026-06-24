<?php

namespace App\Filament\Resources\ProjectRequests\Tables;

use App\Support\Site;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProjectRequestsTable
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

                TextColumn::make('phone')
                    ->label('الجوال')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('project_type')
                    ->label('نوع المشروع')
                    ->badge()
                    ->formatStateUsing(fn ($state) => Site::projectTypeOptions()[$state] ?? $state),

                TextColumn::make('budget')
                    ->label('الميزانية')
                    ->formatStateUsing(fn ($state) => $state ? (Site::budgetOptions()[$state] ?? $state) : '—')
                    ->toggleable(),

                TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->formatStateUsing(fn ($state) => Site::statusOptions()[$state] ?? $state)
                    ->color(fn ($state) => match ($state) {
                        'new'       => 'info',
                        'in_review' => 'warning',
                        'contacted' => 'success',
                        'closed'    => 'gray',
                        default     => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('تاريخ الطلب')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('الحالة')
                    ->options(Site::statusOptions()),
                SelectFilter::make('project_type')
                    ->label('نوع المشروع')
                    ->options(Site::projectTypeOptions()),
            ])
            ->recordActions([
                ViewAction::make()->label('عرض'),
                EditAction::make()->label('تعديل'),
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
