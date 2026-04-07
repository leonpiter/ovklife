<?php
/**
 * Шаблон секции «Объекты» (вариант default).
 *
 * Галерея реализованных проектов со слайдером и карточками.
 *
 * Переменные из data.php:
 *
 * @var string $objects_label Надпись над заголовком.
 * @var string $objects_title Заголовок секции.
 * @var string $img_dir       URL директории изображений.
 * @var array  $projects      Массив проектов (title, type, area, works, image).
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>

<section id="obekty" class="landing-section landing-section--light objects">
	<div class="landing-container">
		<div class="objects__header">
			<p class="objects__label"><?php echo esc_html( $objects_label ); ?></p>
			<h2 class="objects__title"><?php echo esc_html( $objects_title ); ?></h2>
		</div>

		<!-- Слайдер -->
		<div class="objects__slider">
			<div class="objects__slider-track">
				<?php foreach ( $projects as $index => $project ) : ?>
				<div class="objects__slide">
					<div class="objects__slide-image">
						<img
							<?php if ( 0 === $index ) : ?>
							src="<?php echo esc_url( $img_dir . $project['image'] ); ?>"
							<?php else : ?>
							src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
							data-src="<?php echo esc_url( $img_dir . $project['image'] ); ?>"
							class="lazy"
							<?php endif; ?>
							alt="<?php echo esc_attr( $project['title'] . ' — ' . $project['type'] ); ?>"
							width="800"
							height="500"
							loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>"
						>
					</div>
					<div class="objects__slide-info">
						<h3 class="objects__slide-title">
							<?php echo esc_html( $project['title'] ); ?>
						</h3>
						<div class="objects__slide-meta">
							<span class="objects__slide-type"><?php echo esc_html( $project['type'] ); ?></span>
							<span class="objects__slide-area"><?php echo esc_html( $project['area'] ); ?></span>
						</div>
						<p class="objects__slide-works">
							<span class="objects__slide-works-label"><?php esc_html_e( 'Виды работ', 'ovklife' ); ?></span>
							<?php echo esc_html( $project['works'] ); ?>
						</p>
					</div>
				</div>
				<?php endforeach; ?>
			</div>

			<!-- Навигация слайдера -->
			<button type="button" class="objects__slider-prev" aria-label="<?php esc_attr_e( 'Предыдущий проект', 'ovklife' ); ?>">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
					<path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
			<button type="button" class="objects__slider-next" aria-label="<?php esc_attr_e( 'Следующий проект', 'ovklife' ); ?>">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
					<path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
			<div class="objects__slider-dots"></div>
		</div>
	</div>
</section>
