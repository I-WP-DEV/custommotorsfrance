<?php
/**
 * Theme Options, Color Schemes and Fonts utilities
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0
 */

// -----------------------------------------------------------------
// -- Create and manage Theme Options
// -----------------------------------------------------------------

// Theme init priorities:
// 2 - create Theme Options
if ( ! function_exists( 'briny_options_theme_setup2' ) ) {
	add_action( 'after_setup_theme', 'briny_options_theme_setup2', 2 );
	function briny_options_theme_setup2() {
		briny_create_theme_options();
	}
}

// Step 1: Load default settings and previously saved mods
if ( ! function_exists( 'briny_options_theme_setup5' ) ) {
	add_action( 'after_setup_theme', 'briny_options_theme_setup5', 5 );
	function briny_options_theme_setup5() {
		briny_storage_set( 'options_reloaded', false );
		briny_load_theme_options();
	}
}

// Step 2: Load current theme customization mods
if ( is_customize_preview() ) {
	if ( ! function_exists( 'briny_load_custom_options' ) ) {
		add_action( 'wp_loaded', 'briny_load_custom_options' );
		function briny_load_custom_options() {
			if ( ! briny_storage_get( 'options_reloaded' ) ) {
				briny_storage_set( 'options_reloaded', true );
				briny_load_theme_options();
			}
		}
	}
}



// Load current values for each customizable option
if ( ! function_exists( 'briny_load_theme_options' ) ) {
	function briny_load_theme_options() {
		$options = briny_storage_get( 'options' );
		$reset   = (int) get_theme_mod( 'reset_options', 0 );
		foreach ( $options as $k => $v ) {
			if ( isset( $v['std'] ) ) {
				$value = briny_get_theme_option_std( $k, $v['std'] );
				if ( ! $reset ) {
					if ( isset( $_GET[ $k ] ) ) {
						$value = wp_kses_data( wp_unslash( $_GET[ $k ] ) );
					} else {
						$default_value = -987654321;
						$tmp           = get_theme_mod( $k, $default_value );
						if ( $tmp != $default_value ) {
							$value = $tmp;
						}
					}
				}
				briny_storage_set_array2( 'options', $k, 'val', $value );
				if ( $reset ) {
					remove_theme_mod( $k );
				}
			}
		}
		if ( $reset ) {
			// Unset reset flag
			set_theme_mod( 'reset_options', 0 );
			// Regenerate CSS with default colors and fonts
			briny_customizer_save_css();
		} else {
			do_action( 'briny_action_load_options' );
		}
	}
}

// Override options with stored page/post meta
if ( ! function_exists( 'briny_override_theme_options' ) ) {
	add_action( 'wp', 'briny_override_theme_options', 1 );
	function briny_override_theme_options( $query = null ) {
		if ( is_page_template( 'blog.php' ) ) {
			briny_storage_set( 'blog_archive', true );
			briny_storage_set( 'blog_template', get_the_ID() );
		}
		briny_storage_set( 'blog_mode', briny_detect_blog_mode() );
		if ( is_singular() ) {
			briny_storage_set( 'options_meta', get_post_meta( get_the_ID(), 'briny_options', true ) );
		}
		do_action( 'briny_action_override_theme_options' );
	}
}

// Override options with stored page meta on 'Blog posts' pages
if ( ! function_exists( 'briny_blog_override_theme_options' ) ) {
	add_action( 'briny_action_override_theme_options', 'briny_blog_override_theme_options' );
	function briny_blog_override_theme_options() {
		global $wp_query;
		if ( is_home() && ! is_front_page() && ! empty( $wp_query->is_posts_page ) ) {
			$id = get_option( 'page_for_posts' );
			if ( (int) $id > 0 ) {
				briny_storage_set( 'options_meta', get_post_meta( $id, 'briny_options', true ) );
			}
		}
	}
}


// Return 'std' value of the option, processed by special function (if specified)
if ( ! function_exists( 'briny_get_theme_option_std' ) ) {
	function briny_get_theme_option_std( $opt_name, $opt_std ) {
		if ( ! is_array( $opt_std ) && strpos( $opt_std, '$briny_' ) !== false ) {
			$func = substr( $opt_std, 1 );
			if ( function_exists( $func ) ) {
				$opt_std = $func( $opt_name );
			}
		}
		return $opt_std;
	}
}


// Return customizable option value
if ( ! function_exists( 'briny_get_theme_option' ) ) {
	function briny_get_theme_option( $name, $defa = '', $strict_mode = false, $post_id = 0 ) {
		$rez            = $defa;
		$from_post_meta = false;


		if ( $post_id > 0 ) {
			if ( ! briny_storage_isset( 'post_options_meta', $post_id ) ) {
				briny_storage_set_array( 'post_options_meta', $post_id, get_post_meta( $post_id, 'briny_options', true ) );
			}
			if ( briny_storage_isset( 'post_options_meta', $post_id, $name ) ) {
				$tmp = briny_storage_get_array( 'post_options_meta', $post_id, $name );
				if ( ! briny_is_inherit( $tmp ) ) {
					$rez            = $tmp;
					$from_post_meta = true;
				}
			}
		}

		if ( ! $from_post_meta && briny_storage_isset( 'options' ) ) {

			$blog_mode   = briny_storage_get( 'blog_mode' );
			$mobile_mode = wp_is_mobile() ? 'mobile' : '';

			if ( ! briny_storage_isset( 'options', $name ) && ( empty( $blog_mode ) || ! briny_storage_isset( 'options', $name . '_' . $blog_mode ) ) ) {

				$rez = '_not_exists_';
				$tmp = $rez;
				if ( function_exists( 'trx_addons_get_option' ) ) {
					$rez = trx_addons_get_option( $name, $tmp, false );
				}
				if ( $rez === $tmp ) {
					if ( $strict_mode ) {
						// Translators: Add option's name to the output
						echo '<pre>' . esc_html( sprintf( esc_html__( 'Undefined option "%s" called from:', 'briny' ), $name ) );
						if ( function_exists( 'dcs' ) ) {
							dcs();
						}
						echo '</pre>';
						wp_die();
					} else {
						$rez = $defa;
					}
				}

			} else {

				// Single option name: 'expand_content' -> 'expand_content_single'
				$single_name = $name . ( is_single() && substr( $name, -7) != '_single' ? '_single' : '' );

				// Parent mode: 'team_single' -> 'team'
				$blog_mode_parent = apply_filters( 
										'briny_filter_blog_mode_parent',
										'post' == $blog_mode
											? 'blog'
											: str_replace( '_single', '', $blog_mode )
									);

				// Parent option name for posts: 'expand_content_single' -> 'expand_content_blog'
				$blog_name = 'post' == $blog_mode && substr( $name, -7) == '_single' ? str_replace( '_single', '_blog', $name ) : '';

				// Parent option name for CPT: 'expand_content_single_team' -> 'expand_content_team'
				$parent_name = strpos( $name, '_single') !== false ? str_replace( '_single', '', $name ) : '';

				// Get 'xxx_single' instead 'xxx_post'
				if ('post' == $blog_mode) {
					$blog_mode = 'single';
				}

				// Override option from GET or POST for current blog mode
				
				if ( ! empty( $blog_mode ) && isset( $_REQUEST[ $name . '_' . $blog_mode ] ) ) {
					$rez = wp_kses_data( wp_unslash( $_REQUEST[ $name . '_' . $blog_mode ] ) );

					// Override option from GET or POST
					
				} elseif ( isset( $_REQUEST[ $name ] ) ) {
					$rez = wp_kses_data( wp_unslash( $_REQUEST[ $name ] ) );

					// Override option from current page settings (if exists) with mobile mode
					
				} elseif ( ! empty( $mobile_mode ) && briny_storage_isset( 'options_meta', $name . '_' . $mobile_mode ) && ! briny_is_inherit( briny_storage_get_array( 'options_meta', $name . '_' . $mobile_mode ) ) ) {
					$rez = briny_storage_get_array( 'options_meta', $name . '_' . $mobile_mode );

					// Override option from current page settings (if exists)
					
				} elseif ( briny_storage_isset( 'options_meta', $name ) && ! briny_is_inherit( briny_storage_get_array( 'options_meta', $name ) ) ) {
					$rez = briny_storage_get_array( 'options_meta', $name );

					// Override single option with mobile mode
					
				} elseif ( ! empty( $mobile_mode ) && $single_name != $name && briny_storage_isset( 'options', $single_name . '_' . $mobile_mode, 'val' ) && ! briny_is_inherit( briny_storage_get_array( 'options', $single_name . '_' . $mobile_mode, 'val' ) ) ) {
					$rez = briny_storage_get_array( 'options', $single_name . '_' . $mobile_mode, 'val' );

					// Override option with mobile mode
					
				} elseif ( ! empty( $mobile_mode ) && briny_storage_isset( 'options', $name . '_' . $mobile_mode, 'val' ) && ! briny_is_inherit( briny_storage_get_array( 'options', $name . '_' . $mobile_mode, 'val' ) ) ) {
					$rez = briny_storage_get_array( 'options', $name . '_' . $mobile_mode, 'val' );

					// Override option from current blog mode settings: 'front', 'search', 'page', 'post', 'blog', etc. (if exists)
					
				} elseif ( ! empty( $blog_mode ) && $single_name != $name && briny_storage_isset( 'options', $single_name . '_' . $blog_mode, 'val' ) && ! briny_is_inherit( briny_storage_get_array( 'options', $single_name . '_' . $blog_mode, 'val' ) ) ) {
					$rez = briny_storage_get_array( 'options', $single_name . '_' . $blog_mode, 'val' );

					// Override option from current blog mode settings: 'front', 'search', 'page', 'post', 'blog', etc. (if exists)
					
				} elseif ( ! empty( $blog_mode ) && briny_storage_isset( 'options', $name . '_' . $blog_mode, 'val' ) && ! briny_is_inherit( briny_storage_get_array( 'options', $name . '_' . $blog_mode, 'val' ) ) ) {
					$rez = briny_storage_get_array( 'options', $name . '_' . $blog_mode, 'val' );

					// Override option from parent blog mode
					
				} elseif ( ! empty( $blog_mode ) && ! empty( $parent_name ) && $parent_name != $name && briny_storage_isset( 'options', $parent_name . '_' . $blog_mode, 'val' ) && ! briny_is_inherit( briny_storage_get_array( 'options', $parent_name . '_' . $blog_mode, 'val' ) ) ) {
					$rez = briny_storage_get_array( 'options', $parent_name . '_' . $blog_mode, 'val' );

					// Override option for 'post' from 'blog' settings (if exists)
					// Also used for override 'xxx_single' on the 'xxx'
					// (for example, instead 'sidebar_courses_single' return option for 'sidebar_courses')
					
				} elseif ( ! empty( $blog_mode_parent ) && $blog_mode != $blog_mode_parent && $single_name != $name && briny_storage_isset( 'options', $single_name . '_' . $blog_mode_parent, 'val' ) && ! briny_is_inherit( briny_storage_get_array( 'options', $single_name . '_' . $blog_mode_parent, 'val' ) ) ) {
					$rez = briny_storage_get_array( 'options', $single_name . '_' . $blog_mode_parent, 'val' );

				} elseif ( ! empty( $blog_mode_parent ) && $blog_mode != $blog_mode_parent && briny_storage_isset( 'options', $name . '_' . $blog_mode_parent, 'val' ) && ! briny_is_inherit( briny_storage_get_array( 'options', $name . '_' . $blog_mode_parent, 'val' ) ) ) {
					$rez = briny_storage_get_array( 'options', $name . '_' . $blog_mode_parent, 'val' );

				} elseif ( ! empty( $blog_mode_parent ) && $blog_mode != $blog_mode_parent && $parent_name != $name && briny_storage_isset( 'options', $parent_name . '_' . $blog_mode_parent, 'val' ) && ! briny_is_inherit( briny_storage_get_array( 'options', $parent_name . '_' . $blog_mode_parent, 'val' ) ) ) {
					$rez = briny_storage_get_array( 'options', $parent_name . '_' . $blog_mode_parent, 'val' );

					// Get saved option value for single post
					
				} elseif ( briny_storage_isset( 'options', $single_name, 'val' ) && ! briny_is_inherit( briny_storage_get_array( 'options', $single_name, 'val' ) ) ) {
					$rez = briny_storage_get_array( 'options', $single_name, 'val' );

					// Get saved option value
					
				} elseif ( briny_storage_isset( 'options', $name, 'val' ) && $single_name != $name && ! briny_is_inherit( briny_storage_get_array( 'options', $name, 'val' ) ) ) {
					$rez = briny_storage_get_array( 'options', $name, 'val' );

					// Override option for '_single' from '_blog' settings (if exists)
					
				} elseif ( ! empty( $blog_name ) && briny_storage_isset( 'options', $blog_name, 'val' ) && ! briny_is_inherit( briny_storage_get_array( 'options', $blog_name, 'val' ) ) ) {
					$rez = briny_storage_get_array( 'options', $blog_name, 'val' );

					// Override option for '_single' from parent settings (if exists)
					
				} elseif ( ! empty( $parent_name ) && $parent_name != $name && briny_storage_isset( 'options', $parent_name, 'val' ) && ! briny_is_inherit( briny_storage_get_array( 'options', $parent_name, 'val' ) ) ) {
					$rez = briny_storage_get_array( 'options', $parent_name, 'val' );

					// Get saved option value if nobody override it
					
				} elseif ( briny_storage_isset( 'options', $name, 'val' ) ) {
					$rez = briny_storage_get_array( 'options', $name, 'val' );

					// Get ThemeREX Addons option value
				} elseif ( function_exists( 'trx_addons_get_option' ) ) {
					$rez = trx_addons_get_option( $name, $defa, false );

				}
			}
		}
		return $rez;
	}
}


// Check if customizable option exists
if ( ! function_exists( 'briny_check_theme_option' ) ) {
	function briny_check_theme_option( $name ) {
		return briny_storage_isset( 'options', $name );
	}
}


// Return customizable option value, stored in the posts meta
if ( ! function_exists( 'briny_get_theme_option_from_meta' ) ) {
	function briny_get_theme_option_from_meta( $name, $defa = '' ) {
		$rez = $defa;
		if ( briny_storage_isset( 'options_meta' ) ) {
			if ( briny_storage_isset( 'options_meta', $name ) ) {
				$rez = briny_storage_get_array( 'options_meta', $name );
			} else {
				$rez = 'inherit';
			}
		}
		return $rez;
	}
}


// Get dependencies list from the Theme Options
if ( ! function_exists( 'briny_get_theme_dependencies' ) ) {
	function briny_get_theme_dependencies() {
		$options = briny_storage_get( 'options' );
		$depends = array();
		foreach ( $options as $k => $v ) {
			if ( isset( $v['dependency'] ) ) {
				$depends[ $k ] = $v['dependency'];
			}
		}
		return $depends;
	}
}



//------------------------------------------------
// Save options
//------------------------------------------------
if ( ! function_exists( 'briny_options_save' ) ) {
	add_action( 'after_setup_theme', 'briny_options_save', 4 );
	function briny_options_save() {

		if ( ! isset( $_REQUEST['page'] ) || 'theme_options' != $_REQUEST['page'] || '' == briny_get_value_gp( 'briny_nonce' ) ) {
			return;
		}

		// verify nonce
		if ( ! wp_verify_nonce( briny_get_value_gp( 'briny_nonce' ), admin_url() ) ) {
			briny_add_admin_message( esc_html__( 'Bad security code! Options are not saved!', 'briny' ), 'error', true );
			return;
		}

		// Check permissions
		if ( ! current_user_can( 'manage_options' ) ) {
			briny_add_admin_message( esc_html__( 'Manage options is denied for the current user! Options are not saved!', 'briny' ), 'error', true );
			return;
		}

		// Save options
		briny_options_update( null, 'briny_options_field_' );

		// Return result
		briny_add_admin_message( esc_html__( 'Options are saved', 'briny' ) );
		wp_redirect( get_admin_url( null, 'admin.php?page=theme_options' ) );
		exit();
	}
}


// Update theme options from specified source
// (_POST or any other options storage)
if ( ! function_exists( 'briny_options_update' ) ) {
	function briny_options_update( $from = null, $from_prefix = '' ) {
		$options           = briny_storage_get( 'options' );
		$external_storages = array();
		$values            = null === $from ? get_theme_mods() : $from;
		foreach ( $options as $k => $v ) {
			// Skip non-data options - sections, info, etc.
			if ( ! isset( $v['std'] ) ) {
				continue;
			}
			// Get new value
			$value = null;
			if ( null === $from ) {
				$from_name = "{$from_prefix}{$k}";
				if ( isset( $_POST[ $from_name ] ) ) {
					$value = briny_get_value_gp( $from_name );
					// Individual options processing
					if ( 'custom_logo' == $k ) {
						if ( ! empty( $value ) && 0 == (int) $value ) {
							$value = attachment_url_to_postid( briny_clear_thumb_size( $value ) );
							if ( empty( $value ) ) {
								$value = null === $from ? get_theme_mod( $k ) : $values[$k];
							}
						}
					}
					// Save to the result array
					if ( ! empty( $v['type'] ) && 'hidden' != $v['type'] && ( empty( $v['hidden'] ) || ! $v['hidden'] ) && briny_get_theme_option_std( $k, $v['std'] ) != $value ) {
						$values[ $k ] = $value;
					} elseif ( isset( $values[ $k ] ) ) {
						unset( $values[ $k ] );
						$value = null;
					}
				}
			} else {
				$value = isset( $values[ $k ] )
								? $values[ $k ]
								: briny_get_theme_option_std( $k, $v['std'] );
			}
			// External plugin's options
			if ( $value !== null && ! empty( $v['options_storage'] ) ) {
				if ( ! isset( $external_storages[ $v['options_storage'] ] ) ) {
					$external_storages[ $v['options_storage'] ] = array();
				}
				$external_storages[ $v['options_storage'] ][ $k ] = $value;
			}
		}

		// Update options in the external storages
		foreach ( $external_storages as $storage_name => $storage_values ) {
			$storage = get_option( $storage_name, false );
			if ( is_array( $storage ) ) {
				foreach ( $storage_values as $k => $v ) {
					$storage[ $k ] = $v;
				}
				update_option( $storage_name, apply_filters( 'briny_filter_options_save', $storage, $storage_name ) );
			}
		}

		// Update Theme Mods (internal Theme Options)
		$stylesheet_slug = get_option( 'stylesheet' );
		$values          = apply_filters( 'briny_filter_options_save', $values, 'theme_mods' );

		update_option( "theme_mods_{$stylesheet_slug}", $values );

		do_action( 'briny_action_just_save_options', $values );

		// Store new schemes colors
		if ( ! empty( $values['scheme_storage'] ) ) {
			$schemes = briny_unserialize( $values['scheme_storage'] );
			if ( is_array( $schemes ) && count( $schemes ) > 0 ) {
				briny_storage_set( 'schemes', $schemes );
			}
		}

		// Store new fonts parameters
		$fonts = briny_get_theme_fonts();
		foreach ( $fonts as $tag => $v ) {
			foreach ( $v as $css_prop => $css_value ) {
				if ( in_array( $css_prop, array( 'title', 'description' ) ) ) {
					continue;
				}
				if ( isset( $values[ "{$tag}_{$css_prop}" ] ) ) {
					$fonts[ $tag ][ $css_prop ] = $values[ "{$tag}_{$css_prop}" ];
				}
			}
		}
		briny_storage_set( 'theme_fonts', $fonts );

		// Update ThemeOptions save timestamp
		$stylesheet_time = time();
		update_option( "briny_options_timestamp_{$stylesheet_slug}", $stylesheet_time );

		// Sinchronize theme options between child and parent themes
		if ( briny_get_theme_setting( 'duplicate_options' ) == 'both' ) {
			$theme_slug = get_option( 'template' );
			if ( $theme_slug != $stylesheet_slug ) {
				briny_customizer_duplicate_theme_options( $stylesheet_slug, $theme_slug, $stylesheet_time );
			}
		}

		// Apply action - moved to the delayed state (see below) to load all enabled modules and apply changes after
		// Attention! Don't remove comment the line below!
		// Not need here: do_action('briny_action_save_options');
		update_option( 'briny_action', 'briny_action_save_options' );
	}
}


//-------------------------------------------------------
//-- Delayed action from previous session
//-- (after save options)
//-- to save new CSS, etc.
//-------------------------------------------------------
if ( ! function_exists( 'briny_do_delayed_action' ) ) {
	add_action( 'after_setup_theme', 'briny_do_delayed_action' );
	function briny_do_delayed_action() {
		$action = get_option( 'briny_action' );
		if ( '' != $action ) {
			do_action( $action );
			update_option( 'briny_action', '' );
		}
	}
}



// -----------------------------------------------------------------
// -- Theme Settings utilities
// -----------------------------------------------------------------

// Return internal theme setting value
if ( ! function_exists( 'briny_get_theme_setting' ) ) {
	function briny_get_theme_setting( $name ) {
		if ( ! briny_storage_isset( 'settings', $name ) ) {
			// Translators: Add setting's name to the output
			echo '<pre>' . esc_html( sprintf( esc_html__( 'Undefined setting "%s" called from:', 'briny' ), $name ) );
			if ( function_exists( 'dcs' ) ) {
				dcs();
			}
			echo '</pre>';
			wp_die();
		} else {
			return briny_storage_get_array( 'settings', $name );
		}
	}
}

// Set theme setting
if ( ! function_exists( 'briny_set_theme_setting' ) ) {
	function briny_set_theme_setting( $option_name, $value ) {
		if ( briny_storage_isset( 'settings', $option_name ) ) {
			briny_storage_set_array( 'settings', $option_name, $value );
		}
	}
}



// -----------------------------------------------------------------
// -- Color Schemes utilities
// -----------------------------------------------------------------

// Load saved values to the color schemes
if ( ! function_exists( 'briny_load_schemes' ) ) {
	add_action( 'briny_action_load_options', 'briny_load_schemes' );
	function briny_load_schemes() {
		$schemes = briny_storage_get( 'schemes' );
		$storage = briny_unserialize( briny_get_theme_option( 'scheme_storage' ) );
		if ( is_array( $storage ) && count( $storage ) > 0 ) {
			
			// New way - use all color schemes (built-in and created by user)
			briny_storage_set( 'schemes', $storage );
		}
	}
}

// Return specified color from current (or specified) color scheme
if ( ! function_exists( 'briny_get_scheme_color' ) ) {
	function briny_get_scheme_color( $color_name, $scheme = '' ) {
		if ( empty( $scheme ) ) {
			$scheme = briny_get_theme_option( 'color_scheme' );
		}
		if ( empty( $scheme ) || briny_storage_empty( 'schemes', $scheme ) ) {
			$scheme = 'default';
		}
		$colors = briny_storage_get_array( 'schemes', $scheme, 'colors' );
		return $colors[ $color_name ];
	}
}

// Return colors from current color scheme
if ( ! function_exists( 'briny_get_scheme_colors' ) ) {
	function briny_get_scheme_colors( $scheme = '' ) {
		if ( empty( $scheme ) ) {
			$scheme = briny_get_theme_option( 'color_scheme' );
		}
		if ( empty( $scheme ) || briny_storage_empty( 'schemes', $scheme ) ) {
			$scheme = 'default';
		}
		return briny_storage_get_array( 'schemes', $scheme, 'colors' );
	}
}

// Return colors from all schemes
if ( ! function_exists( 'briny_get_scheme_storage' ) ) {
	function briny_get_scheme_storage( $scheme = '' ) {
		return serialize( briny_storage_get( 'schemes' ) );
	}
}

// Return theme fonts parameter's default value
if ( ! function_exists( 'briny_get_scheme_color_option' ) ) {
	function briny_get_scheme_color_option( $option_name ) {
		$parts = explode( '_', $option_name, 2 );
		return briny_get_scheme_color( $parts[1] );
	}
}

// Return schemes list
if ( ! function_exists( 'briny_get_list_schemes' ) ) {
	function briny_get_list_schemes( $prepend_inherit = false ) {
		$list    = array();
		$schemes = briny_storage_get( 'schemes' );
		if ( is_array( $schemes ) && count( $schemes ) > 0 ) {
			foreach ( $schemes as $slug => $scheme ) {
				$list[ $slug ] = $scheme['title'];
			}
		}
		return $prepend_inherit ? briny_array_merge( array( 'inherit' => esc_html__( 'Inherit', 'briny' ) ), $list ) : $list;
	}
}

// Return all schemes, sorted by usage in the parameters 'xxx_scheme' on the current page
if ( ! function_exists( 'briny_get_sorted_schemes' ) ) {
	function briny_get_sorted_schemes() {
		$params  = briny_storage_get( 'schemes_sorted' );
		$schemes = briny_storage_get( 'schemes' );
		$rez     = array();
		if ( is_array( $schemes ) ) {
			foreach ( $params as $p ) {
				if ( ! briny_check_theme_option( $p ) ) {
					continue;
				}
				$s = briny_get_theme_option( $p );
				if ( ! empty( $s ) && ! briny_is_inherit( $s ) && isset( $schemes[ $s ] ) ) {
					$rez[ $s ] = $schemes[ $s ];
					unset( $schemes[ $s ] );
				}
			}
			if ( count( $schemes ) > 0 ) {
				$rez = array_merge( $rez, $schemes );
			}
		}
		return $rez;
	}
}


// -----------------------------------------------------------------
// -- Theme Fonts utilities
// -----------------------------------------------------------------

// Load saved values into fonts list
if ( ! function_exists( 'briny_load_fonts' ) ) {
	add_action( 'briny_action_load_options', 'briny_load_fonts' );
	function briny_load_fonts() {
		// Fonts to load when theme starts
		$load_fonts = array();
		for ( $i = 1; $i <= briny_get_theme_setting( 'max_load_fonts' ); $i++ ) {
			$name = briny_get_theme_option( "load_fonts-{$i}-name" );
			if ( '' != $name ) {
				$load_fonts[] = array(
					'name'   => $name,
					'family' => briny_get_theme_option( "load_fonts-{$i}-family" ),
					'styles' => briny_get_theme_option( "load_fonts-{$i}-styles" ),
				);
			}
		}
		briny_storage_set( 'load_fonts', $load_fonts );
		briny_storage_set( 'load_fonts_subset', briny_get_theme_option( 'load_fonts_subset' ) );

		// Font parameters of the main theme's elements
		$fonts = briny_get_theme_fonts();
		foreach ( $fonts as $tag => $v ) {
			foreach ( $v as $css_prop => $css_value ) {
				if ( in_array( $css_prop, array( 'title', 'description' ) ) ) {
					continue;
				}
				$fonts[ $tag ][ $css_prop ] = briny_get_theme_option( "{$tag}_{$css_prop}" );
			}
		}
		briny_storage_set( 'theme_fonts', $fonts );
	}
}

// Return slug of the loaded font
if ( ! function_exists( 'briny_get_load_fonts_slug' ) ) {
	function briny_get_load_fonts_slug( $name ) {
		return str_replace( ' ', '-', $name );
	}
}

// Return load fonts parameter's default value
if ( ! function_exists( 'briny_get_load_fonts_option' ) ) {
	function briny_get_load_fonts_option( $option_name ) {
		$rez        = '';
		$parts      = explode( '-', $option_name );
		$load_fonts = briny_storage_get( 'load_fonts' );
		if ( 'load_fonts' == $parts[0] && count( $load_fonts ) > $parts[1] - 1 && isset( $load_fonts[ $parts[1] - 1 ][ $parts[2] ] ) ) {
			$rez = $load_fonts[ $parts[1] - 1 ][ $parts[2] ];
		}
		return $rez;
	}
}

// Return load fonts subset's default value
if ( ! function_exists( 'briny_get_load_fonts_subset' ) ) {
	function briny_get_load_fonts_subset( $option_name ) {
		return briny_storage_get( 'load_fonts_subset' );
	}
}

// Return load fonts list
if ( ! function_exists( 'briny_get_list_load_fonts' ) ) {
	function briny_get_list_load_fonts( $prepend_inherit = false ) {
		$list       = array();
		$load_fonts = briny_storage_get( 'load_fonts' );
		if ( is_array( $load_fonts ) && count( $load_fonts ) > 0 ) {
			foreach ( $load_fonts as $font ) {
				$list[ '"' . trim( $font['name'] ) . '"' . ( ! empty( $font['family'] ) ? ',' . trim( $font['family'] ) : '' ) ] = $font['name'];
			}
		}
		return $prepend_inherit ? briny_array_merge( array( 'inherit' => esc_html__( 'Inherit', 'briny' ) ), $list ) : $list;
	}
}

// Return font settings of the theme specific elements
if ( ! function_exists( 'briny_get_theme_fonts' ) ) {
	function briny_get_theme_fonts() {
		return briny_storage_get( 'theme_fonts' );
	}
}

// Return theme fonts parameter's default value
if ( ! function_exists( 'briny_get_theme_fonts_option' ) ) {
	function briny_get_theme_fonts_option( $option_name ) {
		$rez         = '';
		$parts       = explode( '_', $option_name );
		$theme_fonts = briny_storage_get( 'theme_fonts' );
		if ( ! empty( $theme_fonts[ $parts[0] ][ $parts[1] ] ) ) {
			$rez = $theme_fonts[ $parts[0] ][ $parts[1] ];
		}
		return $rez;
	}
}

// Update loaded fonts list in the each tag's parameter (p, h1..h6,...) after the 'load_fonts' options are loaded
if ( ! function_exists( 'briny_update_list_load_fonts' ) ) {
	add_action( 'briny_action_load_options', 'briny_update_list_load_fonts', 11 );
	function briny_update_list_load_fonts() {
		$theme_fonts = briny_get_theme_fonts();
		$load_fonts  = briny_get_list_load_fonts( true );
		foreach ( $theme_fonts as $tag => $v ) {
			briny_storage_set_array2( 'options', $tag . '_font-family', 'options', $load_fonts );
		}
	}
}



// -----------------------------------------------------------------
// -- Other options utilities
// -----------------------------------------------------------------

// Return all vars from Theme Options with option 'customizer'
if ( ! function_exists( 'briny_get_theme_vars' ) ) {
	function briny_get_theme_vars() {
		$options = briny_storage_get( 'options' );
		$vars    = array();
		foreach ( $options as $k => $v ) {
			if ( ! empty( $v['customizer'] ) ) {
				$vars[ $v['customizer'] ] = briny_get_theme_option( $k );
			}
		}
		return $vars;
	}
}

// Return current theme-specific border radius for form's fields and buttons
if ( ! function_exists( 'briny_get_border_radius' ) ) {
	function briny_get_border_radius() {
		$rad = str_replace( ' ', '', briny_get_theme_option( 'border_radius' ) );
		if ( empty( $rad ) ) {
			$rad = 0;
		}
		return briny_prepare_css_value( $rad );
	}
}




// -----------------------------------------------------------------
// -- Theme Options page
// -----------------------------------------------------------------

if ( ! function_exists( 'briny_options_init_page_builder' ) ) {
	add_action( 'after_setup_theme', 'briny_options_init_page_builder' );
	function briny_options_init_page_builder() {
		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', 'briny_options_add_scripts' );
		}
	}
}

// Load required styles and scripts for admin mode
if ( ! function_exists( 'briny_options_add_scripts' ) ) {
	
	function briny_options_add_scripts() {
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : false;
		if ( ! empty( $screen->id ) && false !== strpos($screen->id, '_page_theme_options') ) {
			wp_enqueue_style( 'fontello-icons', briny_get_file_url( 'css/font-icons/css/fontello.css' ), array(), null );
			wp_enqueue_style( 'wp-color-picker', false, array(), null );
			wp_enqueue_script( 'wp-color-picker', false, array( 'jquery' ), null, true );
			wp_enqueue_script( 'jquery-ui-tabs', false, array( 'jquery', 'jquery-ui-core' ), null, true );
			wp_enqueue_script( 'jquery-ui-accordion', false, array( 'jquery', 'jquery-ui-core' ), null, true );
			wp_enqueue_script( 'briny-options', briny_get_file_url( 'theme-options/theme-options.js' ), array( 'jquery' ), null, true );
			wp_enqueue_script( 'colorpicker-colors', briny_get_file_url( 'js/colorpicker/colors.js' ), array( 'jquery' ), null, true );
			wp_enqueue_script( 'jquery-colorpicker', briny_get_file_url( 'js/colorpicker/jqColorPicker.js' ), array( 'jquery' ), null, true );
			wp_localize_script( 'briny-options', 'briny_dependencies', briny_get_theme_dependencies() );
			wp_localize_script( 'briny-options', 'briny_color_schemes', briny_storage_get( 'schemes' ) );
			wp_localize_script( 'briny-options', 'briny_simple_schemes', briny_storage_get( 'schemes_simple' ) );
			wp_localize_script( 'briny-options', 'briny_sorted_schemes', briny_storage_get( 'schemes_sorted' ) );
			wp_localize_script( 'briny-options', 'briny_theme_fonts', briny_storage_get( 'theme_fonts' ) );
			wp_localize_script( 'briny-options', 'briny_theme_vars', briny_get_theme_vars() );
			wp_localize_script(
				'briny-options', 'briny_options_vars', apply_filters(
					'briny_filter_options_vars', array(
						'max_load_fonts' => briny_get_theme_setting( 'max_load_fonts' ),
					)
				)
			);
		}
	}
}

// Add Theme Options item in the Appearance menu
if ( ! function_exists( 'briny_options_add_theme_panel_page' ) ) {
	add_action( 'trx_addons_filter_add_theme_panel_pages', 'briny_options_add_theme_panel_page' );
	function briny_options_add_theme_panel_page($list) {
		if ( ! BRINY_THEME_FREE ) {
			$list[] = array(
				esc_html__( 'Theme Options', 'briny' ),
				esc_html__( 'Theme Options', 'briny' ),
				'manage_options',
				'theme_options',
				'briny_options_page_builder',
				'dashicons-admin-generic'
			);
		}
		return $list;
	}
}

// Build options page
if ( ! function_exists( 'briny_options_page_builder' ) ) {
	function briny_options_page_builder() {
		?>
		<div class="briny_options">
			<h2 class="briny_options_title"><?php esc_html_e( 'Theme Options', 'briny' ); ?></h2>
			<?php briny_show_admin_messages(); ?>
			<div class="briny_options_info notice notice-info notice-large">
				<p><b>
					<?php esc_html_e( 'Attention!', 'briny' ); ?>
				</b></p>
				<p>
					<?php echo esc_html__( 'Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages.', 'briny' )
						. '<br>'
						. esc_html__( 'If you changed such parameter and nothing happened on the page, this option may be overridden in the corresponding section or in the Page Options of this page.', 'briny' );
					?>
				</p>
				<p><span class="briny_options_asterisk"></span>
					<i>
						<?php esc_html_e( 'These options are marked with an asterisk (*) in the title.', 'briny' ); ?>
					</i>
				</p>
			</div>
			<form id="briny_options_form" action="#" method="post" enctype="multipart/form-data">
				<input type="hidden" name="briny_nonce" value="<?php echo esc_attr( wp_create_nonce( admin_url() ) ); ?>" />
				<?php briny_options_show_fields(); ?>
				<div class="briny_options_buttons">
					<input type="button" class="briny_options_button_submit" value="<?php  esc_attr_e( 'Save Options', 'briny' ); ?>">
				</div>
			</form>
		</div>
		<?php
	}
}

// Display all option's fields
if ( ! function_exists( 'briny_options_show_fields' ) ) {
	function briny_options_show_fields( $options = false ) {
		if ( empty( $options ) ) {
			$options = briny_storage_get( 'options' );
		}
		$tabs_titles  = array();
		$tabs_content = array();
		$last_panel   = '';
		$last_section = '';
		$last_group   = '';
		foreach ( $options as $k => $v ) {
			if ( 'panel' == $v['type'] || ( 'section' == $v['type'] && empty( $last_panel ) ) ) {
				// New tab
				if ( ! isset( $tabs_titles[ $k ] ) ) {
					$tabs_titles[ $k ]  = $v['title'];
					$tabs_content[ $k ] = '';
				}
				if ( ! empty( $last_group ) ) {
					$tabs_content[ $last_section ] .= '</div></div>';
					$last_group                     = '';
				}
				$last_section = $k;
				if ( 'panel' == $v['type'] ) {
					$last_panel = $k;
				}
			} elseif ( 'group' == $v['type'] || ( 'section' == $v['type'] && ! empty( $last_panel ) ) ) {
				// New group
				if ( empty( $last_group ) ) {
					$tabs_content[ $last_section ] = ( ! isset( $tabs_content[ $last_section ] ) ? '' : $tabs_content[ $last_section ] )
													. '<div class="briny_accordion briny_options_groups">';
				} else {
					$tabs_content[ $last_section ] .= '</div>';
				}
				$tabs_content[ $last_section ] .= '<h4 class="briny_accordion_title briny_options_group_title">' . esc_html( $v['title'] ) . '</h4>'
												. '<div class="briny_accordion_content briny_options_group_content">';
				$last_group                     = $k;
			} elseif ( in_array( $v['type'], array( 'group_end', 'section_end', 'panel_end' ) ) ) {
				// End panel, section or group
				if ( ! empty( $last_group ) && ( 'section_end' != $v['type'] || empty( $last_panel ) ) ) {
					$tabs_content[ $last_section ] .= '</div></div>';
					$last_group                     = '';
				}
				if ( 'panel_end' == $v['type'] ) {
					$last_panel = '';
				}
			} else {
				// Field's layout
				$tabs_content[ $last_section ] = ( ! isset( $tabs_content[ $last_section ] ) ? '' : $tabs_content[ $last_section ] )
												. briny_options_show_field( $k, $v );
			}
		}
		if ( ! empty( $last_group ) ) {
			$tabs_content[ $last_section ] .= '</div></div>';
		}

		if ( count( $tabs_content ) > 0 ) {
			// Remove empty sections
			foreach ( $tabs_content as $k => $v ) {
				if ( empty( $v ) ) {
					unset( $tabs_titles[ $k ] );
					unset( $tabs_content[ $k ] );
				}
			}
			?>
			<div id="briny_options_tabs" class="briny_tabs <?php echo count( $tabs_titles ) > 1 ? 'with_tabs' : 'no_tabs'; ?>">
				<?php
				if ( count( $tabs_titles ) > 1 ) {
					?>
					<ul>
						<?php
						$cnt = 0;
						foreach ( $tabs_titles as $k => $v ) {
							$cnt++;
							echo '<li><a href="#briny_options_section_' . esc_attr( $cnt ) . '">' . esc_html( $v ) . '</a></li>';
						}
						?>
					</ul>
					<?php
				}
				$cnt = 0;
				foreach ( $tabs_content as $k => $v ) {
					$cnt++;
					?>
					<div id="briny_options_section_<?php echo esc_attr( $cnt ); ?>" class="briny_tabs_section briny_options_section">
						<?php briny_show_layout( $v ); ?>
					</div>
					<?php
				}
				?>
			</div>
			<?php
		}
	}
}


// Display single option's field
if ( ! function_exists( 'briny_options_show_field' ) ) {
	function briny_options_show_field( $name, $field, $post_type = '' ) {

		$inherit_allow = ! empty( $post_type );
		$inherit_state = ! empty( $post_type ) && isset( $field['val'] ) && briny_is_inherit( $field['val'] );

		$field_data_present = 'info' != $field['type'] || ! empty( $field['override']['desc'] ) || ! empty( $field['desc'] );

		if ( ( 'hidden' == $field['type'] && $inherit_allow )         // Hidden field in the post meta (not in the root Theme Options)
			|| ( ! empty( $field['hidden'] ) && ! $inherit_allow )    // Field only for post meta in the root Theme Options
		) {
			return '';
		}

		if ( 'hidden' == $field['type'] ) {
			$output = isset( $field['val'] )
							? '<input type="hidden" name="briny_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( $field['val'] ) . '"'
								. ' />'
							: '';
		} else {
			$output = ( ! empty( $field['class'] ) && strpos( $field['class'], 'briny_new_row' ) !== false
						? '<div class="briny_new_row_before"></div>'
						: '' )
						. '<div class="briny_options_item briny_options_item_' . esc_attr( $field['type'] )
									. ( $inherit_allow ? ' briny_options_inherit_' . ( $inherit_state ? 'on' : 'off' ) : '' )
									. ( ! empty( $field['class'] ) ? ' ' . esc_attr( $field['class'] ) : '' )
									. '">'
							. '<h4 class="briny_options_item_title">'
								. esc_html( $field['title'] )
								. ( ! empty( $field['override'] )
										? ' <span class="briny_options_asterisk"></span>'
										: '' )
								. ( $inherit_allow
										? '<span class="briny_options_inherit_lock" id="briny_options_inherit_' . esc_attr( $name ) . '"></span>'
										: '' )
							. '</h4>'
							. ( $field_data_present
								? '<div class="briny_options_item_data">'
									. '<div class="briny_options_item_field" data-param="' . esc_attr( $name ) . '"'
										. ( ! empty( $field['linked'] ) ? ' data-linked="' . esc_attr( $field['linked'] ) . '"' : '' )
										. '>'
								: '' );
			if ( 'checkbox' == $field['type'] ) {
				// Type 'checkbox'
				$output .= '<label class="briny_options_item_label">'
							// Hack to always send checkbox value even it not checked
							. '<input type="hidden" name="briny_options_field_' . esc_attr( $name ) . '" value="' . esc_attr( briny_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '" />'
							. '<input type="checkbox" name="briny_options_field_' . esc_attr( $name ) . '_chk" value="1"'
									. ( 1 == $field['val'] ? ' checked="checked"' : '' )
									. ' />'
							. esc_html( $field['title'] )
						. '</label>';
			} elseif ( in_array( $field['type'], array( 'switch', 'radio' ) ) ) {
				// Type 'switch' (2 choises) or 'radio' (3+ choises)
				$field['options'] = apply_filters( 'briny_filter_options_get_list_choises', $field['options'], $name );
				$first            = true;
				foreach ( $field['options'] as $k => $v ) {
					$output .= '<label class="briny_options_item_label">'
								. '<input type="radio" name="briny_options_field_' . esc_attr( $name ) . '"'
										. ' value="' . esc_attr( $k ) . '"'
										. ( ( '#' . $field['val'] ) == ( '#' . $k ) || ( $first && ! isset( $field['options'][ $field['val'] ] ) ) ? ' checked="checked"' : '' )
										. ' />'
								. esc_html( $v )
							. '</label>';
					$first   = false;
				}
			} elseif ( in_array( $field['type'], array( 'text', 'time', 'date' ) ) ) {
				// Type 'text' or 'time' or 'date'
				$output .= '<input type="text" name="briny_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( briny_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ' />';
			} elseif ( 'textarea' == $field['type'] ) {
				// Type 'textarea'
				$output .= '<textarea name="briny_options_field_' . esc_attr( $name ) . '">'
								. esc_html( briny_is_inherit( $field['val'] ) ? '' : $field['val'] )
							. '</textarea>';
			} elseif ( 'text_editor' == $field['type'] ) {
				// Type 'text_editor'
				$output .= '<input type="hidden" id="briny_options_field_' . esc_attr( $name ) . '"'
								. ' name="briny_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_textarea( briny_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ' />'
							. briny_show_custom_field(
								'briny_options_field_' . esc_attr( $name ) . '_tinymce',
								$field,
								briny_is_inherit( $field['val'] ) ? '' : $field['val']
							);
			} elseif ( 'select' == $field['type'] ) {
				// Type 'select'
				$field['options'] = apply_filters( 'briny_filter_options_get_list_choises', $field['options'], $name );
				$output          .= '<select size="1" name="briny_options_field_' . esc_attr( $name ) . '">';
				foreach ( $field['options'] as $k => $v ) {
					$output .= '<option value="' . esc_attr( $k ) . '"' . ( ( '#' . $field['val'] ) == ( '#' . $k ) ? ' selected="selected"' : '' ) . '>' . esc_html( $v ) . '</option>';
				}
				$output .= '</select>';
			} elseif ( in_array( $field['type'], array( 'image', 'media', 'video', 'audio' ) ) ) {
				// Type 'image', 'media', 'video' or 'audio'
				if ( (int) $field['val'] > 0 ) {
					$image        = wp_get_attachment_image_src( $field['val'], 'full' );
					$field['val'] = $image[0];
				}
				$output .= ( ! empty( $field['multiple'] )
							? '<input type="hidden" id="briny_options_field_' . esc_attr( $name ) . '"'
								. ' name="briny_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( briny_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ' />'
							: '<input type="text" id="briny_options_field_' . esc_attr( $name ) . '"'
								. ' name="briny_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( briny_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ' />' )
						. briny_show_custom_field(
							'briny_options_field_' . esc_attr( $name ) . '_button',
							array(
								'type'            => 'mediamanager',
								'multiple'        => ! empty( $field['multiple'] ),
								'data_type'       => $field['type'],
								'linked_field_id' => 'briny_options_field_' . esc_attr( $name ),
							),
							briny_is_inherit( $field['val'] ) ? '' : $field['val']
						);
			} elseif ( 'color' == $field['type'] ) {
				// Type 'color'
				$output .= '<input type="text" id="briny_options_field_' . esc_attr( $name ) . '"'
								. ' class="briny_color_selector"'
								. ' name="briny_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( $field['val'] ) . '"'
								. ' />';
			} elseif ( 'icon' == $field['type'] ) {
				// Type 'icon'
				$output .= '<input type="text" id="briny_options_field_' . esc_attr( $name ) . '"'
								. ' name="briny_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( briny_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ' />'
							. briny_show_custom_field(
								'briny_options_field_' . esc_attr( $name ) . '_button',
								array(
									'type'   => 'icons',
									'button' => true,
									'icons'  => true,
								),
								briny_is_inherit( $field['val'] ) ? '' : $field['val']
							);
			} elseif ( 'checklist' == $field['type'] ) {
				// Type 'checklist'
				$output .= '<input type="hidden" id="briny_options_field_' . esc_attr( $name ) . '"'
								. ' name="briny_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( briny_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ' />'
							. briny_show_custom_field(
								'briny_options_field_' . esc_attr( $name ) . '_list',
								$field,
								briny_is_inherit( $field['val'] ) ? '' : $field['val']
							);
			} elseif ( 'scheme_editor' == $field['type'] ) {
				// Type 'scheme_editor'
				$output .= '<input type="hidden" id="briny_options_field_' . esc_attr( $name ) . '"'
								. ' name="briny_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( briny_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ' />'
							. briny_show_custom_field(
								'briny_options_field_' . esc_attr( $name ) . '_scheme',
								$field,
								briny_unserialize( $field['val'] )
							);
			} elseif ( in_array( $field['type'], array( 'slider', 'range' ) ) ) {
				// Type 'slider' || 'range'
				$field['show_value'] = ! isset( $field['show_value'] ) || $field['show_value'];
				$output             .= '<input type="' . ( ! $field['show_value'] ? 'hidden' : 'text' ) . '" id="briny_options_field_' . esc_attr( $name ) . '"'
								. ' name="briny_options_field_' . esc_attr( $name ) . '"'
								. ' value="' . esc_attr( briny_is_inherit( $field['val'] ) ? '' : $field['val'] ) . '"'
								. ( $field['show_value'] ? ' class="briny_range_slider_value"' : '' )
								. ' />'
							. briny_show_custom_field(
								'briny_options_field_' . esc_attr( $name ) . '_slider',
								$field,
								briny_is_inherit( $field['val'] ) ? '' : $field['val']
							);
			}

			$output .= ( $inherit_allow
							? '<div class="briny_options_inherit_cover' . ( ! $inherit_state ? ' briny_hidden' : '' ) . '">'
								. '<span class="briny_options_inherit_label">' . esc_html__( 'Inherit', 'briny' ) . '</span>'
								. '<input type="hidden" name="briny_options_inherit_' . esc_attr( $name ) . '"'
										. ' value="' . esc_attr( $inherit_state ? 'inherit' : '' ) . '"'
										. ' />'
								. '</div>'
							: '' )
						. ( $field_data_present ? '</div>' : '' )
						. ( ! empty( $field['override']['desc'] ) || ! empty( $field['desc'] )
							? '<div class="briny_options_item_description">'
								. ( ! empty( $field['override']['desc'] )   // param 'desc' already processed with wp_kses()!
										? $field['override']['desc']
										: $field['desc'] )
								. '</div>'
							: '' )
					. ( $field_data_present ? '</div>' : '' )
				. '</div>';
		}
		return $output;
	}
}


// Show theme specific fields
function briny_show_custom_field( $id, $field, $value ) {
	$output = '';

	switch ( $field['type'] ) {

		case 'mediamanager':
			wp_enqueue_media();
			$title   = empty( $field['data_type'] ) || 'image' == $field['data_type']
							? esc_html__( 'Choose Image', 'briny' )
							: esc_html__( 'Choose Media', 'briny' );
			$output .= '<input type="button"'
							. ' id="' . esc_attr( $id ) . '"'
							. ' class="button mediamanager briny_media_selector"'
							. '	data-param="' . esc_attr( $id ) . '"'
							. '	data-choose="' . esc_attr( ! empty( $field['multiple'] ) ? esc_html__( 'Choose Images', 'briny' ) : $title ) . '"'
							. ' data-update="' . esc_attr( ! empty( $field['multiple'] ) ? esc_html__( 'Add to Gallery', 'briny' ) : $title ) . '"'
							. '	data-multiple="' . esc_attr( ! empty( $field['multiple'] ) ? '1' : '0' ) . '"'
							. '	data-type="' . esc_attr( ! empty( $field['data_type'] ) ? $field['data_type'] : 'image' ) . '"'
							. '	data-linked-field="' . esc_attr( $field['linked_field_id'] ) . '"'
							. ' value="'
								. ( ! empty( $field['multiple'] )
										? ( empty( $field['data_type'] ) || 'image' == $field['data_type']
											? esc_attr__( 'Add Images', 'briny' )
											: esc_attr__( 'Add Files', 'briny' )
											)
										: esc_attr( $title )
									)
								. '"'
							. '>';
			$output .= '<span class="briny_options_field_preview">';
			$images  = explode( '|', $value );
			if ( is_array( $images ) ) {
				foreach ( $images as $img ) {
					$output .= $img && ! briny_is_inherit( $img )
							? '<span>'
									. ( in_array( briny_get_file_ext( $img ), array( 'gif', 'jpg', 'jpeg', 'png' ) )
											? '<img src="' . esc_url( $img ) . '" alt="' . esc_attr__( 'Selected image', 'briny' ) . '">'
											: '<a href="' . esc_url( $img ) . '">' . esc_html( basename( $img ) ) . '</a>'
										)
								. '</span>'
							: '';
				}
			}
			$output .= '</span>';
			break;

		case 'icons':
			$icons_type = ! empty( $field['style'] )
							? $field['style']
							: briny_get_theme_setting( 'icons_type' );
			if ( empty( $field['return'] ) ) {
				$field['return'] = 'full';
			}
			$briny_icons = briny_get_list_icons( $icons_type );
			if ( is_array( $briny_icons ) ) {
				if ( ! empty( $field['button'] ) ) {
					$output .= '<span id="' . esc_attr( $id ) . '"'
									. ' class="briny_list_icons_selector'
											. ( 'icons' == $icons_type && ! empty( $value ) ? ' ' . esc_attr( $value ) : '' )
											. '"'
									. ' title="' . esc_attr__( 'Select icon', 'briny' ) . '"'
									. ' data-style="' . esc_attr( $icons_type ) . '"'
									. ( in_array( $icons_type, array( 'images', 'svg' ) ) && ! empty( $value )
										? ' style="background-image: url(' . esc_url( 'slug' == $field['return'] ? $briny_icons[ $value ] : $value ) . ');"'
										: ''
										)
								. '></span>';
				}
				if ( ! empty( $field['icons'] ) ) {
					$output .= '<div class="briny_list_icons">'
								. '<input type="text" class="briny_list_icons_search" placeholder="' . esc_attr__( 'Search icon ...', 'briny' ) . '">';
					foreach ( $briny_icons as $slug => $icon ) {
						$output .= '<span class="' . esc_attr( 'icons' == $icons_type ? $icon : $slug )
								. ( ( 'full' == $field['return'] ? $icon : $slug ) == $value ? ' briny_list_active' : '' )
								. '"'
								. ' title="' . esc_attr( $slug ) . '"'
								. ' data-icon="' . esc_attr( 'full' == $field['return'] ? $icon : $slug ) . '"'
								. ( in_array( $icons_type, array( 'images', 'svg' ) ) ? ' style="background-image: url(' . esc_url( $icon ) . ');"' : '' )
								. '></span>';
					}
					$output .= '</div>';
				}
			}
			break;

		case 'checklist':
			if ( ! empty( $field['sortable'] ) ) {
				wp_enqueue_script( 'jquery-ui-sortable', false, array( 'jquery', 'jquery-ui-core' ), null, true );
			}
			$output .= '<div class="briny_checklist briny_checklist_' . esc_attr( $field['dir'] )
						. ( ! empty( $field['sortable'] ) ? ' briny_sortable' : '' )
						. '">';
			if ( ! is_array( $value ) ) {
				if ( ! empty( $value ) && ! briny_is_inherit( $value ) ) {
					parse_str( str_replace( '|', '&', $value ), $value );
				} else {
					$value = array();
				}
			}
			// Sort options by values order
			if ( ! empty( $field['sortable'] ) && is_array( $value ) ) {
				$field['options'] = briny_array_merge( $value, $field['options'] );
			}
			foreach ( $field['options'] as $k => $v ) {
				$output .= '<label class="briny_checklist_item_label'
								. ( ! empty( $field['sortable'] ) ? ' briny_sortable_item' : '' )
								. '">'
							. '<input type="checkbox" value="1" data-name="' . $k . '"'
								. ( isset( $value[ $k ] ) && 1 == (int) $value[ $k ] ? ' checked="checked"' : '' )
								. ' />'
							. ( substr( $v, 0, 4 ) == 'http' ? '<img src="' . esc_url( $v ) . '">' : esc_html( $v ) )
						. '</label>';
			}
			$output .= '</div>';
			break;

		case 'slider':
		case 'range':
			wp_enqueue_script( 'jquery-ui-slider', false, array( 'jquery', 'jquery-ui-core' ), null, true );
			$is_range   = 'range' == $field['type'];
			$field_min  = ! empty( $field['min'] ) ? $field['min'] : 0;
			$field_max  = ! empty( $field['max'] ) ? $field['max'] : 100;
			$field_step = ! empty( $field['step'] ) ? $field['step'] : 1;
			$field_val  = ! empty( $value )
							? ( $value . ( $is_range && strpos( $value, ',' ) === false ? ',' . $field_max : '' ) )
							: ( $is_range ? $field_min . ',' . $field_max : $field_min );
			$output    .= '<div id="' . esc_attr( $id ) . '"'
							. ' class="briny_range_slider"'
							. ' data-range="' . esc_attr( $is_range ? 'true' : 'min' ) . '"'
							. ' data-min="' . esc_attr( $field_min ) . '"'
							. ' data-max="' . esc_attr( $field_max ) . '"'
							. ' data-step="' . esc_attr( $field_step ) . '"'
							. '>'
							. '<span class="briny_range_slider_label briny_range_slider_label_min">'
								. esc_html( $field_min )
							. '</span>'
							. '<span class="briny_range_slider_label briny_range_slider_label_max">'
								. esc_html( $field_max )
							. '</span>';
			$values     = explode( ',', $field_val );
			for ( $i = 0; $i < count( $values ); $i++ ) {
				$output .= '<span class="briny_range_slider_label briny_range_slider_label_cur">'
								. esc_html( $values[ $i ] )
							. '</span>';
			}
			$output .= '</div>';
			break;

		case 'text_editor':
			if ( function_exists( 'wp_enqueue_editor' ) ) {
				wp_enqueue_editor();
			}
			ob_start();
			wp_editor(
				$value, $id, array(
					'default_editor' => 'tmce',
					'wpautop'        => isset( $field['wpautop'] ) ? $field['wpautop'] : false,
					'teeny'          => isset( $field['teeny'] ) ? $field['teeny'] : false,
					'textarea_rows'  => isset( $field['rows'] ) && $field['rows'] > 1 ? $field['rows'] : 10,
					'editor_height'  => 16 * ( isset( $field['rows'] ) && $field['rows'] > 1 ? (int) $field['rows'] : 10 ),
					'tinymce'        => array(
						'resize'             => false,
						'wp_autoresize_on'   => false,
						'add_unload_trigger' => false,
					),
				)
			);
			$editor_html = ob_get_contents();
			ob_end_clean();
			$output .= '<div class="briny_text_editor">' . $editor_html . '</div>';
			break;

		case 'scheme_editor':
			if ( ! is_array( $value ) ) {
				break;
			}
			if ( empty( $field['colorpicker'] ) ) {
				$field['colorpicker'] = 'internal';
			}
			$output .= '<div class="briny_scheme_editor">';
			// Select scheme
			$output .= '<div class="briny_scheme_editor_scheme">'
							. '<select class="briny_scheme_editor_selector">';
			foreach ( $value as $scheme => $v ) {
				$output .= '<option value="' . esc_attr( $scheme ) . '">' . esc_html( $v['title'] ) . '</option>';
			}
			$output .= '</select>';
			// Scheme controls
			$output .= '<span class="briny_scheme_editor_controls">'
							. '<span class="briny_scheme_editor_control briny_scheme_editor_control_reset" title="' . esc_attr__( 'Reload scheme', 'briny' ) . '"></span>'
							. '<span class="briny_scheme_editor_control briny_scheme_editor_control_copy" title="' . esc_attr__( 'Duplicate scheme', 'briny' ) . '"></span>'
							. '<span class="briny_scheme_editor_control briny_scheme_editor_control_delete" title="' . esc_attr__( 'Delete scheme', 'briny' ) . '"></span>'
						. '</span>'
					. '</div>';
			// Select type
			$output .= '<div class="briny_scheme_editor_type">'
							. '<div class="briny_scheme_editor_row">'
								. '<span class="briny_scheme_editor_row_cell">'
									. esc_html__( 'Editor type', 'briny' )
								. '</span>'
								. '<span class="briny_scheme_editor_row_cell briny_scheme_editor_row_cell_span">'
									. '<label>'
										. '<input name="briny_scheme_editor_type" type="radio" value="simple" checked="checked"> '
										. esc_html__( 'Simple', 'briny' )
									. '</label>'
									. '<label>'
										. '<input name="briny_scheme_editor_type" type="radio" value="advanced"> '
										. esc_html__( 'Advanced', 'briny' )
									. '</label>'
								. '</span>'
							. '</div>'
						. '</div>';
			// Colors
			$groups  = briny_storage_get( 'scheme_color_groups' );
			$colors  = briny_storage_get( 'scheme_color_names' );
			$output .= '<div class="briny_scheme_editor_colors">';
			foreach ( $value as $scheme => $v ) {
				$output .= '<div class="briny_scheme_editor_header">'
								. '<span class="briny_scheme_editor_header_cell"></span>';
				foreach ( $groups as $group_name => $group_data ) {
					$output .= '<span class="briny_scheme_editor_header_cell" title="' . esc_attr( $group_data['description'] ) . '">'
								. esc_html( $group_data['title'] )
								. '</span>';
				}
				$output .= '</div>';
				foreach ( $colors as $color_name => $color_data ) {
					$output .= '<div class="briny_scheme_editor_row">'
								. '<span class="briny_scheme_editor_row_cell" title="' . esc_attr( $color_data['description'] ) . '">'
								. esc_html( $color_data['title'] )
								. '</span>';
					foreach ( $groups as $group_name => $group_data ) {
						$slug    = 'main' == $group_name
									? $color_name
									: str_replace( 'text_', '', "{$group_name}_{$color_name}" );
						$output .= '<span class="briny_scheme_editor_row_cell">'
									. ( isset( $v['colors'][ $slug ] )
										? "<input type=\"text\" name=\"{$slug}\" class=\"" . ( 'tiny' == $field['colorpicker'] ? 'tinyColorPicker' : 'iColorPicker' ) . '" value="' . esc_attr( $v['colors'][ $slug ] ) . '">'
										: ''
										)
									. '</span>';
					}
					$output .= '</div>';
				}
				break;
			}
			$output .= '</div>'
					. '</div>';
			break;
	}
	return apply_filters( 'briny_filter_show_custom_field', $output, $id, $field, $value );
}


// Refresh data in the linked field
// according the main field value
if ( ! function_exists( 'briny_refresh_linked_data' ) ) {
	function briny_refresh_linked_data( $value, $linked_name ) {
		if ( 'parent_cat' == $linked_name ) {
			$tax   = briny_get_post_type_taxonomy( $value );
			$terms = ! empty( $tax ) ? briny_get_list_terms( false, $tax ) : array();
			$terms = briny_array_merge( array( 0 => esc_html__( '- Select category -', 'briny' ) ), $terms );
			briny_storage_set_array2( 'options', $linked_name, 'options', $terms );
		}
	}
}


// AJAX: Refresh data in the linked fields
if ( ! function_exists( 'briny_callback_get_linked_data' ) ) {
	add_action( 'wp_ajax_briny_get_linked_data', 'briny_callback_get_linked_data' );
	function briny_callback_get_linked_data() {
		if ( ! wp_verify_nonce( briny_get_value_gp( 'nonce' ), admin_url( 'admin-ajax.php' ) ) ) {
			wp_die();
		}
		$response  = array( 'error' => '' );
		if ( ! empty( $_REQUEST['chg_name'] ) ) {
			$chg_name  = wp_kses_data( wp_unslash( $_REQUEST['chg_name'] ) );
			$chg_value = wp_kses_data( wp_unslash( $_REQUEST['chg_value'] ) );
			if ( 'post_type' == $chg_name ) {
				$tax              = briny_get_post_type_taxonomy( $chg_value );
				$terms            = ! empty( $tax ) ? briny_get_list_terms( false, $tax ) : array();
				$response['list'] = briny_array_merge( array( 0 => esc_html__( '- Select category -', 'briny' ) ), $terms );
			}
		}
		echo json_encode( $response );
		wp_die();
	}
}
