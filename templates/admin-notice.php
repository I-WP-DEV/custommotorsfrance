<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0.1
 */

$briny_theme_obj = wp_get_theme();
?>
<div class="briny_admin_notice briny_welcome_notice update-nag">
	<?php
	// Theme image
	$briny_theme_img = briny_get_file_url( 'screenshot.jpg' );
	if ( '' != $briny_theme_img ) {
		?>
		<div class="briny_notice_image"><img src="<?php echo esc_url( $briny_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'briny' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="briny_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				esc_html__( 'Welcome to %1$s v.%2$s', 'briny' ),
				$briny_theme_obj->name . ( BRINY_THEME_FREE ? ' ' . esc_html__( 'Free', 'briny' ) : '' ),
				$briny_theme_obj->version
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="briny_notice_text">
		<p class="briny_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $briny_theme_obj->description ) );
			?>
		</p>
		<p class="briny_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'briny' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="briny_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=briny_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'briny' );
			?>
		</a>
		<?php		
		// Dismiss this notice
		?>
		<a href="#" class="briny_hide_notice"><i class="dashicons dashicons-dismiss"></i> <span class="briny_hide_notice_text"><?php esc_html_e( 'Dismiss', 'briny' ); ?></span></a>
	</div>
</div>
