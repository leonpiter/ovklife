<?php
/**
 * Подключение стилей и скриптов через Vite manifest.
 *
 * В development: Vite dev server (HMR).
 * В production: hashed файлы из dist/ через manifest.json.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Проверяет, запущен ли Vite dev server.
 *
 * @return bool True если Vite dev server доступен.
 */
function ovklife_is_vite_dev() {
	// В production всегда false.
	if ( ! defined( 'WP_DEBUG' ) || ! WP_DEBUG ) {
		return false;
	}

	// Проверяем наличие Vite dev server.
	// Из Docker-контейнера хост доступен через host.docker.internal.
	$vite_host = 'host.docker.internal';
	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents, WordPress.PHP.NoSilencedErrors.Discouraged -- Намеренное подавление ошибки: проверяем доступность Vite dev server, ошибка ожидаема в production.
	$response = @file_get_contents( 'http://' . $vite_host . ':5173/@vite/client' );
	return false !== $response;
}

/**
 * Получает URL ассета из Vite manifest.
 *
 * @param string $entry Путь к entry point (например, 'assets/js/main.js').
 * @return string URL файла или пустая строка.
 */
function ovklife_vite_asset( $entry ) {
	$manifest_path = get_template_directory() . '/dist/.vite/manifest.json';

	if ( ! file_exists( $manifest_path ) ) {
		return '';
	}

	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$manifest = json_decode( file_get_contents( $manifest_path ), true );

	if ( isset( $manifest[ $entry ]['file'] ) ) {
		return get_template_directory_uri() . '/dist/' . $manifest[ $entry ]['file'];
	}

	return '';
}

/**
 * Получает CSS-файлы из Vite manifest для указанного entry.
 *
 * @param string $entry Путь к entry point.
 * @return array Массив URL CSS-файлов.
 */
function ovklife_vite_css( $entry ) {
	$manifest_path = get_template_directory() . '/dist/.vite/manifest.json';

	if ( ! file_exists( $manifest_path ) ) {
		return [];
	}

	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$manifest = json_decode( file_get_contents( $manifest_path ), true );
	$css_urls = [];

	if ( isset( $manifest[ $entry ]['css'] ) && is_array( $manifest[ $entry ]['css'] ) ) {
		foreach ( $manifest[ $entry ]['css'] as $css_file ) {
			$css_urls[] = get_template_directory_uri() . '/dist/' . $css_file;
		}
	}

	return $css_urls;
}

/**
 * Проверяет, является ли текущая страница лендингом.
 *
 * Лендинги используют vanilla CSS/JS вместо Tailwind.
 * Критерии: front_page или шаблон page-landing.php.
 *
 * @return bool True если текущая страница — лендинг.
 */
function ovklife_is_landing_page() {
	if ( is_front_page() ) {
		return true;
	}

	if ( is_page_template( 'templates/landing.php' ) ) {
		return true;
	}

	return false;
}

/**
 * Подключение стилей и скриптов.
 *
 * Условная загрузка: лендинги → vanilla CSS/JS, остальные → Tailwind.
 */
function ovklife_enqueue_assets() {
	$is_landing = ovklife_is_landing_page();

	if ( ovklife_is_vite_dev() ) {
		// Development: Vite HMR.
		// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_enqueue_script( 'vite-client', 'http://localhost:5173/@vite/client', [], null, false );

		if ( $is_landing ) {
			// Лендинг: vanilla CSS/JS.
			// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
			wp_enqueue_script( 'ovklife-landing', 'http://localhost:5173/assets/js/landing/main.js', [], null, true );
			// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
			wp_enqueue_style( 'ovklife-landing-style', 'http://localhost:5173/assets/css/landing/base.css', [], null );
		} else {
			// Внутренние страницы: Tailwind.
			// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
			wp_enqueue_script( 'ovklife-main', 'http://localhost:5173/assets/js/main.js', [], null, true );
			// phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
			wp_enqueue_style( 'ovklife-style', 'http://localhost:5173/assets/css/main.css', [], null );
		}

		// Добавляем type="module" для Vite скриптов.
		add_filter(
			'script_loader_tag',
			function ( $tag, $handle ) {
				$vite_handles = [ 'vite-client', 'ovklife-main', 'ovklife-landing' ];
				if ( in_array( $handle, $vite_handles, true ) ) {
					return str_replace( ' src', ' type="module" src', $tag );
				}
				return $tag;
			},
			10,
			2
		);
	} elseif ( $is_landing ) {
		// Production лендинг: vanilla CSS/JS из manifest.
		$landing_style = ovklife_vite_asset( 'assets/css/landing/base.css' );
		if ( $landing_style ) {
			wp_enqueue_style( 'ovklife-landing-style', $landing_style, [], OVKLIFE_VERSION );
		}

		// CSS из landing JS entry.
		$landing_js_css = ovklife_vite_css( 'assets/js/landing/main.js' );
		foreach ( $landing_js_css as $index => $css_url ) {
			wp_enqueue_style( 'ovklife-landing-css-' . $index, $css_url, [], OVKLIFE_VERSION );
		}

		$landing_script = ovklife_vite_asset( 'assets/js/landing/main.js' );
		if ( $landing_script ) {
			wp_enqueue_script( 'ovklife-landing', $landing_script, [], OVKLIFE_VERSION, true );
		}
	} else {
		// Production внутренние страницы: Tailwind из manifest.
		$style_url = ovklife_vite_asset( 'assets/css/main.css' );
		if ( $style_url ) {
			wp_enqueue_style( 'ovklife-style', $style_url, [], OVKLIFE_VERSION );
		}

		// CSS из JS entry (Tailwind компилируется через JS).
		$js_css = ovklife_vite_css( 'assets/js/main.js' );
		foreach ( $js_css as $index => $css_url ) {
			wp_enqueue_style( 'ovklife-js-css-' . $index, $css_url, [], OVKLIFE_VERSION );
		}

		$script_url = ovklife_vite_asset( 'assets/js/main.js' );
		if ( $script_url ) {
			wp_enqueue_script( 'ovklife-main', $script_url, [], OVKLIFE_VERSION, true );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'ovklife_enqueue_assets' );
