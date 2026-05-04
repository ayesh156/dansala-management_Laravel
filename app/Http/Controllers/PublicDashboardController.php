<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Pledge;
use App\Models\CashDonation;
use Illuminate\Http\Request;

class PublicDashboardController extends Controller
{
    const PER_PAGE = 6;

    public function index(Request $request)
    {
        // ── Item section params ──────────────────────────────
        $search = $request->get('q', '');
        $sort   = $request->get('s', 'pct_asc');
        $filter = $request->get('f', 'all');
        $page   = max(1, (int) $request->get('page', 1));

        $query = Item::withSum('pledges', 'pledged_quantity');
        if (filled($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $allFiltered = $query->get()->map(function ($item) {
            $pledged  = (float) ($item->pledges_sum_pledged_quantity ?? 0);
            $required = (float) $item->required_quantity;
            $item->total_pledged_qty = $pledged;
            $item->remaining_qty     = max(0, $required - $pledged);
            $item->percentage        = $required > 0 ? min(100, round(($pledged / $required) * 100, 1)) : 0;
            return $item;
        });

        if ($filter !== 'all') {
            $allFiltered = $allFiltered->filter(fn ($i) => match ($filter) {
                'red'   => $i->percentage < 50,
                'amber' => $i->percentage >= 50 && $i->percentage < 100,
                'green' => $i->percentage >= 100,
                default => true,
            });
        }

        $allFiltered = match ($sort) {
            'pct_desc' => $allFiltered->sortByDesc('percentage')->values(),
            'name'     => $allFiltered->sortBy('name')->values(),
            default    => $allFiltered->sortBy('percentage')->values(),
        };

        $totalCount = $allFiltered->count();
        $totalPages = max(1, (int) ceil($totalCount / self::PER_PAGE));
        $page       = min($page, $totalPages);
        $items      = $allFiltered->slice(($page - 1) * self::PER_PAGE, self::PER_PAGE)->values();

        // ── Stats ────────────────────────────────────────────
        $allItems      = Item::withSum('pledges', 'pledged_quantity')->get();
        $totalItems    = $allItems->count();
        $totalPledges  = Pledge::count();
        $totalDonors   = Pledge::whereNotNull('donor_name')->distinct('donor_name')->count('donor_name');
        $fulfilledItems = $allItems->filter(fn ($i) =>
            (float) ($i->pledges_sum_pledged_quantity ?? 0) >= (float) $i->required_quantity
        )->count();

        $recentPledges = Pledge::with('item')->latest()->limit(20)->get();

        // ── Cash donations section params ────────────────────
        $cashSearch = $request->get('cq', '');
        $cashSort   = $request->get('cs', 'newest');

        $cashQuery = CashDonation::query();
        if (filled($cashSearch)) {
            $cashQuery->where(function ($q) use ($cashSearch) {
                $q->where('donor_name',   'like', '%' . $cashSearch . '%')
                  ->orWhere('donor_mobile','like', '%' . $cashSearch . '%')
                  ->orWhere('note',        'like', '%' . $cashSearch . '%');
            });
        }

        $cashDonations = match ($cashSort) {
            'oldest'     => $cashQuery->oldest()->get(),
            'name'       => $cashQuery->get()->sortBy('donor_name')->values(),
            'amount_desc'=> $cashQuery->orderByDesc('amount')->get(),
            'amount_asc' => $cashQuery->orderBy('amount')->get(),
            default      => $cashQuery->latest()->get(),
        };

        $totalCash       = CashDonation::count();
        $totalCashAmount = CashDonation::sum('amount');

        return view('public.dashboard', compact(
            'items', 'totalItems', 'totalPledges',
            'totalDonors', 'fulfilledItems', 'recentPledges',
            'search', 'sort', 'filter',
            'page', 'totalPages', 'totalCount',
            'cashDonations', 'totalCash', 'totalCashAmount',
            'cashSearch', 'cashSort'
        ));
    }
}
