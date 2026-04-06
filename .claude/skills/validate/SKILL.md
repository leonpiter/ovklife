---
name: validate
description: Полная проверка качества кода перед коммитом (PHPCS + ESLint + Stylelint + Prettier)
user_invocable: true
---

# /validate — Полная проверка качества

Запусти последовательно все проверки и выведи итоговый результат.

## Шаги

1. **PHPCS** — WordPress Coding Standards:
   ```bash
   npm run phpcs
   ```

2. **ESLint** — JavaScript проверка:
   ```bash
   npm run eslint:check
   ```

3. **Stylelint** — CSS проверка:
   ```bash
   npm run stylelint
   ```

4. **Prettier** — Форматирование:
   ```bash
   npm run format:check
   ```

## Вывод результата

Выведи таблицу результатов:

| Проверка   | Статус |
|------------|--------|
| PHPCS      | ✅/❌  |
| ESLint     | ✅/❌  |
| Stylelint  | ✅/❌  |
| Prettier   | ✅/❌  |

Итоговый вердикт: **READY TO COMMIT** или **NEEDS FIXES**

Если есть ошибки — покажи конкретные проблемы и предложи как исправить.
