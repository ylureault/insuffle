<?php
/**
 * Template Name: Offre / Service
 * Template Post Type: page
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

get_header();
?>

	<main id="primary" class="site-main offre-page">
		<?php
		while ( have_posts() ) :
			the_post();

			// Hero section if enabled
			if ( has_post_thumbnail() ) {
				insuffle_hero_section();
			}
			?>

			<div class="insuffle-container">
				<?php insuffle_breadcrumb(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						<?php if ( has_excerpt() ) : ?>
							<div class="entry-excerpt">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
					</header><!-- .entry-header -->

					<div class="offre-layout">
						<div class="offre-content">
							<div class="entry-content">
								<?php the_content(); ?>
							</div><!-- .entry-content -->
						</div>

						<aside class="offre-sidebar">
							<div class="offre-highlights">
								<h3><?php esc_html_e( 'Points clés', 'insuffle-framework' ); ?></h3>

								<?php
								// Exemple de métadonnées pour une offre
								$avantages = get_post_meta( get_the_ID(), '_offre_avantages', true );
								$delai = get_post_meta( get_the_ID(), '_offre_delai', true );
								$tarif = get_post_meta( get_the_ID(), '_offre_tarif', true );
								?>

								<?php if ( $avantages ) : ?>
									<div class="highlight-item">
										<strong><?php esc_html_e( 'Avantages :', 'insuffle-framework' ); ?></strong>
										<div><?php echo wp_kses_post( $avantages ); ?></div>
									</div>
								<?php endif; ?>

								<?php if ( $delai ) : ?>
									<div class="highlight-item">
										<strong><?php esc_html_e( 'Délai :', 'insuffle-framework' ); ?></strong>
										<span><?php echo esc_html( $delai ); ?></span>
									</div>
								<?php endif; ?>

								<?php if ( $tarif ) : ?>
									<div class="highlight-item highlight-tarif">
										<strong><?php esc_html_e( 'À partir de :', 'insuffle-framework' ); ?></strong>
										<span class="tarif-montant"><?php echo esc_html( $tarif ); ?></span>
									</div>
								<?php endif; ?>

								<a href="#contact" class="button button-primary offre-cta">
									<?php esc_html_e( 'Demander un devis', 'insuffle-framework' ); ?>
								</a>
							</div>
						</aside>
					</div><!-- .offre-layout -->
				</article><!-- #post-<?php the_ID(); ?> -->
			</div><!-- .insuffle-container -->

			<?php
		endwhile;
		?>
	</main><!-- #primary -->

<?php
get_footer();
