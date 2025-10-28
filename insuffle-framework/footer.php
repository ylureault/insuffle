	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
			<div class="footer-widgets">
				<div class="insuffle-container">
					<div class="footer-widgets-grid footer-columns-<?php echo esc_attr( get_theme_mod( 'insuffle_footer_columns', '4' ) ); ?>">
						<?php
						$footer_columns = get_theme_mod( 'insuffle_footer_columns', '4' );
						for ( $i = 1; $i <= $footer_columns; $i++ ) {
							if ( is_active_sidebar( 'footer-' . $i ) ) {
								?>
								<div class="footer-widget-area footer-widget-<?php echo esc_attr( $i ); ?>">
									<?php dynamic_sidebar( 'footer-' . $i ); ?>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div><!-- .footer-widgets -->
		<?php endif; ?>

		<div class="footer-bottom">
			<div class="insuffle-container">
				<div class="footer-bottom-inner">
					<div class="site-info">
						<?php
						$footer_text = get_theme_mod( 'insuffle_footer_text', sprintf( __( '© %s Insuffle. Tous droits réservés.', 'insuffle-framework' ), date( 'Y' ) ) );
						echo wp_kses_post( $footer_text );
						?>
					</div><!-- .site-info -->

					<?php if ( get_theme_mod( 'insuffle_show_branding', true ) ) : ?>
						<div class="insuffle-branding">
							<?php
							printf(
								/* translators: %s: Insuffle */
								esc_html__( 'Propulsé par %s', 'insuffle-framework' ),
								'<a href="https://insuffle.com" target="_blank" rel="noopener">Insuffle</a>'
							);
							?>
						</div>
					<?php endif; ?>

					<?php
					if ( has_nav_menu( 'footer' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'menu_id'        => 'footer-menu',
								'menu_class'     => 'footer-menu',
								'container'      => 'nav',
								'container_class' => 'footer-navigation',
								'depth'          => 1,
								'fallback_cb'    => false,
							)
						);
					}
					?>
				</div><!-- .footer-bottom-inner -->
			</div><!-- .insuffle-container -->
		</div><!-- .footer-bottom -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
