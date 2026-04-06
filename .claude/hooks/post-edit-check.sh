#!/bin/bash
# ============================================================================
# Post-Edit Check Hook (PostToolUse)
# Проверяет файл после каждого Edit/Write на опасные паттерны.
# НЕ блокирует (exit 0), только предупреждает.
# ============================================================================

TOOL_INPUT="$1"

# Извлечь путь файла из JSON input
FILE_PATH=$(echo "$TOOL_INPUT" | grep -oP '"file_path"\s*:\s*"([^"]+)"' | head -1 | sed 's/"file_path"\s*:\s*"//' | sed 's/"$//')

if [ -z "$FILE_PATH" ] || [ ! -f "$FILE_PATH" ]; then
  exit 0
fi

WARNINGS=0

# ============================================================================
# Проверка размера файла
# ============================================================================
LINE_COUNT=$(wc -l < "$FILE_PATH" 2>/dev/null || echo "0")

if [ "$LINE_COUNT" -gt 500 ]; then
  echo "🚨 ALERT: Файл $FILE_PATH содержит $LINE_COUNT строк (макс. 500)!"
  echo "   Рекомендуется разбить на модули."
  WARNINGS=$((WARNINGS + 1))
elif [ "$LINE_COUNT" -gt 300 ]; then
  echo "⚠️  WARNING: Файл $FILE_PATH содержит $LINE_COUNT строк (макс. рекомендуемый: 300)."
  WARNINGS=$((WARNINGS + 1))
fi

# ============================================================================
# Проверка text-[13px] (запрещён)
# ============================================================================
if grep -qn 'text-\[13px\]' "$FILE_PATH" 2>/dev/null; then
  echo "⛔ ЗАПРЕЩЕНО: text-[13px] в $FILE_PATH"
  echo "   Используй text-sm (14px) вместо text-[13px] (13px)"
  WARNINGS=$((WARNINGS + 1))
fi

# ============================================================================
# WordPress-специфичные проверки (только для PHP файлов)
# ============================================================================
if echo "$FILE_PATH" | grep -qE '\.php$'; then

  # XSS: echo $_GET/$_POST/$_REQUEST без экранирования
  if grep -nE 'echo\s+\$_(GET|POST|REQUEST|SERVER|COOKIE)' "$FILE_PATH" 2>/dev/null; then
    echo "🔴 XSS РИСК: Прямой echo \$_GET/\$_POST без экранирования в $FILE_PATH"
    echo "   Используй: echo esc_html(\$_GET['key'])"
    WARNINGS=$((WARNINGS + 1))
  fi

  # SQL Injection: $wpdb->query() без prepare()
  if grep -nE '\$wpdb->query\s*\(' "$FILE_PATH" 2>/dev/null | grep -vq 'prepare'; then
    echo "🔴 SQL INJECTION РИСК: \$wpdb->query() без \$wpdb->prepare() в $FILE_PATH"
    echo "   Используй: \$wpdb->query(\$wpdb->prepare(...))"
    WARNINGS=$((WARNINGS + 1))
  fi

  # Прямой доступ к $_SERVER без esc_url
  if grep -nE "\\$_SERVER\['REQUEST_URI'\]" "$FILE_PATH" 2>/dev/null | grep -vq 'esc_url'; then
    echo "⚠️  WARNING: \$_SERVER['REQUEST_URI'] без esc_url() в $FILE_PATH"
    WARNINGS=$((WARNINGS + 1))
  fi

  # wp-config.php не должен коммититься
  if echo "$FILE_PATH" | grep -q 'wp-config\.php$'; then
    echo "⛔ ЗАПРЕЩЕНО: Редактирование wp-config.php — этот файл не коммитится!"
    echo "   Используй wp-config-sample.php как шаблон."
    WARNINGS=$((WARNINGS + 1))
  fi
fi

if [ $WARNINGS -gt 0 ]; then
  echo ""
  echo "📋 Обнаружено предупреждений: $WARNINGS"
fi

# НЕ блокируем — только предупреждаем
exit 0
