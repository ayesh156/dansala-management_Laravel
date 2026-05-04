<?php

namespace App\Filament\Resources\ItemResource\Pages;

use App\Filament\Resources\ItemResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateItem extends CreateRecord
{
    protected static string $resource = ItemResource::class;

    // Stay on create page — user can add another item immediately
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('create');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('භාණ්ඩය එකතු කරන ලදී ✓')
            ->body('නව භාණ්ඩයක් ලියාපදිංචි කළ හැකිය.')
            ->duration(4000);
    }
}
