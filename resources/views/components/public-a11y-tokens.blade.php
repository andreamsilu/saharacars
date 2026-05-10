{{--
  WCAG-oriented baseline (source for sahara-public-tokens.css). Loaded via linked stylesheet on the site.
--}}
  /* Visible focus: links / chromeless controls use brown outline; form fields use .ghost-border (gold) — avoids browser default blue rings. */
  :where(a, button, summary):focus {
    outline: none;
  }
  :where(a, button, summary):focus-visible {
    outline: 2px solid #5c4320;
    outline-offset: 2px;
  }
  :where(input, select, textarea):focus,
  :where(input, select, textarea):focus-visible {
    outline: none;
  }
  /* High-contrast focus on dark / filled buttons (keep offset readable on gold). */
  .focus-ring-on-dark:focus-visible {
    outline: 2px solid #ffffff;
    outline-offset: 3px;
  }
  .focus-ring-inset:focus-visible {
    outline: 2px solid #5c4320;
    outline-offset: -2px;
  }

  @media (prefers-reduced-motion: reduce) {
    html {
      scroll-behavior: auto;
    }
    .partner-track {
      animation: none !important;
    }
    .pulse-chip,
    .float-orb {
      animation: none !important;
    }
    .animate-ping {
      animation: none !important;
    }
  }

  /* 2.4.1 Skip link (after global focus rules so visible styles win). */
  .skip-to-main {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
  }
  .skip-to-main:focus,
  .skip-to-main:focus-visible {
    position: fixed;
    top: 1rem;
    left: 1rem;
    z-index: 99999;
    width: auto;
    height: auto;
    margin: 0;
    padding: 0.75rem 1.25rem;
    clip: auto;
    overflow: visible;
    white-space: normal;
    border-radius: 0.5rem;
    background: #ffffff;
    color: #5c4320;
    font-weight: 700;
    font-size: 0.875rem;
    line-height: 1.25;
    box-shadow: 0 10px 25px rgba(25, 28, 30, 0.15);
    text-decoration: none;
    outline: 3px solid #5c4320;
    outline-offset: 2px;
  }
