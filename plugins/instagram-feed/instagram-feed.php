<?php
/*
Instagram Feed support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'briny_instagram_feed_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'briny_instagram_feed_theme_setup9', 9 );
	function briny_instagram_feed_theme_setup9() {
		if ( briny_exists_instagram_feed() ) {
			add_action( 'wp_enqueue_scripts', 'briny_instagram_responsive_styles', 2000 );
			add_filter( 'briny_filter_merge_styles_responsive', 'briny_instagram_merge_styles_responsive' );
		}
		if ( is_admin() ) {
			add_filter( 'briny_filter_tgmpa_required_plugins', 'briny_instagram_feed_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'briny_instagram_feed_tgmpa_required_plugins' ) ) {
	
	function briny_instagram_feed_tgmpa_required_plugins( $list = array() ) {
		if ( briny_storage_isset( 'required_plugins', 'instagram-feed' ) && briny_storage_get_array( 'required_plugins', 'instagram-feed', 'install' ) !== false ) {
			$list[] = array(
				'name'     => briny_storage_get_array( 'required_plugins', 'instagram-feed', 'title' ),
				'slug'     => 'instagram-feed',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if Instagram Feed installed and activated
if ( ! function_exists( 'briny_exists_instagram_feed' ) ) {
	function briny_exists_instagram_feed() {
		return defined( 'SBIVER' );
	}
}

// Enqueue responsive styles for frontend
if ( ! function_exists( 'briny_instagram_responsive_styles' ) ) {
	
	function briny_instagram_responsive_styles() {
		if ( briny_is_on( briny_get_theme_option( 'debug_mode' ) ) ) {
			$briny_url = briny_get_file_url( 'plugins/instagram/instagram-responsive.css' );
			if ( '' != $briny_url ) {
				wp_enqueue_style( 'briny-instagram-responsive', $briny_url, array(), null );
			}
		}
	}
}

// Merge responsive styles
if ( ! function_exists( 'briny_instagram_merge_styles_responsive' ) ) {
	
	function briny_instagram_merge_styles_responsive( $list ) {
		$list[] = 'plugins/instagram/instagram-responsive.css';
		return $list;
	}
}

