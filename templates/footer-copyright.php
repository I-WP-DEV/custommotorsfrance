<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$briny_copyright_scheme = briny_get_theme_option( 'copyright_scheme' );
if ( ! empty( $briny_copyright_scheme ) && ! briny_is_inherit( $briny_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $briny_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$briny_copyright = briny_get_theme_option( 'copyright' );
			if ( ! empty( $briny_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$briny_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $briny_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$briny_copyright = briny_prepare_macros( $briny_copyright );
				// Display copyright
				echo wp_kses( nl2br( $briny_copyright ), 'briny_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
