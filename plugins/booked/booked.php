<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'briny_booked_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'briny_booked_theme_setup9', 9 );
	function briny_booked_theme_setup9() {
		if ( briny_exists_booked() ) {
			add_action( 'wp_enqueue_scripts', 'briny_booked_frontend_scripts', 1100 );
			add_filter( 'briny_filter_merge_styles', 'briny_booked_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'briny_filter_tgmpa_required_plugins', 'briny_booked_tgmpa_required_plugins' );
			add_filter( 'briny_filter_theme_plugins', 'briny_booked_theme_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'briny_booked_tgmpa_required_plugins' ) ) {
	
	function briny_booked_tgmpa_required_plugins( $list = array() ) {
		if ( briny_storage_isset( 'required_plugins', 'booked' ) && briny_storage_get_array( 'required_plugins', 'booked', 'install' ) !== false && briny_is_theme_activated() ) {
			$path = briny_get_plugin_source_path( 'plugins/booked/booked.zip' );
			if ( ! empty( $path ) || briny_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => briny_storage_get_array( 'required_plugins', 'booked', 'title' ),
					'slug'     => 'booked',
                    'version'   => '2.3.5',
					'source'   => ! empty( $path ) ? $path : 'upload://booked.zip',
					'required' => false,
				);
			}

		}
		return $list;
	}
}

// Filter theme-supported plugins list
if ( ! function_exists( 'briny_booked_theme_plugins' ) ) {
	
	function briny_booked_theme_plugins( $list = array() ) {
		if ( ! empty( $list['booked']['group'] ) ) {
			foreach ( $list as $k => $v ) {
				if ( substr( $k, 0, 6 ) == 'booked' ) {
					if ( empty( $v['group'] ) ) {
						$list[ $k ]['group'] = $list['booked']['group'];
					}
					if ( ! empty( $list['booked']['logo'] ) ) {
						$list[ $k ]['logo'] = strpos( $list['booked']['logo'], '//' ) !== false
												? $list['booked']['logo']
												: briny_get_file_url( "plugins/booked/{$list['booked']['logo']}" );
					}
				}
			}
		}
		return $list;
	}
}



// Check if plugin installed and activated
if ( ! function_exists( 'briny_exists_booked' ) ) {
	function briny_exists_booked() {
		return class_exists( 'booked_plugin' );
	}
}


// Enqueue styles for frontend
if ( ! function_exists( 'briny_booked_frontend_scripts' ) ) {
	
	function briny_booked_frontend_scripts() {
		if ( briny_is_on( briny_get_theme_option( 'debug_mode' ) ) ) {
			$briny_url = briny_get_file_url( 'plugins/booked/booked.css' );
			if ( '' != $briny_url ) {
				wp_enqueue_style( 'briny-booked', $briny_url, array(), null );
			}
		}
	}
}


// Merge custom styles
if ( ! function_exists( 'briny_booked_merge_styles' ) ) {
	
	function briny_booked_merge_styles( $list ) {
		$list[] = 'plugins/booked/booked.css';
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( briny_exists_booked() ) {
	require_once BRINY_THEME_DIR . 'plugins/booked/booked-styles.php';
}
