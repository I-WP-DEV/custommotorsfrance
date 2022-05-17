<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0.10
 */

// Logo
if ( briny_is_on( briny_get_theme_option( 'logo_in_footer' ) ) ) {
	$briny_logo_image = briny_get_logo_image( 'footer' );
	$briny_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $briny_logo_image['logo'] ) || ! empty( $briny_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $briny_logo_image['logo'] ) ) {
					$briny_attr = briny_getimagesize( $briny_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $briny_logo_image['logo'] ) . '"'
								. ( ! empty( $briny_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $briny_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'briny' ) . '"'
								. ( ! empty( $briny_attr[3] ) ? ' ' . wp_kses_data( $briny_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $briny_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $briny_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
