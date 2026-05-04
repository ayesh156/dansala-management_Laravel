<?php

namespace App\Filament\Resources\CashDonationResource\Pages;

use App\Filament\Resources\CashDonationResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateCashDonation extends CreateRecord
{
    protected static string $resource = CashDonationResource::class;

    // Stay on create page after saving — user can add another immediately
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('create');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('සල්ලි දායකත්වය සුරකින ලදී ✓')
            ->body('නව සල්ලි දායකත්වයක් ලියාපදිංචි කළ හැකිය.')
            ->duration(4000);
    }
}
