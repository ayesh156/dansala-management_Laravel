<x-filament-panels::page>

<style>
/* ── Controls ───────────────────────────────────────────── */
.dmc-search {
    width:100%; padding:.65rem 1rem .65rem 2.6rem;
    background:#111827; border:1px solid #374151; border-radius:14px;
    color:#f9fafb; font-size:.875rem; outline:none;
    transition:border-color .2s, box-shadow .2s;
}
html:not(.dark) .dmc-search { background:#f9fafb; border:1px solid #d1d5db; color:#111827; }
.dmc-search::placeholder { color:#6b7280; }
.dmc-search:focus { border-color:#f97316; box-shadow:0 0 0 3px rgba(249,115,22,.15); }

.dmc-controls { display:flex; gap:.5rem; margin-bottom:.75rem; flex-wrap:wrap; align-items:center; }
.dmc-chip {
    display:inline-flex; align-items:center; gap:.3rem;
    padding:.35rem .75rem; border-radius:999px; font-size:.72rem; font-weight:600;
    border:1px solid rgba(255,255,255,.1); background:rgba(255,255,255,.05);
    color:#9ca3af; cursor:pointer; transition:all .15s; white-space:nowrap;
    -webkit-tap-highlight-color:transparent;
}
html:not(.dark) .dmc-chip { background:rgba(0,0,0,.04); border:1px solid rgba(0,0,0,.1); color:#374151; }
.dmc-chip:hover  { background:rgba(255,255,255,.1); color:#e5e7eb; }
html:not(.dark) .dmc-chip:hover { background:rgba(0,0,0,.08); color:#111827; }
.dmc-chip.active { background:rgba(249,115,22,.15); border-color:rgba(249,115,22,.4); color:#fb923c; }
html:not(.dark) .dmc-chip.active { color:#ea580c; }
.dmc-chip.active-green { background:rgba(16,185,129,.15); border-color:rgba(16,185,129,.4); color:#6ee7b7; }
html:not(.dark) .dmc-chip.active-green { color:#059669; }
.dmc-chip.active-gray  { background:rgba(107,114,128,.15); border-color:rgba(107,114,128,.4); color:#d1d5db; }
html:not(.dark) .dmc-chip.active-gray { color:#6b7280; }

.dmc-divider-v { width:1px; background:rgba(255,255,255,.08); margin:0 .15rem; align-self:stretch; }
html:not(.dark) .dmc-divider-v { background:rgba(0,0,0,.1); }

/* ── Cash Cards ─────────────────────────────────────────── */
.dmc-card {
    position:relative; overflow:hidden; border-radius:20px;
    border:1px solid rgba(255,255,255,.07);
    border-left:3px solid rgba(249,115,22,.5);
    background:linear-gradient(135deg,#1a0a00 0%,#0f172a 70%);
    margin-bottom:.75rem; transition:transform .15s;
}
html:not(.dark) .dmc-card {
    background:linear-gradient(135deg,#fff7ed,#fffbf5);
    border-color:rgba(0,0,0,.08);
    border-left-color:rgba(249,115,22,.6);
}
.dmc-card:active { transform:scale(.985); }
.dmc-card-inner { position:relative; padding:1rem 1rem .85rem; }

.dmc-glow { position:absolute; border-radius:50%; filter:blur(50px); pointer-events:none;
            opacity:.12; width:130px; height:130px; right:-30px; top:-30px; background:#f97316; }
html:not(.dark) .dmc-glow { opacity:.05; }

.dmc-name  { font-size:1rem; font-weight:700; color:#f9fafb; line-height:1.2; }
html:not(.dark) .dmc-name { color:#111827; }
.dmc-phone { font-size:.72rem; color:#9ca3af; display:flex; align-items:center; gap:.3rem; margin-top:.2rem; }
html:not(.dark) .dmc-phone { color:#6b7280; }
.dmc-address { font-size:.7rem; color:#6b7280; display:flex; align-items:flex-start; gap:.35rem; margin-top:.2rem; line-height:1.4; }
.dmc-note { font-size:.7rem; color:#9ca3af; font-style:italic;
            background:rgba(255,255,255,.04); border-radius:8px;
            padding:.3rem .6rem; margin-top:.4rem; }
html:not(.dark) .dmc-note { background:rgba(0,0,0,.04); color:#6b7280; }
.dmc-date { font-size:.62rem; color:#4b5563; margin-top:.35rem; }
html:not(.dark) .dmc-date { color:#9ca3af; }

.dmc-amount-big { font-size:1.25rem; font-weight:800; color:#fb923c; line-height:1.1; }
.dmc-no-amount  { font-size:.72rem; color:#6b7280; background:rgba(255,255,255,.05);
                  padding:.2rem .5rem; border-radius:999px; border:1px solid rgba(255,255,255,.08); }
html:not(.dark) .dmc-no-amount { background:rgba(0,0,0,.05); border-color:rgba(0,0,0,.1); }

.dmc-divider { height:1px; background:rgba(255,255,255,.05); margin:.65rem 0; }
html:not(.dark) .dmc-divider { background:rgba(0,0,0,.07); }

.dmc-actions { display:flex; gap:.5rem; }
.dmc-btn { flex:1; display:flex; align-items:center; justify-content:center; gap:.4rem;
           padding:.55rem; border-radius:12px; font-size:.75rem; font-weight:600;
           text-decoration:none; transition:background .15s, transform .1s; }
.dmc-btn:active { transform:scale(.96); }
.dmc-btn--edit { background:rgba(255,255,255,.1); color:#e5e7eb; }
.dmc-btn--edit:hover { background:rgba(255,255,255,.18); }
html:not(.dark) .dmc-btn--edit { background:rgba(0,0,0,.06); color:#374151; }
.dmc-btn--view { background:rgba(255,255,255,.04); color:#9ca3af; flex:0 0 auto; padding:.55rem .9rem; }
.dmc-btn--view:hover { background:rgba(255,255,255,.09); }
html:not(.dark) .dmc-btn--view { background:rgba(0,0,0,.03); color:#6b7280; }

/* ── Total bar ──────────────────────────────────────────── */
.dmc-total {
    background:rgba(249,115,22,.08); border:1px solid rgba(249,115,22,.2);
    border-radius:14px; padding:.75rem 1rem;
    display:flex; align-items:center; justify-content:space-between;
    margin-bottom:.75rem;
}
html:not(.dark) .dmc-total { background:rgba(249,115,22,.06); }

.dmc-empty { display:flex; flex-direction:column; align-items:center; justify-content:center; padding:4rem 1rem; text-align:center; }
.dmc-empty-icon { width:3.5rem; height:3.5rem; border-radius:16px; background:rgba(255,255,255,.05); display:flex; align-items:center; justify-content:center; margin-bottom:.85rem; }
html:not(.dark) .dmc-empty-icon { background:rgba(0,0,0,.04); }
</style>

{{-- ══════════════════════════════════════════
     MOBILE CARD VIEW  (< md)
     ══════════════════════════════════════════ --}}
<div class="block md:hidden">

    {{-- Search --}}
    <div style="position:relative;margin-bottom:.75rem;">
        <svg style="position:absolute;left:.75rem;top:50%;transform:translateY(-50%);width:1rem;height:1rem;color:#6b7280;pointer-events:none;"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
        </svg>
        <input wire:model.live.debounce.300ms="mobileSearch"
               type="search" placeholder="නම, දුරකථනය, සටහන සොයන්න..."
               class="dmc-search" />
    </div>

    {{-- Sort + Filter --}}
    <div class="dmc-controls">
        <button wire:click="$set('mobileSort','newest')"      class="dmc-chip {{ $mobileSort==='newest'      ? 'active':'' }}">🕐 අලුත්</button>
        <button wire:click="$set('mobileSort','oldest')"      class="dmc-chip {{ $mobileSort==='oldest'      ? 'active':'' }}">🕰 පැරණි</button>
        <button wire:click="$set('mobileSort','name')"        class="dmc-chip {{ $mobileSort==='name'        ? 'active':'' }}">A-Z නම</button>
        <button wire:click="$set('mobileSort','amount_desc')" class="dmc-chip {{ $mobileSort==='amount_desc' ? 'active':'' }}">↓ මුදල</button>
        <button wire:click="$set('mobileSort','amount_asc')"  class="dmc-chip {{ $mobileSort==='amount_asc'  ? 'active':'' }}">↑ මුදල</button>

        <div class="dmc-divider-v"></div>

        <button wire:click="$set('mobileFilter','all')"         class="dmc-chip {{ $mobileFilter==='all'         ? 'active':'' }}">සියල්ල</button>
        <button wire:click="$set('mobileFilter','with_amount')" class="dmc-chip {{ $mobileFilter==='with_amount' ? 'active-green':'' }}">💰 මුදල සහිත</button>
        <button wire:click="$set('mobileFilter','no_amount')"   class="dmc-chip {{ $mobileFilter==='no_amount'   ? 'active-gray':'' }}">— මුදල නැත</button>
    </div>

    {{-- Count + total --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem;">
        <p style="font-size:.72rem;color:#6b7280;">
            {{ $mobileTotalCount }} දායකයන්
            @if(filled($mobileSearch)) · "{{ $mobileSearch }}" @endif
        </p>
        @if($mobileTotalAmount > 0)
        <p style="font-size:.72rem;font-weight:700;color:#fb923c;">
            රු. {{ number_format($mobileTotalAmount, 2) }}
        </p>
        @endif
    </div>

    {{-- Cards --}}
    @forelse($mobileDonations as $cd)
        <div class="dmc-card">
            <div class="dmc-glow"></div>
            <div class="dmc-card-inner">

                {{-- Name + Amount --}}
                <div style="display:flex;align-items:flex-start;justify-content:space-between;">
                    <div style="min-width:0;flex:1;padding-right:.5rem;">
                        <p class="dmc-name">{{ $cd->donor_name }}</p>
                        @if($cd->donor_mobile)
                            <p class="dmc-phone">
                                <svg style="width:.7rem;height:.7rem;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ $cd->donor_mobile }}
                            </p>
                        @endif
                    </div>
                    <div style="text-align:right;flex-shrink:0;">
                        @if($cd->amount)
                            <div class="dmc-amount-big">රු.{{ number_format($cd->amount, 2) }}</div>
                        @else
                            <div class="dmc-no-amount">මුදල නැත</div>
                        @endif
                    </div>
                </div>

                @if($cd->donor_address)
                    <p class="dmc-address">
                        <svg style="width:.7rem;height:.7rem;flex-shrink:0;margin-top:.1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $cd->donor_address }}
                    </p>
                @endif

                @if($cd->note)
                    <p class="dmc-note">"{{ $cd->note }}"</p>
                @endif

                <p class="dmc-date">{{ $cd->created_at->format('d M Y, h:i A') }}</p>

                <div class="dmc-divider"></div>

                <div class="dmc-actions">
                    <a href="{{ \App\Filament\Resources\CashDonationResource::getUrl('edit', ['record' => $cd]) }}"
                       class="dmc-btn dmc-btn--edit">
                        <svg style="width:.85rem;height:.85rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        සංස්කරණය
                    </a>
                    <a href="{{ \App\Filament\Resources\CashDonationResource::getUrl('view', ['record' => $cd]) }}"
                       class="dmc-btn dmc-btn--view">
                        <svg style="width:.85rem;height:.85rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        බලන්න
                    </a>
                </div>

            </div>
        </div>
    @empty
        <div class="dmc-empty">
            <div class="dmc-empty-icon">
                <svg style="width:1.75rem;height:1.75rem;color:#4b5563;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <p style="font-weight:600;color:#d1d5db;">සල්ලි දායකත්ව නොමැත</p>
            <p style="font-size:.8rem;color:#6b7280;margin-top:.3rem;">
                @if(filled($mobileSearch)) "{{ $mobileSearch }}" සඳහා ප්‍රතිඵල නොමැත
                @elseif($mobileFilter !== 'all') මෙම filter ට ගැළපෙන ඒවා නොමැත
                @else ආරම්භ කිරීමට නව සල්ලි දායකත්වයක් එකතු කරන්න @endif
            </p>
        </div>
    @endforelse

    {{-- Pagination --}}
    @if($mobileTotalPages > 1)
    <div style="display:flex;align-items:center;justify-content:center;gap:.4rem;margin:1rem 0 .5rem;flex-wrap:wrap;">
        <button wire:click="$set('mobilePage', {{ max(1, $mobilePage-1) }})"
                @if($mobilePage<=1) disabled @endif
                style="display:flex;align-items:center;justify-content:center;width:2.1rem;height:2.1rem;border-radius:50%;
                       background:{{ $mobilePage<=1 ? 'rgba(255,255,255,.04)':'rgba(255,255,255,.08)' }};
                       border:1px solid {{ $mobilePage<=1 ? 'rgba(255,255,255,.06)':'rgba(255,255,255,.15)' }};
                       color:{{ $mobilePage<=1 ? '#4b5563':'#e5e7eb' }};
                       cursor:{{ $mobilePage<=1 ? 'not-allowed':'pointer' }};font-size:.8rem;">‹</button>

        @php $pStart=max(1,$mobilePage-2); $pEnd=min($mobileTotalPages,$mobilePage+2); @endphp

        @if($pStart>1)
            <button wire:click="$set('mobilePage',1)"
                    style="min-width:2.1rem;height:2.1rem;border-radius:10px;padding:0 .5rem;
                           background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
                           color:#9ca3af;font-size:.75rem;font-weight:600;cursor:pointer;">1</button>
            @if($pStart>2)<span style="color:#4b5563;font-size:.75rem;">…</span>@endif
        @endif

        @for($i=$pStart;$i<=$pEnd;$i++)
            <button wire:click="$set('mobilePage',{{ $i }})"
                    style="min-width:2.1rem;height:2.1rem;border-radius:10px;padding:0 .5rem;
                           background:{{ $i===$mobilePage ? 'rgba(249,115,22,.2)':'rgba(255,255,255,.05)' }};
                           border:1px solid {{ $i===$mobilePage ? 'rgba(249,115,22,.5)':'rgba(255,255,255,.1)' }};
                           color:{{ $i===$mobilePage ? '#fb923c':'#9ca3af' }};
                           font-size:.75rem;font-weight:{{ $i===$mobilePage ? '700':'600' }};cursor:pointer;">{{ $i }}</button>
        @endfor

        @if($pEnd<$mobileTotalPages)
            @if($pEnd<$mobileTotalPages-1)<span style="color:#4b5563;font-size:.75rem;">…</span>@endif
            <button wire:click="$set('mobilePage',{{ $mobileTotalPages }})"
                    style="min-width:2.1rem;height:2.1rem;border-radius:10px;padding:0 .5rem;
                           background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
                           color:#9ca3af;font-size:.75rem;font-weight:600;cursor:pointer;">{{ $mobileTotalPages }}</button>
        @endif

        <button wire:click="$set('mobilePage', {{ min($mobileTotalPages, $mobilePage+1) }})"
                @if($mobilePage>=$mobileTotalPages) disabled @endif
                style="display:flex;align-items:center;justify-content:center;width:2.1rem;height:2.1rem;border-radius:50%;
                       background:{{ $mobilePage>=$mobileTotalPages ? 'rgba(255,255,255,.04)':'rgba(255,255,255,.08)' }};
                       border:1px solid {{ $mobilePage>=$mobileTotalPages ? 'rgba(255,255,255,.06)':'rgba(255,255,255,.15)' }};
                       color:{{ $mobilePage>=$mobileTotalPages ? '#4b5563':'#e5e7eb' }};
                       cursor:{{ $mobilePage>=$mobileTotalPages ? 'not-allowed':'pointer' }};font-size:.8rem;">›</button>
    </div>
    <p style="text-align:center;font-size:.65rem;color:#4b5563;margin-bottom:.5rem;">
        පිටුව {{ $mobilePage }} / {{ $mobileTotalPages }} &nbsp;·&nbsp; මුළු {{ $mobileTotalCount }} දායකයන්
    </p>
    @endif

</div>

{{-- ══════════════════════════════════════════
     DESKTOP TABLE VIEW  (≥ md)
     ══════════════════════════════════════════ --}}
<div class="hidden md:block">
    {{ $this->table }}
</div>

</x-filament-panels::page>
