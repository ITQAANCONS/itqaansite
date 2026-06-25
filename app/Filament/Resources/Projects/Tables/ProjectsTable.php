<?php

namespace App\Filament\Resources\Projects\Tables;

use App\Models\Project;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                ImageColumn::make('image')
                    ->label('الصورة')
                    ->disk('public')
                    ->height(44)
                    ->extraImgAttributes(['class' => 'rounded-lg object-cover']),

                TextColumn::make('title_ar')
                    ->label('المشروع')
                    ->weight('bold')
                    ->description(fn ($record) => $record->title_en)
                    ->searchable(['title_ar', 'title_en']),

                TextColumn::make('platform')
                    ->label('النوع')
                    ->badge()
                    ->formatStateUsing(fn ($state) => Project::PLATFORMS[$state]['ar'] ?? $state),

                TextColumn::make('year')->label('السنة')->toggleable(),

                IconColumn::make('is_featured')->label('مميّز')->boolean()->toggleable(),
                IconColumn::make('is_published')->label('منشور')->boolean(),
            ])
            ->filters([
                SelectFilter::make('platform')
                    ->label('النوع')
                    ->options(collect(Project::PLATFORMS)->map(fn ($v) => $v['ar'])),
                TernaryFilter::make('is_published')->label('منشور'),
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
