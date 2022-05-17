<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'briny_mailchimp_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'briny_mailchimp_theme_setup9', 9 );
	function briny_mailchimp_theme_setup9() {
		if ( briny_exists_mailchimp() ) {
			add_action( 'wp_enqueue_scripts', 'briny_mailchimp_frontend_scripts', 1100 );
			add_filter( 'briny_filter_merge_styles', 'briny_mailchimp_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'briny_filter_tgmpa_required_plugins', 'briny_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'briny_mailchimp_tgmpa_required_plugins' ) ) {
	
	function briny_mailchimp_tgmpa_required_plugins( $list = array() ) {
		if ( briny_storage_isset( 'required_plugins', 'mailchimp-for-wp' ) && briny_storage_get_array( 'required_plugins', 'mailchimp-for-wp', 'install' ) !== false ) {
			$list[] = array(
				'name'     => briny_storage_get_array( 'required_plugins', 'mailchimp-for-wp', 'title' ),
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'briny_exists_mailchimp' ) ) {
	function briny_exists_mailchimp() {
		return function_exists( '__mc4wp_load_plugin' ) || defined( 'MC4WP_VERSION' );
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue styles for frontend
if ( ! function_exists( 'briny_mailchimp_frontend_scripts' ) ) {
	
	function briny_mailchimp_frontend_scripts() {
		if ( briny_is_on( briny_get_theme_option( 'debug_mode' ) ) ) {
			$briny_url = briny_get_file_url( 'plugins/mailchimp-for-wp/mailchimp-for-wp.css' );
			if ( '' != $briny_url ) {
				wp_enqueue_style( 'briny-mailchimp', $briny_url, array(), null );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'briny_mailchimp_merge_styles' ) ) {
	
	function briny_mailchimp_merge_styles( $list ) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( briny_exists_mailchimp() ) {
	require_once BRINY_THEME_DIR . 'plugins/mailchimp-for-wp/mailchimp-for-wp-styles.php'; }

