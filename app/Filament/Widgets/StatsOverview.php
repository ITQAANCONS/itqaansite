<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\ProjectRequest;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $newRequests = ProjectRequest::where('status', 'new')->count();
        $totalRequests = ProjectRequest::count();
        $unreadMessages = ContactMessage::whereNull('read_at')->count();

        return [
            Stat::make('طلبات جديدة', $newRequests)
                ->description('بانتظار المراجعة')
                ->descriptionIcon('heroicon-m-rocket-launch')
                ->color('info'),

            Stat::make('إجمالي الطلبات', $totalRequests)
                ->description('كل طلبات المشاريع')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('primary'),

            Stat::make('رسائل غير مقروءة', $unreadMessages)
                ->description('من نموذج التواصل')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('warning'),
        ];
    }
}
