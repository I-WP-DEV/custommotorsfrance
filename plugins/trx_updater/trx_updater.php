<?php
/* ThemeREX Updater support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'briny_trx_updater_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'briny_trx_updater_theme_setup9', 9 );
    function briny_trx_updater_theme_setup9() {
        if ( is_admin() ) {
            add_filter( 'briny_filter_tgmpa_required_plugins', 'briny_trx_updater_tgmpa_required_plugins', 8 );
        }
    }
}

// Filter to add in the required plugins list
// Priority 8 is used to add this plugin before all other plugins
if ( ! function_exists( 'briny_trx_updater_tgmpa_required_plugins' ) ) {
    
    function briny_trx_updater_tgmpa_required_plugins( $list = array() ) {
        if ( briny_storage_isset( 'required_plugins', 'trx_updater' ) && briny_storage_get_array( 'required_plugins', 'trx_updater', 'install' ) !== false && briny_is_theme_activated() ) {
            $path = briny_get_plugin_source_path( 'plugins/trx_updater/trx_updater.zip' );
            if ( ! empty( $path ) || briny_get_theme_setting( 'tgmpa_upload' ) ) {
                $list[] = array(
                    'name'     => briny_storage_get_array( 'required_plugins', 'trx_updater', 'title' ),
                    'slug'     => 'trx_updater',
                    'version'   => '1.9.1',
                    'source'   => ! empty( $path ) ? $path : 'upload://trx_updater.zip',
                    'required' => false,
                );
            }
        }
        return $list;
    }
}

// Check if plugin installed and activated
if ( ! function_exists( 'briny_exists_trx_updater' ) ) {
    function briny_exists_trx_updater() {
        return defined( 'TRX_UPDATER_VERSION' );
    }
}
