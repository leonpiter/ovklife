/**
 * OVKLife Landing — Мобильное меню
 *
 * Бургер-меню с выдвижной панелью справа.
 * Открытие/закрытие панели, overlay, блокировка скролла,
 * закрытие по Escape и клику на якорную ссылку.
 */

/**
 * Инициализация мобильного меню
 */
export function initMobileMenu() {
  const burger = document.querySelector('.landing-nav__burger');
  const menu = document.querySelector('.landing-menu');
  const overlay = document.querySelector('.landing-menu__overlay');
  const closeBtn = document.querySelector('.landing-menu__close');
  const menuLinks = document.querySelectorAll('.landing-menu__link');
  const ctaLink = document.querySelector('.landing-menu__cta');

  if (!burger || !menu) {
    return;
  }

  /**
   * Открыть меню
   */
  function openMenu() {
    menu.classList.add('landing-menu--open');
    document.body.classList.add('menu-open');
    burger.setAttribute('aria-expanded', 'true');

    /* Фокус на кнопку закрытия */
    if (closeBtn) {
      closeBtn.focus();
    }
  }

  /**
   * Закрыть меню
   */
  function closeMenu() {
    menu.classList.remove('landing-menu--open');
    document.body.classList.remove('menu-open');
    burger.setAttribute('aria-expanded', 'false');

    /* Вернуть фокус на бургер */
    burger.focus();
  }

  /* Обработчики событий */
  burger.addEventListener('click', openMenu);

  if (closeBtn) {
    closeBtn.addEventListener('click', closeMenu);
  }

  if (overlay) {
    overlay.addEventListener('click', closeMenu);
  }

  /* Закрытие при клике на якорную ссылку */
  menuLinks.forEach(function (link) {
    link.addEventListener('click', closeMenu);
  });

  if (ctaLink) {
    ctaLink.addEventListener('click', closeMenu);
  }

  /* Закрытие по Escape */
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && menu.classList.contains('landing-menu--open')) {
      closeMenu();
    }
  });

  /* Sticky footer */
  initStickyFooter();
  window.addEventListener('resize', initStickyFooter);
}

/**
 * Sticky footer: устанавливает margin-bottom на main
 * для корректного отображения фиксированного footer на desktop.
 */
function initStickyFooter() {
  const footer = document.querySelector('.landing-footer');
  const main = document.querySelector('.landing-main');

  if (!footer || !main) {
    return;
  }

  if (window.innerWidth >= 1200) {
    const height = footer.offsetHeight;
    main.style.marginBottom = height + 'px';
  } else {
    main.style.marginBottom = '';
  }
}
