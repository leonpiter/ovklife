/**
 * OVKLife Landing — Ленивая загрузка
 *
 * IntersectionObserver для отложенной загрузки изображений.
 * Изображения с атрибутом data-src подгружаются при
 * приближении к viewport.
 */

/**
 * Инициализация ленивой загрузки
 */
export function initLazyLoad() {
  const lazyImages = document.querySelectorAll('img[data-src]');

  if (lazyImages.length === 0) {
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src;
          img.removeAttribute('data-src');
          img.classList.remove('lazy');
          observer.unobserve(img);
        }
      });
    },
    {
      rootMargin: '200px 0px',
    }
  );

  lazyImages.forEach((img) => observer.observe(img));
}
