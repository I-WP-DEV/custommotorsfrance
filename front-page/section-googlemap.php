<div class="front_page_section front_page_section_googlemap<?php
	$briny_scheme = briny_get_theme_option( 'front_page_googlemap_scheme' );
	if ( ! empty( $briny_scheme ) && ! briny_is_inherit( $briny_scheme ) ) {
		echo ' scheme_' . esc_attr( $briny_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( briny_get_theme_option( 'front_page_googlemap_paddings' ) );
?>"
		<?php
		$briny_css      = '';
		$briny_bg_image = briny_get_theme_option( 'front_page_googlemap_bg_image' );
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
	$briny_anchor_icon = briny_get_theme_option( 'front_page_googlemap_anchor_icon' );
	$briny_anchor_text = briny_get_theme_option( 'front_page_googlemap_anchor_text' );
if ( ( ! empty( $briny_anchor_icon ) || ! empty( $briny_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_googlemap"'
									. ( ! empty( $briny_anchor_icon ) ? ' icon="' . esc_attr( $briny_anchor_icon ) . '"' : '' )
									. ( ! empty( $briny_anchor_text ) ? ' title="' . esc_attr( $briny_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_googlemap_inner
	<?php
	if ( briny_get_theme_option( 'front_page_googlemap_fullheight' ) ) {
		echo ' briny-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$briny_css      = '';
			$briny_bg_mask  = briny_get_theme_option( 'front_page_googlemap_bg_mask' );
			$briny_bg_color_type = briny_get_theme_option( 'front_page_googlemap_bg_color_type' );
			if ( 'custom' == $briny_bg_color_type ) {
				$briny_bg_color = briny_get_theme_option( 'front_page_googlemap_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap
		<?php
			$briny_layout = briny_get_theme_option( 'front_page_googlemap_layout' );
		if ( 'fullwidth' != $briny_layout ) {
			echo ' content_wrap';
		}
		?>
		">
			<?php
			// Content wrap with title and description
			$briny_caption     = briny_get_theme_option( 'front_page_googlemap_caption' );
			$briny_description = briny_get_theme_option( 'front_page_googlemap_description' );
			if ( ! empty( $briny_caption ) || ! empty( $briny_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'fullwidth' == $briny_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}
					// Caption
				if ( ! empty( $briny_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo ! empty( $briny_caption ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $briny_caption, 'briny_kses_content' );
					?>
					</h2>
					<?php
				}

					// Description (text)
				if ( ! empty( $briny_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo ! empty( $briny_description ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( wpautop( $briny_description ), 'briny_kses_content' );
					?>
					</div>
					<?php
				}
				if ( 'fullwidth' == $briny_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$briny_content = briny_get_theme_option( 'front_page_googlemap_content' );
			if ( ! empty( $briny_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				if ( 'columns' == $briny_layout ) {
					?>
					<div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} elseif ( 'fullwidth' == $briny_layout ) {
					?>
					<div class="content_wrap">
					<?php
				}

				?>
				<div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo ! empty( $briny_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses( $briny_content, 'briny_kses_content' );
				?>
				</div>
				<?php

				if ( 'columns' == $briny_layout ) {
					?>
					</div><div class="column-2_3">
					<?php
				} elseif ( 'fullwidth' == $briny_layout ) {
					?>
					</div>
					<?php
				}
			}

			// Widgets output
			?>
			<div class="front_page_section_output front_page_section_googlemap_output">
			<?php
			if ( is_active_sidebar( 'front_page_googlemap_widgets' ) ) {
				dynamic_sidebar( 'front_page_googlemap_widgets' );
			} elseif ( current_user_can( 'edit_theme_options' ) ) {
				if ( ! briny_exists_trx_addons() ) {
					briny_customizer_need_trx_addons_message();
				} else {
					briny_customizer_need_widgets_message( 'front_page_googlemap_caption', 'ThemeREX Addons - Google map' );
				}
			}
			?>
			</div>
			<?php

			if ( 'columns' == $briny_layout && ( ! empty( $briny_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>
		</div>
	</div>
</div>
