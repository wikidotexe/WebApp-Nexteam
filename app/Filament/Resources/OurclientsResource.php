<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurclientsResource\Pages;
use App\Filament\Resources\OurclientsResource\RelationManagers;
use App\Models\Ourclients;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OurclientsResource extends Resource
{
    protected static ?string $model = Ourclients::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function getNavigationGroup(): ?string
    {
        return 'Web';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name_clients')->required()->label('Name')->placeholder('Masukin nama perusahaan'),
                TextInput::make('information')->required()->placeholder('Masukin keterangan gambar'),
                TextInput::make('links')->label('Link Website')->placeholder('Masukin link perusahaan'),
                FIleUpload::make('image'),
                Select::make('status')->options([
                    1 => 'Active',
                    2 => 'Block'
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->width(100),
                TextColumn::make('name_clients'),
                TextColumn::make('information')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListOurclients::route('/'),
            'create' => Pages\CreateOurclients::route('/create'),
            'edit' => Pages\EditOurclients::route('/{record}/edit'),
        ];
    }
}
