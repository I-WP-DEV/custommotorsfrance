<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0.10
 */

// Footer menu
$briny_menu_footer = briny_get_nav_menu( 'menu_footer' );
if ( ! empty( $briny_menu_footer ) ) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php
			briny_show_layout(
				$briny_menu_footer,
				'<nav class="menu_footer_nav_area sc_layouts_menu sc_layouts_menu_default"'
					. ' itemscope itemtype="//schema.org/SiteNavigationElement"'
					. '>',
				'</nav>'
			);
			?>
		</div>
	</div>
	<?php
}
