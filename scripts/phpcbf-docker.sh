#!/bin/bash
# Обёртка для запуска PHPCBF через Docker (автоисправление PHPCS).
# Передаёт все аргументы (файлы) в PHPCBF внутри контейнера.

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/.." && pwd)"

# Конвертируем путь для Docker на Windows (MINGW/Git Bash).
DOCKER_MOUNT="$PROJECT_ROOT"
if [[ "$OSTYPE" == "msys" || "$OSTYPE" == "mingw"* ]]; then
	DOCKER_MOUNT="$(echo "$PROJECT_ROOT" | sed 's|^/\([a-z]\)/|\1:/|')"
fi

exec docker run --rm \
	-v "$DOCKER_MOUNT:/app" \
	-w "//app" \
	composer:2 \
	./vendor/bin/phpcbf --standard=phpcs.xml "$@"
