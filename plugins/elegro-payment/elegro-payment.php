<?php
/* Elegro Crypto Payment support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'briny_elegro_payment_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'briny_elegro_payment_theme_setup9', 9 );
    function briny_elegro_payment_theme_setup9() {
        if ( briny_exists_elegro_payment() ) {
            add_filter( 'briny_filter_merge_styles', 'briny_elegro_payment_merge_styles' );
        }
        if ( is_admin() ) {
            add_filter( 'briny_filter_tgmpa_required_plugins', 'briny_elegro_payment_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'briny_elegro_payment_tgmpa_required_plugins' ) ) {

    function briny_elegro_payment_tgmpa_required_plugins( $list = array() ) {
        if ( briny_storage_isset( 'required_plugins', 'elegro-payment' ) && briny_storage_get_array( 'required_plugins', 'elegro-payment', 'install' ) !== false ) {
            // Elegro plugin
            $list[] = array(
                'name'     => briny_storage_get_array( 'required_plugins', 'elegro-payment', 'title' ),
                'slug'     => 'elegro-payment',
                'required' => false,
            );

        }
        return $list;
    }
}

// Check if this plugin installed and activated
if ( ! function_exists( 'briny_exists_elegro_payment' ) ) {
    function briny_exists_elegro_payment() {
        return class_exists( 'WC_Elegro_Payment' );
    }
}

// Merge custom styles
if ( ! function_exists( 'briny_elegro_payment_merge_styles' ) ) {
    function briny_elegro_payment_merge_styles( $list ) {
        $list[] = 'plugins/elegro-payment/_elegro-payment.scss';
        return $list;
    }
}