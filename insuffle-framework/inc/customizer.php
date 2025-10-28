<?php
/**
 * Customizer settings and controls
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register customizer settings
 */
function insuffle_customize_register( $wp_customize ) {

	// ===========================
	// SECTION: COULEURS
	// ===========================
	$wp_customize->add_section(
		'insuffle_colors',
		array(
			'title'    => __( 'Couleurs Insuffle', 'insuffle-framework' ),
			'priority' => 40,
		)
	);

	// Color Scheme selector
	$wp_customize->add_setting(
		'insuffle_color_scheme',
		array(
			'default'           => 'default',
			'sanitize_callback' => 'insuffle_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'insuffle_color_scheme',
		array(
			'label'   => __( 'Palette de couleurs', 'insuffle-framework' ),
			'section' => 'insuffle_colors',
			'type'    => 'select',
			'choices' => array(
				'default' => __( 'Par défaut (Bleu)', 'insuffle-framework' ),
				'green'   => __( 'Vert', 'insuffle-framework' ),
				'red'     => __( 'Rouge', 'insuffle-framework' ),
				'purple'  => __( 'Violet', 'insuffle-framework' ),
				'orange'  => __( 'Orange', 'insuffle-framework' ),
				'custom'  => __( 'Personnalisé', 'insuffle-framework' ),
			),
		)
	);

	// Primary Color (only visible when custom is selected)
	$wp_customize->add_setting(
		'insuffle_primary_color',
		array(
			'default'           => '#1f3a8b',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'insuffle_primary_color',
			array(
				'label'           => __( 'Couleur primaire', 'insuffle-framework' ),
				'section'         => 'insuffle_colors',
				'active_callback' => function() {
					return get_theme_mod( 'insuffle_color_scheme', 'default' ) === 'custom';
				},
			)
		)
	);

	// Secondary Color
	$wp_customize->add_setting(
		'insuffle_secondary_color',
		array(
			'default'           => '#ffde59',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'insuffle_secondary_color',
			array(
				'label'           => __( 'Couleur secondaire', 'insuffle-framework' ),
				'section'         => 'insuffle_colors',
				'active_callback' => function() {
					return get_theme_mod( 'insuffle_color_scheme', 'default' ) === 'custom';
				},
			)
		)
	);

	// Accent Color
	$wp_customize->add_setting(
		'insuffle_accent_color',
		array(
			'default'           => '#ff5959',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'insuffle_accent_color',
			array(
				'label'           => __( 'Couleur d\'accent', 'insuffle-framework' ),
				'section'         => 'insuffle_colors',
				'active_callback' => function() {
					return get_theme_mod( 'insuffle_color_scheme', 'default' ) === 'custom';
				},
			)
		)
	);

	// ===========================
	// SECTION: TYPOGRAPHIE
	// ===========================
	$wp_customize->add_section(
		'insuffle_typography',
		array(
			'title'    => __( 'Typographie', 'insuffle-framework' ),
			'priority' => 45,
		)
	);

	// Base font size
	$wp_customize->add_setting(
		'insuffle_base_font_size',
		array(
			'default'           => '16',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'insuffle_base_font_size',
		array(
			'label'       => __( 'Taille de police de base (px)', 'insuffle-framework' ),
			'section'     => 'insuffle_typography',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 12,
				'max'  => 24,
				'step' => 1,
			),
		)
	);

	// Heading font weight
	$wp_customize->add_setting(
		'insuffle_heading_weight',
		array(
			'default'           => '700',
			'sanitize_callback' => 'insuffle_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'insuffle_heading_weight',
		array(
			'label'   => __( 'Graisse des titres', 'insuffle-framework' ),
			'section' => 'insuffle_typography',
			'type'    => 'select',
			'choices' => array(
				'300' => __( 'Light (300)', 'insuffle-framework' ),
				'400' => __( 'Regular (400)', 'insuffle-framework' ),
				'500' => __( 'Medium (500)', 'insuffle-framework' ),
				'600' => __( 'Semi-Bold (600)', 'insuffle-framework' ),
				'700' => __( 'Bold (700)', 'insuffle-framework' ),
				'800' => __( 'Extra-Bold (800)', 'insuffle-framework' ),
			),
		)
	);

	// Line height
	$wp_customize->add_setting(
		'insuffle_line_height',
		array(
			'default'           => '1.5',
			'sanitize_callback' => 'insuffle_sanitize_float',
		)
	);

	$wp_customize->add_control(
		'insuffle_line_height',
		array(
			'label'       => __( 'Hauteur de ligne', 'insuffle-framework' ),
			'section'     => 'insuffle_typography',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 1,
				'max'  => 2.5,
				'step' => 0.1,
			),
		)
	);

	// ===========================
	// SECTION: HEADER
	// ===========================
	$wp_customize->add_section(
		'insuffle_header',
		array(
			'title'    => __( 'En-tête', 'insuffle-framework' ),
			'priority' => 50,
		)
	);

	// Header layout
	$wp_customize->add_setting(
		'insuffle_header_layout',
		array(
			'default'           => 'default',
			'sanitize_callback' => 'insuffle_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'insuffle_header_layout',
		array(
			'label'   => __( 'Disposition de l\'en-tête', 'insuffle-framework' ),
			'section' => 'insuffle_header',
			'type'    => 'select',
			'choices' => array(
				'default' => __( 'Par défaut', 'insuffle-framework' ),
				'centered' => __( 'Centré', 'insuffle-framework' ),
				'minimal' => __( 'Minimaliste', 'insuffle-framework' ),
			),
		)
	);

	// Sticky header
	$wp_customize->add_setting(
		'insuffle_sticky_header',
		array(
			'default'           => true,
			'sanitize_callback' => 'insuffle_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'insuffle_sticky_header',
		array(
			'label'   => __( 'En-tête fixe (sticky)', 'insuffle-framework' ),
			'section' => 'insuffle_header',
			'type'    => 'checkbox',
		)
	);

	// Header CTA Button Text
	$wp_customize->add_setting(
		'insuffle_header_cta_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'insuffle_header_cta_text',
		array(
			'label'   => __( 'Texte du bouton CTA', 'insuffle-framework' ),
			'section' => 'insuffle_header',
			'type'    => 'text',
		)
	);

	// Header CTA Button URL
	$wp_customize->add_setting(
		'insuffle_header_cta_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'insuffle_header_cta_url',
		array(
			'label'   => __( 'URL du bouton CTA', 'insuffle-framework' ),
			'section' => 'insuffle_header',
			'type'    => 'url',
		)
	);

	// ===========================
	// SECTION: FOOTER
	// ===========================
	$wp_customize->add_section(
		'insuffle_footer',
		array(
			'title'    => __( 'Pied de page', 'insuffle-framework' ),
			'priority' => 55,
		)
	);

	// Footer columns
	$wp_customize->add_setting(
		'insuffle_footer_columns',
		array(
			'default'           => '4',
			'sanitize_callback' => 'insuffle_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'insuffle_footer_columns',
		array(
			'label'   => __( 'Nombre de colonnes', 'insuffle-framework' ),
			'section' => 'insuffle_footer',
			'type'    => 'select',
			'choices' => array(
				'1' => __( '1 colonne', 'insuffle-framework' ),
				'2' => __( '2 colonnes', 'insuffle-framework' ),
				'3' => __( '3 colonnes', 'insuffle-framework' ),
				'4' => __( '4 colonnes', 'insuffle-framework' ),
			),
		)
	);

	// Footer text
	$wp_customize->add_setting(
		'insuffle_footer_text',
		array(
			'default'           => sprintf( __( '© %s Insuffle. Tous droits réservés.', 'insuffle-framework' ), date( 'Y' ) ),
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		'insuffle_footer_text',
		array(
			'label'   => __( 'Texte du copyright', 'insuffle-framework' ),
			'section' => 'insuffle_footer',
			'type'    => 'textarea',
		)
	);

	// Show Insuffle branding
	$wp_customize->add_setting(
		'insuffle_show_branding',
		array(
			'default'           => true,
			'sanitize_callback' => 'insuffle_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'insuffle_show_branding',
		array(
			'label'   => __( 'Afficher "Propulsé par Insuffle"', 'insuffle-framework' ),
			'section' => 'insuffle_footer',
			'type'    => 'checkbox',
		)
	);

	// ===========================
	// SECTION: LAYOUT
	// ===========================
	$wp_customize->add_section(
		'insuffle_layout',
		array(
			'title'    => __( 'Mise en page', 'insuffle-framework' ),
			'priority' => 60,
		)
	);

	// Container width
	$wp_customize->add_setting(
		'insuffle_container_width',
		array(
			'default'           => '1280',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'insuffle_container_width',
		array(
			'label'       => __( 'Largeur du conteneur (px)', 'insuffle-framework' ),
			'section'     => 'insuffle_layout',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 960,
				'max'  => 1920,
				'step' => 20,
			),
		)
	);

	// Border radius
	$wp_customize->add_setting(
		'insuffle_border_radius',
		array(
			'default'           => '16',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'insuffle_border_radius',
		array(
			'label'       => __( 'Arrondi des coins (px)', 'insuffle-framework' ),
			'section'     => 'insuffle_layout',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 50,
				'step' => 2,
			),
		)
	);

	// Section spacing
	$wp_customize->add_setting(
		'insuffle_section_spacing',
		array(
			'default'           => '64',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		'insuffle_section_spacing',
		array(
			'label'       => __( 'Espacement des sections (px)', 'insuffle-framework' ),
			'section'     => 'insuffle_layout',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 32,
				'max'  => 128,
				'step' => 8,
			),
		)
	);

	// ===========================
	// SECTION: BLOG
	// ===========================
	$wp_customize->add_section(
		'insuffle_blog',
		array(
			'title'    => __( 'Blog', 'insuffle-framework' ),
			'priority' => 65,
		)
	);

	// Blog layout
	$wp_customize->add_setting(
		'insuffle_blog_layout',
		array(
			'default'           => 'grid',
			'sanitize_callback' => 'insuffle_sanitize_select',
		)
	);

	$wp_customize->add_control(
		'insuffle_blog_layout',
		array(
			'label'   => __( 'Disposition du blog', 'insuffle-framework' ),
			'section' => 'insuffle_blog',
			'type'    => 'select',
			'choices' => array(
				'list' => __( 'Liste', 'insuffle-framework' ),
				'grid' => __( 'Grille', 'insuffle-framework' ),
				'card' => __( 'Cartes', 'insuffle-framework' ),
			),
		)
	);

	// Show featured image
	$wp_customize->add_setting(
		'insuffle_show_featured_image',
		array(
			'default'           => true,
			'sanitize_callback' => 'insuffle_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'insuffle_show_featured_image',
		array(
			'label'   => __( 'Afficher l\'image à la une', 'insuffle-framework' ),
			'section' => 'insuffle_blog',
			'type'    => 'checkbox',
		)
	);

	// Show post meta
	$wp_customize->add_setting(
		'insuffle_show_post_meta',
		array(
			'default'           => true,
			'sanitize_callback' => 'insuffle_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'insuffle_show_post_meta',
		array(
			'label'   => __( 'Afficher les métadonnées', 'insuffle-framework' ),
			'section' => 'insuffle_blog',
			'type'    => 'checkbox',
		)
	);

	// Show excerpt
	$wp_customize->add_setting(
		'insuffle_show_excerpt',
		array(
			'default'           => true,
			'sanitize_callback' => 'insuffle_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'insuffle_show_excerpt',
		array(
			'label'   => __( 'Afficher l\'extrait', 'insuffle-framework' ),
			'section' => 'insuffle_blog',
			'type'    => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'insuffle_customize_register' );

/**
 * Sanitize float value
 */
function insuffle_sanitize_float( $value ) {
	return floatval( $value );
}

/**
 * Enqueue customizer live preview script
 */
function insuffle_customize_preview_js() {
	wp_enqueue_script(
		'insuffle-customizer',
		get_template_directory_uri() . '/assets/js/customizer.js',
		array( 'customize-preview' ),
		INSUFFLE_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'insuffle_customize_preview_js' );

/**
 * Output customizer CSS variables
 */
function insuffle_customizer_css() {
	$color_scheme = get_theme_mod( 'insuffle_color_scheme', 'default' );

	// Define color schemes
	$schemes = array(
		'green'  => array(
			'primary' => '#2d7a3e',
			'secondary' => '#a8d08d',
			'accent' => '#1a472a',
		),
		'red'    => array(
			'primary' => '#c53030',
			'secondary' => '#fc8181',
			'accent' => '#742a2a',
		),
		'purple' => array(
			'primary' => '#6b46c1',
			'secondary' => '#d6bcfa',
			'accent' => '#44337a',
		),
		'orange' => array(
			'primary' => '#dd6b20',
			'secondary' => '#fbd38d',
			'accent' => '#7c2d12',
		),
	);

	$css = '<style id="insuffle-customizer-css">';
	$css .= ':root {';

	// Apply color scheme
	if ( $color_scheme === 'custom' ) {
		$primary = get_theme_mod( 'insuffle_primary_color', '#1f3a8b' );
		$secondary = get_theme_mod( 'insuffle_secondary_color', '#ffde59' );
		$accent = get_theme_mod( 'insuffle_accent_color', '#ff5959' );

		$css .= '--insuffle-primary: ' . esc_attr( $primary ) . ';';
		$css .= '--insuffle-secondary: ' . esc_attr( $secondary ) . ';';
		$css .= '--insuffle-accent: ' . esc_attr( $accent ) . ';';
	} elseif ( isset( $schemes[ $color_scheme ] ) ) {
		$css .= '--insuffle-primary: ' . esc_attr( $schemes[ $color_scheme ]['primary'] ) . ';';
		$css .= '--insuffle-secondary: ' . esc_attr( $schemes[ $color_scheme ]['secondary'] ) . ';';
		$css .= '--insuffle-accent: ' . esc_attr( $schemes[ $color_scheme ]['accent'] ) . ';';
	}

	// Typography
	$base_font_size = get_theme_mod( 'insuffle_base_font_size', 16 );
	$heading_weight = get_theme_mod( 'insuffle_heading_weight', 700 );
	$line_height = get_theme_mod( 'insuffle_line_height', 1.5 );

	$css .= '--insuffle-font-base: ' . esc_attr( $base_font_size ) . 'px;';
	$css .= '--insuffle-line-height-normal: ' . esc_attr( $line_height ) . ';';

	// Layout
	$container_width = get_theme_mod( 'insuffle_container_width', 1280 );
	$border_radius = get_theme_mod( 'insuffle_border_radius', 16 );
	$section_spacing = get_theme_mod( 'insuffle_section_spacing', 64 );

	$css .= '--insuffle-max-width-7xl: ' . esc_attr( $container_width ) . 'px;';
	$css .= '--insuffle-radius-lg: ' . esc_attr( $border_radius ) . 'px;';
	$css .= '--insuffle-space-4xl: ' . esc_attr( $section_spacing ) . 'px;';

	$css .= '}';

	// Heading weight
	$css .= 'h1, h2, h3, h4, h5, h6 { font-weight: ' . esc_attr( $heading_weight ) . '; }';

	$css .= '</style>';

	echo $css; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
add_action( 'wp_head', 'insuffle_customizer_css' );
