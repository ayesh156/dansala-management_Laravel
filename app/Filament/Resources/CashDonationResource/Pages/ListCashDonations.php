<?php

namespace App\Filament\Resources\CashDonationResource\Pages;

use App\Filament\Resources\CashDonationResource;
use App\Models\CashDonation;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Livewire\Attributes\Url;

class ListCashDonations extends ListRecords
{
    protected static string $resource = CashDonationResource::class;

    protected static string $view = 'filament.resources.cash-donation-resource.pages.list-cash-donations';

    #[Url(as: 'q')]  public string $mobileSearch    = '';
    #[Url(as: 's')]  public string $mobileSort       = 'newest';
    #[Url(as: 'f')]  public string $mobileFilter     = 'all'; // all | with_amount | no_amount
    #[Url(as: 'p')]  public int    $mobilePage       = 1;

    const PER_PAGE = 6;

    public function updatedMobileSearch(): void  { $this->mobilePage = 1; }
    public function updatedMobileSort(): void    { $this->mobilePage = 1; }
    public function updatedMobileFilter(): void  { $this->mobilePage = 1; }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('නව සල්ලි දායකත්වය'),
        ];
    }

    public function getViewData(): array
    {
        $query = CashDonation::query();

        if (filled($this->mobileSearch)) {
            $s = '%' . $this->mobileSearch . '%';
            $query->where(fn ($q) => $q
                ->where('donor_name',    'like', $s)
                ->orWhere('donor_mobile','like', $s)
                ->orWhere('donor_address','like', $s)
                ->orWhere('note',        'like', $s)
            );
        }

        if ($this->mobileFilter === 'with_amount') {
            $query->whereNotNull('amount')->where('amount', '>', 0);
        } elseif ($this->mobileFilter === 'no_amount') {
            $query->where(fn ($q) => $q->whereNull('amount')->orWhere('amount', 0));
        }

        $all = match ($this->mobileSort) {
            'oldest'      => $query->oldest()->get(),
            'name'        => $query->get()->sortBy('donor_name')->values(),
            'amount_desc' => $query->orderByDesc('amount')->get(),
            'amount_asc'  => $query->orderBy('amount')->get(),
            default       => $query->latest()->get(),
        };

        $total      = $all->count();
        $totalPages = max(1, (int) ceil($total / self::PER_PAGE));
        $page       = max(1, min($this->mobilePage, $totalPages));
        $donations  = $all->slice(($page - 1) * self::PER_PAGE, self::PER_PAGE)->values();

        return array_merge(parent::getViewData(), [
            'mobileDonations'  => $donations,
            'mobileSort'       => $this->mobileSort,
            'mobileFilter'     => $this->mobileFilter,
            'mobileTotalCount' => $total,
            'mobileTotalPages' => $totalPages,
            'mobilePage'       => $page,
            'mobileTotalAmount'=> CashDonation::sum('amount'),
        ]);
    }
}
