<?php

namespace App\Filament\Resources\ProjectRequests;

use App\Filament\Resources\ProjectRequests\Pages\CreateProjectRequest;
use App\Filament\Resources\ProjectRequests\Pages\EditProjectRequest;
use App\Filament\Resources\ProjectRequests\Pages\ListProjectRequests;
use App\Filament\Resources\ProjectRequests\Pages\ViewProjectRequest;
use App\Filament\Resources\ProjectRequests\Schemas\ProjectRequestForm;
use App\Filament\Resources\ProjectRequests\Schemas\ProjectRequestInfolist;
use App\Filament\Resources\ProjectRequests\Tables\ProjectRequestsTable;
use App\Models\ProjectRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProjectRequestResource extends Resource
{
    protected static ?string $model = ProjectRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRocketLaunch;

    protected static string|UnitEnum|null $navigationGroup = 'الطلبات والتواصل';

    protected static ?string $navigationLabel = 'طلبات المشاريع';

    protected static ?string $modelLabel = 'طلب مشروع';

    protected static ?string $pluralModelLabel = 'طلبات المشاريع';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'new')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'info';
    }

    public static function form(Schema $schema): Schema
    {
        return ProjectRequestForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProjectRequestInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectRequestsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjectRequests::route('/'),
            'create' => CreateProjectRequest::route('/create'),
            'view' => ViewProjectRequest::route('/{record}'),
            'edit' => EditProjectRequest::route('/{record}/edit'),
        ];
    }
}
