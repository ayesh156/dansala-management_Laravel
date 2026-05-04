<x-filament-panels::page>

<style>
/* ── Item Cards ─────────────────────────────────────────── */
.dms-search {
    width:100%; padding:.65rem 1rem .65rem 2.6rem;
    background:#111827; border:1px solid #374151; border-radius:14px;
    color:#f9fafb; font-size:.875rem; outline:none;
    transition:border-color .2s, box-shadow .2s;
}
.dms-search::placeholder { color:#6b7280; }
.dms-search:focus { border-color:#10b981; box-shadow:0 0 0 3px rgba(16,185,129,.15); }

.dms-item-card {
    position:relative; overflow:hidden; border-radius:20px;
    border:1px solid rgba(255,255,255,.06);
    padding:1rem 1rem .85rem;
    margin-bottom:.75rem;
    backdrop-filter:blur(8px);
    transition:transform .15s, box-shadow .15s;
}
.dms-item-card:active { transform:scale(.985); }

/* status colours */
.dms-card--green  { background:linear-gradient(135deg,#052e16 0%,#0f172a 60%); }
.dms-card--amber  { background:linear-gradient(135deg,#1c1003 0%,#0f172a 60%); }
.dms-card--red    { background:linear-gradient(135deg,#1c0505 0%,#0f172a 60%); }

.dms-glow {
    position:absolute; border-radius:50%; filter:blur(40px);
    pointer-events:none; opacity:.18;
}

.dms-badge {
    display:inline-flex; align-items:center; gap:.3rem;
    font-size:.65rem; font-weight:600; letter-spacing:.04em;
    padding:.2rem .55rem; border-radius:999px;
}
.dms-badge--green { background:rgba(16,185,129,.15); color:#6ee7b7; border:1px solid rgba(16,185,129,.3); }
.dms-badge--amber { background:rgba(245,158,11,.15);  color:#fcd34d; border:1px solid rgba(245,158,11,.3); }
.dms-badge--red   { background:rgba(239,68,68,.15);   color:#fca5a5; border:1px solid rgba(239,68,68,.3); }

.dms-progress-track {
    height:5px; border-radius:999px; background:rgba(255,255,255,.08); overflow:hidden; margin:.6rem 0 .85rem;
}
.dms-progress-fill { height:100%; border-radius:999px; transition:width .7s cubic-bezier(.4,0,.2,1); }
.dms-fill--green { background:linear-gradient(90deg,#059669,#34d399); }
.dms-fill--amber { background:linear-gradient(90deg,#d97706,#fbbf24); }
.dms-fill--red   { background:linear-gradient(90deg,#dc2626,#f87171); }

.dms-stats { display:grid; grid-template-columns:repeat(3,1fr); gap:.5rem; margin-bottom:.85rem; }
.dms-stat {
    background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.06);
    border-radius:12px; padding:.5rem .25rem; text-align:center;
}
.dms-stat-label { font-size:.6rem; text-transform:uppercase; letter-spacing:.06em; color:#6b7280; margin-bottom:.2rem; }
.dms-stat-value { font-size:.9rem; font-weight:700; line-height:1.1; }
.dms-stat-unit  { font-size:.6rem; color:#4b5563; margin-top:.1rem; }

.dms-actions { display:flex; gap:.5rem; padding-top:.75rem; border-top:1px solid rgba(255,255,255,.05); }
.dms-btn {
    flex:1; display:flex; align-items:center; justify-content:center; gap:.4rem;
    padding:.55rem; border-radius:12px; font-size:.75rem; font-weight:600;
    text-decoration:none; transition:background .15s, transform .1s;
}
.dms-btn:active { transform:scale(.96); }
.dms-btn--primary { background:rgba(255,255,255,.1); color:#e5e7eb; }
.dms-btn--primary:hover { background:rgba(255,255,255,.18); }
.dms-btn--ghost  { background:rgba(255,255,255,.04); color:#9ca3af; flex:0 0 auto; padding:.55rem .9rem; }
.dms-btn--ghost:hover { background:rgba(255,255,255,.09); }

.dms-empty {
    display:flex; flex-direction:column; align-items:center;
    justify-content:center; padding:4rem 1rem; text-align:center;
}
.dms-empty-icon {
    width:3.5rem; height:3.5rem; border-radius:16px;
    background:rgba(255,255,255,.05); display:flex; align-items:center; justify-content:center;
    margin-bottom:.85rem;
}
</style>

{{-- ══════════════════════════════════════════
     MOBILE CARD VIEW  (< md)
     ══════════════════════════════════════════ --}}
<div class="block md:hidden">

    {{-- Search --}}
    <div style="position:relative;margin-bottom:1rem;">
        <svg style="position:absolute;left:.75rem;top:50%;transform:translateY(-50%);width:1rem;height:1rem;color:#6b7280;pointer-events:none;"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
        </svg>
        <input wire:model.live.debounce.300ms="mobileSearch"
               type="search" placeholder="භාණ්ඩ සොයන්න..."
               class="dms-search" />
    </div>

    @if(filled($mobileSearch))
        <p style="font-size:.75rem;color:#6b7280;margin-bottom:.75rem;">
            "{{ $mobileSearch }}" — {{ $mobileItems->count() }} ප්‍රතිඵල
        </p>
    @endif

    {{-- Cards --}}
    @forelse ($mobileItems as $item)
        @php
            $pct = $item->percentage;
            if ($pct >= 100) {
                $cardCls  = 'dms-card--green';
                $glowClr  = '#10b981';
                $fillCls  = 'dms-fill--green';
                $badgeCls = 'dms-badge--green';
                $pctClr   = '#34d399';
                $valClr   = '#34d399';
                $remClr   = '#34d399';
                $icon     = '✓';
                $label    = 'සම්පූර්ණයි';
            } elseif ($pct >= 50) {
                $cardCls  = 'dms-card--amber';
                $glowClr  = '#f59e0b';
                $fillCls  = 'dms-fill--amber';
                $badgeCls = 'dms-badge--amber';
                $pctClr   = '#fbbf24';
                $valClr   = '#fbbf24';
                $remClr   = '#fbbf24';
                $icon     = '⏳';
                $label    = 'ක්‍රියාත්මකයි';
            } else {
                $cardCls  = 'dms-card--red';
                $glowClr  = '#ef4444';
                $fillCls  = 'dms-fill--red';
                $badgeCls = 'dms-badge--red';
                $pctClr   = '#f87171';
                $valClr   = '#f87171';
                $remClr   = '#f87171';
                $icon     = '⚠';
                $label    = 'දායකත්ව අවශ්‍යයි';
            }
        @endphp

        <div class="dms-item-card {{ $cardCls }}">

            {{-- Glow orb --}}
            <div class="dms-glow" style="width:120px;height:120px;right:-30px;top:-30px;background:{{ $glowClr }};"></div>

            {{-- Header --}}
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:.4rem;">
                <div style="min-width:0;flex:1;padding-right:.5rem;">
                    <p style="font-size:1rem;font-weight:700;color:#f9fafb;line-height:1.2;
                               white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        {{ $item->name }}
                    </p>
                    <span class="dms-badge {{ $badgeCls }}" style="margin-top:.3rem;">
                        {{ $icon }} {{ $label }}
                    </span>
                </div>
                <span style="font-size:1.35rem;font-weight:800;color:{{ $pctClr }};flex-shrink:0;">
                    {{ $pct }}%
                </span>
            </div>

            {{-- Progress --}}
            <div class="dms-progress-track">
                <div class="dms-progress-fill {{ $fillCls }}" style="width:{{ $pct }}%"></div>
            </div>

            {{-- Stats --}}
            <div class="dms-stats">
                <div class="dms-stat">
                    <div class="dms-stat-label">අවශ්‍ය</div>
                    <div class="dms-stat-value" style="color:#e5e7eb;">{{ number_format($item->required_quantity,1) }}</div>
                    <div class="dms-stat-unit">{{ $item->unit }}</div>
                </div>
                <div class="dms-stat">
                    <div class="dms-stat-label">ලැබුණු</div>
                    <div class="dms-stat-value" style="color:#34d399;">{{ number_format($item->total_pledged_qty,1) }}</div>
                    <div class="dms-stat-unit">{{ $item->unit }}</div>
                </div>
                <div class="dms-stat">
                    <div class="dms-stat-label">ඉතිරි</div>
                    <div class="dms-stat-value" style="color:{{ $remClr }};">{{ number_format($item->remaining_qty,1) }}</div>
                    <div class="dms-stat-unit">{{ $item->unit }}</div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="dms-actions">
                <a href="{{ \App\Filament\Resources\ItemResource::getUrl('edit', ['record' => $item]) }}"
                   class="dms-btn dms-btn--primary">
                    <svg style="width:.9rem;height:.9rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                 m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    සංස්කරණය
                </a>
                <a href="{{ \App\Filament\Resources\ItemResource::getUrl('view', ['record' => $item]) }}"
                   class="dms-btn dms-btn--ghost">
                    <svg style="width:.9rem;height:.9rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z
                                 M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943
                                 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    බලන්න
                </a>
            </div>

        </div>
    @empty
        <div class="dms-empty">
            <div class="dms-empty-icon">
                <svg style="width:1.75rem;height:1.75rem;color:#4b5563;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                </svg>
            </div>
            <p style="font-weight:600;color:#d1d5db;">භාණ්ඩ නොමැත</p>
            <p style="font-size:.8rem;color:#6b7280;margin-top:.3rem;">
                @if(filled($mobileSearch))
                    "{{ $mobileSearch }}" සඳහා ප්‍රතිඵල නොමැත
                @else
                    ආරම්භ කිරීමට නව භාණ්ඩයක් එකතු කරන්න
                @endif
            </p>
        </div>
    @endforelse

</div>

{{-- ══════════════════════════════════════════
     DESKTOP TABLE VIEW  (≥ md)
     ══════════════════════════════════════════ --}}
<div class="hidden md:block">
    {{ $this->table }}
</div>

</x-filament-panels::page>
