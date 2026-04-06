---
name: deploy-prod
description: Деплой на production-сервер через PR staging→prod
user_invocable: true
---

# /deploy-prod — Деплой на production

⛔ **ТРЕБУЕТСЯ ЯВНОЕ РАЗРЕШЕНИЕ ПОЛЬЗОВАТЕЛЯ!**
⛔ Слова «деплой в staging и prod» дают право на staging + prod. НЕ на main!

## Предусловия
- Пользователь ЯВНО сказал «деплой в prod» / «деплой в продакшн»
- Staging успешно протестирован
- Все проверки пройдены

## Шаги

1. **Показать что будет задеплоено:**
   ```bash
   git log prod..staging --oneline
   ```

2. **Создание PR staging → prod:**
   ```bash
   gh pr create --base prod --head staging --title "Deploy to production" --body "Деплой в production"
   ```

3. **Мерж PR:**
   ```bash
   gh pr merge --merge
   ```

4. **Push в prod (триггер CI/CD):**
   ```bash
   git checkout prod
   git pull origin prod
   git push origin prod
   ```

5. **Мониторинг деплоя:**
   - Логи: http://155.212.138.145/leonid/ovklife/actions
   - Health check: https://ovklife.ru

## После деплоя

⛔ **ПОЛНАЯ ОСТАНОВКА.** Сообщить пользователю:

> Задеплоено в prod. Проверьте https://ovklife.ru
> ⚠️ Для синхронизации main нужна **ОТДЕЛЬНАЯ** команда: «синхронизируй main»

❌ НЕ трогать main без отдельного явного разрешения!
