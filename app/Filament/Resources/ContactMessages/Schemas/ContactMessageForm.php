<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('الاسم')->required(),
                TextInput::make('email')->label('البريد الإلكتروني')->email()->required(),
                TextInput::make('phone')->label('رقم الهاتف'),
                TextInput::make('subject')->label('الموضوع'),
                Textarea::make('message')->label('الرسالة')->required()->rows(6)->columnSpanFull(),
            ]);
    }
}
