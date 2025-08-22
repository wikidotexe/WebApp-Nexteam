<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;

class LatestProject extends BaseWidget
{
    protected static ?string $heading = 'Latest Project';

    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
	{
	    return Project::query()
	        ->select('projects.*')
	        ->leftJoin('invoices', 'projects.id', '=', 'invoices.project_id')
	        ->with(['client', 'invoices.items']);
	}

    protected function isTableSearchable(): bool
    {
        return true;
    }

    protected function modifyQueryUsing(Builder $query): Builder
    {
        if ($search = $this->getTableSearch()) {
            $query->whereHas('client', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('invoices', function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    protected function getTableColumns(): array
    {
        return [
			TextColumn::make('client.name')
			    ->label('Nama Client')
			    ->sortable()
			    ->searchable(),
			
			TextColumn::make('invoices.invoice_number')
		    ->label('Invoice Number')
		    ->sortable()
		    ->searchable(),

            TextColumn::make('client.category')
                ->label('Category')
                ->badge()
                ->default('-'),

            TextColumn::make('status')
                ->label('Project Status')
                ->badge()
                ->colors([
                    'success' => 'completed',
                    'warning' => 'in-progress',
                    'danger' => 'pending',
                ]),

            TextColumn::make('invoices.0.status')
                ->label('Status Invoice')
                ->badge()
                ->colors([
                    'success' => 'paid',
                    'warning' => 'unpaid',
                    'danger' => 'overdue',
                ])
                ->default('-'),

            TextColumn::make('price')
                ->label('Price')
                ->getStateUsing(function ($record) {
                    return $record->invoices->sum(function ($invoice) {
                        return $invoice->items->sum('total');
                    });
                })
                ->formatStateUsing(fn ($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : '-'),
        ];
    }
}