<?php

namespace App\Filament\Resources\ProjectRequests\Schemas;

use App\Support\Site;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProjectRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')->label('الاسم'),
                TextEntry::make('email')->label('البريد الإلكتروني')->copyable(),
                TextEntry::make('phone')->label('رقم الجوال')->copyable(),
                TextEntry::make('company')->label('الجهة / الشركة')->placeholder('—'),

                TextEntry::make('project_type')
                    ->label('نوع المشروع')
                    ->badge()
                    ->formatStateUsing(fn ($state) => Site::projectTypeOptions()[$state] ?? $state),

                TextEntry::make('services')
                    ->label('الخدمات المطلوبة')
                    ->badge()
                    ->formatStateUsing(fn ($state) => Site::serviceOptions()[$state] ?? $state)
                    ->placeholder('—')
                    ->columnSpanFull(),

                TextEntry::make('budget')
                    ->label('الميزانية')
                    ->formatStateUsing(fn ($state) => $state ? (Site::budgetOptions()[$state] ?? $state) : '—'),
                TextEntry::make('timeline')
                    ->label('الإطار الزمني')
                    ->formatStateUsing(fn ($state) => $state ? (Site::timelineOptions()[$state] ?? $state) : '—'),
                TextEntry::make('has_brand')
                    ->label('لديه هوية بصرية؟')
                    ->formatStateUsing(fn ($state) => match ($state) { 'yes' => 'نعم', 'no' => 'لا', default => '—' }),

                TextEntry::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->formatStateUsing(fn ($state) => Site::statusOptions()[$state] ?? $state)
                    ->color(fn ($state) => match ($state) {
                        'new' => 'info', 'in_review' => 'warning', 'contacted' => 'success', default => 'gray',
                    }),

                TextEntry::make('description')->label('وصف المشروع')->columnSpanFull(),
                TextEntry::make('admin_notes')->label('ملاحظات داخلية')->placeholder('—')->columnSpanFull(),

                TextEntry::make('created_at')->label('تاريخ الطلب')->dateTime('Y-m-d H:i'),
                TextEntry::make('updated_at')->label('آخر تحديث')->dateTime('Y-m-d H:i'),
            ]);
    }
}
