<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0.10
 */


// Socials
if ( briny_is_on( briny_get_theme_option( 'socials_in_footer' ) ) ) {
	$briny_output = briny_get_socials_links();
	if ( '' != $briny_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php briny_show_layout( $briny_output ); ?>
			</div>
		</div>
		<?php
	}
}
