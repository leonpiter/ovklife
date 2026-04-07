<?php
/**
 * Главный шаблон.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
	<?php if ( is_home() && ! is_front_page() ) : ?>
		<h1 class="mb-8 text-3xl font-bold"><?php single_post_title(); ?></h1>
	<?php endif; ?>

	<?php if ( have_posts() ) : ?>
		<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'overflow-hidden rounded-lg border border-secondary-200 bg-white shadow-sm transition hover:shadow-md' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>">
							<?php
							the_post_thumbnail(
								'medium_large',
								[ 'class' => 'h-48 w-full object-cover' ]
							);
							?>
						</a>
					<?php endif; ?>

					<div class="p-6">
						<h2 class="mb-2 text-xl font-semibold">
							<a href="<?php the_permalink(); ?>"
								class="text-secondary-900 transition hover:text-primary-600">
								<?php the_title(); ?>
							</a>
						</h2>

						<div class="mb-4 text-sm text-secondary-500">
							<?php echo esc_html( get_the_date() ); ?>
						</div>

						<div class="text-secondary-600">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</article>
			<?php endwhile; ?>
		</div>

		<div class="mt-12">
			<?php
			the_posts_pagination(
				[
					'mid_size'  => 2,
					'prev_text' => esc_html__( '&larr; Назад', 'ovklife' ),
					'next_text' => esc_html__( 'Далее &rarr;', 'ovklife' ),
				]
			);
			?>
		</div>
	<?php else : ?>
		<p class="text-secondary-500"><?php esc_html_e( 'Записей не найдено.', 'ovklife' ); ?></p>
	<?php endif; ?>
</div>

<?php
get_footer();
