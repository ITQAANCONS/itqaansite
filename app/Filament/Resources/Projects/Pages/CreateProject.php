<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use App\Models\Project;
use App\Services\ProjectAiGenerator;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generateWithAi')
                ->label('توليد بالذكاء الاصطناعي')
                ->icon('heroicon-o-sparkles')
                ->color('info')
                ->schema([
                    TextInput::make('name')->label('اسم المشروع')->required(),
                    TextInput::make('url')->label('رابط المشروع (اختياري)')->url(),
                    Select::make('platform')->label('النوع')
                        ->options(collect(Project::PLATFORMS)->map(fn ($v) => $v['ar'])),
                    Textarea::make('notes')->label('ملاحظات / وصف موجز (اختياري)')->rows(3),
                ])
                ->action(function (array $data, ProjectAiGenerator $generator): void {
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

                    Notification::make()->title('تم توليد بيانات المشروع — راجعها ثم احفظ')->success()->send();
                }),
        ];
    }
}
