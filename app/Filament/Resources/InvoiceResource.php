<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Invoices';

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
                    ->required()
                    ->unique(ignoreRecord: true),
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
                Tables\Columns\TextColumn::make('total_amount')->money('IDR'),
                Tables\Columns\TextColumn::make('status')->badge(),
            ])
            ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            
            Tables\Actions\Action::make('viewPdf')
                ->label('View PDF')
                ->icon('heroicon-o-eye')
                ->color('primary')
                ->action(function (Invoice $record) {
                    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoice.pdf', ['invoice' => $record]);

                    return response($pdf->output(), 200)
                        ->header('Content-Type', 'application/pdf')
                        ->header('Content-Disposition', 'inline; filename="invoice-' . $record->invoice_number . '.pdf"');
                }),

            Tables\Actions\Action::make('downloadPdf')
                ->label('Download PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('danger')
                ->action(function (Invoice $record) {
                    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoice.pdf', ['invoice' => $record]);

                    return response()->streamDownload(
                        fn() => print($pdf->output()),
                        'invoice-' . $record->invoice_number . '.pdf'
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
