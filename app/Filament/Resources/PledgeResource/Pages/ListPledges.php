<?php

namespace App\Filament\Resources\PledgeResource\Pages;

use App\Filament\Resources\PledgeResource;
use App\Models\Item;
use App\Models\Pledge;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Livewire\Attributes\Url;

class ListPledges extends ListRecords
{
    protected static string $resource = PledgeResource::class;
    protected static string $view = 'filament.resources.pledge-resource.pages.list-pledges';

    #[Url(as: 'q')]  public string $mobileSearch     = '';
    #[Url(as: 's')]  public string $mobileSort        = 'newest';
    #[Url(as: 'fi')] public int    $mobileFilterItem  = 0;
    #[Url(as: 'p')]  public int    $mobilePage        = 1;

    const PER_PAGE = 6;

    public function updatedMobileSearch(): void     { $this->mobilePage = 1; }
    public function updatedMobileSort(): void       { $this->mobilePage = 1; }
    public function updatedMobileFilterItem(): void { $this->mobilePage = 1; }

    /**
     * When the page mounts (e.g. after redirect from create/edit),
     * if sort is 'newest' reset to page 1 so the just-saved record is visible.
     */
    public function mount(): void
    {
        parent::mount();

        // If coming back from create/edit with no explicit page param, go to page 1
        if (!request()->has('p')) {
            $this->mobilePage = 1;
        }
    }

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()->label('නව පොරොන්දුව')];
    }

    public function getViewData(): array
    {
        $query = Pledge::with('items');

        if (filled($this->mobileSearch)) {
            $s = '%' . $this->mobileSearch . '%';
            $query->where(fn ($q) => $q
                ->where('donor_name',    'like', $s)
                ->orWhere('donor_mobile', 'like', $s)
                ->orWhere('donor_address','like', $s)
                ->orWhereHas('items', fn ($iq) => $iq->where('name', 'like', $s))
            );
        }

        if ($this->mobileFilterItem > 0) {
            $query->whereHas('items', fn ($q) => $q->where('items.id', $this->mobileFilterItem));
        }

        $all = match ($this->mobileSort) {
            'oldest'   => $query->oldest('updated_at')->get(),
            'name'     => $query->get()->sortBy('donor_name')->values(),
            'qty_desc' => $query->get()->sortByDesc(fn ($p) => $p->items->sum('pivot.pledged_quantity'))->values(),
            'qty_asc'  => $query->get()->sortBy(fn ($p) => $p->items->sum('pivot.pledged_quantity'))->values(),
            default    => $query->latest('updated_at')->get(),  // 'newest' = most recently updated first
        };

        $total      = $all->count();
        $totalPages = max(1, (int) ceil($total / self::PER_PAGE));
        $page       = max(1, min($this->mobilePage, $totalPages));
        $pledges    = $all->slice(($page - 1) * self::PER_PAGE, self::PER_PAGE)->values();

        return array_merge(parent::getViewData(), [
            'mobilePledges'    => $pledges,
            'mobileSort'       => $this->mobileSort,
            'mobileFilterItem' => $this->mobileFilterItem,
            'allItems'         => Item::orderBy('name')->get(['id', 'name']),
            'mobileTotalCount' => $total,
            'mobileTotalPages' => $totalPages,
            'mobilePage'       => $page,
            'mobilePerPage'    => self::PER_PAGE,
        ]);
    }
}
