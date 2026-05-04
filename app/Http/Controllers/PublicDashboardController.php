<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Pledge;
use App\Models\CashDonation;
use Illuminate\Http\Request;

class PublicDashboardController extends Controller
{
    const PER_PAGE      = 6;
    const PLEDGE_PER_PAGE = 6;
    const CASH_PER_PAGE   = 6;

    public function index(Request $request)
    {
        // ── Item section ─────────────────────────────────────
        $search = $request->get('q', '');
        $sort   = $request->get('s', 'pct_asc');
        $filter = $request->get('f', 'all');
        $page   = max(1, (int) $request->get('page', 1));

        $query = Item::query();
        if (filled($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $allFiltered = $query->get()->map(function ($item) {
            $pledged  = $item->total_pledged;
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
        $allItems      = Item::all();
        $totalItems    = $allItems->count();
        $totalPledges  = Pledge::count();
        $totalDonors   = Pledge::whereNotNull('donor_name')->distinct('donor_name')->count('donor_name');
        $fulfilledItems = $allItems->filter(fn ($i) =>
            $i->total_pledged >= (float) $i->required_quantity
        )->count();

        // ── Pledges section with pagination ──────────────────
        $pledgePage   = max(1, (int) $request->get('pp', 1));
        $pledgeTotal  = Pledge::count();
        $pledgePages  = max(1, (int) ceil($pledgeTotal / self::PLEDGE_PER_PAGE));
        $pledgePage   = min($pledgePage, $pledgePages);
        $recentPledges = Pledge::with('items')
            ->latest('updated_at')
            ->skip(($pledgePage - 1) * self::PLEDGE_PER_PAGE)
            ->take(self::PLEDGE_PER_PAGE)
            ->get();

        // ── Cash donations section ────────────────────────────
        $cashSearch = $request->get('cq', '');
        $cashSort   = $request->get('cs', 'newest');
        $cashPage   = max(1, (int) $request->get('cp', 1));

        $cashQuery = CashDonation::query();
        if (filled($cashSearch)) {
            $cashQuery->where(fn ($q) => $q
                ->where('donor_name',    'like', '%' . $cashSearch . '%')
                ->orWhere('donor_mobile','like', '%' . $cashSearch . '%')
                ->orWhere('note',        'like', '%' . $cashSearch . '%')
            );
        }

        $cashAll = match ($cashSort) {
            'oldest'      => $cashQuery->oldest()->get(),
            'name'        => $cashQuery->get()->sortBy('donor_name')->values(),
            'amount_desc' => $cashQuery->orderByDesc('amount')->get(),
            'amount_asc'  => $cashQuery->orderBy('amount')->get(),
            default       => $cashQuery->latest()->get(),
        };

        $cashTotal  = $cashAll->count();
        $cashPages  = max(1, (int) ceil($cashTotal / self::CASH_PER_PAGE));
        $cashPage   = min($cashPage, $cashPages);
        $cashDonations = $cashAll->slice(($cashPage - 1) * self::CASH_PER_PAGE, self::CASH_PER_PAGE)->values();

        $totalCash       = CashDonation::count();
        $totalCashAmount = CashDonation::sum('amount');

        return view('public.dashboard', compact(
            'items', 'totalItems', 'totalPledges',
            'totalDonors', 'fulfilledItems',
            'recentPledges', 'pledgePage', 'pledgePages', 'pledgeTotal',
            'search', 'sort', 'filter', 'page', 'totalPages', 'totalCount',
            'cashDonations', 'totalCash', 'totalCashAmount',
            'cashSearch', 'cashSort', 'cashPage', 'cashPages', 'cashTotal'
        ));
    }
}
