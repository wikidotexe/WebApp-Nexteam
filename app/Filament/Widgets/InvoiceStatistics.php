<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class InvoiceStatistics extends ChartWidget
{
    protected static ?string $heading = 'Invoice Statistics';

    protected static string $color = 'success';

    protected function getData(): array
    {
        // Ambil 12 bulan terakhir
        $months = range(1, 12);
        $labels = array_map(fn($m) => date('M', mktime(0, 0, 0, $m, 1)), $months);

        // Data per status
        $statuses = ['paid', 'unpaid', 'overdue'];
        $datasets = [];

        foreach ($statuses as $index => $status) {
            $data = [];

            foreach ($months as $month) {
                $data[] = \App\Models\Invoice::where('status', $status)
                    ->whereMonth('invoice_date', $month)
                    ->whereYear('invoice_date', now()->year)
                    ->count();
            }

            $datasets[] = [
                'label' => ucfirst($status),
                'data' => $data,
                'borderColor' => match ($status) {
                    'paid' => '#22c55e',
                    'unpaid' => '#facc15',
                    'overdue' => '#ef4444',
                },
                'fill' => false,
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}