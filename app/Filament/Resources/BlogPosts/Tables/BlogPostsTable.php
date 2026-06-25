<?php

namespace App\Filament\Resources\BlogPosts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BlogPostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                ImageColumn::make('cover_image')->label('الغلاف')->disk('public')->height(44)
                    ->extraImgAttributes(['class' => 'rounded-lg object-cover']),

                TextColumn::make('title_ar')->label('العنوان')->weight('bold')
                    ->description(fn ($record) => $record->title_en)
                    ->searchable(['title_ar', 'title_en'])->limit(50),

                TextColumn::make('status')->label('الحالة')->badge()
                    ->formatStateUsing(fn ($state) => $state === 'published' ? 'منشور' : 'مسودة')
                    ->color(fn ($state) => $state === 'published' ? 'success' : 'gray'),

                IconColumn::make('is_featured')->label('مميّز')->boolean()->toggleable(),

                TextColumn::make('published_at')->label('تاريخ النشر')->dateTime('Y-m-d')->sortable()->placeholder('—'),
            ])
            ->filters([
                SelectFilter::make('status')->label('الحالة')
                    ->options(['draft' => 'مسودة', 'published' => 'منشور']),
            ])
            ->recordActions([
                EditAction::make()->label('تعديل'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
