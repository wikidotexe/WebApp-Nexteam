<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Tables\Actions\Action;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Carbon\Carbon;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Invoices';

    public static function getNavigationGroup(): ?string
    {
        return 'Work';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'name')
                    ->required(),

                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'title')
                    ->required(),

                Forms\Components\TextInput::make('invoice_number')
                    ->disabled()
                    ->default(function () {
                        $year = date('Y');
                        $lastId = Invoice::max('id') + 1;
                        return "{$year}-Nexteam-" . str_pad($lastId, 5, '0', STR_PAD_LEFT);
                    }),

                Forms\Components\DatePicker::make('invoice_date')->required(),

                Forms\Components\TextInput::make('tax')
                    ->numeric()
                    ->suffix('%')
                    ->default(0),

                Forms\Components\Select::make('status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'paid' => 'Paid',
                        'overdue' => 'Overdue',
                    ])
                    ->default('unpaid')
                    ->required(),

                Forms\Components\TextInput::make('notes')
                    ->required(),

                Forms\Components\Repeater::make('items')
                    ->relationship('items')
                    ->schema([
                        Forms\Components\TextInput::make('description')->required(),
                        Forms\Components\TextInput::make('quantity')->numeric()->required(),
                        Forms\Components\TextInput::make('unit_price')->numeric()->prefix('Rp')->required(),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('client.name'),
                Tables\Columns\TextColumn::make('project.title'),
                Tables\Columns\TextColumn::make('invoice_date')->date(),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('total')
                ->label('Price')
                ->money('IDR')
                ->getStateUsing(function (Invoice $record) {
                    $taxRate = ($record->tax ?? 0) / 100;

                    // Jumlahkan tiap item: (qty * unit_price) + rounded(tax per item)
                    $grandTotal = $record->items->sum(function ($item) use ($taxRate) {
                        $itemTotal = $item->quantity * $item->unit_price;
                        $itemTax = (int) round($itemTotal * $taxRate); // pembulatan pajak per-item
                        return $itemTotal + $itemTax;
                    });

                    return $grandTotal;
                }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('viewPdf')
                    ->label('View PDF')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->modalHeading('Invoice Preview')
                    ->modalContent(function (Invoice $record) {
                        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoice.pdf', [
                            'invoice' => $record
                        ]);
                        
                        $base64Pdf = base64_encode($pdf->output());

                        return view('components.pdf-viewer', [
                            'pdfData' => $base64Pdf
                        ]);
                    })
                    ->modalWidth('7xl')
                    ->requiresConfirmation(false),

                Tables\Actions\Action::make('downloadPdf')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('danger')
                    ->action(function (Invoice $record) {
                        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoice.pdf', ['invoice' => $record]);
                        $filename = 'invoice-' . Carbon::now()->format('Ymd') . '-Nexteam' . str_pad($record->id, 5, '0', STR_PAD_LEFT) . '-' . str_replace(' ', '_', $record->client->name) . '-' . str_replace(' ', '_', $record->project->title) . '.pdf';

                        return response()->streamDownload(
                            fn() => print($pdf->output()),
                            $filename
                        );
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
