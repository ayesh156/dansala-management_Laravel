<?php

namespace App\Filament\Resources\CashDonationResource\Pages;

use App\Filament\Resources\CashDonationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCashDonation extends CreateRecord
{
    protected static string $resource = CashDonationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
