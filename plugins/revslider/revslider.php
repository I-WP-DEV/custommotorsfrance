<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'briny_revslider_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'briny_revslider_theme_setup9', 9 );
	function briny_revslider_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'briny_filter_tgmpa_required_plugins', 'briny_revslider_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'briny_revslider_tgmpa_required_plugins' ) ) {
	
	function briny_revslider_tgmpa_required_plugins( $list = array() ) {
		if ( briny_storage_isset( 'required_plugins', 'revslider' ) && briny_storage_get_array( 'required_plugins', 'revslider', 'install' ) !== false && briny_is_theme_activated() ) {
			$path = briny_get_plugin_source_path( 'plugins/revslider/revslider.zip' );
			if ( ! empty( $path ) || briny_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => briny_storage_get_array( 'required_plugins', 'revslider', 'title' ),
					'slug'     => 'revslider',
					'version'   => '6.5.5',
					'source'   => ! empty( $path ) ? $path : 'upload://revslider.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if RevSlider installed and activated
if ( ! function_exists( 'briny_exists_revslider' ) ) {
	function briny_exists_revslider() {
		return function_exists( 'rev_slider_shortcode' );
	}
}
