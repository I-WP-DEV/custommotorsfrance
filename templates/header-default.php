<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

$briny_header_css   = '';
$briny_header_image = get_header_image();
$briny_header_video = briny_get_header_video();
if ( ! empty( $briny_header_image ) && briny_trx_addons_featured_image_override( is_singular() || briny_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$briny_header_image = briny_get_current_mode_image( $briny_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $briny_header_image ) || ! empty( $briny_header_video ) ? ' with_bg_image' : ' without_bg_image';
	if ( '' != $briny_header_video ) {
		echo ' with_bg_video';
	}
	if ( '' != $briny_header_image ) {
		echo ' ' . esc_attr( briny_add_inline_css_class( 'background-image: url(' . esc_url( $briny_header_image ) . ');' ) );
	}
	if ( is_single() && has_post_thumbnail() ) {
		echo ' with_featured_image';
	}
	if ( briny_is_on( briny_get_theme_option( 'header_fullheight' ) ) ) {
		echo ' header_fullheight briny-full-height';
	}
	$briny_header_scheme = briny_get_theme_option( 'header_scheme' );
	if ( ! empty( $briny_header_scheme ) && ! briny_is_inherit( $briny_header_scheme  ) ) {
		echo ' scheme_' . esc_attr( $briny_header_scheme );
	}
	?>
">
	<?php

	// Background video
	if ( ! empty( $briny_header_video ) ) {
		get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/header-video' ) );
	}

	// Main menu
	if ( briny_get_theme_option( 'menu_style' ) == 'top' ) {
		get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/header-navi' ) );
	}

	// Mobile header
	if ( briny_is_on( briny_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/header-mobile' ) );
	}

	if ( !is_single() || ( briny_get_theme_option( 'post_header_position' ) == 'under' && briny_get_theme_option( 'post_thumbnail_type' ) == 'default' ) ) {
		// Page title and breadcrumbs area
		get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/header-title' ) );

		// Display featured image in the header on the single posts
		// Comment next line to prevent show featured image in the header area
		// and display it in the post's content
		get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/header-single' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
