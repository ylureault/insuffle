<?php
/**
 * The template for displaying the front page
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

get_header();
?>

	<main id="primary" class="site-main front-page">
		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				// Hero section if enabled and has thumbnail
				$hero_enabled = get_post_meta( get_the_ID(), '_insuffle_hero_enabled', true );
				if ( $hero_enabled === 'yes' && has_post_thumbnail() ) {
					insuffle_hero_section();
				}
				?>

				<div class="entry-content">
					<?php
					the_content();
					?>
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->

			<?php
		endwhile;
		?>
	</main><!-- #primary -->

<?php
get_footer();
