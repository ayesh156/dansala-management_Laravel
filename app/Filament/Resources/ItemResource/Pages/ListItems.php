<?php

namespace App\Filament\Resources\ItemResource\Pages;

use App\Filament\Resources\ItemResource;
use App\Models\Item;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Livewire\Attributes\Url;

class ListItems extends ListRecords
{
    protected static string $resource = ItemResource::class;

    protected static string $view = 'filament.resources.item-resource.pages.list-items';

    // Live search — synced to URL query string
    #[Url(as: 'q')]
    public string $mobileSearch = '';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('නව භාණ්ඩය'),
        ];
    }

    public function getViewData(): array
    {
        $query = Item::withSum('pledges', 'pledged_quantity')
            ->orderBy('name');

        if (filled($this->mobileSearch)) {
            $search = '%' . $this->mobileSearch . '%';
            $query->where('name', 'like', $search)
                  ->orWhere('unit', 'like', $search);
        }

        $items = $query->get()->map(function ($item) {
            $totalPledged = (float) ($item->pledges_sum_pledged_quantity ?? 0);
            $required     = (float) $item->required_quantity;

            $item->total_pledged_qty = $totalPledged;
            $item->remaining_qty     = max(0, $required - $totalPledged);
            $item->percentage        = $required > 0
                ? min(100, round(($totalPledged / $required) * 100, 1))
                : 0;

            return $item;
        });

        return array_merge(parent::getViewData(), [
            'mobileItems' => $items,
        ]);
    }
}
