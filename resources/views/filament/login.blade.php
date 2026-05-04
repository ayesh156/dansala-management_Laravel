<x-filament-panels::page.simple>

    <style>
        /* Hide Filament's default heading/subheading/logo inside simple layout */
        .fi-simple-header { display: none !important; }

        /* Hide Filament's own footer if it renders one */
        .fi-simple-footer { display: none !important; }

        /* Make the simple layout fill full viewport height */
        .fi-simple-layout {
            min-height: 100dvh !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
            padding: 1rem 1rem 1.5rem 1rem !important;
        }

        /* Card should not grow beyond viewport */
        .fi-simple-main {
            width: 100% !important;
            max-width: 400px !important;
            margin: 0 auto !important;
        }

        /* ── Animated orbs ── */
        @keyframes orbFloat {
            0%,100% { transform: translate(0,0) scale(1); }
            50%      { transform: translate(12px,-18px) scale(1.06); }
        }
        .login-orb {
            position: fixed; border-radius: 50%;
            filter: blur(70px); pointer-events: none; opacity: .13;
            animation: orbFloat 9s ease-in-out infinite;
        }
        .login-orb-1 { width:260px;height:260px;background:#10b981;top:-70px;left:-70px;animation-delay:0s; }
        .login-orb-2 { width:220px;height:220px;background:#6366f1;bottom:-50px;right:-50px;animation-delay:3.5s; }
        .login-orb-3 { width:160px;height:160px;background:#f59e0b;top:45%;left:55%;animation-delay:6s; }

        /* ── Logo block ── */
        .login-logo-block {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .login-logo-ring {
            width: 68px; height: 68px;
            border-radius: 50%;
            padding: 3px;
            background: linear-gradient(135deg, #10b981 0%, #6366f1 100%);
            margin-bottom: .75rem;
            box-shadow: 0 0 28px rgba(16,185,129,.35);
        }
        .login-logo-ring img {
            width: 100%; height: 100%;
            border-radius: 50%; object-fit: cover; display: block;
        }
        .login-brand-sub  { font-size:.7rem; color:#6b7280; letter-spacing:.03em; margin-bottom:.2rem; }
        .login-brand-main { font-size:1.2rem; font-weight:800; color:#f9fafb; text-align:center; line-height:1.3; }

        /* ── Divider ── */
        .login-hr { height:1px; background:rgba(255,255,255,.08); margin:1.1rem 0 1.25rem; }

        /* ── Submit button override ── */
        .login-submit-btn {
            width: 100% !important;
            margin-top: .6rem;
            background: linear-gradient(135deg, #059669, #10b981) !important;
            border: none !important;
            border-radius: 14px !important;
            padding: .8rem 1rem !important;
            font-size: .95rem !important;
            font-weight: 700 !important;
            letter-spacing: .02em !important;
            box-shadow: 0 4px 18px rgba(16,185,129,.35) !important;
            transition: opacity .2s, transform .1s !important;
            color: #fff !important;
        }
        .login-submit-btn:hover  { opacity: .92 !important; }
        .login-submit-btn:active { transform: scale(.98) !important; }

        /* ── Footer text ── */
        .login-foot {
            text-align: center;
            font-size: .68rem;
            color: #4b5563;
            margin-top: 1.4rem;
        }
        .login-foot a { color: #10b981; text-decoration: none; font-weight: 600; }
    </style>

    {{-- Orbs (fixed, behind everything) --}}
    <div class="login-orb login-orb-1"></div>
    <div class="login-orb login-orb-2"></div>
    <div class="login-orb login-orb-3"></div>

    {{-- Tracker icon — top right of card --}}
    <div style="display:flex;justify-content:flex-end;margin-bottom:-.5rem;position:relative;z-index:1;">
        <a href="{{ url('/') }}"
           title="ප්‍රගති නිරීක්ෂණය"
           style="
               display:inline-flex;align-items:center;gap:.35rem;
               padding:.3rem .65rem;border-radius:999px;
               background:rgba(16,185,129,.1);border:1px solid rgba(16,185,129,.25);
               color:#10b981;text-decoration:none;font-size:.68rem;font-weight:600;
               transition:all .2s;
           "
           onmouseover="this.style.background='rgba(16,185,129,.2)';this.style.borderColor='rgba(16,185,129,.45)'"
           onmouseout="this.style.background='rgba(16,185,129,.1)';this.style.borderColor='rgba(16,185,129,.25)'"
        >
            <svg style="width:.75rem;height:.75rem;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            ප්‍රගතිය
        </a>
    </div>

    {{-- Logo + brand --}}
    <div class="login-logo-block">
        <div class="login-logo-ring">
            <img src="{{ asset('logo.jpg') }}" alt="logo" />
        </div>
        <p class="login-brand-sub">දන්සල් කළමනාකරණ පද්ධතිය</p>
        <h1 class="login-brand-main">පද්ධතියට ඇතුළු වන්න</h1>
    </div>

    <div class="login-hr"></div>

    {{-- Form --}}
    <x-filament-panels::form wire:submit="authenticate">
        {{ $this->form }}

        <button type="submit" class="login-submit-btn">
            ඇතුළු වන්න
        </button>
    </x-filament-panels::form>

</x-filament-panels::page.simple>
