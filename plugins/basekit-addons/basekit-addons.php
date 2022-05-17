<?php
/* ThemeREX Addons support functions
------------------------------------------------------------------------------- */
// Theme init priorities:
// 1 - register filters, that add/remove lists items for the Theme Options
if ( ! function_exists( 'briny_basekit_addons_support_theme_setup1' ) ) {
    add_action( 'after_setup_theme', 'briny_basekit_addons_support_theme_setup1', 1 );
    function briny_basekit_addons_support_theme_setup1() {
        if ( briny_basekit_exists_basekit_addons() ) {
            add_filter( 'basekit_filter_list_posts_types', 'briny_basekit_addons_support_list_post_types' );
        }
    }
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'briny_basekit_addons_support_theme_setup9' ) ) {
    add_action( 'after_setup_theme', 'briny_basekit_addons_support_theme_setup9', 9 );
    function briny_basekit_addons_support_theme_setup9() {

        if ( briny_basekit_exists_basekit_addons() ) {
            add_action( 'wp_enqueue_scripts', 'briny_basekit_addons_support_frontend_scripts', 1100 );
            add_action( 'wp_enqueue_scripts', 'briny_basekit_addons_support_responsive_styles', 2000 );
            add_filter( 'briny_filter_merge_styles', 'briny_basekit_addons_support_merge_styles' );
            add_filter( 'trx_addons_cpt_list_options', 'briny_basekit_addons_trx_addons_cpt_list_options', 10, 4 );
            add_filter( 'briny_filter_merge_styles_responsive', 'briny_basekit_addons_merge_styles_responsive' );
            add_filter( 'briny_filter_merge_scripts', 'briny_basekit_addons_support_merge_scripts' );
            add_filter( 'briny_filter_post_type_taxonomy', 'briny_basekit_addons_support_post_type_taxonomy', 10, 2 );
            if ( is_admin() ) {
                add_filter( 'briny_filter_allow_override_options', 'briny_basekit_addons_support_allow_override_options', 10, 2 );
            } else {

                add_filter( 'briny_filter_detect_blog_mode', 'briny_basekit_addons_support_detect_blog_mode' );
                add_filter( 'trx_addons_filter_args_related', 'briny_basekit_addons_support_args_related');
            }
        }

        if ( is_admin() ) {
            add_filter( 'briny_filter_tgmpa_required_plugins', 'briny_basekit_addons_support_tgmpa_required_plugins' );
        }
    }
}

// Filter to add in the required plugins list
if ( ! function_exists( 'briny_basekit_addons_support_tgmpa_required_plugins' ) ) {
    
    function briny_basekit_addons_support_tgmpa_required_plugins( $list = array() ) {
        if ( briny_storage_isset( 'required_plugins', 'basekit-addons' ) && briny_storage_get_array( 'required_plugins', 'basekit-addons', 'install' ) !== false ) {
            $path = briny_get_plugin_source_path( 'plugins/basekit-addons/basekit-addons.zip' );
            if ( ! empty( $path ) || briny_get_theme_setting( 'tgmpa_upload' ) ) {
                $list[] = array(
                    'name'     => briny_storage_get_array( 'required_plugins', 'basekit-addons', 'title' ),
                    'slug'     => 'basekit-addons',
                    'version'  => '1.0.0',
                    'source'   => ! empty( $path ) ? $path : 'upload://basekit-addons.zip',
                    'required' => true,
                );
            }
        }
        return $list;
    }
}


/* Add options in the Theme Options Customizer
------------------------------------------------------------------------------- */

if ( ! function_exists( 'briny_basekit_addons_trx_addons_cpt_list_options' ) ) {
    function briny_basekit_addons_trx_addons_cpt_list_options( $options, $cpt ) {
        if ( 'layouts' == $cpt && BRINY_THEME_FREE ) {
            $options = array();
        } elseif ( is_array( $options ) ) {
            foreach ( $options as $k => $v ) {
                // Store this option in the external (not theme's) storage
                $options[ $k ]['options_storage'] = 'trx_addons_options';
                // Hide this option from plugin's options (only for overriden options)
                if ( in_array( $cpt, array( 'tours', 'boats' ) ) ) {
                    $options[ $k ]['hidden'] = true;
                }
            }
        }
        return $options;
    }
}


// Return plugin's specific options for CPT
if ( ! function_exists( 'briny_addons_support_get_list_cpt_options' ) ) {
    function briny_addons_support_get_list_cpt_options( $cpt ) {
        $options = array();
        if ( 'tours' == $cpt ) {
            $options = basekit_addons_cpt_tours_get_list_options();
        }elseif ( 'boats' == $cpt ) {
            $options = array_merge(
                basekit_addons_cpt_boats_get_list_options(),
                basekit_addons_cpt_boats_agents_get_list_options()
            );
        }
        // Remove parameter 'hidden'
        foreach ( $options as $k => $v ) {
            if ( ! empty( $v['hidden'] ) ) {
                unset( $options[ $k ]['hidden'] );
            }
        }
        return $options;
    }
}

// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'briny_basekit_addons_support_setup3' ) ) {
    add_action( 'after_setup_theme', 'briny_basekit_addons_support_setup3', 3 );
    function briny_basekit_addons_support_setup3() {
        // Section 'Tours' - settings to show 'Tours' blog archive and single posts
        if ( briny_basekit_exists_tours() ) {
           briny_storage_merge_array(
                'options', '', array_merge(
                    array(
                        'tours' => array(
                            'title' => esc_html__( 'Tours', 'briny' ),
                            'desc'  => wp_kses_data( __( 'Select parameters to display the Tours pages', 'briny' ) )
                                . '<br>'
                                . wp_kses_data( __( 'Attention! Option "Style" apply only after you save the options!', 'briny' ) ),
                            'type'  => 'section',
                        ),
                    ),
                    briny_addons_support_get_list_cpt_options( 'tours' ),
                    briny_options_get_list_cpt_options( 'tours' ),
                    array(
                        'single_info_tours'        => array(
                            'title' => esc_html__( 'Single Tours item', 'briny' ),
                            'desc'  => '',
                            'type'  => 'info',
                        ),
                        'show_related_posts_tours' => array(
                            'title' => esc_html__( 'Show related posts', 'briny' ),
                            'desc'  => wp_kses_data( __( "Show section 'Related Tours items' on the single Tours page", 'briny' ) ),
                            'std'   => 1,
                            'type'  => 'checkbox',
                        ),
                        'related_posts_tours'      => array(
                            'title'      => esc_html__( 'Related Tours items', 'briny' ),
                            'desc'       => wp_kses_data( __( 'How many related Tours items should be displayed on the single Tours page?', 'briny' ) ),
                            'dependency' => array(
                                'show_related_posts_tours' => array( 1 ),
                            ),
                            'std'        => 2,
                            'options'    => briny_get_list_range( 1, 9 ),
                            'type'       => 'select',
                        ),
                        'related_columns_tours'    => array(
                            'title'      => esc_html__( 'Related columns', 'briny' ),
                            'desc'       => wp_kses_data( __( 'How many columns should be used to output related Tours on the single Tours page?', 'briny' ) ),
                            'dependency' => array(
                                'show_related_posts_tours' => array( 1 ),
                            ),
                            'std'        => 2,
                            'options'    => briny_get_list_range( 1, 4 ),
                            'type'       => 'select',
                        ),
                    )
                )
            );
        }
        // Section 'Boats' - settings to show 'Boats' blog archive and single posts
        if ( briny_basekit_exists_boats() ) {

            briny_storage_merge_array(
                'options', '', array_merge(
                    array(
                        'boats' => array(
                            'title' => esc_html__( 'Boats', 'briny' ),
                            'desc'  => wp_kses_data( __( 'Select parameters to display the Boats pages', 'briny' ) )
                                . '<br>'
                                . wp_kses_data( __( 'Attention! Option "Style" apply only after you save the options!', 'briny' ) ),
                            'type'  => 'section',
                        ),
                    ),

                    briny_addons_support_get_list_cpt_options( 'boats' ),
                    briny_options_get_list_cpt_options ( 'boats' ),
                    array(
                        'single_info_boats'        => array(
                            'title' => esc_html__( 'Single boat', 'briny' ),
                            'desc'  => '',
                            'type'  => 'info',
                        ),
                        'show_related_posts_boats' => array(
                            'title' => esc_html__( 'Show related posts', 'briny' ),
                            'desc'  => wp_kses_data( __( "Show section 'Related boats' on the single boat page", 'briny' ) ),
                            'std'   => 1,
                            'type'  => 'checkbox',
                        ),
                        'related_posts_boats'      => array(
                            'title'      => esc_html__( 'Related boats', 'briny' ),
                            'desc'       => wp_kses_data( __( 'How many related boats should be displayed on the single boat page?', 'briny' ) ),
                            'dependency' => array(
                                'show_related_posts_boats' => array( 1 ),
                            ),
                            'std'        => 3,
                            'options'    => briny_get_list_range( 1, 9 ),
                            'type'       => 'select',
                        ),
                        'related_columns_boats'    => array(
                            'title'      => esc_html__( 'Related columns', 'briny' ),
                            'desc'       => wp_kses_data( __( 'How many columns should be used to output related boats on the single boat page?', 'briny' ) ),
                            'dependency' => array(
                                'show_related_posts_boats' => array( 1 ),
                            ),
                            'std'        => 3,
                            'options'    => briny_get_list_range( 1, 4 ),
                            'type'       => 'select',
                        ),
                    )
                )
            );
        }
    }
}



/* Plugin's support utilities
------------------------------------------------------------------------------- */

// Check if plugin installed and activated
if ( ! function_exists( 'briny_basekit_exists_basekit_addons' ) ) {
    function briny_basekit_exists_basekit_addons() {
        return function_exists( 'basekit_addons_init' );
    }
}

// Return true if CPT_Name is supported
if ( ! function_exists( 'briny_basekit_exists_tours' ) ) {
    function briny_basekit_exists_tours() {
        return defined( 'BASEKIT_ADDONS_CPT_TOURS_PT' );
    }
}

// Return true if boats is supported
if ( ! function_exists( 'briny_basekit_exists_boats' ) ) {
    function briny_basekit_exists_boats() {
        return defined( 'BASEKIT_ADDONS_CPT_BOATS_PT' );
    }
}

// Return true if it's boats page
if ( ! function_exists( 'briny_basekit_is_boats_page' ) ) {
    function briny_basekit_is_boats_page() {
        return function_exists( 'trx_addons_is_boats_page' ) && trx_addons_is_boats_page();
    }
}

// Return true if it's agent page
if ( ! function_exists( 'briny_basekit_is_boats_agents_page' ) ) {
    function briny_basekit_is_boats_agents_page() {
        return function_exists( 'trx_addons_is_agents_page' ) && trx_addons_is_agents_page();
    }
}


// Return true if it's CPT_Name page
if ( ! function_exists( 'briny_basekit_is_tours_page' ) ) {
    function briny_basekit_is_tours_page() {
        return function_exists( 'basekit_addons_is_tours_page' ) && basekit_addons_is_tours_page();
    }
}

// Detect current blog mode
if ( ! function_exists( 'briny_basekit_addons_support_detect_blog_mode' ) ) {
    
    function briny_basekit_addons_support_detect_blog_mode( $mode = '' ) {
        if ( briny_basekit_is_tours_page() ) {
            $mode = 'tours';
        }elseif ( briny_basekit_is_boats_page() ) {
            $mode = 'boats';
        }
        return $mode;
    }
}

// Add CPT_Name to the supported posts list
if ( ! function_exists( 'briny_basekit_addons_support_list_post_types' ) ) {
    
    function briny_basekit_addons_support_list_post_types( $list = array() ) {
        if ( defined( 'BASEKIT_ADDONS_CPT_TOURS_PT' ) ) {
            $list[ BASEKIT_ADDONS_CPT_TOURS_PT ] = esc_html__( 'Tours', 'briny' );
        }
        elseif ( defined( 'BASEKIT_ADDONS_CPT_BOATS_PT' ) ) {
            $list[ BASEKIT_ADDONS_CPT_BOATS_PT ] = esc_html__( 'Boats', 'briny' );
        }
        return $list;
    }
}

// Return taxonomy for current post type
if ( ! function_exists( 'briny_basekit_addons_support_post_type_taxonomy' ) ) {
    
    function briny_basekit_addons_support_post_type_taxonomy( $tax = '', $post_type = '' ) {
        if ( defined( 'BASEKIT_ADDONS_CPT_TOURS_PT' ) && BASEKIT_ADDONS_CPT_TOURS_PT == $post_type ) {
            $tax = BASEKIT_ADDONS_CPT_TOURS_TAXONOMY;
        }elseif ( defined( 'BASEKIT_ADDONS_CPT_BOATS_PT' ) && BASEKIT_ADDONS_CPT_BOATS_PT == $post_type ) {
            $tax = array(TRX_ADDONS_CPT_BOATS_TAXONOMY_BOAT_AMENITIES,
                TRX_ADDONS_CPT_BOATS_TAXONOMY_BOAT_SPECIFICATIONS,
                TRX_ADDONS_CPT_BOATS_TAXONOMY_BOAT_CREW,
                TRX_ADDONS_CPT_BOATS_TAXONOMY_BOAT_TYPE,
                TRX_ADDONS_CPT_BOATS_TAXONOMY_BOAT_LOCATION,
            );
        }
        return $tax;
    }
}

// Show categories of the CPT_Name
if ( ! function_exists( 'briny_basekit_addons_support_get_post_categories' ) ) {
    
    function briny_basekit_addons_support_get_post_categories( $cats = '' ) {

        if ( defined( 'BASEKIT_ADDONS_CPT_TOURS_PT' ) ) {
            if ( get_post_type() == BASEKIT_ADDONS_CPT_TOURS_PT ) {
                $cats = briny_get_post_terms( ', ', get_the_ID(), BASEKIT_ADDONS_CPT_TOURS_TAXONOMY );
            }
        }
        return $cats;
    }
}


// Check if override option is allowed
if ( ! function_exists( 'briny_basekit_addons_support_allow_override_options' ) ) {
    
    function briny_basekit_addons_support_allow_override_options( $allow, $post_type ) {
        return $allow || ( defined( 'BASEKIT_ADDONS_CPT_TOURS_PT' ) && BASEKIT_ADDONS_CPT_TOURS_PT == $post_type )
            || ( defined( 'BASEKIT_ADDONS_CPT_BOATS_PT' ) && BASEKIT_ADDONS_CPT_BOATS_PT == $post_type )
            || ( defined( 'TRX_ADDONS_CPT_AGENTS_PT' ) && TRX_ADDONS_CPT_AGENTS_PT == $post_type );
    }
}

// Set related posts and columns for the plugin's output
if ( ! function_exists( 'briny_basekit_addons_support_args_related' ) ) {
    
    function briny_basekit_addons_support_args_related( $args ) {
        if ( ! empty( $args['template_args_name'] )
            && in_array(
                $args['template_args_name'],
                array( 'trx_addons_args_sc_tours',
                       'trx_addons_args_sc_boats' )
            ) ) {
            $args['posts_per_page'] = (int) briny_get_theme_option( 'show_related_posts' )
                ? briny_get_theme_option( 'related_posts' )
                : 0;
            $args['columns']  = briny_get_theme_option( 'related_columns' );
        }
        return $args;
    }
}


// Enqueue custom styles
if ( ! function_exists( 'briny_basekit_addons_support_frontend_scripts' ) ) {
    
    function briny_basekit_addons_support_frontend_scripts() {
        if ( briny_basekit_exists_basekit_addons() ) {
            if ( briny_is_on( briny_get_theme_option( 'debug_mode' ) ) ) {
                $basekit_url = briny_get_file_url( 'plugins/basekit-addons/basekit-addons.css' );
                if ( '' != $basekit_url ) {
                    wp_enqueue_style( 'briny-basekit-addons',  $basekit_url, array(), null );
                }
                $basekit_url = briny_get_file_url( 'plugins/basekit-addons/basekit-addons.js' );
                if ( '' != $basekit_url ) {
                    wp_enqueue_script( 'briny-basekit-addons', $basekit_url, array( 'jquery' ), null, true );
                }
            }
        }
    }
}


// Enqueue responsive styles
if ( ! function_exists( 'briny_basekit_addons_support_responsive_styles' ) ) {
    
    function briny_basekit_addons_support_responsive_styles() {
        if ( briny_basekit_exists_basekit_addons() ) {
            if ( briny_is_on( briny_get_theme_option( 'debug_mode' ) ) ) {
                $basekit_url = briny_get_file_url( 'plugins/basekit-addons/basekit-addons-responsive.css' );
                if ( '' != $basekit_url ) {
                    wp_enqueue_style( 'briny-basekit-addons-responsive',  $basekit_url, array(), null );
                }
            }
        }
    }
}

// Merge custom styles
if ( ! function_exists( 'briny_basekit_addons_support_merge_styles' ) ) {
    
    function briny_basekit_addons_support_merge_styles( $list ) {
        $list[] = 'plugins/basekit-addons/basekit-addons.css';
        return $list;
    }
}

// Merge responsive styles
if ( ! function_exists( 'briny_basekit_addons_merge_styles_responsive' ) ) {
    
    function briny_basekit_addons_merge_styles_responsive( $list ) {
        
        return $list;
    }
}

// Merge custom scripts
if ( ! function_exists( 'briny_basekit_addons_support_merge_scripts' ) ) {
    
    function briny_basekit_addons_support_merge_scripts( $list ) {
        
        return $list;
    }
}



// Plugin API - theme-specific wrappers for plugin functions
//------------------------------------------------------------------------

// Add plugin-specific colors and fonts to the custom CSS
if ( briny_basekit_exists_basekit_addons() ) {
    require_once BRINY_THEME_DIR . 'plugins/basekit-addons/basekit-addons-styles.php';
}
