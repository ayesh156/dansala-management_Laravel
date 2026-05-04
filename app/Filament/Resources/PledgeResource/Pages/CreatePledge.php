<?php

namespace App\Filament\Resources\PledgeResource\Pages;

use App\Filament\Resources\PledgeResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreatePledge extends CreateRecord
{
    protected static string $resource = PledgeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('පොරොන්දුව සුරකින ලදී')
            ->body('දායකත්ව පොරොන්දුව සාර්ථකව ලියාපදිංචි කරන ලදී.')
            ->duration(4000);
    }
}
