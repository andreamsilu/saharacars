{{-- Fixed control: appears after scroll; left side clears WhatsApp (right). --}}
<button
    type="button"
    id="sahara-scroll-to-top"
    class="fixed z-50 left-4 sm:left-5 bottom-[calc(5.75rem+env(safe-area-inset-bottom,0px))] md:bottom-8 md:left-8 w-12 h-12 sm:w-14 sm:h-14 min-w-[48px] min-h-[48px] sm:min-w-[56px] sm:min-h-[56px] rounded-full bg-primary text-on-primary shadow-xl shadow-primary/25 flex items-center justify-center transition-[opacity,transform,filter,visibility] duration-200 opacity-0 translate-y-2 pointer-events-none invisible focus-ring-on-dark focus-visible:outline-offset-4 hover:brightness-110 active:scale-95 touch-manipulation"
    aria-hidden="true"
    tabindex="-1"
    aria-label="Back to top"
>
    <span class="material-symbols-outlined text-[26px] sm:text-[28px]" aria-hidden="true">arrow_upward</span>
</button>
<script>
(function () {
    var btn = document.getElementById('sahara-scroll-to-top');
    if (!btn) return;

    var threshold = 320;

    function setVisible(show) {
        btn.classList.toggle('opacity-0', !show);
        btn.classList.toggle('opacity-100', show);
        btn.classList.toggle('translate-y-2', !show);
        btn.classList.toggle('translate-y-0', show);
        btn.classList.toggle('pointer-events-none', !show);
        btn.classList.toggle('invisible', !show);
        btn.classList.toggle('visible', show);
        btn.setAttribute('aria-hidden', show ? 'false' : 'true');
        btn.setAttribute('tabindex', show ? '0' : '-1');
    }

    function onScroll() {
        setVisible(window.scrollY > threshold);
    }

    btn.addEventListener('click', function () {
        var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        window.scrollTo({ top: 0, behavior: reduce ? 'auto' : 'smooth' });
        var main = document.getElementById('main-content');
        if (main) {
            try {
                main.focus({ preventScroll: true });
            } catch (e) {
                main.focus();
            }
        }
    });

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
})();
</script>
