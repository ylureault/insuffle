<?php
/**
 * Template Name: Contact
 * Template Post Type: page
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

get_header();
?>

	<main id="primary" class="site-main contact-page">
		<?php
		while ( have_posts() ) :
			the_post();
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

					<div class="contact-layout">
						<div class="contact-form-wrapper">
							<div class="entry-content">
								<?php
								// Le contenu peut inclure un shortcode de formulaire (Contact Form 7, Gravity Forms, etc.)
								the_content();
								?>
							</div><!-- .entry-content -->
						</div>

						<aside class="contact-info">
							<div class="contact-info-card">
								<h3><?php esc_html_e( 'Coordonnées', 'insuffle-framework' ); ?></h3>

								<?php
								// Exemple de coordonnées - peut être géré via le customizer ou des options
								$email = get_option( 'insuffle_contact_email', get_option( 'admin_email' ) );
								$phone = get_option( 'insuffle_contact_phone' );
								$address = get_option( 'insuffle_contact_address' );
								?>

								<?php if ( $email ) : ?>
									<div class="contact-item">
										<strong><?php esc_html_e( 'Email :', 'insuffle-framework' ); ?></strong>
										<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
									</div>
								<?php endif; ?>

								<?php if ( $phone ) : ?>
									<div class="contact-item">
										<strong><?php esc_html_e( 'Téléphone :', 'insuffle-framework' ); ?></strong>
										<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
									</div>
								<?php endif; ?>

								<?php if ( $address ) : ?>
									<div class="contact-item">
										<strong><?php esc_html_e( 'Adresse :', 'insuffle-framework' ); ?></strong>
										<address><?php echo wp_kses_post( $address ); ?></address>
									</div>
								<?php endif; ?>
							</div>

							<?php
							// Liens réseaux sociaux
							if ( has_nav_menu( 'social' ) ) :
								?>
								<div class="social-links-card">
									<h3><?php esc_html_e( 'Suivez-nous', 'insuffle-framework' ); ?></h3>
									<?php
									wp_nav_menu(
										array(
											'theme_location' => 'social',
											'menu_class'     => 'social-links',
											'container'      => 'nav',
											'depth'          => 1,
											'link_before'    => '<span class="screen-reader-text">',
											'link_after'     => '</span>',
										)
									);
									?>
								</div>
								<?php
							endif;
							?>
						</aside>
					</div><!-- .contact-layout -->
				</article><!-- #post-<?php the_ID(); ?> -->
			</div><!-- .insuffle-container -->

			<?php
		endwhile;
		?>
	</main><!-- #primary -->

<?php
get_footer();
