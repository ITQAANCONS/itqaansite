<?php

namespace App\Filament\Resources\BlogPosts\Pages;

use App\Filament\Resources\BlogPosts\BlogPostResource;
use App\Services\BlogAiGenerator;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateBlogPost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('draftWithAi')
                ->label('مسودة بالذكاء الاصطناعي')
                ->icon('heroicon-o-sparkles')
                ->color('info')
                ->schema([
                    TextInput::make('topic')->label('موضوع المقال')->required()
                        ->placeholder('مثال: أهمية تحسين تجربة المستخدم في المتاجر الإلكترونية'),
                    Textarea::make('notes')->label('ملاحظات / نقاط رئيسية (اختياري)')->rows(3),
                ])
                ->action(function (array $data, BlogAiGenerator $generator): void {
                    try {
                        $generated = $generator->generate($data);
                    } catch (\Throwable $e) {
                        Notification::make()->title('تعذّر التوليد')->body($e->getMessage())->danger()->send();
                        return;
                    }

                    if (empty($generated['slug']) && ! empty($generated['title_en'])) {
                        $generated['slug'] = Str::slug($generated['title_en']);
                    }

                    $this->data = array_merge($this->data ?? [], $generated);
                    $this->form->fill($this->data);

                    Notification::make()->title('تم إنشاء المسودة — راجعها ثم احفظ')->success()->send();
                }),
        ];
    }
}
