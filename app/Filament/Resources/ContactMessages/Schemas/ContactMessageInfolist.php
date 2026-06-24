<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContactMessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')->label('الاسم'),
                TextEntry::make('email')->label('البريد الإلكتروني')->copyable(),
                TextEntry::make('phone')->label('رقم الهاتف')->placeholder('—')->copyable(),
                TextEntry::make('subject')->label('الموضوع')->placeholder('—'),
                TextEntry::make('message')->label('الرسالة')->columnSpanFull(),
                TextEntry::make('created_at')->label('التاريخ')->dateTime('Y-m-d H:i'),
            ]);
    }
}
