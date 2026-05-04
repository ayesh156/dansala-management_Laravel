<?php

namespace App\Filament\Resources\PledgeResource\Pages;

use App\Filament\Resources\PledgeResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreatePledge extends CreateRecord
{
    protected static string $resource = PledgeResource::class;

    // Stay on create page — user can add another pledge immediately
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('create');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('පොරොන්දුව සුරකින ලදී ✓')
            ->body('නව පොරොන්දුවක් ලියාපදිංචි කළ හැකිය.')
            ->duration(4000);
    }
}
