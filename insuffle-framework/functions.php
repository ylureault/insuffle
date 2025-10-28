<?php
/**
 * Insuffle Framework - Functions and definitions
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Insuffle Framework version
 */
define( 'INSUFFLE_VERSION', '1.0.0' );

/**
 * Set up theme defaults and register support for various WordPress features
 */
function insuffle_setup() {
	// Make theme available for translation
	load_theme_textdomain( 'insuffle-framework', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages
	add_theme_support( 'post-thumbnails' );

	// Set default post thumbnail size
	set_post_thumbnail_size( 1200, 675, true );

	// Add additional image sizes
	add_image_size( 'insuffle-hero', 1920, 1080, true );
	add_image_size( 'insuffle-card', 600, 400, true );
	add_image_size( 'insuffle-thumbnail', 400, 300, true );

	// Register navigation menus
	register_nav_menus(
		array(
			'primary'   => esc_html__( 'Menu Principal', 'insuffle-framework' ),
			'secondary' => esc_html__( 'Menu Secondaire', 'insuffle-framework' ),
			'footer'    => esc_html__( 'Menu Footer', 'insuffle-framework' ),
			'social'    => esc_html__( 'Liens Sociaux', 'insuffle-framework' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments to output valid HTML5
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for custom logo
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Add support for responsive embedded content
	add_theme_support( 'responsive-embeds' );

	// Add support for editor styles
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles
	add_editor_style( 'assets/css/editor-style.css' );

	// Add support for full and wide align images
	add_theme_support( 'align-wide' );

	// Add support for Block Styles
	add_theme_support( 'wp-block-styles' );

	// Add support for custom line height controls
	add_theme_support( 'custom-line-height' );

	// Add support for custom spacing controls
	add_theme_support( 'custom-spacing' );

	// Add support for custom units
	add_theme_support( 'custom-units' );

	// Add support for link color control
	add_theme_support( 'link-color' );

	// Add support for experimental cover block spacing
	add_theme_support( 'experimental-custom-spacing' );

	// Add support for custom color palette in Gutenberg
	add_theme_support( 'editor-color-palette' );

	// Disable custom colors in Gutenberg (use theme colors only)
	add_theme_support( 'disable-custom-colors' );

	// Add excerpt support for pages
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'insuffle_setup' );

/**
 * Set the content width in pixels, based on the theme's design
 */
function insuffle_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'insuffle_content_width', 1280 );
}
add_action( 'after_setup_theme', 'insuffle_content_width', 0 );

/**
 * Register widget areas
 */
function insuffle_widgets_init() {
	// Sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'insuffle-framework' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Ajoutez des widgets ici pour qu\'ils apparaissent dans la sidebar.', 'insuffle-framework' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	// Footer widgets
	for ( $i = 1; $i <= 4; $i++ ) {
		register_sidebar(
			array(
				'name'          => sprintf( esc_html__( 'Footer %d', 'insuffle-framework' ), $i ),
				'id'            => 'footer-' . $i,
				'description'   => sprintf( esc_html__( 'Zone de widgets pour le footer %d.', 'insuffle-framework' ), $i ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}
}
add_action( 'widgets_init', 'insuffle_widgets_init' );

/**
 * Enqueue Google Fonts - Poppins
 */
function insuffle_fonts_url() {
	$fonts_url = '';

	// Poppins font - all weights
	$font_families = array();
	$font_families[] = 'Poppins:300,400,500,600,700,800';

	$query_args = array(
		'family'  => urlencode( implode( '|', $font_families ) ),
		'subset'  => urlencode( 'latin,latin-ext' ),
		'display' => urlencode( 'swap' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles
 */
function insuffle_scripts() {
	// Enqueue Google Fonts
	wp_enqueue_style( 'insuffle-fonts', insuffle_fonts_url(), array(), null );

	// Main stylesheet
	wp_enqueue_style( 'insuffle-style', get_stylesheet_uri(), array(), INSUFFLE_VERSION );

	// Global styles
	wp_enqueue_style( 'insuffle-global', get_template_directory_uri() . '/assets/css/global.css', array( 'insuffle-style' ), INSUFFLE_VERSION );

	// Components styles
	wp_enqueue_style( 'insuffle-components', get_template_directory_uri() . '/assets/css/components.css', array( 'insuffle-global' ), INSUFFLE_VERSION );

	// Responsive styles
	wp_enqueue_style( 'insuffle-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array( 'insuffle-components' ), INSUFFLE_VERSION );

	// Navigation script
	wp_enqueue_script( 'insuffle-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), INSUFFLE_VERSION, true );

	// Main script
	wp_enqueue_script( 'insuffle-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), INSUFFLE_VERSION, true );

	// Localize script for AJAX and translations
	wp_localize_script(
		'insuffle-main',
		'insuffleData',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'insuffle-nonce' ),
		)
	);

	// Comment reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'insuffle_scripts' );

/**
 * Enqueue block editor assets
 */
function insuffle_block_editor_assets() {
	// Editor styles
	wp_enqueue_style(
		'insuffle-block-editor-styles',
		get_template_directory_uri() . '/assets/css/editor-style.css',
		array(),
		INSUFFLE_VERSION
	);

	// Google Fonts in editor
	wp_enqueue_style( 'insuffle-editor-fonts', insuffle_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'insuffle_block_editor_assets' );

/**
 * Custom template tags for this theme
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Theme options panel
 */
require get_template_directory() . '/inc/options.php';

/**
 * Custom blocks and block patterns
 */
require get_template_directory() . '/inc/blocks.php';

/**
 * SEO and Schema.org enhancements
 */
require get_template_directory() . '/inc/seo.php';

/**
 * Add custom body classes
 */
function insuffle_body_classes( $classes ) {
	// Add class if sidebar is active
	if ( is_active_sidebar( 'sidebar-1' ) && ! is_page_template( 'templates/custom/landing.php' ) ) {
		$classes[] = 'has-sidebar';
	}

	// Add class for page templates
	if ( is_page_template() ) {
		$template_slug = basename( get_page_template_slug(), '.php' );
		$classes[] = 'template-' . $template_slug;
	}

	// Add class for singular posts
	if ( is_singular() ) {
		$classes[] = 'singular';
	}

	// Add class based on customizer settings
	$color_scheme = get_theme_mod( 'insuffle_color_scheme', 'default' );
	$classes[] = 'color-scheme-' . $color_scheme;

	return $classes;
}
add_filter( 'body_class', 'insuffle_body_classes' );

/**
 * Add custom post classes
 */
function insuffle_post_classes( $classes ) {
	// Add has-thumbnail class if post has thumbnail
	if ( has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'insuffle_post_classes' );

/**
 * Modify excerpt length
 */
function insuffle_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'insuffle_excerpt_length' );

/**
 * Modify excerpt more string
 */
function insuffle_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'insuffle_excerpt_more' );

/**
 * Add pingback header for single posts
 */
function insuffle_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'insuffle_pingback_header' );

/**
 * Custom breadcrumb function
 */
function insuffle_breadcrumb() {
	if ( ! is_front_page() ) {
		echo '<nav class="breadcrumb" aria-label="' . esc_attr__( 'Fil d\'Ariane', 'insuffle-framework' ) . '">';
		echo '<ol class="breadcrumb-list">';
		echo '<li class="breadcrumb-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Accueil', 'insuffle-framework' ) . '</a></li>';

		if ( is_category() || is_single() ) {
			echo '<li class="breadcrumb-item">';
			the_category( ', ' );
			echo '</li>';
			if ( is_single() ) {
				echo '<li class="breadcrumb-item active" aria-current="page">';
				the_title();
				echo '</li>';
			}
		} elseif ( is_page() ) {
			if ( wp_get_post_parent_id( get_the_ID() ) ) {
				$parent_id = wp_get_post_parent_id( get_the_ID() );
				$breadcrumbs = array();
				while ( $parent_id ) {
					$page = get_page( $parent_id );
					$breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a></li>';
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse( $breadcrumbs );
				foreach ( $breadcrumbs as $crumb ) {
					echo $crumb;
				}
			}
			echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html( get_the_title() ) . '</li>';
		} elseif ( is_search() ) {
			echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html__( 'Résultats de recherche pour : ', 'insuffle-framework' ) . get_search_query() . '</li>';
		} elseif ( is_404() ) {
			echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html__( 'Erreur 404', 'insuffle-framework' ) . '</li>';
		}

		echo '</ol>';
		echo '</nav>';
	}
}

/**
 * Sanitize checkbox
 */
function insuffle_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}

/**
 * Sanitize select
 */
function insuffle_sanitize_select( $input, $setting ) {
	$input = sanitize_key( $input );
	$choices = $setting->manager->get_control( $setting->id )->choices;
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
