<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0.10
 */

// Footer sidebar
$briny_footer_name    = briny_get_theme_option( 'footer_widgets' );
$briny_footer_present = ! briny_is_off( $briny_footer_name ) && is_active_sidebar( $briny_footer_name );
if ( $briny_footer_present ) {
	briny_storage_set( 'current_sidebar', 'footer' );
	$briny_footer_wide = briny_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $briny_footer_name ) ) {
		dynamic_sidebar( $briny_footer_name );
	}
	$briny_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $briny_out ) ) {
		$briny_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $briny_out );
		$briny_need_columns = true;   //or check: strpos($briny_out, 'columns_wrap')===false;
		if ( $briny_need_columns ) {
			$briny_columns = max( 0, (int) briny_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $briny_columns ) {
				$briny_columns = min( 4, max( 1, briny_tags_count( $briny_out, 'aside' ) ) );
			}
			if ( $briny_columns > 1 ) {
				$briny_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $briny_columns ) . ' widget', $briny_out );
			} else {
				$briny_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $briny_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $briny_footer_wide ) {
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
				briny_show_layout( $briny_out );
				do_action( 'briny_action_after_sidebar' );
				if ( $briny_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $briny_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
