<?php
/**
 * Компонент хлебных крошек (HTML).
 *
 * Переиспользуемый компонент для всех типов страниц.
 * JSON-LD Schema генерируется отдельно в inc/seo.php.
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Выводит HTML хлебных крошек.
 *
 * Поддерживает: страницы, CPT service (иерархия), CPT project, записи блога.
 * На главной не выводится.
 */
function ovklife_breadcrumbs() {
	if ( is_front_page() ) {
		return;
	}

	$items = [];

	// Главная — всегда первая.
	$items[] = [
		'label' => __( 'Главная', 'ovklife' ),
		'url'   => home_url( '/' ),
	];

	if ( is_singular( 'service' ) ) {
		$items[] = [
			'label' => __( 'Услуги', 'ovklife' ),
			'url'   => get_post_type_archive_link( 'service' ),
		];

		// Родительская услуга (если есть).
		$post   = get_post();
		$parent = $post ? $post->post_parent : 0;
		if ( $parent ) {
			$items[] = [
				'label' => get_the_title( $parent ),
				'url'   => get_permalink( $parent ),
			];
		}

		$items[] = [ 'label' => get_the_title() ];

	} elseif ( is_singular( 'project' ) ) {
		$items[] = [
			'label' => __( 'Проекты', 'ovklife' ),
			'url'   => get_post_type_archive_link( 'project' ),
		];
		$items[] = [ 'label' => get_the_title() ];

	} elseif ( is_single() ) {
		$page_for_posts = get_option( 'page_for_posts' );
		if ( $page_for_posts ) {
			$items[] = [
				'label' => __( 'Блог', 'ovklife' ),
				'url'   => get_permalink( $page_for_posts ),
			];
		}
		$items[] = [ 'label' => get_the_title() ];

	} elseif ( is_post_type_archive( 'service' ) ) {
		$items[] = [ 'label' => __( 'Услуги', 'ovklife' ) ];

	} elseif ( is_post_type_archive( 'project' ) ) {
		$items[] = [ 'label' => __( 'Проекты', 'ovklife' ) ];

	} elseif ( is_page() ) {
		// Иерархические страницы — собираем цепочку предков.
		$post      = get_post();
		$ancestors = $post ? get_post_ancestors( $post ) : [];
		$ancestors = array_reverse( $ancestors );

		foreach ( $ancestors as $ancestor_id ) {
			$items[] = [
				'label' => get_the_title( $ancestor_id ),
				'url'   => get_permalink( $ancestor_id ),
			];
		}

		$items[] = [ 'label' => get_the_title() ];

	} elseif ( is_category() || is_tag() ) {
		$items[] = [ 'label' => single_term_title( '', false ) ];

	} elseif ( is_search() ) {
		/* translators: %s: Поисковый запрос */
		$items[] = [ 'label' => sprintf( __( 'Результаты поиска: %s', 'ovklife' ), get_search_query() ) ];

	} elseif ( is_404() ) {
		$items[] = [ 'label' => __( 'Страница не найдена', 'ovklife' ) ];
	}

	// Нужно минимум 2 элемента для хлебных крошек.
	if ( count( $items ) < 2 ) {
		return;
	}

	$last_index = count( $items ) - 1;
	?>
	<nav class="breadcrumbs" aria-label="<?php esc_attr_e( 'Хлебные крошки', 'ovklife' ); ?>">
		<ol class="breadcrumbs__list" role="list">
			<?php foreach ( $items as $index => $item ) : ?>
			<li class="breadcrumbs__item">
				<?php if ( $index < $last_index && ! empty( $item['url'] ) ) : ?>
				<a href="<?php echo esc_url( $item['url'] ); ?>" class="breadcrumbs__link">
					<?php echo esc_html( $item['label'] ); ?>
				</a>
				<span class="breadcrumbs__separator" aria-hidden="true">›</span>
				<?php else : ?>
				<span class="breadcrumbs__current" aria-current="page">
					<?php echo esc_html( $item['label'] ); ?>
				</span>
				<?php endif; ?>
			</li>
			<?php endforeach; ?>
		</ol>
	</nav>
	<?php
}
