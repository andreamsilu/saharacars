/* CTA: both stops dark enough for white label text (WCAG AA ≥4.5:1) */
.cta-gradient { background-color: #8a6528; }
.section-editorial { padding-top: 7rem; padding-bottom: 5rem; }
.section-editorial-compact { padding-top: 4rem; padding-bottom: 3rem; }
@media (min-width: 768px) {
  .section-editorial { padding-top: 8rem; padding-bottom: 6rem; }
  .section-editorial-compact { padding-top: 6rem; padding-bottom: 4rem; }
}

/*
 * Public pages with fixed <x-mobile-nav /> need bottom padding so content clears the bar
 * and iOS safe-area (home indicator). Hidden on md+ where bottom nav is not shown.
 */
.pb-mobile-nav {
  padding-bottom: calc(5.5rem + env(safe-area-inset-bottom, 0px));
}
@media (min-width: 768px) {
  .pb-mobile-nav {
    padding-bottom: 0;
  }
}

/*
 * Shared subtle border utility used by inputs, selects, chips, and pills.
 * Explicitly themed to avoid browser/Tailwind default blue focus styling.
 */
.ghost-border {
  border: 1px solid rgba(195, 198, 209, 0.9);
}

:is(input, select, textarea).ghost-border:focus,
:is(input, select, textarea).ghost-border:focus-visible {
  border-color: rgba(138, 101, 40, 0.55);
  box-shadow: 0 0 0 2px rgba(138, 101, 40, 0.14);
}
