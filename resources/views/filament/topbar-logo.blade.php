<div style="
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    pointer-events: none;
    z-index: 5;
">
    <img
        src="{{ asset('logo.jpg') }}"
        alt="logo"
        style="
            height: 2rem;
            width: 2rem;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(16, 185, 129, 0.5);
            flex-shrink: 0;
        "
    />
    <a
        href="https://www.mahamevnawa.lk"
        target="_blank"
        rel="noopener noreferrer"
        style="
            pointer-events: all;
            font-size: 0.85rem;
            font-weight: 600;
            color: #10b981;
            text-decoration: none;
            white-space: nowrap;
            letter-spacing: 0.01em;
        "
        onmouseover="this.style.color='#34d399'"
        onmouseout="this.style.color='#10b981'"
    >මහමෙව්නාව</a>
</div>
