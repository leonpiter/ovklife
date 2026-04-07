<?php
/**
 * Шапка лендинга.
 *
 * Альтернативный header для лендинг-страниц.
 * Загружается через get_header( 'landing' ).
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php // Preconnect для внешних ресурсов (Google Fonts). ?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<?php // Preload Hero-изображения для ускорения LCP. ?>
	<?php if ( is_front_page() ) : ?>
	<link rel="preload"
		as="image"
		href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/landing/tild3135-3161-4533-a136-366237376433____1.jpg' ); ?>"
		fetchpriority="high">
	<?php endif; ?>

	<?php // Preload основного начертания шрифта Inter. ?>
	<link rel="preload"
		as="font"
		type="font/woff2"
		href="https://fonts.gstatic.com/s/inter/v18/UcCO3FwrK3iLTeHuS_nVMrMxCp50SjIw2boKoduKmMEVuLyfAZ9hjQ.woff2"
		crossorigin>

	<?php wp_head(); ?>
</head>
<body <?php body_class( 'landing-page' ); ?>>
<?php wp_body_open(); ?>

<?php // Skip-to-content для скринридеров и keyboard navigation. ?>
<a href="#main-content" class="skip-to-content">
	<?php esc_html_e( 'Перейти к основному содержимому', 'ovklife' ); ?>
</a>

<!-- Навигация -->
<header class="landing-nav" role="banner">
	<div class="landing-nav__inner landing-container">
		<!-- Логотип -->
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
			class="landing-nav__logo"
			aria-label="<?php esc_attr_e( 'OVK Life — на главную', 'ovklife' ); ?>">
			<?php ovklife_svg_icon( 'logo-icon.svg', 'landing-nav__logo-icon' ); ?>
			<?php ovklife_svg_icon( 'logo-text.svg', 'landing-nav__logo-text' ); ?>
		</a>

		<!-- Бургер -->
		<button type="button"
				class="landing-nav__burger"
				aria-label="<?php esc_attr_e( 'Открыть меню', 'ovklife' ); ?>"
				aria-expanded="false"
				aria-controls="landing-menu">
			<span class="landing-nav__burger-line"></span>
			<span class="landing-nav__burger-line"></span>
			<span class="landing-nav__burger-line"></span>
		</button>
	</div>
</header>

<!-- Выдвижное меню -->
<div class="landing-menu" id="landing-menu">
	<div class="landing-menu__overlay"></div>
	<div class="landing-menu__panel" role="dialog" aria-label="<?php esc_attr_e( 'Меню навигации', 'ovklife' ); ?>">
		<!-- Кнопка закрытия -->
		<button type="button"
				class="landing-menu__close"
				aria-label="<?php esc_attr_e( 'Закрыть меню', 'ovklife' ); ?>">
			<span class="landing-menu__close-icon"></span>
		</button>

		<!-- Навигация -->
		<nav aria-label="<?php esc_attr_e( 'Основная навигация', 'ovklife' ); ?>">
			<ul class="landing-menu__list" role="list">
				<li class="landing-menu__item">
					<a href="#obekty" class="landing-menu__link">
						<?php esc_html_e( 'Объекты', 'ovklife' ); ?>
					</a>
				</li>
				<li class="landing-menu__item">
					<a href="#ehtapy-rabot" class="landing-menu__link">
						<?php esc_html_e( 'Этапы работ', 'ovklife' ); ?>
					</a>
				</li>
				<li class="landing-menu__item">
					<a href="#uslugi" class="landing-menu__link">
						<?php esc_html_e( 'Услуги', 'ovklife' ); ?>
					</a>
				</li>
				<li class="landing-menu__item">
					<a href="#primer-proekta" class="landing-menu__link">
						<?php esc_html_e( 'Пример проекта', 'ovklife' ); ?>
					</a>
				</li>
			</ul>
		</nav>

		<!-- Контакты -->
		<div class="landing-menu__contacts">
			<?php ovklife_phone_button( 'landing-menu__phone' ); ?>

			<div class="landing-menu__telegram">
				<?php ovklife_svg_icon( 'telegram.svg', 'landing-menu__telegram-icon' ); ?>
				<?php ovklife_telegram_link( 'engineer_integrator', 'landing-menu__telegram-link' ); ?>
			</div>
		</div>

		<!-- CTA -->
		<a href="#obratnaya-svyaz" class="landing-menu__cta">
			<?php esc_html_e( 'Обсудить проект', 'ovklife' ); ?>
		</a>
	</div>
</div>

<!-- Основной контент -->
<main class="landing-main" id="main-content" role="main">
