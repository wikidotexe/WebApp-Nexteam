<?php

namespace App\Filament\Resources\OurclientsResource\Pages;

use App\Filament\Resources\OurclientsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOurclients extends ListRecords
{
    protected static string $resource = OurclientsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
