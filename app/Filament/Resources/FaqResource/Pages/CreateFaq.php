<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Filament\Resources\FaqResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateFaq extends CreateRecord
{
    protected static string $resource = FaqResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
{
    return Notification::make()
        ->success()
        ->title('Faq created')
        ->body('Faq created successfully.');
}
}
