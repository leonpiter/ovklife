<?php
/**
 * Секция Hero лендинга.
 *
 * Полноэкранный слайдер с фотографиями объектов и формой обратной связи.
 * Наполняется в Sprint-03.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>

<section id="hero" class="landing-section landing-section--dark" style="min-height: 100vh; display: flex; align-items: center;">
	<div class="landing-container">
		<h1><?php esc_html_e( 'Планируете строительство или дизайн-проект?', 'ovklife' ); ?></h1>
		<p><?php esc_html_e( 'Инженерные системы для загородного дома — отопление, водоснабжение, электрика.', 'ovklife' ); ?></p>
	</div>
</section>
