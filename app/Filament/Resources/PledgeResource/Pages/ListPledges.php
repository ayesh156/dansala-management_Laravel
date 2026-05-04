<?php

namespace App\Filament\Resources\PledgeResource\Pages;

use App\Filament\Resources\PledgeResource;
use App\Models\Pledge;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Livewire\Attributes\Url;

class ListPledges extends ListRecords
{
    protected static string $resource = PledgeResource::class;

    protected static string $view = 'filament.resources.pledge-resource.pages.list-pledges';

    // Live search — synced to URL query string
    #[Url(as: 'q')]
    public string $mobileSearch = '';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('නව පොරොන්දුව'),
        ];
    }

    public function getViewData(): array
    {
        $query = Pledge::with('item')->latest();

        if (filled($this->mobileSearch)) {
            $search = '%' . $this->mobileSearch . '%';
            $query->where(function ($q) use ($search) {
                $q->where('donor_name',   'like', $search)
                  ->orWhere('donor_mobile', 'like', $search)
                  ->orWhere('donor_address', 'like', $search)
                  ->orWhereHas('item', fn ($iq) => $iq->where('name', 'like', $search));
            });
        }

        return array_merge(parent::getViewData(), [
            'mobilePledges' => $query->get(),
        ]);
    }
}
