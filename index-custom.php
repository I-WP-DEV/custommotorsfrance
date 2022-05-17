<?php
/**
 * The template for homepage posts with custom style
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0.50
 */

briny_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	$briny_blog_style = briny_get_theme_option( 'blog_style' );
	$briny_parts      = explode( '_', $briny_blog_style );
	$briny_columns    = ! empty( $briny_parts[1] ) ? max( 1, min( 6, (int) $briny_parts[1] ) ) : 1;
	$briny_blog_id    = briny_get_custom_blog_id( $briny_blog_style );
	$briny_blog_meta  = briny_get_custom_layout_meta( $briny_blog_id );
	if ( ! empty( $briny_blog_meta['margin'] ) ) {
		briny_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( briny_prepare_css_value( $briny_blog_meta['margin'] ) ) ) );
	}
	$briny_custom_style = ! empty( $briny_blog_meta['scripts_required'] ) ? $briny_blog_meta['scripts_required'] : 'none';

	briny_blog_archive_start();

	$briny_classes    = 'posts_container blog_custom_wrap' 
							. ( ! briny_is_off( $briny_custom_style )
								? sprintf( ' %s_wrap', $briny_custom_style )
								: ( $briny_columns > 1 
									? ' columns_wrap columns_padding_bottom' 
									: ''
									)
								);
	$briny_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$briny_sticky_out = briny_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $briny_stickies ) && count( $briny_stickies ) > 0 && get_query_var( 'paged' ) < 1;
	if ( $briny_sticky_out ) {
		?>
		<div class="sticky_wrap columns_wrap">
		<?php
	}
	if ( ! $briny_sticky_out ) {
		if ( briny_get_theme_option( 'first_post_large' ) && ! is_paged() && ! in_array( briny_get_theme_option( 'body_style' ), array( 'fullwide', 'fullscreen' ) ) ) {
			the_post();
			get_template_part( apply_filters( 'briny_filter_get_template_part', 'content', 'excerpt' ), 'excerpt' );
		}
		?>
		<div class="<?php echo esc_attr( $briny_classes ); ?>">
		<?php
	}
	while ( have_posts() ) {
		the_post();
		if ( $briny_sticky_out && ! is_sticky() ) {
			$briny_sticky_out = false;
			?>
			</div><div class="<?php echo esc_attr( $briny_classes ); ?>">
			<?php
		}
		$briny_part = $briny_sticky_out && is_sticky() ? 'sticky' : 'custom';
		get_template_part( apply_filters( 'briny_filter_get_template_part', 'content', $briny_part ), $briny_part );
	}
	?>
	</div>
	<?php

	briny_show_pagination();

	briny_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'briny_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'briny_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
