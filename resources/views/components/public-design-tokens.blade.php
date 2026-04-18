/* CTA: both stops dark enough for white label text (WCAG AA ≥4.5:1) */
.cta-gradient { background-image: linear-gradient(135deg, #5c4320, #8a6528); }
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
