<x-filament-panels::page>

<style>
/* ── Shared Controls ────────────────────────────────────── */
.dmp-search {
    width:100%; padding:.65rem 1rem .65rem 2.6rem;
    background:#111827; border:1px solid #374151; border-radius:14px;
    color:#f9fafb; font-size:.875rem; outline:none;
    transition:border-color .2s, box-shadow .2s;
}
html:not(.dark) .dmp-search { background:#f9fafb; border:1px solid #d1d5db; color:#111827; }
.dmp-search::placeholder { color:#6b7280; }
.dmp-search:focus { border-color:#10b981; box-shadow:0 0 0 3px rgba(16,185,129,.15); }

.dmp-controls { display:flex; gap:.5rem; margin-bottom:.75rem; flex-wrap:wrap; align-items:center; }
.dmp-chip {
    display:inline-flex; align-items:center; gap:.3rem;
    padding:.35rem .75rem; border-radius:999px; font-size:.72rem; font-weight:600;
    border:1px solid rgba(255,255,255,.1); background:rgba(255,255,255,.05);
    color:#9ca3af; cursor:pointer; transition:all .15s; white-space:nowrap;
    -webkit-tap-highlight-color:transparent;
}
html:not(.dark) .dmp-chip { background:rgba(0,0,0,.04); border:1px solid rgba(0,0,0,.1); color:#374151; }
.dmp-chip:hover  { background:rgba(255,255,255,.1); color:#e5e7eb; }
.dmp-chip.active { background:rgba(16,185,129,.15); border-color:rgba(16,185,129,.4); color:#6ee7b7; }
html:not(.dark) .dmp-chip.active { color:#059669; }

/* ── Custom Dropdown ─────────────────────────────────────── */
.dmp-dropdown { position:relative; }
.dmp-dropdown-btn {
    display:inline-flex; align-items:center; gap:.4rem;
    padding:.35rem .75rem; border-radius:999px; font-size:.72rem; font-weight:600;
    border:1px solid rgba(255,255,255,.1); background:rgba(255,255,255,.05);
    color:#9ca3af; cursor:pointer; white-space:nowrap;
    transition:all .15s; -webkit-tap-highlight-color:transparent;
    max-width:160px;
}
html:not(.dark) .dmp-dropdown-btn { background:rgba(0,0,0,.04); border:1px solid rgba(0,0,0,.1); color:#374151; }
.dmp-dropdown-btn.has-value {
    background:rgba(16,185,129,.12); border-color:rgba(16,185,129,.35); color:#6ee7b7;
}
html:not(.dark) .dmp-dropdown-btn.has-value { color:#059669; }
.dmp-dropdown-btn svg { flex-shrink:0; transition:transform .2s; }
.dmp-dropdown-btn.open svg { transform:rotate(180deg); }
.dmp-dropdown-btn span { overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:110px; }

.dmp-dropdown-menu {
    position:absolute; top:calc(100% + .4rem); left:0; z-index:100;
    background:#1f2937; border:1px solid rgba(255,255,255,.1);
    border-radius:16px; padding:.4rem;
    min-width:200px; max-width:280px;
    box-shadow:0 8px 32px rgba(0,0,0,.5);
    max-height:260px; overflow-y:auto;
    display:none;
}
html:not(.dark) .dmp-dropdown-menu { background:#ffffff; border:1px solid rgba(0,0,0,.1); box-shadow:0 8px 32px rgba(0,0,0,.15); }
.dmp-dropdown-menu.open { display:block; }
.dmp-dropdown-item {
    display:flex; align-items:center; gap:.5rem;
    padding:.5rem .75rem; border-radius:10px; font-size:.78rem;
    color:#d1d5db; cursor:pointer; transition:background .12s;
    white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
}
html:not(.dark) .dmp-dropdown-item { color:#374151; }
.dmp-dropdown-item:hover { background:rgba(255,255,255,.07); color:#f9fafb; }
html:not(.dark) .dmp-dropdown-item:hover { background:rgba(0,0,0,.05); color:#111827; }
.dmp-dropdown-item.selected { background:rgba(16,185,129,.12); color:#6ee7b7; }
html:not(.dark) .dmp-dropdown-item.selected { background:rgba(16,185,129,.1); color:#059669; }
.dmp-dropdown-item .dmp-dd-check { color:#10b981; flex-shrink:0; opacity:0; }
.dmp-dropdown-item.selected .dmp-dd-check { opacity:1; }

.dmp-divider-v { width:1px; background:rgba(255,255,255,.08); margin:0 .15rem; align-self:stretch; }
html:not(.dark) .dmp-divider-v { background:rgba(0,0,0,.1); }

/* ── Pledge Cards ───────────────────────────────────────── */
.dmp-card { position:relative; overflow:hidden; border-radius:20px; border:1px solid rgba(255,255,255,.07); margin-bottom:.75rem; transition:transform .15s; }
.dmp-card:active { transform:scale(.985); }
.dmp-card-inner { position:relative; padding:1rem 1rem .85rem; }
.dmp-glow { position:absolute; border-radius:50%; filter:blur(50px); pointer-events:none; opacity:.15; width:140px; height:140px; right:-35px; top:-35px; }
html:not(.dark) .dmp-glow { opacity:.05; }

.dmp-a0 { background:linear-gradient(135deg,#030d1a 0%,#0f172a 70%); }
html:not(.dark) .dmp-a0 { background:#f0f9ff; border-left:3px solid #0ea5e9; }
.dmp-a0 .dmp-glow { background:#0ea5e9; } .dmp-a0 .dmp-qty { color:#38bdf8; } .dmp-a0 .dmp-dot { background:#0ea5e9; }
.dmp-a0 .dmp-item-pill { background:rgba(14,165,233,.12); color:#7dd3fc; border:1px solid rgba(14,165,233,.25); }

.dmp-a1 { background:linear-gradient(135deg,#0d0520 0%,#0f172a 70%); }
html:not(.dark) .dmp-a1 { background:#faf5ff; border-left:3px solid #8b5cf6; }
.dmp-a1 .dmp-glow { background:#8b5cf6; } .dmp-a1 .dmp-qty { color:#a78bfa; } .dmp-a1 .dmp-dot { background:#8b5cf6; }
.dmp-a1 .dmp-item-pill { background:rgba(139,92,246,.12); color:#c4b5fd; border:1px solid rgba(139,92,246,.25); }

.dmp-a2 { background:linear-gradient(135deg,#021a14 0%,#0f172a 70%); }
html:not(.dark) .dmp-a2 { background:#f0fdfa; border-left:3px solid #14b8a6; }
.dmp-a2 .dmp-glow { background:#14b8a6; } .dmp-a2 .dmp-qty { color:#2dd4bf; } .dmp-a2 .dmp-dot { background:#14b8a6; }
.dmp-a2 .dmp-item-pill { background:rgba(20,184,166,.12); color:#5eead4; border:1px solid rgba(20,184,166,.25); }

.dmp-a3 { background:linear-gradient(135deg,#1a0520 0%,#0f172a 70%); }
html:not(.dark) .dmp-a3 { background:#fdf4ff; border-left:3px solid #d946ef; }
.dmp-a3 .dmp-glow { background:#d946ef; } .dmp-a3 .dmp-qty { color:#e879f9; } .dmp-a3 .dmp-dot { background:#d946ef; }
.dmp-a3 .dmp-item-pill { background:rgba(217,70,239,.12); color:#f0abfc; border:1px solid rgba(217,70,239,.25); }

.dmp-a4 { background:linear-gradient(135deg,#1a0a00 0%,#0f172a 70%); }
html:not(.dark) .dmp-a4 { background:#fff7ed; border-left:3px solid #f97316; }
.dmp-a4 .dmp-glow { background:#f97316; } .dmp-a4 .dmp-qty { color:#fb923c; } .dmp-a4 .dmp-dot { background:#f97316; }
.dmp-a4 .dmp-item-pill { background:rgba(249,115,22,.12); color:#fdba74; border:1px solid rgba(249,115,22,.25); }

.dmp-a5 { background:linear-gradient(135deg,#001a1a 0%,#0f172a 70%); }
html:not(.dark) .dmp-a5 { background:#ecfeff; border-left:3px solid #06b6d4; }
.dmp-a5 .dmp-glow { background:#06b6d4; } .dmp-a5 .dmp-qty { color:#22d3ee; } .dmp-a5 .dmp-dot { background:#06b6d4; }
.dmp-a5 .dmp-item-pill { background:rgba(6,182,212,.12); color:#67e8f9; border:1px solid rgba(6,182,212,.25); }

.dmp-name  { font-size:1rem; font-weight:700; color:#f9fafb; line-height:1.2; }
html:not(.dark) .dmp-name { color:#111827; }
.dmp-phone { font-size:.75rem; color:#9ca3af; display:flex; align-items:center; gap:.3rem; margin-top:.25rem; }
html:not(.dark) .dmp-phone { color:#6b7280; }
.dmp-date  { font-size:.7rem; color:#6b7280; background:rgba(255,255,255,.05); padding:.2rem .55rem; border-radius:999px; white-space:nowrap; }
html:not(.dark) .dmp-date { background:rgba(0,0,0,.05); color:#6b7280; }

.dmp-item-row { display:flex; align-items:center; justify-content:space-between; background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.06); border-radius:14px; padding:.6rem .85rem; margin:.65rem 0; }
html:not(.dark) .dmp-item-row { background:rgba(0,0,0,.03); border:1px solid rgba(0,0,0,.07); }
.dmp-item-left { display:flex; align-items:center; gap:.5rem; min-width:0; }
.dmp-dot       { width:.55rem; height:.55rem; border-radius:50%; flex-shrink:0; }
.dmp-item-pill { font-size:.75rem; font-weight:600; padding:.15rem .55rem; border-radius:999px; }
.dmp-qty       { font-size:1.1rem; font-weight:800; flex-shrink:0; }
.dmp-qty-unit  { font-size:.65rem; color:#6b7280; margin-left:.2rem; }
html:not(.dark) .dmp-qty-unit { color:#6b7280; }

.dmp-address { font-size:.72rem; color:#6b7280; display:flex; align-items:flex-start; gap:.4rem; margin-bottom:.5rem; line-height:1.4; }
html:not(.dark) .dmp-address { color:#6b7280; }
.dmp-divider { height:1px; background:rgba(255,255,255,.05); margin:.65rem 0; }
html:not(.dark) .dmp-divider { background:rgba(0,0,0,.07); }

.dmp-actions { display:flex; gap:.5rem; }
.dmp-btn { flex:1; display:flex; align-items:center; justify-content:center; gap:.4rem; padding:.55rem; border-radius:12px; font-size:.75rem; font-weight:600; text-decoration:none; transition:background .15s, transform .1s; }
.dmp-btn:active { transform:scale(.96); }
.dmp-btn--edit { background:rgba(255,255,255,.1); color:#e5e7eb; }
.dmp-btn--edit:hover { background:rgba(255,255,255,.18); }
html:not(.dark) .dmp-btn--edit { background:rgba(0,0,0,.06); color:#374151; }
.dmp-btn--view { background:rgba(255,255,255,.04); color:#9ca3af; flex:0 0 auto; padding:.55rem .9rem; }
.dmp-btn--view:hover { background:rgba(255,255,255,.09); }
html:not(.dark) .dmp-btn--view { background:rgba(0,0,0,.03); color:#6b7280; }

.dmp-empty { display:flex; flex-direction:column; align-items:center; justify-content:center; padding:4rem 1rem; text-align:center; }
.dmp-empty-icon { width:3.5rem; height:3.5rem; border-radius:16px; background:rgba(255,255,255,.05); display:flex; align-items:center; justify-content:center; margin-bottom:.85rem; }
html:not(.dark) .dmp-empty-icon { background:rgba(0,0,0,.04); }

/* Dropdown sticky search wrapper */
.dmp-dropdown-search-wrap { background:#1f2937; }
html:not(.dark) .dmp-dropdown-search-wrap { background:#ffffff; }
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
               type="search" placeholder="නම, දුරකථනය, භාණ්ඩය සොයන්න..."
               class="dmp-search" />
    </div>

    {{-- Sort chips --}}
    <div class="dmp-controls">
        <button wire:click="$set('mobileSort','newest')"  class="dmp-chip {{ $mobileSort==='newest'   ? 'active':'' }}">🕐 අලුත්</button>
        <button wire:click="$set('mobileSort','oldest')"  class="dmp-chip {{ $mobileSort==='oldest'   ? 'active':'' }}">🕰 පැරණි</button>
        <button wire:click="$set('mobileSort','name')"    class="dmp-chip {{ $mobileSort==='name'     ? 'active':'' }}">A-Z නම</button>
        <button wire:click="$set('mobileSort','qty_desc')" class="dmp-chip {{ $mobileSort==='qty_desc' ? 'active':'' }}">↓ ප්‍රමාණය</button>
        <button wire:click="$set('mobileSort','qty_asc')"  class="dmp-chip {{ $mobileSort==='qty_asc'  ? 'active':'' }}">↑ ප්‍රමාණය</button>

        <div class="dmp-divider-v"></div>

        {{-- Item filter — custom dropdown --}}
        @php $selectedItem = $allItems->firstWhere('id', $mobileFilterItem); @endphp
        <div class="dmp-dropdown" id="dmpItemDropdown">
            <button type="button"
                    class="dmp-dropdown-btn {{ $mobileFilterItem > 0 ? 'has-value' : '' }}"
                    id="dmpDropdownBtn"
                    onclick="toggleDmpDropdown()">
                <svg style="width:.75rem;height:.75rem;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                </svg>
                <span>{{ $selectedItem ? $selectedItem->name : 'සියලු භාණ්ඩ' }}</span>
                <svg style="width:.7rem;height:.7rem;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div class="dmp-dropdown-menu" id="dmpDropdownMenu">
                {{-- Search inside dropdown --}}
                <div style="padding:.3rem .3rem .4rem;position:sticky;top:0;z-index:1;" class="dmp-dropdown-search-wrap">
                    <div style="position:relative;">
                        <svg style="position:absolute;left:.6rem;top:50%;transform:translateY(-50%);width:.8rem;height:.8rem;color:#6b7280;pointer-events:none;"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                        </svg>
                        <input type="text" id="dmpDropdownSearch"
                               placeholder="භාණ්ඩ සොයන්න..."
                               oninput="filterDmpItems(this.value)"
                               class="dmp-search"
                               style="padding:.4rem .6rem .4rem 1.9rem;border-radius:10px;font-size:.75rem;" />
                    </div>
                </div>

                {{-- All option --}}
                <div class="dmp-dropdown-item {{ $mobileFilterItem === 0 ? 'selected' : '' }} dmp-dd-opt"
                     data-label="සියලු භාණ්ඩ"
                     wire:click="$set('mobileFilterItem', 0)"
                     onclick="closeDmpDropdown()">
                    <svg class="dmp-dd-check" style="width:.75rem;height:.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    සියලු භාණ්ඩ
                </div>

                <div class="dmp-divider" style="margin:.3rem .25rem;" id="dmpDivider"></div>

                {{-- Items --}}
                @foreach($allItems as $it)
                    <div class="dmp-dropdown-item {{ $mobileFilterItem === $it->id ? 'selected' : '' }} dmp-dd-opt"
                         data-label="{{ $it->name }}"
                         wire:click="$set('mobileFilterItem', {{ $it->id }})"
                         onclick="closeDmpDropdown()">
                        <svg class="dmp-dd-check" style="width:.75rem;height:.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ $it->name }}
                    </div>
                @endforeach

                {{-- No results --}}
                <div id="dmpNoResults" style="display:none;padding:.6rem .75rem;font-size:.75rem;color:#6b7280;text-align:center;">
                    ප්‍රතිඵල නොමැත
                </div>
            </div>
        </div>
    </div>

    {{-- Result count --}}
    <p style="font-size:.72rem;color:#6b7280;margin-bottom:.75rem;">
        {{ $mobilePledges->count() }} / {{ $mobileTotalCount }} පොරොන්දු
        @if(filled($mobileSearch)) · "{{ $mobileSearch }}" @endif
        @if($mobileFilterItem > 0) · {{ $allItems->firstWhere('id', $mobileFilterItem)?->name }} @endif
    </p>

    {{-- Cards --}}
    @forelse ($mobilePledges as $pledge)
        @php $item = $pledge->item; $accent = $pledge->id % 6; @endphp

        <div class="dmp-card dmp-a{{ $accent }}">
            <div class="dmp-glow"></div>
            <div class="dmp-card-inner">

                <div style="display:flex;align-items:flex-start;justify-content:space-between;">
                    <div style="min-width:0;flex:1;padding-right:.5rem;">
                        <p class="dmp-name">{{ $pledge->donor_name }}</p>
                        @if($pledge->donor_mobile)
                            <p class="dmp-phone">
                                <svg style="width:.8rem;height:.8rem;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ $pledge->donor_mobile }}
                            </p>
                        @endif
                    </div>
                    <span class="dmp-date">{{ $pledge->created_at->format('d M Y') }}</span>
                </div>

                <div class="dmp-item-row">
                    <div class="dmp-item-left">
                        <span class="dmp-dot"></span>
                        <span class="dmp-item-pill">{{ $item?->name ?? '—' }}</span>
                    </div>
                    <div style="display:flex;align-items:baseline;flex-shrink:0;margin-left:.5rem;">
                        @if($pledge->pledged_quantity)
                            <span class="dmp-qty">{{ number_format($pledge->pledged_quantity, 2) }}</span>
                            <span class="dmp-qty-unit">{{ $item?->unit }}</span>
                        @else
                            <span style="font-size:.72rem;color:#6b7280;background:rgba(255,255,255,.05);
                                         padding:.2rem .5rem;border-radius:999px;border:1px solid rgba(255,255,255,.08);">
                                ප්‍රමාණය නොදනී
                            </span>
                        @endif
                    </div>
                </div>

                @if($pledge->donor_address)
                    <p class="dmp-address">
                        <svg style="width:.8rem;height:.8rem;flex-shrink:0;margin-top:.1rem;color:#4b5563;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span style="overflow:hidden;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;">{{ $pledge->donor_address }}</span>
                    </p>
                @endif

                <div class="dmp-divider"></div>

                <div class="dmp-actions">
                    <a href="{{ \App\Filament\Resources\PledgeResource::getUrl('edit', ['record' => $pledge]) }}" class="dmp-btn dmp-btn--edit">
                        <svg style="width:.85rem;height:.85rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        සංස්කරණය
                    </a>
                    <a href="{{ \App\Filament\Resources\PledgeResource::getUrl('view', ['record' => $pledge]) }}" class="dmp-btn dmp-btn--view">
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
        <div class="dmp-empty">
            <div class="dmp-empty-icon">
                <svg style="width:1.75rem;height:1.75rem;color:#4b5563;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <p style="font-weight:600;color:#d1d5db;">පොරොන්දු නොමැත</p>
            <p style="font-size:.8rem;color:#6b7280;margin-top:.3rem;">
                @if(filled($mobileSearch)) "{{ $mobileSearch }}" සඳහා ප්‍රතිඵල නොමැත
                @elseif($mobileFilterItem > 0) මෙම භාණ්ඩය සඳහා පොරොන්දු නොමැත
                @else ආරම්භ කිරීමට නව පොරොන්දුවක් එකතු කරන්න @endif
            </p>
        </div>
    @endforelse

    {{-- ── Pagination ── --}}
    @if($mobileTotalPages > 1)
    <div style="display:flex;align-items:center;justify-content:center;gap:.4rem;margin:1rem 0 .5rem;flex-wrap:wrap;">
        <button wire:click="$set('mobilePage', {{ max(1, $mobilePage - 1) }})"
                @if($mobilePage <= 1) disabled @endif
                style="display:flex;align-items:center;justify-content:center;width:2.1rem;height:2.1rem;border-radius:50%;
                       background:{{ $mobilePage <= 1 ? 'rgba(255,255,255,.04)' : 'rgba(255,255,255,.08)' }};
                       border:1px solid {{ $mobilePage <= 1 ? 'rgba(255,255,255,.06)' : 'rgba(255,255,255,.15)' }};
                       color:{{ $mobilePage <= 1 ? '#4b5563' : '#e5e7eb' }};
                       cursor:{{ $mobilePage <= 1 ? 'not-allowed' : 'pointer' }};font-size:.8rem;">‹</button>

        @php $start = max(1, $mobilePage - 2); $end = min($mobileTotalPages, $mobilePage + 2); @endphp

        @if($start > 1)
            <button wire:click="$set('mobilePage', 1)"
                    style="min-width:2.1rem;height:2.1rem;border-radius:10px;padding:0 .5rem;
                           background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
                           color:#9ca3af;font-size:.75rem;font-weight:600;cursor:pointer;">1</button>
            @if($start > 2)<span style="color:#4b5563;font-size:.75rem;">…</span>@endif
        @endif

        @for($i = $start; $i <= $end; $i++)
            <button wire:click="$set('mobilePage', {{ $i }})"
                    style="min-width:2.1rem;height:2.1rem;border-radius:10px;padding:0 .5rem;
                           background:{{ $i === $mobilePage ? 'rgba(16,185,129,.2)' : 'rgba(255,255,255,.05)' }};
                           border:1px solid {{ $i === $mobilePage ? 'rgba(16,185,129,.5)' : 'rgba(255,255,255,.1)' }};
                           color:{{ $i === $mobilePage ? '#34d399' : '#9ca3af' }};
                           font-size:.75rem;font-weight:{{ $i === $mobilePage ? '700' : '600' }};cursor:pointer;">{{ $i }}</button>
        @endfor

        @if($end < $mobileTotalPages)
            @if($end < $mobileTotalPages - 1)<span style="color:#4b5563;font-size:.75rem;">…</span>@endif
            <button wire:click="$set('mobilePage', {{ $mobileTotalPages }})"
                    style="min-width:2.1rem;height:2.1rem;border-radius:10px;padding:0 .5rem;
                           background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
                           color:#9ca3af;font-size:.75rem;font-weight:600;cursor:pointer;">{{ $mobileTotalPages }}</button>
        @endif

        <button wire:click="$set('mobilePage', {{ min($mobileTotalPages, $mobilePage + 1) }})"
                @if($mobilePage >= $mobileTotalPages) disabled @endif
                style="display:flex;align-items:center;justify-content:center;width:2.1rem;height:2.1rem;border-radius:50%;
                       background:{{ $mobilePage >= $mobileTotalPages ? 'rgba(255,255,255,.04)' : 'rgba(255,255,255,.08)' }};
                       border:1px solid {{ $mobilePage >= $mobileTotalPages ? 'rgba(255,255,255,.06)' : 'rgba(255,255,255,.15)' }};
                       color:{{ $mobilePage >= $mobileTotalPages ? '#4b5563' : '#e5e7eb' }};
                       cursor:{{ $mobilePage >= $mobileTotalPages ? 'not-allowed' : 'pointer' }};font-size:.8rem;">›</button>
    </div>
    <p style="text-align:center;font-size:.65rem;color:#4b5563;margin-bottom:.5rem;">
        පිටුව {{ $mobilePage }} / {{ $mobileTotalPages }} &nbsp;·&nbsp; මුළු {{ $mobileTotalCount }} පොරොන්දු
    </p>
    @endif

</div>

{{-- ══════════════════════════════════════════
     DESKTOP TABLE VIEW  (≥ md)
     ══════════════════════════════════════════ --}}
<div class="hidden md:block">
    {{ $this->table }}
</div>

<script>
function toggleDmpDropdown() {
    const btn  = document.getElementById('dmpDropdownBtn');
    const menu = document.getElementById('dmpDropdownMenu');
    const isOpen = menu.classList.contains('open');
    if (isOpen) {
        menu.classList.remove('open');
        btn.classList.remove('open');
    } else {
        menu.classList.add('open');
        btn.classList.add('open');
        // Clear search and focus
        const s = document.getElementById('dmpDropdownSearch');
        if (s) { s.value = ''; filterDmpItems(''); setTimeout(() => s.focus(), 80); }
    }
}

function closeDmpDropdown() {
    const btn  = document.getElementById('dmpDropdownBtn');
    const menu = document.getElementById('dmpDropdownMenu');
    menu.classList.remove('open');
    btn.classList.remove('open');
}

function filterDmpItems(val) {
    const q       = val.trim().toLowerCase();
    const opts    = document.querySelectorAll('.dmp-dd-opt');
    const divider = document.getElementById('dmpDivider');
    let   visible = 0;

    opts.forEach(function(el) {
        const label = (el.dataset.label || '').toLowerCase();
        // Always show "සියලු භාණ්ඩ" when no query
        if (!q || label.includes(q)) {
            el.style.display = '';
            visible++;
        } else {
            el.style.display = 'none';
        }
    });

    // Hide divider when searching
    if (divider) divider.style.display = q ? 'none' : '';

    const noRes = document.getElementById('dmpNoResults');
    if (noRes) noRes.style.display = visible === 0 ? '' : 'none';
}

// Close on outside click
document.addEventListener('click', function(e) {
    const wrap = document.getElementById('dmpItemDropdown');
    if (wrap && !wrap.contains(e.target)) {
        closeDmpDropdown();
    }
});
</script>

</x-filament-panels::page>
