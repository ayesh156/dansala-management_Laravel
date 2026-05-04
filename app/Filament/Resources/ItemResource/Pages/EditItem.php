<?php

namespace App\Filament\Resources\ItemResource\Pages;

use App\Filament\Resources\ItemResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditItem extends EditRecord
{
    protected static string $resource = ItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('මකන්න')
                ->successNotification(
                    Notification::make()
                        ->danger()
                        ->title('භාණ්ඩය මකා දමන ලදී')
                        ->body('භාණ්ඩය සහ එහි සියලු පොරොන්දු ඉවත් කරන ලදී.')
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
            ->title('භාණ්ඩය යාවත්කාලීන විය')
            ->body('භාණ්ඩ විස්තර සාර්ථකව යාවත්කාලීන කරන ලදී.')
            ->duration(4000);
    }
}
