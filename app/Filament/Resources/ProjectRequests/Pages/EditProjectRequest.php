<?php

namespace App\Filament\Resources\ProjectRequests\Pages;

use App\Filament\Resources\ProjectRequests\ProjectRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProjectRequest extends EditRecord
{
    protected static string $resource = ProjectRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
