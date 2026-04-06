<?php
/**
 * Подвал сайта.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>
</main>

<footer class="mt-auto border-t border-secondary-200 bg-secondary-900 text-secondary-300">
	<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
		<div class="grid grid-cols-1 gap-8 md:grid-cols-3">
			<!-- О компании -->
			<div>
				<h3 class="mb-4 text-lg font-semibold text-white">
					<?php bloginfo( 'name' ); ?>
				</h3>
				<p class="text-sm leading-relaxed">
					<?php echo esc_html( get_bloginfo( 'description' ) ); ?>
				</p>
			</div>

			<!-- Навигация -->
			<div>
				<h3 class="mb-4 text-lg font-semibold text-white">
					<?php esc_html_e( 'Навигация', 'ovklife' ); ?>
				</h3>
				<?php
				wp_nav_menu(
					[
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'space-y-2 text-sm',
						'fallback_cb'    => false,
						'depth'          => 1,
					]
				);
				?>
			</div>

			<!-- Контакты -->
			<div>
				<h3 class="mb-4 text-lg font-semibold text-white">
					<?php esc_html_e( 'Контакты', 'ovklife' ); ?>
				</h3>
				<ul class="space-y-2 text-sm">
					<?php
					$phone   = get_theme_mod( 'ovklife_phone' );
					$email   = get_theme_mod( 'ovklife_email' );
					$address = get_theme_mod( 'ovklife_address' );

					if ( $phone ) :
						?>
						<li>
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^+0-9]/', '', $phone ) ); ?>"
							   class="transition hover:text-white">
								<?php echo esc_html( $phone ); ?>
							</a>
						</li>
					<?php endif; ?>

					<?php if ( $email ) : ?>
						<li>
							<a href="mailto:<?php echo esc_attr( $email ); ?>"
							   class="transition hover:text-white">
								<?php echo esc_html( $email ); ?>
							</a>
						</li>
					<?php endif; ?>

					<?php if ( $address ) : ?>
						<li><?php echo esc_html( $address ); ?></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>

		<!-- Копирайт -->
		<div class="mt-8 border-t border-secondary-700 pt-8 text-center text-sm">
			<p>
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
				<?php bloginfo( 'name' ); ?>.
				<?php esc_html_e( 'Все права защищены.', 'ovklife' ); ?>
			</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
