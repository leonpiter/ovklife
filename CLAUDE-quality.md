# CLAUDE-quality.md — Качество кода OVKLife

## Инструменты

| Инструмент | Конфиг | Что проверяет |
|-----------|--------|--------------|
| **PHP_CodeSniffer** | `phpcs.xml` | WordPress Coding Standards, PHP 8.2+ совместимость |
| **ESLint** | `.eslintrc.json` | JavaScript — качество, ошибки, стиль |
| **Stylelint** | `.stylelintrc.json` | CSS — стандарты, Tailwind совместимость |
| **Prettier** | `.prettierrc` | Форматирование JS, CSS, JSON, MD |
| **Husky + lint-staged** | `package.json` | Pre-commit проверки (автоматически) |

---

## PHP_CodeSniffer (WPCS)

### Команды

```bash
npm run phpcs          # Проверка
npm run phpcbf         # Автоисправление
```

### Что проверяет

- WordPress Coding Standards (отступы, именование, документация)
- PHP 8.2+ совместимость (PHPCompatibility)
- Безопасность: экранирование, подготовленные запросы, nonce
- Text domain: `'ovklife'` для всех переводимых строк

### Исключения в phpcs.xml

- `Universal.Arrays.DisallowShortArraySyntax` — разрешены `[]`
- `WordPress.PHP.DisallowShortTernary` — разрешён `?:`

### Что PHPCS НЕ исправляет автоматически

- Добавление `esc_html()` / `esc_url()` / `esc_attr()`
- Добавление `$wpdb->prepare()`
- Добавление `wp_nonce_field()` / `wp_verify_nonce()`

Это нужно делать вручную!

---

## ESLint (JavaScript)

### Команды

```bash
npm run eslint         # Проверка
npm run eslint:fix     # Автоисправление
npm run eslint:check   # Строгая проверка (0 warnings)
```

### Ключевые правила

| Правило | Значение |
|---------|----------|
| `no-console` | warn (разрешены .warn, .error) |
| `no-debugger` | error |
| `no-alert` | error |
| `prefer-const` | error |
| `no-var` | error |
| `eqeqeq` | error (всегда `===`) |

### WP Globals

Доступны без импорта: `wp`, `ajaxurl`, `jQuery`

---

## Stylelint (CSS)

### Команды

```bash
npm run stylelint      # Проверка
npm run stylelint:fix  # Автоисправление
```

### Tailwind @-правила

Разрешены: `@tailwind`, `@apply`, `@layer`, `@config`, `@screen`, `@responsive`, `@variants`

---

## Prettier

### Команды

```bash
npm run format         # Форматировать всё
npm run format:check   # Проверить без изменений
```

### Настройки

- `singleQuote: true`
- `tabWidth: 2`
- `trailingComma: "es5"`
- `printWidth: 100`
- `prettier-plugin-tailwindcss` — автосортировка Tailwind классов

---

## Pre-commit Hook (Husky + lint-staged)

Автоматически при каждом `git commit`:

| Файлы | Проверки |
|-------|---------|
| `*.php` | PHPCS (WordPress standards) |
| `*.js` | Prettier → ESLint fix → ESLint strict |
| `*.css`, `*.scss` | Prettier → Stylelint fix |
| `*.json`, `*.md` | Prettier |

⛔ Коммит **блокируется** при любых ошибках!

### Обход (только в крайнем случае!)

```bash
git commit --no-verify -m "emergency: описание"
```

---

## Полная проверка

```bash
npm run validate
```

Эквивалент:
```bash
npm run phpcs && npm run eslint:check && npm run stylelint && npm run format:check
```

Автоисправление:
```bash
npm run fix
```
