# Sprint-01: Фундамент — дизайн-система и инфраструктура

> **Статус:** ✅ Готов (07.04.2026)
> **Ветка:** `feature/sprint-01-foundation`
> **Зависимости:** нет (первый спринт)
> **Результат:** дизайн-гайд, CSS-инфраструктура, Vite-конфиг для лендингов, SEO-модуль

---

## Контекст

Сайт OVKLife мигрирует с Tilda на WordPress. Перед вёрсткой главной страницы нужно заложить фундамент: извлечь дизайн-токены из Tilda-экспорта, создать CSS-архитектуру для лендингов (vanilla CSS, без Tailwind), настроить Vite для раздельной сборки и подготовить SEO-инфраструктуру.

**Источник дизайна:** `ovk-life/page128203106.html` (Tilda-экспорт, ~700KB)
**Тема WordPress:** `wp-content/themes/ovklife/`

---

## Ключевые решения

| Решение | Обоснование |
|---------|-------------|
| Vanilla CSS для лендингов, Tailwind для внутренних | Pixel-perfect контроль лендингов + быстрая разработка внутренних |
| BEM-методология | Предсказуемость, отсутствие конфликтов с Tailwind |
| CSS Custom Properties как дизайн-токены | Единый стиль между лендингами, легко менять |
| Условная загрузка ассетов | Лендинги не грузят Tailwind, внутренние не грузят landing CSS |
| Mobile-first, breakpoints 320/640/1200px | Совпадает с Tilda, покрывает все устройства |

---

## Дизайн-токены (из Tilda-экспорта)

### Цвета
- `--color-dark: #1e180e` — навигация, подвал
- `--color-text: #2c2929` — основной текст
- `--color-text-secondary: #4d4646` — вторичный текст
- `--color-light: #fafafa` — светлый фон
- `--color-accent: #3a2e1b` — hover-акцент
- `--color-white: #ffffff`
- Градиент заголовков: `radial-gradient(ellipse at 44.23% 45.24%, rgba(78,66,50,1), rgba(42,37,28,1))`

### Типографика
- Шрифт: Inter (Google Fonts) — wght 300/400/500/600/700
- H1: 43px / weight 500 / spacing -3px / line-height 0.9
- Body: 14px / weight 500 / spacing -0.5px
- Small: 12px / spacing -0.4px

### Компоненты
- Кнопки: border-radius 15px, box-shadow 0 0 20px rgba(0,0,0,0.2)
- Карточки: border-radius 20-30px
- Контейнер: max-width 1200px, padding 60px

---

## Чеклист задач

### 1. Дизайн-гайд
- [x] Создать `docs/design-guide.md` — цвета, типографика, компоненты, отступы, иконки
- [x] Задокументировать все SVG-иконки из `ovk-life/images/*.svg`

### 2. CSS-инфраструктура
- [x] Создать `assets/css/landing/base.css` — CSS Custom Properties, reset, типографика
- [x] Создать `assets/css/landing/components.css` — кнопки, формы, карточки
- [x] Создать `assets/css/landing/layouts/nav.css` — навигация
- [x] Создать `assets/css/landing/layouts/footer.css` — подвал
- [x] Создать пустые файлы секций в `assets/css/landing/sections/`

### 3. JS-инфраструктура
- [x] Создать `assets/js/landing/main.js` — entry point (импорт модулей)
- [x] Создать пустые модули: slider.js, smooth-scroll.js, lazy-load.js, animations.js, mobile-menu.js

### 4. Vite-конфигурация
- [x] Обновить `vite.config.js` — добавить landing entry points
- [x] Проверить `npm run build` — сборка обоих entry points

### 5. WordPress-инфраструктура
- [x] Обновить `inc/enqueue.php` — функция `ovklife_is_landing_page()` + условная загрузка
- [x] Создать `inc/seo.php` — Organization + LocalBusiness JSON-LD, мета-теги
- [x] Создать `inc/landing-helpers.php` — утилиты для лендингов
- [x] Обновить `functions.php` — подключить новые модули

### 6. Изображения
- [x] Скопировать `ovk-life/images/` → `assets/images/landing/`
- [x] Переименовать ключевые SVG: logo-icon.svg, logo-text.svg, telegram.svg
- [ ] Оптимизировать SVG (удалить лишние атрибуты) *(Sprint-04)*

### 7. Проверка
- [x] `npm run build` — сборка без ошибок
- [x] `npm run validate` — PHPCS, ESLint, Stylelint, Prettier — 0 ошибок
- [x] Файлы в manifest.json: landing + landing-style entries

---

## Файлы для создания/модификации

| Файл | Действие |
|------|----------|
| `docs/design-guide.md` | СОЗДАТЬ |
| `assets/css/landing/base.css` | СОЗДАТЬ |
| `assets/css/landing/components.css` | СОЗДАТЬ |
| `assets/css/landing/layouts/nav.css` | СОЗДАТЬ |
| `assets/css/landing/layouts/footer.css` | СОЗДАТЬ |
| `assets/css/landing/sections/*.css` | СОЗДАТЬ (6 пустых) |
| `assets/js/landing/main.js` | СОЗДАТЬ |
| `assets/js/landing/*.js` | СОЗДАТЬ (5 модулей) |
| `assets/images/landing/` | СОЗДАТЬ (копия) |
| `vite.config.js` | МОДИФИЦИРОВАТЬ |
| `inc/enqueue.php` | МОДИФИЦИРОВАТЬ |
| `inc/seo.php` | СОЗДАТЬ |
| `inc/landing-helpers.php` | СОЗДАТЬ |
| `functions.php` | МОДИФИЦИРОВАТЬ |

---

## Результат спринта

После завершения Sprint-01:
- Дизайн-гайд зафиксирован в документации
- CSS-инфраструктура готова для вёрстки секций
- Vite собирает landing и Tailwind ассеты раздельно
- SEO-модуль выводит базовую Schema.org разметку
- Изображения из Tilda скопированы и оптимизированы
