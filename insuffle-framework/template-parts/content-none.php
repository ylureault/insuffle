<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Aucun résultat trouvé', 'insuffle-framework' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Prêt à publier votre premier article ? <a href="%1$s">Commencez ici</a>.', 'insuffle-framework' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Désolé, aucun résultat ne correspond à votre recherche. Essayez avec d\'autres mots-clés.', 'insuffle-framework' ); ?></p>
			<?php
			get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'Il semble que nous ne trouvions pas ce que vous cherchez. Essayez peut-être une recherche ?', 'insuffle-framework' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
