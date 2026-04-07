<?php
/**
 * Секция «Пример проекта» лендинга.
 *
 * Кейс-стади: частный дом с бассейном, 500 м²,
 * полный комплекс инженерных систем.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

$img_dir = get_template_directory_uri() . '/assets/images/landing/';

$gallery = array(
	'tild3430-6531-4165-a532-613331643834__rectangle_8_2.jpg',
	'tild6462-3435-4430-b830-653638306138__rectangle_69.jpg',
	'tild6664-3462-4333-a239-643836373831__rectangle_70.jpg',
);

$systems = array(
	'отопление',
	'вентиляция бассейна',
	'водоснабжение и канализация',
	'автоматика',
	'слаботочные системы',
	'водоподготовка',
	'наружные сети',
);
?>

<section id="primer-proekta" class="landing-section case-study">
	<div class="landing-container">
		<div class="case-study__header">
			<p class="case-study__label"><?php esc_html_e( 'Пример проекта', 'ovklife' ); ?></p>
			<h2 class="case-study__title"><?php esc_html_e( 'Пример инженерной реализации', 'ovklife' ); ?></h2>
		</div>

		<div class="case-study__grid">
			<!-- Информация -->
			<div class="case-study__info">
				<h3 class="case-study__project-title">
					<?php esc_html_e( 'Частный дом с бассейном', 'ovklife' ); ?>
				</h3>

				<div class="case-study__meta">
					<span class="case-study__location"><?php esc_html_e( 'Подмосковье', 'ovklife' ); ?></span>
					<span class="case-study__area"><?php esc_html_e( '500 м²', 'ovklife' ); ?></span>
				</div>

				<p class="case-study__desc">
					<?php esc_html_e( 'Полный комплекс инженерных систем — от котельной до систем безопасности и видеонаблюдения', 'ovklife' ); ?>
				</p>

				<p class="case-study__systems-label"><?php esc_html_e( 'Системы', 'ovklife' ); ?></p>
				<ul class="case-study__systems">
					<?php foreach ( $systems as $system ) : ?>
					<li class="case-study__system"><?php echo esc_html( $system ); ?></li>
					<?php endforeach; ?>
				</ul>

				<p class="case-study__result">
					<?php esc_html_e( 'Проект выполнен под ключ: от расчёта до запуска', 'ovklife' ); ?>
				</p>

				<a href="#obratnaya-svyaz" class="landing-btn landing-btn--dark landing-btn--md case-study__cta">
					<?php esc_html_e( 'Обсудить проект', 'ovklife' ); ?>
				</a>
			</div>

			<!-- Галерея -->
			<div class="case-study__gallery">
				<?php foreach ( $gallery as $index => $image ) : ?>
				<div class="case-study__photo case-study__photo--<?php echo (int) ( $index + 1 ); ?>">
					<img
						src="<?php echo esc_url( $img_dir . $image ); ?>"
						alt="<?php echo esc_attr( 'Частный дом с бассейном — фото ' . ( $index + 1 ) ); ?>"
						width="600"
						height="400"
						loading="lazy"
					>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
