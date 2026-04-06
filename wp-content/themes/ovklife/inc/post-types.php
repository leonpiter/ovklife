<?php
/**
 * Кастомные типы записей и таксономии.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Регистрация кастомных типов записей.
 *
 * Услуги, проекты (портфолио) и т.д. добавляются по мере необходимости.
 */
function ovklife_register_post_types() {
	// Услуги.
	register_post_type(
		'service',
		[
			'labels'       => [
				'name'               => esc_html__( 'Услуги', 'ovklife' ),
				'singular_name'      => esc_html__( 'Услуга', 'ovklife' ),
				'add_new'            => esc_html__( 'Добавить услугу', 'ovklife' ),
				'add_new_item'       => esc_html__( 'Добавить новую услугу', 'ovklife' ),
				'edit_item'          => esc_html__( 'Редактировать услугу', 'ovklife' ),
				'view_item'          => esc_html__( 'Просмотреть услугу', 'ovklife' ),
				'all_items'          => esc_html__( 'Все услуги', 'ovklife' ),
				'search_items'       => esc_html__( 'Найти услугу', 'ovklife' ),
				'not_found'          => esc_html__( 'Услуги не найдены', 'ovklife' ),
				'not_found_in_trash' => esc_html__( 'В корзине услуг нет', 'ovklife' ),
			],
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => [ 'slug' => 'uslugi' ],
			'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ],
			'menu_icon'    => 'dashicons-hammer',
			'show_in_rest' => true,
		]
	);

	// Проекты (портфолио).
	register_post_type(
		'project',
		[
			'labels'       => [
				'name'               => esc_html__( 'Проекты', 'ovklife' ),
				'singular_name'      => esc_html__( 'Проект', 'ovklife' ),
				'add_new'            => esc_html__( 'Добавить проект', 'ovklife' ),
				'add_new_item'       => esc_html__( 'Добавить новый проект', 'ovklife' ),
				'edit_item'          => esc_html__( 'Редактировать проект', 'ovklife' ),
				'view_item'          => esc_html__( 'Просмотреть проект', 'ovklife' ),
				'all_items'          => esc_html__( 'Все проекты', 'ovklife' ),
				'search_items'       => esc_html__( 'Найти проект', 'ovklife' ),
				'not_found'          => esc_html__( 'Проекты не найдены', 'ovklife' ),
				'not_found_in_trash' => esc_html__( 'В корзине проектов нет', 'ovklife' ),
			],
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => [ 'slug' => 'proekty' ],
			'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
			'menu_icon'    => 'dashicons-portfolio',
			'show_in_rest' => true,
		]
	);
}
add_action( 'init', 'ovklife_register_post_types' );
