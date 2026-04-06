# CLAUDE-architecture.md — Архитектура WordPress OVKLife

## Стек технологий

| Компонент | Технология |
|-----------|-----------|
| CMS | WordPress 6.7 |
| PHP | 8.2+ |
| Build | Vite 6 |
| CSS | Tailwind CSS 3.4 |
| Сервер | Nginx + PHP-FPM |
| БД | MySQL 8.0 |

---

## WordPress Template Hierarchy

```
index.php              ← Fallback для всего
├── front-page.php     ← Главная страница (если настроена)
├── home.php           ← Страница блога
├── page.php           ← Отдельная страница
│   └── templates/page-*.php  ← Кастомные шаблоны
├── single.php         ← Отдельная запись
│   └── single-{cpt}.php     ← Записи CPT (service, project)
├── archive.php        ← Архив записей
│   └── archive-{cpt}.php    ← Архив CPT
├── search.php         ← Результаты поиска
└── 404.php            ← Страница 404
```

---

## Custom Post Types

### Услуги (`service`)

```php
register_post_type( 'service', [
    'public'       => true,
    'has_archive'  => true,
    'rewrite'      => [ 'slug' => 'uslugi' ],
    'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ],
    'show_in_rest' => true,  // Gutenberg support
] );
```

URL: `/uslugi/`, `/uslugi/{slug}/`

### Проекты (`project`)

```php
register_post_type( 'project', [
    'public'       => true,
    'has_archive'  => true,
    'rewrite'      => [ 'slug' => 'proekty' ],
    'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
    'show_in_rest' => true,
] );
```

URL: `/proekty/`, `/proekty/{slug}/`

---

## Vite Integration

### Development (HMR)

```
Browser → localhost:8080 (WordPress)
         ↓ (загружает скрипты с Vite)
         localhost:5173 (Vite dev server)
```

Файл `inc/enqueue.php` проверяет `WP_DEBUG` и доступность Vite dev server.
Если dev server запущен → подгружает ассеты через HMR.

### Production

```
npm run build → dist/.vite/manifest.json
WordPress читает manifest → подключает hashed файлы
```

Пример manifest.json:
```json
{
  "assets/js/main.js": {
    "file": "js/main.abc123.js",
    "css": ["css/style.def456.css"]
  }
}
```

---

## Безопасность — ОБЯЗАТЕЛЬНЫЕ правила

### Экранирование вывода

| Контекст | Функция |
|---------|---------|
| Текст в HTML | `esc_html( $var )` |
| HTML-атрибут | `esc_attr( $var )` |
| URL | `esc_url( $var )` |
| JavaScript | `esc_js( $var )` |
| Доверенный HTML | `wp_kses_post( $content )` |
| Перевод + вывод | `esc_html_e( 'текст', 'ovklife' )` |
| Перевод (возврат) | `esc_html__( 'текст', 'ovklife' )` |

### SQL-запросы

```php
// ✅ Правильно — всегда prepare()
$results = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * FROM {$wpdb->posts} WHERE post_type = %s AND post_status = %s",
        'service',
        'publish'
    )
);

// ❌ Запрещено — конкатенация переменных
$results = $wpdb->get_results(
    "SELECT * FROM {$wpdb->posts} WHERE ID = {$id}"
);
```

### CSRF-защита (nonce)

```php
// В форме:
wp_nonce_field( 'ovklife_action', 'ovklife_nonce' );

// При обработке:
if ( ! wp_verify_nonce( $_POST['ovklife_nonce'], 'ovklife_action' ) ) {
    wp_die( 'Ошибка проверки безопасности' );
}
```

---

## Паттерны кода

### Префикс функций

Все функции темы начинаются с `ovklife_`:
```php
function ovklife_setup() { ... }
function ovklife_enqueue_assets() { ... }
function ovklife_register_post_types() { ... }
```

### Text Domain

Все переводимые строки используют domain `'ovklife'`:
```php
esc_html__( 'Текст', 'ovklife' )
esc_html_e( 'Текст', 'ovklife' )
```

### Защита файлов

Каждый PHP-файл начинается с:
```php
<?php
defined( 'ABSPATH' ) || exit;
```

### Hooks (действия и фильтры)

```php
// Действие
add_action( 'init', 'ovklife_register_post_types' );
add_action( 'wp_enqueue_scripts', 'ovklife_enqueue_assets' );
add_action( 'after_setup_theme', 'ovklife_setup' );

// Фильтр
add_filter( 'the_content', 'ovklife_filter_content' );
```

---

## Структура темы

```
wp-content/themes/ovklife/
├── assets/              # Исходники
│   ├── css/main.css     # Tailwind + кастомные стили
│   ├── js/main.js       # Главный JS + импорт CSS
│   └── images/          # Исходные изображения
├── dist/                # Сборка Vite (НЕ в git)
├── inc/                 # PHP-модули
│   ├── enqueue.php      # Vite manifest loader
│   ├── post-types.php   # CPT: service, project
│   └── customizer.php   # Настройки кастомайзера
├── templates/           # Кастомные шаблоны страниц
├── functions.php        # Главный файл (подключает inc/)
├── style.css            # Метаданные темы
├── header.php           # Шапка
├── footer.php           # Подвал
├── index.php            # Fallback шаблон
├── page.php             # Страница
├── single.php           # Запись
├── 404.php              # Ошибка 404
├── package.json         # Vite + Tailwind
├── vite.config.js       # Конфигурация Vite
└── tailwind.config.js   # Конфигурация Tailwind
```
