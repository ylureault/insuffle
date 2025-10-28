<?php
/**
 * The template for displaying all single posts
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();

			// Hero section if enabled
			$hero_enabled = get_post_meta( get_the_ID(), '_insuffle_hero_enabled', true );
			if ( $hero_enabled === 'yes' && has_post_thumbnail() ) {
				insuffle_hero_section();
			}
			?>

			<div class="insuffle-container">
				<?php insuffle_breadcrumb(); ?>

				<div class="content-area <?php echo insuffle_has_sidebar() ? 'has-sidebar' : 'full-width'; ?>">
					<div class="main-content">
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<?php
								if ( 'post' === get_post_type() ) :
									?>
									<div class="entry-meta">
										<?php
										insuffle_post_categories();
										echo ' &middot; ';
										echo insuffle_reading_time();
										?>
									</div>
									<?php
								endif;

								the_title( '<h1 class="entry-title">', '</h1>' );

								if ( 'post' === get_post_type() && get_theme_mod( 'insuffle_show_post_meta', true ) ) :
									?>
									<div class="entry-meta-details">
										<?php insuffle_post_meta(); ?>
									</div>
									<?php
								endif;
								?>
							</header><!-- .entry-header -->

							<?php
							$hide_featured_image = get_post_meta( get_the_ID(), '_insuffle_hide_featured_image', true );
							if ( has_post_thumbnail() && $hide_featured_image !== 'yes' && $hero_enabled !== 'yes' && get_theme_mod( 'insuffle_show_featured_image', true ) ) :
								?>
								<div class="post-thumbnail">
									<?php the_post_thumbnail( 'large' ); ?>
								</div>
								<?php
							endif;
							?>

							<div class="entry-content">
								<?php
								the_content(
									sprintf(
										wp_kses(
											/* translators: %s: Name of current post. Only visible to screen readers */
											__( 'Continuer la lecture<span class="screen-reader-text"> de "%s"</span>', 'insuffle-framework' ),
											array(
												'span' => array(
													'class' => array(),
												),
											)
										),
										wp_kses_post( get_the_title() )
									)
								);

								wp_link_pages(
									array(
										'before' => '<div class="page-links">' . esc_html__( 'Pages :', 'insuffle-framework' ),
										'after'  => '</div>',
									)
								);
								?>
							</div><!-- .entry-content -->

							<footer class="entry-footer">
								<?php insuffle_post_tags(); ?>
							</footer><!-- .entry-footer -->
						</article><!-- #post-<?php the_ID(); ?> -->

						<?php
						// Social sharing
						insuffle_social_share();

						// Post navigation
						insuffle_post_navigation();

						// Related posts
						insuffle_related_posts( get_the_ID(), 3 );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>
					</div><!-- .main-content -->

					<?php if ( insuffle_has_sidebar() ) : ?>
						<aside id="secondary" class="widget-area">
							<?php dynamic_sidebar( 'sidebar-1' ); ?>
						</aside>
					<?php endif; ?>
				</div><!-- .content-area -->
			</div><!-- .insuffle-container -->

			<?php
		endwhile;
		?>
	</main><!-- #primary -->

<?php
get_footer();
