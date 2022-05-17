<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0.50
 */

$briny_template_args = get_query_var( 'briny_template_args' );
if ( is_array( $briny_template_args ) ) {
	$briny_columns    = empty( $briny_template_args['columns'] ) ? 2 : max( 1, $briny_template_args['columns'] );
	$briny_blog_style = array( $briny_template_args['type'], $briny_columns );
} else {
	$briny_blog_style = explode( '_', briny_get_theme_option( 'blog_style' ) );
	$briny_columns    = empty( $briny_blog_style[1] ) ? 2 : max( 1, $briny_blog_style[1] );
}
$briny_blog_id       = briny_get_custom_blog_id( join( '_', $briny_blog_style ) );
$briny_blog_style[0] = str_replace( 'blog-custom-', '', $briny_blog_style[0] );
$briny_expanded      = ! briny_sidebar_present() && briny_is_on( briny_get_theme_option( 'expand_content' ) );
$briny_animation     = briny_get_theme_option( 'blog_animation' );
$briny_components    = briny_array_get_keys_by_value( briny_get_theme_option( 'meta_parts' ) );

$briny_post_format   = get_post_format();
$briny_post_format   = empty( $briny_post_format ) ? 'standard' : str_replace( 'post-format-', '', $briny_post_format );

$briny_blog_meta     = briny_get_custom_layout_meta( $briny_blog_id );
$briny_custom_style  = ! empty( $briny_blog_meta['scripts_required'] ) ? $briny_blog_meta['scripts_required'] : 'none';

if ( ! empty( $briny_template_args['slider'] ) || $briny_columns > 1 || ! briny_is_off( $briny_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $briny_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo ( briny_is_off( $briny_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $briny_custom_style ) ) . '-1_' . esc_attr( $briny_columns );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_format_' . esc_attr( $briny_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $briny_columns )
					. ' post_layout_' . esc_attr( $briny_blog_style[0] )
					. ' post_layout_' . esc_attr( $briny_blog_style[0] ) . '_' . esc_attr( $briny_columns )
					. ( ! briny_is_off( $briny_custom_style )
						? ' post_layout_' . esc_attr( $briny_custom_style )
							. ' post_layout_' . esc_attr( $briny_custom_style ) . '_' . esc_attr( $briny_columns )
						: ''
						)
		);
	echo ( ! briny_is_off( $briny_animation ) && empty( $briny_template_args['slider'] ) ? ' data-animation="' . esc_attr( briny_get_animation_classes( $briny_animation ) ) . '"' : '' );
	?>
>
	<?php
	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}
	// Custom layout
	do_action( 'briny_action_show_layout', $briny_blog_id );
	?>
</article><?php
if ( ! empty( $briny_template_args['slider'] ) || $briny_columns > 1 || ! briny_is_off( $briny_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
