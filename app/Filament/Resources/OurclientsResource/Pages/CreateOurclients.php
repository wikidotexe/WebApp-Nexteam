<?php

namespace App\Filament\Resources\OurclientsResource\Pages;

use App\Filament\Resources\OurclientsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateOurclients extends CreateRecord
{
    protected static string $resource = OurclientsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Ourclients created')
        ->body('Ourclients created successfully.');
}
}
