---
name: deploy-staging
description: Деплой на staging-сервер через PR dev→staging
user_invocable: true
---

# /deploy-staging — Деплой на staging

⛔ **ТРЕБУЕТСЯ ЯВНОЕ РАЗРЕШЕНИЕ ПОЛЬЗОВАТЕЛЯ!**

## Предусловия
- Пользователь явно сказал «деплой в staging» или аналог
- Все изменения замержены в `dev`
- `npm run validate` проходит без ошибок

## Шаги

1. **Проверка текущего состояния:**
   ```bash
   git status
   git branch --show-current
   ```

2. **Запуск валидации:**
   ```bash
   npm run validate
   ```
   Если не проходит — СТОП, исправить проблемы.

3. **Сборка темы (проверка):**
   ```bash
   npm run build
   ```

4. **Создание PR dev → staging:**
   ```bash
   git checkout dev
   git pull origin dev
   gh pr create --base staging --head dev --title "Deploy to staging" --body "Деплой на staging"
   ```

5. **Мерж PR:**
   ```bash
   gh pr merge --merge
   ```

6. **Push в staging (триггер CI/CD):**
   ```bash
   git checkout staging
   git pull origin staging
   git push origin staging
   ```

7. **Мониторинг деплоя:**
   - Логи: http://155.212.138.145/leonid/ovklife/actions
   - Проверить: https://staging.ovklife.ru

## После деплоя

⛔ **ПОЛНАЯ ОСТАНОВКА.** Сообщить пользователю:
> Задеплоено на staging. Проверьте https://staging.ovklife.ru
> Для деплоя в prod нужна отдельная команда.
