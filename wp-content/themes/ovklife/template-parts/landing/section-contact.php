<?php
/**
 * Секция «Обратная связь» лендинга.
 *
 * CTA-блок с заголовком, контактами и формой обратной связи.
 * Форма будет реализована в Sprint-14 (AJAX + CPT lead).
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>

<section id="obratnaya-svyaz" class="landing-section landing-section--dark contact">
	<div class="landing-container">
		<div class="contact__content">
			<p class="contact__label"><?php esc_html_e( 'Консультация инженера по вашему проекту', 'ovklife' ); ?></p>
			<h2 class="contact__title">
				<?php esc_html_e( 'Планируете строительство или дизайн-проект?', 'ovklife' ); ?>
			</h2>
			<p class="contact__subtitle">
				<?php esc_html_e( 'Подключимся на стадии проекта и рассчитаем систему под ваш дом', 'ovklife' ); ?>
			</p>

			<!-- Контакты -->
			<div class="contact__links">
				<a href="<?php echo esc_url( 'tel:' . ovklife_phone_link( '+7 (921) 947-46-93' ) ); ?>"
					class="contact__phone">
					<?php esc_html_e( '+7 (921) 947-46-93', 'ovklife' ); ?>
				</a>
				<a href="<?php echo esc_url( 'mailto:service@ovk.life' ); ?>"
					class="contact__email">
					<?php esc_html_e( 'service@ovk.life', 'ovklife' ); ?>
				</a>
				<a href="<?php echo esc_url( 'https://t.me/engineer_integrator' ); ?>"
					class="contact__telegram"
					target="_blank"
					rel="noopener noreferrer">
					<?php ovklife_svg_icon( 'telegram.svg', 'contact__telegram-icon' ); ?>
					<span><?php esc_html_e( 'Telegram', 'ovklife' ); ?></span>
				</a>
			</div>

			<!-- Кнопка CTA (до реализации формы в Sprint-14) -->
			<a href="<?php echo esc_url( 'https://t.me/engineer_integrator' ); ?>"
				class="landing-btn landing-btn--primary landing-btn--lg contact__cta"
				target="_blank"
				rel="noopener noreferrer">
				<?php esc_html_e( 'Обсудить проект', 'ovklife' ); ?>
			</a>
		</div>
	</div>
</section>
