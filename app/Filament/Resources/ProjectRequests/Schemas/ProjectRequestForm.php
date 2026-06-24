<?php

namespace App\Filament\Resources\ProjectRequests\Schemas;

use App\Support\Site;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('الاسم')->required(),
                TextInput::make('email')->label('البريد الإلكتروني')->email()->required(),
                TextInput::make('phone')->label('رقم الجوال')->tel()->required(),
                TextInput::make('company')->label('الجهة / الشركة'),

                Select::make('project_type')
                    ->label('نوع المشروع')
                    ->options(Site::projectTypeOptions())
                    ->required(),

                Select::make('services')
                    ->label('الخدمات المطلوبة')
                    ->multiple()
                    ->options(Site::serviceOptions())
                    ->columnSpanFull(),

                Textarea::make('description')->label('وصف المشروع')->required()->rows(5)->columnSpanFull(),

                Select::make('budget')->label('الميزانية')->options(Site::budgetOptions()),
                Select::make('timeline')->label('الإطار الزمني')->options(Site::timelineOptions()),
                Select::make('has_brand')->label('لديه هوية بصرية؟')->options(['yes' => 'نعم', 'no' => 'لا']),

                Select::make('status')
                    ->label('الحالة')
                    ->options(Site::statusOptions())
                    ->default('new')
                    ->required(),

                Textarea::make('admin_notes')->label('ملاحظات داخلية')->rows(3)->columnSpanFull(),
            ]);
    }
}
