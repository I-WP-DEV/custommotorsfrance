<?php
/**
 * The Classic template to display the content
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
$briny_expanded   = ! briny_sidebar_present() && briny_is_on( briny_get_theme_option( 'expand_content' ) );
$briny_animation  = briny_get_theme_option( 'blog_animation' );
$briny_components = briny_array_get_keys_by_value( briny_get_theme_option( 'meta_parts' ) );

$briny_post_format = get_post_format();
$briny_post_format = empty( $briny_post_format ) ? 'standard' : str_replace( 'post-format-', '', $briny_post_format );

?><div class="
<?php
if ( ! empty( $briny_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( 'classic' == $briny_blog_style[0] ? 'column' : 'masonry_item masonry_item' ) . '-1_' . esc_attr( $briny_columns );
}
?>
"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_format_' . esc_attr( $briny_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $briny_columns )
				. ' post_layout_' . esc_attr( $briny_blog_style[0] )
				. ' post_layout_' . esc_attr( $briny_blog_style[0] ) . '_' . esc_attr( $briny_columns )
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

	// Featured image
	$briny_hover = ! empty( $briny_template_args['hover'] ) && ! briny_is_inherit( $briny_template_args['hover'] )
						? $briny_template_args['hover']
						: briny_get_theme_option( 'image_hover' );
	briny_show_post_featured(
		array(
			'thumb_size' => briny_get_thumb_size(
				'classic' == $briny_blog_style[0]
						? ( strpos( briny_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $briny_columns > 2 ? 'big' : 'huge' )
								: ( $briny_columns > 2
									? ( $briny_expanded ? 'med' : 'small' )
									: ( $briny_expanded ? 'big' : 'med' )
									)
							)
						: ( strpos( briny_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $briny_columns > 2 ? 'masonry-big' : 'full' )
								: ( $briny_columns <= 2 && $briny_expanded ? 'masonry-big' : 'masonry' )
							)
			),
			'hover'      => $briny_hover,
			'no_links'   => ! empty( $briny_template_args['no_links'] ),
		)
	);

	if ( ! in_array( $briny_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
		<div class="post_header entry-header">
			<?php
			do_action( 'briny_action_before_post_title' );

			// Post title
			if ( empty( $briny_template_args['no_links'] ) ) {
				the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
			} else {
				the_title( '<h4 class="post_title entry-title">', '</h4>' );
			}

			do_action( 'briny_action_before_post_meta' );

			// Post meta
			if ( ! empty( $briny_components ) && ! in_array( $briny_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
				briny_show_post_meta(
					apply_filters(
						'briny_filter_post_meta_args', array(
							'components' => $briny_components,
							'seo'        => false,
						), $briny_blog_style[0], $briny_columns
					)
				);
			}

			do_action( 'briny_action_after_post_meta' );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>

	<div class="post_content entry-content">
		<?php
		if ( empty( $briny_template_args['hide_excerpt'] ) && briny_get_theme_option( 'excerpt_length' ) > 0 ) {
			// Post content area
			briny_show_post_content( $briny_template_args, '<div class="post_content_inner">', '</div>' );
		}
		
		// Post meta
		if ( in_array( $briny_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
			if ( ! empty( $briny_components ) ) {
				briny_show_post_meta(
					apply_filters(
						'briny_filter_post_meta_args', array(
							'components' => $briny_components,
						), $briny_blog_style[0], $briny_columns
					)
				);
			}
		}
		
		// More button
		if ( empty( $briny_template_args['no_links'] ) && ! empty( $briny_template_args['more_text'] ) && ! in_array( $briny_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
			briny_show_post_more_link( $briny_template_args, '<p>', '</p>' );
		}
		?>
	</div><!-- .entry-content -->

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
