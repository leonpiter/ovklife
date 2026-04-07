# Sprint-09: Рекламные лендинги — модульная сборка для Яндекс.Директ

> **Статус:** ⏳ Ожидает
> **Ветка:** `feature/sprint-09-ad-landings`
> **Зависимости:** Sprint-03 (модульная система секций), Sprint-08 (форма обратной связи), Sprint-04a (семядро)
> **Результат:** конфигурируемые лендинги из секций-кирпичиков, 5 лендингов под Директ, новые секции из конкурентного анализа

---

## Контекст

В Sprint-03 создана модульная система секций (`inc/landing-sections.php`) с data.php + вариантными шаблонами. Теперь используем этот фундамент для создания рекламных лендингов.

**Ключевое преимущество:** каждый лендинг — конфигурация в коде (массив секций), а НЕ отдельный PHP-файл. Можно быстро собирать новые лендинги из готовых кирпичиков.

**Источник идей:** конкурентный анализ NotebookLM (docs/nlm_q5..q11):
- **tilspb.ru** → аудит сметы, лица команды, лид-магнит PDF
- **sankt-tehnik.ru** → стандарт монтажа, фотофиксация с рулеткой, бирки
- **galf.ru** → 3D BIM-визуализация, пакеты Стандарт/Комфорт/Премиум
- **comf.life** → видео-сценарии, hero с видео-фоном
- **Boiler-SPb** → пакетные цены «под ключ»
- **Амикта** → детальные кейсы с ценами

---

## Ключевые решения

| Решение | Обоснование |
|---------|-------------|
| `inc/landing-config.php` — конфигурации в коде | Контент через код, не через WP-админку. Массив секций для каждого лендинга |
| `templates/landing.php` — WordPress Page Template | Собирает лендинг по конфигу, определяемому slug-ом страницы |
| noindex на лендингах | Не конкурируют с основными SEO-страницами |
| Варианты Hero (default, video, engineer) | A/B тестирование разных подходов (Sprint-11) |
| Новые секции из конкурентного анализа | pricing, team, standards, benefits — лучшее от конкурентов |
| override данных секций | Разные заголовки/тексты для разных лендингов без создания новых шаблонов |

---

## Архитектура

### Поток данных

```
Пользователь → /lp/otoplenie/
  → templates/landing.php
    → ovklife_get_landing_config('otoplenie')
      → foreach config['sections']
        → ovklife_landing_section('hero', 'default', ['hero_title' => '...'])
        → ovklife_landing_section('pricing', 'default')
        → ovklife_landing_section('contact', 'default')
```

### Структура конфигурации лендинга

```php
'otoplenie' => [
    'title'    => 'Монтаж отопления в загородном доме под ключ — OVK Life',
    'noindex'  => true,
    'sections' => [
        ['section' => 'hero', 'variant' => 'default', 'override' => ['hero_title' => '...']],
        ['section' => 'benefits'],
        ['section' => 'pricing'],
        ['section' => 'case-study'],
        ['section' => 'team'],
        ['section' => 'contact'],
    ],
],
```

---

## Новые секции (из конкурентного анализа)

| Секция | Источник идеи | Описание |
|--------|---------------|----------|
| **pricing** | Boiler-SPb, Санкт Техник | 3 пакета: Стандарт (Valtec) / Комфорт (Stout) / Премиум (Rehau) с ценами |
| **team** | Тепло и люди | Фото реальной бригады, ФИО, стаж, специализация |
| **standards** | Санкт Техник | Наш стандарт монтажа: фотофиксация с рулеткой, бирки, правила |
| **benefits** | Общий | Почему мы: гарантия 5 лет, 3D-проект, собственный склад |

### Варианты существующих секций

| Секция | Вариант | Описание |
|--------|---------|----------|
| **hero/video** | comf.life | Видео-фон вместо фото (autoplay, muted, poster fallback) |
| **hero/engineer** | Тепло и люди | Лицо инженера + кнопка «Аудит сметы» + квиз |
| **services/focused** | — | Отфильтрованные услуги (только релевантные запросу лендинга) |

---

## Волна 1: Первые 5 лендингов

| URL | Запрос Яндекс.Директ | Секции лендинга |
|-----|----------------------|-----------------|
| `/lp/otoplenie/` | отопление загородного дома | hero → benefits → pricing → case-study → team → contact |
| `/lp/vodosnabzhenie/` | водоснабжение частного дома | hero → benefits → standards → objects → contact |
| `/lp/proektirovanie/` | проектирование инженерных систем | hero(engineer) → benefits → case-study → pricing → contact |
| `/lp/elektromontazh/` | электромонтажные работы | hero → services(focused) → standards → team → contact |
| `/lp/ventilyaciya/` | монтаж вентиляции | hero → benefits → pricing → objects → contact |

---

## Чеклист задач

### 1. Инфраструктура лендингов
- [ ] Создать `inc/landing-config.php` — конфигурации всех лендингов (массивы секций)
- [ ] Создать `templates/landing.php` — WordPress Page Template, рендерит по конфигу
- [ ] Подключить в `functions.php`
- [ ] Обновить `inc/enqueue.php` — `ovklife_is_landing_page()` включает `templates/landing.php`
- [ ] `<meta name="robots" content="noindex, nofollow">` для рекламных лендингов

### 2. Новые секции
- [ ] `sections/pricing/data.php` + `default.php` — пакетные цены (3 колонки)
- [ ] `sections/team/data.php` + `default.php` — команда с фотографиями
- [ ] `sections/standards/data.php` + `default.php` — стандарт монтажа (фото + правила)
- [ ] `sections/benefits/data.php` + `default.php` — преимущества (иконки + текст)
- [ ] CSS: `pricing.css`, `team.css`, `standards.css`, `benefits.css`
- [ ] Добавить `@import` в `base.css`

### 3. Варианты секций
- [ ] `sections/hero/video.php` — Hero с видео-фоном
- [ ] `sections/hero/engineer.php` — Hero с лицом инженера + аудит сметы
- [ ] `sections/services/focused.php` — отфильтрованные услуги
- [ ] CSS: `hero-video.css`, `hero-engineer.css`
- [ ] JS: `video-hero.js` (управление видео, pause на мобильных)

### 4. Создание 5 лендингов (волна 1)
- [ ] Конфигурация: отопление загородного дома
- [ ] Конфигурация: водоснабжение частного дома
- [ ] Конфигурация: проектирование инженерных систем
- [ ] Конфигурация: электромонтажные работы
- [ ] Конфигурация: вентиляция и кондиционирование
- [ ] Создать 5 страниц в WordPress с шаблоном «Рекламный лендинг»

### 5. Аналитика
- [ ] UTM-параметры для каждого лендинга
- [ ] Подготовка к интеграции с Яндекс.Метрикой (Sprint-11)

### 6. Проверка
- [ ] Все 5 лендингов открываются и отображаются корректно
- [ ] Каждый лендинг — уникальная комбинация секций
- [ ] `<meta robots noindex>` присутствует
- [ ] CTA-кнопки работают: `tel:` + Telegram + форма (Sprint-08)
- [ ] Адаптивность на мобильных (основной трафик из Директа)
- [ ] Скорость загрузки < 3 секунд
- [ ] `npm run validate` — 0 ошибок

---

## Файлы

### СОЗДАТЬ

| Файл | Назначение |
|------|------------|
| `inc/landing-config.php` | Конфигурации лендингов |
| `templates/landing.php` | WordPress Page Template |
| `template-parts/landing/sections/pricing/data.php` | Данные пакетных цен |
| `template-parts/landing/sections/pricing/default.php` | Шаблон пакетных цен |
| `template-parts/landing/sections/team/data.php` | Данные команды |
| `template-parts/landing/sections/team/default.php` | Шаблон команды |
| `template-parts/landing/sections/standards/data.php` | Данные стандарта монтажа |
| `template-parts/landing/sections/standards/default.php` | Шаблон стандарта монтажа |
| `template-parts/landing/sections/benefits/data.php` | Данные преимуществ |
| `template-parts/landing/sections/benefits/default.php` | Шаблон преимуществ |
| `template-parts/landing/sections/hero/video.php` | Hero с видео-фоном |
| `template-parts/landing/sections/hero/engineer.php` | Hero с инженером |
| `template-parts/landing/sections/services/focused.php` | Услуги фильтрованные |
| `assets/css/landing/sections/pricing.css` | Стили пакетов |
| `assets/css/landing/sections/team.css` | Стили команды |
| `assets/css/landing/sections/standards.css` | Стили стандартов |
| `assets/css/landing/sections/benefits.css` | Стили преимуществ |
| `assets/css/landing/sections/hero-video.css` | Стили видео-hero |
| `assets/css/landing/sections/hero-engineer.css` | Стили engineer-hero |
| `assets/js/landing/video-hero.js` | Управление видео-фоном |

### МОДИФИЦИРОВАТЬ

| Файл | Действие |
|------|----------|
| `functions.php` | +require landing-config.php |
| `inc/enqueue.php` | Расширить `ovklife_is_landing_page()` |
| `assets/css/landing/base.css` | +@import новых секций |
| `assets/js/landing/main.js` | +import video-hero.js |

---

## Результат спринта

После завершения Sprint-09:
- Инфраструктура модульных лендингов (конфиг → секции → HTML)
- 4 новые секции: pricing, team, standards, benefits
- 3 варианта Hero: default, video, engineer
- 5 рекламных лендингов под Яндекс.Директ
- Готовность к A/B тестированию (Sprint-11)
- Готовность к масштабированию (Sprint-13: ещё 7 лендингов)
