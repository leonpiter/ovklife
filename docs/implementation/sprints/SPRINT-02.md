# Sprint-02: Лейаут лендинга — header, footer, каркас front-page

> **Статус:** ⏳ Ожидает
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
- [ ] Создать `header-landing.php` — `<!DOCTYPE>`, `<head>`, `wp_head()`, `<body>`
- [ ] Верстка навигации: бургер-кнопка (BEM: `.landing-nav`, `.landing-nav__burger`)
- [ ] Верстка выдвижной панели: меню, телефон, Telegram, кнопка закрытия
- [ ] CSS: `assets/css/landing/layouts/nav.css` — стили навигации
- [ ] JS: `assets/js/landing/mobile-menu.js` — открытие/закрытие, overlay

### 2. Footer лендинга
- [ ] Создать `footer-landing.php` — `wp_footer()`, `</body>`, `</html>`
- [ ] Верстка: контакты (телефон, Telegram), копирайт, соцссылки
- [ ] CSS: `assets/css/landing/layouts/footer.css`

### 3. Front-page каркас
- [ ] Создать `front-page.php` — подключение header/footer + секции через `get_template_part()`
- [ ] Создать `template-parts/landing/` директорию
- [ ] Создать заглушки для 6 секций (section-hero.php, section-objects.php, и т.д.)

### 4. Smooth-scroll
- [ ] `assets/js/landing/smooth-scroll.js` — плавная прокрутка к якорям (#obekty, #uslugi, и т.д.)

### 5. Проверка
- [ ] Открыть главную в браузере — header и footer отображаются
- [ ] Бургер-меню открывается/закрывается
- [ ] Якорные ссылки скроллят к секциям
- [ ] Адаптивность: 320px, 640px, 1200px
- [ ] `npm run validate` — 0 ошибок

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
