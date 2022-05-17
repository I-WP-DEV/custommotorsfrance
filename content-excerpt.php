<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

$briny_template_args = get_query_var( 'briny_template_args' );
if ( is_array( $briny_template_args ) ) {
	$briny_columns    = empty( $briny_template_args['columns'] ) ? 1 : max( 1, $briny_template_args['columns'] );
	$briny_blog_style = array( $briny_template_args['type'], $briny_columns );
	if ( ! empty( $briny_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $briny_columns > 1 ) {
		?>
		<div class="column-1_<?php echo esc_attr( $briny_columns ); ?>">
		<?php
	}
}
$briny_expanded    = ! briny_sidebar_present() && briny_is_on( briny_get_theme_option( 'expand_content' ) );
$briny_post_format = get_post_format();
$briny_post_format = empty( $briny_post_format ) ? 'standard' : str_replace( 'post-format-', '', $briny_post_format );
$briny_animation   = briny_get_theme_option( 'blog_animation' );
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php post_class( 'post_item post_layout_excerpt post_format_' . esc_attr( $briny_post_format ) ); ?>
	<?php echo ( ! briny_is_off( $briny_animation ) && empty( $briny_template_args['slider'] ) ? ' data-animation="' . esc_attr( briny_get_animation_classes( $briny_animation ) ) . '"' : '' ); ?>
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
			'no_links'   => ! empty( $briny_template_args['no_links'] ),
			'hover'      => $briny_hover,
			'thumb_size' => briny_get_thumb_size( strpos( briny_get_theme_option( 'body_style' ), 'full' ) !== false ? 'full' : ( $briny_expanded ? 'tours' : ( in_array( $briny_post_format, array( 'gallery', 'audio' )) ? 'big' : 'excerpt' ) ) ),
		)
	);

?>
<div class="post_content_excerpt">
<?php
	// Title and post meta
		?>
		<div class="post_header entry-header">
			<?php
			do_action( 'briny_action_before_post_title' );

            // Post meta
			$briny_components = briny_array_get_keys_by_value( briny_get_theme_option( 'meta_parts' ) );

			if ( ! empty( $briny_components ) && ! in_array( $briny_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
				briny_show_post_meta(
					apply_filters(
						'briny_filter_post_meta_args', array(
							'components' => $briny_components,
							'seo'        => false,
						), 'excerpt', 1
					)
				);
			}
            if ( get_the_title() != '' ) {
                    // Post title
                    if ( empty( $briny_template_args['no_links'] ) ) {
                        the_title( sprintf( '<h1 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
                    } else {
                        the_title( '<h1 class="post_title entry-title">', '</h1>' );
                    }

                    do_action( 'briny_action_before_post_meta' );
                }
                    ?>
		</div><!-- .post_header -->

		<?php
	// Post content
	if ( empty( $briny_template_args['hide_excerpt'] ) && briny_get_theme_option( 'excerpt_length' ) > 0 ) {
		?>
		<div class="post_content entry-content">
			<?php
			if ( briny_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'briny_action_before_full_post_content' );
					the_content( '' );
					do_action( 'briny_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'briny' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'briny' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				briny_show_post_content( $briny_template_args, '<div class="post_content_inner">', '</div>' );
			}
			?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
</div>
</article>
<?php

if ( is_array( $briny_template_args ) ) {
	if ( ! empty( $briny_template_args['slider'] ) || $briny_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
