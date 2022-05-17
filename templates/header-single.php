<?php
/**
 * The template to display the featured image in the single post
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

if ( get_query_var( 'briny_header_image' ) == '' && briny_trx_addons_featured_image_override( is_singular() && has_post_thumbnail() && in_array( get_post_type(), array( 'post', 'page' ) ) ) ) {
	$briny_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	if ( ! empty( $briny_src[0] ) ) {
		briny_sc_layouts_showed( 'featured', true );
		?>
		<div class="sc_layouts_featured with_image without_content <?php echo esc_attr( briny_add_inline_css_class( 'background-image:url(' . esc_url( $briny_src[0] ) . ');' ) ); ?>"></div>
		<?php
	}
}
