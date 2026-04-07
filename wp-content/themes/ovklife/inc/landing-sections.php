<?php
/**
 * Модульная система секций лендинга.
 *
 * Обеспечивает разделение данных и шаблонов для секций,
 * поддержку вариантов (A/B тесты) и оверрайдов данных.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Загружает секцию лендинга: данные + шаблон варианта.
 *
 * @param string $section  Имя секции (hero, objects, stages, services, case-study, contact).
 * @param string $variant  Вариант шаблона. По умолчанию определяется фильтром.
 * @param array  $override Оверрайд данных секции (мержится поверх data.php).
 */
function ovklife_landing_section( $section, $variant = '', $override = array() ) {
	$section  = sanitize_file_name( $section );
	$variant  = $variant ? sanitize_file_name( $variant ) : ovklife_resolve_section_variant( $section );
	$data     = ovklife_load_section_data( $section, $override );
	$template = get_template_directory() . "/template-parts/landing/sections/{$section}/{$variant}.php";

	if ( ! file_exists( $template ) ) {
		return;
	}

	ovklife_register_active_section( $section, $variant );

	/*
	 * Извлекаем данные в переменные для шаблона.
	 * Аналогично WordPress load_template() — EXTR_SKIP
	 * не перезаписывает существующие переменные.
	 */
	if ( is_array( $data ) && ! empty( $data ) ) {
		// phpcs:ignore WordPress.PHP.DontExtract.extract_extract -- Стандартный паттерн шаблонизации, аналогичен WP load_template().
		extract( $data, EXTR_SKIP );
	}

	include $template;
}

/**
 * Загружает данные секции и мержит с оверрайдом.
 *
 * @param string $section  Имя секции.
 * @param array  $override Оверрайд данных (мержится поверх data.php).
 * @return array Данные секции.
 */
function ovklife_load_section_data( $section, $override = array() ) {
	$data_file = get_template_directory() . "/template-parts/landing/sections/{$section}/data.php";
	$data      = array();

	if ( file_exists( $data_file ) ) {
		$data = include $data_file;
	}

	if ( ! is_array( $data ) ) {
		$data = array();
	}

	if ( ! empty( $override ) ) {
		$data = array_merge( $data, $override );
	}

	return $data;
}

/**
 * Определяет вариант шаблона секции через фильтр.
 *
 * Sprint-11 подключит A/B тестирование через этот фильтр.
 * Sprint-09 — конфигурации рекламных лендингов.
 *
 * @param string $section Имя секции.
 * @return string Имя варианта (по умолчанию 'default').
 */
function ovklife_resolve_section_variant( $section ) {
	/**
	 * Фильтр варианта секции.
	 *
	 * @param string $variant Имя варианта ('default').
	 * @param string $section Имя секции.
	 */
	return apply_filters( 'ovklife_section_variant', 'default', $section );
}

/**
 * Регистрирует активную секцию для условной загрузки CSS/JS.
 *
 * @param string $section Имя секции.
 * @param string $variant Вариант шаблона.
 */
function ovklife_register_active_section( $section, $variant ) {
	global $ovklife_active_sections;

	if ( ! is_array( $ovklife_active_sections ) ) {
		$ovklife_active_sections = array();
	}

	$ovklife_active_sections[ $section ] = $variant;
}
