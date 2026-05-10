.material-symbols-outlined {
  font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
}
body {
  text-rendering: optimizeLegibility;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  font-feature-settings: "cv11", "ss01";
  overflow-wrap: anywhere;
}
h1, h2, h3, .font-headline {
  letter-spacing: -0.015em;
  line-height: 1.15;
}
.font-label {
  font-weight: 600;
  letter-spacing: 0.02em;
}
input, select, textarea, button {
  font-weight: 500;
}

/*
 * Editorial scale — matches Why Sahara (why-choose-us): hero intro, section titles, kickers.
 * Use with semantic color tokens (e.g. text-on-surface-variant, text-secondary) in markup.
 */
.text-editorial-body {
  font-size: 1rem;
  line-height: 1.625;
}
@media (min-width: 768px) {
  .text-editorial-body {
    font-size: 1.125rem;
  }
}
@media (min-width: 1024px) {
  .text-editorial-body {
    font-size: 1.25rem;
    line-height: 1.6;
  }
}

.text-editorial-hero {
  font-size: 1.875rem;
  letter-spacing: -0.015em;
  line-height: 1.15;
}
@media (min-width: 640px) {
  .text-editorial-hero {
    font-size: 2.25rem;
  }
}
@media (min-width: 768px) {
  .text-editorial-hero {
    font-size: 3rem;
  }
}

.text-editorial-section-title {
  font-size: 1.5rem;
  letter-spacing: -0.015em;
  line-height: 1.15;
}
@media (min-width: 640px) {
  .text-editorial-section-title {
    font-size: 1.875rem;
  }
}
@media (min-width: 768px) {
  .text-editorial-section-title {
    font-size: 2rem;
  }
}

.text-editorial-kicker {
  font-size: 0.75rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  line-height: 1.25;
}
@media (min-width: 768px) {
  .text-editorial-kicker {
    font-size: 0.875rem;
  }
}
