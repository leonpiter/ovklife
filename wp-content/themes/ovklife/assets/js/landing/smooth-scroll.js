/**
 * OVKLife Landing — Плавная прокрутка
 *
 * Якорная навигация к секциям (#obekty, #uslugi и т.д.)
 * с учётом высоты фиксированной навигации.
 */

/** Высота навигации для offset при скролле (px) */
const NAV_HEIGHT = 60;

/**
 * Инициализация плавной прокрутки
 */
export function initSmoothScroll() {
  document.addEventListener('click', handleAnchorClick);
}

/**
 * Обработчик клика по якорной ссылке
 *
 * @param {Event} event — событие клика
 */
function handleAnchorClick(event) {
  const link = event.target.closest('a[href^="#"]');

  if (!link) {
    return;
  }

  const targetId = link.getAttribute('href');

  if (!targetId || targetId === '#') {
    return;
  }

  const target = document.querySelector(targetId);

  if (!target) {
    return;
  }

  event.preventDefault();

  const offsetTop = target.getBoundingClientRect().top + window.pageYOffset - NAV_HEIGHT;

  window.scrollTo({
    top: offsetTop,
    behavior: 'smooth',
  });
}
