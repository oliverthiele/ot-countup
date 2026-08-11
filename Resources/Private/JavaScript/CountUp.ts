/**
 * Animates every [data-js="otCountupItem"] element from its data-start to its
 * data-end value once it individually enters the viewport. Each item uses its
 * own IntersectionObserver (not a shared wrapper observer) so that items
 * further down the page still animate on their own when scrolled into view —
 * a shared-wrapper observer would only fire once and leave later items static
 * on narrow (single-column) viewports.
 */
(function () {
  const DEFAULT_DURATION = 2000;
  const OBSERVER_OPTIONS: IntersectionObserverInit = {
    threshold: 0.2,
    rootMargin: '0px 0px -10% 0px',
  };

  const prefersReducedMotion = window.matchMedia
    ? window.matchMedia('(prefers-reduced-motion: reduce)').matches
    : false;

  function easeOutQuad(t: number): number {
    return t * (2 - t);
  }

  function formatValue(element: HTMLElement, value: number): string {
    // Values such as years must stay unformatted (1989, not 1,989).
    if (element.dataset.unformatted === '1') {
      return String(value);
    }

    const locale = document.documentElement.lang || 'de-DE';
    return new Intl.NumberFormat(locale).format(value);
  }

  function setValue(element: HTMLElement, value: number): void {
    element.textContent = formatValue(element, value);
  }

  function animate(element: HTMLElement): void {
    const start = parseInt(element.dataset.start || '', 10) || 0;
    const end = parseInt(element.dataset.end || '', 10) || 0;
    const duration = parseInt(element.dataset.duration || '', 10) || DEFAULT_DURATION;

    if (prefersReducedMotion) {
      setValue(element, end);
      return;
    }

    const startTime = performance.now();

    function step(currentTime: number): void {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);
      const currentValue = Math.round(start + (end - start) * easeOutQuad(progress));

      setValue(element, currentValue);

      if (progress < 1) {
        window.requestAnimationFrame(step);
      }
    }

    window.requestAnimationFrame(step);
  }

  function init(): void {
    const items = document.querySelectorAll<HTMLElement>('[data-js="otCountupItem"]');

    if (!items.length) {
      return;
    }

    items.forEach((item) => {
      setValue(item, parseInt(item.dataset.start || '', 10) || 0);
    });

    if (!('IntersectionObserver' in window)) {
      items.forEach((item) => animate(item));
      return;
    }

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) {
          return;
        }

        observer.unobserve(entry.target);
        animate(entry.target as HTMLElement);
      });
    }, OBSERVER_OPTIONS);

    items.forEach((item) => observer.observe(item));
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
