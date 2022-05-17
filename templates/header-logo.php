<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

$briny_args = get_query_var( 'briny_logo_args' );

// Site logo
$briny_logo_type   = isset( $briny_args['type'] ) ? $briny_args['type'] : '';
$briny_logo_image  = briny_get_logo_image( $briny_logo_type );
$briny_logo_text   = briny_is_on( briny_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$briny_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $briny_logo_image['logo'] ) || ! empty( $briny_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $briny_logo_image['logo'] ) ) {
			if ( empty( $briny_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric( $briny_logo_image['logo'] ) && $briny_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$briny_attr = briny_getimagesize( $briny_logo_image['logo'] );
				echo '<img src="' . esc_url( $briny_logo_image['logo'] ) . '"'
						. ( ! empty( $briny_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $briny_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $briny_logo_text ) . '"'
						. ( ! empty( $briny_attr[3] ) ? ' ' . wp_kses_data( $briny_attr[3] ) : '' )
						. '>';
			}
		} else {
			briny_show_layout( briny_prepare_macros( $briny_logo_text ), '<span class="logo_text">', '</span>' );
			briny_show_layout( briny_prepare_macros( $briny_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
