<?php
/**
 * Custom blocks and block patterns
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register block patterns category
 */
function insuffle_register_block_pattern_category() {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'insuffle',
			array( 'label' => __( 'Insuffle', 'insuffle-framework' ) )
		);
	}
}
add_action( 'init', 'insuffle_register_block_pattern_category' );

/**
 * Register block patterns
 */
function insuffle_register_block_patterns() {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	// Hero Section Pattern
	register_block_pattern(
		'insuffle/hero-section',
		array(
			'title'       => __( 'Hero Section', 'insuffle-framework' ),
			'description' => __( 'Section hero pleine largeur avec titre et CTA', 'insuffle-framework' ),
			'categories'  => array( 'insuffle' ),
			'content'     => '<!-- wp:cover {"url":"","dimRatio":50,"overlayColor":"primary","align":"full","style":{"spacing":{"padding":{"top":"6rem","bottom":"6rem"}}}} -->
			<div class="wp-block-cover alignfull"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1,"textColor":"white"} -->
			<h1 class="has-text-align-center has-white-color has-text-color">Bienvenue chez Insuffle</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center","textColor":"white","fontSize":"lg"} -->
			<p class="has-text-align-center has-white-color has-text-color has-lg-font-size">Votre partenaire pour la transformation digitale</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"2rem"}}}} -->
			<div class="wp-block-buttons" style="margin-top:2rem"><!-- wp:button {"backgroundColor":"secondary","textColor":"text","className":"is-style-fill"} -->
			<div class="wp-block-button is-style-fill"><a class="wp-block-button__link has-text-color has-secondary-background-color has-text-color has-background">Commencer</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons --></div></div>
			<!-- /wp:cover -->',
		)
	);

	// Call to Action Pattern
	register_block_pattern(
		'insuffle/cta-section',
		array(
			'title'       => __( 'Section Call-to-Action', 'insuffle-framework' ),
			'description' => __( 'Section CTA avec fond coloré', 'insuffle-framework' ),
			'categories'  => array( 'insuffle' ),
			'content'     => '<!-- wp:group {"backgroundColor":"primary-light","style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem","left":"2rem","right":"2rem"},"margin":{"top":"3rem","bottom":"3rem"}}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group has-primary-light-background-color has-background" style="margin-top:3rem;margin-bottom:3rem;padding-top:3rem;padding-right:2rem;padding-bottom:3rem;padding-left:2rem"><!-- wp:heading {"textAlign":"center","textColor":"primary"} -->
			<h2 class="has-text-align-center has-primary-color has-text-color">Prêt à commencer ?</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center">Découvrez comment nous pouvons vous aider à atteindre vos objectifs.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"2rem"}}}} -->
			<div class="wp-block-buttons" style="margin-top:2rem"><!-- wp:button {"backgroundColor":"primary","textColor":"white"} -->
			<div class="wp-block-button"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background">Contactez-nous</a></div>
			<!-- /wp:button --></div>
			<!-- /wp:buttons --></div>
			<!-- /wp:group -->',
		)
	);

	// Features 3 Columns Pattern
	register_block_pattern(
		'insuffle/features-3-columns',
		array(
			'title'       => __( 'Fonctionnalités 3 colonnes', 'insuffle-framework' ),
			'description' => __( 'Grille de 3 colonnes pour présenter des fonctionnalités', 'insuffle-framework' ),
			'categories'  => array( 'insuffle' ),
			'content'     => '<!-- wp:columns {"style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem"},"blockGap":{"top":"2rem","left":"2rem"}}}} -->
			<div class="wp-block-columns" style="padding-top:3rem;padding-bottom:3rem"><!-- wp:column {"style":{"spacing":{"padding":{"top":"2rem","right":"2rem","bottom":"2rem","left":"2rem"}}},"backgroundColor":"bg-light"} -->
			<div class="wp-block-column has-bg-light-background-color has-background" style="padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem"><!-- wp:heading {"level":3,"textColor":"primary"} -->
			<h3 class="has-primary-color has-text-color">Rapide</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Performance optimisée pour une expérience utilisateur fluide.</p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:column -->

			<!-- wp:column {"style":{"spacing":{"padding":{"top":"2rem","right":"2rem","bottom":"2rem","left":"2rem"}}},"backgroundColor":"bg-light"} -->
			<div class="wp-block-column has-bg-light-background-color has-background" style="padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem"><!-- wp:heading {"level":3,"textColor":"primary"} -->
			<h3 class="has-primary-color has-text-color">Flexible</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Personnalisable selon vos besoins et votre identité visuelle.</p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:column -->

			<!-- wp:column {"style":{"spacing":{"padding":{"top":"2rem","right":"2rem","bottom":"2rem","left":"2rem"}}},"backgroundColor":"bg-light"} -->
			<div class="wp-block-column has-bg-light-background-color has-background" style="padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem"><!-- wp:heading {"level":3,"textColor":"primary"} -->
			<h3 class="has-primary-color has-text-color">Moderne</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Design contemporain et élégant qui valorise votre contenu.</p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns -->',
		)
	);

	// Testimonial Pattern
	register_block_pattern(
		'insuffle/testimonial',
		array(
			'title'       => __( 'Témoignage', 'insuffle-framework' ),
			'description' => __( 'Section de témoignage stylisée', 'insuffle-framework' ),
			'categories'  => array( 'insuffle' ),
			'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem","left":"2rem","right":"2rem"}},"border":{"left":{"color":"var:preset|color|secondary","width":"4px"}}},"backgroundColor":"bg-light","layout":{"type":"constrained","contentSize":"800px"}} -->
			<div class="wp-block-group has-bg-light-background-color has-background" style="border-left-color:var(--wp--preset--color--secondary);border-left-width:4px;padding-top:3rem;padding-right:2rem;padding-bottom:3rem;padding-left:2rem"><!-- wp:quote {"className":"is-style-plain"} -->
			<blockquote class="wp-block-quote is-style-plain"><!-- wp:paragraph {"fontSize":"xl"} -->
			<p class="has-xl-font-size">Insuffle Framework a transformé notre façon de créer des sites web. Un outil indispensable !</p>
			<!-- /wp:paragraph --><cite><strong>Marie Dupont</strong><br>Directrice Marketing, Entreprise XYZ</cite></blockquote>
			<!-- /wp:quote --></div>
			<!-- /wp:group -->',
		)
	);

	// FAQ Pattern
	register_block_pattern(
		'insuffle/faq',
		array(
			'title'       => __( 'FAQ', 'insuffle-framework' ),
			'description' => __( 'Section FAQ avec questions/réponses', 'insuffle-framework' ),
			'categories'  => array( 'insuffle' ),
			'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem"}}},"layout":{"type":"constrained","contentSize":"800px"}} -->
			<div class="wp-block-group" style="padding-top:3rem;padding-bottom:3rem"><!-- wp:heading {"textAlign":"center"} -->
			<h2 class="has-text-align-center">Questions Fréquentes</h2>
			<!-- /wp:heading -->

			<!-- wp:separator {"style":{"spacing":{"margin":{"top":"2rem","bottom":"2rem"}}},"backgroundColor":"secondary"} -->
			<hr class="wp-block-separator has-text-color has-secondary-background-color has-alpha-channel-opacity has-secondary-background-color has-background" style="margin-top:2rem;margin-bottom:2rem"/>
			<!-- /wp:separator -->

			<!-- wp:heading {"level":3} -->
			<h3>Comment installer le thème ?</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Téléchargez le fichier ZIP, puis allez dans Apparence &gt; Thèmes &gt; Ajouter &gt; Téléverser.</p>
			<!-- /wp:paragraph -->

			<!-- wp:separator {"style":{"spacing":{"margin":{"top":"2rem","bottom":"2rem"}}},"backgroundColor":"bg-light"} -->
			<hr class="wp-block-separator has-text-color has-bg-light-background-color has-alpha-channel-opacity has-bg-light-background-color has-background" style="margin-top:2rem;margin-bottom:2rem"/>
			<!-- /wp:separator -->

			<!-- wp:heading {"level":3} -->
			<h3>Puis-je personnaliser les couleurs ?</h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Oui ! Rendez-vous dans le Customizer pour choisir parmi plusieurs palettes ou créer la vôtre.</p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:group -->',
		)
	);
}
add_action( 'init', 'insuffle_register_block_patterns' );

/**
 * Allowed block types
 */
function insuffle_allowed_block_types( $allowed_blocks, $editor_context ) {
	// Return all blocks by default
	return $allowed_blocks;
}
add_filter( 'allowed_block_types_all', 'insuffle_allowed_block_types', 10, 2 );

/**
 * Add custom block styles
 */
function insuffle_register_block_styles() {
	// Button styles
	register_block_style(
		'core/button',
		array(
			'name'  => 'insuffle-outline',
			'label' => __( 'Contour Insuffle', 'insuffle-framework' ),
		)
	);

	register_block_style(
		'core/button',
		array(
			'name'  => 'insuffle-ghost',
			'label' => __( 'Ghost Insuffle', 'insuffle-framework' ),
		)
	);

	// Group styles
	register_block_style(
		'core/group',
		array(
			'name'  => 'insuffle-card',
			'label' => __( 'Carte Insuffle', 'insuffle-framework' ),
		)
	);

	register_block_style(
		'core/group',
		array(
			'name'  => 'insuffle-highlight',
			'label' => __( 'Highlight Insuffle', 'insuffle-framework' ),
		)
	);
}
add_action( 'init', 'insuffle_register_block_styles' );
