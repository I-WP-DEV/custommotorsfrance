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
	$briny_columns    = empty( $briny_template_args['columns'] ) ? 1 : max( 1, min( 3, $briny_template_args['columns'] ) );
	$briny_blog_style = array( $briny_template_args['type'], $briny_columns );
} else {
	$briny_blog_style = explode( '_', briny_get_theme_option( 'blog_style' ) );
	$briny_columns    = empty( $briny_blog_style[1] ) ? 1 : max( 1, min( 3, $briny_blog_style[1] ) );
}
$briny_expanded    = ! briny_sidebar_present() && briny_is_on( briny_get_theme_option( 'expand_content' ) );
$briny_post_format = get_post_format();
$briny_post_format = empty( $briny_post_format ) ? 'standard' : str_replace( 'post-format-', '', $briny_post_format );
$briny_animation   = briny_get_theme_option( 'blog_animation' );

?><article id="post-<?php the_ID(); ?>"	data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item'
		. ' post_layout_chess'
		. ' post_layout_chess_' . esc_attr( $briny_columns )
		. ' post_format_' . esc_attr( $briny_post_format )
		. ( ! empty( $briny_template_args['slider'] ) ? ' slider-slide swiper-slide' : '' )
	);
	echo ( ! briny_is_off( $briny_animation ) && empty( $briny_template_args['slider'] ) ? ' data-animation="' . esc_attr( briny_get_animation_classes( $briny_animation ) ) . '"' : '' );
	?>
>

	<?php
	// Add anchor
	if ( 1 == $briny_columns && ! is_array( $briny_template_args ) && shortcode_exists( 'trx_sc_anchor' ) ) {
		echo do_shortcode( '[trx_sc_anchor id="post_' . esc_attr( get_the_ID() ) . '" title="' . the_title_attribute( array( 'echo' => false ) ) . '" icon="' . esc_attr( briny_get_post_icon() ) . '"]' );
	}

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
			'class'         => 1 == $briny_columns && ! is_array( $briny_template_args ) ? 'briny-full-height' : '',
			'hover'         => $briny_hover,
			'no_links'      => ! empty( $briny_template_args['no_links'] ),
			'show_no_image' => true,
			'thumb_ratio'   => '1:1',
			'thumb_bg'      => true,
			'thumb_size'    => briny_get_thumb_size(
				strpos( briny_get_theme_option( 'body_style' ), 'full' ) !== false
										? ( 1 < $briny_columns ? 'huge' : 'original' )
										: ( 2 < $briny_columns ? 'big' : 'huge' )
			),
		)
	);

	?>
	<div class="post_inner"><div class="post_inner_content"><div class="post_header entry-header">
		<?php
			do_action( 'briny_action_before_post_title' );

			// Post title
			if ( empty( $briny_template_args['no_links'] ) ) {
				the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			} else {
				the_title( '<h3 class="post_title entry-title">', '</h3>' );
			}

			do_action( 'briny_action_before_post_meta' );

			// Post meta
			$briny_components = briny_array_get_keys_by_value( briny_get_theme_option( 'meta_parts' ) );
			$briny_post_meta  = empty( $briny_components ) || in_array( $briny_hover, array( 'border', 'pull', 'slide', 'fade' ) )
										? ''
										: briny_show_post_meta(
											apply_filters(
												'briny_filter_post_meta_args', array(
													'components' => $briny_components,
													'seo'  => false,
													'echo' => false,
												), $briny_blog_style[0], $briny_columns
											)
										);
			briny_show_layout( $briny_post_meta );
			?>
		</div><!-- .entry-header -->

		<div class="post_content entry-content">
			<?php
			// Post content area
			if ( empty( $briny_template_args['hide_excerpt'] ) && briny_get_theme_option( 'excerpt_length' ) > 0 ) {
				briny_show_post_content( $briny_template_args, '<div class="post_content_inner">', '</div>' );
			}
			// Post meta
			if ( in_array( $briny_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
				briny_show_layout( $briny_post_meta );
			}
			// More button
			if ( empty( $briny_template_args['no_links'] ) && ! in_array( $briny_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
				briny_show_post_more_link( $briny_template_args, '<p>', '</p>' );
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
