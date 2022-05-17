<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$briny_footer_scheme = briny_get_theme_option( 'footer_scheme' );
if ( ! empty( $briny_footer_scheme ) && ! briny_is_inherit( $briny_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $briny_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/footer-socials' ) );

	// Menu
	get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/footer-menu' ) );

	// Copyright area
	get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
