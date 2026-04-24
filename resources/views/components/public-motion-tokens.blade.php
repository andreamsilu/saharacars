/* Sahara public motion: subtle entrance, scroll reveal, and hovers. Honor prefers-reduced-motion. */
@keyframes sahara-fade-in-up {
  from { opacity: 0; transform: translate3d(0, 14px, 0); }
  to { opacity: 1; transform: translate3d(0, 0, 0); }
}
@keyframes sahara-fade-in {
  from { opacity: 0; }
  to { opacity: 1; }
}
@keyframes sahara-scale-in {
  from { opacity: 0; transform: scale(0.94); }
  to { opacity: 1; transform: scale(1); }
}

@media (prefers-reduced-motion: no-preference) {
  .sahara-motion-header {
    animation: sahara-fade-in-up 0.48s cubic-bezier(0.22, 1, 0.36, 1) both;
  }
  .sahara-motion-footer {
    animation: sahara-fade-in 0.5s ease-out 0.04s both;
  }
  .sahara-motion-fab {
    animation: sahara-scale-in 0.5s cubic-bezier(0.22, 1, 0.36, 1) 0.18s both;
  }
  .sahara-motion-nav-bottom {
    animation: sahara-fade-in-up 0.42s ease-out 0.12s both;
  }
}

.sahara-card-motion {
  transition: transform 0.28s ease, box-shadow 0.28s ease;
}
@media (prefers-reduced-motion: no-preference) {
  .sahara-card-motion:hover {
    transform: translateY(-2px);
  }
}

/* Intersection-based reveal: applied by public-motion-init to #main-content > * */
.sahara-reveal {
  opacity: 0;
  transform: translate3d(0, 20px, 0);
  transition:
    opacity 0.6s cubic-bezier(0.22, 1, 0.36, 1),
    transform 0.6s cubic-bezier(0.22, 1, 0.36, 1);
}
.sahara-reveal.sahara-reveal--visible {
  opacity: 1;
  transform: translate3d(0, 0, 0);
}
@media (prefers-reduced-motion: reduce) {
  .sahara-reveal {
    opacity: 1;
    transform: none;
    transition: none;
  }
  .sahara-motion-header,
  .sahara-motion-footer,
  .sahara-motion-fab,
  .sahara-motion-nav-bottom {
    animation: none;
  }
}

/* Car grids: light stagger on first paint (cards also scroll inside parent) */
@media (prefers-reduced-motion: no-preference) {
  .sahara-stagger-children > * {
    animation: sahara-fade-in-up 0.42s ease backwards;
  }
  .sahara-stagger-children > *:nth-child(1) { animation-delay: 0.02s; }
  .sahara-stagger-children > *:nth-child(2) { animation-delay: 0.04s; }
  .sahara-stagger-children > *:nth-child(3) { animation-delay: 0.06s; }
  .sahara-stagger-children > *:nth-child(4) { animation-delay: 0.08s; }
  .sahara-stagger-children > *:nth-child(5) { animation-delay: 0.1s; }
  .sahara-stagger-children > *:nth-child(6) { animation-delay: 0.12s; }
  .sahara-stagger-children > *:nth-child(7) { animation-delay: 0.14s; }
  .sahara-stagger-children > *:nth-child(8) { animation-delay: 0.16s; }
  .sahara-stagger-children > *:nth-child(9) { animation-delay: 0.18s; }
  .sahara-stagger-children > *:nth-child(10) { animation-delay: 0.2s; }
  .sahara-stagger-children > *:nth-child(11) { animation-delay: 0.22s; }
  .sahara-stagger-children > *:nth-child(12) { animation-delay: 0.24s; }
  .sahara-stagger-children > *:nth-child(13) { animation-delay: 0.25s; }
  .sahara-stagger-children > *:nth-child(14) { animation-delay: 0.25s; }
  .sahara-stagger-children > *:nth-child(15) { animation-delay: 0.25s; }
  .sahara-stagger-children > *:nth-child(16) { animation-delay: 0.25s; }
  .sahara-stagger-children > *:nth-child(17) { animation-delay: 0.25s; }
  .sahara-stagger-children > *:nth-child(18) { animation-delay: 0.25s; }
  .sahara-stagger-children > *:nth-child(19) { animation-delay: 0.25s; }
  .sahara-stagger-children > *:nth-child(20) { animation-delay: 0.25s; }
  .sahara-stagger-children > *:nth-child(n+21) { animation-delay: 0.26s; }
}
