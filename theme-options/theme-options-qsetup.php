<?php
/**
 * Quick Setup Section in the Theme Panel
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0.48
 */


// Load required styles and scripts for admin mode
if ( ! function_exists( 'briny_options_qsetup_add_scripts' ) ) {
	add_action("admin_enqueue_scripts", 'briny_options_qsetup_add_scripts');
	function briny_options_qsetup_add_scripts() {
		if ( ! BRINY_THEME_FREE ) {
			$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : false;
			if ( is_object( $screen ) && ! empty( $screen->id ) && false !== strpos($screen->id, 'page_trx_addons_theme_panel') ) {
				wp_enqueue_style( 'fontello-icons', briny_get_file_url( 'css/font-icons/css/fontello.css' ), array(), null );
				wp_enqueue_script( 'jquery-ui-tabs', false, array( 'jquery', 'jquery-ui-core' ), null, true );
				wp_enqueue_script( 'jquery-ui-accordion', false, array( 'jquery', 'jquery-ui-core' ), null, true );
				wp_enqueue_script( 'briny-options', briny_get_file_url( 'theme-options/theme-options.js' ), array( 'jquery' ), null, true );
				wp_localize_script( 'briny-options', 'briny_dependencies', briny_get_theme_dependencies() );
			}
		}
	}
}


// Add step to the 'Quick Setup'
if ( ! function_exists( 'briny_options_qsetup_theme_panel_steps' ) ) {
	add_filter( 'trx_addons_filter_theme_panel_steps', 'briny_options_qsetup_theme_panel_steps' );
	function briny_options_qsetup_theme_panel_steps( $steps ) {
		if ( ! BRINY_THEME_FREE ) {
			$steps = briny_array_merge( $steps, array( 'qsetup' => esc_html__( 'Start customizing your theme.', 'briny' ) ) );
		}
		return $steps;
	}
}


// Add tab link 'Quick Setup'
if ( ! function_exists( 'briny_options_qsetup_theme_panel_tabs' ) ) {
	add_filter( 'trx_addons_filter_theme_panel_tabs', 'briny_options_qsetup_theme_panel_tabs' );
	function briny_options_qsetup_theme_panel_tabs( $tabs ) {
		if ( ! BRINY_THEME_FREE ) {
			$tabs = briny_array_merge( $tabs, array( 'qsetup' => esc_html__( 'Quick Setup', 'briny' ) ) );
		}
		return $tabs;
	}
}

// Add accent colors to the 'Quick Setup' section in the Theme Panel
if ( ! function_exists( 'briny_options_qsetup_add_accent_colors' ) ) {
	add_filter( 'briny_filter_qsetup_options', 'briny_options_qsetup_add_accent_colors' );
	function briny_options_qsetup_add_accent_colors( $options ) {
		return briny_array_merge(
			array(
				'colors_info'        => array(
					'title'    => esc_html__( 'Theme Colors', 'briny' ),
					'desc'     => '',
					'qsetup'   => esc_html__( 'General', 'briny' ),
					'type'     => 'info',
				),
				'colors_text_link'   => array(
					'title'    => esc_html__( 'Accent color 1', 'briny' ),
					'desc'     => wp_kses_data( __( "Color of the links", 'briny' ) ),
					'std'      => '',
					'val'      => briny_get_scheme_color( 'text_link' ),
					'qsetup'   => esc_html__( 'General', 'briny' ),
					'type'     => 'color',
				),
				'colors_text_hover'  => array(
					'title'    => esc_html__( 'Accent color 1 (hovered state)', 'briny' ),
					'desc'     => wp_kses_data( __( "Color of the hovered state of the links", 'briny' ) ),
					'std'      => '',
					'val'      => briny_get_scheme_color( 'text_hover' ),
					'qsetup'   => esc_html__( 'General', 'briny' ),
					'type'     => 'color',
				),
				'colors_text_link2'  => array(
					'title'    => esc_html__( 'Accent color 2', 'briny' ),
					'desc'     => wp_kses_data( __( "Color of the accented areas", 'briny' ) ),
					'std'      => '',
					'val'      => briny_get_scheme_color( 'text_link2' ),
					'qsetup'   => esc_html__( 'General', 'briny' ),
					'type'     => 'color',
				),
				'colors_text_hover2' => array(
					'title'    => esc_html__( 'Accent color 2 (hovered state)', 'briny' ),
					'desc'     => wp_kses_data( __( "Color of the hovered state of the accented areas", 'briny' ) ),
					'std'      => '',
					'val'      => briny_get_scheme_color( 'text_hover2' ),
					'qsetup'   => esc_html__( 'General', 'briny' ),
					'type'     => 'color',
				),
				'colors_text_link3'  => array(
					'title'    => esc_html__( 'Accent color 3', 'briny' ),
					'desc'     => wp_kses_data( __( "Color of the another accented areas", 'briny' ) ),
					'std'      => '',
					'val'      => briny_get_scheme_color( 'text_link3' ),
					'qsetup'   => esc_html__( 'General', 'briny' ),
					'type'     => 'color',
				),
				'colors_text_hover3' => array(
					'title'    => esc_html__( 'Accent color 3 (hovered state)', 'briny' ),
					'desc'     => wp_kses_data( __( "Color of the hovered state of the another accented areas", 'briny' ) ),
					'std'      => '',
					'val'      => briny_get_scheme_color( 'text_hover3' ),
					'qsetup'   => esc_html__( 'General', 'briny' ),
					'type'     => 'color',
				),
			),
			$options
		);
	}
}

// Display 'Quick Setup' section in the Theme Panel
if ( ! function_exists( 'briny_options_qsetup_theme_panel_section' ) ) {
	add_action( 'trx_addons_action_theme_panel_section', 'briny_options_qsetup_theme_panel_section', 10, 2);
	function briny_options_qsetup_theme_panel_section( $tab_id, $theme_info ) {
		if ( 'qsetup' !== $tab_id ) return;
		?>
		<div id="trx_addons_theme_panel_section_<?php echo esc_attr($tab_id); ?>" class="trx_addons_tabs_section">

			<?php do_action('trx_addons_action_theme_panel_section_start', $tab_id, $theme_info); ?>
			
			<div class="trx_addons_theme_panel_qsetup">

				<?php do_action('trx_addons_action_theme_panel_before_section_title', $tab_id, $theme_info); ?>

				<h1 class="trx_addons_theme_panel_section_title">
					<?php esc_html_e( 'Quick Setup', 'briny' ); ?>
				</h1>

				<?php do_action('trx_addons_action_theme_panel_after_section_title', $tab_id, $theme_info); ?>
				
				<div class="trx_addons_theme_panel_section_info">
					<p>
						<?php
						echo wp_kses_data( __( 'Here you can customize the basic settings of your website.', 'briny' ) )
							. ' '
							. wp_kses_data( sprintf(
								__( 'For a detailed customization, go to %s.', 'briny' ),
								'<a href="' . esc_url(admin_url() . 'customize.php') . '">' . esc_html__( 'Customizer', 'briny' ) . '</a>'
								. ( BRINY_THEME_FREE 
									? ''
									: ' ' . esc_html__( 'or', 'briny' ) . ' ' . '<a href="' . esc_url( get_admin_url( null, 'admin.php?page=trx_addons_theme_panel' ) ) . '">' . esc_html__( 'Theme Options', 'briny' ) . '</a>'
									)
								)
							);
						?>
					</p>
					<p><?php echo wp_kses_data( __( "<b>Note:</b> If you've imported the demo data, you may skip this step, since all the necessary settings have already been applied.", 'briny' ) ); ?></p>
				</div>

				<?php
				do_action('trx_addons_action_theme_panel_before_qsetup', $tab_id, $theme_info);

				briny_options_qsetup_show();

				do_action('trx_addons_action_theme_panel_after_qsetup', $tab_id, $theme_info);

				do_action('trx_addons_action_theme_panel_after_section_data', $tab_id, $theme_info);
				?>

			</div>

			<?php do_action('trx_addons_action_theme_panel_section_end', $tab_id, $theme_info); ?>

		</div>
		<?php
	}
}


// Display options
if ( ! function_exists( 'briny_options_qsetup_show' ) ) {
	function briny_options_qsetup_show() {
		$tabs_titles  = array();
		$tabs_content = array();
		$options      = apply_filters( 'briny_filter_qsetup_options', briny_storage_get( 'options' ) );
		// Show fields
		$cnt = 0;
		foreach ( $options as $k => $v ) {
			if ( empty( $v['qsetup'] ) ) {
				continue;
			}
			if ( is_bool( $v['qsetup'] ) ) {
				$v['qsetup'] = esc_html__( 'General', 'briny' );
			}
			if ( ! isset( $tabs_titles[ $v['qsetup'] ] ) ) {
				$tabs_titles[ $v['qsetup'] ]  = $v['qsetup'];
				$tabs_content[ $v['qsetup'] ] = '';
			}
			if ( 'info' !== $v['type'] ) {
				$cnt++;
				if ( ! empty( $v['class'] ) ) {
					$v['class'] = str_replace( array( 'briny_column-1_2', 'briny_new_row' ), '', $v['class'] );
				}
				$v['class'] = ( ! empty( $v['class'] ) ? $v['class'] . ' ' : '' ) . 'briny_column-1_2' . ( $cnt % 2 == 1 ? ' briny_new_row' : '' );
			} else {
				$cnt = 0;
			}
			$tabs_content[ $v['qsetup'] ] .= briny_options_show_field( $k, $v );
		}
		if ( count( $tabs_titles ) > 0 ) {
			?>
			<div class="briny_options briny_options_qsetup">
				<form action="<?php echo esc_url( get_admin_url( null, 'admin.php?page=trx_addons_theme_panel' ) ); ?>" class="trx_addons_theme_panel_section_form" name="trx_addons_theme_panel_qsetup_form" method="post">
					<input type="hidden" name="qsetup_options_nonce" value="<?php echo esc_attr( wp_create_nonce( admin_url() ) ); ?>" />
					<?php
					if ( count( $tabs_titles ) > 1 ) {
						?>
						<div id="briny_options_tabs" class="briny_tabs">
							<ul>
								<?php
								$cnt = 0;
								foreach ( $tabs_titles as $k => $v ) {
									$cnt++;
									?>
									<li><a href="#briny_options_<?php echo esc_attr( $cnt ); ?>"><?php echo esc_html( $v ); ?></a></li>
									<?php
								}
								?>
							</ul>
							<?php
							$cnt = 0;
							foreach ( $tabs_content as $k => $v ) {
								$cnt++;
								?>
								<div id="briny_options_<?php echo esc_attr( $cnt ); ?>" class="briny_tabs_section briny_options_section">
									<?php briny_show_layout( $v ); ?>
								</div>
								<?php
							}
							?>
						</div>
						<?php
					} else {
						?>
						<div class="briny_options_section">
							<?php briny_show_layout( briny_array_get_first( $tabs_content, false ) ); ?>
						</div>
						<?php
					}
					?>
					<div class="briny_options_buttons trx_buttons">
						<input type="button" class="briny_options_button_submit button button-action" value="<?php  esc_attr_e( 'Save Options', 'briny' ); ?>">
					</div>
				</form>
			</div>
			<?php
		}
	}
}


// Save quick setup options
if ( ! function_exists( 'briny_options_qsetup_save_options' ) ) {
	add_action( 'after_setup_theme', 'briny_options_qsetup_save_options', 4 );
	function briny_options_qsetup_save_options() {

		if ( ! isset( $_REQUEST['page'] ) || 'trx_addons_theme_panel' != $_REQUEST['page'] || '' == briny_get_value_gp( 'qsetup_options_nonce' ) ) {
			return;
		}

		// verify nonce
		if ( ! wp_verify_nonce( briny_get_value_gp( 'qsetup_options_nonce' ), admin_url() ) ) {
			trx_addons_set_admin_message( esc_html__( 'Bad security code! Options are not saved!', 'briny' ), 'error', true );
			return;
		}

		// Check permissions
		if ( ! current_user_can( 'manage_options' ) ) {
			trx_addons_set_admin_message( esc_html__( 'Manage options is denied for the current user! Options are not saved!', 'briny' ), 'error', true );
			return;
		}

		// Prepare colors for Theme Options
		if ( '' != briny_get_value_gp( 'briny_options_field_colors_text_link' ) ) {
			$scheme_storage = get_theme_mod( 'scheme_storage' );
			if ( empty( $scheme_storage ) ) {
				$scheme_storage = briny_get_scheme_storage();
			}
			if ( ! empty( $scheme_storage ) ) {
				$schemes = briny_unserialize( $scheme_storage );
				if ( is_array( $schemes ) ) {
					$color_scheme = get_theme_mod( briny_storage_get_array( 'schemes_sorted', 0 ) );
					if ( empty( $color_scheme ) ) {
						$color_scheme = briny_array_get_first( $schemes );
					}
					if ( ! empty( $schemes[ $color_scheme ] ) ) {
						$schemes_simple = briny_storage_get( 'schemes_simple' );
						// Get posted data and calculate substitutions
						$need_save = false;
						foreach ( $schemes[ $color_scheme ][ 'colors' ] as $k => $v ) {
							$v2 = briny_get_value_gp( "briny_options_field_colors_{$k}" );
							if ( ! empty( $v2 ) && $v != $v2 ) {
								$schemes[ $color_scheme ][ 'colors' ][ $k ] = $v2;
								$need_save = true;
								// Сalculate substitutions
								if ( isset( $schemes_simple[ $k ] ) && is_array( $schemes_simple[ $k ] ) ) {
									foreach ( $schemes_simple[ $k ] as $color => $level ) {
										$new_v2 = $v2;
										// Make color_value darker or lighter
										if ( 1 != $level ) {
											$hsb = briny_hex2hsb( $new_v2 );
											$hsb[ 'b' ] = min( 100, max( 0, $hsb[ 'b' ] * ( $hsb[ 'b' ] < 70 ? 2 - $level : $level ) ) );
											$new_v2 = briny_hsb2hex( $hsb );
										}
										$schemes[ $color_scheme ][ 'colors' ][ $color ] = $new_v2;
									}
								}
							}
						}
						// Put new values to the POST
						if ( $need_save ) {
							$_POST[ 'briny_options_field_scheme_storage' ] = serialize( $schemes );
						}
					}
				}
			}
		}

		// Save options
		briny_options_update( null, 'briny_options_field_' );

		// Return result
		trx_addons_set_admin_message( esc_html__( 'Options are saved', 'briny' ), 'success', true );
		wp_redirect( get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_qsetup' ) );
		exit();
	}
}
