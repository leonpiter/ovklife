# Sprint-03: Вёрстка главной + модульная система секций

> **Статус:** ⏳ В работе (07.04.2026)
> **Ветка:** `feature/sprint-03-landing-sections`
> **Зависимости:** Sprint-02 (лейаут, header/footer)
> **Результат:** свёрстанная главная (pixel-perfect по Tilda) + модульная архитектура секций для A/B и рекламных лендингов

---

## Контекст

Лейаут лендинга готов (Sprint-02). Теперь — основная работа:
1. Pixel-perfect вёрстка 6 секций главной по Tilda-дизайну
2. Рефакторинг секций в модульную систему (data.php + вариантные шаблоны)

**Зачем модульность сейчас:** конкурентный анализ (10 отчётов NotebookLM, 8 конкурентов) показал, что нужны A/B тесты Hero-секции, модульная сборка рекламных лендингов, разные варианты секций под целевые аудитории. Фундамент закладываем в Sprint-03, варианты и A/B — в Sprint-09/11.

**Источник дизайна:** `ovk-life/page128203106.html` (Tilda-экспорт)

---

## Ключевые решения

| Решение | Обоснование |
|---------|-------------|
| Vanilla JS слайдер | Нет зависимости от библиотек, минимальный размер |
| IntersectionObserver для анимаций | Современный API, без лишнего JS |
| Семантические `<section>` с id | SEO + якорная навигация |
| **Модульная система секций** | Фундамент для A/B тестов (Sprint-11) и рекламных лендингов (Sprint-09) |
| **Разделение data.php / default.php** | Данные отдельно от вёрстки → легко менять контент для разных лендингов |
| **Proxy-обёртки для обратной совместимости** | `front-page.php` не трогаем |

---

## Часть 1: Модульная система секций

### Архитектура

```
front-page.php
  → get_template_part('section', 'hero')
    → section-hero.php (proxy)
      → ovklife_landing_section('hero')
        → sections/hero/data.php (данные)
        → sections/hero/default.php (шаблон)
```

### Новая структура файлов

```
template-parts/landing/
  section-hero.php              ← proxy: вызывает ovklife_landing_section('hero')
  section-objects.php           ← proxy
  section-stages.php            ← proxy
  section-services.php          ← proxy
  section-case-study.php        ← proxy
  section-contact.php           ← proxy
  sections/
    hero/
      data.php                  ← return ['hero_title' => ..., 'hero_image' => ...]
      default.php               ← HTML-шаблон, использует переменные из data.php
    objects/
      data.php
      default.php
    stages/
      data.php
      default.php
    services/
      data.php
      default.php
    case-study/
      data.php
      default.php
    contact/
      data.php
      default.php
```

### Ядро: `inc/landing-sections.php`

| Функция | Назначение |
|---------|------------|
| `ovklife_landing_section( $section, $variant, $override )` | Загружает data.php + шаблон варианта |
| `ovklife_load_section_data( $section, $override )` | Загружает данные, мержит с override |
| `ovklife_resolve_section_variant( $section )` | Определяет вариант через фильтр `ovklife_section_variant` |
| `ovklife_register_active_section( $section, $variant )` | Регистрирует для будущей условной загрузки CSS/JS |

**Расширяемость:** Sprint-09 подключает конфигурации лендингов, Sprint-11 — A/B через фильтр `ovklife_section_variant`.

---

## Часть 2: Секции и контент (из Tilda)

### 1. Hero (#hero)
- Заголовок: «Инженерные системы частных домов»
- Подзаголовок: описание интеграции
- Кнопка CTA → #obratnaya-svyaz
- Фоновое изображение с overlay
- 2 преимущества с SVG-иконками
- Телефон: +7 (921) 947-46-93

### 2. Объекты (#obekty)
- Слайдер проектов (4 объекта, touch-свайп, автоплей)
- Карточки: фото, площадь, локация, описание

### 3. Этапы работ (#ehtapy-rabot)
- 3 проблемы клиента → решение → 3 шага процесса
- Теги систем (отопление, водоснабжение, электрика, вентиляция, автоматизация)

### 4. Услуги (#uslugi)
- 5 карточек: Отопление, Вентиляция, Электрика, Водоснабжение, Автоматизация
- SVG-иконки, hover-анимация

### 5. Пример проекта (#primer-proekta)
- Кейс объекта (фото, площадь, локация, описание)
- Галерея 3 фотографии (grid)

### 6. Обратная связь (#obratnaya-svyaz)
- CTA-блок с телефоном, email, Telegram

---

## Чеклист задач

### Модульная система
- [ ] Создать `inc/landing-sections.php` (4 функции)
- [ ] Подключить в `functions.php`
- [ ] Создать директории `template-parts/landing/sections/{hero,objects,stages,services,case-study,contact}/`
- [ ] Для каждой секции: извлечь данные в `data.php`, шаблон в `default.php`
- [ ] Обновить 6 proxy-файлов `section-*.php` → вызов `ovklife_landing_section()`

### Секция 1: Hero
- [x] Верстка `section-hero.php` / `sections/hero/default.php`
- [x] CSS: `assets/css/landing/sections/hero.css`
- [x] JS: `assets/js/landing/slider.js`
- [x] Адаптивность: 320px / 640px / 1200px
- [x] Preload Hero-изображения (fetchpriority="high")

### Секция 2: Объекты
- [x] Верстка `section-objects.php` / `sections/objects/default.php`
- [x] CSS: `assets/css/landing/sections/objects.css`
- [x] Lazy loading (data-src + IntersectionObserver)

### Секция 3: Этапы работ
- [x] Верстка `section-stages.php` / `sections/stages/default.php`
- [x] CSS: `assets/css/landing/sections/stages.css`
- [x] SVG-иконки inline через ovklife_svg_icon()

### Секция 4: Услуги
- [x] Верстка `section-services.php` / `sections/services/default.php`
- [x] CSS: `assets/css/landing/sections/services.css`

### Секция 5: Пример проекта
- [x] Верстка `section-case-study.php` / `sections/case-study/default.php`
- [x] CSS: `assets/css/landing/sections/case-study.css`

### Секция 6: Обратная связь
- [x] Верстка `section-contact.php` / `sections/contact/default.php`
- [x] CSS: `assets/css/landing/sections/contact.css`

### Общее
- [x] `assets/js/landing/animations.js` — scroll-анимации
- [x] `assets/js/landing/lazy-load.js` — ленивая загрузка
- [ ] Проверка pixel-perfect: Tilda vs WordPress
- [x] Адаптивность всех секций: 320px, 640px, 1200px
- [ ] `npm run validate` — 0 ошибок

---

## Файлы

### СОЗДАТЬ (13 файлов)

| Файл | Назначение |
|------|------------|
| `inc/landing-sections.php` | Ядро модульной системы |
| `template-parts/landing/sections/hero/data.php` | Данные Hero |
| `template-parts/landing/sections/hero/default.php` | Шаблон Hero |
| `template-parts/landing/sections/objects/data.php` | Данные Объектов |
| `template-parts/landing/sections/objects/default.php` | Шаблон Объектов |
| `template-parts/landing/sections/stages/data.php` | Данные Этапов |
| `template-parts/landing/sections/stages/default.php` | Шаблон Этапов |
| `template-parts/landing/sections/services/data.php` | Данные Услуг |
| `template-parts/landing/sections/services/default.php` | Шаблон Услуг |
| `template-parts/landing/sections/case-study/data.php` | Данные Кейса |
| `template-parts/landing/sections/case-study/default.php` | Шаблон Кейса |
| `template-parts/landing/sections/contact/data.php` | Данные Контактов |
| `template-parts/landing/sections/contact/default.php` | Шаблон Контактов |

### МОДИФИЦИРОВАТЬ (7 файлов)

| Файл | Действие |
|------|----------|
| `functions.php` | +1 строка require landing-sections.php |
| `template-parts/landing/section-hero.php` | Заменить на proxy (3 строки) |
| `template-parts/landing/section-objects.php` | Заменить на proxy |
| `template-parts/landing/section-stages.php` | Заменить на proxy |
| `template-parts/landing/section-services.php` | Заменить на proxy |
| `template-parts/landing/section-case-study.php` | Заменить на proxy |
| `template-parts/landing/section-contact.php` | Заменить на proxy |

### НЕ ТРОГАТЬ

`front-page.php`, `base.css`, `main.js`, `vite.config.js`, `header-landing.php`, `footer-landing.php`

---

## Результат спринта

После завершения Sprint-03:
- Главная страница полностью свёрстана, визуально совпадает с Tilda
- Модульная система секций: data.php + вариантные шаблоны
- Фильтр `ovklife_section_variant` готов для A/B (Sprint-11)
- Обратная совместимость: `front-page.php` не изменён
- Слайдер, анимации, lazy-load работают
- Все секции адаптивны (320px / 640px / 1200px)
