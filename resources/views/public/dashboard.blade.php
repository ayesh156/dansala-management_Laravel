<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dansala – Donation Progress</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'system-ui', 'sans-serif'] }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .progress-bar { transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-gray-950 text-gray-100 min-h-screen">

    {{-- Header --}}
    <header class="bg-gray-900 border-b border-gray-800 sticky top-0 z-10">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <div>
                <h1 class="text-lg font-bold text-emerald-400 leading-tight">🕌 Dansala</h1>
                <p class="text-xs text-gray-400">Donation Progress Tracker</p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-500">Last updated</p>
                <p class="text-xs font-medium text-gray-300">{{ now()->format('d M Y, h:i A') }}</p>
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-6 space-y-6">

        {{-- Summary Stats --}}
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
            <div class="bg-gray-900 rounded-xl p-4 border border-gray-800 text-center">
                <p class="text-2xl font-bold text-emerald-400">{{ $totalItems }}</p>
                <p class="text-xs text-gray-400 mt-1">Total Items</p>
            </div>
            <div class="bg-gray-900 rounded-xl p-4 border border-gray-800 text-center">
                <p class="text-2xl font-bold text-sky-400">{{ $totalPledges }}</p>
                <p class="text-xs text-gray-400 mt-1">Total Pledges</p>
            </div>
            <div class="bg-gray-900 rounded-xl p-4 border border-gray-800 text-center">
                <p class="text-2xl font-bold text-amber-400">{{ $totalDonors }}</p>
                <p class="text-xs text-gray-400 mt-1">Donors</p>
            </div>
            <div class="bg-gray-900 rounded-xl p-4 border border-gray-800 text-center">
                <p class="text-2xl font-bold {{ $fulfilledItems === $totalItems && $totalItems > 0 ? 'text-emerald-400' : 'text-rose-400' }}">
                    {{ $fulfilledItems }}/{{ $totalItems }}
                </p>
                <p class="text-xs text-gray-400 mt-1">Fulfilled</p>
            </div>
        </div>

        {{-- Section Title --}}
        <div class="flex items-center gap-2">
            <div class="h-px flex-1 bg-gray-800"></div>
            <span class="text-xs font-semibold text-gray-500 uppercase tracking-widest">Item Progress</span>
            <div class="h-px flex-1 bg-gray-800"></div>
        </div>

        {{-- Item Cards --}}
        @if ($items->isEmpty())
            <div class="text-center py-16 text-gray-500">
                <p class="text-4xl mb-3">📦</p>
                <p class="font-medium">No items found.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                @foreach ($items as $item)
                    @php
                        $pct = $item->percentage;
                        if ($pct >= 100) {
                            $bar    = 'bg-emerald-500';
                            $text   = 'text-emerald-400';
                            $badge  = 'bg-emerald-900/50 text-emerald-300 border border-emerald-700/50';
                            $label  = '✓ Fulfilled';
                            $card   = 'border-emerald-800/40';
                        } elseif ($pct >= 50) {
                            $bar    = 'bg-amber-500';
                            $text   = 'text-amber-400';
                            $badge  = 'bg-amber-900/50 text-amber-300 border border-amber-700/50';
                            $label  = '⏳ In Progress';
                            $card   = 'border-amber-800/40';
                        } else {
                            $bar    = 'bg-rose-500';
                            $text   = 'text-rose-400';
                            $badge  = 'bg-rose-900/50 text-rose-300 border border-rose-700/50';
                            $label  = '⚠ Needs Donations';
                            $card   = 'border-rose-800/40';
                        }
                    @endphp

                    <div class="bg-gray-900 rounded-xl border {{ $card }} p-5">
                        {{-- Card Header --}}
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="font-semibold text-white text-base">{{ $item->name }}</h3>
                                <span class="inline-block mt-1 text-xs px-2 py-0.5 rounded-full {{ $badge }}">
                                    {{ $label }}
                                </span>
                            </div>
                            <span class="text-2xl font-bold {{ $text }}">{{ $pct }}%</span>
                        </div>

                        {{-- Progress Bar --}}
                        <div class="h-2 w-full bg-gray-800 rounded-full overflow-hidden mb-4">
                            <div class="h-2 rounded-full progress-bar {{ $bar }}" style="width: {{ $pct }}%"></div>
                        </div>

                        {{-- Stats --}}
                        <div class="grid grid-cols-3 gap-2 text-center">
                            <div class="bg-gray-800/60 rounded-lg py-2 px-1">
                                <p class="text-xs text-gray-500 mb-0.5">Required</p>
                                <p class="text-sm font-semibold text-gray-200">{{ number_format($item->required_quantity, 2) }}</p>
                                <p class="text-xs text-gray-600">{{ $item->unit }}</p>
                            </div>
                            <div class="bg-gray-800/60 rounded-lg py-2 px-1">
                                <p class="text-xs text-gray-500 mb-0.5">Received</p>
                                <p class="text-sm font-semibold text-emerald-400">{{ number_format($item->total_pledged_qty, 2) }}</p>
                                <p class="text-xs text-gray-600">{{ $item->unit }}</p>
                            </div>
                            <div class="bg-gray-800/60 rounded-lg py-2 px-1">
                                <p class="text-xs text-gray-500 mb-0.5">Remaining</p>
                                <p class="text-sm font-semibold {{ $item->remaining_qty <= 0 ? 'text-emerald-400' : 'text-rose-400' }}">
                                    {{ number_format($item->remaining_qty, 2) }}
                                </p>
                                <p class="text-xs text-gray-600">{{ $item->unit }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Pledges Table --}}
        <div class="flex items-center gap-2 pt-2">
            <div class="h-px flex-1 bg-gray-800"></div>
            <span class="text-xs font-semibold text-gray-500 uppercase tracking-widest">Recent Pledges</span>
            <div class="h-px flex-1 bg-gray-800"></div>
        </div>

        <div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-800 text-left">
                            <th class="px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Donor</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Item</th>
                            <th class="px-4 py-3 text-xs font-semibold text-gray-400 uppercase tracking-wide text-right">Qty</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse ($recentPledges as $pledge)
                            <tr class="hover:bg-gray-800/40 transition-colors">
                                <td class="px-4 py-3 font-medium text-gray-200">{{ $pledge->donor_name }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-block bg-sky-900/50 text-sky-300 border border-sky-700/40 text-xs px-2 py-0.5 rounded-full">
                                        {{ optional($pledge->item)->name ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right font-semibold text-emerald-400">
                                    {{ number_format($pledge->pledged_quantity, 2) }}
                                    <span class="text-xs text-gray-500">{{ optional($pledge->item)->unit }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-8 text-center text-gray-500">No pledges yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Legend --}}
        <div class="flex flex-wrap gap-4 text-xs text-gray-500 pb-6">
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-emerald-500 inline-block"></span> Fulfilled (≥100%)</span>
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-amber-500 inline-block"></span> In Progress (50–99%)</span>
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-rose-500 inline-block"></span> Needs Donations (&lt;50%)</span>
        </div>

    </main>
</body>
</html>
