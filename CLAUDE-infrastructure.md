# CLAUDE-infrastructure.md — Инфраструктура OVKLife

## Серверы

| Назначение | IP | ОС | Доступ |
|-----------|-----|-----|--------|
| **Production + Staging** | 62.113.102.129 | Ubuntu 24.04 | `ssh ovklife` |
| **Forgejo (CI/CD)** | 155.212.138.145 | — | http://155.212.138.145/leonid/ovklife |

### Пути на сервере

| Среда | Путь | URL |
|-------|------|-----|
| Production | `/var/www/ovklife.ru` | https://ovklife.ru |
| Staging | `/var/www/staging.ovklife.ru` | https://staging.ovklife.ru |

### SSH-доступ

```bash
ssh ovklife                    # Подключение к серверу
ssh ovklife "wp --version"     # Проверка WP-CLI
```

SSH-ключ: `~/.ssh/id_ed25519_ovklife` (алиас `ovklife` в ~/.ssh/config)

---

## LEMP стек (на сервере)

- **Nginx** — веб-сервер, virtual hosts для prod + staging
- **PHP 8.2-FPM** — расширения: mysql, curl, gd, mbstring, xml, zip, intl
- **MySQL 8.0** — базы: `ovklife_prod`, `ovklife_staging`
- **WP-CLI** — управление WordPress из командной строки
- **Certbot** — SSL-сертификаты Let's Encrypt

---

## Git-инфраструктура

### Remotes

| Имя | URL | Назначение |
|-----|-----|-----------|
| `origin` | `ssh://git@155.212.138.145:2222/leonid/ovklife.git` | Forgejo (primary) |
| `github` | `git@github.com:leonid/ovklife.git` | GitHub (mirror) |

### Зеркалирование

GitHub настроен как Push Mirror в Forgejo Settings → Repository → Mirrors.
Все push в Forgejo автоматически зеркалируются на GitHub.

---

## CI/CD Workflows (Forgejo)

### audit-gate.yml
**Триггер:** PR в dev/staging, push в dev
**Действие:** PHPCS + ESLint + Stylelint + Prettier check

### deploy-staging.yml
**Триггер:** push в staging
**Действие:**
1. Установка Node.js + зависимостей темы
2. `npm run build` (Vite production build)
3. rsync темы на staging-сервер
4. `wp cache flush` на сервере

### deploy-prod.yml
**Триггер:** push в prod
**Действие:**
1. Бэкап БД на сервере
2. Установка Node.js + зависимостей темы
3. `npm run build`
4. rsync темы на production-сервер
5. Health check

### Secrets (в Forgejo Settings → Secrets)

| Secret | Описание |
|--------|----------|
| `SERVER_SSH_KEY` | Приватный SSH-ключ для доступа к серверу |
| `SERVER_HOST` | 62.113.102.129 |
| `SERVER_USER` | root |
| `STAGING_PATH` | /var/www/staging.ovklife.ru |
| `PROD_PATH` | /var/www/ovklife.ru |

---

## Бэкапы

### MySQL
- **Скрипт:** `/opt/ovklife/backup.sh` на сервере
- **Расписание:** cron — ежедневно в 03:00
- **Ротация:** 10 последних бэкапов
- **Путь:** `/opt/ovklife/backups/`

### Восстановление
```bash
ssh ovklife
mysql ovklife_prod < /opt/ovklife/backups/latest.sql
```

---

## Docker (только локальная разработка)

На сервере Docker **НЕ** используется — обычный LEMP стек.

```bash
docker compose -f docker-compose.local.yml up -d    # Запуск
docker compose -f docker-compose.local.yml down      # Остановка
```

| Сервис | Порт | URL |
|--------|------|-----|
| WordPress | 8080 | http://localhost:8080 |
| phpMyAdmin | 8081 | http://localhost:8081 |
| MySQL | 3306 | — |

---

## Деплой: стандартный путь

```
feature-ветка → PR в dev → PR в staging → PR в prod → PR в main
```

1. **dev → staging:** Тема собирается, rsync на staging-сервер
2. **staging → prod:** Бэкап БД, тема собирается, rsync на prod-сервер
3. **prod → main:** Только синхронизация кода (ОТДЕЛЬНОЕ разрешение!)

⛔ **Ручной деплой через SSH запрещён!** Только CI/CD.
