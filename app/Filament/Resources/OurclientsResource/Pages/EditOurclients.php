<?php

namespace App\Filament\Resources\OurclientsResource\Pages;

use App\Filament\Resources\OurclientsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditOurclients extends EditRecord
{
    protected static string $resource = OurclientsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];  
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Ourclients Updated')
            ->body('Ourclients updated successfully.');
    }
}
