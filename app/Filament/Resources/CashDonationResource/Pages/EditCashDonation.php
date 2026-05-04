<?php

namespace App\Filament\Resources\CashDonationResource\Pages;

use App\Filament\Resources\CashDonationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCashDonation extends EditRecord
{
    protected static string $resource = CashDonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('මකන්න'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
