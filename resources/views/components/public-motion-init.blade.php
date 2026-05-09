{{-- Scroll-in for #main-content direct children. Above-the-fold gets visible class immediately (no flash). --}}
<script>
(function () {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  var main = document.getElementById('main-content');
  if (!main) return;
  var kids = main.children;
  var vh = window.innerHeight || document.documentElement.clientHeight;
  var margin = vh * 0.08;
  var revealables = [];

  function markVisible(el) {
    el.classList.add('sahara-reveal--visible');
  }

  for (var i = 0; i < kids.length; i++) {
    var el = kids[i];
    if (!el || el.nodeType !== 1) continue;
    if (el.tagName === 'SCRIPT' || el.tagName === 'NOSCRIPT') continue;
    if (el.getAttribute('data-sahara-skip-reveal') === '1') continue;
    el.classList.add('sahara-reveal');
    revealables.push(el);
  }

  // Read layout in a separate frame after class writes to avoid forced reflow.
  requestAnimationFrame(function () {
    for (var r = 0; r < revealables.length; r++) {
      var rect = revealables[r].getBoundingClientRect();
      if (rect.top < vh - margin && rect.bottom > 0) {
        markVisible(revealables[r]);
      }
    }
  });

  if (!('IntersectionObserver' in window)) return;

  var io = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        markVisible(entry.target);
        io.unobserve(entry.target);
      });
    },
    { root: null, rootMargin: '0px 0px -4% 0px', threshold: 0.05 }
  );

  for (var j = 0; j < revealables.length; j++) {
    var c = revealables[j];
    if (!c.classList.contains('sahara-reveal--visible')) io.observe(c);
  }
})();
</script>
