<?php
/**
 * Шаблон секции «Пример проекта» (вариант default).
 *
 * Кейс-стади: частный дом с бассейном, 500 м²,
 * полный комплекс инженерных систем.
 *
 * Переменные из data.php:
 *
 * @var string $case_label         Надпись над заголовком.
 * @var string $case_title         Заголовок секции.
 * @var string $case_project_title Название проекта.
 * @var string $case_location      Локация.
 * @var string $case_area          Площадь.
 * @var string $case_desc          Описание проекта.
 * @var string $case_systems_label Подпись списка систем.
 * @var string $case_result        Итог проекта.
 * @var string $case_cta_text      Текст CTA-кнопки.
 * @var string $case_cta_link      Ссылка CTA-кнопки.
 * @var string $img_dir            URL директории изображений.
 * @var array  $gallery            Массив имён файлов изображений.
 * @var array  $case_systems       Массив названий систем.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>

<section id="primer-proekta" class="landing-section case-study">
	<div class="landing-container">
		<div class="case-study__header">
			<p class="case-study__label"><?php echo esc_html( $case_label ); ?></p>
			<h2 class="case-study__title"><?php echo esc_html( $case_title ); ?></h2>
		</div>

		<div class="case-study__grid">
			<!-- Информация -->
			<div class="case-study__info">
				<h3 class="case-study__project-title">
					<?php echo esc_html( $case_project_title ); ?>
				</h3>

				<div class="case-study__meta">
					<span class="case-study__location"><?php echo esc_html( $case_location ); ?></span>
					<span class="case-study__area"><?php echo esc_html( $case_area ); ?></span>
				</div>

				<p class="case-study__desc">
					<?php echo esc_html( $case_desc ); ?>
				</p>

				<p class="case-study__systems-label"><?php echo esc_html( $case_systems_label ); ?></p>
				<ul class="case-study__systems">
					<?php foreach ( $case_systems as $system ) : ?>
					<li class="case-study__system"><?php echo esc_html( $system ); ?></li>
					<?php endforeach; ?>
				</ul>

				<p class="case-study__result">
					<?php echo esc_html( $case_result ); ?>
				</p>

				<a href="<?php echo esc_url( $case_cta_link ); ?>" class="landing-btn landing-btn--dark landing-btn--md case-study__cta">
					<?php echo esc_html( $case_cta_text ); ?>
				</a>
			</div>

			<!-- Галерея -->
			<div class="case-study__gallery">
				<?php foreach ( $gallery as $index => $image ) : ?>
				<div class="case-study__photo case-study__photo--<?php echo (int) ( $index + 1 ); ?>">
					<img
						src="<?php echo esc_url( $img_dir . $image ); ?>"
						alt="<?php echo esc_attr( $case_project_title . ' — фото ' . ( $index + 1 ) ); ?>"
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
