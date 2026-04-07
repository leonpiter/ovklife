<?php
/**
 * Шаблон секции Hero (вариант default).
 *
 * Главный экран с заголовком, подзаголовком, CTA-кнопкой,
 * фоновым изображением и ключевыми преимуществами.
 *
 * Переменные из data.php:
 *
 * @var string $hero_image    URL фонового изображения.
 * @var string $hero_title    Заголовок H1.
 * @var string $hero_subtitle Подзаголовок.
 * @var string $hero_location Локация и площадь.
 * @var array  $hero_features Массив преимуществ (icon, text).
 * @var string $hero_cta_text Текст CTA-кнопки.
 * @var string $hero_cta_link Ссылка CTA-кнопки.
 * @var string $hero_phone    Номер телефона.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>

<section id="hero" class="hero">
	<div class="hero__bg">
		<img
			src="<?php echo esc_url( $hero_image ); ?>"
			alt="<?php echo esc_attr( $hero_title . ' — OVK Life' ); ?>"
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
				<?php echo esc_html( $hero_title ); ?>
			</h1>
			<p class="hero__subtitle">
				<?php echo esc_html( $hero_subtitle ); ?>
			</p>
			<p class="hero__location">
				<?php echo esc_html( $hero_location ); ?>
			</p>
		</div>

		<div class="hero__features">
			<?php foreach ( $hero_features as $feature ) : ?>
			<div class="hero__feature">
				<?php ovklife_svg_icon( $feature['icon'], 'hero__feature-icon' ); ?>
				<span class="hero__feature-text">
					<?php echo esc_html( $feature['text'] ); ?>
				</span>
			</div>
			<?php endforeach; ?>
		</div>

		<div class="hero__actions">
			<a href="<?php echo esc_url( $hero_cta_link ); ?>" class="landing-btn landing-btn--primary landing-btn--lg hero__cta">
				<?php echo esc_html( $hero_cta_text ); ?>
			</a>
			<a href="<?php echo esc_url( 'tel:' . ovklife_phone_link( $hero_phone ) ); ?>"
				class="hero__phone">
				<?php echo esc_html( $hero_phone ); ?>
			</a>
		</div>
	</div>
</section>
