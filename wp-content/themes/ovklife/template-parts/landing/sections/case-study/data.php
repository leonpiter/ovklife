<?php
/**
 * Данные секции «Пример проекта».
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

return array(
	'case_label'         => __( 'Пример проекта', 'ovklife' ),
	'case_title'         => __( 'Пример инженерной реализации', 'ovklife' ),
	'case_project_title' => __( 'Частный дом с бассейном', 'ovklife' ),
	'case_location'      => __( 'Подмосковье', 'ovklife' ),
	'case_area'          => '500 м²',
	'case_desc'          => __( 'Полный комплекс инженерных систем — от котельной до систем безопасности и видеонаблюдения', 'ovklife' ),
	'case_systems_label' => __( 'Системы', 'ovklife' ),
	'case_result'        => __( 'Проект выполнен под ключ: от расчёта до запуска', 'ovklife' ),
	'case_cta_text'      => __( 'Обсудить проект', 'ovklife' ),
	'case_cta_link'      => '#obratnaya-svyaz',
	'img_dir'            => get_template_directory_uri() . '/assets/images/landing/',
	'gallery'            => array(
		'tild3430-6531-4165-a532-613331643834__rectangle_8_2.jpg',
		'tild6462-3435-4430-b830-653638306138__rectangle_69.jpg',
		'tild6664-3462-4333-a239-643836373831__rectangle_70.jpg',
	),
	'case_systems'       => array(
		__( 'отопление', 'ovklife' ),
		__( 'вентиляция бассейна', 'ovklife' ),
		__( 'водоснабжение и канализация', 'ovklife' ),
		__( 'автоматика', 'ovklife' ),
		__( 'слаботочные системы', 'ovklife' ),
		__( 'водоподготовка', 'ovklife' ),
		__( 'наружные сети', 'ovklife' ),
	),
);
