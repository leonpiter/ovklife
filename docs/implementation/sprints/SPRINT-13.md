# Sprint-13: Лендинги волна 2 — расширение + A/B оптимизация

> **Статус:** ⏳ Ожидает
> **Ветка:** `feature/sprint-13-ad-landings-wave2`
> **Зависимости:** Sprint-09 (модульные лендинги), Sprint-11 (A/B, UTM, Метрика), Sprint-12 (расширенные услуги)
> **Результат:** 7 дополнительных лендингов, A/B тесты, динамический контент по UTM, конверсионная оптимизация

---

## Контекст

В Sprint-09 создана модульная система лендингов и 5 первых лендингов. В Sprint-11 настроены A/B тестирование, UTM и аналитика. В Sprint-12 добавлены расширенные направления услуг.

Теперь:
1. Создаём 7 новых лендингов через конфигурацию (`landing-config.php`)
2. Внедряем динамическую подмену контента по utm_content
3. Запускаем A/B тесты на основе данных первого раунда (Sprint-11)
4. Добавляем конверсионные элементы (sticky CTA, exit-intent)

---

## Ключевые решения

| Решение | Обоснование |
|---------|-------------|
| Конфигурации в `landing-config.php` | Добавить 7 лендингов = добавить 7 массивов в конфиг |
| override в конфиге | Заголовки подменяются без создания новых шаблонов |
| utm_content → override заголовка | Точное соответствие рекламному объявлению |
| A/B тесты: квиз vs форма | Определить лучший CTA-формат на основе Sprint-11 данных |
| Dynamic import для JS | Code splitting для heavy-модулей (exit-intent, sticky CTA) |

---

## 7 новых лендингов

| URL | Направление | Состав секций |
|-----|------------|---------------|
| `/lp/umniy-dom/` | Умный дом | hero(video) → benefits → pricing → case-study → contact |
| `/lp/avtomatizaciya/` | Автоматизация котельной | hero(engineer) → standards → pricing → team → contact |
| `/lp/videonablyudenie/` | Видеонаблюдение | hero → benefits → services(focused) → objects → contact |
| `/lp/multirum/` | Мультирум | hero(video) → benefits → case-study → pricing → contact |
| `/lp/spa/` | SPA-комплексы | hero → benefits → standards → pricing → team → contact |
| `/lp/septik/` | Септик | hero → benefits → pricing → objects → contact |
| `/lp/kompleks/` | Комплексная интеграция | hero(engineer) → benefits → services → pricing → team → standards → contact |

---

## Чеклист задач

### 1. Создание 7 лендингов
- [ ] Добавить 7 конфигураций в `inc/landing-config.php`
- [ ] Создать 7 страниц в WordPress с шаблоном «Рекламный лендинг»
- [ ] Проверить рендеринг каждого лендинга

### 2. Динамическая подмена контента
- [ ] Создать `inc/dynamic-content.php` — маппинг utm_content → override
- [ ] Подмена H1 по utm_content:
  - `utm_content=price` → «Монтаж отопления от 50 000 руб.»
  - `utm_content=speed` → «Отопление загородного дома за 14 дней»
  - `utm_content=guarantee` → «Отопление с гарантией 5 лет»
- [ ] Подмена CTA-текста по utm_content
- [ ] Fallback на дефолтный заголовок
- [ ] Интеграция через override в `ovklife_landing_section()`

### 3. A/B тесты (второй раунд)
- [ ] Тест: Квиз (Sprint-10) vs Форма обратной связи
  - Вариант A: CTA → квиз
  - Вариант B: CTA → простая форма
- [ ] Тест: Короткий лендинг (Hero + CTA + 3 отзыва) vs Полный лендинг
  - Реализация через разные конфигурации секций
- [ ] Добавить конфигурации тестов в `inc/ab-testing.php`
- [ ] Документация результатов в `docs/ab-tests.md`

### 4. Конверсионная оптимизация
- [ ] Sticky CTA-кнопка на мобильных (фиксированная внизу)
- [ ] CSS: `sticky-cta.css`
- [ ] JS: `sticky-cta.js` (dynamic import, показ после скролла 30%)
- [ ] Exit-intent popup для десктопа (optional)
- [ ] JS: `exit-intent.js` (dynamic import)

### 5. Аналитика
- [ ] Цели Метрики для каждого нового лендинга
- [ ] UTM-трекинг для 7 лендингов
- [ ] Отчёт по первому раунду A/B тестов (Sprint-11)

### 6. Проверка
- [ ] Все 7 лендингов открываются, noindex присутствует
- [ ] Динамическая подмена работает с UTM
- [ ] A/B тесты: варианты переключаются при очистке cookie
- [ ] Sticky CTA на мобильных не перекрывает контент
- [ ] Скорость загрузки < 3 секунд (dynamic import для heavy JS)
- [ ] `npm run validate` — 0 ошибок

---

## Файлы

### СОЗДАТЬ

| Файл | Назначение |
|------|------------|
| `inc/dynamic-content.php` | Маппинг utm_content → override |
| `assets/js/landing/sticky-cta.js` | Sticky CTA на мобильных |
| `assets/js/landing/exit-intent.js` | Exit-intent popup |
| `assets/css/landing/components/sticky-cta.css` | Стили sticky CTA |
| `docs/ab-tests.md` | Документация A/B тестов |

### МОДИФИЦИРОВАТЬ

| Файл | Действие |
|------|----------|
| `inc/landing-config.php` | +7 конфигураций лендингов |
| `inc/ab-testing.php` | +новые конфигурации тестов |
| `functions.php` | +require dynamic-content.php |
| `assets/js/landing/main.js` | +dynamic import sticky-cta, exit-intent |

---

## Результат спринта

После завершения Sprint-13:
- 12 лендингов для Яндекс.Директ (5 из Sprint-09 + 7 новых)
- Динамическая подмена заголовков по utm_content
- A/B тесты второго раунда (квиз vs форма, короткий vs полный)
- Sticky CTA на мобильных
- **Полная инфраструктура для масштабного запуска Яндекс.Директ**
