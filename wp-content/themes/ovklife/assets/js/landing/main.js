/**
 * OVKLife Landing — Главный JS-модуль
 *
 * Entry point для Vite. Импортирует CSS и JS-модули лендинга.
 * Инициализация модулей при DOMContentLoaded.
 */

/* Импорт CSS для Vite HMR */
import '../../css/landing/base.css';

/* Импорт модулей (наполняются в Sprint-02 и Sprint-03) */
import { initMobileMenu } from './mobile-menu.js';
import { initSmoothScroll } from './smooth-scroll.js';
import { initSlider } from './slider.js';
import { initLazyLoad } from './lazy-load.js';
import { initAnimations } from './animations.js';

/**
 * Инициализация всех модулей лендинга
 */
function initLanding() {
  initMobileMenu();
  initSmoothScroll();
  initSlider();
  initLazyLoad();
  initAnimations();
}

/* Запуск при готовности DOM */
document.addEventListener('DOMContentLoaded', initLanding);
