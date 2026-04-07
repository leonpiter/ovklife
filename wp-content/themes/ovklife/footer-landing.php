<?php
/**
 * Подвал лендинга.
 *
 * Альтернативный footer для лендинг-страниц.
 * Загружается через get_footer( 'landing' ).
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>
</main><!-- .landing-main -->

<footer class="landing-footer">
	<div class="landing-footer__inner landing-container">
		<!-- Верхняя часть -->
		<div class="landing-footer__top">
			<!-- Логотип -->
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
				class="landing-footer__logo"
				aria-label="OVK Life">
				<?php ovklife_svg_icon( 'logo-icon.svg', 'landing-footer__logo-icon' ); ?>
				<?php ovklife_svg_icon( 'logo-text.svg', 'landing-footer__logo-text' ); ?>
			</a>

			<!-- Контакты -->
			<div class="landing-footer__contacts">
				<?php ovklife_phone_button( 'landing-footer__phone' ); ?>

				<div class="landing-footer__telegram">
					<?php ovklife_svg_icon( 'telegram.svg', 'landing-footer__telegram-icon' ); ?>
					<?php ovklife_telegram_link( 'engineer_integrator', 'landing-footer__telegram-link' ); ?>
				</div>
			</div>

			<!-- Навигация -->
			<nav class="landing-footer__nav"
				aria-label="<?php esc_attr_e( 'Навигация подвала', 'ovklife' ); ?>">
				<ul class="landing-footer__nav-list" role="list">
					<li class="landing-footer__nav-item">
						<a href="#obekty" class="landing-footer__nav-link">
							<?php esc_html_e( 'Объекты', 'ovklife' ); ?>
						</a>
					</li>
					<li class="landing-footer__nav-item">
						<a href="#ehtapy-rabot" class="landing-footer__nav-link">
							<?php esc_html_e( 'Этапы работ', 'ovklife' ); ?>
						</a>
					</li>
					<li class="landing-footer__nav-item">
						<a href="#uslugi" class="landing-footer__nav-link">
							<?php esc_html_e( 'Услуги', 'ovklife' ); ?>
						</a>
					</li>
					<li class="landing-footer__nav-item">
						<a href="#primer-proekta" class="landing-footer__nav-link">
							<?php esc_html_e( 'Пример проекта', 'ovklife' ); ?>
						</a>
					</li>
				</ul>
			</nav>
		</div>

		<!-- Нижняя полоса -->
		<div class="landing-footer__bottom">
			<p class="landing-footer__copy">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
				OVK Life. <?php esc_html_e( 'Все права защищены.', 'ovklife' ); ?>
			</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
