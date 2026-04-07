<?php
/**
 * Главная страница лендинга.
 *
 * Каркас с подключением секций через get_template_part().
 * WordPress автоматически выбирает front-page.php для главной.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'landing' );

/* Секция 1: Hero — слайдер с фотографиями объектов */
get_template_part( 'template-parts/landing/section', 'hero' );

/* Секция 2: Объекты — галерея реализованных проектов */
get_template_part( 'template-parts/landing/section', 'objects' );

/* Секция 3: Этапы работ — процесс сотрудничества */
get_template_part( 'template-parts/landing/section', 'stages' );

/* Секция 4: Услуги — направления деятельности */
get_template_part( 'template-parts/landing/section', 'services' );

/* Секция 5: Пример проекта — кейс-стади */
get_template_part( 'template-parts/landing/section', 'case-study' );

/* Секция 6: Обратная связь — форма связи */
get_template_part( 'template-parts/landing/section', 'contact' );

get_footer( 'landing' );
