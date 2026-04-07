<?php
/**
 * Данные секции Hero.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

return array(
	'hero_image'    => get_template_directory_uri() . '/assets/images/landing/tild3135-3161-4533-a136-366237376433____1.jpg',
	'hero_title'    => __( 'Инженерные системы частных домов', 'ovklife' ),
	'hero_subtitle' => __( 'Проектируем и реализуем инженерные системы, интегрированные в архитектуру и дизайн дома', 'ovklife' ),
	'hero_location' => __( 'Санкт-Петербург и Ленинградская область · Дома 150–600 м²', 'ovklife' ),
	'hero_features' => array(
		array(
			'icon' => 'tild6234-6663-4561-b530-663830633664__frame_43.svg',
			'text' => __( 'Интеграция с архитектурой и дизайн-проектом', 'ovklife' ),
		),
		array(
			'icon' => 'tild6562-3038-4963-a362-396335626139__frame_44.svg',
			'text' => __( 'Полный инженерный цикл', 'ovklife' ),
		),
	),
	'hero_cta_text' => __( 'Консультация инженера бесплатно', 'ovklife' ),
	'hero_cta_link' => '#obratnaya-svyaz',
	'hero_phone'    => '+7 (921) 947-46-93',
);
