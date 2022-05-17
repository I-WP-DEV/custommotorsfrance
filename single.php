<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

get_header();

while ( have_posts() ) {
	the_post();

	// Prepare theme-specific vars:

	// Full post loading
	$full_post_loading        = briny_get_value_gp( 'action' ) == 'full_post_loading';

	// Prev post loading
	$prev_post_loading        = briny_get_value_gp( 'action' ) == 'prev_post_loading';

	// Position of the related posts
	$briny_related_position = briny_get_theme_option( 'related_position' );

	// Type of the prev/next posts navigation
	$briny_posts_navigation = briny_get_theme_option( 'posts_navigation' );
	$briny_prev_post        = false;

	if ( 'scroll' == $briny_posts_navigation ) {
		$briny_prev_post = get_previous_post( true );         // Get post from same category
		if ( ! $briny_prev_post ) {
			$briny_prev_post = get_previous_post( false );    // Get post from any category
			if ( ! $briny_prev_post ) {
				$briny_posts_navigation = 'links';
			}
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $briny_prev_post ) ) {
		briny_storage_set_array( 'options_meta', 'post_thumbnail_type', 'default' );
		if ( briny_get_theme_option( 'post_header_position' ) != 'below' ) {
			briny_storage_set_array( 'options_meta', 'post_header_position', 'above' );
		}
		briny_sc_layouts_showed( 'featured', false );
		briny_sc_layouts_showed( 'title', false );
		briny_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $briny_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'briny_filter_get_template_part', 'content', get_post_format() ), get_post_format() );

	// If related posts should be inside the content
	if ( strpos( $briny_related_position, 'inside' ) === 0 ) {
		$briny_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'briny_action_related_posts' );
		$briny_related_content = ob_get_contents();
		ob_end_clean();

		$briny_related_position_inside = max( 0, min( 9, briny_get_theme_option( 'related_position_inside' ) ) );
		if ( 0 == $briny_related_position_inside ) {
			$briny_related_position_inside = mt_rand( 1, 9 );
		}
		
		$briny_p_number = 0;
		$briny_related_inserted = false;
		for ( $i = 0; $i < strlen( $briny_content ) - 3; $i++ ) {
			if ( $briny_content[ $i ] == '<' && $briny_content[ $i + 1 ] == 'p' && in_array( $briny_content[ $i + 2 ], array( '>', ' ' ) ) ) {
				$briny_p_number++;
				if ( $briny_related_position_inside == $briny_p_number ) {
					$briny_related_inserted = true;
					$briny_content = ( $i > 0 ? substr( $briny_content, 0, $i ) : '' )
										. $briny_related_content
										. substr( $briny_content, $i );
				}
			}
		}
		if ( ! $briny_related_inserted ) {
			$briny_content .= $briny_related_content;
		}

		briny_show_layout( $briny_content );
	}

	// Author bio
	if ( briny_get_theme_option( 'show_author_info' ) == 1
		&& ! is_attachment()
		&& get_the_author_meta( 'description' )
		&& ( 'scroll' != $briny_posts_navigation || briny_get_theme_option( 'posts_navigation_scroll_hide_author' ) == 0 )
		&& ( ! $full_post_loading || briny_get_theme_option( 'open_full_post_hide_author' ) == 0 )
	) {
		do_action( 'briny_action_before_post_author' );
		get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/author-bio' ) );
		do_action( 'briny_action_after_post_author' );
	}

	// Previous/next post navigation.
	if ( 'links' == $briny_posts_navigation && ! $full_post_loading ) {
		do_action( 'briny_action_before_post_navigation' );
		?>
		<div class="nav-links-single<?php
			if ( ! briny_is_off( briny_get_theme_option( 'posts_navigation_fixed' ) ) ) {
				echo ' nav-links-fixed fixed';
			}
		?>">
			<?php
			the_post_navigation(
				array(
					'next_text' => '<span class="nav-arrow"></span>'
						. '<span class="screen-reader-text">' . esc_html__( 'Next post', 'briny' ) . '</span> '
						. '<h6 class="post-title">%title</h6>'
						. '<span class="post_date">%date</span>',
					'prev_text' => '<span class="nav-arrow"></span>'
						. '<span class="screen-reader-text">' . esc_html__( 'Previous post', 'briny' ) . '</span> '
						. '<h6 class="post-title">%title</h6>'
						. '<span class="post_date">%date</span>',
				)
			);
			?>
		</div>
		<?php
		do_action( 'briny_action_after_post_navigation' );
	}

	// Related posts
	if ( 'below_content' == $briny_related_position
		&& ( 'scroll' != $briny_posts_navigation || briny_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || briny_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'briny_action_related_posts' );
	}

	// If comments are open or we have at least one comment, load up the comment template.
	$briny_comments_number = get_comments_number();
	if ( comments_open() || $briny_comments_number > 0 ) {
		if ( ! $full_post_loading && ( 'scroll' != $briny_posts_navigation || briny_get_theme_option( 'posts_navigation_scroll_hide_comments' ) == 0 ) ) {
			do_action( 'briny_action_before_comments' );
			comments_template();
			do_action( 'briny_action_after_comments' );
		} else {
			?>
			<div class="show_comments_single">
				<a href="<?php comments_link(); ?>" class="theme_button show_comments_button">
					<?php
					if ( $briny_comments_number > 0 ) {
						echo esc_html( ($briny_comments_number === 1) ? esc_html__('Show comment', 'briny') :  sprintf( esc_html__('Show comments ( %d )', 'briny'), $briny_comments_number ) );
					} else {
						esc_html_e( 'Leave a comment', 'briny' );
					}
					?>
				</a>
			</div>
			<?php
		}
	}

	if ( 'scroll' == $briny_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $briny_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $briny_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $briny_prev_post ) ); ?>">
		</div>
		<?php
	}
}

get_footer();
