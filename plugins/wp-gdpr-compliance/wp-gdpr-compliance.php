<?php
/* WP GDPR Compliance support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'briny_wp_gdpr_compliance_feed_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'briny_wp_gdpr_compliance_theme_setup9', 9 );
	function briny_wp_gdpr_compliance_theme_setup9() {
		if ( is_admin() ) {
			add_filter( 'briny_filter_tgmpa_required_plugins', 'briny_wp_gdpr_compliance_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'briny_wp_gdpr_compliance_tgmpa_required_plugins' ) ) {
	
	function briny_wp_gdpr_compliance_tgmpa_required_plugins( $list = array() ) {
		if ( briny_storage_isset( 'required_plugins', 'wp-gdpr-compliance' ) && briny_storage_get_array( 'required_plugins', 'wp-gdpr-compliance', 'install' ) !== false ) {
			$list[] = array(
				'name'     => briny_storage_get_array( 'required_plugins', 'wp-gdpr-compliance', 'title' ),
				'slug'     => 'wp-gdpr-compliance',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'briny_exists_wp_gdpr_compliance' ) ) {
    function briny_exists_wp_gdpr_compliance() {
        return defined( 'WP_GDPR_C_ROOT_FILE' ) || defined( 'WPGDPRC_ROOT_FILE' );
    }
}


