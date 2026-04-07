<?php
/**
 * SEO-модуль — Schema.org JSON-LD, мета-теги, Open Graph.
 *
 * Выводит структурированные данные для поисковых систем:
 * - Organization (на всех страницах)
 * - LocalBusiness (на главной и контактах)
 * - BreadcrumbList (на всех страницах)
 * - Мета-теги: description, canonical, OG
 *
 * @package OVKLife
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Выводит Organization Schema.org JSON-LD.
 */
function ovklife_schema_organization() {
	$phone   = get_theme_mod( 'ovklife_phone', '+7 (921) 947-46-93' );
	$email   = get_theme_mod( 'ovklife_email', 'info@ovklife.ru' );
	$address = get_theme_mod( 'ovklife_address', 'Санкт-Петербург и Ленинградская область' );

	$schema = [
		'@context'    => 'https://schema.org',
		'@type'       => 'Organization',
		'name'        => 'OVK Life',
		'description' => 'Инженерные системы для загородного дома — проектирование и монтаж в СПб и ЛО',
		'url'         => home_url( '/' ),
		'logo'        => get_template_directory_uri() . '/assets/images/landing/logo-ovklife.svg',
		'telephone'   => $phone,
		'email'       => $email,
		'address'     => [
			'@type'           => 'PostalAddress',
			'addressLocality' => 'Санкт-Петербург',
			'addressRegion'   => 'Ленинградская область',
			'addressCountry'  => 'RU',
		],
		'sameAs'      => [
			'https://t.me/engineer_integrator',
		],
	];

	return $schema;
}

/**
 * Выводит LocalBusiness Schema.org JSON-LD.
 */
function ovklife_schema_local_business() {
	$phone   = get_theme_mod( 'ovklife_phone', '+7 (921) 947-46-93' );
	$email   = get_theme_mod( 'ovklife_email', 'info@ovklife.ru' );
	$address = get_theme_mod( 'ovklife_address', 'Санкт-Петербург и Ленинградская область' );

	$schema = [
		'@context'                  => 'https://schema.org',
		'@type'                     => 'HomeAndConstructionBusiness',
		'name'                      => 'OVK Life — Инженерные системы',
		'description'               => 'Проектирование и монтаж инженерных систем для загородных домов в Санкт-Петербурге и Ленинградской области. Отопление, водоснабжение, электрика, вентиляция.',
		'url'                       => home_url( '/' ),
		'telephone'                 => $phone,
		'email'                     => $email,
		'priceRange'                => '₽₽₽',
		'address'                   => [
			'@type'           => 'PostalAddress',
			'addressLocality' => 'Санкт-Петербург',
			'addressRegion'   => 'Ленинградская область',
			'addressCountry'  => 'RU',
		],
		'areaServed'                => [
			[
				'@type' => 'City',
				'name'  => 'Санкт-Петербург',
			],
			[
				'@type' => 'State',
				'name'  => 'Ленинградская область',
			],
		],
		'openingHoursSpecification' => [
			[
				'@type'     => 'OpeningHoursSpecification',
				'dayOfWeek' => [ 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ],
				'opens'     => '09:00',
				'closes'    => '18:00',
			],
		],
	];

	return $schema;
}

/**
 * Выводит BreadcrumbList Schema.org JSON-LD.
 */
function ovklife_schema_breadcrumbs() {
	$items    = [];
	$position = 1;

	// Главная всегда первая.
	$items[] = [
		'@type'    => 'ListItem',
		'position' => $position,
		'name'     => 'Главная',
		'item'     => home_url( '/' ),
	];

	if ( is_singular( 'service' ) ) {
		++$position;
		$items[] = [
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => 'Услуги',
			'item'     => get_post_type_archive_link( 'service' ),
		];

		// Родительская услуга (если есть).
		$post   = get_post();
		$parent = $post ? $post->post_parent : 0;
		if ( $parent ) {
			++$position;
			$items[] = [
				'@type'    => 'ListItem',
				'position' => $position,
				'name'     => get_the_title( $parent ),
				'item'     => get_permalink( $parent ),
			];
		}

		++$position;
		$items[] = [
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => get_the_title(),
		];
	} elseif ( is_singular( 'project' ) ) {
		++$position;
		$items[] = [
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => 'Проекты',
			'item'     => get_post_type_archive_link( 'project' ),
		];

		++$position;
		$items[] = [
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => get_the_title(),
		];
	} elseif ( is_single() ) {
		++$position;
		$items[] = [
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => 'Блог',
			'item'     => get_permalink( get_option( 'page_for_posts' ) ),
		];

		++$position;
		$items[] = [
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => get_the_title(),
		];
	} elseif ( is_page() && ! is_front_page() ) {
		++$position;
		$items[] = [
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => get_the_title(),
		];
	}

	if ( count( $items ) < 2 ) {
		return null;
	}

	return [
		'@context'        => 'https://schema.org',
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $items,
	];
}

/**
 * Возвращает массив Service Schema.org для секции «Услуги» на главной.
 *
 * @return array Массив Service schema.
 */
function ovklife_schema_services() {
	$services = [
		[
			'name'        => 'Монтаж отопления',
			'description' => 'Проектирование и монтаж систем отопления для загородных домов в СПб и ЛО',
		],
		[
			'name'        => 'Монтаж вентиляции и кондиционирования',
			'description' => 'Приточно-вытяжная вентиляция и кондиционирование для частных домов',
		],
		[
			'name'        => 'Электромонтажные работы',
			'description' => 'Электроснабжение загородного дома — проводка, щиты, автоматика',
		],
		[
			'name'        => 'Водоснабжение и канализация',
			'description' => 'Монтаж водоснабжения и канализации для загородных домов',
		],
		[
			'name'        => 'Автоматизация инженерных систем',
			'description' => 'Управление инженерными системами и слаботочные сети',
		],
	];

	$schemas = [];
	foreach ( $services as $service ) {
		$schemas[] = [
			'@context'    => 'https://schema.org',
			'@type'       => 'Service',
			'name'        => $service['name'],
			'description' => $service['description'],
			'provider'    => [
				'@type' => 'Organization',
				'name'  => 'OVK Life',
			],
			'areaServed'  => [
				[
					'@type' => 'City',
					'name'  => 'Санкт-Петербург',
				],
				[
					'@type' => 'State',
					'name'  => 'Ленинградская область',
				],
			],
		];
	}

	return $schemas;
}

/**
 * Выводит все Schema.org JSON-LD в <head>.
 */
function ovklife_output_schema() {
	$schemas = [];

	// Organization — на всех страницах.
	$schemas[] = ovklife_schema_organization();

	// LocalBusiness — на главной и странице контактов.
	if ( is_front_page() || is_page( 'kontakty' ) ) {
		$schemas[] = ovklife_schema_local_business();
	}

	// Service — на главной (секция «Услуги»).
	if ( is_front_page() ) {
		$schemas = array_merge( $schemas, ovklife_schema_services() );
	}

	// BreadcrumbList — на всех, кроме главной.
	if ( ! is_front_page() ) {
		$breadcrumbs = ovklife_schema_breadcrumbs();
		if ( $breadcrumbs ) {
			$schemas[] = $breadcrumbs;
		}
	}

	foreach ( $schemas as $schema ) {
		echo '<script type="application/ld+json">';
		echo wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
		echo '</script>' . "\n";
	}
}
add_action( 'wp_head', 'ovklife_output_schema', 1 );

/**
 * Настраивает robots.txt через WordPress фильтр.
 *
 * @param string $output  Текущее содержимое robots.txt.
 * @param bool   $is_public True если сайт открыт для индексации.
 * @return string Обновлённое содержимое robots.txt.
 */
function ovklife_robots_txt( $output, $is_public ) {
	if ( ! $is_public ) {
		return $output;
	}

	$output  = "User-agent: *\n";
	$output .= "Allow: /\n";
	$output .= "Disallow: /wp-admin/\n";
	$output .= "Disallow: /wp-includes/\n";
	$output .= "Disallow: /wp-content/plugins/\n";
	$output .= "Disallow: /wp-content/cache/\n\n";
	$output .= "# Рекламные лендинги — noindex в meta, но разрешаем обход\n";
	$output .= "Allow: /lp/\n\n";
	$output .= 'Sitemap: ' . home_url( '/wp-sitemap.xml' ) . "\n";

	return $output;
}
add_filter( 'robots_txt', 'ovklife_robots_txt', 10, 2 );

/**
 * Убирает canonical на 404 страницах.
 * Добавляет noindex для рекламных лендингов.
 */
function ovklife_seo_adjustments() {
	// Рекламные лендинги — noindex.
	if ( is_page_template( 'templates/landing.php' ) ) {
		echo '<meta name="robots" content="noindex, nofollow">' . "\n";
	}
}
add_action( 'wp_head', 'ovklife_seo_adjustments', 0 );

/**
 * Выводит мета-тег description.
 */
function ovklife_meta_description() {
	$description = '';

	// Кастомное описание из мета-поля (Sprint-11: SEO мета-бокс).
	if ( is_singular() ) {
		$custom = get_post_meta( get_the_ID(), '_ovklife_seo_description', true );
		if ( $custom ) {
			$description = $custom;
		} elseif ( has_excerpt() ) {
			$description = get_the_excerpt();
		}
	} elseif ( is_front_page() ) {
		$description = 'OVK Life — проектирование и монтаж инженерных систем для загородных домов в СПб и Ленинградской области. Отопление, водоснабжение, электрика, вентиляция под ключ.';
	} elseif ( is_post_type_archive( 'service' ) ) {
		$description = 'Услуги по монтажу инженерных систем для загородного дома — отопление, водоснабжение, электрика, вентиляция, проектирование. OVK Life, СПб и ЛО.';
	} elseif ( is_post_type_archive( 'project' ) ) {
		$description = 'Портфолио реализованных проектов OVK Life — инженерные системы в загородных домах Санкт-Петербурга и Ленинградской области.';
	}

	if ( $description ) {
		$description = wp_strip_all_tags( $description );
		$description = mb_substr( $description, 0, 160 );
		echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'ovklife_meta_description', 2 );

/**
 * Выводит canonical URL.
 */
function ovklife_canonical_url() {
	// Нет canonical на 404 и рекламных лендингах.
	if ( is_404() || is_page_template( 'templates/landing.php' ) ) {
		return;
	}

	if ( is_singular() ) {
		echo '<link rel="canonical" href="' . esc_url( get_permalink() ) . '">' . "\n";
	} elseif ( is_front_page() ) {
		echo '<link rel="canonical" href="' . esc_url( home_url( '/' ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'ovklife_canonical_url', 3 );

/**
 * Выводит Open Graph мета-теги.
 */
function ovklife_open_graph() {
	$og_title       = wp_get_document_title();
	$og_url         = is_singular() ? get_permalink() : home_url( '/' );
	$og_type        = is_single() ? 'article' : 'website';
	$og_description = '';
	$og_image       = '';

	if ( is_singular() && has_post_thumbnail() ) {
		$og_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
	} elseif ( is_front_page() ) {
		// Hero-изображение как OG-image для главной.
		$og_image = get_template_directory_uri() . '/assets/images/landing/tild3135-3161-4533-a136-366237376433____1.jpg';
	}

	if ( is_singular() && has_excerpt() ) {
		$og_description = get_the_excerpt();
	} elseif ( is_front_page() ) {
		$og_description = 'Инженерные системы для загородного дома под ключ — проектирование и монтаж в СПб и ЛО';
	}

	echo '<meta property="og:title" content="' . esc_attr( $og_title ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( $og_url ) . '">' . "\n";
	echo '<meta property="og:type" content="' . esc_attr( $og_type ) . '">' . "\n";
	echo '<meta property="og:site_name" content="OVK Life">' . "\n";

	if ( $og_description ) {
		echo '<meta property="og:description" content="' . esc_attr( wp_strip_all_tags( $og_description ) ) . '">' . "\n";
	}

	if ( $og_image ) {
		echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'ovklife_open_graph', 4 );
