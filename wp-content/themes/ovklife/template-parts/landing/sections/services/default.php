<?php
/**
 * Шаблон секции «Услуги» (вариант default).
 *
 * 5 направлений: отопление, вентиляция, электрика,
 * водоснабжение, автоматизация.
 *
 * Переменные из data.php:
 *
 * @var string $services_label Надпись над заголовком.
 * @var string $services_title Заголовок секции.
 * @var array  $services       Массив услуг (icon, title, desc).
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>

<section id="uslugi" class="landing-section landing-section--light services">
	<div class="landing-container">
		<div class="services__header">
			<p class="services__label"><?php echo esc_html( $services_label ); ?></p>
			<h2 class="services__title"><?php echo esc_html( $services_title ); ?></h2>
		</div>

		<div class="services__grid">
			<?php foreach ( $services as $service ) : ?>
			<div class="services__card">
				<div class="services__card-icon">
					<?php ovklife_svg_icon( $service['icon'], 'services__icon' ); ?>
				</div>
				<h3 class="services__card-title"><?php echo esc_html( $service['title'] ); ?></h3>
				<p class="services__card-desc"><?php echo esc_html( $service['desc'] ); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
