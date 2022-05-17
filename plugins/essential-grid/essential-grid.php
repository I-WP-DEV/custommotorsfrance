<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'briny_essential_grid_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'briny_essential_grid_theme_setup9', 9 );
	function briny_essential_grid_theme_setup9() {
		if ( briny_exists_essential_grid() ) {
			add_action( 'wp_enqueue_scripts', 'briny_essential_grid_frontend_scripts', 1100 );
			add_filter( 'briny_filter_merge_styles', 'briny_essential_grid_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'briny_filter_tgmpa_required_plugins', 'briny_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'briny_essential_grid_tgmpa_required_plugins' ) ) {
	
	function briny_essential_grid_tgmpa_required_plugins( $list = array() ) {
		if ( briny_storage_isset( 'required_plugins', 'essential-grid' ) && briny_storage_get_array( 'required_plugins', 'essential-grid', 'install' ) !== false && briny_is_theme_activated() ) {
			$path = briny_get_plugin_source_path( 'plugins/essential-grid/essential-grid.zip' );
			if ( ! empty( $path ) || briny_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => briny_storage_get_array( 'required_plugins', 'essential-grid', 'title' ),
					'slug'     => 'essential-grid',
                    'version'   => '3.0.12',
					'source'   => ! empty( $path ) ? $path : 'upload://essential-grid.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'briny_exists_essential_grid' ) ) {
	function briny_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH') || defined( 'ESG_PLUGIN_PATH' );
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'briny_essential_grid_frontend_scripts' ) ) {
	
	function briny_essential_grid_frontend_scripts() {
		if ( briny_is_on( briny_get_theme_option( 'debug_mode' ) ) ) {
			$briny_url = briny_get_file_url( 'plugins/essential-grid/essential-grid.css' );
			if ( '' != $briny_url ) {
				wp_enqueue_style( 'briny-essential-grid', $briny_url, array(), null );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'briny_essential_grid_merge_styles' ) ) {
	
	function briny_essential_grid_merge_styles( $list ) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}

