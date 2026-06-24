<?php

namespace App\Filament\Resources\ProjectRequests\Pages;

use App\Filament\Resources\ProjectRequests\ProjectRequestResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProjectRequest extends ViewRecord
{
    protected static string $resource = ProjectRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
