/**
 * OVKLife — Главный JavaScript файл.
 *
 * @package OVKLife
 * @since 1.0.0
 */

// Импорт стилей (для Vite HMR).
import '../css/main.css';

/**
 * Мобильное меню.
 */
function initMobileMenu() {
  const menuButton = document.querySelector('[aria-label]');
  const nav = document.querySelector('header nav');

  if (!menuButton || !nav) {
    return;
  }

  menuButton.addEventListener('click', () => {
    nav.classList.toggle('hidden');
    nav.classList.toggle('block');
  });
}

/**
 * Плавная прокрутка к якорям.
 */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', (e) => {
      const targetId = anchor.getAttribute('href');
      if (targetId === '#') {
        return;
      }

      const target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });
}

/**
 * Инициализация при загрузке DOM.
 */
document.addEventListener('DOMContentLoaded', () => {
  initMobileMenu();
  initSmoothScroll();
});
