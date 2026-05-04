<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-heroicon-o-chart-bar class="h-5 w-5 text-primary-500" />
                <span>දායකත්ව ප්‍රගතිය</span>
            </div>
        </x-slot>
        <x-slot name="description">
            සියලු භාණ්ඩවල දායකත්ව ස්ථිතිය සහ ප්‍රගතිය.
        </x-slot>

        @php $items = $this->getItems(); @endphp

        @if ($items->isEmpty())
            <div class="flex flex-col items-center justify-center py-12 text-center">
                <x-heroicon-o-archive-box class="h-12 w-12 text-gray-400 dark:text-gray-500 mb-4" />
                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">භාණ්ඩ නොමැත.</p>
                <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">ප්‍රගතිය නිරීක්ෂණය කිරීමට භාණ්ඩ එකතු කරන්න.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($items as $item)
                    @php
                        $pct = $item->percentage;
                        if ($pct >= 100) {
                            $barColor    = 'bg-green-500';
                            $badgeColor  = 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300';
                            $cardBorder  = 'border-green-500/30';
                            $iconColor   = 'text-green-500';
                            $statusLabel = '✓ සම්පූර්ණයි';
                            $statusIcon  = 'heroicon-s-check-circle';
                        } elseif ($pct >= 50) {
                            $barColor    = 'bg-amber-500';
                            $badgeColor  = 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300';
                            $cardBorder  = 'border-amber-500/30';
                            $iconColor   = 'text-amber-500';
                            $statusLabel = '⏳ ක්‍රියාත්මකයි';
                            $statusIcon  = 'heroicon-s-clock';
                        } else {
                            $barColor    = 'bg-red-500';
                            $badgeColor  = 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-300';
                            $cardBorder  = 'border-red-500/30';
                            $iconColor   = 'text-red-500';
                            $statusLabel = '⚠ දායකත්ව අවශ්‍යයි';
                            $statusIcon  = 'heroicon-s-exclamation-circle';
                        }
                    @endphp

                    <div class="relative rounded-xl border {{ $cardBorder }} bg-white dark:bg-gray-800 p-5 shadow-sm hover:shadow-md transition-shadow duration-200">

                        {{-- Header --}}
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-semibold text-gray-900 dark:text-white truncate">
                                    {{ $item->name }}
                                </h3>
                                <span class="inline-flex items-center mt-1 rounded-full px-2 py-0.5 text-xs font-medium {{ $badgeColor }}">
                                    @svg($statusIcon, 'h-3 w-3 mr-1 inline')
                                    {{ $statusLabel }}
                                </span>
                            </div>
                            <div class="ml-3 flex-shrink-0">
                                <span class="text-2xl font-bold {{ $iconColor }}">{{ $pct }}%</span>
                            </div>
                        </div>

                        {{-- Progress Bar --}}
                        <div class="mb-4">
                            <div class="h-2.5 w-full rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden">
                                <div
                                    class="h-2.5 rounded-full {{ $barColor }} transition-all duration-500"
                                    style="width: {{ $pct }}%"
                                ></div>
                            </div>
                        </div>

                        {{-- Stats Grid --}}
                        <div class="grid grid-cols-3 gap-2 text-center">
                            <div class="rounded-lg bg-gray-50 dark:bg-gray-700/50 p-2">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-0.5">අවශ්‍ය</p>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ number_format($item->required_quantity, 2) }}
                                </p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">{{ $item->unit }}</p>
                            </div>
                            <div class="rounded-lg bg-gray-50 dark:bg-gray-700/50 p-2">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-0.5">ලැබුණු</p>
                                <p class="text-sm font-semibold text-green-600 dark:text-green-400">
                                    {{ number_format($item->total_pledged_qty, 2) }}
                                </p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">{{ $item->unit }}</p>
                            </div>
                            <div class="rounded-lg bg-gray-50 dark:bg-gray-700/50 p-2">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-0.5">ඉතිරි</p>
                                <p class="text-sm font-semibold {{ $item->remaining_qty <= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                    {{ number_format($item->remaining_qty, 2) }}
                                </p>
                                <p class="text-xs text-gray-400 dark:text-gray-500">{{ $item->unit }}</p>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Legend --}}
            <div class="mt-6 flex flex-wrap items-center gap-4 text-xs text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 pt-4">
                <span class="font-medium text-gray-600 dark:text-gray-300">සංකේත:</span>
                <span class="flex items-center gap-1.5">
                    <span class="inline-block h-2.5 w-5 rounded-full bg-green-500"></span> සම්පූර්ණ (≥ 100%)
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="inline-block h-2.5 w-5 rounded-full bg-amber-500"></span> ක්‍රියාත්මක (50–99%)
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="inline-block h-2.5 w-5 rounded-full bg-red-500"></span> දායකත්ව අවශ්‍යයි (&lt; 50%)
                </span>
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
