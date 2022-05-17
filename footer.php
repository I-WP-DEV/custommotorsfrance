<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

							// Widgets area inside page content
							briny_create_widgets_area( 'widgets_below_content' );
							?>
						</div><!-- </.content> -->
					<?php

					// Show main sidebar
					get_sidebar();

					$briny_body_style = briny_get_theme_option( 'body_style' );
					?>
					</div><!-- </.content_wrap> -->
					<?php

					// Widgets area below page content and related posts below page content
					$briny_widgets_name = briny_get_theme_option( 'widgets_below_page' );
					$briny_show_widgets = ! briny_is_off( $briny_widgets_name ) && is_active_sidebar( $briny_widgets_name );
					$briny_show_related = is_single() && briny_get_theme_option( 'related_position' ) == 'below_page';
					if ( $briny_show_widgets || $briny_show_related ) {
						if ( 'fullscreen' != $briny_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $briny_show_related ) {
							do_action( 'briny_action_related_posts' );
						}

						// Widgets area below page content
						if ( $briny_show_widgets ) {
							briny_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $briny_body_style ) {
							?>
							</div><!-- </.content_wrap> -->
							<?php
						}
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Single posts banner before footer
			if ( is_singular( 'post' ) ) {
				briny_show_post_banner('footer');
			}
			// Footer
			$briny_footer_type = briny_get_theme_option( 'footer_type' );
			if ( 'custom' == $briny_footer_type && ! briny_is_layouts_available() ) {
				$briny_footer_type = 'default';
			}
			get_template_part( apply_filters( 'briny_filter_get_template_part', "templates/footer-{$briny_footer_type}" ) );
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php wp_footer(); ?>

</body>
</html>