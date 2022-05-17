<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

if ( briny_sidebar_present() ) {
	ob_start();
	$briny_sidebar_name = briny_get_theme_option( 'sidebar_widgets' );
	briny_storage_set( 'current_sidebar', 'sidebar' );
	if ( is_active_sidebar( $briny_sidebar_name ) ) {
		dynamic_sidebar( $briny_sidebar_name );
	}
	$briny_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $briny_out ) ) {
		$briny_sidebar_position    = briny_get_theme_option( 'sidebar_position' );
		$briny_sidebar_position_ss = briny_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $briny_sidebar_position );
			echo ' sidebar_' . esc_attr( $briny_sidebar_position_ss );

			if ( 'float' == $briny_sidebar_position_ss ) {
				echo ' sidebar_float';
			}
			$briny_sidebar_scheme = briny_get_theme_option( 'sidebar_scheme' );
			if ( ! empty( $briny_sidebar_scheme ) && ! briny_is_inherit( $briny_sidebar_scheme ) ) {
				echo ' scheme_' . esc_attr( $briny_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php
			// Single posts banner before sidebar
			briny_show_post_banner( 'sidebar' );
			// Button to show/hide sidebar on mobile
			if ( in_array( $briny_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$briny_title = apply_filters( 'briny_filter_sidebar_control_title', 'float' == $briny_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'briny' ) : '' );
				$briny_text  = apply_filters( 'briny_filter_sidebar_control_text', 'above' == $briny_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'briny' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $briny_title ); ?>"><?php echo esc_html( $briny_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'briny_action_before_sidebar' );
				briny_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $briny_out ) );
				do_action( 'briny_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<div class="clearfix"></div>
		<?php
	}
}
