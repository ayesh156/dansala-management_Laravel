<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use App\Models\Pledge;
use App\Models\CashDonation;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DansalaDashboard extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalItems     = Item::count();
        $totalPledges   = Pledge::count();
        $totalDonors    = Pledge::distinct('donor_name')->count('donor_name');
        $fulfilledItems = Item::withSum('pledges', 'pledged_quantity')
            ->get()
            ->filter(fn ($item) => (float) $item->pledges_sum_pledged_quantity >= (float) $item->required_quantity)
            ->count();

        return [
            Stat::make('මුළු භාණ්ඩ', $totalItems)
                ->description('ලුහුබැඳෙන භාණ්ඩ ගණන')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('info'),

            Stat::make('මුළු පොරොන්දු', $totalPledges)
                ->description('ලියාපදිංචි දායකත්ව')
                ->descriptionIcon('heroicon-m-heart')
                ->color('success'),

            Stat::make('දායකයන්', $totalDonors)
                ->description('තනි දායකයන් ගණන')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning'),

            Stat::make('සම්පූර්ණ', $fulfilledItems . ' / ' . $totalItems)
                ->description('100% සම්පූර්ණ භාණ්ඩ')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color($fulfilledItems === $totalItems && $totalItems > 0 ? 'success' : 'danger'),

            Stat::make('සල්ලි දායකත්ව', CashDonation::count())
                ->description('මුළු: රු. ' . number_format((float) CashDonation::sum('amount'), 2))
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning'),
        ];
    }
}
