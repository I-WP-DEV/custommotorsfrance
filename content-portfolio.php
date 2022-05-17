<?php
/**
 * The Portfolio template to display the content
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
		. ( is_sticky() && ! is_paged() ? ' sticky' : '' )
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

	$briny_image_hover = ! empty( $briny_template_args['hover'] ) && ! briny_is_inherit( $briny_template_args['hover'] )
								? $briny_template_args['hover']
								: briny_get_theme_option( 'image_hover' );
	// Featured image
	briny_show_post_featured(
		array(
			'hover'         => $briny_image_hover,
			'no_links'      => ! empty( $briny_template_args['no_links'] ),
			'thumb_size'    => briny_get_thumb_size(
				strpos( briny_get_theme_option( 'body_style' ), 'full' ) !== false || $briny_columns < 3
								? 'masonry-big'
				: 'masonry'
			),
			'show_no_image' => true,
			'class'         => 'dots' == $briny_image_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $briny_image_hover ? '<div class="post_info">' . esc_html( get_the_title() ) . '</div>' : '',
		)
	);
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!