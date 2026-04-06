#!/bin/bash
# ============================================================================
# Block Prod Push Hook (PreToolUse)
# Блокирует push/merge в prod и main без явного разрешения пользователя.
# Exit code 2 = немедленная остановка агента.
# ============================================================================

TOOL_INPUT="$1"

# Проверка push в prod или main
if echo "$TOOL_INPUT" | grep -qE "git push.*(origin|upstream).*(prod|main)\b"; then
  echo "⛔ ЗАБЛОКИРОВАНО: Push в prod/main без явного разрешения!"
  echo ""
  echo "Для push в prod нужна явная команда пользователя: «деплой в prod»"
  echo "Для push в main нужна ОТДЕЛЬНАЯ команда: «синхронизируй main»"
  exit 2
fi

# Проверка gh pr create в prod или main
if echo "$TOOL_INPUT" | grep -qE "gh pr create.*--base (prod|main)\b"; then
  echo "⛔ ЗАБЛОКИРОВАНО: Создание PR в prod/main без явного разрешения!"
  echo ""
  echo "Для PR в prod нужна команда: «деплой в prod»"
  echo "Для PR в main нужна ОТДЕЛЬНАЯ команда: «синхронизируй main»"
  exit 2
fi

# Проверка gh pr merge для prod или main
if echo "$TOOL_INPUT" | grep -qE "gh pr merge"; then
  CURRENT_BRANCH=$(git rev-parse --abbrev-ref HEAD 2>/dev/null)
  if echo "$CURRENT_BRANCH" | grep -qE "^(prod|main)$"; then
    echo "⛔ ЗАБЛОКИРОВАНО: Merge PR в $CURRENT_BRANCH без явного разрешения!"
    exit 2
  fi
fi

# Проверка gpush на prod/main ветке
if echo "$TOOL_INPUT" | grep -qE "\bgpush\b"; then
  CURRENT_BRANCH=$(git rev-parse --abbrev-ref HEAD 2>/dev/null)
  if echo "$CURRENT_BRANCH" | grep -qE "^(prod|main)$"; then
    echo "⛔ ЗАБЛОКИРОВАНО: gpush на ветке $CURRENT_BRANCH без явного разрешения!"
    exit 2
  fi
fi

exit 0
