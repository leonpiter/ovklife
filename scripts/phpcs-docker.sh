#!/bin/bash
# Обёртка для запуска PHPCS через Docker (когда PHP не установлен на хосте).
# Используется в lint-staged для pre-commit проверки.
# lint-staged передаёт абсолютные пути — конвертируем в относительные для Docker.

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/.." && pwd)"

# Конвертируем путь для Docker на Windows (MINGW/Git Bash).
# PROJECT_ROOT: /c/Dev/Projects/wp_ovklife
# DOCKER_MOUNT: c:/Dev/Projects/wp_ovklife
DOCKER_MOUNT="$PROJECT_ROOT"
if [[ "$OSTYPE" == "msys" || "$OSTYPE" == "mingw"* ]]; then
	DOCKER_MOUNT="$(echo "$PROJECT_ROOT" | sed 's|^/\([a-z]\)/|\1:/|')"
fi

# Конвертируем абсолютные пути файлов в относительные.
# lint-staged передаёт C:/Dev/Projects/wp_ovklife/wp-content/...
# Нужно оставить только wp-content/...
RELATIVE_FILES=()
for file in "$@"; do
	normalized="${file//\\//}"
	# Извлекаем путь после wp-content/ (общая часть для всех PHP файлов темы).
	if [[ "$normalized" == *"/wp-content/"* ]]; then
		rel="wp-content/${normalized#*/wp-content/}"
	else
		rel="$normalized"
	fi
	RELATIVE_FILES+=("$rel")
done

exec docker run --rm \
	-v "$DOCKER_MOUNT:/app" \
	-w "//app" \
	composer:2 \
	./vendor/bin/phpcs --standard=phpcs.xml "${RELATIVE_FILES[@]}"
