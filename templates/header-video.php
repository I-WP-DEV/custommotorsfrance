<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0.14
 */
$briny_header_video = briny_get_header_video();
$briny_embed_video  = '';
if ( ! empty( $briny_header_video ) && ! briny_is_from_uploads( $briny_header_video ) ) {
	if ( briny_is_youtube_url( $briny_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $briny_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php briny_show_layout( briny_get_embed_video( $briny_header_video ) ); ?></div>
		<?php
	}
}
