<?php
/**
 * SEO enhancements and Schema.org markup
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add Open Graph meta tags
 */
function insuffle_add_opengraph_tags() {
	if ( is_singular() ) {
		global $post;

		$title = get_the_title();
		$description = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 30 );
		$url = get_permalink();
		$image = has_post_thumbnail() ? get_the_post_thumbnail_url( $post->ID, 'full' ) : '';
		$site_name = get_bloginfo( 'name' );

		?>
		<!-- Open Graph Meta Tags -->
		<meta property="og:type" content="<?php echo is_singular( 'post' ) ? 'article' : 'website'; ?>">
		<meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
		<meta property="og:description" content="<?php echo esc_attr( wp_strip_all_tags( $description ) ); ?>">
		<meta property="og:url" content="<?php echo esc_url( $url ); ?>">
		<meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
		<?php if ( $image ) : ?>
			<meta property="og:image" content="<?php echo esc_url( $image ); ?>">
			<meta property="og:image:width" content="1200">
			<meta property="og:image:height" content="630">
		<?php endif; ?>

		<!-- Twitter Card Meta Tags -->
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
		<meta name="twitter:description" content="<?php echo esc_attr( wp_strip_all_tags( $description ) ); ?>">
		<?php if ( $image ) : ?>
			<meta name="twitter:image" content="<?php echo esc_url( $image ); ?>">
		<?php endif; ?>
		<?php
	}
}
add_action( 'wp_head', 'insuffle_add_opengraph_tags' );

/**
 * Add JSON-LD Schema.org structured data
 */
function insuffle_add_schema_markup() {
	if ( is_singular( 'post' ) ) {
		global $post;

		$schema = array(
			'@context'      => 'https://schema.org',
			'@type'         => 'BlogPosting',
			'headline'      => get_the_title(),
			'description'   => has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 30 ),
			'datePublished' => get_the_date( 'c' ),
			'dateModified'  => get_the_modified_date( 'c' ),
			'author'        => array(
				'@type' => 'Person',
				'name'  => get_the_author(),
			),
			'publisher'     => array(
				'@type' => 'Organization',
				'name'  => get_bloginfo( 'name' ),
				'logo'  => array(
					'@type' => 'ImageObject',
					'url'   => get_theme_mod( 'custom_logo' ) ? wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' ) : '',
				),
			),
		);

		if ( has_post_thumbnail() ) {
			$schema['image'] = array(
				'@type'  => 'ImageObject',
				'url'    => get_the_post_thumbnail_url( $post->ID, 'full' ),
				'width'  => 1200,
				'height' => 630,
			);
		}

		?>
		<script type="application/ld+json">
		<?php echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
		</script>
		<?php
	} elseif ( is_front_page() ) {
		$schema = array(
			'@context' => 'https://schema.org',
			'@type'    => 'WebSite',
			'name'     => get_bloginfo( 'name' ),
			'url'      => home_url( '/' ),
			'description' => get_bloginfo( 'description' ),
		);

		?>
		<script type="application/ld+json">
		<?php echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
		</script>
		<?php
	}
}
add_action( 'wp_head', 'insuffle_add_schema_markup' );

/**
 * Add breadcrumb schema
 */
function insuffle_breadcrumb_schema() {
	if ( is_front_page() ) {
		return;
	}

	$items = array();
	$position = 1;

	// Home
	$items[] = array(
		'@type'    => 'ListItem',
		'position' => $position++,
		'name'     => __( 'Accueil', 'insuffle-framework' ),
		'item'     => home_url( '/' ),
	);

	// Categories (for posts)
	if ( is_singular( 'post' ) ) {
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			$category = $categories[0];
			$items[] = array(
				'@type'    => 'ListItem',
				'position' => $position++,
				'name'     => $category->name,
				'item'     => get_category_link( $category->term_id ),
			);
		}
	}

	// Current page
	if ( is_singular() ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => get_the_title(),
			'item'     => get_permalink(),
		);
	} elseif ( is_category() ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => single_cat_title( '', false ),
		);
	} elseif ( is_tag() ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => single_tag_title( '', false ),
		);
	} elseif ( is_search() ) {
		$items[] = array(
			'@type'    => 'ListItem',
			'position' => $position,
			'name'     => sprintf( __( 'Résultats de recherche pour : %s', 'insuffle-framework' ), get_search_query() ),
		);
	}

	$schema = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $items,
	);

	?>
	<script type="application/ld+json">
	<?php echo wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
	</script>
	<?php
}
add_action( 'wp_head', 'insuffle_breadcrumb_schema' );

/**
 * Improve SEO titles
 */
function insuffle_document_title_separator( $sep ) {
	return '|';
}
add_filter( 'document_title_separator', 'insuffle_document_title_separator' );

/**
 * Add meta description
 */
function insuffle_add_meta_description() {
	if ( is_singular() ) {
		$description = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 30 );
		?>
		<meta name="description" content="<?php echo esc_attr( wp_strip_all_tags( $description ) ); ?>">
		<?php
	} elseif ( is_home() || is_front_page() ) {
		?>
		<meta name="description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
		<?php
	}
}
add_action( 'wp_head', 'insuffle_add_meta_description' );

/**
 * Add canonical URL
 */
function insuffle_add_canonical_url() {
	if ( is_singular() ) {
		?>
		<link rel="canonical" href="<?php echo esc_url( get_permalink() ); ?>">
		<?php
	}
}
add_action( 'wp_head', 'insuffle_add_canonical_url' );

/**
 * Add robots meta tag
 */
function insuffle_add_robots_meta() {
	if ( is_404() || is_search() ) {
		?>
		<meta name="robots" content="noindex, follow">
		<?php
	}
}
add_action( 'wp_head', 'insuffle_add_robots_meta' );
