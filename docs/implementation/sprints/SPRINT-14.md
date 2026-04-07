# Sprint-14: Формы обратной связи и CRM-интеграция

> **Статус:** ⏳ Ожидает
> **Ветка:** `feature/sprint-14-forms-crm`
> **Зависимости:** Sprint-11 (UTM, Метрика), Sprint-10 (квиз)
> **Результат:** AJAX-формы, email/Telegram уведомления, CPT для заявок, CRM-подготовка

---

## Контекст

В Sprint-08 создана базовая форма «Заказать звонок» (wp_mail). Теперь нужна полноценная система обработки лидов: все заявки (формы + квиз) сохраняются в CPT `lead`, отправляют уведомления в email и Telegram, передают UTM-данные. Это расширение базовой формы из Sprint-08 до production-ready системы.

> **Предыстория:** базовая форма (`inc/forms-basic.php`, `template-parts/common/form-callback.php`) создана в Sprint-08. В этом спринте она заменяется полноценным модулем `inc/forms.php` с CPT lead, Telegram-ботом, rate limiting и т.д.

---

## Ключевые решения

| Решение | Обоснование |
|---------|-------------|
| Vanilla JS + WP REST API | Без плагинов (CF7/WPForms), полный контроль |
| CPT `lead` для хранения заявок | Все заявки в WP-админке, экспорт, фильтрация |
| Email + Telegram-бот | Мгновенное уведомление менеджера |
| Единый обработчик для всех форм | DRY-принцип, одна точка обработки |
| UTM-данные в каждой заявке | Отслеживание ROI рекламных кампаний |
| Замена forms-basic.php → forms.php | Sprint-08 создал MVP, этот спринт делает production |

---

## Типы форм

| Форма | Где используется | Поля |
|-------|-----------------|------|
| Заказать звонок | Header (все страницы), модальное окно | Имя, Телефон |
| Заявка на расчёт | Страницы услуг (CTA-блок) | Имя, Телефон, Услуга (auto), Сообщение |
| Форма контактов | Страница /kontakty/ | Имя, Телефон, Email, Сообщение |
| Запрос на консультацию | Лендинги (CTA-секция) | Имя, Телефон, Способ связи |

---

## Чеклист задач

### 1. Серверная часть — обработчик форм
- [ ] Заменить `inc/forms-basic.php` → `inc/forms.php` — единый модуль обработки форм
- [ ] WP REST API endpoint: `/wp-json/ovklife/v1/form-submit`
- [ ] Валидация на сервере:
  - Имя: не пустое, sanitize_text_field
  - Телефон: regex проверка формата (+7/8, 10-11 цифр)
  - Email: is_email() проверка (если есть)
  - Сообщение: wp_kses_post() санитизация
- [ ] Nonce-защита (wp_create_nonce / wp_verify_nonce)
- [ ] Rate limiting (не более 3 заявок с одного IP за 10 минут)

### 2. CPT для заявок
- [ ] Зарегистрировать CPT `lead` в `inc/post-types.php`:
  - public: false (не видно на фронте)
  - show_ui: true (видно в админке)
  - supports: title
- [ ] Мета-поля заявки:
  - `_lead_name` — имя
  - `_lead_phone` — телефон
  - `_lead_email` — email
  - `_lead_message` — сообщение
  - `_lead_service` — услуга
  - `_lead_source` — источник (форма / квиз / callback)
  - `_lead_utm_source`, `_lead_utm_medium`, `_lead_utm_campaign` — UTM
  - `_lead_page_url` — URL страницы с которой отправлена
  - `_lead_ab_variant` — вариант A/B теста
- [ ] Колонки в списке заявок: Имя, Телефон, Источник, UTM Source, Дата

### 3. Уведомления
- [ ] Email-уведомление администратору (wp_mail):
  - Тема: «Новая заявка с ovklife.ru — [Имя]»
  - Тело: все данные заявки + UTM + URL страницы
- [ ] Telegram-бот уведомление:
  - Через Telegram Bot API (wp_remote_post)
  - Bot token и chat_id в Customizer
  - Форматированное сообщение с данными заявки

### 4. Клиентская часть — JS
- [ ] Создать `assets/js/forms.js` — модуль форм
- [ ] Маска телефона (input mask: +7 (___) ___-__-__)
- [ ] Клиентская валидация (имя не пустое, телефон формат)
- [ ] AJAX-отправка через fetch() к REST API
- [ ] Состояния кнопки: default → loading (спиннер) → success / error
- [ ] Callback в Метрику при успешной отправке: `ym(ID, 'reachGoal', 'form_submit')`
- [ ] UTM из cookie → скрытые поля формы
- [ ] A/B вариант → скрытое поле

### 5. HTML-формы в шаблонах
- [ ] Модальное окно «Заказать звонок» — в header-landing.php и header.php
- [ ] Форма в CTA-блоке услуг — `template-parts/service/section-cta.php`
- [ ] Форма на странице контактов — `templates/page-contacts.php`
- [ ] Форма в CTA-секции лендингов — `template-parts/landing/section-contact.php`
- [ ] Общий partial: `template-parts/common/form-callback.php` (переиспользование)

### 6. Интеграция с квизом (Sprint-10)
- [ ] Обновить `inc/quiz-handler.php` — сохранять как CPT lead (source: quiz)
- [ ] UTM и A/B данные в заявках из квиза

### 7. Проверка
- [ ] Все формы отправляются без перезагрузки страницы
- [ ] Email-уведомление приходит с корректными данными
- [ ] Telegram-уведомление приходит (если настроен бот)
- [ ] Заявки отображаются в WP-админке → Заявки
- [ ] UTM-данные корректно сохраняются
- [ ] Маска телефона работает на мобильных
- [ ] Rate limiting блокирует спам
- [ ] Nonce валидация работает
- [ ] `npm run validate` — 0 ошибок

---

## Файлы для создания/модификации

| Файл | Действие |
|------|----------|
| `inc/forms.php` | СОЗДАТЬ |
| `inc/post-types.php` | МОДИФИЦИРОВАТЬ (CPT lead) |
| `inc/customizer.php` | МОДИФИЦИРОВАТЬ (Telegram bot settings) |
| `inc/quiz-handler.php` | МОДИФИЦИРОВАТЬ (интеграция с CPT lead) |
| `assets/js/forms.js` | СОЗДАТЬ |
| `assets/js/landing/main.js` | МОДИФИЦИРОВАТЬ (импорт forms.js) |
| `template-parts/common/form-callback.php` | СОЗДАТЬ |
| `template-parts/service/section-cta.php` | МОДИФИЦИРОВАТЬ (встроить форму) |
| `template-parts/landing/section-contact.php` | МОДИФИЦИРОВАТЬ (встроить форму) |
| `header-landing.php` | МОДИФИЦИРОВАТЬ (модальное окно) |
| `header.php` | МОДИФИЦИРОВАТЬ (модальное окно) |
| `functions.php` | МОДИФИЦИРОВАТЬ (подключить forms.php) |

---

## Результат спринта

После завершения Sprint-14:
- 4 типа форм обратной связи на всех ключевых страницах
- Все заявки сохраняются в CPT lead с UTM-данными
- Email + Telegram уведомления при каждой заявке
- Маска телефона, клиентская валидация, AJAX-отправка
- Защита от спама (nonce + rate limiting)
- **Единая система обработки лидов для SEO + Директ трафика**
