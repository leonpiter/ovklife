# Sprint-02: Лейаут лендинга — header, footer, каркас front-page

> **Статус:** ✅ Готов (07.04.2026)
> **Ветка:** `feature/sprint-02-landing-layout`
> **Зависимости:** Sprint-01 (CSS-инфраструктура, дизайн-токены)
> **Результат:** рабочий каркас главной страницы с навигацией и подвалом

---

## Контекст

CSS-инфраструктура и дизайн-токены готовы (Sprint-01). Теперь нужно создать лейаут лендинга: навигацию с бургер-меню (по Tilda-дизайну), подвал с контактами и Telegram, каркас front-page.php со всеми секциями.

**Дизайн навигации (из Tilda):**
- Бургер-меню (справа сверху, белые полоски на прозрачном фоне)
- Выдвижная панель справа (фон #1e180e, max-width 300px)
- Пункты: Объекты, Этапы работ, Услуги, Пример проекта
- Телефон: +7 (921) 947-46-93
- Telegram: @engineer_integrator

---

## Ключевые решения

| Решение | Обоснование |
|---------|-------------|
| Отдельный header-landing.php | Не конфликтует с Tailwind header.php для внутренних страниц |
| Vanilla JS для мобильного меню | Никаких зависимостей, минимальный размер |
| `get_header('landing')` | WordPress convention для альтернативных header |
| Фиксированный header при скролле | Как в оригинале Tilda |

---

## Чеклист задач

### 1. Header лендинга
- [x] Создать `header-landing.php` — `<!DOCTYPE>`, `<head>`, `wp_head()`, `<body>`
- [x] Верстка навигации: бургер-кнопка (BEM: `.landing-nav`, `.landing-nav__burger`)
- [x] Верстка выдвижной панели: меню, телефон, Telegram, кнопка закрытия
- [x] CSS: `assets/css/landing/layouts/nav.css` — стили навигации
- [x] JS: `assets/js/landing/mobile-menu.js` — открытие/закрытие, overlay, Escape

### 2. Footer лендинга
- [x] Создать `footer-landing.php` — `wp_footer()`, `</body>`, `</html>`
- [x] Верстка: контакты (телефон, Telegram), копирайт, навигация
- [x] CSS: `assets/css/landing/layouts/footer.css` — sticky footer на desktop

### 3. Front-page каркас
- [x] Создать `front-page.php` — подключение header/footer + секции через `get_template_part()`
- [x] Создать `template-parts/landing/` директорию
- [x] Создать заглушки для 6 секций (section-hero.php, section-objects.php, и т.д.)

### 4. Smooth-scroll
- [x] `assets/js/landing/smooth-scroll.js` — плавная прокрутка к якорям с offset для фиксированного header

### 5. Проверка
- [x] Открыть главную в браузере — header и footer отображаются
- [x] Бургер-меню открывается/закрывается
- [x] Якорные ссылки скроллят к секциям
- [x] Адаптивность: 320px, 640px, 1200px
- [x] `npm run validate` — PHPCS, ESLint, Stylelint, Prettier — 0 ошибок

---

## Файлы для создания/модификации

| Файл | Действие |
|------|----------|
| `header-landing.php` | СОЗДАТЬ |
| `footer-landing.php` | СОЗДАТЬ |
| `front-page.php` | СОЗДАТЬ |
| `template-parts/landing/section-hero.php` | СОЗДАТЬ (заглушка) |
| `template-parts/landing/section-objects.php` | СОЗДАТЬ (заглушка) |
| `template-parts/landing/section-stages.php` | СОЗДАТЬ (заглушка) |
| `template-parts/landing/section-services.php` | СОЗДАТЬ (заглушка) |
| `template-parts/landing/section-case-study.php` | СОЗДАТЬ (заглушка) |
| `template-parts/landing/section-contact.php` | СОЗДАТЬ (заглушка) |
| `assets/css/landing/layouts/nav.css` | НАПОЛНИТЬ |
| `assets/css/landing/layouts/footer.css` | НАПОЛНИТЬ |
| `assets/js/landing/mobile-menu.js` | НАПОЛНИТЬ |
| `assets/js/landing/smooth-scroll.js` | НАПОЛНИТЬ |

---

## Результат спринта

После завершения Sprint-02:
- Главная страница открывается в WordPress с правильным header/footer
- Навигация работает (бургер-меню, якорные ссылки)
- Секции — заглушки, готовые для наполнения в Sprint-03
