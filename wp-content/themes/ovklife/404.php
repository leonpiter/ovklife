<?php
/**
 * Страница 404.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="mx-auto flex min-h-[50vh] max-w-7xl flex-col items-center justify-center px-4 py-24 text-center sm:px-6 lg:px-8">
	<h1 class="mb-4 text-6xl font-bold text-primary-600">404</h1>
	<p class="mb-8 text-xl text-secondary-600">
		<?php esc_html_e( 'Страница не найдена', 'ovklife' ); ?>
	</p>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
	   class="inline-flex items-center rounded-lg bg-primary-600 px-6 py-3 text-white transition hover:bg-primary-700">
		<?php esc_html_e( 'На главную', 'ovklife' ); ?>
	</a>
</div>

<?php
get_footer();
