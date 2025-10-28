<?php
/**
 * Custom template tags and functions for this theme
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Display post meta information
 */
function insuffle_post_meta() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Publié le %s', 'post date', 'insuffle-framework' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	// Author
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'par %s', 'post author', 'insuffle-framework' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	// Comments
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Laisser un commentaire<span class="screen-reader-text"> sur %s</span>', 'insuffle-framework' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		echo '</span>';
	}
}

/**
 * Display post categories
 */
function insuffle_post_categories() {
	$categories_list = get_the_category_list( esc_html__( ', ', 'insuffle-framework' ) );
	if ( $categories_list ) {
		printf( '<span class="cat-links">' . esc_html__( 'Dans %1$s', 'insuffle-framework' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * Display post tags
 */
function insuffle_post_tags() {
	$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'insuffle-framework' ) );
	if ( $tags_list ) {
		printf( '<span class="tags-links">' . esc_html__( 'Tags : %1$s', 'insuffle-framework' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * Display social sharing buttons
 */
function insuffle_social_share() {
	$post_title = get_the_title();
	$post_url = get_permalink();

	?>
	<div class="social-share">
		<h3 class="social-share-title"><?php esc_html_e( 'Partager cet article', 'insuffle-framework' ); ?></h3>
		<ul class="social-share-list">
			<li>
				<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $post_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Partager sur Facebook', 'insuffle-framework' ); ?>">
					<span class="social-icon facebook">Facebook</span>
				</a>
			</li>
			<li>
				<a href="https://twitter.com/intent/tweet?text=<?php echo esc_attr( $post_title ); ?>&url=<?php echo esc_url( $post_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Partager sur Twitter', 'insuffle-framework' ); ?>">
					<span class="social-icon twitter">Twitter</span>
				</a>
			</li>
			<li>
				<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( $post_url ); ?>&title=<?php echo esc_attr( $post_title ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Partager sur LinkedIn', 'insuffle-framework' ); ?>">
					<span class="social-icon linkedin">LinkedIn</span>
				</a>
			</li>
			<li>
				<a href="mailto:?subject=<?php echo esc_attr( $post_title ); ?>&body=<?php echo esc_url( $post_url ); ?>" aria-label="<?php esc_attr_e( 'Partager par email', 'insuffle-framework' ); ?>">
					<span class="social-icon email">Email</span>
				</a>
			</li>
		</ul>
	</div>
	<?php
}

/**
 * Display related posts
 */
function insuffle_related_posts( $post_id = null, $number = 3 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$categories = get_the_category( $post_id );
	if ( empty( $categories ) ) {
		return;
	}

	$category_ids = array();
	foreach ( $categories as $category ) {
		$category_ids[] = $category->term_id;
	}

	$args = array(
		'category__in'        => $category_ids,
		'post__not_in'        => array( $post_id ),
		'posts_per_page'      => $number,
		'ignore_sticky_posts' => 1,
	);

	$related_posts = new WP_Query( $args );

	if ( $related_posts->have_posts() ) :
		?>
		<div class="related-posts">
			<h2 class="related-posts-title"><?php esc_html_e( 'Articles similaires', 'insuffle-framework' ); ?></h2>
			<div class="related-posts-grid">
				<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'related-post' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="related-post-thumbnail">
								<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
									<?php the_post_thumbnail( 'insuffle-card' ); ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="related-post-content">
							<header class="related-post-header">
								<?php the_title( '<h3 class="related-post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
							</header>
							<div class="related-post-excerpt">
								<?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 15, '...' ) ); ?>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
		</div>
		<?php
		wp_reset_postdata();
	endif;
}

/**
 * Display reading time
 */
function insuffle_reading_time() {
	$content = get_post_field( 'post_content', get_the_ID() );
	$word_count = str_word_count( strip_tags( $content ) );
	$reading_time = ceil( $word_count / 200 ); // Assuming 200 words per minute

	if ( $reading_time === 1 ) {
		$timer = esc_html__( '1 minute', 'insuffle-framework' );
	} else {
		$timer = sprintf( esc_html__( '%s minutes', 'insuffle-framework' ), $reading_time );
	}

	return '<span class="reading-time">' . $timer . '</span>';
}

/**
 * Get post navigation for single posts
 */
function insuffle_post_navigation() {
	$prev_post = get_previous_post();
	$next_post = get_next_post();

	if ( ! $prev_post && ! $next_post ) {
		return;
	}

	?>
	<nav class="post-navigation" aria-label="<?php esc_attr_e( 'Navigation entre les articles', 'insuffle-framework' ); ?>">
		<div class="post-navigation-inner">
			<?php if ( $prev_post ) : ?>
				<div class="nav-previous">
					<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev">
						<span class="nav-subtitle"><?php esc_html_e( 'Article précédent', 'insuffle-framework' ); ?></span>
						<span class="nav-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
					</a>
				</div>
			<?php endif; ?>

			<?php if ( $next_post ) : ?>
				<div class="nav-next">
					<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next">
						<span class="nav-subtitle"><?php esc_html_e( 'Article suivant', 'insuffle-framework' ); ?></span>
						<span class="nav-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</nav>
	<?php
}

/**
 * Get pagination for archive pages
 */
function insuffle_pagination() {
	if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
		return;
	}

	$args = array(
		'mid_size'           => 2,
		'prev_text'          => esc_html__( '&larr; Précédent', 'insuffle-framework' ),
		'next_text'          => esc_html__( 'Suivant &rarr;', 'insuffle-framework' ),
		'screen_reader_text' => esc_html__( 'Navigation des articles', 'insuffle-framework' ),
		'aria_label'         => esc_html__( 'Articles', 'insuffle-framework' ),
	);

	?>
	<nav class="pagination" role="navigation" aria-label="<?php echo esc_attr( $args['aria_label'] ); ?>">
		<?php echo paginate_links( $args ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</nav>
	<?php
}

/**
 * Get header CTA button from customizer
 */
function insuffle_header_cta() {
	$cta_text = get_theme_mod( 'insuffle_header_cta_text', '' );
	$cta_url = get_theme_mod( 'insuffle_header_cta_url', '' );

	if ( ! empty( $cta_text ) && ! empty( $cta_url ) ) {
		?>
		<a href="<?php echo esc_url( $cta_url ); ?>" class="header-cta-button">
			<?php echo esc_html( $cta_text ); ?>
		</a>
		<?php
	}
}

/**
 * Check if page has sidebar
 */
function insuffle_has_sidebar() {
	// No sidebar on landing pages
	if ( is_page_template( 'templates/custom/landing.php' ) ) {
		return false;
	}

	// No sidebar on front page
	if ( is_front_page() ) {
		return false;
	}

	// Check if sidebar is active
	return is_active_sidebar( 'sidebar-1' );
}

/**
 * Display custom hero section
 */
function insuffle_hero_section() {
	if ( is_singular() && has_post_thumbnail() ) {
		$hero_enabled = get_post_meta( get_the_ID(), '_insuffle_hero_enabled', true );

		if ( $hero_enabled !== 'no' ) {
			?>
			<div class="hero-section">
				<?php the_post_thumbnail( 'insuffle-hero', array( 'class' => 'hero-image' ) ); ?>
				<div class="hero-content">
					<div class="hero-inner">
						<?php the_title( '<h1 class="hero-title">', '</h1>' ); ?>
						<?php if ( has_excerpt() ) : ?>
							<div class="hero-excerpt">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
