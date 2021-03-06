<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js
									<?php
										// Class scheme_xxx need in the <html> as context for the <body>!
										echo ' scheme_' . esc_attr( briny_get_theme_option( 'color_scheme' ) );
									?>
										">
<head>
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>

	<?php wp_body_open(); ?>

	<?php do_action( 'briny_action_before_body' ); ?>

	<div class="body_wrap">

		<div class="page_wrap">
			<?php
			// Desktop header
			$briny_header_type = briny_get_theme_option( 'header_type' );
			if ( 'custom' == $briny_header_type && ! briny_is_layouts_available() ) {
				$briny_header_type = 'default';
			}
			get_template_part( apply_filters( 'briny_filter_get_template_part', "templates/header-{$briny_header_type}" ) );

			// Side menu
			if ( in_array( briny_get_theme_option( 'menu_style' ), array( 'left', 'right' ) ) ) {
				get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/header-navi-side' ) );
			}

			// Mobile menu
			get_template_part( apply_filters( 'briny_filter_get_template_part', 'templates/header-navi-mobile' ) );
			
			// Single posts banner after header
			briny_show_post_banner( 'header' );
			?>

			<div class="page_content_wrap">
				<?php
				// Single posts banner on the background
				if ( is_singular( 'post' ) || is_singular( 'attachment' ) ) {

					briny_show_post_banner( 'background' );

					$briny_post_thumbnail_type  = briny_get_theme_option( 'post_thumbnail_type' );
					$briny_post_header_position = briny_get_theme_option( 'post_header_position' );
					$briny_post_header_align    = briny_get_theme_option( 'post_header_align' );

					// Boxed post thumbnail
					if ( in_array( $briny_post_thumbnail_type, array( 'boxed', 'fullwidth') ) ) {
						ob_start();
						?>
						<div class="header_content_wrap header_align_<?php echo esc_attr( $briny_post_header_align ); ?>">
							<?php
							if ( 'boxed' === $briny_post_thumbnail_type ) {
								?>
								<div class="content_wrap">
								<?php
							}

							// Post title and meta
							if ( 'above' === $briny_post_header_position ) {
								briny_show_post_title_and_meta();
							}

							// Featured image
							briny_show_post_featured_image();

							// Post title and meta
							if ( in_array( $briny_post_header_position, array( 'under', 'on_thumb' ) ) ) {
								briny_show_post_title_and_meta();
							}

							if ( 'boxed' === $briny_post_thumbnail_type ) {
								?>
								</div>
								<?php
							}
							?>
						</div>
						<?php
						$briny_post_header = ob_get_contents();
						ob_end_clean();
						if ( strpos( $briny_post_header, 'post_featured' ) !== false || strpos( $briny_post_header, 'post_title' ) !== false ) {
							briny_show_layout( $briny_post_header );
						}
					}
				}

				// Widgets area above page content
				$briny_body_style   = briny_get_theme_option( 'body_style' );
				$briny_widgets_name = briny_get_theme_option( 'widgets_above_page' );
				$briny_show_widgets = ! briny_is_off( $briny_widgets_name ) && is_active_sidebar( $briny_widgets_name );
				if ( $briny_show_widgets ) {
					if ( 'fullscreen' != $briny_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					briny_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $briny_body_style ) {
						?>
						</div><!-- </.content_wrap> -->
						<?php
					}
				}

				// Content area
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $briny_body_style ? '_fullscreen' : ''; ?>">

					<div class="content">
						<?php
						// Widgets area inside page content
						briny_create_widgets_area( 'widgets_above_content' );
