# CLAUDE.md — Руководство для AI агентов

> **Проект:** OVKLife — Инженерные системы для загородного дома
> **Домен:** ovklife.ru
> **Стек:** WordPress 6.7 + PHP 8.2 + Vite 6 + Tailwind CSS 3.4
> **Версия:** 1.0.0

Все общение только на русском языке, все комментарии только на Русском языке.

---

## 🚨 КРИТИЧЕСКИЕ УВЕДОМЛЕНИЯ

### ⛔ Защита секретов

- ❌ `wp-config.php` — НИКОГДА не коммитить (содержит пароли БД и salt-ключи)
- ❌ `.env` файлы — НИКОГДА не коммитить
- ❌ SQL-дампы — НИКОГДА не коммитить
- ✅ Только `wp-config-sample.php` и `.env.example` — шаблоны без секретов

### ⛔ Безопасность WordPress

- ❌ `echo $_GET['key']` — ЗАПРЕЩЕНО (XSS)
- ✅ `echo esc_html( $_GET['key'] )` — правильно
- ❌ `$wpdb->query("SELECT * WHERE id = $id")` — ЗАПРЕЩЕНО (SQL Injection)
- ✅ `$wpdb->query( $wpdb->prepare( "SELECT * WHERE id = %d", $id ) )` — правильно
- ❌ Действия без nonce — ЗАПРЕЩЕНО (CSRF)
- ✅ `wp_nonce_field()` + `wp_verify_nonce()` для всех форм

### ⛔ Защита веток (Branch Protection)

- ❌ Прямые коммиты в `dev`, `staging`, `prod`, `main` — ЗАПРЕЩЕНО
- ✅ Только через feature-ветки → PR в `dev` → PR в `staging` → PR в `prod` → PR в `main`
- Конвенция именования: `feature/`, `fix/`, `refactor/`, `docs/`

### ⛔ Запрет ручного деплоя

- ❌ Ручной деплой через SSH — **КАТЕГОРИЧЕСКИ ЗАПРЕЩЕНО**
- ✅ Деплой ТОЛЬКО через Forgejo CI/CD (push в `staging`/`prod` → автоматический workflow)
- Workflows: `.forgejo/workflows/deploy-staging.yml`, `.forgejo/workflows/deploy-prod.yml`

**Обязательный Git Flow:**

```
feature-ветки → PR в dev → PR в staging → PR в prod → PR в main
```

- **`dev`** — сборочная ветка. Мерж feature-веток ТОЛЬКО через PR
- **`staging`** — ⛔ **ТОЛЬКО С ЯВНОГО РАЗРЕШЕНИЯ!** Тестовая среда
- **`prod`** — ⛔ **ТОЛЬКО С ЯВНОГО РАЗРЕШЕНИЯ!** Боевой продакшн
- **`main`** — ⛔ **ТОЛЬКО С ОТДЕЛЬНОГО ЯВНОГО РАЗРЕШЕНИЯ!** Стабильная ветка

**⛔ ВЕТКА `main` — ОСОБЫЙ СТАТУС**

- ❌ Разрешение на staging/prod **НЕ распространяется** на main
- ✅ Для main нужна **отдельная явная команда**: «синхронизируй main», «мержи в main»
- ✅ После деплоя в prod — **ПОЛНАЯ ОСТАНОВКА**

### ⛔ Запрет text-[13px]

- ❌ `text-[13px]` — ЗАПРЕЩЕНО
- ✅ Использовать `text-sm` (14px) или `text-xs` (12px)

---

## 🛠️ ОСНОВНЫЕ КОМАНДЫ

### Development

```bash
npm run dev              # Vite dev server (HMR)
npm run build            # Production build темы
npm run watch            # Vite watch mode
```

### Code Quality

```bash
npm run validate         # Полная проверка (PHPCS + ESLint + Stylelint + Prettier)
npm run fix              # Автоисправление всего
npm run phpcs            # PHP_CodeSniffer (WPCS)
npm run phpcbf           # Авто-фикс PHP
npm run eslint           # ESLint для JS
npm run eslint:fix       # Авто-фикс JS
npm run stylelint        # Stylelint для CSS
npm run stylelint:fix    # Авто-фикс CSS
npm run format           # Prettier
npm run format:check     # Prettier проверка
```

### Docker (локальная разработка)

```bash
docker compose -f docker-compose.local.yml up -d     # Запуск
docker compose -f docker-compose.local.yml down       # Остановка
# WordPress: http://localhost:8080
# phpMyAdmin: http://localhost:8081
```

**⚠️ Перед коммитом:** `npm run validate`
Pre-commit hook блокирует коммит при ошибках!

---

## 📚 НАВИГАЦИЯ ПО ДОКУМЕНТАЦИИ

| Файл | Содержание | Когда читать |
|------|-----------|--------------|
| [CLAUDE-infrastructure.md](CLAUDE-infrastructure.md) | Сервер, Forgejo, CI/CD, бэкапы | Деплой, инфраструктура |
| [CLAUDE-workflow.md](CLAUDE-workflow.md) | Git Flow, Feature/Bugfix процессы | Перед коммитом, workflow |
| [CLAUDE-quality.md](CLAUDE-quality.md) | PHPCS, ESLint, Stylelint, Prettier | Линтинг, code quality |
| [CLAUDE-architecture.md](CLAUDE-architecture.md) | WP паттерны, template hierarchy, security | Архитектура, PHP код |

---

## 🏗️ СТРУКТУРА ПРОЕКТА

```
wp_ovklife/
├── .claude/              # Claude Code (hooks, skills, settings)
├── .forgejo/workflows/   # CI/CD workflows
├── .husky/               # Git pre-commit hooks
├── wp-content/
│   └── themes/ovklife/   # Кастомная тема
│       ├── assets/       # Исходники (CSS, JS, images)
│       ├── dist/         # Сборка Vite (НЕ в git)
│       ├── inc/          # PHP-модули
│       ├── templates/    # Шаблоны страниц
│       ├── functions.php # Главный файл темы
│       └── style.css     # Метаданные темы
├── docs/                 # Документация
├── scripts/              # Утилиты
├── CLAUDE.md             # ← Вы здесь
├── package.json          # NPM-скрипты (корень)
├── composer.json         # PHP-зависимости (PHPCS)
└── phpcs.xml             # Конфигурация PHPCS
```

**В Git:** тема, конфиги, docs, CI/CD
**НЕ в Git:** WP core, uploads, node_modules, vendor, dist, wp-config.php

---

## 💼 BUSINESS DOMAIN

**OVKLife** — корпоративный сайт компании по инженерным системам для загородного дома.

**Направления:**
- Отопление (газовое, электрическое, тёплые полы)
- Водоснабжение и канализация
- Вентиляция и кондиционирование
- Электрика

**Ключевые сущности WordPress:**
- **Услуги** (CPT `service`, slug `uslugi`)
- **Проекты/Портфолио** (CPT `project`, slug `proekty`)
- Страницы: Главная, О компании, Услуги, Проекты, Контакты

---

## 🎯 ПРОТОКОЛ ПЕРЕД НАЧАЛОМ РАБОТЫ

1. Прочитать CLAUDE.md
2. Определить тип задачи → прочитать соответствующий CLAUDE-*.md
3. Задать вопросы если неясно
4. TodoWrite для задач с 3+ шагами
5. EnterPlanMode для файлов > 300 строк

---

## ✅ ЧЕКЛИСТ ПЕРЕД КОММИТОМ

- [ ] `npm run validate` — 0 ошибок
- [ ] `wp-config.php` НЕ в staged (`git diff --cached --name-only`)
- [ ] Нет секретов в коде
- [ ] Экранирование вывода в PHP (`esc_html`, `esc_url`, `esc_attr`)
- [ ] Нет `text-[13px]`
- [ ] Комментарии на русском

### CI/CD Pipeline

| Workflow | Триггер | Что делает |
|----------|---------|-----------|
| `audit-gate.yml` | PR в dev/staging | PHPCS, ESLint, Stylelint, Prettier |
| `deploy-staging.yml` | Push в staging | Build тема → rsync на staging |
| `deploy-prod.yml` | Push в prod | Бэкап БД → Build → rsync на prod |

### Git-инфраструктура

- **Primary:** Forgejo (`origin`) — ssh://git@155.212.138.145:2222/leonid/ovklife.git
- **Mirror:** GitHub (`github`) — push-зеркалирование
- **Сервер:** 62.113.102.129 (Ubuntu 24.04)
