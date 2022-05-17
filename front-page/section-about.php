<div class="front_page_section front_page_section_about<?php
	$briny_scheme = briny_get_theme_option( 'front_page_about_scheme' );
	if ( ! empty( $briny_scheme ) && ! briny_is_inherit( $briny_scheme ) ) {
		echo ' scheme_' . esc_attr( $briny_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( briny_get_theme_option( 'front_page_about_paddings' ) );
?>"
		<?php
		$briny_css      = '';
		$briny_bg_image = briny_get_theme_option( 'front_page_about_bg_image' );
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
	$briny_anchor_icon = briny_get_theme_option( 'front_page_about_anchor_icon' );
	$briny_anchor_text = briny_get_theme_option( 'front_page_about_anchor_text' );
if ( ( ! empty( $briny_anchor_icon ) || ! empty( $briny_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_about"'
									. ( ! empty( $briny_anchor_icon ) ? ' icon="' . esc_attr( $briny_anchor_icon ) . '"' : '' )
									. ( ! empty( $briny_anchor_text ) ? ' title="' . esc_attr( $briny_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_about_inner
	<?php
	if ( briny_get_theme_option( 'front_page_about_fullheight' ) ) {
		echo ' briny-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$briny_css           = '';
			$briny_bg_mask       = briny_get_theme_option( 'front_page_about_bg_mask' );
			$briny_bg_color_type = briny_get_theme_option( 'front_page_about_bg_color_type' );
			if ( 'custom' == $briny_bg_color_type ) {
				$briny_bg_color = briny_get_theme_option( 'front_page_about_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_about_content_wrap content_wrap">
			<?php
			// Caption
			$briny_caption = briny_get_theme_option( 'front_page_about_caption' );
			if ( ! empty( $briny_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_about_caption front_page_block_<?php echo ! empty( $briny_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $briny_caption, 'briny_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$briny_description = briny_get_theme_option( 'front_page_about_description' );
			if ( ! empty( $briny_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_about_description front_page_block_<?php echo ! empty( $briny_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $briny_description ), 'briny_kses_content' ); ?></div>
				<?php
			}

			// Content
			$briny_content = briny_get_theme_option( 'front_page_about_content' );
			if ( ! empty( $briny_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_content front_page_section_about_content front_page_block_<?php echo ! empty( $briny_content ) ? 'filled' : 'empty'; ?>">
				<?php
					$briny_page_content_mask = '%%CONTENT%%';
				if ( strpos( $briny_content, $briny_page_content_mask ) !== false ) {
					$briny_content = preg_replace(
						'/(\<p\>\s*)?' . $briny_page_content_mask . '(\s*\<\/p\>)/i',
						sprintf(
							'<div class="front_page_section_about_source">%s</div>',
							apply_filters( 'the_content', get_the_content() )
						),
						$briny_content
					);
				}
					briny_show_layout( $briny_content );
				?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
