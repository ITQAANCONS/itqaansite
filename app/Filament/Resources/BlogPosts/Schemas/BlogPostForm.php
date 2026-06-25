<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('content')
                    ->tabs([
                        Tab::make('المحتوى العربي')->schema([
                            TextInput::make('title_ar')->label('العنوان')->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, $set, $get) => filled($get('slug')) ? null : $set('slug', Str::slug($state))),
                            TextInput::make('category_ar')->label('التصنيف'),
                            Textarea::make('excerpt_ar')->label('وصف مختصر')->rows(2),
                            RichEditor::make('body_ar')->label('المقال')->columnSpanFull(),
                        ]),
                        Tab::make('English content')->schema([
                            TextInput::make('title_en')->label('Title'),
                            TextInput::make('category_en')->label('Category'),
                            Textarea::make('excerpt_en')->label('Short excerpt')->rows(2),
                            RichEditor::make('body_en')->label('Article')->columnSpanFull(),
                        ]),
                    ])->columnSpanFull(),

                Section::make('النشر')->columns(2)->schema([
                    TextInput::make('slug')->label('المعرّف (slug)')->required()->unique(ignoreRecord: true),
                    TextInput::make('author')->label('الكاتب')->default('فريق إتقان'),
                    Select::make('status')->label('الحالة')
                        ->options(['draft' => 'مسودة', 'published' => 'منشور'])
                        ->default('draft')->required()->live(),
                    DateTimePicker::make('published_at')->label('تاريخ النشر')
                        ->default(now())
                        ->visible(fn ($get) => $get('status') === 'published'),
                    Toggle::make('is_featured')->label('مميّز'),
                    FileUpload::make('cover_image')->label('صورة الغلاف')
                        ->image()->disk('public')->directory('blog')->visibility('public')
                        ->imageEditor()->maxSize(4096)->columnSpanFull(),
                ]),
            ]);
    }
}
