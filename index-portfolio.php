<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

briny_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	briny_blog_archive_start();

	$briny_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$briny_sticky_out = briny_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $briny_stickies ) && count( $briny_stickies ) > 0 && get_query_var( 'paged' ) < 1;

	// Show filters
	$briny_cat          = briny_get_theme_option( 'parent_cat' );
	$briny_post_type    = briny_get_theme_option( 'post_type' );
	$briny_taxonomy     = briny_get_post_type_taxonomy( $briny_post_type );
	$briny_show_filters = briny_get_theme_option( 'show_filters' );
	$briny_tabs         = array();
	if ( ! briny_is_off( $briny_show_filters ) ) {
		$briny_args           = array(
			'type'         => $briny_post_type,
			'child_of'     => $briny_cat,
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'   => 1,
			'hierarchical' => 0,
			'taxonomy'     => $briny_taxonomy,
			'pad_counts'   => false,
		);
		$briny_portfolio_list = get_terms( $briny_args );
		if ( is_array( $briny_portfolio_list ) && count( $briny_portfolio_list ) > 0 ) {
			$briny_tabs[ $briny_cat ] = esc_html__( 'All', 'briny' );
			foreach ( $briny_portfolio_list as $briny_term ) {
				if ( isset( $briny_term->term_id ) ) {
					$briny_tabs[ $briny_term->term_id ] = $briny_term->name;
				}
			}
		}
	}
	if ( count( $briny_tabs ) > 0 ) {
		$briny_portfolio_filters_ajax   = true;
		$briny_portfolio_filters_active = $briny_cat;
		$briny_portfolio_filters_id     = 'portfolio_filters';
		?>
		<div class="portfolio_filters briny_tabs briny_tabs_ajax">
			<ul class="portfolio_titles briny_tabs_titles">
				<?php
				foreach ( $briny_tabs as $briny_id => $briny_title ) {
					?>
					<li><a href="<?php echo esc_url( briny_get_hash_link( sprintf( '#%s_%s_content', $briny_portfolio_filters_id, $briny_id ) ) ); ?>" data-tab="<?php echo esc_attr( $briny_id ); ?>"><?php echo esc_html( $briny_title ); ?></a></li>
					<?php
				}
				?>
			</ul>
			<?php
			$briny_ppp = briny_get_theme_option( 'posts_per_page' );
			if ( briny_is_inherit( $briny_ppp ) ) {
				$briny_ppp = '';
			}
			foreach ( $briny_tabs as $briny_id => $briny_title ) {
				$briny_portfolio_need_content = $briny_id == $briny_portfolio_filters_active || ! $briny_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr( sprintf( '%s_%s_content', $briny_portfolio_filters_id, $briny_id ) ); ?>"
					class="portfolio_content briny_tabs_content"
					data-blog-template="<?php echo esc_attr( briny_storage_get( 'blog_template' ) ); ?>"
					data-blog-style="<?php echo esc_attr( briny_get_theme_option( 'blog_style' ) ); ?>"
					data-posts-per-page="<?php echo esc_attr( $briny_ppp ); ?>"
					data-post-type="<?php echo esc_attr( $briny_post_type ); ?>"
					data-taxonomy="<?php echo esc_attr( $briny_taxonomy ); ?>"
					data-cat="<?php echo esc_attr( $briny_id ); ?>"
					data-parent-cat="<?php echo esc_attr( $briny_cat ); ?>"
					data-need-content="<?php echo ( false === $briny_portfolio_need_content ? 'true' : 'false' ); ?>"
				>
					<?php
					if ( $briny_portfolio_need_content ) {
						briny_show_portfolio_posts(
							array(
								'cat'        => $briny_id,
								'parent_cat' => $briny_cat,
								'taxonomy'   => $briny_taxonomy,
								'post_type'  => $briny_post_type,
								'page'       => 1,
								'sticky'     => $briny_sticky_out,
							)
						);
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		briny_show_portfolio_posts(
			array(
				'cat'        => $briny_cat,
				'parent_cat' => $briny_cat,
				'taxonomy'   => $briny_taxonomy,
				'post_type'  => $briny_post_type,
				'page'       => 1,
				'sticky'     => $briny_sticky_out,
			)
		);
	}

	briny_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'briny_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'briny_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
