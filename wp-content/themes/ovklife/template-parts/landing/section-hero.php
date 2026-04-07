<?php
/**
 * Секция Hero лендинга.
 *
 * Главный экран с заголовком, подзаголовком, CTA-кнопкой,
 * фоновым изображением и ключевыми преимуществами.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

$hero_image = get_template_directory_uri() . '/assets/images/landing/tild3135-3161-4533-a136-366237376433____1.jpg';
?>

<section id="hero" class="hero">
	<div class="hero__bg">
		<img
			src="<?php echo esc_url( $hero_image ); ?>"
			alt="<?php esc_attr_e( 'Инженерные системы частного дома — OVK Life', 'ovklife' ); ?>"
			class="hero__bg-img"
			width="1920"
			height="1080"
			fetchpriority="high"
		>
		<div class="hero__overlay"></div>
	</div>

	<div class="hero__content landing-container">
		<div class="hero__text">
			<h1 class="hero__title">
				<?php esc_html_e( 'Инженерные системы частных домов', 'ovklife' ); ?>
			</h1>
			<p class="hero__subtitle">
				<?php esc_html_e( 'Проектируем и реализуем инженерные системы, интегрированные в архитектуру и дизайн дома', 'ovklife' ); ?>
			</p>
			<p class="hero__location">
				<?php esc_html_e( 'Санкт-Петербург и Ленинградская область · Дома 150–600 м²', 'ovklife' ); ?>
			</p>
		</div>

		<div class="hero__features">
			<div class="hero__feature">
				<?php ovklife_svg_icon( 'tild6234-6663-4561-b530-663830633664__frame_43.svg', 'hero__feature-icon' ); ?>
				<span class="hero__feature-text">
					<?php esc_html_e( 'Интеграция с архитектурой и дизайн-проектом', 'ovklife' ); ?>
				</span>
			</div>
			<div class="hero__feature">
				<?php ovklife_svg_icon( 'tild6562-3038-4963-a362-396335626139__frame_44.svg', 'hero__feature-icon' ); ?>
				<span class="hero__feature-text">
					<?php esc_html_e( 'Полный инженерный цикл', 'ovklife' ); ?>
				</span>
			</div>
		</div>

		<div class="hero__actions">
			<a href="#obratnaya-svyaz" class="landing-btn landing-btn--primary landing-btn--lg hero__cta">
				<?php esc_html_e( 'Консультация инженера бесплатно', 'ovklife' ); ?>
			</a>
			<a href="<?php echo esc_url( 'tel:' . ovklife_phone_link( '+7 (921) 947-46-93' ) ); ?>"
				class="hero__phone">
				<?php esc_html_e( '+7 (921) 947-46-93', 'ovklife' ); ?>
			</a>
		</div>
	</div>
</section>
