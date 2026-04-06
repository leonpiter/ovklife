<?php
/**
 * Настройки кастомайзера темы.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Регистрация настроек кастомайзера.
 *
 * @param WP_Customize_Manager $wp_customize Объект кастомайзера.
 */
function ovklife_customize_register( $wp_customize ) {

	// Секция: Контакты компании.
	$wp_customize->add_section(
		'ovklife_contacts',
		[
			'title'    => esc_html__( 'Контакты компании', 'ovklife' ),
			'priority' => 30,
		]
	);

	// Телефон.
	$wp_customize->add_setting(
		'ovklife_phone',
		[
			'default'           => '+7 (XXX) XXX-XX-XX',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		]
	);

	$wp_customize->add_control(
		'ovklife_phone',
		[
			'label'   => esc_html__( 'Телефон', 'ovklife' ),
			'section' => 'ovklife_contacts',
			'type'    => 'text',
		]
	);

	// Email.
	$wp_customize->add_setting(
		'ovklife_email',
		[
			'default'           => 'info@ovklife.ru',
			'sanitize_callback' => 'sanitize_email',
			'transport'         => 'refresh',
		]
	);

	$wp_customize->add_control(
		'ovklife_email',
		[
			'label'   => esc_html__( 'Email', 'ovklife' ),
			'section' => 'ovklife_contacts',
			'type'    => 'email',
		]
	);

	// Адрес.
	$wp_customize->add_setting(
		'ovklife_address',
		[
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		]
	);

	$wp_customize->add_control(
		'ovklife_address',
		[
			'label'   => esc_html__( 'Адрес', 'ovklife' ),
			'section' => 'ovklife_contacts',
			'type'    => 'textarea',
		]
	);
}
add_action( 'customize_register', 'ovklife_customize_register' );
