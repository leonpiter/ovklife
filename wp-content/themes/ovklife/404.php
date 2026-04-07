<?php
/**
 * Кастомная страница 404.
 *
 * Отображается при обращении к несуществующей странице.
 * Содержит навигацию к основным разделам сайта.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'landing' );
?>

<section class="error-404">
	<div class="landing-container">
		<div class="error-404__content">
			<h1 class="error-404__title">404</h1>
			<p class="error-404__subtitle">
				<?php esc_html_e( 'Страница не найдена', 'ovklife' ); ?>
			</p>
			<p class="error-404__text">
				<?php esc_html_e( 'Запрашиваемая страница не существует или была перемещена. Воспользуйтесь навигацией ниже.', 'ovklife' ); ?>
			</p>

			<nav class="error-404__nav" aria-label="<?php esc_attr_e( 'Навигация по сайту', 'ovklife' ); ?>">
				<ul class="error-404__links" role="list">
					<li>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="error-404__link">
							<?php esc_html_e( 'Главная', 'ovklife' ); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/#uslugi' ) ); ?>" class="error-404__link">
							<?php esc_html_e( 'Услуги', 'ovklife' ); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/#obekty' ) ); ?>" class="error-404__link">
							<?php esc_html_e( 'Объекты', 'ovklife' ); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/#obratnaya-svyaz' ) ); ?>" class="error-404__link">
							<?php esc_html_e( 'Контакты', 'ovklife' ); ?>
						</a>
					</li>
				</ul>
			</nav>

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="landing-btn landing-btn--primary landing-btn--lg error-404__cta">
				<?php esc_html_e( 'На главную', 'ovklife' ); ?>
			</a>
		</div>
	</div>
</section>

<?php
get_footer( 'landing' );
