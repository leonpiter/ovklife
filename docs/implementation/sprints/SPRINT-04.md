# Sprint-04: SEO-оптимизация и производительность

> **Статус:** ⏳ Ожидает
> **Ветка:** `feature/sprint-04-seo-performance`
> **Зависимости:** Sprint-03 (свёрстанная главная)
> **Результат:** Lighthouse > 90 по всем метрикам, Schema.org разметка, Core Web Vitals в зелёной зоне

---

## Контекст

Главная страница свёрстана (Sprint-03). Теперь — техническая SEO-оптимизация для максимального ранжирования в Яндекс и Google. Цель: обогнать конкурентов (boiler-spb, amikta, sh365) по Core Web Vitals и технической SEO-подготовке.

---

## Ключевые решения

| Решение | Обоснование |
|---------|-------------|
| Schema.org через JSON-LD | Google рекомендует, rich snippets в выдаче |
| WebP + fallback через `<picture>` | -30-50% размер изображений |
| Critical CSS inline | Ускорение First Contentful Paint |
| Preload ключевых ресурсов | LCP < 2.5s |

---

## Чеклист задач

### 1. Schema.org JSON-LD
- [ ] Organization — на всех страницах (название, лого, контакты, соцсети)
- [ ] LocalBusiness — на главной (адрес СПб, телефон, часы работы, зона обслуживания)
- [ ] Service — для каждой услуги в секции
- [ ] BreadcrumbList — хлебные крошки
- [ ] Проверить через Google Rich Results Test

### 2. Meta-теги
- [ ] `<title>` — «OVK Life — Инженерные системы для загородного дома | СПб и ЛО»
- [ ] `<meta description>` — уникальное описание с ключевыми словами
- [ ] Open Graph (og:title, og:description, og:image, og:url, og:type)
- [ ] Canonical URL
- [ ] Yandex/Google verification (перенести из Tilda)

### 3. Оптимизация изображений
- [ ] Конвертировать JPG → WebP (сохранить оригиналы как fallback)
- [ ] Сжать все изображения (quality 80-85%)
- [ ] Добавить `srcset` для адаптивных размеров (320w, 640w, 1200w)
- [ ] `<picture>` элементы с WebP + JPG fallback
- [ ] `loading="lazy"` для изображений ниже fold
- [ ] `width` и `height` атрибуты на всех `<img>` (CLS)
- [ ] `fetchpriority="high"` на Hero-изображении (LCP)

### 4. Critical CSS
- [ ] Извлечь critical CSS для above-the-fold контента
- [ ] Inline в `<head>` через PHP
- [ ] Остальной CSS — async загрузка

### 5. JS-оптимизация
- [ ] `defer` на всех скриптах
- [ ] Минимизация через Vite
- [ ] Проверить: нет блокирующего JS

### 6. Preload / Preconnect
- [ ] `<link rel="preconnect" href="https://fonts.googleapis.com">`
- [ ] `<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>`
- [ ] `<link rel="preload">` для Hero-изображения
- [ ] `<link rel="preload">` для шрифта Inter (основные начертания)

### 7. Технический SEO
- [ ] XML Sitemap (через WordPress или кастомный)
- [ ] robots.txt (разрешить индексацию, указать sitemap)
- [ ] Favicon (перенести из Tilda SVG)
- [ ] 404 страница (уже есть, проверить)

### 8. Кастомная страница 404
- [ ] Создать `404.php` — кастомная страница ошибки
- [ ] Содержимое: заголовок, поисковая строка, ссылки на основные разделы (Услуги, Проекты, Блог, Контакты)
- [ ] CSS-стили для 404 (минимальные, в base.css или отдельный файл)
- [ ] Schema.org: не нужна на 404, но canonical убрать

### 9. Компонент хлебных крошек
- [ ] Создать `template-parts/common/breadcrumbs.php` — переиспользуемый компонент
- [ ] PHP-функция `ovklife_breadcrumbs()` в `inc/breadcrumbs.php`
- [ ] BreadcrumbList JSON-LD Schema генерируется автоматически
- [ ] Поддержка: страницы, CPT service (иерархия), CPT project, записи блога
- [ ] Подключить в `functions.php`

### 10. Accessibility (a11y) базовый чеклист
- [ ] ARIA-роли: `role="navigation"`, `role="main"`, `role="banner"`, `role="contentinfo"`
- [ ] `alt` атрибуты на всех `<img>` (описательные, не пустые)
- [ ] Контрастность текста: WCAG AA (минимум 4.5:1 для обычного текста)
- [ ] Фокус-менеджмент: видимый outline на интерактивных элементах
- [ ] Keyboard navigation: Tab/Enter/Escape для бургер-меню и модальных окон
- [ ] `<html lang="ru">` в header
- [ ] Skip-to-content ссылка для скринридеров

### 11. Телефонные ссылки
- [ ] Все номера телефонов обёрнуты в `<a href="tel:+79219474693">`
- [ ] `itemprop="telephone"` в Schema.org разметке
- [ ] Click-to-call работает на мобильных

### 12. Тестирование
- [ ] Lighthouse: Performance > 90
- [ ] Lighthouse: SEO > 95
- [ ] Lighthouse: Accessibility > 90
- [ ] Lighthouse: Best Practices > 90
- [ ] Google PageSpeed Insights: Core Web Vitals зелёные
- [ ] Google Rich Results Test: Schema.org валидна
- [ ] Yandex Webmaster: проверить страницу
- [ ] Кастомная 404 отображается при неверном URL
- [ ] Хлебные крошки отображаются корректно
- [ ] `npm run validate` — 0 ошибок

---

## Файлы для создания/модификации

| Файл | Действие |
|------|----------|
| `inc/seo.php` | НАПОЛНИТЬ (Schema.org, meta) |
| `header-landing.php` | МОДИФИЦИРОВАТЬ (preload, critical CSS, meta) |
| `template-parts/landing/section-hero.php` | МОДИФИЦИРОВАТЬ (picture, srcset) |
| `template-parts/landing/section-objects.php` | МОДИФИЦИРОВАТЬ (lazy loading, srcset) |
| `assets/images/landing/*.webp` | СОЗДАТЬ (конвертация) |
| `404.php` | СОЗДАТЬ |
| `template-parts/common/breadcrumbs.php` | СОЗДАТЬ |
| `inc/breadcrumbs.php` | СОЗДАТЬ |

---

## Результат спринта

После завершения Sprint-04:
- Lighthouse > 90 по всем метрикам
- Schema.org проходит валидацию Google
- Core Web Vitals в зелёной зоне (LCP < 2.5s, CLS < 0.1, INP < 200ms)
- Все изображения оптимизированы (WebP + fallback)
- Meta-теги и OG-теги настроены
