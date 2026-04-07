/**
 * OVKLife Landing — Scroll-анимации
 *
 * IntersectionObserver для плавного появления элементов
 * при скролле. Класс .animate-in добавляется при попадании
 * элемента в viewport.
 */

/**
 * Инициализация scroll-анимаций
 */
export function initAnimations() {
  const elements = document.querySelectorAll(
    '.stages__problem, .stages__step, .services__card, .objects__slide-info, .case-study__info, .case-study__gallery'
  );

  if (elements.length === 0) {
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-in');
          observer.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.15,
      rootMargin: '0px 0px -40px 0px',
    }
  );

  elements.forEach((el) => {
    el.classList.add('animate-ready');
    observer.observe(el);
  });
}
