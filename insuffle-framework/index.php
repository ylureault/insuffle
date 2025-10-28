<?php
/**
 * The main template file
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="insuffle-container">
			<div class="content-area <?php echo insuffle_has_sidebar() ? 'has-sidebar' : 'full-width'; ?>">
				<div class="main-content">
					<?php
					if ( have_posts() ) :

						// Page header
						if ( is_home() && ! is_front_page() ) :
							?>
							<header class="page-header">
								<h1 class="page-title"><?php single_post_title(); ?></h1>
							</header>
							<?php
						endif;

						// Blog layout
						$blog_layout = get_theme_mod( 'insuffle_blog_layout', 'grid' );
						?>
						<div class="posts-wrapper layout-<?php echo esc_attr( $blog_layout ); ?>">
							<?php
							while ( have_posts() ) :
								the_post();
								get_template_part( 'template-parts/content', get_post_type() );
							endwhile;
							?>
						</div>

						<?php
						insuffle_pagination();

					else :

						get_template_part( 'template-parts/content', 'none' );

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
	</main><!-- #primary -->

<?php
get_footer();
