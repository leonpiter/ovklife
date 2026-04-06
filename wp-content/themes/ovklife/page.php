<?php
/**
 * Шаблон отдельной страницы.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class(); ?>>
			<h1 class="mb-8 text-4xl font-bold text-secondary-900">
				<?php the_title(); ?>
			</h1>

			<div class="prose prose-lg max-w-none">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>
</div>

<?php
get_footer();
