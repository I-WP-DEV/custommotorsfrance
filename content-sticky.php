<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

$briny_columns     = max( 1, min( 3, count( get_option( 'sticky_posts' ) ) ) );
$briny_post_format = get_post_format();
$briny_post_format = empty( $briny_post_format ) ? 'standard' : str_replace( 'post-format-', '', $briny_post_format );
$briny_animation   = briny_get_theme_option( 'blog_animation' );

?><div class="column-1_<?php echo esc_attr( $briny_columns ); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_' . esc_attr( $briny_post_format ) ); ?>
	<?php echo ( ! briny_is_off( $briny_animation ) ? ' data-animation="' . esc_attr( briny_get_animation_classes( $briny_animation ) ) . '"' : '' ); ?>
	>

	<?php
	if ( is_sticky() && is_home() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	briny_show_post_featured(
		array(
			'thumb_size' => briny_get_thumb_size( 1 == $briny_columns ? 'big' : ( 2 == $briny_columns ? 'med' : 'avatar' ) ),
		)
	);

	if ( ! in_array( $briny_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			briny_show_post_meta( apply_filters( 'briny_filter_post_meta_args', array(), 'sticky', $briny_columns ) );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div><?php

// div.column-1_X is a inline-block and new lines and spaces after it are forbidden
