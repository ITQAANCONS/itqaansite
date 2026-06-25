<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Project;
use App\Support\Site;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('content')
                    ->tabs([
                        Tab::make('المحتوى العربي')
                            ->schema([
                                TextInput::make('title_ar')->label('اسم المشروع')->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, $set, $get) => filled($get('slug')) ? null : $set('slug', Str::slug($state))),
                                TextInput::make('category_ar')->label('التصنيف'),
                                TextInput::make('client_ar')->label('العميل'),
                                Textarea::make('excerpt_ar')->label('وصف مختصر')->rows(2),
                                Textarea::make('description_ar')->label('الوصف الكامل')->rows(6),
                            ]),
                        Tab::make('English content')
                            ->schema([
                                TextInput::make('title_en')->label('Project name')->required(),
                                TextInput::make('category_en')->label('Category'),
                                TextInput::make('client_en')->label('Client'),
                                Textarea::make('excerpt_en')->label('Short excerpt')->rows(2),
                                Textarea::make('description_en')->label('Full description')->rows(6),
                            ]),
                    ])
                    ->columnSpanFull(),

                Section::make('تفاصيل المشروع')
                    ->columns(2)
                    ->schema([
                        TextInput::make('slug')->label('المعرّف (slug)')->required()->unique(ignoreRecord: true)
                            ->helperText('يُستخدم في رابط المشروع'),
                        Select::make('platform')->label('النوع')
                            ->options(collect(Project::PLATFORMS)->map(fn ($v) => $v['ar']))
                            ->default('website')->required(),
                        TextInput::make('url')->label('رابط المشروع')->url()->prefix('https://')->placeholder('example.com'),
                        TextInput::make('year')->label('السنة')->numeric()->minValue(2000)->maxValue(2100),
                        Select::make('services')->label('الخدمات المقدّمة')
                            ->multiple()->options(Site::serviceOptions())->columnSpanFull(),
                        FileUpload::make('image')->label('صورة المشروع (واجهة الموقع/التطبيق)')
                            ->image()->disk('public')->directory('projects')->visibility('public')
                            ->imageEditor()->maxSize(4096)->columnSpanFull(),
                    ]),

                Section::make('النشر')
                    ->columns(3)
                    ->schema([
                        Toggle::make('is_published')->label('منشور')->default(true),
                        Toggle::make('is_featured')->label('مميّز (يظهر في الرئيسية)'),
                        TextInput::make('sort_order')->label('الترتيب')->numeric()->default(0),
                    ]),
            ]);
    }
}
