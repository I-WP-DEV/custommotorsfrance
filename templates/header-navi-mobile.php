<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr( briny_get_theme_option( 'menu_mobile_fullscreen' ) > 0 ? 'fullscreen' : 'narrow' ); ?> scheme_dark">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close theme_button_close"><span class="theme_button_close_icon"></span></a>
		<?php

		// Logo
		set_query_var( 'briny_logo_args', array( 'type' => 'mobile' ) );
		get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/header-logo' ) );
		set_query_var( 'briny_logo_args', array() );

		// Mobile menu
		$briny_menu_mobile = briny_get_nav_menu( 'menu_mobile' );
		if ( empty( $briny_menu_mobile ) ) {
			$briny_menu_mobile = apply_filters( 'briny_filter_get_mobile_menu', '' );
			if ( empty( $briny_menu_mobile ) ) {
				$briny_menu_mobile = briny_get_nav_menu( 'menu_main' );
				if ( empty( $briny_menu_mobile ) ) {
					$briny_menu_mobile = briny_get_nav_menu();
				}
			}
		}
		if ( ! empty( $briny_menu_mobile ) ) {
			$briny_menu_mobile = str_replace(
				array( 'menu_main',   'id="menu-',        'sc_layouts_menu_nav', 'sc_layouts_menu ', 'sc_layouts_hide_on_mobile', 'hide_on_mobile' ),
				array( 'menu_mobile', 'id="menu_mobile-', '',                    ' ',                '',                          '' ),
				$briny_menu_mobile
			);
			if ( strpos( $briny_menu_mobile, '<nav ' ) === false ) {
				$briny_menu_mobile = sprintf( '<nav class="menu_mobile_nav_area" itemscope itemtype="//schema.org/SiteNavigationElement">%s</nav>', $briny_menu_mobile );
			}
			briny_show_layout( apply_filters( 'briny_filter_menu_mobile_layout', $briny_menu_mobile ) );
		}

		// Search field
		do_action(
			'briny_action_search',
			array(
				'style' => 'normal',
				'class' => 'search_mobile',
				'ajax'  => false
			)
		);

		// Social icons
		briny_show_layout( briny_get_socials_links(), '<div class="socials_mobile">', '</div>' );
		?>
	</div>
</div>
