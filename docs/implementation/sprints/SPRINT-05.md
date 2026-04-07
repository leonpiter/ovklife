# Sprint-05: Страницы услуг — CPT иерархия, шаблоны, SEO-тексты

> **Статус:** ⏳ Ожидает
> **Ветка:** `feature/sprint-05-service-pages`
> **Зависимости:** Sprint-04 (SEO-инфраструктура)
> **Результат:** 15 страниц услуг с SEO-текстами, FAQ-schema, внутренней перелинковкой

---

## Контекст

Главная страница готова и оптимизирована (Sprint-01–04). Теперь — многостраничная структура услуг. Каждая услуга = отдельная SEO-оптимизированная страница, таргетирующая свой кластер ключевых слов. Это основа для органического трафика.

**CPT `service` уже существует** (`inc/post-types.php`) — нужно добавить иерархию (parent/child).

---

## Ключевые решения

| Решение | Обоснование |
|---------|-------------|
| Иерархический CPT (hierarchical: true) | Parent «Отопление» → child «Газовое отопление» |
| FAQ-секция на каждой услуге | FAQPage Schema → featured snippets в выдаче |
| Хлебные крошки | BreadcrumbList Schema + UX навигация |
| Перелинковка между услугами | Распределение ссылочного веса, поведенческие факторы |
| Блок CTA на каждой странице | Конверсия: «Рассчитать стоимость» / «Консультация» |

---

## Структура услуг

```
Источник URL: docs/semantic/SEMANTIC_CORE.md

/uslugi/                                                        ← Хаб (archive-service.php)
├── /uslugi/otoplenie-chastnogo-doma/                           ← Кластер 1: Отопление
│   ├── /uslugi/otoplenie-chastnogo-doma/kotelnya/                      ← Котельная под ключ
│   ├── /uslugi/otoplenie-chastnogo-doma/teplyj-pol/                    ← Тёплый пол водяной
│   ├── /uslugi/otoplenie-chastnogo-doma/teplovoj-nasos/                ← Тепловые насосы
│   └── /uslugi/otoplenie-chastnogo-doma/elektricheskoe/                ← Электрическое отопление
├── /uslugi/ventilyaciya-i-kondicionirovanie/                   ← Кластер 2: Вентиляция
│   ├── /pritochno-vytyazhnaya/
│   ├── /kondicionirovanie/
│   └── /rekuperaciya/
├── /uslugi/elektrika-v-zagorodnom-dome/                        ← Кластер 3: Электрика
│   ├── /provodka/
│   ├── /shchit/
│   └── /osveshchenie/
├── /uslugi/vodosnabzhenie-i-kanalizaciya/                      ← Кластер 4: Водоснабжение
│   ├── /montazh/
│   ├── /kanalizaciya/
│   ├── /vodopodgotovka/
│   └── /septik/
├── /uslugi/avtomatizaciya-inzhenernyh-sistem/                  ← Кластер 5: Автоматизация (Sprint-12)
│   ├── /avtomatizaciya-kotelnoj/
│   ├── /umnyj-dom/
│   └── /dispetcherizaciya/
├── /uslugi/kompleksnye-inzhenernye-sistemy/                    ← Кластер 6: Комплексный проект (Sprint-12)
├── /uslugi/videonablyudenie/                                   ← Видеонаблюдение (Sprint-12)
│   ├── /proektirovanie-videonablyudeniya/
│   └── /montazh-videonablyudeniya/
├── /uslugi/multirum/                                           ← Мультирум (Sprint-12)
├── /uslugi/spa-kompleksy/                                      ← SPA-комплексы (Sprint-12)
│   ├── /bassejny/
│   ├── /hammamy/
│   └── /sauny/
└── /uslugi/obsluzhivanie/                                      ← Обслуживание (Sprint-12)
    ├── /servisnoe-obsluzhivanie/
    └── /energoaudit/

Геостраницы (Sprint-17):
/geo/vsevolozhsk/    /geo/gatchina/    /geo/pushkin/
/geo/murino/         /geo/kolpino/     /geo/sestroretsk/
/geo/vyborg/         /geo/tikhvin/     /geo/kirishi/
/geo/luga/           /geo/kingisepp/   /geo/volkhov/
/geo/podporozhye/
```

> **Примечание:** Основные 5 направлений создаются в Sprint-05.
> Расширенные направления (автоматизация, видеонаблюдение, мультирум, SPA, септик, обслуживание) — в Sprint-12.

---

## Чеклист задач

### 1. CPT доработка
- [ ] Обновить `inc/post-types.php` — `'hierarchical' => true` для service
- [ ] Добавить `'page-attributes'` в supports (для порядка)
- [ ] Flush rewrite rules

### 2. Шаблоны
- [ ] Создать `archive-service.php` — хаб-страница всех услуг (карточки)
- [ ] Создать `single-service.php` — шаблон отдельной услуги
- [ ] Создать `template-parts/service/content-card.php` — карточка услуги
- [ ] Создать `template-parts/service/section-faq.php` — FAQ-блок
- [ ] Создать `template-parts/service/section-cta.php` — CTA-блок
- [ ] Создать `template-parts/service/section-related.php` — смежные услуги

### 3. SEO для каждой услуги (Title/H1 из `docs/semantic/SEMANTIC_CORE.md`)

| Страница | Title | H1 |
|----------|-------|-----|
| Отопление | Монтаж отопления частного дома под ключ в СПб и ЛО \| OVK Life | Монтаж отопления загородного дома под ключ — котельная, тёплый пол, радиаторы |
| Вентиляция | Монтаж вентиляции и кондиционирования в частном доме СПб \| OVK Life | Вентиляция загородного дома под ключ — проектирование и монтаж в СПб и ЛО |
| Электрика | Монтаж электрики в загородном доме под ключ в СПб и ЛО \| OVK Life | Электрика в частном доме под ключ — монтаж и проектирование в СПб и ЛО |
| Водоснабжение | Водоснабжение и канализация в частном доме под ключ в СПб и ЛО \| OVK Life | Монтаж водоснабжения и канализации в загородном доме под ключ |

- [ ] Уникальный title + description (из `docs/semantic/SEMANTIC_CORE.md`)
- [ ] Schema.org Service + FAQPage
- [ ] BreadcrumbList (Главная → Услуги → Отопление → Котельная)
- [ ] H1 с ключевым словом (из семантического ядра)
- [ ] Внутренние ссылки на смежные услуги
- [ ] Структура страницы по шаблону из `docs/semantic/SEO_STRATEGY.md`

### 4. Контент (SEO-тексты) — основные 5 направлений
- [ ] Хаб /uslugi/ — обзор всех направлений (включая будущие из Sprint-12)
- [ ] Отопление — основная + 4 дочерних
- [ ] Водоснабжение — основная + 3 дочерних
- [ ] Электрика — основная + 2 дочерних
- [ ] Вентиляция — основная + 3 дочерних (приточно-вытяжная, кондиционирование, климат-контроль)
- [ ] Проектирование — основная + 4 дочерних (проект отопления, вентиляции, электрики, комплексный)

> Расширенные направления (автоматизация, умный дом, видеонаблюдение, мультирум, SPA, септик, обслуживание) → Sprint-12

### 5. Пагинация архива
- [ ] Создать `template-parts/common/pagination.php` — переиспользуемый компонент
- [ ] Использовать `the_posts_pagination()` с кастомной разметкой
- [ ] Подключить в `archive-service.php`
- [ ] Стили пагинации (Tailwind для внутренних страниц)

### 6. Проверка
- [ ] Все URL работают, ЧПУ корректные
- [ ] Хлебные крошки отображаются (компонент из Sprint-04)
- [ ] FAQ-schema проходит Google Rich Results Test
- [ ] Внутренняя перелинковка работает
- [ ] Пагинация работает при 10+ записях
- [ ] `npm run validate` — 0 ошибок

> **⚠️ Зависимость:** CTA-кнопки на страницах услуг ведут на форму обратной связи. Базовая форма создаётся в Sprint-08. До Sprint-08 CTA может вести на `tel:` ссылку или Telegram.

---

## Файлы для создания/модификации

| Файл | Действие |
|------|----------|
| `inc/post-types.php` | МОДИФИЦИРОВАТЬ (hierarchical) |
| `archive-service.php` | СОЗДАТЬ |
| `single-service.php` | СОЗДАТЬ |
| `template-parts/service/content-card.php` | СОЗДАТЬ |
| `template-parts/service/section-faq.php` | СОЗДАТЬ |
| `template-parts/service/section-cta.php` | СОЗДАТЬ |
| `template-parts/service/section-related.php` | СОЗДАТЬ |
| `inc/seo.php` | МОДИФИЦИРОВАТЬ (Service schema, FAQ schema) |
| `template-parts/common/pagination.php` | СОЗДАТЬ |

---

## Результат спринта

После завершения Sprint-05:
- 15 страниц услуг с уникальными SEO-текстами
- Иерархическая структура (parent → child)
- FAQ-schema на каждой странице
- Внутренняя перелинковка между услугами
- Хаб-страница /uslugi/ с карточками
