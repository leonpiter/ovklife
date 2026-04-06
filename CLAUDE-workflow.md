# CLAUDE-workflow.md — Процессы разработки OVKLife

## Git Flow

```
feature/* → dev → staging → prod → main
fix/*     → dev → staging → prod → main
```

### Создание feature-ветки

```bash
git checkout dev
git pull origin dev
git checkout -b feature/описание
# ... работа ...
git add <файлы>
git commit -m "feat: описание изменений"
git push origin feature/описание
gh pr create --base dev --title "Feature: описание" --body "..."
```

### Мерж в dev

```bash
gh pr merge <номер> --merge
```

Агент может самостоятельно: feature → dev (создание ветки, PR, мерж).

### Мерж в staging (ТОЛЬКО с разрешения!)

```bash
# Пользователь сказал "деплой в staging"
gh pr create --base staging --head dev --title "Deploy to staging"
gh pr merge --merge
git push origin staging  # → триггер deploy-staging.yml
```

### Мерж в prod (ТОЛЬКО с разрешения!)

```bash
# Пользователь сказал "деплой в prod"
gh pr create --base prod --head staging --title "Deploy to production"
gh pr merge --merge
git push origin prod  # → триггер deploy-prod.yml
```

### Мерж в main (ОТДЕЛЬНОЕ разрешение!)

```bash
# Пользователь сказал "синхронизируй main"
gh pr create --base main --head prod --title "Sync main"
gh pr merge --merge
```

---

## Конвенция коммитов

Формат: `тип: описание на русском`

| Тип | Описание |
|-----|----------|
| `feat` | Новая функциональность |
| `fix` | Исправление бага |
| `refactor` | Рефакторинг без изменения функциональности |
| `style` | Стили, CSS, форматирование |
| `docs` | Документация |
| `chore` | Конфиги, зависимости, CI/CD |

Примеры:
- `feat: добавлена страница услуг с шаблоном page-uslugi`
- `fix: исправлено отображение мобильного меню`
- `style: обновлён дизайн секции "О компании"`

---

## Чеклист перед коммитом

1. `npm run validate` — PHPCS + ESLint + Stylelint + Prettier
2. Проверить что `wp-config.php` НЕ в staged
3. Проверить экранирование в PHP: `esc_html()`, `esc_url()`, `esc_attr()`
4. Визуально проверить изменения: `git diff`

---

## Процесс Feature

1. Создать ветку от `dev`: `git checkout -b feature/название`
2. Реализовать → коммиты
3. `npm run validate`
4. Push ветки → PR в `dev`
5. Audit-gate проверка на CI
6. Мерж

## Процесс Bugfix

1. Создать ветку от `dev`: `git checkout -b fix/название`
2. Исправить → коммит
3. `npm run validate`
4. Push → PR в `dev`
5. Мерж

---

## Спринт-инструкции

При работе в Plan Mode:
1. **Первый пункт плана:** создать `docs/implementation/sprints/SPRINT-XX-название.md`
2. **Последний пункт плана:** обновить статус задач в спринт-файле

Шаблон: `docs/implementation/sprints/SPRINT-TEMPLATE.md`
