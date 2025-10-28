<?php
/**
 * The template for displaying all pages
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
				<?php
				// Breadcrumb
				if ( ! is_front_page() ) {
					insuffle_breadcrumb();
				}
				?>

				<div class="content-area <?php echo insuffle_has_sidebar() ? 'has-sidebar' : 'full-width'; ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php
						$hide_title = get_post_meta( get_the_ID(), '_insuffle_hide_title', true );
						if ( $hide_title !== 'yes' ) :
							?>
							<header class="entry-header">
								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
							</header>
							<?php
						endif;

						$hide_featured_image = get_post_meta( get_the_ID(), '_insuffle_hide_featured_image', true );
						if ( has_post_thumbnail() && $hide_featured_image !== 'yes' && $hero_enabled !== 'yes' ) :
							?>
							<div class="post-thumbnail">
								<?php the_post_thumbnail( 'large' ); ?>
							</div>
							<?php
						endif;
						?>

						<div class="entry-content">
							<?php
							the_content();

							wp_link_pages(
								array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages :', 'insuffle-framework' ),
									'after'  => '</div>',
								)
							);
							?>
						</div><!-- .entry-content -->
					</article><!-- #post-<?php the_ID(); ?> -->

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

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
