<?php
/**
 * Утилиты для лендингов — хелперы для шаблонов.
 *
 * SVG-иконки, форматирование телефона, социальные ссылки.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Выводит inline SVG из файла.
 *
 * @param string $filename Имя файла SVG (без пути, например 'logo.svg').
 * @param string $css_class    CSS-класс для обёртки.
 */
function ovklife_svg_icon( $filename, $css_class = '' ) {
	$path = get_template_directory() . '/assets/images/landing/' . $filename;

	if ( ! file_exists( $path ) ) {
		return;
	}

	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$svg = file_get_contents( $path );

	if ( $css_class ) {
		$svg = str_replace( '<svg', '<svg class="' . esc_attr( $css_class ) . '"', $svg );
	}

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- SVG из доверенного файла темы.
	echo $svg;
}

/**
 * Форматирует телефон для ссылки tel:
 *
 * @param string $phone Телефон в любом формате.
 * @return string Телефон в формате +7XXXXXXXXXX.
 */
function ovklife_phone_link( $phone ) {
	return preg_replace( '/[^+0-9]/', '', $phone );
}

/**
 * Выводит ссылку на телефон с иконкой.
 *
 * @param string $css_class CSS-класс.
 */
function ovklife_phone_button( $css_class = '' ) {
	$phone = get_theme_mod( 'ovklife_phone', '+7 (921) 947-46-93' );
	$href  = 'tel:' . ovklife_phone_link( $phone );

	printf(
		'<a href="%s" class="%s">%s</a>',
		esc_url( $href ),
		esc_attr( $css_class ),
		esc_html( $phone )
	);
}

/**
 * Выводит ссылку на Telegram.
 *
 * @param string $username Telegram-юзернейм (без @).
 * @param string $css_class    CSS-класс.
 */
function ovklife_telegram_link( $username = 'engineer_integrator', $css_class = '' ) {
	printf(
		'<a href="%s" class="%s" target="_blank" rel="noopener noreferrer">@%s</a>',
		esc_url( 'https://t.me/' . $username ),
		esc_attr( $css_class ),
		esc_html( $username )
	);
}

/**
 * Выводит <picture> элемент с WebP + JPG fallback.
 *
 * Проверяет наличие .webp версии рядом с оригиналом.
 * Если WebP нет — выводит обычный <img>.
 *
 * @param string $src       URL изображения (JPG).
 * @param string $alt       Alt-текст.
 * @param string $css_class CSS-класс для <img>.
 * @param array  $attrs     Дополнительные атрибуты (width, height, loading, fetchpriority).
 */
function ovklife_picture( $src, $alt, $css_class = '', $attrs = [] ) {
	$webp_src = preg_replace( '/\.jpe?g$/i', '.webp', $src );

	// Проверяем наличие WebP файла.
	$theme_dir = get_template_directory();
	$theme_uri = get_template_directory_uri();
	$webp_path = str_replace( $theme_uri, $theme_dir, $webp_src );
	$has_webp  = file_exists( $webp_path );

	// Собираем строку атрибутов.
	$attr_str = '';
	$defaults = [
		'width'   => '',
		'height'  => '',
		'loading' => 'lazy',
	];
	$attrs    = array_merge( $defaults, $attrs );

	foreach ( $attrs as $key => $value ) {
		if ( '' !== $value ) {
			$attr_str .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
		}
	}

	$class_attr = $css_class ? ' class="' . esc_attr( $css_class ) . '"' : '';

	if ( $has_webp ) {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- $class_attr и $attr_str уже экранированы через esc_attr() выше.
		echo '<picture>';
		echo '<source srcset="' . esc_url( $webp_src ) . '" type="image/webp">';
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '<img src="' . esc_url( $src ) . '" alt="' . esc_attr( $alt ) . '"' . $class_attr . $attr_str . '>';
		echo '</picture>';
	} else {
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '<img src="' . esc_url( $src ) . '" alt="' . esc_attr( $alt ) . '"' . $class_attr . $attr_str . '>';
	}
}
