<?php
/**
 * Шапка сайта.
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
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'font-sans antialiased text-secondary-900' ); ?>>
<?php wp_body_open(); ?>

<header class="sticky top-0 z-50 border-b border-secondary-200 bg-white shadow-sm">
	<div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
		<!-- Логотип -->
		<div class="flex items-center">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-bold text-primary-700">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<!-- Навигация -->
		<nav class="hidden md:block">
			<?php
			wp_nav_menu(
				[
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'flex items-center gap-8',
					'fallback_cb'    => false,
					'depth'          => 2,
				]
			);
			?>
		</nav>

		<!-- Телефон -->
		<?php
		$phone = get_theme_mod( 'ovklife_phone', '+7 (XXX) XXX-XX-XX' );
		if ( $phone ) :
			?>
			<div class="hidden items-center gap-2 lg:flex">
				<a href="tel:<?php echo esc_attr( preg_replace( '/[^+0-9]/', '', $phone ) ); ?>"
				   class="text-lg font-semibold text-primary-700 transition hover:text-primary-500">
					<?php echo esc_html( $phone ); ?>
				</a>
			</div>
		<?php endif; ?>

		<!-- Мобильное меню (кнопка) -->
		<button type="button"
				class="inline-flex items-center justify-center rounded-md p-2 text-secondary-500 hover:bg-secondary-100 hover:text-secondary-700 md:hidden"
				aria-label="<?php esc_attr_e( 'Открыть меню', 'ovklife' ); ?>">
			<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
			</svg>
		</button>
	</div>
</header>

<main>
