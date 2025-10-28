<?php
/**
 * Template Name: Formation
 * Template Post Type: page
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

get_header();
?>

	<main id="primary" class="site-main formation-page">
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

					<div class="formation-layout">
						<div class="formation-content">
							<div class="entry-content">
								<?php the_content(); ?>
							</div><!-- .entry-content -->
						</div>

						<aside class="formation-sidebar">
							<div class="formation-info-card">
								<h3><?php esc_html_e( 'Informations', 'insuffle-framework' ); ?></h3>

								<?php
								// Exemple de métadonnées personnalisées pour une formation
								$duree = get_post_meta( get_the_ID(), '_formation_duree', true );
								$niveau = get_post_meta( get_the_ID(), '_formation_niveau', true );
								$prix = get_post_meta( get_the_ID(), '_formation_prix', true );
								?>

								<?php if ( $duree ) : ?>
									<div class="info-item">
										<strong><?php esc_html_e( 'Durée :', 'insuffle-framework' ); ?></strong>
										<span><?php echo esc_html( $duree ); ?></span>
									</div>
								<?php endif; ?>

								<?php if ( $niveau ) : ?>
									<div class="info-item">
										<strong><?php esc_html_e( 'Niveau :', 'insuffle-framework' ); ?></strong>
										<span><?php echo esc_html( $niveau ); ?></span>
									</div>
								<?php endif; ?>

								<?php if ( $prix ) : ?>
									<div class="info-item">
										<strong><?php esc_html_e( 'Tarif :', 'insuffle-framework' ); ?></strong>
										<span><?php echo esc_html( $prix ); ?></span>
									</div>
								<?php endif; ?>

								<a href="#contact" class="button button-primary formation-cta">
									<?php esc_html_e( 'S\'inscrire', 'insuffle-framework' ); ?>
								</a>
							</div>
						</aside>
					</div><!-- .formation-layout -->
				</article><!-- #post-<?php the_ID(); ?> -->
			</div><!-- .insuffle-container -->

			<?php
		endwhile;
		?>
	</main><!-- #primary -->

<?php
get_footer();
