<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Pledge;

class PublicDashboardController extends Controller
{
    public function index()
    {
        $items = Item::withSum('pledges', 'pledged_quantity')
            ->orderBy('name')
            ->get()
            ->map(function ($item) {
                $totalPledged = (float) ($item->pledges_sum_pledged_quantity ?? 0);
                $required     = (float) $item->required_quantity;

                $item->total_pledged_qty = $totalPledged;
                $item->remaining_qty     = max(0, $required - $totalPledged);
                $item->percentage        = $required > 0
                    ? min(100, round(($totalPledged / $required) * 100, 1))
                    : 0;

                return $item;
            });

        $totalItems    = $items->count();
        $totalPledges  = Pledge::count();
        $totalDonors   = Pledge::whereNotNull('donor_name')
                            ->distinct('donor_name')
                            ->count('donor_name');
        $fulfilledItems = $items->filter(fn ($i) => $i->percentage >= 100)->count();

        $recentPledges = Pledge::with('item')
            ->latest()
            ->limit(20)
            ->get();

        return view('public.dashboard', compact(
            'items',
            'totalItems',
            'totalPledges',
            'totalDonors',
            'fulfilledItems',
            'recentPledges'
        ));
    }
}
