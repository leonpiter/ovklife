<?php
/**
 * Шаблон отдельной записи.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class(); ?>>
			<header class="mb-8">
				<h1 class="mb-4 text-4xl font-bold text-secondary-900">
					<?php the_title(); ?>
				</h1>
				<div class="text-sm text-secondary-500">
					<?php echo esc_html( get_the_date() ); ?>
					&middot;
					<?php echo esc_html( get_the_author() ); ?>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="mb-8">
					<?php
					the_post_thumbnail(
						'large',
						[ 'class' => 'w-full rounded-lg' ]
					);
					?>
				</div>
			<?php endif; ?>

			<div class="prose prose-lg max-w-none">
				<?php the_content(); ?>
			</div>
		</article>

		<nav class="mt-12 flex justify-between border-t border-secondary-200 pt-8">
			<div>
				<?php previous_post_link( '%link', '&larr; %title' ); ?>
			</div>
			<div>
				<?php next_post_link( '%link', '%title &rarr;' ); ?>
			</div>
		</nav>
	<?php endwhile; ?>
</div>

<?php
get_footer();
