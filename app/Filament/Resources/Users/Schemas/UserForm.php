<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->label('الاسم')->required()->maxLength(120),
                TextInput::make('email')->label('البريد الإلكتروني')->email()->required()->unique(ignoreRecord: true),

                Select::make('type')
                    ->label('النوع')
                    ->options([User::TYPE_STAFF => 'عضو فريق', User::TYPE_CLIENT => 'عميل'])
                    ->default(User::TYPE_STAFF)
                    ->live()
                    ->required(),

                Toggle::make('is_active')->label('حساب مفعّل')->default(true),

                TextInput::make('phone')->label('رقم الجوال')->tel()->maxLength(40),
                TextInput::make('company')
                    ->label('الشركة / الجهة')
                    ->maxLength(160)
                    ->visible(fn ($get) => $get('type') === User::TYPE_CLIENT),

                Select::make('roles')
                    ->label('الأدوار')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->visible(fn ($get) => $get('type') === User::TYPE_STAFF)
                    ->columnSpanFull(),

                TextInput::make('password')
                    ->label('كلمة المرور')
                    ->password()
                    ->revealable()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation) => $operation === 'create')
                    ->helperText('اتركها فارغة عند التعديل للإبقاء على كلمة المرور الحالية.')
                    ->columnSpanFull(),
            ]);
    }
}
