<div class="front_page_section front_page_section_woocommerce<?php
	$briny_scheme = briny_get_theme_option( 'front_page_woocommerce_scheme' );
	if ( ! empty( $briny_scheme ) && ! briny_is_inherit( $briny_scheme ) ) {
		echo ' scheme_' . esc_attr( $briny_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( briny_get_theme_option( 'front_page_woocommerce_paddings' ) );
?>"
		<?php
		$briny_css      = '';
		$briny_bg_image = briny_get_theme_option( 'front_page_woocommerce_bg_image' );
		if ( ! empty( $briny_bg_image ) ) {
			$briny_css .= 'background-image: url(' . esc_url( briny_get_attachment_url( $briny_bg_image ) ) . ');';
		}
		if ( ! empty( $briny_css ) ) {
			echo ' style="' . esc_attr( $briny_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$briny_anchor_icon = briny_get_theme_option( 'front_page_woocommerce_anchor_icon' );
	$briny_anchor_text = briny_get_theme_option( 'front_page_woocommerce_anchor_text' );
if ( ( ! empty( $briny_anchor_icon ) || ! empty( $briny_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_woocommerce"'
									. ( ! empty( $briny_anchor_icon ) ? ' icon="' . esc_attr( $briny_anchor_icon ) . '"' : '' )
									. ( ! empty( $briny_anchor_text ) ? ' title="' . esc_attr( $briny_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner
	<?php
	if ( briny_get_theme_option( 'front_page_woocommerce_fullheight' ) ) {
		echo ' briny-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$briny_css      = '';
			$briny_bg_mask  = briny_get_theme_option( 'front_page_woocommerce_bg_mask' );
			$briny_bg_color_type = briny_get_theme_option( 'front_page_woocommerce_bg_color_type' );
			if ( 'custom' == $briny_bg_color_type ) {
				$briny_bg_color = briny_get_theme_option( 'front_page_woocommerce_bg_color' );
			} elseif ( 'scheme_bg_color' == $briny_bg_color_type ) {
				$briny_bg_color = briny_get_scheme_color( 'bg_color', $briny_scheme );
			} else {
				$briny_bg_color = '';
			}
			if ( ! empty( $briny_bg_color ) && $briny_bg_mask > 0 ) {
				$briny_css .= 'background-color: ' . esc_attr(
					1 == $briny_bg_mask ? $briny_bg_color : briny_hex2rgba( $briny_bg_color, $briny_bg_mask )
				) . ';';
			}
			if ( ! empty( $briny_css ) ) {
				echo ' style="' . esc_attr( $briny_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$briny_caption     = briny_get_theme_option( 'front_page_woocommerce_caption' );
			$briny_description = briny_get_theme_option( 'front_page_woocommerce_description' );
			if ( ! empty( $briny_caption ) || ! empty( $briny_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $briny_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo ! empty( $briny_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( $briny_caption, 'briny_kses_content' );
					?>
					</h2>
					<?php
				}

				// Description (text)
				if ( ! empty( $briny_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo ! empty( $briny_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( wpautop( $briny_description ), 'briny_kses_content' );
					?>
					</div>
					<?php
				}
			}

			// Content (widgets)
			?>
			<div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs">
			<?php
				$briny_woocommerce_sc = briny_get_theme_option( 'front_page_woocommerce_products' );
			if ( 'products' == $briny_woocommerce_sc ) {
				$briny_woocommerce_sc_ids      = briny_get_theme_option( 'front_page_woocommerce_products_per_page' );
				$briny_woocommerce_sc_per_page = count( explode( ',', $briny_woocommerce_sc_ids ) );
			} else {
				$briny_woocommerce_sc_per_page = max( 1, (int) briny_get_theme_option( 'front_page_woocommerce_products_per_page' ) );
			}
				$briny_woocommerce_sc_columns = max( 1, min( $briny_woocommerce_sc_per_page, (int) briny_get_theme_option( 'front_page_woocommerce_products_columns' ) ) );
				echo do_shortcode(
					"[{$briny_woocommerce_sc}"
									. ( 'products' == $briny_woocommerce_sc
											? ' ids="' . esc_attr( $briny_woocommerce_sc_ids ) . '"'
											: '' )
									. ( 'product_category' == $briny_woocommerce_sc
											? ' category="' . esc_attr( briny_get_theme_option( 'front_page_woocommerce_products_categories' ) ) . '"'
											: '' )
									. ( 'best_selling_products' != $briny_woocommerce_sc
											? ' orderby="' . esc_attr( briny_get_theme_option( 'front_page_woocommerce_products_orderby' ) ) . '"'
												. ' order="' . esc_attr( briny_get_theme_option( 'front_page_woocommerce_products_order' ) ) . '"'
											: '' )
									. ' per_page="' . esc_attr( $briny_woocommerce_sc_per_page ) . '"'
									. ' columns="' . esc_attr( $briny_woocommerce_sc_columns ) . '"'
					. ']'
				);
				?>
			</div>
		</div>
	</div>
</div>
