<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

// Header sidebar
$briny_header_name    = briny_get_theme_option( 'header_widgets' );
$briny_header_present = ! briny_is_off( $briny_header_name ) && is_active_sidebar( $briny_header_name );
if ( $briny_header_present ) {
	briny_storage_set( 'current_sidebar', 'header' );
	$briny_header_wide = briny_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $briny_header_name ) ) {
		dynamic_sidebar( $briny_header_name );
	}
	$briny_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $briny_widgets_output ) ) {
		$briny_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $briny_widgets_output );
		$briny_need_columns   = strpos( $briny_widgets_output, 'columns_wrap' ) === false;
		if ( $briny_need_columns ) {
			$briny_columns = max( 0, (int) briny_get_theme_option( 'header_columns' ) );
			if ( 0 == $briny_columns ) {
				$briny_columns = min( 6, max( 1, briny_tags_count( $briny_widgets_output, 'aside' ) ) );
			}
			if ( $briny_columns > 1 ) {
				$briny_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $briny_columns ) . ' widget', $briny_widgets_output );
			} else {
				$briny_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $briny_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $briny_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $briny_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'briny_action_before_sidebar' );
				briny_show_layout( $briny_widgets_output );
				do_action( 'briny_action_after_sidebar' );
				if ( $briny_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $briny_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
