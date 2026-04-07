# Sprint-11: Аналитика, UTM-трекинг, A/B тестирование и серверная оптимизация

> **Статус:** ⏳ Ожидает
> **Ветка:** `feature/sprint-11-analytics-ab`
> **Зависимости:** Sprint-04 (SEO), Sprint-09 (модульные лендинги), Sprint-10 (квиз)
> **Результат:** Яндекс.Метрика с целями, UTM-трекинг, A/B тестирование секций, .htaccess, SEO мета-бокс
>
> **⚠️ Примечание:** Можно разделить на Sprint-11a (аналитика + UTM + A/B) и Sprint-11b (.htaccess + SEO мета-бокс).

---

## Контекст

После Sprint-09 у нас есть модульная система лендингов с фильтром `ovklife_section_variant`. Sprint-11 подключает A/B тестирование через этот фильтр — **без модификации ядра** (`landing-sections.php`). Cookie определяет вариант, данные уходят в Яндекс.Метрику.

---

## Ключевые решения

| Решение | Обоснование |
|---------|-------------|
| A/B через фильтр `ovklife_section_variant` | Фундамент заложен в Sprint-03, подключаемся без правки ядра |
| Cookie для персистентности A/B | Пользователь видит один вариант на протяжении 30 дней |
| Взвешенный рандом (50/50, 70/30) | Гибкое распределение трафика между вариантами |
| Конфигурация тестов в коде | Массив в `inc/ab-testing.php`, не через БД/админку |
| `wp_localize_script` → Метрика | PHP определяет вариант → JS отправляет в Метрику как параметр визита |
| UTM в cookie (30 дней) | Сохранение источника при повторных визитах |

---

## Архитектура A/B тестирования

### Поток данных

```
Пользователь → любая landing-страница
  → ovklife_resolve_section_variant('hero')
    → фильтр ovklife_section_variant
      → ovklife_ab_section_variant('hero')
        → проверка cookie 'ovklife_ab_hero_video'
          → есть → return сохранённый вариант
          → нет → взвешенный рандом → setcookie → return
  → include sections/hero/{variant}.php
  → wp_localize_script → window.ovklife.abTests
  → JS → ym(ID, 'params', { ab_hero_video: 'video' })
```

### Конфигурация тестов

```php
// inc/ab-testing.php
'hero_video' => [
    'section'  => 'hero',
    'variants' => ['default' => 50, 'video' => 50],  // 50/50
    'active'   => true,
],
'hero_engineer' => [
    'section'  => 'hero',
    'variants' => ['default' => 50, 'engineer' => 50],
    'active'   => false,  // включить после завершения первого теста
],
```

---

## Чеклист задач

### 1. Яндекс.Метрика и аналитика
- [ ] Создать `inc/analytics.php` — модуль аналитики
- [ ] Секция «Аналитика» в `inc/customizer.php`:
  - ID Яндекс.Метрики
  - Код GA4 (опционально)
  - Мета-тег Яндекс.Вебмастер верификации
  - Мета-тег Google Search Console верификации
- [ ] Вывод счётчика Метрики в `wp_footer`
- [ ] Цели Метрики через JS-API:
  - `form_submit` — отправка формы
  - `quiz_complete` — завершение квиза
  - `phone_click` — клик по телефону
  - `telegram_click` — клик по Telegram
  - `scroll_50` / `scroll_100` — глубина скролла

### 2. UTM-трекинг
- [ ] Создать `inc/utm.php`
- [ ] Чтение UTM из URL: utm_source, utm_medium, utm_campaign, utm_content, utm_term
- [ ] Сохранение UTM в cookie (30 дней)
- [ ] Передача UTM в скрытые поля форм
- [ ] Передача UTM в данные квиза (Sprint-10)
- [ ] Передача UTM как параметры визита в Метрику
- [ ] PHP-функция `ovklife_get_utm()`

### 3. A/B тестирование секций лендинга
- [ ] Создать `inc/ab-testing.php`:
  - `ovklife_ab_tests_config()` — конфигурация активных тестов
  - `ovklife_get_ab_variant( $test_name )` — вариант из cookie или рандом
  - `ovklife_weighted_random( $weights )` — взвешенный выбор
  - `ovklife_get_active_ab_tests()` — все активные тесты для JS
  - `ovklife_ab_section_variant()` — фильтр для `ovklife_section_variant`
- [ ] Подключить фильтр: `add_filter( 'ovklife_section_variant', 'ovklife_ab_section_variant', 20, 2 )`
- [ ] Создать `assets/js/landing/ab-tracker.js`:
  - Читает `window.ovklife.abTests`
  - Отправляет `ym(ID, 'params', { ab_hero_video: 'video' })`
- [ ] `wp_localize_script` в enqueue.php — передача abTests + metrikaId + utm в JS
- [ ] Первый тест: Hero default vs Hero video (50/50)

### 4. SEO мета-бокс в админке
- [ ] Создать `inc/meta-boxes.php`
- [ ] Мета-бокс для: post, page, service, project
- [ ] Поля: SEO Title, Meta Description, Focus Keyword, noindex checkbox
- [ ] Nonce-защита при сохранении
- [ ] Интеграция с `inc/seo.php`

### 5. Серверная оптимизация (.htaccess)
- [ ] Gzip/Deflate сжатие (text/html, css, js, json, svg)
- [ ] Browser caching: изображения 30 дней, CSS/JS 7 дней, шрифты 365 дней
- [ ] Security headers: X-Content-Type-Options, X-Frame-Options, Referrer-Policy
- [ ] Запрет доступа к .env, wp-config.php, .git

### 6. Проверка
- [ ] Метрика: счётчик работает, цели срабатывают
- [ ] UTM: сохраняются в cookie, передаются в формы
- [ ] A/B: разные варианты Hero показываются при очистке cookie
- [ ] A/B: данные уходят в Метрику (проверить через devtools → Network)
- [ ] A/B: при повторном визите — тот же вариант (cookie)
- [ ] SEO мета-бокс: title/description в `<head>`
- [ ] .htaccess: gzip и кэш-заголовки
- [ ] `npm run validate` — 0 ошибок

---

## Файлы

### СОЗДАТЬ

| Файл | Назначение |
|------|------------|
| `inc/analytics.php` | Яндекс.Метрика, GA4, цели |
| `inc/utm.php` | UTM-трекинг, cookie, формы |
| `inc/ab-testing.php` | A/B тесты через cookie + фильтр |
| `inc/meta-boxes.php` | SEO мета-бокс в админке |
| `assets/js/landing/ab-tracker.js` | JS-трекинг A/B в Метрику |
| `.htaccess` | Серверная оптимизация |

### МОДИФИЦИРОВАТЬ

| Файл | Действие |
|------|----------|
| `inc/customizer.php` | +секция «Аналитика» |
| `inc/seo.php` | +интеграция с мета-бокс |
| `inc/enqueue.php` | +wp_localize_script (abTests, utm, metrikaId) |
| `functions.php` | +require analytics, utm, ab-testing, meta-boxes |
| `assets/js/landing/main.js` | +import ab-tracker |

---

## Результат спринта

После завершения Sprint-11:
- Яндекс.Метрика с 6 целями конверсий
- UTM-трекинг в cookie → формы → квиз → Метрика
- A/B тестирование секций лендинга (Hero video vs default)
- SEO мета-бокс для всех типов контента
- .htaccess: gzip, кэш, security
- **Готовность к запуску Яндекс.Директ с полным A/B и отслеживанием**
