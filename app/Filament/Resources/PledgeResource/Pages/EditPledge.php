<?php

namespace App\Filament\Resources\PledgeResource\Pages;

use App\Filament\Resources\PledgeResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPledge extends EditRecord
{
    protected static string $resource = PledgeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('මකන්න')
                ->successNotification(
                    Notification::make()
                        ->danger()
                        ->title('පොරොන්දුව මකා දමන ලදී')
                        ->body('පොරොන්දුව සාර්ථකව ඉවත් කරන ලදී.')
                ),
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
            ->title('පොරොන්දුව යාවත්කාලීන විය')
            ->body('පොරොන්දු විස්තර සාර්ථකව යාවත්කාලීන කරන ලදී.')
            ->duration(4000);
    }
}
