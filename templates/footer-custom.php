<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0.10
 */

$briny_footer_id = briny_get_custom_footer_id();
$briny_footer_meta = get_post_meta( $briny_footer_id, 'trx_addons_options', true );
if ( ! empty( $briny_footer_meta['margin'] ) ) {
	briny_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( briny_prepare_css_value( $briny_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $briny_footer_id ); ?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($briny_footer_id))); ?>
						<?php
						$briny_footer_scheme = briny_get_theme_option( 'footer_scheme' );
						if ( ! empty( $briny_footer_scheme ) && ! briny_is_inherit( $briny_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $briny_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'briny_action_show_layout', $briny_footer_id );
	?>
</footer><!-- /.footer_wrap -->
