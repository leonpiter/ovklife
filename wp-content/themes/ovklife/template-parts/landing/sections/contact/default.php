<?php
/**
 * Шаблон секции «Обратная связь» (вариант default).
 *
 * CTA-блок с заголовком, контактами и кнопкой.
 * Форма будет реализована в Sprint-14 (AJAX + CPT lead).
 *
 * Переменные из data.php:
 *
 * @var string $contact_label    Надпись над заголовком.
 * @var string $contact_title    Заголовок секции.
 * @var string $contact_subtitle Подзаголовок.
 * @var string $contact_phone    Номер телефона.
 * @var string $contact_email    Email.
 * @var string $contact_telegram URL Telegram.
 * @var string $contact_cta_text Текст CTA-кнопки.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>

<section id="obratnaya-svyaz" class="landing-section landing-section--dark contact">
	<div class="landing-container">
		<div class="contact__content">
			<p class="contact__label"><?php echo esc_html( $contact_label ); ?></p>
			<h2 class="contact__title">
				<?php echo esc_html( $contact_title ); ?>
			</h2>
			<p class="contact__subtitle">
				<?php echo esc_html( $contact_subtitle ); ?>
			</p>

			<!-- Контакты -->
			<div class="contact__links">
				<a href="<?php echo esc_url( 'tel:' . ovklife_phone_link( $contact_phone ) ); ?>"
					class="contact__phone">
					<?php echo esc_html( $contact_phone ); ?>
				</a>
				<a href="<?php echo esc_url( 'mailto:' . $contact_email ); ?>"
					class="contact__email">
					<?php echo esc_html( $contact_email ); ?>
				</a>
				<a href="<?php echo esc_url( $contact_telegram ); ?>"
					class="contact__telegram"
					target="_blank"
					rel="noopener noreferrer">
					<?php ovklife_svg_icon( 'telegram.svg', 'contact__telegram-icon' ); ?>
					<span><?php esc_html_e( 'Telegram', 'ovklife' ); ?></span>
				</a>
			</div>

			<!-- Кнопка CTA (до реализации формы в Sprint-14) -->
			<a href="<?php echo esc_url( $contact_telegram ); ?>"
				class="landing-btn landing-btn--primary landing-btn--lg contact__cta"
				target="_blank"
				rel="noopener noreferrer">
				<?php echo esc_html( $contact_cta_text ); ?>
			</a>
		</div>
	</div>
</section>
