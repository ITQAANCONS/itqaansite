<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\ProjectRequest;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class SubmissionsChart extends ChartWidget
{
    protected ?string $heading = 'الطلبات والرسائل — آخر ١٤ يوماً';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $days = 14;
        $labels = [];
        $requests = [];
        $messages = [];

        $start = Carbon::today()->subDays($days - 1);

        // Pre-aggregate counts keyed by Y-m-d.
        $reqByDay = ProjectRequest::query()
            ->where('created_at', '>=', $start)
            ->get()
            ->groupBy(fn ($r) => $r->created_at->toDateString())
            ->map->count();

        $msgByDay = ContactMessage::query()
            ->where('created_at', '>=', $start)
            ->get()
            ->groupBy(fn ($m) => $m->created_at->toDateString())
            ->map->count();

        for ($i = 0; $i < $days; $i++) {
            $date = $start->copy()->addDays($i);
            $key = $date->toDateString();
            $labels[] = $date->format('m/d');
            $requests[] = $reqByDay[$key] ?? 0;
            $messages[] = $msgByDay[$key] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'طلبات المشاريع',
                    'data' => $requests,
                    'borderColor' => '#226b9f',
                    'backgroundColor' => 'rgba(34,107,159,0.12)',
                    'fill' => true,
                    'tension' => 0.35,
                ],
                [
                    'label' => 'رسائل التواصل',
                    'data' => $messages,
                    'borderColor' => '#27abe3',
                    'backgroundColor' => 'rgba(39,171,227,0.12)',
                    'fill' => true,
                    'tension' => 0.35,
                ],
            ],
            'labels' => $labels,
        ];
    }
}
