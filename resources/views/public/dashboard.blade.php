<!DOCTYPE html>
<html lang="si" id="htmlRoot">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>දන්සල් කළමනාකරණ පද්ධතිය</title>

    {{-- Open Graph / Social Share --}}
    <meta property="og:type"        content="website" />
    <meta property="og:title"       content="දන්සල් කළමනාකරණ පද්ධතිය" />
    <meta property="og:description" content="මහමෙව්නාව භාවනා අසපුවේ දන්සල් දායකත්ව ප්‍රගති නිරීක්ෂණය" />
    <meta property="og:image"       content="{{ asset('logo.jpg') }}" />
    <meta property="og:url"         content="{{ url('/') }}" />
    <meta property="og:site_name"   content="දන්සල් කළමනාකරණ පද්ධතිය" />
    <meta name="twitter:card"       content="summary" />
    <meta name="twitter:title"      content="දන්සල් කළමනාකරණ පද්ධතිය" />
    <meta name="twitter:description" content="මහමෙව්නාව භාවනා අසපුවේ දන්සල් දායකත්ව ප්‍රගති නිරීක්ෂණය" />
    <meta name="twitter:image"      content="{{ asset('logo.jpg') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { darkMode: 'class' }</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Sinhala:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        // Apply saved theme before render to avoid flash
        (function() {
            const t = localStorage.getItem('pub-theme') || 'dark';
            document.documentElement.classList.toggle('dark', t === 'dark');
        })();
    </script>
    <style>
        body { font-family: 'Noto Sans Sinhala', 'Inter', sans-serif; transition: background .3s, color .3s; }
        .progress-bar { transition: width 0.9s cubic-bezier(0.4,0,0.2,1); }

        /* ── DARK theme (default) ── */
        :root {
            --bg:        #030712;
            --nav-bg:    rgba(15,23,42,0.92);
            --nav-border:rgba(255,255,255,0.07);
            --card-bg:   rgba(255,255,255,.04);
            --card-border:rgba(255,255,255,.07);
            --text-main: #f9fafb;
            --text-sub:  #6b7280;
            --text-muted:#4b5563;
            --input-bg:  #111827;
            --input-border:#374151;
            --chip-bg:   rgba(255,255,255,.05);
            --chip-border:rgba(255,255,255,.1);
            --chip-color:#9ca3af;
            --divider:   rgba(255,255,255,.06);
            --mini-bg:   rgba(255,255,255,.04);
            --mini-border:rgba(255,255,255,.06);
            --pledge-bg: rgba(255,255,255,.03);
            --pledge-border:rgba(255,255,255,.06);
            /* announcement banner dark vars */
            --ann-bg:        linear-gradient(135deg,#052e16 0%,#0f172a 60%,#1e1b4b 100%);
            --ann-border:    rgba(16,185,129,.25);
            --ann-shadow:    0 0 40px rgba(16,185,129,.08);
            --ann-title:     #f9fafb;
            --ann-text:      #d1d5db;
            --ann-strong:    #6ee7b7;
            --ann-orb1:      #10b981;
            --ann-orb2:      #6366f1;
            --ann-schedule-bg:   rgba(255,255,255,.04);
            --ann-schedule-border: rgba(255,255,255,.07);
            --ann-time-color:#fbbf24;
            --ann-bank-bg:   rgba(16,185,129,.07);
            --ann-bank-border:rgba(16,185,129,.2);
            --ann-bank-title:#6ee7b7;
            --ann-bank-num:  #fbbf24;
            --ann-bank-wp:   #34d399;
            --ann-phone:     #34d399;
            --ann-phone-sub: #9ca3af;
            --ann-footer-border: rgba(255,255,255,.06);
            --ann-footer-text:   #6b7280;
            --ann-dot:       #f87171;
        }

        /* ── LIGHT theme ── */
        html:not(.dark) {
            --bg:        #fdf6ee;
            --nav-bg:    rgba(255,255,255,0.97);
            --nav-border:rgba(0,0,0,0.08);
            --card-bg:   #ffffff;
            --card-border:rgba(0,0,0,0.08);
            --text-main: #1a1a2e;
            --text-sub:  #6b7280;
            --text-muted:#9ca3af;
            --input-bg:  #f9fafb;
            --input-border:#d1d5db;
            --chip-bg:   rgba(0,0,0,.04);
            --chip-border:rgba(0,0,0,.1);
            --chip-color:#374151;
            --divider:   rgba(0,0,0,.07);
            --mini-bg:   #f9fafb;
            --mini-border:rgba(0,0,0,.07);
            --pledge-bg: #ffffff;
            --pledge-border:rgba(0,0,0,.07);
            /* announcement banner light vars */
            --ann-bg:        linear-gradient(135deg,#fffbf0 0%,#fff7ed 40%,#fef3c7 70%,#ecfdf5 100%);
            --ann-border:    rgba(245,158,11,.35);
            --ann-shadow:    0 4px 32px rgba(245,158,11,.12), 0 1px 8px rgba(16,185,129,.08);
            --ann-title:     #92400e;
            --ann-text:      #374151;
            --ann-strong:    #065f46;
            --ann-orb1:      #f59e0b;
            --ann-orb2:      #10b981;
            --ann-schedule-bg:   rgba(245,158,11,.06);
            --ann-schedule-border: rgba(245,158,11,.2);
            --ann-time-color:#b45309;
            --ann-bank-bg:   rgba(16,185,129,.07);
            --ann-bank-border:rgba(16,185,129,.25);
            --ann-bank-title:#065f46;
            --ann-bank-num:  #b45309;
            --ann-bank-wp:   #059669;
            --ann-phone:     #059669;
            --ann-phone-sub: #6b7280;
            --ann-footer-border: rgba(0,0,0,.07);
            --ann-footer-text:   #9ca3af;
            --ann-dot:       #ef4444;
        }

        body { background: var(--bg); color: var(--text-main); }

        /* Navbar */
        .pub-nav {
            position:sticky; top:0; z-index:50;
            background: var(--nav-bg);
            backdrop-filter:blur(16px);
            border-bottom:1px solid var(--nav-border);
        }
        .pub-nav-inner {
            max-width:900px; margin:0 auto;
            padding:.6rem 1rem .5rem;
            display:flex; flex-direction:column; gap:.35rem;
        }

        /* Top row */
        .pub-nav-top {
            display:flex; align-items:center; gap:.55rem;
        }

        /* Logo */
        .pub-logo-pill { display:flex; align-items:center; flex-shrink:0; }
        .pub-logo-pill img {
            height:2.4rem; width:2.4rem; border-radius:50%; object-fit:cover;
            border:2px solid rgba(16,185,129,.55);
            box-shadow:0 0 14px rgba(16,185,129,.3);
        }

        /* Brand text */
        .pub-brand-col { min-width:0; flex:1; }
        .pub-brand-text {
            font-size:.9rem; font-weight:800; color:var(--text-main);
            line-height:1.3; letter-spacing:-.01em;
        }

        /* Right icons */
        .pub-nav-icons { display:flex; align-items:center; gap:.35rem; flex-shrink:0; }

        /* Bottom row — time */
        .pub-nav-bottom { display:none; }

        /* Theme toggle & admin buttons */
        .theme-toggle {
            width:1.9rem; height:1.9rem; border-radius:50%; flex-shrink:0;
            background: var(--chip-bg); border:1px solid var(--chip-border);
            color: var(--chip-color); cursor:pointer;
            display:flex; align-items:center; justify-content:center;
            transition: all .2s; font-size:.85rem;
        }
        .theme-toggle:hover { background: rgba(16,185,129,.15); border-color:rgba(16,185,129,.4); color:#10b981; }

        /* Stats */
        .pub-stat-card {
            background: var(--card-bg);
            border:1px solid var(--card-border);
            border-radius:16px; padding:1rem; text-align:center;
        }
        .pub-stat-val { font-size:1.6rem; font-weight:800; line-height:1.1; }
        .pub-stat-lbl { font-size:.7rem; color:var(--text-sub); margin-top:.3rem; }

        /* Search */
        .pub-search-wrap { position:relative; }
        .pub-search {
            width:100%; padding:.65rem 1rem .65rem 2.6rem;
            background: var(--input-bg); border:1px solid var(--input-border); border-radius:14px;
            color: var(--text-main); font-size:.875rem; outline:none;
            transition:border-color .2s, box-shadow .2s;
        }
        .pub-search::placeholder { color:var(--text-sub); }
        .pub-search:focus { border-color:#10b981; box-shadow:0 0 0 3px rgba(16,185,129,.15); }

        /* Chips */
        .pub-chips { display:flex; gap:.4rem; flex-wrap:wrap; margin-top:.6rem; }
        .pub-chip {
            padding:.3rem .7rem; border-radius:999px; font-size:.72rem; font-weight:600;
            border:1px solid var(--chip-border); background: var(--chip-bg);
            color: var(--chip-color); cursor:pointer; text-decoration:none; white-space:nowrap;
            transition:all .15s;
        }
        .pub-chip:hover { background:rgba(16,185,129,.1); color:#10b981; border-color:rgba(16,185,129,.3); }
        .pub-chip.active { background:rgba(16,185,129,.15); border-color:rgba(16,185,129,.4); color:#059669; }
        .pub-chip.active-red   { background:rgba(239,68,68,.1);  border-color:rgba(239,68,68,.4);  color:#dc2626; }
        .pub-chip.active-amber { background:rgba(245,158,11,.1); border-color:rgba(245,158,11,.4); color:#d97706; }
        .pub-chip.active-green { background:rgba(16,185,129,.15);border-color:rgba(16,185,129,.4); color:#059669; }
        .pub-divider-v { width:1px; background:var(--divider); align-self:stretch; margin:0 .1rem; }

        /* Item cards — dark */
        .pub-item-card {
            position:relative; overflow:hidden; border-radius:20px;
            border:1px solid var(--card-border); padding:1.1rem; transition:transform .15s;
        }
        .dark .pub-card--green { background:linear-gradient(135deg,#052e16 0%,#0f172a 65%); }
        .dark .pub-card--amber { background:linear-gradient(135deg,#1c1003 0%,#0f172a 65%); }
        .dark .pub-card--red   { background:linear-gradient(135deg,#1c0505 0%,#0f172a 65%); }
        html:not(.dark) .pub-card--green {
            background:linear-gradient(135deg,#d1fae5 0%,#ecfdf5 50%,#f0fdf4 100%);
            border-color:rgba(16,185,129,.3);
            box-shadow:0 2px 16px rgba(16,185,129,.1);
        }
        html:not(.dark) .pub-card--amber {
            background:linear-gradient(135deg,#fef3c7 0%,#fffbeb 50%,#fefce8 100%);
            border-color:rgba(245,158,11,.3);
            box-shadow:0 2px 16px rgba(245,158,11,.1);
        }
        html:not(.dark) .pub-card--red {
            background:linear-gradient(135deg,#fee2e2 0%,#fff1f2 50%,#fff5f5 100%);
            border-color:rgba(239,68,68,.3);
            box-shadow:0 2px 16px rgba(239,68,68,.1);
        }
        html:not(.dark) .pub-item-card:hover { transform:translateY(-2px); }

        .pub-glow { position:absolute; border-radius:50%; filter:blur(45px); pointer-events:none; opacity:.16; }
        html:not(.dark) .pub-glow { opacity:.08; }

        .pub-badge {
            display:inline-flex; align-items:center; gap:.3rem;
            font-size:.65rem; font-weight:600; padding:.2rem .55rem; border-radius:999px;
        }
        .pub-badge--green { background:rgba(16,185,129,.15); color:#059669; border:1px solid rgba(16,185,129,.3); }
        .pub-badge--amber { background:rgba(245,158,11,.15);  color:#d97706; border:1px solid rgba(245,158,11,.3); }
        .pub-badge--red   { background:rgba(239,68,68,.15);   color:#dc2626; border:1px solid rgba(239,68,68,.3); }
        .dark .pub-badge--green { color:#6ee7b7; }
        .dark .pub-badge--amber { color:#fcd34d; }
        .dark .pub-badge--red   { color:#fca5a5; }

        .pub-prog-track { height:5px; border-radius:999px; background:var(--mini-border); overflow:hidden; margin:.65rem 0 .85rem; }
        .pub-prog-fill  { height:100%; border-radius:999px; }
        .pub-fill--green { background:linear-gradient(90deg,#059669,#34d399); }
        .pub-fill--amber { background:linear-gradient(90deg,#d97706,#fbbf24); }
        .pub-fill--red   { background:linear-gradient(90deg,#dc2626,#f87171); }

        .pub-stats-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:.5rem; }
        .pub-mini-stat  { background:var(--mini-bg); border:1px solid var(--mini-border); border-radius:12px; padding:.5rem .25rem; text-align:center; }
        html:not(.dark) .pub-card--green .pub-mini-stat { background:rgba(255,255,255,.7); border-color:rgba(16,185,129,.15); }
        html:not(.dark) .pub-card--amber .pub-mini-stat { background:rgba(255,255,255,.7); border-color:rgba(245,158,11,.15); }
        html:not(.dark) .pub-card--red   .pub-mini-stat { background:rgba(255,255,255,.7); border-color:rgba(239,68,68,.15); }
        .pub-mini-lbl   { font-size:.6rem; text-transform:uppercase; letter-spacing:.06em; color:var(--text-sub); margin-bottom:.2rem; }
        .pub-mini-val   { font-size:.88rem; font-weight:700; line-height:1.1; }
        .pub-mini-unit  { font-size:.6rem; color:var(--text-muted); margin-top:.1rem; }

        /* Section title */
        .pub-section-title {
            display:flex; align-items:center; gap:.75rem;
            font-size:.7rem; font-weight:700; color:var(--text-muted);
            text-transform:uppercase; letter-spacing:.1em; margin:1.5rem 0 1rem;
        }
        .pub-section-title::before, .pub-section-title::after {
            content:''; flex:1; height:1px; background:var(--divider);
        }

        /* Pledge cards */
        .pub-pledge-card {
            background:var(--pledge-bg); border:1px solid var(--pledge-border);
            border-radius:16px; padding:.85rem 1rem;
            display:flex; align-items:center; justify-content:space-between; gap:.75rem;
        }
        .pub-pledge-name { font-size:.9rem; font-weight:700; color:var(--text-main); }
        .pub-pledge-item { font-size:.72rem; color:var(--text-sub); margin-top:.15rem; }
        .pub-pledge-qty  { font-size:1rem; font-weight:800; color:#10b981; flex-shrink:0; }
        .pub-pledge-unit { font-size:.65rem; color:var(--text-muted); }

        /* Cash card light mode */
        html:not(.dark) .html-not-dark-cash-card {
            background:linear-gradient(135deg,#fff7ed,#fffbf5) !important;
            border-color:rgba(0,0,0,.08) !important;
            border-left-color:rgba(251,146,60,.6) !important;
        }
        html:not(.dark) .html-not-dark-cash-card .pub-glow { opacity:.05; }

        /* Section title anchor offset for sticky nav */
        #pledges, #cash {
            scroll-margin-top: 80px;
        }

        /* Footer */
        .pub-footer {
            text-align:center; padding:1.5rem 1rem;
            border-top:1px solid var(--divider);
            font-size:.75rem; color:var(--text-muted); margin-top:2rem;
        }
        .pub-footer a { color:#10b981; text-decoration:none; font-weight:600; }
        .pub-footer a:hover { color:#059669; }

        /* Item name color */
        .pub-item-name { color: var(--text-main); }

        /* ── ANNOUNCEMENT BANNER ── */
        .pub-ann-banner {
            position:relative; overflow:hidden;
            border-radius:20px; margin-bottom:1.25rem;
            background: var(--ann-bg);
            border:1px solid var(--ann-border);
            box-shadow: var(--ann-shadow);
            padding:1.25rem 1.1rem 1.1rem;
        }
        .pub-ann-orb1 {
            position:absolute;width:200px;height:200px;border-radius:50%;
            filter:blur(60px);pointer-events:none;
            background:var(--ann-orb1);top:-60px;right:-40px;
            opacity:.12;
        }
        html:not(.dark) .pub-ann-orb1 { opacity:.18; }
        .pub-ann-orb2 {
            position:absolute;width:150px;height:150px;border-radius:50%;
            filter:blur(50px);pointer-events:none;
            background:var(--ann-orb2);bottom:-40px;left:-30px;
            opacity:.08;
        }
        html:not(.dark) .pub-ann-orb2 { opacity:.14; }
        .pub-ann-title { font-size:1.1rem;font-weight:800;color:var(--ann-title);line-height:1.6;text-align:center; }
        html:not(.dark) .pub-ann-title {
            background: linear-gradient(135deg,#92400e,#b45309,#065f46);
            -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
        }
        .pub-ann-body { font-size:.8rem;color:var(--ann-text);line-height:1.9;display:flex;flex-direction:column;gap:.6rem; }
        .pub-ann-strong { color:var(--ann-strong); }
        .pub-ann-schedule {
            background:var(--ann-schedule-bg);border:1px solid var(--ann-schedule-border);
            border-radius:14px;padding:.75rem .9rem;display:flex;flex-direction:column;gap:.45rem;
        }
        html:not(.dark) .pub-ann-schedule {
            background: linear-gradient(135deg,rgba(255,251,235,.8),rgba(236,253,245,.6));
        }
        .pub-ann-dot { color:var(--ann-dot);flex-shrink:0; }
        .pub-ann-time { color:var(--ann-time-color);font-weight:700; }
        .pub-ann-bank {
            background:var(--ann-bank-bg);border:1px solid var(--ann-bank-border);
            border-radius:14px;padding:.75rem .9rem;
        }
        html:not(.dark) .pub-ann-bank {
            background: linear-gradient(135deg,rgba(236,253,245,.9),rgba(240,253,244,.7));
        }
        .pub-ann-bank-title { font-size:.72rem;font-weight:700;color:var(--ann-bank-title);margin-bottom:.45rem; }
        .pub-ann-bank-num { color:var(--ann-bank-num);font-weight:700; }
        .pub-ann-bank-wp { color:var(--ann-bank-wp);font-weight:700; }
        .pub-ann-phone { color:var(--ann-phone);font-weight:700;text-decoration:none; }
        .pub-ann-phone:hover { text-decoration:underline; }
        .pub-ann-phone-sub { color:var(--ann-phone-sub); }
        .pub-ann-footer {
            border-top:1px solid var(--ann-footer-border);
            padding-top:.7rem;margin-top:.9rem;text-align:center;
        }
        .pub-ann-footer p { font-size:.72rem;color:var(--ann-footer-text);margin:0;font-style:italic; }
        html:not(.dark) .pub-ann-footer p { color:#a16207; }
    </style>
</head>
<body>

{{-- ══ NAVBAR ══════════════════════════════════════════════ --}}
<nav class="pub-nav">
    <div class="pub-nav-inner">

        {{-- Top row: logo + brand + icons --}}
        <div class="pub-nav-top">
            <div class="pub-logo-pill">
                <img src="{{ asset('logo.jpg') }}" alt="logo" />
            </div>

            <div class="pub-brand-col">
                <div style="font-size:.82rem;font-weight:800;color:var(--text-main);line-height:1.25;letter-spacing:-.01em;">දන්සල් කළමනාකරණ පද්ධතිය</div>
                <div style="font-size:.68rem;font-weight:700;color:#10b981;margin-top:.1rem;line-height:1.3;">මාතර අපරැක්ක මහමෙව්නාව</div>
            </div>

            <div class="pub-nav-icons">
                <a href="{{ url('/admin') }}"
                   title="පරිපාලන පද්ධතිය"
                   style="
                       display:inline-flex;align-items:center;justify-content:center;
                       width:1.9rem;height:1.9rem;border-radius:50%;flex-shrink:0;
                       background:var(--chip-bg);border:1px solid var(--chip-border);
                       color:var(--chip-color);text-decoration:none;transition:all .2s;
                   "
                   onmouseover="this.style.background='rgba(99,102,241,.15)';this.style.borderColor='rgba(99,102,241,.4)';this.style.color='#818cf8'"
                   onmouseout="this.style.background='var(--chip-bg)';this.style.borderColor='var(--chip-border)';this.style.color='var(--chip-color)'"
                >
                    <svg style="width:.85rem;height:.85rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </a>
                <button class="theme-toggle" onclick="toggleTheme()" id="themeBtn" title="Theme">
                    <span id="themeIcon">🌙</span>
                </button>
            </div>
        </div>

        {{-- Bottom row: time --}}
        <div class="pub-nav-bottom">
            <div class="pub-time-badge">
                <svg style="width:.65rem;height:.65rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <strong>{{ now()->format('d M Y, h:i A') }}</strong>
            </div>
        </div>

    </div>
</nav>

<main style="max-width:900px;margin:0 auto;padding:1.25rem 1rem 2rem;">

    {{-- ══ ANNOUNCEMENT BANNER ════════════════════════════ --}}
    <div class="pub-ann-banner">
        {{-- Glow orbs --}}
        <div class="pub-ann-orb1"></div>
        <div class="pub-ann-orb2"></div>

        {{-- Header --}}
        <div style="text-align:center;margin-bottom:1rem;">
            <div class="pub-ann-title">
                🙏 නමෝ බුද්ධාය 🙏
            </div>
        </div>

        {{-- Main text --}}
        <div class="pub-ann-body">

            <p>☸️ 2026.05.30 වන දින ට යෙදෙන උතුම් වෙසක් පුන් පොහෝ දිනය මූලික කරගෙන <strong class="pub-ann-strong">මාතර අපරැක්ක මහමෙව්නාව මහා විහාරය</strong> විසින් "දිනය" පුරා පවත්වනු ලබන සීල භාවනා වැඩසටහන, උතුම් සෑ වන්දනාව, වෙසක් සැරසිලි සහිත බොහෝ ආගමික කටයුතු සංවිධානය කර ඇත.</p>

            <p>✨ මෙම උතුම් පුණ්‍ය කටයුතු වලට සහභාගි වන සියලු සැදැහැවතුන් වෙනුවෙන් බත් දන්සැලක්, කඩල දන්සැලක්, අයිස්ක්‍රීම් දන්සැලක්, සරුවත් දන්සැලක්, කිරි තේ සමග පොල් රොටී දන්සැලක් පැවැත්වීමට කටයුතු සිදු වෙමින් පවතී.</p>

            <p>💐 දන්සැල් පවත්වන ආකාරය පහත දැක්වේ ☸️</p>

            <div class="pub-ann-schedule">
                <div style="display:flex;align-items:flex-start;gap:.5rem;">
                    <span class="pub-ann-dot">⭕</span>
                    <span>මැයි 30 වෙසක් පොහෝ දින උදෑසන <strong class="pub-ann-time">10.00</strong> සිට කඩල දන්සැල, සරුවත් දන්සැල සහ සවස කිරි තේ සමග පොල් රොටී දන්සැල</span>
                </div>
                <div style="display:flex;align-items:flex-start;gap:.5rem;">
                    <span class="pub-ann-dot">⭕</span>
                    <span>පොහෝ දිනට පසු දින උදෑසන <strong class="pub-ann-time">10.00</strong> සිට මහා බත් දන්සැල හා අයිස්ක්‍රීම් දන්සැල</span>
                </div>
            </div>

            <p>☸️ දන්සැල් කටයුතු සාර්ථකව සිදු කර ගැනීමට පින්වත් ඔබටත් දායක විය හැකිය. ද්‍රව්‍යමය වශයෙන් හෝ මුදල් ආධාරමය වශයෙන් මේ සඳහා දායකත්වය ලබා ගත හැකිය.</p>

            <div class="pub-ann-bank">
                <div class="pub-ann-bank-title">🙏 ගිණුම් විස්තර ✨</div>
                <p style="margin:0;line-height:1.8;">
                    මහමෙව්නාව මහා විහාර උපස්ථාන කමිටුව,
                    <strong class="pub-ann-bank-num">015360000114</strong>,
                    සම්පත් බැංකුව, මාතර ශාඛාවට මුදල් බැර කර එහි රිසිට්පත
                    <strong class="pub-ann-bank-wp">0714978310</strong>
                    අංකය වෙත වට්සැප් කරන්න.
                </p>
            </div>

            <div>
                <p style="margin:0 0 .45rem 0;">✨ දන්සැල සම්බන්ධ සියලු තොරතුරු දැන ගැනීමට පහත දුරකථන අංක අමතන්න.</p>
                <div style="display:flex;flex-direction:column;gap:.3rem;">
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <span>☎️</span>
                        <a href="tel:0710458318" class="pub-ann-phone">0710458318</a>
                        <span class="pub-ann-phone-sub">පින්වත් තිලක ස්වාමින්වහන්සේ</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <span>☎️</span>
                        <a href="tel:0702994214" class="pub-ann-phone">0702994214</a>
                        <span class="pub-ann-phone-sub">/</span>
                        <a href="tel:0701021422" class="pub-ann-phone">0701021422</a>
                        <span class="pub-ann-phone-sub">කුමාර</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <span>☎️</span>
                        <a href="tel:0714978310" class="pub-ann-phone">0714978310</a>
                        <span class="pub-ann-phone-sub">දනුෂ්ක</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Footer --}}
        <div class="pub-ann-footer">
            <p>🌷 "බාරගෙන" ඉතිරිවී ඇති ද්‍රව්‍ය ප්‍රමාණය මෙසේය. 🌷</p>
        </div>
    </div>

    {{-- ══ STATS ══════════════════════════════════════════ --}}
    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:.75rem;margin-bottom:1.5rem;">
        <div class="pub-stat-card">
            <div class="pub-stat-val" style="color:#10b981;">{{ $totalItems }}</div>
            <div class="pub-stat-lbl">මුළු භාණ්ඩ</div>
        </div>
        <div class="pub-stat-card">
            <div class="pub-stat-val" style="color:#38bdf8;">{{ $totalPledges }}</div>
            <div class="pub-stat-lbl">මුළු පොරොන්දු</div>
        </div>
        <div class="pub-stat-card">
            <div class="pub-stat-val" style="color:#fbbf24;">{{ $totalDonors }}</div>
            <div class="pub-stat-lbl">දායකයන්</div>
        </div>
        <div class="pub-stat-card">
            <div class="pub-stat-val" style="color:{{ $fulfilledItems === $totalItems && $totalItems > 0 ? '#10b981' : '#f87171' }};">
                {{ $fulfilledItems }}/{{ $totalItems }}
            </div>
            <div class="pub-stat-lbl">සම්පූර්ණ</div>
        </div>
        <div class="pub-stat-card" style="grid-column:span 2;">
            <div style="display:flex;align-items:center;justify-content:space-between;gap:.5rem;">
                <div>
                    <div class="pub-stat-val" style="color:#fb923c;text-align:left;">{{ $totalCash }}</div>
                    <div class="pub-stat-lbl" style="text-align:left;">සල්ලි දායකයන්</div>
                </div>
                @if($totalCashAmount > 0)
                <div style="text-align:right;">
                    <div style="font-size:1.1rem;font-weight:800;color:#fb923c;line-height:1.1;">
                        රු. {{ number_format($totalCashAmount, 2) }}
                    </div>
                    <div class="pub-stat-lbl">මුළු මුදල</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ══ SEARCH + SORT + FILTER ══════════════════════════ --}}
    <form method="GET" action="" id="filterForm">
        <div class="pub-search-wrap" style="margin-bottom:.6rem;">
            <svg style="position:absolute;left:.75rem;top:50%;transform:translateY(-50%);width:1rem;height:1rem;color:#6b7280;pointer-events:none;"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
            <input type="search" name="q" value="{{ $search }}"
                   placeholder="භාණ්ඩ සොයන්න..."
                   class="pub-search"
                   onchange="document.getElementById('filterForm').submit()" />
        </div>

        {{-- Sort chips --}}
        <div class="pub-chips">
            <a href="{{ request()->fullUrlWithQuery(['s'=>'pct_asc','f'=>$filter,'q'=>$search]) }}"
               class="pub-chip {{ $sort==='pct_asc' ? 'active' : '' }}">↑ අඩු fill</a>
            <a href="{{ request()->fullUrlWithQuery(['s'=>'pct_desc','f'=>$filter,'q'=>$search]) }}"
               class="pub-chip {{ $sort==='pct_desc' ? 'active' : '' }}">↓ වැඩි fill</a>
            <a href="{{ request()->fullUrlWithQuery(['s'=>'name','f'=>$filter,'q'=>$search]) }}"
               class="pub-chip {{ $sort==='name' ? 'active' : '' }}">A-Z නම</a>

            <div class="pub-divider-v"></div>

            <a href="{{ request()->fullUrlWithQuery(['f'=>'all','s'=>$sort,'q'=>$search]) }}"
               class="pub-chip {{ $filter==='all' ? 'active' : '' }}">සියල්ල</a>
            <a href="{{ request()->fullUrlWithQuery(['f'=>'red','s'=>$sort,'q'=>$search]) }}"
               class="pub-chip {{ $filter==='red' ? 'active-red' : '' }}">⚠ අවශ්‍ය</a>
            <a href="{{ request()->fullUrlWithQuery(['f'=>'amber','s'=>$sort,'q'=>$search]) }}"
               class="pub-chip {{ $filter==='amber' ? 'active-amber' : '' }}">⏳ ක්‍රියාත්මක</a>
            <a href="{{ request()->fullUrlWithQuery(['f'=>'green','s'=>$sort,'q'=>$search]) }}"
               class="pub-chip {{ $filter==='green' ? 'active-green' : '' }}">✓ සම්පූර්ණ</a>
        </div>
    </form>

    <p style="font-size:.72rem;color:#6b7280;margin:.6rem 0 1rem;">
        {{ $totalCount }} භාණ්ඩ · පිටුව {{ $page }}/{{ $totalPages }}
        @if(filled($search)) · "{{ $search }}" @endif
    </p>

    {{-- ══ ITEM PROGRESS SECTION ══════════════════════════ --}}
    <div class="pub-section-title">භාණ්ඩ ප්‍රගතිය</div>

    @if($items->isEmpty())
        <div style="text-align:center;padding:3rem 1rem;color:#6b7280;">
            <div style="font-size:2.5rem;margin-bottom:.5rem;">📦</div>
            <p style="font-weight:600;color:#9ca3af;">භාණ්ඩ නොමැත</p>
            @if(filled($search))<p style="font-size:.8rem;margin-top:.25rem;">"{{ $search }}" සඳහා ප්‍රතිඵල නොමැත</p>@endif
        </div>
    @else
        <div style="display:grid;grid-template-columns:1fr;gap:.85rem;">
            @foreach ($items as $item)
                @php
                    $pct = $item->percentage;
                    if ($pct >= 100) {
                        $cardCls='pub-card--green'; $glowClr='#10b981'; $fillCls='pub-fill--green';
                        $badgeCls='pub-badge--green'; $pctClr='#34d399'; $remClr='#34d399';
                        $icon='✓'; $label='සම්පූර්ණයි';
                    } elseif ($pct >= 50) {
                        $cardCls='pub-card--amber'; $glowClr='#f59e0b'; $fillCls='pub-fill--amber';
                        $badgeCls='pub-badge--amber'; $pctClr='#fbbf24'; $remClr='#fbbf24';
                        $icon='⏳'; $label='ක්‍රියාත්මකයි';
                    } else {
                        $cardCls='pub-card--red'; $glowClr='#ef4444'; $fillCls='pub-fill--red';
                        $badgeCls='pub-badge--red'; $pctClr='#f87171'; $remClr='#f87171';
                        $icon='⚠'; $label='දායකත්ව අවශ්‍යයි';
                    }
                @endphp

                <div class="pub-item-card {{ $cardCls }}">
                    <div class="pub-glow" style="width:130px;height:130px;right:-30px;top:-30px;background:{{ $glowClr }};"></div>

                    <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:.35rem;">
                        <div style="min-width:0;flex:1;padding-right:.5rem;">
                            <p class="pub-item-name" style="font-size:1rem;font-weight:700;line-height:1.3;">{{ $item->name }}</p>
                            <span class="pub-badge {{ $badgeCls }}" style="margin-top:.3rem;">{{ $icon }} {{ $label }}</span>
                        </div>
                        <span style="font-size:1.4rem;font-weight:800;color:{{ $pctClr }};flex-shrink:0;">{{ $pct }}%</span>
                    </div>

                    <div class="pub-prog-track">
                        <div class="pub-prog-fill progress-bar {{ $fillCls }}" style="width:{{ $pct }}%"></div>
                    </div>

                    <div class="pub-stats-grid">
                        <div class="pub-mini-stat">
                            <div class="pub-mini-lbl">අවශ්‍ය</div>
                            <div class="pub-mini-val" style="color:var(--text-main);">{{ number_format($item->required_quantity,1) }}</div>
                            <div class="pub-mini-unit">{{ $item->unit }}</div>
                        </div>
                        <div class="pub-mini-stat">
                            <div class="pub-mini-lbl">ලැබුණු</div>
                            <div class="pub-mini-val" style="color:#34d399;">{{ number_format($item->total_pledged_qty,1) }}</div>
                            <div class="pub-mini-unit">{{ $item->unit }}</div>
                        </div>
                        <div class="pub-mini-stat">
                            <div class="pub-mini-lbl">ඉතිරි</div>
                            <div class="pub-mini-val" style="color:{{ $remClr }};">{{ number_format($item->remaining_qty,1) }}</div>
                            <div class="pub-mini-unit">{{ $item->unit }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- ══ PAGINATION ══════════════════════════════════════ --}}
    @if($totalPages > 1)
    @php
        $pStart = max(1, $page - 2);
        $pEnd   = min($totalPages, $page + 2);
        // Build URL helper
        $baseParams = array_filter(['q'=>$search,'s'=>$sort,'f'=>$filter], fn($v)=>$v!==''&&$v!=='all'&&$v!=='pct_asc');
    @endphp
    <div style="display:flex;align-items:center;justify-content:center;gap:.4rem;margin:1.25rem 0 .5rem;flex-wrap:wrap;">

        {{-- Prev --}}
        @if($page > 1)
        <a href="{{ request()->fullUrlWithQuery(array_merge($baseParams, ['page'=>$page-1])) }}"
           style="display:flex;align-items:center;justify-content:center;width:2.2rem;height:2.2rem;border-radius:50%;
                  background:var(--chip-bg);border:1px solid var(--chip-border);color:var(--text-main);
                  text-decoration:none;font-size:.9rem;transition:all .15s;">‹</a>
        @else
        <span style="display:flex;align-items:center;justify-content:center;width:2.2rem;height:2.2rem;border-radius:50%;
                     background:var(--mini-bg);border:1px solid var(--mini-border);color:var(--text-muted);font-size:.9rem;">‹</span>
        @endif

        @if($pStart > 1)
            <a href="{{ request()->fullUrlWithQuery(array_merge($baseParams, ['page'=>1])) }}"
               style="min-width:2.2rem;height:2.2rem;border-radius:10px;padding:0 .5rem;display:flex;align-items:center;justify-content:center;
                      background:var(--chip-bg);border:1px solid var(--chip-border);color:var(--chip-color);
                      text-decoration:none;font-size:.75rem;font-weight:600;">1</a>
            @if($pStart > 2)<span style="color:var(--text-muted);font-size:.75rem;">…</span>@endif
        @endif

        @for($i = $pStart; $i <= $pEnd; $i++)
            <a href="{{ request()->fullUrlWithQuery(array_merge($baseParams, ['page'=>$i])) }}"
               style="min-width:2.2rem;height:2.2rem;border-radius:10px;padding:0 .5rem;display:flex;align-items:center;justify-content:center;
                      background:{{ $i===$page ? 'rgba(16,185,129,.2)' : 'var(--chip-bg)' }};
                      border:1px solid {{ $i===$page ? 'rgba(16,185,129,.5)' : 'var(--chip-border)' }};
                      color:{{ $i===$page ? '#10b981' : 'var(--chip-color)' }};
                      text-decoration:none;font-size:.75rem;font-weight:{{ $i===$page ? '700' : '600' }};
                      transition:all .15s;">{{ $i }}</a>
        @endfor

        @if($pEnd < $totalPages)
            @if($pEnd < $totalPages - 1)<span style="color:var(--text-muted);font-size:.75rem;">…</span>@endif
            <a href="{{ request()->fullUrlWithQuery(array_merge($baseParams, ['page'=>$totalPages])) }}"
               style="min-width:2.2rem;height:2.2rem;border-radius:10px;padding:0 .5rem;display:flex;align-items:center;justify-content:center;
                      background:var(--chip-bg);border:1px solid var(--chip-border);color:var(--chip-color);
                      text-decoration:none;font-size:.75rem;font-weight:600;">{{ $totalPages }}</a>
        @endif

        {{-- Next --}}
        @if($page < $totalPages)
        <a href="{{ request()->fullUrlWithQuery(array_merge($baseParams, ['page'=>$page+1])) }}"
           style="display:flex;align-items:center;justify-content:center;width:2.2rem;height:2.2rem;border-radius:50%;
                  background:var(--chip-bg);border:1px solid var(--chip-border);color:var(--text-main);
                  text-decoration:none;font-size:.9rem;transition:all .15s;">›</a>
        @else
        <span style="display:flex;align-items:center;justify-content:center;width:2.2rem;height:2.2rem;border-radius:50%;
                     background:var(--mini-bg);border:1px solid var(--mini-border);color:var(--text-muted);font-size:.9rem;">›</span>
        @endif
    </div>
    <p style="text-align:center;font-size:.65rem;color:var(--text-muted);margin-bottom:.5rem;">
        පිටුව {{ $page }} / {{ $totalPages }} &nbsp;·&nbsp; මුළු {{ $totalCount }} භාණ්ඩ
    </p>
    @endif

    {{-- ══ RECENT PLEDGES ══════════════════════════════════ --}}
    <div class="pub-section-title" id="pledges">මෑත පොරොන්දු</div>

    @if($recentPledges->isEmpty())
        <p style="text-align:center;color:#6b7280;padding:2rem 0;font-size:.85rem;">පොරොන්දු නොමැත</p>
    @else
        <div style="display:flex;flex-direction:column;gap:.5rem;">
            @foreach($recentPledges as $pledge)
                <div class="pub-pledge-card">
                    <div style="min-width:0;flex:1;">
                        <div class="pub-pledge-name">{{ $pledge->donor_name }}</div>
                        @if($pledge->items->count() > 0)
                            <div class="pub-pledge-item">
                                @foreach($pledge->items as $item)
                                    <span style="display:inline-block;margin-right:.5rem;">
                                        {{ $item->name }} · 
                                        <strong style="color:#10b981;">
                                            {{ $item->pivot->pledged_quantity ? number_format($item->pivot->pledged_quantity, 2) : '?' }}
                                        </strong>
                                        {{ $item->unit }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <div class="pub-pledge-item">—</div>
                        @endif
                        <div style="font-size:.62rem;color:var(--text-muted);margin-top:.2rem;">
                            {{ $pledge->updated_at->format('d M Y, h:i A') }}
                        </div>
                    </div>
                    @if($pledge->items->count() > 0)
                        <div style="text-align:right;">
                            <div style="font-size:.75rem;font-weight:700;color:#10b981;">
                                {{ $pledge->items->count() }} භාණ්ඩ
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Pledge pagination --}}
        @if($pledgePages > 1)
        @php $ppStart=max(1,$pledgePage-2); $ppEnd=min($pledgePages,$pledgePage+2); @endphp
        <div style="display:flex;align-items:center;justify-content:center;gap:.4rem;margin:1rem 0 .5rem;flex-wrap:wrap;">
            @if($pledgePage>1)
            <a href="{{ request()->fullUrlWithQuery(['pp'=>$pledgePage-1]) }}#pledges"
               style="display:flex;align-items:center;justify-content:center;width:2.2rem;height:2.2rem;border-radius:50%;
                      background:var(--chip-bg);border:1px solid var(--chip-border);color:var(--text-main);text-decoration:none;font-size:.9rem;">‹</a>
            @else
            <span style="display:flex;align-items:center;justify-content:center;width:2.2rem;height:2.2rem;border-radius:50%;
                         background:var(--mini-bg);border:1px solid var(--mini-border);color:var(--text-muted);font-size:.9rem;">‹</span>
            @endif
            @if($ppStart>1)
                <a href="{{ request()->fullUrlWithQuery(['pp'=>1]) }}#pledges" style="min-width:2.2rem;height:2.2rem;border-radius:10px;padding:0 .5rem;display:flex;align-items:center;justify-content:center;background:var(--chip-bg);border:1px solid var(--chip-border);color:var(--chip-color);text-decoration:none;font-size:.75rem;font-weight:600;">1</a>
                @if($ppStart>2)<span style="color:var(--text-muted);font-size:.75rem;">…</span>@endif
            @endif
            @for($i=$ppStart;$i<=$ppEnd;$i++)
                <a href="{{ request()->fullUrlWithQuery(['pp'=>$i]) }}#pledges"
                   style="min-width:2.2rem;height:2.2rem;border-radius:10px;padding:0 .5rem;display:flex;align-items:center;justify-content:center;
                          background:{{ $i===$pledgePage?'rgba(16,185,129,.2)':'var(--chip-bg)' }};
                          border:1px solid {{ $i===$pledgePage?'rgba(16,185,129,.5)':'var(--chip-border)' }};
                          color:{{ $i===$pledgePage?'#10b981':'var(--chip-color)' }};
                          text-decoration:none;font-size:.75rem;font-weight:{{ $i===$pledgePage?'700':'600' }};">{{ $i }}</a>
            @endfor
            @if($ppEnd<$pledgePages)
                @if($ppEnd<$pledgePages-1)<span style="color:var(--text-muted);font-size:.75rem;">…</span>@endif
                <a href="{{ request()->fullUrlWithQuery(['pp'=>$pledgePages]) }}#pledges" style="min-width:2.2rem;height:2.2rem;border-radius:10px;padding:0 .5rem;display:flex;align-items:center;justify-content:center;background:var(--chip-bg);border:1px solid var(--chip-border);color:var(--chip-color);text-decoration:none;font-size:.75rem;font-weight:600;">{{ $pledgePages }}</a>
            @endif
            @if($pledgePage<$pledgePages)
            <a href="{{ request()->fullUrlWithQuery(['pp'=>$pledgePage+1]) }}#pledges"
               style="display:flex;align-items:center;justify-content:center;width:2.2rem;height:2.2rem;border-radius:50%;
                      background:var(--chip-bg);border:1px solid var(--chip-border);color:var(--text-main);text-decoration:none;font-size:.9rem;">›</a>
            @else
            <span style="display:flex;align-items:center;justify-content:center;width:2.2rem;height:2.2rem;border-radius:50%;
                         background:var(--mini-bg);border:1px solid var(--mini-border);color:var(--text-muted);font-size:.9rem;">›</span>
            @endif
        </div>
        <p style="text-align:center;font-size:.65rem;color:var(--text-muted);margin-bottom:.5rem;">
            පිටුව {{ $pledgePage }} / {{ $pledgePages }} &nbsp;·&nbsp; මුළු {{ $pledgeTotal }} පොරොන්දු
        </p>
        @endif
    @endif

    {{-- ══ CASH DONATIONS ═════════════════════════════════ --}}
    <div class="pub-section-title" id="cash">සල්ලි දායකත්ව</div>

    {{-- Cash search + sort --}}
    <form method="GET" action="" id="cashForm" style="margin-bottom:.75rem;">
        {{-- preserve item section params --}}
        @if(filled($search))<input type="hidden" name="q" value="{{ $search }}">@endif
        @if($sort !== 'pct_asc')<input type="hidden" name="s" value="{{ $sort }}">@endif
        @if($filter !== 'all')<input type="hidden" name="f" value="{{ $filter }}">@endif

        <div class="pub-search-wrap" style="margin-bottom:.55rem;">
            <svg style="position:absolute;left:.75rem;top:50%;transform:translateY(-50%);width:1rem;height:1rem;color:var(--text-sub);pointer-events:none;"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
            </svg>
            <input type="search" name="cq" value="{{ $cashSearch }}"
                   placeholder="නම, දුරකථනය, සටහන සොයන්න..."
                   class="pub-search"
                   onchange="document.getElementById('cashForm').submit()" />
        </div>

        <div class="pub-chips">
            <a href="{{ request()->fullUrlWithQuery(['cq'=>$cashSearch,'cs'=>'newest']) }}"
               class="pub-chip {{ $cashSort==='newest' ? 'active':'' }}">🕐 අලුත්</a>
            <a href="{{ request()->fullUrlWithQuery(['cq'=>$cashSearch,'cs'=>'oldest']) }}"
               class="pub-chip {{ $cashSort==='oldest' ? 'active':'' }}">🕰 පැරණි</a>
            <a href="{{ request()->fullUrlWithQuery(['cq'=>$cashSearch,'cs'=>'name']) }}"
               class="pub-chip {{ $cashSort==='name' ? 'active':'' }}">A-Z නම</a>
            <a href="{{ request()->fullUrlWithQuery(['cq'=>$cashSearch,'cs'=>'amount_desc']) }}"
               class="pub-chip {{ $cashSort==='amount_desc' ? 'active':'' }}">↓ මුදල</a>
            <a href="{{ request()->fullUrlWithQuery(['cq'=>$cashSearch,'cs'=>'amount_asc']) }}"
               class="pub-chip {{ $cashSort==='amount_asc' ? 'active':'' }}">↑ මුදල</a>
        </div>
    </form>

    <p style="font-size:.72rem;color:var(--text-muted);margin-bottom:.75rem;">
        {{ $cashDonations->count() }} සල්ලි දායකයන්
        @if(filled($cashSearch)) · "{{ $cashSearch }}" @endif
    </p>

    @if($cashDonations->isEmpty())
        <p style="text-align:center;color:var(--text-muted);padding:1.5rem 0;font-size:.85rem;">
            @if(filled($cashSearch)) "{{ $cashSearch }}" සඳහා ප්‍රතිඵල නොමැත
            @else සල්ලි දායකත්ව නොමැත @endif
        </p>
    @else
        <div style="display:flex;flex-direction:column;gap:.75rem;margin-bottom:1rem;">
            @foreach($cashDonations as $cd)
            @php $accent = $cd->id % 6; @endphp
            <div style="
                position:relative;overflow:hidden;border-radius:20px;
                border:1px solid rgba(255,255,255,.07);
                border-left:3px solid rgba(251,146,60,.5);
                background:linear-gradient(135deg,#1a0a00 0%,#0f172a 70%);
                transition:transform .15s;
            " class="html-not-dark-cash-card">
                {{-- Glow --}}
                <div style="position:absolute;border-radius:50%;filter:blur(50px);pointer-events:none;
                            opacity:.12;width:130px;height:130px;right:-30px;top:-30px;
                            background:#f97316;"></div>

                <div style="position:relative;padding:1rem 1rem .85rem;">
                    {{-- Row 1: name + amount --}}
                    <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:.4rem;">
                        <div style="min-width:0;flex:1;padding-right:.5rem;">
                            <p style="font-size:1rem;font-weight:700;color:var(--text-main);line-height:1.2;">
                                {{ $cd->donor_name }}
                            </p>
                            @if($cd->donor_mobile)
                                <p style="font-size:.72rem;color:var(--text-sub);display:flex;align-items:center;gap:.3rem;margin-top:.2rem;">
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
                                <div style="font-size:1.2rem;font-weight:800;color:#fb923c;line-height:1.1;">
                                    රු.{{ number_format($cd->amount, 2) }}
                                </div>
                            @else
                                <div style="font-size:.75rem;color:var(--text-muted);background:rgba(255,255,255,.05);
                                            padding:.2rem .5rem;border-radius:999px;border:1px solid rgba(255,255,255,.08);">
                                    මුදල නැත
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($cd->donor_address)
                        <p style="font-size:.7rem;color:var(--text-muted);display:flex;align-items:flex-start;gap:.35rem;margin-bottom:.4rem;">
                            <svg style="width:.7rem;height:.7rem;flex-shrink:0;margin-top:.1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $cd->donor_address }}
                        </p>
                    @endif

                    @if($cd->note)
                        <p style="font-size:.7rem;color:var(--text-sub);font-style:italic;
                                  background:rgba(255,255,255,.04);border-radius:8px;
                                  padding:.3rem .6rem;margin-bottom:.4rem;">
                            "{{ $cd->note }}"
                        </p>
                    @endif

                    <p style="font-size:.62rem;color:var(--text-muted);margin-top:.3rem;">
                        {{ $cd->created_at->format('d M Y, h:i A') }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Cash total --}}
        @if($totalCashAmount > 0)
        <div style="
            background:rgba(251,146,60,.08);border:1px solid rgba(251,146,60,.2);
            border-radius:14px;padding:.75rem 1rem;
            display:flex;align-items:center;justify-content:space-between;
            margin-bottom:1rem;
        ">
            <span style="font-size:.78rem;color:var(--text-sub);font-weight:600;">
                මුළු සල්ලි දායකත්ව ({{ $totalCash }})
            </span>
            <span style="font-size:1.1rem;font-weight:800;color:#fb923c;">
                රු. {{ number_format($totalCashAmount, 2) }}
            </span>
        </div>
        @endif
    @endif

    {{-- Cash pagination --}}
    @if($cashPages > 1)
    @php $cpStart=max(1,$cashPage-2); $cpEnd=min($cashPages,$cashPage+2); @endphp
    <div style="display:flex;align-items:center;justify-content:center;gap:.4rem;margin:1rem 0 .5rem;flex-wrap:wrap;">
        @if($cashPage>1)
        <a href="{{ request()->fullUrlWithQuery(['cp'=>$cashPage-1]) }}#cash"
           style="display:flex;align-items:center;justify-content:center;width:2.2rem;height:2.2rem;border-radius:50%;
                  background:var(--chip-bg);border:1px solid var(--chip-border);color:var(--text-main);text-decoration:none;font-size:.9rem;">‹</a>
        @else
        <span style="display:flex;align-items:center;justify-content:center;width:2.2rem;height:2.2rem;border-radius:50%;
                     background:var(--mini-bg);border:1px solid var(--mini-border);color:var(--text-muted);font-size:.9rem;">‹</span>
        @endif
        @if($cpStart>1)
            <a href="{{ request()->fullUrlWithQuery(['cp'=>1]) }}#cash" style="min-width:2.2rem;height:2.2rem;border-radius:10px;padding:0 .5rem;display:flex;align-items:center;justify-content:center;background:var(--chip-bg);border:1px solid var(--chip-border);color:var(--chip-color);text-decoration:none;font-size:.75rem;font-weight:600;">1</a>
            @if($cpStart>2)<span style="color:var(--text-muted);font-size:.75rem;">…</span>@endif
        @endif
        @for($i=$cpStart;$i<=$cpEnd;$i++)
            <a href="{{ request()->fullUrlWithQuery(['cp'=>$i]) }}#cash"
               style="min-width:2.2rem;height:2.2rem;border-radius:10px;padding:0 .5rem;display:flex;align-items:center;justify-content:center;
                      background:{{ $i===$cashPage?'rgba(249,115,22,.2)':'var(--chip-bg)' }};
                      border:1px solid {{ $i===$cashPage?'rgba(249,115,22,.5)':'var(--chip-border)' }};
                      color:{{ $i===$cashPage?'#fb923c':'var(--chip-color)' }};
                      text-decoration:none;font-size:.75rem;font-weight:{{ $i===$cashPage?'700':'600' }};">{{ $i }}</a>
        @endfor
        @if($cpEnd<$cashPages)
            @if($cpEnd<$cashPages-1)<span style="color:var(--text-muted);font-size:.75rem;">…</span>@endif
            <a href="{{ request()->fullUrlWithQuery(['cp'=>$cashPages]) }}#cash" style="min-width:2.2rem;height:2.2rem;border-radius:10px;padding:0 .5rem;display:flex;align-items:center;justify-content:center;background:var(--chip-bg);border:1px solid var(--chip-border);color:var(--chip-color);text-decoration:none;font-size:.75rem;font-weight:600;">{{ $cashPages }}</a>
        @endif
        @if($cashPage<$cashPages)
        <a href="{{ request()->fullUrlWithQuery(['cp'=>$cashPage+1]) }}#cash"
           style="display:flex;align-items:center;justify-content:center;width:2.2rem;height:2.2rem;border-radius:50%;
                  background:var(--chip-bg);border:1px solid var(--chip-border);color:var(--text-main);text-decoration:none;font-size:.9rem;">›</a>
        @else
        <span style="display:flex;align-items:center;justify-content:center;width:2.2rem;height:2.2rem;border-radius:50%;
                     background:var(--mini-bg);border:1px solid var(--mini-border);color:var(--text-muted);font-size:.9rem;">›</span>
        @endif
    </div>
    <p style="text-align:center;font-size:.65rem;color:var(--text-muted);margin-bottom:.5rem;">
        පිටුව {{ $cashPage }} / {{ $cashPages }} &nbsp;·&nbsp; මුළු {{ $cashTotal }} දායකයන්
    </p>
    @endif

    {{-- ══ LEGEND ══════════════════════════════════════════ --}}
    <div style="display:flex;flex-wrap:wrap;gap:.75rem;margin-top:1.5rem;font-size:.72rem;color:#6b7280;">
        <span style="display:flex;align-items:center;gap:.4rem;">
            <span style="width:.65rem;height:.65rem;border-radius:50%;background:#10b981;display:inline-block;"></span> සම්පූර්ණ (≥100%)
        </span>
        <span style="display:flex;align-items:center;gap:.4rem;">
            <span style="width:.65rem;height:.65rem;border-radius:50%;background:#f59e0b;display:inline-block;"></span> ක්‍රියාත්මක (50–99%)
        </span>
        <span style="display:flex;align-items:center;gap:.4rem;">
            <span style="width:.65rem;height:.65rem;border-radius:50%;background:#ef4444;display:inline-block;"></span> දායකත්ව අවශ්‍යයි (&lt;50%)
        </span>
    </div>

</main>

{{-- ══ FOOTER ══════════════════════════════════════════════ --}}
<footer class="pub-footer">
    © {{ date('Y') }} සියලු හිමිකම් ඇවිරිණි &nbsp;|&nbsp;
    <a href="https://www.mahamevnawa.lk" target="_blank" rel="noopener">මහමෙව්නාව භාවනා අසපුව</a>
</footer>

<script>
function toggleTheme() {
    const html = document.documentElement;
    const isDark = html.classList.contains('dark');
    html.classList.toggle('dark', !isDark);
    localStorage.setItem('pub-theme', isDark ? 'light' : 'dark');
    document.getElementById('themeIcon').textContent = isDark ? '☀️' : '🌙';
}

// Set correct icon on load
(function() {
    const t = localStorage.getItem('pub-theme') || 'dark';
    document.getElementById('themeIcon').textContent = t === 'dark' ? '🌙' : '☀️';
})();
</script>

</body>
</html>
