<?php

namespace App\Filament\Resources\CashDonationResource\Pages;

use App\Filament\Resources\CashDonationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCashDonation extends ViewRecord
{
    protected static string $resource = CashDonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('සංස්කරණය'),
        ];
    }
}
