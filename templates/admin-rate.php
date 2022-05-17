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
<div class="briny_admin_notice briny_rate_notice update-nag">
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
	<h3 class="briny_notice_title"><a href="<?php echo esc_url( briny_storage_get( 'theme_rate_url' ) ); ?>" target="_blank">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				esc_html__( 'Rate our theme "%s", please', 'briny' ),
				$briny_theme_obj->name . ( BRINY_THEME_FREE ? ' ' . esc_html__( 'Free', 'briny' ) : '' )
			)
		);
		?>
	</a></h3>
	<?php

	// Description
	?>
	<div class="briny_notice_text">
		<p><?php echo wp_kses_data( __( 'We are glad you chose our WP theme for your website. You’ve done well customizing your website and we hope that you’ve enjoyed working with our theme.', 'briny' ) ); ?></p>
		<p><?php echo wp_kses_data( __( 'It would be just awesome if you spend just a minute of your time to rate our theme or the customer service you’ve received from us.', 'briny' ) ); ?></p>
		<p class="briny_notice_text_info"><?php echo wp_kses_data( __( '* We love receiving your reviews! Every time you leave a review, our CEO Henry Rise gives $5 to homeless dog shelter! Save the planet with us!', 'briny' ) ); ?></p>
	</div>
	<?php

	// Buttons
	?>
	<div class="briny_notice_buttons">
		<?php
		// Link to the theme download page
		?>
		<a href="<?php echo esc_url( briny_storage_get( 'theme_rate_url' ) ); ?>" class="button button-primary" target="_blank"><i class="dashicons dashicons-star-filled"></i> 
			<?php
			// Translators: Add theme name
			echo esc_html( sprintf( esc_html__( 'Rate theme %s', 'briny' ), $briny_theme_obj->name ) );
			?>
		</a>
		<?php
		// Link to the theme support
		?>
		<a href="<?php echo esc_url( briny_storage_get( 'theme_support_url' ) ); ?>" class="button" target="_blank"><i class="dashicons dashicons-sos"></i> 
			<?php
			esc_html_e( 'Support', 'briny' );
			?>
		</a>
		<?php
		// Link to the theme documentation
		?>
		<a href="<?php echo esc_url( briny_storage_get( 'theme_doc_url' ) ); ?>" class="button" target="_blank"><i class="dashicons dashicons-book"></i> 
			<?php
			esc_html_e( 'Documentation', 'briny' );
			?>
		</a>
		<?php
		// Dismiss
		?>
		<a href="#" class="briny_hide_notice"><i class="dashicons dashicons-dismiss"></i> <span class="briny_hide_notice_text"><?php esc_html_e( 'Dismiss', 'briny' ); ?></span></a>
	</div>
</div>
