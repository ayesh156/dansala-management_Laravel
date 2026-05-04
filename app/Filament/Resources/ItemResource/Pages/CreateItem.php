<?php

namespace App\Filament\Resources\ItemResource\Pages;

use App\Filament\Resources\ItemResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateItem extends CreateRecord
{
    protected static string $resource = ItemResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('භාණ්ඩය එකතු කරන ලදී')
            ->body('නව භාණ්ඩය සාර්ථකව ලියාපදිංචි කරන ලදී.')
            ->duration(4000);
    }
}
