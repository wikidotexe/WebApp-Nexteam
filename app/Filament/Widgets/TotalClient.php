<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Client;

class TotalClient extends ChartWidget
{
    protected static ?string $heading = 'Total Client Monthly';

    protected function getData(): array
    {
        $months = range(1, 12);
        $labels = array_map(fn($m) => date('M', mktime(0, 0, 0, $m, 1)), $months);

        $data = [];

        foreach ($months as $month) {
            $data[] = Client::whereMonth('created_at', $month)
                ->whereYear('created_at', now()->year)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Client',
                    'data' => $data,
                    'backgroundColor' => '#3b82f6', // warna biru
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // ganti jadi bar chart
    }
}