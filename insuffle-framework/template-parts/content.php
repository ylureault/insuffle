<?php
/**
 * Template part for displaying posts
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() && get_theme_mod( 'insuffle_show_featured_image', true ) ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail( 'insuffle-card', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="post-content-wrapper">
		<header class="entry-header">
			<?php
			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php insuffle_post_categories(); ?>
				</div><!-- .entry-meta -->
				<?php
			endif;

			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() && get_theme_mod( 'insuffle_show_post_meta', true ) ) :
				?>
				<div class="entry-meta-details">
					<?php insuffle_post_meta(); ?>
				</div><!-- .entry-meta-details -->
				<?php
			endif;
			?>
		</header><!-- .entry-header -->

		<?php if ( get_theme_mod( 'insuffle_show_excerpt', true ) ) : ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php endif; ?>

		<?php if ( ! is_singular() ) : ?>
			<div class="entry-footer">
				<a href="<?php the_permalink(); ?>" class="read-more">
					<?php esc_html_e( 'Lire la suite', 'insuffle-framework' ); ?>
					<span aria-hidden="true"> &rarr;</span>
				</a>
			</div><!-- .entry-footer -->
		<?php endif; ?>
	</div><!-- .post-content-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->
