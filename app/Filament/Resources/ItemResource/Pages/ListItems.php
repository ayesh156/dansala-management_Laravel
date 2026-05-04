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

    #[Url(as: 'q')]  public string $mobileSearch = '';
    #[Url(as: 's')]  public string $mobileSort   = 'pct_asc';
    #[Url(as: 'f')]  public string $mobileFilter  = 'all';
    #[Url(as: 'p')]  public int    $mobilePage    = 1;

    const PER_PAGE = 6;

    // Reset page when search/sort/filter changes
    public function updatedMobileSearch(): void { $this->mobilePage = 1; }
    public function updatedMobileSort(): void   { $this->mobilePage = 1; }
    public function updatedMobileFilter(): void { $this->mobilePage = 1; }

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()->label('නව භාණ්ඩය')];
    }

    public function getViewData(): array
    {
        $query = Item::withSum('pledges', 'pledged_quantity');

        if (filled($this->mobileSearch)) {
            $s = '%' . $this->mobileSearch . '%';
            $query->where(fn ($q) => $q->where('name', 'like', $s)->orWhere('unit', 'like', $s));
        }

        $all = $query->get()->map(function ($item) {
            $pledged  = (float) ($item->pledges_sum_pledged_quantity ?? 0);
            $required = (float) $item->required_quantity;
            $item->total_pledged_qty = $pledged;
            $item->remaining_qty     = max(0, $required - $pledged);
            $item->percentage        = $required > 0 ? min(100, round(($pledged / $required) * 100, 1)) : 0;
            return $item;
        });

        if ($this->mobileFilter !== 'all') {
            $all = $all->filter(fn ($i) => match ($this->mobileFilter) {
                'red'   => $i->percentage < 50,
                'amber' => $i->percentage >= 50 && $i->percentage < 100,
                'green' => $i->percentage >= 100,
                default => true,
            });
        }

        $all = match ($this->mobileSort) {
            'pct_desc' => $all->sortByDesc('percentage')->values(),
            'newest'   => $all->sortByDesc('created_at')->values(),
            'name'     => $all->sortBy('name')->values(),
            default    => $all->sortBy('percentage')->values(),
        };

        $total      = $all->count();
        $totalPages = max(1, (int) ceil($total / self::PER_PAGE));
        $page       = max(1, min($this->mobilePage, $totalPages));
        $items      = $all->slice(($page - 1) * self::PER_PAGE, self::PER_PAGE)->values();

        return array_merge(parent::getViewData(), [
            'mobileItems'      => $items,
            'mobileSort'       => $this->mobileSort,
            'mobileFilter'     => $this->mobileFilter,
            'mobileTotalCount' => $total,
            'mobileTotalPages' => $totalPages,
            'mobilePage'       => $page,
            'mobilePerPage'    => self::PER_PAGE,
        ]);
    }
}
