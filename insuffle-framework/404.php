<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="insuffle-container">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oups ! Cette page est introuvable.', 'insuffle-framework' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'Il semble que rien n\'ait été trouvé à cet emplacement. Essayez peut-être une recherche ?', 'insuffle-framework' ); ?></p>

					<?php get_search_form(); ?>

					<div class="error-404-links">
						<h2><?php esc_html_e( 'Liens utiles', 'insuffle-framework' ); ?></h2>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Retour à l\'accueil', 'insuffle-framework' ); ?></a></li>
							<?php if ( have_posts() ) : ?>
								<li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'Voir le blog', 'insuffle-framework' ); ?></a></li>
							<?php endif; ?>
						</ul>
					</div>

					<?php
					// Display recent posts
					$recent_posts = new WP_Query(
						array(
							'posts_per_page' => 3,
							'post_status'    => 'publish',
						)
					);

					if ( $recent_posts->have_posts() ) :
						?>
						<div class="error-404-recent-posts">
							<h2><?php esc_html_e( 'Articles récents', 'insuffle-framework' ); ?></h2>
							<div class="posts-wrapper layout-grid">
								<?php
								while ( $recent_posts->have_posts() ) :
									$recent_posts->the_post();
									?>
									<article id="post-<?php the_ID(); ?>" <?php post_class( 'recent-post' ); ?>>
										<?php if ( has_post_thumbnail() ) : ?>
											<div class="post-thumbnail">
												<a href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail( 'insuffle-card' ); ?>
												</a>
											</div>
										<?php endif; ?>
										<header class="entry-header">
											<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
										</header>
									</article>
									<?php
								endwhile;
								wp_reset_postdata();
								?>
							</div>
						</div>
						<?php
					endif;
					?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</div><!-- .insuffle-container -->
	</main><!-- #primary -->

<?php
get_footer();
