{{-- Car emoji orbiting a ring during same-origin navigations (public pages). --}}
<div
    id="sahara-page-load-bar"
    class="sahara-pl-root pointer-events-none opacity-0 transition-opacity duration-200 ease-out"
    style="z-index: 100"
    aria-hidden="true"
>
    <div class="sahara-pl-panel">
        <div class="sahara-pl-ring" aria-hidden="true"></div>
        <div class="sahara-pl-orbit">
            <span class="sahara-pl-car" role="img" aria-hidden="true">🚗</span>
        </div>
    </div>
</div>
<style>
    .sahara-pl-root {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 56px;
        height: 56px;
    }
    .sahara-pl-root.is-active {
        opacity: 1;
    }
    .sahara-pl-panel {
        position: relative;
        width: 56px;
        height: 56px;
        border-radius: 9999px;
        background: rgba(255, 255, 255, 0.94);
        box-shadow: 0 10px 28px rgba(25, 28, 30, 0.12), 0 0 0 1px rgba(138, 101, 40, 0.12);
    }
    .sahara-pl-ring {
        position: absolute;
        inset: 0;
        border-radius: 9999px;
        border: 3px solid rgba(138, 101, 40, 0.28);
        border-top-color: #8a6528;
    }
    .sahara-pl-orbit {
        position: absolute;
        inset: 0;
        animation: sahara-pl-orbit 1.35s linear infinite;
    }
    .sahara-pl-car {
        position: absolute;
        left: 50%;
        top: 1px;
        font-size: 1.2rem;
        line-height: 1;
        filter: drop-shadow(0 1px 1px rgba(0, 0, 0, 0.12));
        animation: sahara-pl-car-upright 1.35s linear infinite;
    }
    @keyframes sahara-pl-orbit {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
    @keyframes sahara-pl-car-upright {
        from {
            transform: translateX(-50%) rotate(0deg);
        }
        to {
            transform: translateX(-50%) rotate(-360deg);
        }
    }
    @media (prefers-reduced-motion: reduce) {
        .sahara-pl-orbit,
        .sahara-pl-car {
            animation: none !important;
        }
        .sahara-pl-car {
            transform: translateX(-50%);
        }
    }
</style>
<script src="{{ asset('js/sahara-page-load.min.js') }}" defer></script>
