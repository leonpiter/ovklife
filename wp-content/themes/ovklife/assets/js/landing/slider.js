/**
 * OVKLife Landing — Слайдер
 *
 * Vanilla JS слайдер для секции «Объекты» с touch-свайпом,
 * автоплеем и навигацией.
 */

/**
 * Инициализация слайдера
 */
export function initSlider() {
  const slider = document.querySelector('.objects__slider');
  if (!slider) {
    return;
  }

  const track = slider.querySelector('.objects__slider-track');
  const slides = slider.querySelectorAll('.objects__slide');
  const prevBtn = slider.querySelector('.objects__slider-prev');
  const nextBtn = slider.querySelector('.objects__slider-next');
  const dotsContainer = slider.querySelector('.objects__slider-dots');

  if (!track || slides.length === 0) {
    return;
  }

  let currentIndex = 0;
  let startX = 0;
  let currentX = 0;
  let isDragging = false;
  const totalSlides = slides.length;

  /* Создание точек навигации */
  if (dotsContainer) {
    slides.forEach((_, i) => {
      const dot = document.createElement('button');
      dot.type = 'button';
      dot.className = 'objects__slider-dot';
      dot.setAttribute('aria-label', `Слайд ${i + 1}`);
      if (i === 0) {
        dot.classList.add('objects__slider-dot--active');
      }
      dot.addEventListener('click', () => goToSlide(i));
      dotsContainer.appendChild(dot);
    });
  }

  const dots = dotsContainer ? dotsContainer.querySelectorAll('.objects__slider-dot') : [];

  /**
   * Переход к слайду по индексу
   *
   * @param {number} index Индекс слайда.
   */
  function goToSlide(index) {
    currentIndex = ((index % totalSlides) + totalSlides) % totalSlides;
    track.style.transform = `translateX(-${currentIndex * 100}%)`;
    updateDots();
  }

  /**
   * Обновление активной точки навигации
   */
  function updateDots() {
    dots.forEach((dot, i) => {
      dot.classList.toggle('objects__slider-dot--active', i === currentIndex);
    });
  }

  /* Кнопки навигации */
  if (prevBtn) {
    prevBtn.addEventListener('click', () => goToSlide(currentIndex - 1));
  }
  if (nextBtn) {
    nextBtn.addEventListener('click', () => goToSlide(currentIndex + 1));
  }

  /* Touch-свайп */
  track.addEventListener(
    'touchstart',
    (e) => {
      isDragging = true;
      startX = e.touches[0].clientX;
    },
    { passive: true }
  );

  track.addEventListener(
    'touchmove',
    (e) => {
      if (!isDragging) {
        return;
      }
      currentX = e.touches[0].clientX;
    },
    { passive: true }
  );

  track.addEventListener('touchend', () => {
    if (!isDragging) {
      return;
    }
    isDragging = false;
    const diff = startX - currentX;
    const threshold = 50;

    if (diff > threshold) {
      goToSlide(currentIndex + 1);
    } else if (diff < -threshold) {
      goToSlide(currentIndex - 1);
    }
  });

  /* Автоплей */
  let autoplayInterval = setInterval(() => goToSlide(currentIndex + 1), 5000);

  slider.addEventListener('mouseenter', () => clearInterval(autoplayInterval));
  slider.addEventListener('mouseleave', () => {
    autoplayInterval = setInterval(() => goToSlide(currentIndex + 1), 5000);
  });
}
