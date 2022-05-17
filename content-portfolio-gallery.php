<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

$briny_template_args = get_query_var( 'briny_template_args' );
if ( is_array( $briny_template_args ) ) {
	$briny_columns    = empty( $briny_template_args['columns'] ) ? 2 : max( 1, $briny_template_args['columns'] );
	$briny_blog_style = array( $briny_template_args['type'], $briny_columns );
} else {
	$briny_blog_style = explode( '_', briny_get_theme_option( 'blog_style' ) );
	$briny_columns    = empty( $briny_blog_style[1] ) ? 2 : max( 1, $briny_blog_style[1] );
}
$briny_post_format = get_post_format();
$briny_post_format = empty( $briny_post_format ) ? 'standard' : str_replace( 'post-format-', '', $briny_post_format );
$briny_animation   = briny_get_theme_option( 'blog_animation' );
$briny_image       = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

?><div class="
<?php
if ( ! empty( $briny_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo 'masonry_item masonry_item-1_' . esc_attr( $briny_columns );
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_format_' . esc_attr( $briny_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $briny_columns )
		. ' post_layout_gallery'
		. ' post_layout_gallery_' . esc_attr( $briny_columns )
	);
	echo ( ! briny_is_off( $briny_animation ) && empty( $briny_template_args['slider'] ) ? ' data-animation="' . esc_attr( briny_get_animation_classes( $briny_animation ) ) . '"' : '' );
	?>
	data-size="
		<?php
		if ( ! empty( $briny_image[1] ) && ! empty( $briny_image[2] ) ) {
			echo intval( $briny_image[1] ) . 'x' . intval( $briny_image[2] );}
		?>
	"
	data-src="
		<?php
		if ( ! empty( $briny_image[0] ) ) {
			echo esc_url( $briny_image[0] );}
		?>
	"
>
<?php

	// Sticky label
if ( is_sticky() && ! is_paged() ) {
	?>
		<span class="post_label label_sticky"></span>
		<?php
}

	// Featured image
	$briny_image_hover = 'icon';  
if ( in_array( $briny_image_hover, array( 'icons', 'zoom' ) ) ) {
	$briny_image_hover = 'dots';
}
$briny_components = briny_array_get_keys_by_value( briny_get_theme_option( 'meta_parts' ) );
briny_show_post_featured(
	array(
		'hover'         => $briny_image_hover,
		'no_links'      => ! empty( $briny_template_args['no_links'] ),
		'thumb_size'    => briny_get_thumb_size( strpos( briny_get_theme_option( 'body_style' ), 'full' ) !== false || $briny_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only'    => true,
		'show_no_image' => true,
		'post_info'     => '<div class="post_details">'
						. '<h2 class="post_title">'
							. ( empty( $briny_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>'
								: esc_html( get_the_title() )
								)
						. '</h2>'
						. '<div class="post_description">'
							. ( ! empty( $briny_components )
								? briny_show_post_meta(
									apply_filters(
										'briny_filter_post_meta_args', array(
											'components' => $briny_components,
											'seo'      => false,
											'echo'     => false,
										), $briny_blog_style[0], $briny_columns
									)
								)
								: ''
								)
							. ( empty( $briny_template_args['hide_excerpt'] )
								? '<div class="post_description_content">' . get_the_excerpt() . '</div>'
								: ''
								)
							. ( empty( $briny_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__( 'Learn more', 'briny' ) . '</span></a>'
								: ''
								)
						. '</div>'
					. '</div>',
	)
);
?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
