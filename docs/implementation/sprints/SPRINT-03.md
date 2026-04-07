# Sprint-03: Вёрстка главной страницы — 6 секций по Tilda-дизайну

> **Статус:** ⏳ Ожидает
> **Ветка:** `feature/sprint-03-homepage-sections`
> **Зависимости:** Sprint-02 (лейаут, header/footer)
> **Результат:** полностью свёрстанная главная страница, pixel-perfect по Tilda

---

## Контекст

Лейаут лендинга готов (Sprint-02). Теперь — основная работа: pixel-perfect вёрстка всех 6 секций главной по Tilda-дизайну. Используем vanilla CSS (BEM), vanilla JS для слайдера и анимаций. Без jQuery, без Tilda-фреймворка.

**Источник:** `ovk-life/page128203106.html` + `ovk-life/files/page128203106body.html`
**Изображения:** `assets/images/landing/` (скопированы в Sprint-01)

---

## Ключевые решения

| Решение | Обоснование |
|---------|-------------|
| Vanilla JS слайдер | Нет зависимости от библиотек, минимальный размер |
| IntersectionObserver для анимаций | Современный API, без лишнего JS |
| `<picture>` + WebP | Оптимизация изображений для Core Web Vitals |
| Семантические `<section>` с id | SEO + якорная навигация |

---

## Секции и контент (из Tilda)

### 1. Hero (#hero)
- Заголовок: «Планируете строительство или дизайн-проект?»
- Подзаголовок: «Подключимся на стадии проекта и рассчитаем систему под ваш дом»
- Кнопка: «Консультация инженера по вашему проекту» (ведёт на #obratnaya-svyaz)
- Слайдер: 13 фотографий объектов (автоплей, свайп на мобильных)
- Блок с телефоном: +7 (921) 947-46-93 с иконкой
- Логотип OVK Life (SVG)

### 2. Объекты (#obekty)
- Галерея/портфолио выполненных проектов
- Карточки с фотографиями и описаниями

### 3. Этапы работ (#ehtapy-rabot)
- Шаги процесса работы с клиентом
- SVG-иконки для каждого этапа
- Нумерация этапов

### 4. Услуги (#uslugi)
- 4 направления: Отопление, Водоснабжение, Вентиляция, Электрика
- SVG-иконки для каждой услуги
- Краткие описания
- Ссылки на будущие страницы услуг

### 5. Пример проекта (#primer-proekta)
- Детальный кейс одного проекта
- Фотографии до/после или процесса
- Параметры объекта

### 6. Обратная связь (#obratnaya-svyaz)
- Призыв к действию
- Телефон, Telegram
- Кнопка связи

---

## Чеклист задач

### Секция 1: Hero
- [ ] Верстка `template-parts/landing/section-hero.php`
- [ ] CSS: `assets/css/landing/sections/hero.css`
- [ ] JS: `assets/js/landing/slider.js` — слайдер с touch-свайпом
- [ ] Адаптивность: 320px / 640px / 1200px
- [ ] Preload Hero-изображения для LCP

### Секция 2: Объекты
- [ ] Верстка `template-parts/landing/section-objects.php`
- [ ] CSS: `assets/css/landing/sections/objects.css`
- [ ] Lazy loading для изображений

### Секция 3: Этапы работ
- [ ] Верстка `template-parts/landing/section-stages.php`
- [ ] CSS: `assets/css/landing/sections/stages.css`
- [ ] SVG-иконки inline или из файлов

### Секция 4: Услуги
- [ ] Верстка `template-parts/landing/section-services.php`
- [ ] CSS: `assets/css/landing/sections/services.css`
- [ ] SVG-иконки для 4 направлений

### Секция 5: Пример проекта
- [ ] Верстка `template-parts/landing/section-case-study.php`
- [ ] CSS: `assets/css/landing/sections/case-study.css`
- [ ] Галерея фотографий проекта

### Секция 6: Обратная связь
- [ ] Верстка `template-parts/landing/section-contact.php`
- [ ] CSS: `assets/css/landing/sections/contact.css`

### Общее
- [ ] `assets/js/landing/animations.js` — scroll-анимации (IntersectionObserver)
- [ ] `assets/js/landing/lazy-load.js` — ленивая загрузка
- [ ] Проверка pixel-perfect: открыть Tilda-экспорт и WordPress рядом
- [ ] Адаптивность всех секций: 320px, 640px, 1200px
- [ ] `npm run validate` — 0 ошибок

---

## Файлы для создания/модификации

| Файл | Действие |
|------|----------|
| `template-parts/landing/section-hero.php` | НАПОЛНИТЬ |
| `template-parts/landing/section-objects.php` | НАПОЛНИТЬ |
| `template-parts/landing/section-stages.php` | НАПОЛНИТЬ |
| `template-parts/landing/section-services.php` | НАПОЛНИТЬ |
| `template-parts/landing/section-case-study.php` | НАПОЛНИТЬ |
| `template-parts/landing/section-contact.php` | НАПОЛНИТЬ |
| `assets/css/landing/sections/*.css` | НАПОЛНИТЬ (6 файлов) |
| `assets/js/landing/slider.js` | НАПОЛНИТЬ |
| `assets/js/landing/animations.js` | НАПОЛНИТЬ |
| `assets/js/landing/lazy-load.js` | НАПОЛНИТЬ |

---

## Результат спринта

После завершения Sprint-03:
- Главная страница полностью свёрстана, визуально совпадает с Tilda
- Слайдер работает (десктоп + touch на мобильных)
- Все секции адаптивны (320px / 640px / 1200px)
- Якорная навигация скроллит к секциям
- Анимации появления при скролле
