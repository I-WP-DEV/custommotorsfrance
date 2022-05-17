<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

briny_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	briny_blog_archive_start();

	?><div class="posts_container">
		<?php

		$briny_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
		$briny_sticky_out = briny_get_theme_option( 'sticky_style' ) == 'columns'
								&& is_array( $briny_stickies ) && count( $briny_stickies ) > 0 && get_query_var( 'paged' ) < 1;
		if ( $briny_sticky_out ) {
			?>
			<div class="sticky_wrap columns_wrap">
			<?php
		}
		while ( have_posts() ) {
			the_post();
			if ( $briny_sticky_out && ! is_sticky() ) {
				$briny_sticky_out = false;
				?>
				</div>
				<?php
			}
			$briny_part = $briny_sticky_out && is_sticky() ? 'sticky' : 'excerpt';
			get_template_part( apply_filters( 'briny_filter_get_template_part', 'content', $briny_part ), $briny_part );
		}
		if ( $briny_sticky_out ) {
			$briny_sticky_out = false;
			?>
			</div>
			<?php
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
