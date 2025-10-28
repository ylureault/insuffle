<?php
/**
 * Theme options panel
 *
 * @package Insuffle_Framework
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add theme options page
 */
function insuffle_add_options_page() {
	add_theme_page(
		__( 'Options Insuffle', 'insuffle-framework' ),
		__( 'Options Insuffle', 'insuffle-framework' ),
		'edit_theme_options',
		'insuffle-options',
		'insuffle_render_options_page'
	);
}
add_action( 'admin_menu', 'insuffle_add_options_page' );

/**
 * Render options page
 */
function insuffle_render_options_page() {
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<div class="insuffle-options-wrapper">
			<div class="insuffle-options-panel">
				<h2><?php esc_html_e( 'Bienvenue dans Insuffle Framework', 'insuffle-framework' ); ?></h2>
				<p><?php esc_html_e( 'Un thème WordPress universel, élégant et personnalisable.', 'insuffle-framework' ); ?></p>

				<div class="insuffle-options-grid">
					<div class="insuffle-option-card">
						<h3><?php esc_html_e( 'Personnalisation', 'insuffle-framework' ); ?></h3>
						<p><?php esc_html_e( 'Accédez au Customizer pour personnaliser les couleurs, la typographie, l\'en-tête, le footer et plus encore.', 'insuffle-framework' ); ?></p>
						<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary">
							<?php esc_html_e( 'Ouvrir le Customizer', 'insuffle-framework' ); ?>
						</a>
					</div>

					<div class="insuffle-option-card">
						<h3><?php esc_html_e( 'Menus', 'insuffle-framework' ); ?></h3>
						<p><?php esc_html_e( 'Gérez vos menus de navigation (principal, secondaire, footer, social).', 'insuffle-framework' ); ?></p>
						<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>" class="button button-primary">
							<?php esc_html_e( 'Gérer les menus', 'insuffle-framework' ); ?>
						</a>
					</div>

					<div class="insuffle-option-card">
						<h3><?php esc_html_e( 'Widgets', 'insuffle-framework' ); ?></h3>
						<p><?php esc_html_e( 'Configurez les zones de widgets (sidebar, footer).', 'insuffle-framework' ); ?></p>
						<a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" class="button button-primary">
							<?php esc_html_e( 'Gérer les widgets', 'insuffle-framework' ); ?>
						</a>
					</div>

					<div class="insuffle-option-card">
						<h3><?php esc_html_e( 'Documentation', 'insuffle-framework' ); ?></h3>
						<p><?php esc_html_e( 'Consultez le README.md pour des instructions complètes.', 'insuffle-framework' ); ?></p>
						<a href="https://github.com/insuffle/insuffle-framework" class="button" target="_blank" rel="noopener">
							<?php esc_html_e( 'Voir la documentation', 'insuffle-framework' ); ?>
						</a>
					</div>
				</div>

				<hr>

				<h2><?php esc_html_e( 'Informations du thème', 'insuffle-framework' ); ?></h2>
				<table class="widefat">
					<tbody>
						<tr>
							<td><strong><?php esc_html_e( 'Nom du thème', 'insuffle-framework' ); ?></strong></td>
							<td>Insuffle Framework</td>
						</tr>
						<tr>
							<td><strong><?php esc_html_e( 'Version', 'insuffle-framework' ); ?></strong></td>
							<td><?php echo esc_html( INSUFFLE_VERSION ); ?></td>
						</tr>
						<tr>
							<td><strong><?php esc_html_e( 'Version WordPress', 'insuffle-framework' ); ?></strong></td>
							<td><?php echo esc_html( get_bloginfo( 'version' ) ); ?></td>
						</tr>
						<tr>
							<td><strong><?php esc_html_e( 'Version PHP', 'insuffle-framework' ); ?></strong></td>
							<td><?php echo esc_html( PHP_VERSION ); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<style>
		.insuffle-options-wrapper {
			margin-top: 20px;
		}
		.insuffle-options-panel {
			background: #fff;
			padding: 30px;
			border-radius: 8px;
			box-shadow: 0 1px 3px rgba(0,0,0,0.1);
		}
		.insuffle-options-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
			gap: 20px;
			margin: 30px 0;
		}
		.insuffle-option-card {
			background: #f6f8fa;
			padding: 20px;
			border-radius: 8px;
			border-left: 4px solid #1f3a8b;
		}
		.insuffle-option-card h3 {
			margin-top: 0;
			color: #1f3a8b;
		}
		.insuffle-option-card p {
			color: #555;
			font-size: 14px;
		}
		.insuffle-option-card .button {
			margin-top: 10px;
		}
	</style>
	<?php
}

/**
 * Add meta boxes for pages
 */
function insuffle_add_meta_boxes() {
	add_meta_box(
		'insuffle_page_options',
		__( 'Options de page Insuffle', 'insuffle-framework' ),
		'insuffle_render_page_options',
		'page',
		'side',
		'default'
	);

	add_meta_box(
		'insuffle_page_options',
		__( 'Options d\'article Insuffle', 'insuffle-framework' ),
		'insuffle_render_page_options',
		'post',
		'side',
		'default'
	);
}
add_action( 'add_meta_boxes', 'insuffle_add_meta_boxes' );

/**
 * Render page options meta box
 */
function insuffle_render_page_options( $post ) {
	wp_nonce_field( 'insuffle_page_options_nonce', 'insuffle_page_options_nonce' );

	$hero_enabled = get_post_meta( $post->ID, '_insuffle_hero_enabled', true );
	$hide_title = get_post_meta( $post->ID, '_insuffle_hide_title', true );
	$hide_featured_image = get_post_meta( $post->ID, '_insuffle_hide_featured_image', true );
	?>
	<p>
		<label>
			<input type="checkbox" name="insuffle_hero_enabled" value="yes" <?php checked( $hero_enabled, 'yes' ); ?>>
			<?php esc_html_e( 'Activer le hero plein écran', 'insuffle-framework' ); ?>
		</label>
	</p>
	<p>
		<label>
			<input type="checkbox" name="insuffle_hide_title" value="yes" <?php checked( $hide_title, 'yes' ); ?>>
			<?php esc_html_e( 'Masquer le titre', 'insuffle-framework' ); ?>
		</label>
	</p>
	<p>
		<label>
			<input type="checkbox" name="insuffle_hide_featured_image" value="yes" <?php checked( $hide_featured_image, 'yes' ); ?>>
			<?php esc_html_e( 'Masquer l\'image à la une', 'insuffle-framework' ); ?>
		</label>
	</p>
	<?php
}

/**
 * Save page options
 */
function insuffle_save_page_options( $post_id ) {
	// Check nonce
	if ( ! isset( $_POST['insuffle_page_options_nonce'] ) || ! wp_verify_nonce( $_POST['insuffle_page_options_nonce'], 'insuffle_page_options_nonce' ) ) {
		return;
	}

	// Check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check permissions
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Save hero enabled
	if ( isset( $_POST['insuffle_hero_enabled'] ) ) {
		update_post_meta( $post_id, '_insuffle_hero_enabled', 'yes' );
	} else {
		delete_post_meta( $post_id, '_insuffle_hero_enabled' );
	}

	// Save hide title
	if ( isset( $_POST['insuffle_hide_title'] ) ) {
		update_post_meta( $post_id, '_insuffle_hide_title', 'yes' );
	} else {
		delete_post_meta( $post_id, '_insuffle_hide_title' );
	}

	// Save hide featured image
	if ( isset( $_POST['insuffle_hide_featured_image'] ) ) {
		update_post_meta( $post_id, '_insuffle_hide_featured_image', 'yes' );
	} else {
		delete_post_meta( $post_id, '_insuffle_hide_featured_image' );
	}
}
add_action( 'save_post', 'insuffle_save_page_options' );
