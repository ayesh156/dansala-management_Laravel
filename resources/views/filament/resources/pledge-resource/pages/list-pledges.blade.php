<x-filament-panels::page>

<style>
/* ── Pledge Cards ───────────────────────────────────────── */
.dmp-search {
    width:100%; padding:.65rem 1rem .65rem 2.6rem;
    background:#111827; border:1px solid #374151; border-radius:14px;
    color:#f9fafb; font-size:.875rem; outline:none;
    transition:border-color .2s, box-shadow .2s;
}
.dmp-search::placeholder { color:#6b7280; }
.dmp-search:focus { border-color:#10b981; box-shadow:0 0 0 3px rgba(16,185,129,.15); }

.dmp-card {
    position:relative; overflow:hidden; border-radius:20px;
    border:1px solid rgba(255,255,255,.07);
    margin-bottom:.75rem;
    transition:transform .15s, box-shadow .15s;
}
.dmp-card:active { transform:scale(.985); }

.dmp-card-inner { position:relative; padding:1rem 1rem .85rem; }

.dmp-glow {
    position:absolute; border-radius:50%; filter:blur(50px);
    pointer-events:none; opacity:.15; width:140px; height:140px;
    right:-35px; top:-35px;
}

/* accent palettes — fixed class names so Tailwind won't purge */
.dmp-a0 { background:linear-gradient(135deg,#030d1a 0%,#0f172a 70%); }
.dmp-a0 .dmp-glow { background:#0ea5e9; }
.dmp-a0 .dmp-qty  { color:#38bdf8; }
.dmp-a0 .dmp-dot  { background:#0ea5e9; }
.dmp-a0 .dmp-item-pill { background:rgba(14,165,233,.12); color:#7dd3fc; border:1px solid rgba(14,165,233,.25); }

.dmp-a1 { background:linear-gradient(135deg,#0d0520 0%,#0f172a 70%); }
.dmp-a1 .dmp-glow { background:#8b5cf6; }
.dmp-a1 .dmp-qty  { color:#a78bfa; }
.dmp-a1 .dmp-dot  { background:#8b5cf6; }
.dmp-a1 .dmp-item-pill { background:rgba(139,92,246,.12); color:#c4b5fd; border:1px solid rgba(139,92,246,.25); }

.dmp-a2 { background:linear-gradient(135deg,#021a14 0%,#0f172a 70%); }
.dmp-a2 .dmp-glow { background:#14b8a6; }
.dmp-a2 .dmp-qty  { color:#2dd4bf; }
.dmp-a2 .dmp-dot  { background:#14b8a6; }
.dmp-a2 .dmp-item-pill { background:rgba(20,184,166,.12); color:#5eead4; border:1px solid rgba(20,184,166,.25); }

.dmp-a3 { background:linear-gradient(135deg,#1a0520 0%,#0f172a 70%); }
.dmp-a3 .dmp-glow { background:#d946ef; }
.dmp-a3 .dmp-qty  { color:#e879f9; }
.dmp-a3 .dmp-dot  { background:#d946ef; }
.dmp-a3 .dmp-item-pill { background:rgba(217,70,239,.12); color:#f0abfc; border:1px solid rgba(217,70,239,.25); }

.dmp-a4 { background:linear-gradient(135deg,#1a0a00 0%,#0f172a 70%); }
.dmp-a4 .dmp-glow { background:#f97316; }
.dmp-a4 .dmp-qty  { color:#fb923c; }
.dmp-a4 .dmp-dot  { background:#f97316; }
.dmp-a4 .dmp-item-pill { background:rgba(249,115,22,.12); color:#fdba74; border:1px solid rgba(249,115,22,.25); }

.dmp-a5 { background:linear-gradient(135deg,#001a1a 0%,#0f172a 70%); }
.dmp-a5 .dmp-glow { background:#06b6d4; }
.dmp-a5 .dmp-qty  { color:#22d3ee; }
.dmp-a5 .dmp-dot  { background:#06b6d4; }
.dmp-a5 .dmp-item-pill { background:rgba(6,182,212,.12); color:#67e8f9; border:1px solid rgba(6,182,212,.25); }

/* shared inner elements */
.dmp-name  { font-size:1rem; font-weight:700; color:#f9fafb; line-height:1.2; }
.dmp-phone { font-size:.75rem; color:#9ca3af; display:flex; align-items:center; gap:.3rem; margin-top:.25rem; }
.dmp-date  { font-size:.7rem; color:#6b7280; background:rgba(255,255,255,.05);
             padding:.2rem .55rem; border-radius:999px; white-space:nowrap; }

.dmp-item-row {
    display:flex; align-items:center; justify-content:space-between;
    background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.06);
    border-radius:14px; padding:.6rem .85rem; margin:.65rem 0;
}
.dmp-item-left  { display:flex; align-items:center; gap:.5rem; min-width:0; }
.dmp-dot        { width:.55rem; height:.55rem; border-radius:50%; flex-shrink:0; }
.dmp-item-pill  { font-size:.75rem; font-weight:600; padding:.15rem .55rem; border-radius:999px; }
.dmp-qty        { font-size:1.1rem; font-weight:800; flex-shrink:0; }
.dmp-qty-unit   { font-size:.65rem; color:#6b7280; margin-left:.2rem; }

.dmp-address { font-size:.72rem; color:#6b7280; display:flex; align-items:flex-start;
               gap:.4rem; margin-bottom:.5rem; line-height:1.4; }

.dmp-divider { height:1px; background:rgba(255,255,255,.05); margin:.65rem 0 .65rem; }

.dmp-actions { display:flex; gap:.5rem; }
.dmp-btn {
    flex:1; display:flex; align-items:center; justify-content:center; gap:.4rem;
    padding:.55rem; border-radius:12px; font-size:.75rem; font-weight:600;
    text-decoration:none; transition:background .15s, transform .1s;
}
.dmp-btn:active { transform:scale(.96); }
.dmp-btn--edit  { background:rgba(255,255,255,.1); color:#e5e7eb; }
.dmp-btn--edit:hover { background:rgba(255,255,255,.18); }
.dmp-btn--view  { background:rgba(255,255,255,.04); color:#9ca3af; flex:0 0 auto; padding:.55rem .9rem; }
.dmp-btn--view:hover { background:rgba(255,255,255,.09); }

.dmp-empty {
    display:flex; flex-direction:column; align-items:center;
    justify-content:center; padding:4rem 1rem; text-align:center;
}
.dmp-empty-icon {
    width:3.5rem; height:3.5rem; border-radius:16px;
    background:rgba(255,255,255,.05); display:flex; align-items:center;
    justify-content:center; margin-bottom:.85rem;
}
</style>

{{-- ══════════════════════════════════════════
     MOBILE CARD VIEW  (< md)
     ══════════════════════════════════════════ --}}
<div class="block md:hidden">

    {{-- Search --}}
    <div style="position:relative;margin-bottom:1rem;">
        <svg style="position:absolute;left:.75rem;top:50%;transform:translateY(-50%);
                    width:1rem;height:1rem;color:#6b7280;pointer-events:none;"
             fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
        </svg>
        <input wire:model.live.debounce.300ms="mobileSearch"
               type="search"
               placeholder="නම, දුරකථනය, භාණ්ඩය සොයන්න..."
               class="dmp-search" />
    </div>

    @if(filled($mobileSearch))
        <p style="font-size:.75rem;color:#6b7280;margin-bottom:.75rem;">
            "{{ $mobileSearch }}" — {{ $mobilePledges->count() }} ප්‍රතිඵල
        </p>
    @endif

    {{-- Cards --}}
    @forelse ($mobilePledges as $pledge)
        @php
            $item    = $pledge->item;
            $accent  = $pledge->id % 6;   // 0-5
        @endphp

        <div class="dmp-card dmp-a{{ $accent }}">
            <div class="dmp-glow"></div>

            <div class="dmp-card-inner">

                {{-- Row 1: name + date --}}
                <div style="display:flex;align-items:flex-start;justify-content:space-between;">
                    <div style="min-width:0;flex:1;padding-right:.5rem;">
                        <p class="dmp-name">{{ $pledge->donor_name }}</p>
                        @if($pledge->donor_mobile)
                            <p class="dmp-phone">
                                <svg style="width:.8rem;height:.8rem;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0
                                             01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1
                                             1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716
                                             21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ $pledge->donor_mobile }}
                            </p>
                        @endif
                    </div>
                    <span class="dmp-date">{{ $pledge->created_at->format('d M Y') }}</span>
                </div>

                {{-- Item + Qty row --}}
                <div class="dmp-item-row">
                    <div class="dmp-item-left">
                        <span class="dmp-dot"></span>
                        <span class="dmp-item-pill">{{ $item?->name ?? '—' }}</span>
                    </div>
                    <div style="display:flex;align-items:baseline;flex-shrink:0;margin-left:.5rem;">
                        <span class="dmp-qty">{{ number_format($pledge->pledged_quantity, 2) }}</span>
                        <span class="dmp-qty-unit">{{ $item?->unit }}</span>
                    </div>
                </div>

                {{-- Address --}}
                @if($pledge->donor_address)
                    <p class="dmp-address">
                        <svg style="width:.8rem;height:.8rem;flex-shrink:0;margin-top:.1rem;color:#4b5563;"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8
                                     8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span style="overflow:hidden;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;">
                            {{ $pledge->donor_address }}
                        </span>
                    </p>
                @endif

                <div class="dmp-divider"></div>

                {{-- Actions --}}
                <div class="dmp-actions">
                    <a href="{{ \App\Filament\Resources\PledgeResource::getUrl('edit', ['record' => $pledge]) }}"
                       class="dmp-btn dmp-btn--edit">
                        <svg style="width:.85rem;height:.85rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                     m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        සංස්කරණය
                    </a>
                    <a href="{{ \App\Filament\Resources\PledgeResource::getUrl('view', ['record' => $pledge]) }}"
                       class="dmp-btn dmp-btn--view">
                        <svg style="width:.85rem;height:.85rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z
                                     M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943
                                     9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        බලන්න
                    </a>
                </div>

            </div>
        </div>

    @empty
        <div class="dmp-empty">
            <div class="dmp-empty-icon">
                <svg style="width:1.75rem;height:1.75rem;color:#4b5563;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0
                             00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <p style="font-weight:600;color:#d1d5db;">පොරොන්දු නොමැත</p>
            <p style="font-size:.8rem;color:#6b7280;margin-top:.3rem;">
                @if(filled($mobileSearch))
                    "{{ $mobileSearch }}" සඳහා ප්‍රතිඵල නොමැත
                @else
                    ආරම්භ කිරීමට නව පොරොන්දුවක් එකතු කරන්න
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
