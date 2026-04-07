<?php
/**
 * OVKLife — Функции и определения темы.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Версия темы.
 */
define( 'OVKLIFE_VERSION', '1.0.0' );

/**
 * Подключение ассетов (Vite manifest loader).
 */
require_once get_template_directory() . '/inc/enqueue.php';

/**
 * Кастомные типы записей и таксономии.
 */
require_once get_template_directory() . '/inc/post-types.php';

/**
 * Настройки кастомайзера.
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * SEO-модуль — Schema.org, мета-теги, Open Graph.
 */
require_once get_template_directory() . '/inc/seo.php';

/**
 * Утилиты для лендингов — хелперы для шаблонов.
 */
require_once get_template_directory() . '/inc/landing-helpers.php';

/**
 * Модульная система секций лендинга — data.php + вариантные шаблоны.
 */
require_once get_template_directory() . '/inc/landing-sections.php';

/**
 * Настройка темы — вызывается после инициализации.
 */
function ovklife_setup() {
	// Поддержка тега title.
	add_theme_support( 'title-tag' );

	// Миниатюры записей.
	add_theme_support( 'post-thumbnails' );

	// Кастомный логотип.
	add_theme_support(
		'custom-logo',
		[
			'height'      => 80,
			'width'       => 250,
			'flex-height' => true,
			'flex-width'  => true,
		]
	);

	// HTML5 разметка.
	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		]
	);

	// Регистрация меню.
	register_nav_menus(
		[
			'primary' => esc_html__( 'Главное меню', 'ovklife' ),
			'footer'  => esc_html__( 'Меню подвала', 'ovklife' ),
		]
	);

	// Загрузка текстового домена.
	load_theme_textdomain( 'ovklife', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'ovklife_setup' );
