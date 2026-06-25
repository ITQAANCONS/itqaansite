<?php

namespace App\Filament\Resources\Leads\Schemas;

use App\Models\Lead;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('بيانات العميل المحتمل')->columns(2)->schema([
                    TextInput::make('name')->label('الاسم')->required(),
                    TextInput::make('company')->label('الشركة / الجهة'),
                    TextInput::make('email')->label('البريد الإلكتروني')->email(),
                    TextInput::make('phone')->label('رقم الجوال')->tel(),
                ]),

                Section::make('المتابعة')->columns(2)->schema([
                    Select::make('stage')->label('المرحلة')->options(Lead::STAGES)->default('new')->required(),
                    Select::make('source')->label('المصدر')->options(Lead::SOURCES)->default('manual')->required(),
                    Select::make('assigned_to')->label('مسؤول المتابعة')
                        ->options(fn () => User::where('type', User::TYPE_STAFF)->pluck('name', 'id'))
                        ->searchable()->placeholder('غير مُسند'),
                    TextInput::make('value')->label('القيمة المتوقعة (ر.س)')->numeric()->prefix('﷼'),
                    DatePicker::make('next_follow_up')->label('موعد المتابعة القادم'),
                ]),

                Textarea::make('notes')->label('ملاحظات')->rows(4)->columnSpanFull(),
            ]);
    }
}
