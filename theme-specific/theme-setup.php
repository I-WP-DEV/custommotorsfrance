<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage BRINY
 * @since BRINY 1.0.22
 */

// If this theme is a free version of premium theme
if ( ! defined( 'BRINY_THEME_FREE' ) ) {
	define( 'BRINY_THEME_FREE', false );
}
if ( ! defined( 'BRINY_THEME_FREE_WP' ) ) {
	define( 'BRINY_THEME_FREE_WP', false );
}

// If this theme is a part of Envato Elements
if ( ! defined( 'BRINY_THEME_IN_ENVATO_ELEMENTS' ) ) {
	define( 'BRINY_THEME_IN_ENVATO_ELEMENTS', false );
}

// If this theme uses multiple skins
if ( ! defined( 'BRINY_ALLOW_SKINS' ) ) {
	define( 'BRINY_ALLOW_SKINS', false );
}
if ( ! defined( 'BRINY_DEFAULT_SKIN' ) ) {
	define( 'BRINY_DEFAULT_SKIN', 'default' );
}



// Theme storage
// Attention! Must be in the global namespace to compatibility with WP CLI
//-------------------------------------------------------------------------
$GLOBALS['BRINY_STORAGE'] = array(

	// Key validator: market[env|loc]-vendor[axiom|ancora|themerex]
	'theme_pro_key'      => 'env-ancora',

	// Generate Personal token from Envato to automatic upgrade theme
	'upgrade_token_url'  => 'https://build.envato.com/create-token/?default=t&purchase:download=t&purchase:list=t',

	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url'     => 'http://briny.ancorathemes.com',
	'theme_doc_url'      => 'http://briny.ancorathemes.com/doc',
	
	'theme_rate_url'     => 'https://themeforest.net/download',

	'theme_custom_url' => '//themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themedash',

	'theme_download_url' => 'https://themeforest.net/item/briny-scuba-diving-water-sports-wordpress-theme/24202260',        // Ancora

	'theme_support_url'  => 'https://themerex.net/support/',                    		 // Ancora

	'theme_video_url'    => 'https://www.youtube.com/channel/UCdIjRh7-lPVHqTTKpaf8PLA',  // Ancora

	'theme_privacy_url'  => 'http://ancorathemes.com/privacy-policy/',                   // Ancora

	// Comma separated slugs of theme-specific categories (for get relevant news in the dashboard widget)
	// (i.e. 'children,kindergarten')
	'theme_categories'   => '',

	// Responsive resolutions
	// Parameters to create css media query: min, max
	'responsive'         => array(
		// By size
		'xxl'        => array( 'max' => 1679 ),
		'xl'         => array( 'max' => 1439 ),
		'lg'         => array( 'max' => 1279 ),
		'md_over'    => array( 'min' => 1024 ),
		'md'         => array( 'max' => 1023 ),
		'sm'         => array( 'max' => 767 ),
		'sm_wp'      => array( 'max' => 600 ),
		'xs'         => array( 'max' => 479 ),
		// By device
		'wide'       => array(
			'min' => 2160
		),
		'desktop'    => array(
			'min' => 1680,
			'max' => 2159,
		),
		'notebook'   => array(
			'min' => 1280,
			'max' => 1679,
		),
		'tablet'     => array(
			'min' => 768,
			'max' => 1279,
		),
		'not_mobile' => array(
			'min' => 768
		),
		'mobile'     => array(
			'max' => 767
		),
	),
);



// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$briny_theme_required_plugins_group = esc_html__( 'Core', 'briny' );
$briny_theme_required_plugins = array(
	// Section: "CORE" (required plugins)
	// DON'T COMMENT OR REMOVE NEXT LINES!
	'trx_addons'         => array(
								'title'       => esc_html__( 'ThemeREX Addons', 'briny' ),
								'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'briny' ),
								'required'    => true,
								'logo'        => 'logo.png',
								'group'       => $briny_theme_required_plugins_group,
							),
);

// Section: "PAGE BUILDERS"
$briny_theme_required_plugins_group = esc_html__( 'Page Builders', 'briny' );
$briny_theme_required_plugins['elementor'] = array(
	'title'       => esc_html__( 'Elementor', 'briny' ),
	'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'briny' ),
	'required'    => false,
	'logo'        => 'logo.png',
	'group'       => $briny_theme_required_plugins_group,
);
$briny_theme_required_plugins['gutenberg'] = array(
	'title'       => esc_html__( 'Gutenberg', 'briny' ),
	'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'briny' ),
	'required'    => false,
	'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
	'logo'        => 'logo.png',
	'group'       => $briny_theme_required_plugins_group,
);
if ( ! BRINY_THEME_FREE ) {
	$briny_theme_required_plugins['js_composer']          = array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'briny' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'briny' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'logo.jpg',
		'group'       => $briny_theme_required_plugins_group,
	);
}

// Section: "E-COMMERCE"
$briny_theme_required_plugins_group = esc_html__( 'E-Commerce', 'briny' );
$briny_theme_required_plugins['woocommerce']              = array(
	'title'       => esc_html__( 'WooCommerce', 'briny' ),
	'description' => esc_html__( "Connect the store to your website and start selling now", 'briny' ),
	'required'    => false,
	'logo'        => 'logo.png',
	'group'       => $briny_theme_required_plugins_group,
);
$briny_theme_required_plugins['elegro-payment']              = array(
    'title'       => esc_html__( 'Elegro Crypto Payment', 'briny' ),
    'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'briny' ),
    'required'    => false,
    'logo'        => 'elegro-payment.png',
    'group'       => $briny_theme_required_plugins_group,
);

// Section: "SOCIALS & COMMUNITIES"
$briny_theme_required_plugins_group = esc_html__( 'Socials and Communities', 'briny' );

$briny_theme_required_plugins['trx_socials']   = array(
	'title'       => esc_html__( 'TRX socials', 'briny' ),
	'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'briny' ),
	'required'    => false,
	'logo'        => 'logo.png',
	'group'       => $briny_theme_required_plugins_group,
);
$briny_theme_required_plugins['mailchimp-for-wp'] = array(
	'title'       => esc_html__( 'MailChimp for WP', 'briny' ),
	'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'briny' ),
	'required'    => false,
	'logo'        => 'logo.png',
	'group'       => $briny_theme_required_plugins_group,
);

// Section: "EVENTS & TIMELINES"
$briny_theme_required_plugins_group = esc_html__( 'Events and Appointments', 'briny' );
if ( ! BRINY_THEME_FREE ) {
	$briny_theme_required_plugins['booked']                 = array(
		'title'       => esc_html__( 'Booked Appointments', 'briny' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'logo.png',
		'group'       => $briny_theme_required_plugins_group,
	);
}

// Section: "CONTENT"
$briny_theme_required_plugins_group = esc_html__( 'Content', 'briny' );
$briny_theme_required_plugins['contact-form-7'] = array(
	'title'       => esc_html__( 'Contact Form 7', 'briny' ),
	'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'briny' ),
	'required'    => false,
	'logo'        => 'logo.jpg',
	'group'       => $briny_theme_required_plugins_group,
);
$briny_theme_required_plugins['the-events-calendar'] = array(
    'title'       => esc_html__( 'The Events Calendar', 'briny' ),
    'description' => '',
    'required'    => false,
    'logo'        => 'the-events-calendar.png',
    'group'       => $briny_theme_required_plugins_group,
);
if ( ! BRINY_THEME_FREE ) {
	$briny_theme_required_plugins['essential-grid']             = array(
		'title'       => esc_html__( 'Essential Grid', 'briny' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'logo.png',
		'group'       => $briny_theme_required_plugins_group,
	);
	$briny_theme_required_plugins['revslider']                  = array(
		'title'       => esc_html__( 'Revolution Slider', 'briny' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'logo.png',
		'group'       => $briny_theme_required_plugins_group,
	);

}

// Section: "OTHER"
$briny_theme_required_plugins_group = esc_html__( 'Other', 'briny' );
$briny_theme_required_plugins['wp-gdpr-compliance'] = array(
	'title'       => esc_html__( 'Cookie Information', 'briny' ),
	'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'briny' ),
	'required'    => false,
	'logo'        => 'logo.png',
	'group'       => $briny_theme_required_plugins_group,
);
$briny_theme_required_plugins['trx_updater'] = array(
    'title'       => esc_html__( 'ThemeREX Updater', 'briny' ),
    'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'briny' ),
    'required'    => false,
    'logo'        => 'trx_updater.png',
    'group'       => $briny_theme_required_plugins_group,
);
if ( ! BRINY_THEME_FREE ) {
	$briny_theme_required_plugins['basekit-addons']   = array(
		'title'       => esc_html__( 'Basekit Addons', 'briny' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'logo.png',
		'group'       => esc_html__( 'Other', 'briny' ),
	);
}

// Add plugins list to the global storage
$GLOBALS['BRINY_STORAGE']['required_plugins'] = $briny_theme_required_plugins;



// THEME-SPECIFIC BLOG LAYOUTS
//----------------------------------------------
$briny_theme_blog_styles = array(
	'excerpt' => array(
		'title'   => esc_html__( 'Standard', 'briny' ),
		'archive' => 'index-excerpt',
		'item'    => 'content-excerpt',
		'styles'  => 'excerpt',
	),
	'classic' => array(
		'title'   => esc_html__( 'Classic', 'briny' ),
		'archive' => 'index-classic',
		'item'    => 'content-classic',
		'columns' => array( 2, 3 ),
		'styles'  => 'classic',
	),
);
if ( ! BRINY_THEME_FREE ) {
	$briny_theme_blog_styles['masonry']   = array(
		'title'   => esc_html__( 'Masonry', 'briny' ),
		'archive' => 'index-classic',
		'item'    => 'content-classic',
		'columns' => array( 2, 3 ),
		'styles'  => 'masonry',
	);
	$briny_theme_blog_styles['portfolio'] = array(
		'title'   => esc_html__( 'Portfolio', 'briny' ),
		'archive' => 'index-portfolio',
		'item'    => 'content-portfolio',
		'columns' => array( 2, 3, 4 ),
		'styles'  => 'portfolio',
	);
	$briny_theme_blog_styles['gallery']   = array(
		'title'   => esc_html__( 'Gallery', 'briny' ),
		'archive' => 'index-portfolio',
		'item'    => 'content-portfolio-gallery',
		'columns' => array( 2, 3, 4 ),
		'styles'  => array( 'portfolio', 'gallery' ),
	);
	$briny_theme_blog_styles['chess']     = array(
		'title'   => esc_html__( 'Chess', 'briny' ),
		'archive' => 'index-chess',
		'item'    => 'content-chess',
		'columns' => array( 1, 2, 3 ),
		'styles'  => 'chess',
	);
}

// Add list of blog styles to the global storage
$GLOBALS['BRINY_STORAGE']['blog_styles'] = $briny_theme_blog_styles;


// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( ! function_exists( 'briny_customizer_theme_setup1' ) ) {
	add_action( 'after_setup_theme', 'briny_customizer_theme_setup1', 1 );
	function briny_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		briny_storage_set(
			'settings', array(

				'duplicate_options'      => 'child',                    // none  - use separate options for the main and the child-theme
																		// child - duplicate theme options from the main theme to the child-theme only
																		// both  - sinchronize changes in the theme options between main and child themes

				'customize_refresh'      => 'auto',                     // Refresh method for preview area in the Appearance - Customize:
																		// auto - refresh preview area on change each field with Theme Options
																		// manual - refresh only obn press button 'Refresh' at the top of Customize frame

				'max_load_fonts'         => 5,                          // Max fonts number to load from Google fonts or from uploaded fonts

				'comment_after_name'     => true,                       // Place 'comment' field after the 'name' and 'email'

				'show_author_avatar'     => true,                       // Display author's avatar in the post meta

				'icons_selector'         => 'internal',                 // Icons selector in the shortcodes:
																		// internal - internal popup with plugin's or theme's icons list (fast and support images and svg)

				'icons_type'             => 'icons',                    // Type of icons (if 'icons_selector' is 'internal'):
																		// icons  - use font icons to present icons
																		// images - use images from theme's folder trx_addons/css/icons.png
																		// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'socials_type'           => 'icons',                    // Type of socials icons (if 'icons_selector' is 'internal'):
																		// icons  - use font icons to present social networks
																		// images - use images from theme's folder trx_addons/css/icons.png
																		// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'check_min_version'      => true,                       // Check if exists a .min version of .css and .js and return path to it
																		// instead the path to the original file
																		// (if debug_mode is off and modification time of the original file < time of the .min file)

				'autoselect_menu'        => true,                      // Show any menu if no menu selected in the location 'main_menu'
																		// (for example, the theme is just activated)

				'disable_jquery_ui'      => false,                      // Prevent loading custom jQuery UI libraries in the third-party plugins

				'use_mediaelements'      => true,                       // Load script "Media Elements" to play video and audio

				'tgmpa_upload'           => false,                      // Allow upload not pre-packaged plugins via TGMPA

				'allow_no_image'         => false,                      // Allow to use theme-specific image placeholder if no image present in the blog, related posts, post navigation, etc.

				'separate_schemes'       => true,                       // Save color schemes to the separate files __color_xxx.css (true) or append its to the __custom.css (false)

				'allow_fullscreen'       => false,                      // Allow cases 'fullscreen' and 'fullwide' for the body style in the Theme Options
																		// In the Page Options this styles are present always
																		// (can be removed if filter 'briny_filter_allow_fullscreen' return false)

				'attachments_navigation' => false,                      // Add arrows on the single attachment page to navigate to the prev/next attachment

				'gutenberg_safe_mode'    => array(),                    // 'vc', 'elementor' - Prevent simultaneous editing of posts for Gutenberg and other PageBuilders (VC, Elementor)

				'gutenberg_add_context'  => false,                      // Add context to the Gutenberg editor styles with our method (if true - use if any problem with editor styles) or use native Gutenberg way via add_editor_style() (if false - used by default)

				'allow_gutenberg_blocks' => true,                       // Allow our shortcodes and widgets as blocks in the Gutenberg (not ready yet - in the development now)

				'subtitle_above_title'   => true,                       // Put subtitle above the title in the shortcodes

				'add_hide_on_xxx'        => 'replace',                  // Add our breakpoints to the Responsive section of each element
																		// 'add' - add our breakpoints after Elementor's
																		// 'replace' - add our breakpoints instead Elementor's
																		// 'none' - don't add our breakpoints (using only Elementor's)
			)
		);

		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------

		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		
		briny_storage_set(
			'load_fonts', array(
				// Google font
				array(
					'name'   => 'Roboto',
					'family' => 'sans-serif',
					'styles' => '300,300italic,400,400italic,700,700italic',     // Parameter 'style' used only for the Google fonts
				),
				// Font-face packed with theme
				array(
					'name'   => 'Metropolis',
					'family' => 'sans-serif',
				),
			)
		);

		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		briny_storage_set( 'load_fonts_subset', 'latin,latin-ext' );

		// Settings of the main tags
		// Attention! Font name in the parameter 'font-family' will be enclosed in the quotes and no spaces after comma!
		
		
		

		briny_storage_set(
			'theme_fonts', array(
				'p'       => array(
					'title'           => esc_html__( 'Main text', 'briny' ),
					'description'     => esc_html__( 'Font settings of the main text of the site. Attention! For correct display of the site on mobile devices, use only units "rem", "em" or "ex"', 'briny' ),
					'font-family'     => '"Metropolis",sans-serif',
					'font-size'       => '1rem',
					'font-weight'     => '300',
					'font-style'      => 'normal',
					'line-height'     => '1.5556em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.38px',
					'margin-top'      => '0em',
					'margin-bottom'   => '1.4em',
				),
				'h1'      => array(
					'title'           => esc_html__( 'Heading 1', 'briny' ),
					'font-family'     => '"Metropolis",sans-serif',
					'font-size'       => '3.167em',
					'font-weight'     => '800',
					'font-style'      => 'normal',
					'line-height'     => '1.07em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '1.75em',
					'margin-bottom'   => '0.5em',
				),
				'h2'      => array(
					'title'           => esc_html__( 'Heading 2', 'briny' ),
					'font-family'     => '"Metropolis",sans-serif',
					'font-size'       => '2.556em',
					'font-weight'     => '800',
					'font-style'      => 'normal',
					'line-height'     => '1.065em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '2.1em',
					'margin-bottom'   => '0.619em',
				),
				'h3'      => array(
					'title'           => esc_html__( 'Heading 3', 'briny' ),
					'font-family'     => '"Metropolis",sans-serif',
					'font-size'       => '2em',
					'font-weight'     => '800',
					'font-style'      => 'normal',
					'line-height'     => '1.361em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '2.4545em',
					'margin-bottom'   => '0.68em',
				),
				'h4'      => array(
					'title'           => esc_html__( 'Heading 4', 'briny' ),
					'font-family'     => '"Metropolis",sans-serif',
					'font-size'       => '1.6667em',
					'font-weight'     => '800',
					'font-style'      => 'normal',
					'line-height'     => '1.2333em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '3.1em',
					'margin-bottom'   => '0.7em',
				),
				'h5'      => array(
					'title'           => esc_html__( 'Heading 5', 'briny' ),
					'font-family'     => '"Metropolis",sans-serif',
					'font-size'       => '1.3333em',
					'font-weight'     => '800',
					'font-style'      => 'normal',
					'line-height'     => '1.16667em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '4.1em',
					'margin-bottom'   => '0.85em',
				),
				'h6'      => array(
					'title'           => esc_html__( 'Heading 6', 'briny' ),
					'font-family'     => '"Metropolis",sans-serif',
					'font-size'       => '1em',
					'font-weight'     => '800',
					'font-style'      => 'normal',
					'line-height'     => '1.33333em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '5.1em',
					'margin-bottom'   => '0.8412em',
				),
				'logo'    => array(
					'title'           => esc_html__( 'Logo text', 'briny' ),
					'description'     => esc_html__( 'Font settings of the text case of the logo', 'briny' ),
					'font-family'     => '"Metropolis",sans-serif',
					'font-size'       => '1.8em',
					'font-weight'     => '800',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '1px',
				),
				'button'  => array(
					'title'           => esc_html__( 'Buttons', 'briny' ),
					'font-family'     => '"Metropolis",sans-serif',
					'font-size'       => '14px',
					'font-weight'     => '800',
					'font-style'      => 'normal',
					'line-height'     => '16px',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '0.38px',
				),
				'input'   => array(
					'title'           => esc_html__( 'Input fields', 'briny' ),
					'description'     => esc_html__( 'Font settings of the input fields, dropdowns and textareas', 'briny' ),
					'font-family'     => 'inherit',
					'font-size'       => '14px',
					'font-weight'     => '300',
					'font-style'      => 'normal',
					'line-height'     => '20px', // Attention! Firefox don't allow line-height less then 1.5em in the select
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.38px',
				),
				'info'    => array(
					'title'           => esc_html__( 'Post meta', 'briny' ),
					'description'     => esc_html__( 'Font settings of the post meta: date, counters, share, etc.', 'briny' ),
					'font-family'     => 'inherit',
					'font-size'       => '14px',  // Old value '13px' don't allow using 'font zoom' in the custom blog items
					'font-weight'     => '800',
					'font-style'      => 'normal',
					'line-height'     => '16px',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '1.2px',
					'margin-top'      => '0px',
					'margin-bottom'   => '0px',
				),
				'menu'    => array(
					'title'           => esc_html__( 'Main menu', 'briny' ),
					'description'     => esc_html__( 'Font settings of the main menu items', 'briny' ),
					'font-family'     => '"Metropolis",sans-serif',
					'font-size'       => '.77778em',
					'font-weight'     => '800',
					'font-style'      => 'normal',
					'line-height'     => '1.14em',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '1.5px',
				),
				'submenu' => array(
					'title'           => esc_html__( 'Dropdown menu', 'briny' ),
					'description'     => esc_html__( 'Font settings of the dropdown menu items', 'briny' ),
					'font-family'     => '"Metropolis",sans-serif',
					'font-size'       => '1em',
					'font-weight'     => '800',
					'font-style'      => 'normal',
					'line-height'     => '1.78em',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '1.5px',
				),
			)
		);

		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		briny_storage_set(
			'scheme_color_groups', array(
				'main'    => array(
					'title'       => esc_html__( 'Main', 'briny' ),
					'description' => esc_html__( 'Colors of the main content area', 'briny' ),
				),
				'alter'   => array(
					'title'       => esc_html__( 'Alter', 'briny' ),
					'description' => esc_html__( 'Colors of the alternative blocks (sidebars, etc.)', 'briny' ),
				),
				'extra'   => array(
					'title'       => esc_html__( 'Extra', 'briny' ),
					'description' => esc_html__( 'Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'briny' ),
				),
				'inverse' => array(
					'title'       => esc_html__( 'Inverse', 'briny' ),
					'description' => esc_html__( 'Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'briny' ),
				),
				'input'   => array(
					'title'       => esc_html__( 'Input', 'briny' ),
					'description' => esc_html__( 'Colors of the form fields (text field, textarea, select, etc.)', 'briny' ),
				),
			)
		);
		briny_storage_set(
			'scheme_color_names', array(
				'bg_color'    => array(
					'title'       => esc_html__( 'Background color', 'briny' ),
					'description' => esc_html__( 'Background color of this block in the normal state', 'briny' ),
				),
				'bg_hover'    => array(
					'title'       => esc_html__( 'Background hover', 'briny' ),
					'description' => esc_html__( 'Background color of this block in the hovered state', 'briny' ),
				),
				'bd_color'    => array(
					'title'       => esc_html__( 'Border color', 'briny' ),
					'description' => esc_html__( 'Border color of this block in the normal state', 'briny' ),
				),
				'bd_hover'    => array(
					'title'       => esc_html__( 'Border hover', 'briny' ),
					'description' => esc_html__( 'Border color of this block in the hovered state', 'briny' ),
				),
				'text'        => array(
					'title'       => esc_html__( 'Text', 'briny' ),
					'description' => esc_html__( 'Color of the plain text inside this block', 'briny' ),
				),
				'text_dark'   => array(
					'title'       => esc_html__( 'Text dark', 'briny' ),
					'description' => esc_html__( 'Color of the dark text (bold, header, etc.) inside this block', 'briny' ),
				),
				'text_light'  => array(
					'title'       => esc_html__( 'Text light', 'briny' ),
					'description' => esc_html__( 'Color of the light text (post meta, etc.) inside this block', 'briny' ),
				),
				'text_link'   => array(
					'title'       => esc_html__( 'Link', 'briny' ),
					'description' => esc_html__( 'Color of the links inside this block', 'briny' ),
				),
				'text_hover'  => array(
					'title'       => esc_html__( 'Link hover', 'briny' ),
					'description' => esc_html__( 'Color of the hovered state of links inside this block', 'briny' ),
				),
				'text_link2'  => array(
					'title'       => esc_html__( 'Link 2', 'briny' ),
					'description' => esc_html__( 'Color of the accented texts (areas) inside this block', 'briny' ),
				),
				'text_hover2' => array(
					'title'       => esc_html__( 'Link 2 hover', 'briny' ),
					'description' => esc_html__( 'Color of the hovered state of accented texts (areas) inside this block', 'briny' ),
				),
				'text_link3'  => array(
					'title'       => esc_html__( 'Link 3', 'briny' ),
					'description' => esc_html__( 'Color of the other accented texts (buttons) inside this block', 'briny' ),
				),
				'text_hover3' => array(
					'title'       => esc_html__( 'Link 3 hover', 'briny' ),
					'description' => esc_html__( 'Color of the hovered state of other accented texts (buttons) inside this block', 'briny' ),
				),
			)
		);
		$schemes = array(

			// Color scheme: 'default'
			'default' => array(
				'title'    => esc_html__( 'Default', 'briny' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#f2f2f4',
					'bd_color'         => '#dddce1',

					// Text and links colors
					'text'             => '#635c81',
					'text_light'       => '#635c81',
					'text_dark'        => '#221b40',
					'text_link'        => '#ff1000',
					'text_hover'       => '#00b8f4',
					'text_link2'       => '#00b8f4',
					'text_hover2'      => '#ff1000',
					'text_link3'       => '#0D71CE',
					'text_hover3'      => '#00b8f4',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#ffffff',
					'alter_bg_hover'   => '#e9e9ee',
					'alter_bd_color'   => '#dddce1',
					'alter_bd_hover'   => '#ffffff',
					'alter_text'       => '#635c81',
					'alter_light'      => '#635c81',
					'alter_dark'       => '#221b40',
					'alter_link'       => '#ff1000',
					'alter_hover'      => '#00b8f4',
					'alter_link2'      => '#191d32',
					'alter_hover2'     => '#80d572',
					'alter_link3'      => '#191D32',
					'alter_hover3'     => '#00B8F4',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#191d32',
					'extra_bg_hover'   => '#131627',
					'extra_bd_color'   => '#5f597d',
					'extra_bd_hover'   => '#191d32',
					'extra_text'       => '#635c81',
					'extra_light'      => '#635c81',
					'extra_dark'       => '#635c81',
					'extra_link'       => '#00b8f4',
					'extra_hover'      => '#ff1000',
					'extra_link2'      => '#635C81',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#ffffff',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => '#ffffff',
					'input_bg_hover'   => '#ffffff',
					'input_bd_color'   => '#D5D5DD',
					'input_bd_hover'   => '#dddce1',
					'input_text'       => '#635c81',
					'input_light'      => '#A8ADC5',
					'input_dark'       => '#635c81',

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#ff1000',
					'inverse_bd_hover' => '#5aa4a9',
					'inverse_text'     => '#ffffff',
					'inverse_light'    => '#9C98AF',
					'inverse_dark'     => '#221b40',
					'inverse_link'     => '#ffffff',
					'inverse_hover'    => '#221b40',
				),
			),

			// Color scheme: 'dark'
			'dark'    => array(
				'title'    => esc_html__( 'Dark', 'briny' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#191d32',
					'bd_color'         => '#313459',

					// Text and links colors
					'text'             => '#a8adc5',
					'text_light'       => '#8d83b8',
					'text_dark'        => '#ffffff',
					'text_link'        => '#ff1000',
					'text_hover'       => '#00b8f4',
					'text_link2'       => '#00b8f4',
					'text_hover2'      => '#ff1000',
					'text_link3'       => '#0D71CE',
					'text_hover3'      => '#ffffff',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#131627',
					'alter_bg_hover'   => '#191d32',
					'alter_bd_color'   => '#20243d',
					'alter_bd_hover'   => '#272C43',
					'alter_text'       => '#a8adc5',
					'alter_light'      => '#9f97bf',
					'alter_dark'       => '#ffffff',
					'alter_link'       => '#ff1000',
					'alter_hover'      => '#00b8f4',
					'alter_link2'      => '#131627',
					'alter_hover2'     => '#80d572',
					'alter_link3'      => '#FF1000',
					'alter_hover3'     => '#00B8F4',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#ffffff',
					'extra_bg_hover'   => '#f3f5f7',
					'extra_bd_color'   => '#e5e5e5',
					'extra_bd_hover'   => '#191d32',
					'extra_text'       => '#182124',
					'extra_light'      => '#8d83b8',
					'extra_dark'       => '#182124',
					'extra_link'       => '#00b8f4',
					'extra_hover'      => '#fe7259',
					'extra_link2'      => '#ffffff',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#191d32',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => '#131627',
					'input_bg_hover'   => '#131627',
					'input_bd_color'   => '#191d32',
					'input_bd_hover'   => '#8d83b8',
					'input_text'       => '#a8adc5',
					'input_light'      => '#635C81',
					'input_dark'       => '#ffffff',

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#ff1000',
					'inverse_bd_hover' => '#cb5b47',
					'inverse_text'     => '#ffffff',
					'inverse_light'    => '#635C81',
					'inverse_dark'     => '#182124',
					'inverse_link'     => '#ffffff',
					'inverse_hover'    => '#182124',
				),
			),
		);
		briny_storage_set( 'schemes', $schemes );
		briny_storage_set( 'schemes_original', $schemes );
		
		// Simple scheme editor: lists the colors to edit in the "Simple" mode.
		// For each color you can set the array of 'slave' colors and brightness factors that are used to generate new values,
		// when 'main' color is changed
		// Leave 'slave' arrays empty if your scheme does not have a color dependency
		briny_storage_set(
			'schemes_simple', array(
				'text_link'        => array(
					'alter_hover'      => 1,
					'extra_link'       => 1,
					'inverse_bd_color' => 0.85,
					'inverse_bd_hover' => 0.7,
				),
				'text_hover'       => array(
					'alter_link'  => 1,
					'extra_hover' => 1,
				),
				'text_link2'       => array(
					'alter_hover2' => 1,
					'extra_link2'  => 1,
				),
				'text_hover2'      => array(
					'alter_link2'  => 1,
					'extra_hover2' => 1,
				),
				'text_link3'       => array(
					'alter_hover3' => 1,
					'extra_link3'  => 1,
				),
				'text_hover3'      => array(
					'alter_link3'  => 1,
					'extra_hover3' => 1,
				),
				'alter_link'       => array(),
				'alter_hover'      => array(),
				'alter_link2'      => array(),
				'alter_hover2'     => array(),
				'alter_link3'      => array(),
				'alter_hover3'     => array(),
				'extra_link'       => array(),
				'extra_hover'      => array(),
				'extra_link2'      => array(),
				'extra_hover2'     => array(),
				'extra_link3'      => array(),
				'extra_hover3'     => array(),
				'inverse_bd_color' => array(),
				'inverse_bd_hover' => array(),
			)
		);

		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		briny_storage_set(
			'scheme_colors_add', array(
				'bg_color_0'        => array(
					'color' => 'bg_color',
					'alpha' => 0,
				),
				'bg_color_02'       => array(
					'color' => 'bg_color',
					'alpha' => 0.2,
				),
				'bg_color_07'       => array(
					'color' => 'bg_color',
					'alpha' => 0.7,
				),
				'bg_color_08'       => array(
					'color' => 'bg_color',
					'alpha' => 0.8,
				),
				'bg_color_09'       => array(
					'color' => 'bg_color',
					'alpha' => 0.9,
				),
				'alter_bg_color_07' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.75,
				),
				'alter_bg_color_04' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.4,
				),
				'alter_bg_color_00' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0,
				),
				'alter_bg_color_02' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.2,
				),
                'alter_bg_color_05' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.5,
				),
				'alter_bd_color_02' => array(
					'color' => 'alter_bd_color',
					'alpha' => 0.2,
				),
				'alter_link_02'     => array(
					'color' => 'alter_link',
					'alpha' => 0.2,
				),
				'alter_link_07'     => array(
					'color' => 'alter_link',
					'alpha' => 0.7,
				),
				'extra_bg_color_05' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.5,
				),
				'extra_bg_color_07' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.7,
				),
				'extra_link_02'     => array(
					'color' => 'extra_link',
					'alpha' => 0.2,
				),
				'extra_link_07'     => array(
					'color' => 'extra_link',
					'alpha' => 0.7,
				),
				'text_dark_07'      => array(
					'color' => 'text_dark',
					'alpha' => 0.7,
				),
                'text_dark_02'      => array(
					'color' => 'text_dark',
					'alpha' => 0.2,
				),
                'text_dark_015'      => array(
					'color' => 'text_dark',
					'alpha' => 0.15,
				),
				'text_link_02'      => array(
					'color' => 'text_link',
					'alpha' => 0.2,
				),
				'text_link_07'      => array(
					'color' => 'text_link',
					'alpha' => 0.7,
				),
				'text_link_blend'   => array(
					'color'      => 'text_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
                'inverse_text_02'   => array(
					'color'      => 'inverse_text',
                    'alpha' => 0.2,
				),
				'alter_link_blend'  => array(
					'color'      => 'alter_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
			)
		);

		// Parameters to set order of schemes in the css
		briny_storage_set(
			'schemes_sorted', array(
				'color_scheme',
				'header_scheme',
				'menu_scheme',
				'sidebar_scheme',
				'footer_scheme',
			)
		);

		// -----------------------------------------------------------------
		// -- Theme specific thumb sizes
		// -----------------------------------------------------------------
		briny_storage_set(
			'theme_thumbs', apply_filters(
				'briny_filter_add_thumb_sizes', array(
					// Width of the image is equal to the content area width (without sidebar)
					// Height is fixed
					'briny-thumb-huge'        => array(
						'size'  => array( 1170, 658, true ),
						'title' => esc_html__( 'Huge image', 'briny' ),
						'subst' => 'trx_addons-thumb-huge',
					),
					// Width of the image is equal to the content area width (with sidebar)
					// Height is fixed
					'briny-thumb-big'         => array(
						'size'  => array( 800, 428, true ),
						'title' => esc_html__( 'Large image', 'briny' ),
						'subst' => 'trx_addons-thumb-big',
					),

					// Width of the image is equal to the 1/3 of the content area width (without sidebar)
					// Height is fixed
					'briny-thumb-med'         => array(
						'size'  => array( 370, 208, true ),
						'title' => esc_html__( 'Medium image', 'briny' ),
						'subst' => 'trx_addons-thumb-medium',
					),

					// Small square image (for avatars in comments, etc.)
					'briny-thumb-tiny'        => array(
						'size'  => array( 90, 90, true ),
						'title' => esc_html__( 'Small square avatar', 'briny' ),
						'subst' => 'trx_addons-thumb-tiny',
					),

					// Width of the image is equal to the content area width (with sidebar)
					// Height is proportional (only downscale, not crop)
					'briny-thumb-masonry-big' => array(
						'size'  => array( 760, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry Large (scaled)', 'briny' ),
						'subst' => 'trx_addons-thumb-masonry-big',
					),

					// Width of the image is equal to the 1/3 of the full content area width (without sidebar)
					// Height is proportional (only downscale, not crop)
					'briny-thumb-masonry'     => array(
						'size'  => array( 370, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry (scaled)', 'briny' ),
						'subst' => 'trx_addons-thumb-masonry',
					),
                    'briny-thumb-excerpt'         => array(
                        'size'  => array( 270, 270, true ),
                        'title' => esc_html__( 'Excerpt image', 'briny' ),
                        'subst' => 'trx_addons-thumb-excerpt',
                    ),
                    'briny-thumb-team'         => array(
                        'size'  => array( 270, 370, true ),
                        'title' => esc_html__( 'Team image', 'briny' ),
                        'subst' => 'trx_addons-thumb-team',
                    ),
                    'briny-thumb-tours'         => array(
                        'size'  => array( 570, 570, true ),
                        'title' => esc_html__( 'Tours image', 'briny' ),
                        'subst' => 'trx_addons-thumb-tours',
                    ),
                    'briny-thumb-news'         => array(
                        'size'  => array( 640, 430, true ),
                        'title' => esc_html__( 'News image', 'briny' ),
                        'subst' => 'trx_addons-thumb-news',
                    ),
				)
			)
		);
	}
}


//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'briny_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'briny_importer_set_options', 9 );
	function briny_importer_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			$rtl_slug = is_rtl() ? '-rtl' : '';
            $rtl_url = is_rtl() ? 'rtl.' : '';
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Allow import/export functionality
			$options['allow_import'] = true;
			$options['allow_export'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url( briny_get_protocol() . '://demofiles.ancorathemes.com/briny'. $rtl_slug .'/' );
			// Required plugins
			$options['required_plugins'] = array_keys( briny_storage_get( 'required_plugins' ) );
			// Set number of thumbnails (usually 3 - 5) to regenerate at once when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 0;
			// Default demo
			$options['files']['default']['title']       = esc_html__( 'Briny Demo', 'briny' );
			$options['files']['default']['domain_dev']  = '';       // Developers domain
			$options['files']['default']['domain_demo'] = esc_url( briny_get_protocol() . '://'. $rtl_url .'briny.ancorathemes.com' );       // Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
			
			// The array with theme-specific banners, displayed during demo-content import.
			// If array with banners is empty - the banners are uploaded directly from demo-content server.
			$options['banners'] = array();
		}
		return $options;
	}
}


//------------------------------------------------------------------------
// OCDI support
//------------------------------------------------------------------------

// Set theme specific OCDI options
if ( ! function_exists( 'briny_ocdi_set_options' ) ) {
	add_filter( 'trx_addons_filter_ocdi_options', 'briny_ocdi_set_options', 9 );
	function briny_ocdi_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			// Prepare demo data
			$options['demo_url'] = esc_url( briny_get_protocol() . '://demofiles.ancorathemes.com/briny/' );
			// Required plugins
			$options['required_plugins'] = array_keys( briny_storage_get( 'required_plugins' ) );
			// Demo-site domain
			$options['files']['ocdi']['title']       = esc_html__( 'Briny OCDI Demo', 'briny' );
			$options['files']['ocdi']['domain_demo'] = esc_url( briny_get_protocol() . ':////briny.ancorathemes.com' );
			// If theme need more demo - just copy 'default' and change required parameter
			
			
			
		}
		return $options;
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if ( ! function_exists( 'briny_create_theme_options' ) ) {

	function briny_create_theme_options() {

		// Message about options override.
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = esc_html__( 'Attention! Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages. If you changed such parameter and nothing happened on the page, this option may be overridden in the corresponding section or in the Page Options of this page. These options are marked with an asterisk (*) in the title.', 'briny' );

		// Color schemes number: if < 2 - hide fields with selectors
		$hide_schemes = count( briny_storage_get( 'schemes' ) ) < 2;

		briny_storage_set(

			'options', array(

				// 'Logo & Site Identity'
				//---------------------------------------------
				'title_tagline'                 => array(
					'title'    => esc_html__( 'Logo & Site Identity', 'briny' ),
					'desc'     => '',
					'priority' => 10,
					'type'     => 'section',
				),
				'logo_info'                     => array(
					'title'    => esc_html__( 'Logo Settings', 'briny' ),
					'desc'     => '',
					'priority' => 20,
					'qsetup'   => esc_html__( 'General', 'briny' ),
					'type'     => 'info',
				),
				'logo_text'                     => array(
					'title'    => esc_html__( 'Use Site Name as Logo', 'briny' ),
					'desc'     => wp_kses_data( __( 'Use the site title and tagline as a text logo if no image is selected', 'briny' ) ),
					'class'    => 'briny_column-1_2 briny_new_row',
					'priority' => 30,
					'std'      => 1,
					'qsetup'   => esc_html__( 'General', 'briny' ),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_retina_enabled'           => array(
					'title'    => esc_html__( 'Allow retina display logo', 'briny' ),
					'desc'     => wp_kses_data( __( 'Show fields to select logo images for Retina display', 'briny' ) ),
					'class'    => 'briny_column-1_2',
					'priority' => 40,
					'refresh'  => false,
					'std'      => 0,
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_zoom'                     => array(
					'title'   => esc_html__( 'Logo zoom', 'briny' ),
					'desc'    => wp_kses(
									__( 'Zoom the logo (set 1 to leave original size).', 'briny' )
									. ' <br>'
									. __( 'Attention! For this parameter to affect images, their max-height should be specified in "em" instead of "px" when creating a header.', 'briny' )
									. ' <br>'
									. __( 'In this case maximum size of logo depends on the actual size of the picture.', 'briny' ), 'briny_kses_content'
								),
					'std'     => 1,
					'min'     => 0.2,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => BRINY_THEME_FREE ? 'hidden' : 'slider',
				),
				// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
				'logo_retina'                   => array(
					'title'      => esc_html__( 'Logo for Retina', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'briny' ) ),
					'class'      => 'briny_column-1_2',
					'priority'   => 70,
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_mobile_header'            => array(
					'title' => esc_html__( 'Logo for the mobile header', 'briny' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'briny' ) ),
					'class' => 'briny_column-1_2 briny_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_header_retina'     => array(
					'title'      => esc_html__( 'Logo for the mobile header on Retina', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'briny' ) ),
					'class'      => 'briny_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_mobile'                   => array(
					'title' => esc_html__( 'Logo for the mobile menu', 'briny' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile menu', 'briny' ) ),
					'class' => 'briny_column-1_2 briny_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_retina'            => array(
					'title'      => esc_html__( 'Logo mobile on Retina', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'briny' ) ),
					'class'      => 'briny_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_side'                     => array(
					'title' => esc_html__( 'Logo for the side menu', 'briny' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu', 'briny' ) ),
					'class' => 'briny_column-1_2 briny_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_side_retina'              => array(
					'title'      => esc_html__( 'Logo for the side menu on Retina', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'briny' ) ),
					'class'      => 'briny_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'image',
				),



				// 'General settings'
				//---------------------------------------------
				'general'                       => array(
					'title'    => esc_html__( 'General', 'briny' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 20,
					'type'     => 'section',
				),

				'general_layout_info'           => array(
					'title'  => esc_html__( 'Layout', 'briny' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'briny' ),
					'type'   => 'info',
				),
				'body_style'                    => array(
					'title'    => esc_html__( 'Body style', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select width of the body content', 'briny' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'qsetup'   => esc_html__( 'General', 'briny' ),
					'refresh'  => false,
					'std'      => 'wide',
					'options'  => briny_get_list_body_styles( false ),
					'type'     => 'select',
				),
				'page_width'                    => array(
					'title'      => esc_html__( 'Page width', 'briny' ),
					'desc'       => wp_kses_data( __( 'Total width of the site content and sidebar (in pixels). If empty - use default width', 'briny' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed', 'wide' ),
					),
					'std'        => 1170,
					'min'        => 1000,
					'max'        => 1400,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'page',               // SASS variable's name to preview changes 'on fly'
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'slider',
				),
				'page_boxed_extra'             => array(
					'title'      => esc_html__( 'Boxed page extra spaces', 'briny' ),
					'desc'       => wp_kses_data( __( 'Width of the extra side space on boxed pages', 'briny' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed' ),
					),
					'std'        => 170.5,
					'min'        => 0,
					'max'        => 300,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'page_boxed_extra',   // SASS variable's name to preview changes 'on fly'
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'slider',
				),
				'boxed_bg_image'                => array(
					'title'      => esc_html__( 'Boxed bg image', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select or upload image, used as background in the boxed body', 'briny' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed' ),
					),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'std'        => '',
					'qsetup'     => esc_html__( 'General', 'briny' ),
					
					'type'       => 'image',
				),
				'remove_margins'                => array(
					'title'    => esc_html__( 'Remove margins', 'briny' ),
					'desc'     => wp_kses_data( __( 'Remove margins above and below the content area', 'briny' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'refresh'  => false,
					'std'      => 0,
					'type'     => 'checkbox',
				),

				'general_sidebar_info'          => array(
					'title' => esc_html__( 'Sidebar', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position'              => array(
					'title'    => esc_html__( 'Sidebar position', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar', 'briny' ) ),
					'override' => array(
						'mode'    => 'page',		// Override parameters for single posts moved to the 'sidebar_position_single'
						'section' => esc_html__( 'Widgets', 'briny' ),
					),
					'std'      => 'right',
					'qsetup'   => esc_html__( 'General', 'briny' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_position_ss'       => array(
					'title'    => esc_html__( 'Sidebar position on the small screen', 'briny' ),
					'desc'     => wp_kses_data( __( "Select position to move sidebar (if it's not hidden) on the small screen - above or below the content", 'briny' ) ),
					'override' => array(
						'mode'    => 'page',		// Override parameters for single posts moved to the 'sidebar_position_ss_single'
						'section' => esc_html__( 'Widgets', 'briny' ),
					),
					'dependency' => array(
						'sidebar_position' => array( '^hide' ),
					),
					'std'      => 'below',
					'qsetup'   => esc_html__( 'General', 'briny' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets'               => array(
					'title'      => esc_html__( 'Sidebar widgets', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page',		// Override parameters for single posts moved to the 'sidebar_widgets_single'
						'section' => esc_html__( 'Widgets', 'briny' ),
					),
					'dependency' => array(
						'sidebar_position' => array( '^hide' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'briny' ),
					'type'       => 'select',
				),
				'sidebar_width'                 => array(
					'title'      => esc_html__( 'Sidebar width', 'briny' ),
					'desc'       => wp_kses_data( __( 'Width of the sidebar (in pixels). If empty - use default width', 'briny' ) ),
					'std'        => 340,
					'min'        => 150,
					'max'        => 500,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'sidebar',      // SASS variable's name to preview changes 'on fly'
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'slider',
				),
				'sidebar_gap'                   => array(
					'title'      => esc_html__( 'Sidebar gap', 'briny' ),
					'desc'       => wp_kses_data( __( 'Gap between content and sidebar (in pixels). If empty - use default gap', 'briny' ) ),
					'std'        => 30,
					'min'        => 0,
					'max'        => 100,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'gap',          // SASS variable's name to preview changes 'on fly'
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'slider',
				),
				'expand_content'                => array(
					'title'   => esc_html__( 'Expand content', 'briny' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'briny' ) ),
					'refresh' => false,
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'briny' ),
					),
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'general_widgets_info'          => array(
					'title' => esc_html__( 'Additional widgets', 'briny' ),
					'desc'  => '',
					'type'  => BRINY_THEME_FREE ? 'hidden' : 'info',
				),
				'widgets_above_page'            => array(
					'title'    => esc_html__( 'Widgets at the top of the page', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'briny' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'briny' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_above_content'         => array(
					'title'    => esc_html__( 'Widgets above the content', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'briny' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'briny' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_content'         => array(
					'title'    => esc_html__( 'Widgets below the content', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'briny' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'briny' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_page'            => array(
					'title'    => esc_html__( 'Widgets at the bottom of the page', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'briny' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'briny' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'select',
				),

				'general_effects_info'          => array(
					'title' => esc_html__( 'Design & Effects', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'border_radius'                 => array(
					'title'      => esc_html__( 'Border radius', 'briny' ),
					'desc'       => wp_kses_data( __( 'Specify the border radius of the form fields and buttons in pixels', 'briny' ) ),
					'std'        => 0,
					'min'        => 0,
					'max'        => 20,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'rad',      // SASS name to preview changes 'on fly'
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'slider',
				),

				'general_misc_info'             => array(
					'title' => esc_html__( 'Miscellaneous', 'briny' ),
					'desc'  => '',
					'type'  => BRINY_THEME_FREE ? 'hidden' : 'info',
				),
				'seo_snippets'                  => array(
					'title' => esc_html__( 'SEO snippets', 'briny' ),
					'desc'  => wp_kses_data( __( 'Add structured data markup to the single posts and pages', 'briny' ) ),
					'std'   => 0,
					'type'  => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),

				// 'Header'
				//---------------------------------------------
				'header'                        => array(
					'title'    => esc_html__( 'Header', 'briny' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 30,
					'type'     => 'section',
				),

				'header_style_info'             => array(
					'title' => esc_html__( 'Header style', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type'                   => array(
					'title'    => esc_html__( 'Header style', 'briny' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'briny' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'briny' ),
					),
					'std'      => 'default',
					'options'  => briny_get_list_header_footer_types(),
					'type'     => BRINY_THEME_FREE || ! briny_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'briny' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'briny' ), 'briny_kses_content' ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'briny' ),
					),
					'dependency' => array(
						'header_type' => array( 'custom' ),
					),
					'std'        => 'header-custom-elementor-header-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position'               => array(
					'title'    => esc_html__( 'Header position', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'briny' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'briny' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight'             => array(
					'title'    => esc_html__( 'Header fullheight', 'briny' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'briny' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'briny' ),
					),
					'std'      => 0,
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_wide'                   => array(
					'title'      => esc_html__( 'Header fullwidth', 'briny' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'briny' ),
					),
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'std'        => 1,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_zoom'                   => array(
					'title'   => esc_html__( 'Header zoom', 'briny' ),
					'desc'    => wp_kses_data( __( 'Zoom the header title. 1 - original size', 'briny' ) ),
					'std'     => 1,
					'min'     => 0.3,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => BRINY_THEME_FREE ? 'hidden' : 'slider',
				),

				'header_widgets_info'           => array(
					'title' => esc_html__( 'Header widgets', 'briny' ),
					'desc'  => wp_kses_data( __( 'Here you can place a widget slider, advertising banners, etc.', 'briny' ) ),
					'type'  => 'info',
				),
				'header_widgets'                => array(
					'title'    => esc_html__( 'Header widgets', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select set of widgets to show in the header on each page', 'briny' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'briny' ),
						'desc'    => wp_kses_data( __( 'Select set of widgets to show in the header on this page', 'briny' ) ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => 'select',
				),
				'header_columns'                => array(
					'title'      => esc_html__( 'Header columns', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'briny' ),
					),
					'dependency' => array(
						'header_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => briny_get_list_range( 0, 6 ),
					'type'       => 'select',
				),

				'menu_info'                     => array(
					'title' => esc_html__( 'Main menu', 'briny' ),
					'desc'  => wp_kses_data( __( 'Select main menu style, position and other parameters', 'briny' ) ),
					'type'  => BRINY_THEME_FREE ? 'hidden' : 'info',
				),
				'menu_style'                    => array(
					'title'    => esc_html__( 'Menu position', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select position of the main menu', 'briny' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'briny' ),
					),
					'std'      => 'top',
					'options'  => array(
						'top'   => esc_html__( 'Top', 'briny' ),
						'left'  => esc_html__( 'Left', 'briny' ),
						'right' => esc_html__( 'Right', 'briny' ),
					),
					'type'     => BRINY_THEME_FREE || ! briny_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'menu_side_stretch'             => array(
					'title'      => esc_html__( 'Stretch sidemenu', 'briny' ),
					'desc'       => wp_kses_data( __( 'Stretch sidemenu to window height (if menu items number >= 5)', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'briny' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 0,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_side_icons'               => array(
					'title'      => esc_html__( 'Iconed sidemenu', 'briny' ),
					'desc'       => wp_kses_data( __( 'Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'briny' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 1,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_mobile_fullscreen'        => array(
					'title' => esc_html__( 'Mobile menu fullscreen', 'briny' ),
					'desc'  => wp_kses_data( __( 'Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'briny' ) ),
					'std'   => 1,
					'type'  => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_image_info'             => array(
					'title' => esc_html__( 'Header image', 'briny' ),
					'desc'  => '',
					'type'  => BRINY_THEME_FREE ? 'hidden' : 'info',
				),
				'header_image_override'         => array(
					'title'    => esc_html__( 'Header image override', 'briny' ),
					'desc'     => wp_kses_data( __( "Allow override the header image with the page's/post's/product's/etc. featured image", 'briny' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'briny' ),
					),
					'std'      => 0,
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_mobile_info'            => array(
					'title'      => esc_html__( 'Mobile header', 'briny' ),
					'desc'       => wp_kses_data( __( 'Configure the mobile version of the header', 'briny' ) ),
					'priority'   => 500,
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'info',
				),
				'header_mobile_enabled'         => array(
					'title'      => esc_html__( 'Enable the mobile header', 'briny' ),
					'desc'       => wp_kses_data( __( 'Use the mobile version of the header (if checked) or relayout the current header on mobile devices', 'briny' ) ),
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_additional_info' => array(
					'title'      => esc_html__( 'Additional info', 'briny' ),
					'desc'       => wp_kses_data( __( 'Additional info to show at the top of the mobile header', 'briny' ) ),
					'std'        => '',
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'refresh'    => false,
					'teeny'      => false,
					'rows'       => 20,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'text_editor',
				),
				'header_mobile_hide_info'       => array(
					'title'      => esc_html__( 'Hide additional info', 'briny' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_logo'       => array(
					'title'      => esc_html__( 'Hide logo', 'briny' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_login'      => array(
					'title'      => esc_html__( 'Hide login/logout', 'briny' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_search'     => array(
					'title'      => esc_html__( 'Hide search', 'briny' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_cart'       => array(
					'title'      => esc_html__( 'Hide cart', 'briny' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),



				// 'Footer'
				//---------------------------------------------
				'footer'                        => array(
					'title'    => esc_html__( 'Footer', 'briny' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 50,
					'type'     => 'section',
				),
				'footer_type'                   => array(
					'title'    => esc_html__( 'Footer style', 'briny' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'briny' ) ),
					'override' => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'briny' ),
					),
					'std'      => 'default',
					'options'  => briny_get_list_header_footer_types(),
					'type'     => BRINY_THEME_FREE || ! briny_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'footer_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'briny' ),
					'desc'       => wp_kses( __( 'Select custom footer from Layouts Builder', 'briny' ), 'briny_kses_content' ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'briny' ),
					),
					'dependency' => array(
						'footer_type' => array( 'custom' ),
					),
					'std'        => 'main-footer',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_widgets'                => array(
					'title'      => esc_html__( 'Footer widgets', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'briny' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 'footer_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_columns'                => array(
					'title'      => esc_html__( 'Footer columns', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'briny' ),
					),
					'dependency' => array(
						'footer_type'    => array( 'default' ),
						'footer_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => briny_get_list_range( 0, 6 ),
					'type'       => 'select',
				),
				'footer_wide'                   => array(
					'title'      => esc_html__( 'Footer fullwidth', 'briny' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page,post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'briny' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'logo_in_footer'                => array(
					'title'      => esc_html__( 'Show logo', 'briny' ),
					'desc'       => wp_kses_data( __( 'Show logo in the footer', 'briny' ) ),
					'refresh'    => false,
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'logo_footer'                   => array(
					'title'      => esc_html__( 'Logo for footer', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo to display it in the footer', 'briny' ) ),
					'dependency' => array(
						'footer_type'    => array( 'default' ),
						'logo_in_footer' => array( 1 ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'logo_footer_retina'            => array(
					'title'      => esc_html__( 'Logo for footer (Retina)', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'briny' ) ),
					'dependency' => array(
						'footer_type'         => array( 'default' ),
						'logo_in_footer'      => array( 1 ),
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'image',
				),
				'socials_in_footer'             => array(
					'title'      => esc_html__( 'Show social icons', 'briny' ),
					'desc'       => wp_kses_data( __( 'Show social icons in the footer (under logo or footer widgets)', 'briny' ) ),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => ! briny_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'copyright'                     => array(
					'title'      => esc_html__( 'Copyright', 'briny' ),
					'desc'       => wp_kses_data( __( 'Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'briny' ) ),
					'translate'  => true,
					'std'        => esc_html__( 'AncoraThemes &copy; {Y}. All rights reserved.', 'briny' ),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'refresh'    => false,
					'type'       => 'textarea',
				),

				// 'Mobile version'
				//---------------------------------------------
				'mobile'                        => array(
					'title'    => esc_html__( 'Mobile', 'briny' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 55,
					'type'     => 'section',
				),

				'mobile_header_info'            => array(
					'title' => esc_html__( 'Header on the mobile device', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type_mobile'            => array(
					'title'    => esc_html__( 'Header style', 'briny' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use on mobile devices: the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'briny' ) ),
					'std'      => 'inherit',
					'options'  => briny_get_list_header_footer_types( true ),
					'type'     => BRINY_THEME_FREE || ! briny_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style_mobile'           => array(
					'title'      => esc_html__( 'Select custom layout', 'briny' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'briny' ), 'briny_kses_content' ),
					'dependency' => array(
						'header_type_mobile' => array( 'custom' ),
					),
					'std'        => 'inherit',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position_mobile'        => array(
					'title'    => esc_html__( 'Header position', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'briny' ) ),
					'std'      => 'inherit',
					'options'  => array(),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),

				'mobile_sidebar_info'           => array(
					'title' => esc_html__( 'Sidebar on the mobile device', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position_mobile'       => array(
					'title'    => esc_html__( 'Sidebar position on mobile', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar on mobile devices', 'briny' ) ),
					'std'      => 'inherit',
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets_mobile'        => array(
					'title'      => esc_html__( 'Sidebar widgets', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar on mobile devices', 'briny' ) ),
					'dependency' => array(
						'sidebar_position_mobile' => array( '^hide' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'expand_content_mobile'         => array(
					'title'   => esc_html__( 'Expand content', 'briny' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden on mobile devices', 'briny' ) ),
					'refresh' => false,
					'dependency' => array(
						'sidebar_position_mobile' => array( 'hide', 'inherit' ),
					),
					'std'     => 'inherit',
					'options'  => briny_get_list_checkbox_values( true ),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),

				'mobile_footer_info'           => array(
					'title' => esc_html__( 'Footer on the mobile device', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'footer_type_mobile'           => array(
					'title'    => esc_html__( 'Footer style', 'briny' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use on mobile devices: the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'briny' ) ),
					'std'      => 'inherit',
					'options'  => briny_get_list_header_footer_types(),
					'type'     => BRINY_THEME_FREE || ! briny_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'footer_style_mobile'          => array(
					'title'      => esc_html__( 'Select custom layout', 'briny' ),
					'desc'       => wp_kses( __( 'Select custom footer from Layouts Builder', 'briny' ), 'briny_kses_content' ),
					'dependency' => array(
						'footer_type_mobile' => array( 'custom' ),
					),
					'std'        => 'main-footer',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_widgets_mobile'        => array(
					'title'      => esc_html__( 'Footer widgets', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'briny' ) ),
					'dependency' => array(
						'footer_type_mobile' => array( 'default' ),
					),
					'std'        => 'footer_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_columns_mobile'        => array(
					'title'      => esc_html__( 'Footer columns', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'briny' ) ),
					'dependency' => array(
						'footer_type_mobile'    => array( 'default' ),
						'footer_widgets_mobile' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => briny_get_list_range( 0, 6 ),
					'type'       => 'select',
				),



				// 'Blog'
				//---------------------------------------------
				'blog'                          => array(
					'title'    => esc_html__( 'Blog', 'briny' ),
					'desc'     => wp_kses_data( __( 'Options of the the blog archive', 'briny' ) ),
					'priority' => 70,
					'type'     => 'panel',
				),


				// Blog - Posts page
				//---------------------------------------------
				'blog_general'                  => array(
					'title' => esc_html__( 'Posts page', 'briny' ),
					'desc'  => wp_kses_data( __( 'Style and components of the blog archive', 'briny' ) ),
					'type'  => 'section',
				),
				'blog_general_info'             => array(
					'title'  => esc_html__( 'Posts page settings', 'briny' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'briny' ),
					'type'   => 'info',
				),
				'blog_style'                    => array(
					'title'      => esc_html__( 'Blog style', 'briny' ),
					'desc'       => '',
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'std'        => 'excerpt',
					'qsetup'     => esc_html__( 'General', 'briny' ),
					'options'    => array(),
					'type'       => 'select',
				),
				'first_post_large'              => array(
					'title'      => esc_html__( 'First post large', 'briny' ),
					'desc'       => wp_kses_data( __( 'Make your first post stand out by making it bigger', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style' => array( 'classic', 'masonry' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'blog_content'                  => array(
					'title'      => esc_html__( 'Posts content', 'briny' ),
					'desc'       => wp_kses_data( __( 'Display either post excerpts or the full post content', 'briny' ) ),
					'std'        => 'excerpt',
					'dependency' => array(
						'blog_style' => array( 'excerpt' ),
					),
					'options'    => array(
						'excerpt'  => esc_html__( 'Excerpt', 'briny' ),
						'fullpost' => esc_html__( 'Full post', 'briny' ),
					),
					'type'       => 'switch',
				),
				'excerpt_length'                => array(
					'title'      => esc_html__( 'Excerpt length', 'briny' ),
					'desc'       => wp_kses_data( __( 'Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged', 'briny' ) ),
					'dependency' => array(
						'blog_style'   => array( 'excerpt' ),
						'blog_content' => array( 'excerpt' ),
					),
					'std'        => 12,
					'type'       => 'text',
				),
				'blog_columns'                  => array(
					'title'   => esc_html__( 'Blog columns', 'briny' ),
					'desc'    => wp_kses_data( __( 'How many columns should be used in the blog archive (from 2 to 4)?', 'briny' ) ),
					'std'     => 2,
					'options' => briny_get_list_range( 2, 4 ),
					'type'    => 'hidden',      // This options is available and must be overriden only for some modes (for example, 'shop')
				),
				'post_type'                     => array(
					'title'      => esc_html__( 'Post type', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select post type to show in the blog archive', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'linked'     => 'parent_cat',
					'refresh'    => false,
					'hidden'     => true,
					'std'        => 'post',
					'options'    => array(),
					'type'       => 'select',
				),
				'parent_cat'                    => array(
					'title'      => esc_html__( 'Category to show', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select category to show in the blog archive', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'refresh'    => false,
					'hidden'     => true,
					'std'        => '0',
					'options'    => array(),
					'type'       => 'select',
				),
				'posts_per_page'                => array(
					'title'      => esc_html__( 'Posts per page', 'briny' ),
					'desc'       => wp_kses_data( __( 'How many posts will be displayed on this page', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'hidden'     => true,
					'std'        => '',
					'type'       => 'text',
				),
				'blog_pagination'               => array(
					'title'      => esc_html__( 'Pagination style', 'briny' ),
					'desc'       => wp_kses_data( __( 'Show Older/Newest posts or Page numbers below the posts list', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'std'        => 'pages',
					'qsetup'     => esc_html__( 'General', 'briny' ),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'options'    => array(
						'pages'    => esc_html__( 'Page numbers', 'briny' ),
						'links'    => esc_html__( 'Older/Newest', 'briny' ),
						'more'     => esc_html__( 'Load more', 'briny' ),
						'infinite' => esc_html__( 'Infinite scroll', 'briny' ),
					),
					'type'       => 'select',
				),
				'blog_animation'                => array(
					'title'      => esc_html__( 'Animation for the posts', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'std'        => 'none',
					'options'    => array(),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'select',
				),
				'show_filters'                  => array(
					'title'      => esc_html__( 'Show filters', 'briny' ),
					'desc'       => wp_kses_data( __( 'Show categories as tabs to filter posts', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style'     => array( 'portfolio', 'gallery' ),
					),
					'hidden'     => true,
					'std'        => 0,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'open_full_post_in_blog'        => array(
					'title'      => esc_html__( 'Open full post in blog', 'briny' ),
					'desc'       => wp_kses_data( __( 'Allow to open the full version of the post directly in the blog feed. Attention! Applies only to 1 column layouts!', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'open_full_post_hide_author'    => array(
					'title'      => esc_html__( 'Hide author bio', 'briny' ),
					'desc'       => wp_kses_data( __( "Hide author bio after post content when open the full version of the post directly in the blog feed.", 'briny' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'open_full_post_in_blog' => array( 1 ),
					),
					'std'        => 1,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'open_full_post_hide_related'   => array(
					'title'      => esc_html__( 'Hide related posts', 'briny' ),
					'desc'       => wp_kses_data( __( "Hide related posts after post content when open the full version of the post directly in the blog feed.", 'briny' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'open_full_post_in_blog' => array( 1 ),
					),
					'std'        => 1,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'blog_header_info'              => array(
					'title' => esc_html__( 'Header', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type_blog'              => array(
					'title'    => esc_html__( 'Header style', 'briny' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'briny' ) ),
					'std'      => 'inherit',
					'options'  => briny_get_list_header_footer_types( true ),
					'type'     => BRINY_THEME_FREE || ! briny_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style_blog'             => array(
					'title'      => esc_html__( 'Select custom layout', 'briny' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'briny' ), 'briny_kses_content' ),
					'dependency' => array(
						'header_type_blog' => array( 'custom' ),
					),
					'std'        => 'inherit',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position_blog'          => array(
					'title'    => esc_html__( 'Header position', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'briny' ) ),
					'std'      => 'inherit',
					'options'  => array(),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight_blog'        => array(
					'title'    => esc_html__( 'Header fullheight', 'briny' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'briny' ) ),
					'std'      => 'inherit',
					'options'  => briny_get_list_checkbox_values( true ),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_wide_blog'              => array(
					'title'      => esc_html__( 'Header fullwidth', 'briny' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'briny' ) ),
					'dependency' => array(
						'header_type_blog' => array( 'default' ),
					),
					'std'      => 'inherit',
					'options'  => briny_get_list_checkbox_values( true ),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),

				'blog_sidebar_info'             => array(
					'title' => esc_html__( 'Sidebar', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position_blog'         => array(
					'title'   => esc_html__( 'Sidebar position', 'briny' ),
					'desc'    => wp_kses_data( __( 'Select position to show sidebar', 'briny' ) ),
					'std'     => 'inherit',
					'options' => array(),
					'qsetup'     => esc_html__( 'General', 'briny' ),
					'type'    => 'switch',
				),
				'sidebar_position_ss_blog'  => array(
					'title'    => esc_html__( 'Sidebar position on the small screen', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select position to move sidebar on the small screen - above or below the content', 'briny' ) ),
					'dependency' => array(
						'sidebar_position_blog' => array( '^hide' ),
					),
					'std'      => 'inherit',
					'qsetup'   => esc_html__( 'General', 'briny' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets_blog'          => array(
					'title'      => esc_html__( 'Sidebar widgets', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'briny' ) ),
					'dependency' => array(
						'sidebar_position_blog' => array( '^hide' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'briny' ),
					'type'       => 'select',
				),
				'expand_content_blog'           => array(
					'title'   => esc_html__( 'Expand content', 'briny' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'briny' ) ),
					'refresh' => false,
					'std'     => 'inherit',
					'options'  => briny_get_list_checkbox_values( true ),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),

				'blog_widgets_info'             => array(
					'title' => esc_html__( 'Additional widgets', 'briny' ),
					'desc'  => '',
					'type'  => BRINY_THEME_FREE ? 'hidden' : 'info',
				),
				'widgets_above_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the top of the page', 'briny' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'briny' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => BRINY_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_above_content_blog'    => array(
					'title'   => esc_html__( 'Widgets above the content', 'briny' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'briny' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => BRINY_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_content_blog'    => array(
					'title'   => esc_html__( 'Widgets below the content', 'briny' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'briny' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => BRINY_THEME_FREE ? 'hidden' : 'select',
				),
				'widgets_below_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the bottom of the page', 'briny' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'briny' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => BRINY_THEME_FREE ? 'hidden' : 'select',
				),

				'blog_advanced_info'            => array(
					'title' => esc_html__( 'Advanced settings', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'no_image'                      => array(
					'title' => esc_html__( 'Image placeholder', 'briny' ),
					'desc'  => wp_kses_data( __( 'Select or upload an image used as placeholder for posts without a featured image', 'briny' ) ),
					'std'   => '',
					'type'  => 'image',
				),
				'time_diff_before'              => array(
					'title' => esc_html__( 'Easy Readable Date Format', 'briny' ),
					'desc'  => wp_kses_data( __( "For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'briny' ) ),
					'std'   => 5,
					'type'  => 'text',
				),
				'sticky_style'                  => array(
					'title'   => esc_html__( 'Sticky posts style', 'briny' ),
					'desc'    => wp_kses_data( __( 'Select style of the sticky posts output', 'briny' ) ),
					'std'     => 'inherit',
					'options' => array(
						'inherit' => esc_html__( 'Decorated posts', 'briny' ),
						'columns' => esc_html__( 'Mini-cards', 'briny' ),
					),
					'type'    => BRINY_THEME_FREE ? 'hidden' : 'select',
				),
				'meta_parts'                    => array(
					'title'      => esc_html__( 'Post meta', 'briny' ),
					'desc'       => wp_kses_data( __( "If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page. Post counters and Share Links are available only if plugin ThemeREX Addons is active", 'briny' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'briny' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'categories=1|date=1|views=0|likes=0|comments=0|author=0|share=0|edit=0',
					'options'    => briny_get_list_meta_parts(),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checklist',
				),


				// Blog - Single posts
				//---------------------------------------------
				'blog_single'                   => array(
					'title' => esc_html__( 'Single posts', 'briny' ),
					'desc'  => wp_kses_data( __( 'Settings of the single post', 'briny' ) ),
					'type'  => 'section',
				),

				'blog_single_header_info'       => array(
					'title' => esc_html__( 'Header', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type_single'            => array(
					'title'    => esc_html__( 'Header style', 'briny' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'briny' ) ),
					'std'      => 'inherit',
					'options'  => briny_get_list_header_footer_types( true ),
					'type'     => BRINY_THEME_FREE || ! briny_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style_single'           => array(
					'title'      => esc_html__( 'Select custom layout', 'briny' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'briny' ), 'briny_kses_content' ),
					'dependency' => array(
						'header_type_single' => array( 'custom' ),
					),
					'std'        => 'inherit',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position_single'        => array(
					'title'    => esc_html__( 'Header position', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'briny' ) ),
					'std'      => 'inherit',
					'options'  => array(),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight_single'      => array(
					'title'    => esc_html__( 'Header fullheight', 'briny' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'briny' ) ),
					'std'      => 'inherit',
					'options'  => briny_get_list_checkbox_values( true ),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_wide_single'            => array(
					'title'      => esc_html__( 'Header fullwidth', 'briny' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'briny' ) ),
					'dependency' => array(
						'header_type_single' => array( 'default' ),
					),
					'std'      => 'inherit',
					'options'  => briny_get_list_checkbox_values( true ),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),

				'blog_single_sidebar_info'      => array(
					'title' => esc_html__( 'Sidebar', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position_single'       => array(
					'title'   => esc_html__( 'Sidebar position', 'briny' ),
					'desc'    => wp_kses_data( __( 'Select position to show sidebar on the single posts', 'briny' ) ),
					'std'     => 'right',
					'override'   => array(
						'mode'    => 'post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'briny' ),
					),
					'options' => array(),
					'type'    => 'switch',
				),
				'sidebar_position_ss_single'=> array(
					'title'    => esc_html__( 'Sidebar position on the small screen', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select position to move sidebar on the single posts on the small screen - above or below the content', 'briny' ) ),
					'override' => array(
						'mode'    => 'post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'briny' ),
					),
					'dependency' => array(
						'sidebar_position_single' => array( '^hide' ),
					),
					'std'      => 'below',
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets_single'        => array(
					'title'      => esc_html__( 'Sidebar widgets', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar on the single posts', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post,product,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'briny' ),
					),
					'dependency' => array(
						'sidebar_position_single' => array( '^hide' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'expand_content_single'           => array(
					'title'   => esc_html__( 'Expand content', 'briny' ),
					'desc'    => wp_kses_data( __( 'Expand the content width on the single posts if the sidebar is hidden', 'briny' ) ),
					'refresh' => false,
					'std'     => 'inherit',
					'options'  => briny_get_list_checkbox_values( true ),
					'type'     => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),

				'blog_single_title_info'      => array(
					'title' => esc_html__( 'Featured image and title', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'hide_featured_on_single'       => array(
					'title'    => esc_html__( 'Hide featured image on the single post', 'briny' ),
					'desc'     => wp_kses_data( __( "Hide featured image on the single post's pages", 'briny' ) ),
					'override' => array(
						'mode'    => 'page,post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'post_thumbnail_type'      => array(
					'title'      => esc_html__( 'Type of post thumbnail', 'briny' ),
					'desc'       => wp_kses_data( __( "Select type of post thumbnail on the single post's pages", 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'hide_featured_on_single' => array( 'is_empty', 0 ),
					),
					'std'        => 'default',
					'options'    => array(
						'fullwidth'   => esc_html__( 'Fullwidth', 'briny' ),
						'boxed'       => esc_html__( 'Boxed', 'briny' ),
						'default'     => esc_html__( 'Default', 'briny' ),
					),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'select',
				),
				'post_header_position'          => array(
					'title'      => esc_html__( 'Post header position', 'briny' ),
					'desc'       => wp_kses_data( __( "Select post header position on the single post's pages", 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'hide_featured_on_single' => array( 'is_empty', 0 )
					),
					'std'        => 'under',
					'options'    => array(
						'above'      => esc_html__( 'Above the post thumbnail', 'briny' ),
						'under'      => esc_html__( 'Under the post thumbnail', 'briny' ),
						'on_thumb'   => esc_html__( 'On the post thumbnail', 'briny' ),
						'default'    => esc_html__( 'Default', 'briny' ),
					),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'select',
				),
				'post_header_align'             => array(
					'title'      => esc_html__( 'Align of the post header', 'briny' ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'post_header_position' => array( 'on_thumb' ),
					),
					'std'        => 'mc',
					'options'    => array(
						'ts' => esc_html__('Top Stick Out', 'briny'),
						'tl' => esc_html__('Top Left', 'briny'),
						'tc' => esc_html__('Top Center', 'briny'),
						'tr' => esc_html__('Top Right', 'briny'),
						'ml' => esc_html__('Middle Left', 'briny'),
						'mc' => esc_html__('Middle Center', 'briny'),
						'mr' => esc_html__('Middle Right', 'briny'),
						'bl' => esc_html__('Bottom Left', 'briny'),
						'bc' => esc_html__('Bottom Center', 'briny'),
						'br' => esc_html__('Bottom Right', 'briny'),
						'bs' => esc_html__('Bottom Stick Out', 'briny'),
					),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'select',
				),
				'post_subtitle'                 => array(
					'title' => esc_html__( 'Post subtitle', 'briny' ),
					'desc'  => wp_kses_data( __( "Specify post subtitle to display it under the post title.", 'briny' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'std'   => '',
					'hidden' => true,
					'type'  => 'text',
				),
				'show_post_meta'                => array(
					'title' => esc_html__( 'Show post meta', 'briny' ),
					'desc'  => wp_kses_data( __( "Display block with post's meta: date, categories, counters, etc.", 'briny' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),
				'meta_parts_single'             => array(
					'title'      => esc_html__( 'Post meta', 'briny' ),
					'desc'       => wp_kses_data( __( 'Meta parts for single posts. Post counters and Share Links are available only if plugin ThemeREX Addons is active', 'briny' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'briny' ) ),
					'dependency' => array(
						'show_post_meta' => array( 1 ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'categories=1|date=1|views=0|likes=0|comments=0|author=0|share=0|edit=0',
					'options'    => briny_get_list_meta_parts(),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checklist',
				),
				'show_share_links'              => array(
					'title' => esc_html__( 'Show share links', 'briny' ),
					'desc'  => wp_kses_data( __( 'Display share links on the single post', 'briny' ) ),
					'std'   => 1,
					'type'  => ! briny_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'show_author_info'              => array(
					'title' => esc_html__( 'Show author info', 'briny' ),
					'desc'  => wp_kses_data( __( "Display block with information about post's author", 'briny' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),

				'blog_single_related_info'      => array(
					'title' => esc_html__( 'Related posts', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'show_related_posts'            => array(
					'title'    => esc_html__( 'Show related posts', 'briny' ),
					'desc'     => wp_kses_data( __( "Show section 'Related posts' on the single post's pages", 'briny' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'std'      => 1,
					'type'     => 'checkbox',
				),
				'related_style'                 => array(
					'title'      => esc_html__( 'Related posts style', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select style of the related posts output', 'briny' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 'classic',
					'options'    => array(
						'modern'  => esc_html__( 'Modern', 'briny' ),
						'classic' => esc_html__( 'Classic', 'briny' ),
						'wide'    => esc_html__( 'Wide', 'briny' ),
						'list'    => esc_html__( 'List', 'briny' ),
						'short'   => esc_html__( 'Short', 'briny' ),
					),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_position'              => array(
					'title'      => esc_html__( 'Related posts position', 'briny' ),
					'desc'       => wp_kses_data( __( 'Select position to display the related posts', 'briny' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 'below_content',
					'options'    => array (
						'inside'        => esc_html__( 'Inside the content (fullwidth)', 'briny' ),
						'inside_left'   => esc_html__( 'At left side of the content', 'briny' ),
						'inside_right'  => esc_html__( 'At right side of the content', 'briny' ),
						'below_content' => esc_html__( 'After the content', 'briny' ),
						'below_page'    => esc_html__( 'After the content & sidebar', 'briny' ),
					),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'select',
				),
				'related_position_inside'       => array(
					'title'      => esc_html__( 'Before # paragraph', 'briny' ),
					'desc'       => wp_kses_data( __( 'Before what paragraph should related posts appear? If 0 - randomly.', 'briny' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_position' => array( 'inside', 'inside_left', 'inside_right' ),
					),
					'std'        => 2,
					'options'    => briny_get_list_range( 0, 9 ),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'select',
				),
				'related_posts'                 => array(
					'title'      => esc_html__( 'Related posts', 'briny' ),
					'desc'       => wp_kses_data( __( 'How many related posts should be displayed in the single post? If 0 - no related posts are shown.', 'briny' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'min'        => 1,
					'max'        => 9,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'slider',
				),
				'related_columns'               => array(
					'title'      => esc_html__( 'Related columns', 'briny' ),
					'desc'       => wp_kses_data( __( 'How many columns should be used to output related posts in the single page?', 'briny' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_position' => array( 'inside', 'below_content', 'below_page' ),
					),
					'std'        => 2,
					'options'    => briny_get_list_range( 1, 6 ),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_slider'                => array(
					'title'      => esc_html__( 'Use slider layout', 'briny' ),
					'desc'       => wp_kses_data( __( 'Use slider layout in case related posts count is more than columns count', 'briny' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 0,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'related_slider_controls'       => array(
					'title'      => esc_html__( 'Slider controls', 'briny' ),
					'desc'       => wp_kses_data( __( 'Show arrows in the slider', 'briny' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'none',
					'options'    => array(
						'none'    => esc_html__('None', 'briny'),
						'side'    => esc_html__('Side', 'briny'),
						'outside' => esc_html__('Outside', 'briny'),
						'top'     => esc_html__('Top', 'briny'),
						'bottom'  => esc_html__('Bottom', 'briny')
					),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'select',
				),
				'related_slider_pagination'       => array(
					'title'      => esc_html__( 'Slider pagination', 'briny' ),
					'desc'       => wp_kses_data( __( 'Show bullets after the slider', 'briny' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'bottom',
					'options'    => array(
						'none'    => esc_html__('None', 'briny'),
						'bottom'  => esc_html__('Bottom', 'briny')
					),
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_slider_space'          => array(
					'title'      => esc_html__( 'Space', 'briny' ),
					'desc'       => wp_kses_data( __( 'Space between slides', 'briny' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'briny' ),
					),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 30,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'text',
				),
				'posts_navigation_info'      => array(
					'title' => esc_html__( 'Posts navigation', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'posts_navigation'           => array(
					'title'   => esc_html__( 'Show posts navigation', 'briny' ),
					'desc'    => wp_kses_data( __( "Show posts navigation on the single post's pages", 'briny' ) ),
					'std'     => 'links',
					'options' => array(
						'none'   => esc_html__('None', 'briny'),
						'links'  => esc_html__('Prev/Next links', 'briny'),
						'scroll' => esc_html__('Infinite scroll', 'briny')
					),
					'type'    => BRINY_THEME_FREE ? 'hidden' : 'switch',
				),
				'posts_navigation_fixed'     => array(
					'title'      => esc_html__( 'Fixed posts navigation', 'briny' ),
					'desc'       => wp_kses_data( __( "Make posts navigation fixed position. Display it when the content of the article is inside the window.", 'briny' ) ),
					'dependency' => array(
						'posts_navigation' => array( 'links' ),
					),
					'std'        => 0,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'posts_navigation_scroll_hide_author'  => array(
					'title'      => esc_html__( 'Hide author bio', 'briny' ),
					'desc'       => wp_kses_data( __( "Hide author bio after post content when infinite scroll is used.", 'briny' ) ),
					'dependency' => array(
						'posts_navigation' => array( 'scroll' ),
					),
					'std'        => 0,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'posts_navigation_scroll_hide_related'  => array(
					'title'      => esc_html__( 'Hide related posts', 'briny' ),
					'desc'       => wp_kses_data( __( "Hide related posts after post content when infinite scroll is used.", 'briny' ) ),
					'dependency' => array(
						'posts_navigation' => array( 'scroll' ),
					),
					'std'        => 0,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'posts_navigation_scroll_hide_comments' => array(
					'title'      => esc_html__( 'Hide comments', 'briny' ),
					'desc'       => wp_kses_data( __( "Hide comments after post content when infinite scroll is used.", 'briny' ) ),
					'dependency' => array(
						'posts_navigation' => array( 'scroll' ),
					),
					'std'        => 1,
					'type'       => BRINY_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'posts_banners_info'      => array(
					'title' => esc_html__( 'Posts banners', 'briny' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_banner_link'     => array(
					'title' => esc_html__( 'Header banner link', 'briny' ),
					'desc'  => wp_kses_data( __( 'Insert URL of the banner', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'briny' ),
					),
					'std'   => '',
					'type'  => 'text',
				),
				'header_banner_img'     => array(
					'title' => esc_html__( 'Header banner image', 'briny' ),
					'desc'  => wp_kses_data( __( 'Select image to display at the backgound', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'briny' ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'header_banner_height'  => array(
					'title' => esc_html__( 'Header banner height', 'briny' ),
					'desc'  => wp_kses_data( __( 'Specify minimal height of the banner (in "px" or "em"). For example: 15em', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'briny' ),
					),
					'std'        => '',
					'type'       => 'text',
				),
				'header_banner_code'     => array(
					'title'      => esc_html__( 'Header banner code', 'briny' ),
					'desc'       => wp_kses_data( __( 'Embed html code', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'briny' ),
					),
					'std'        => '',
					'allow_html' => true,
					'type'       => 'textarea',
				),
				'footer_banner_link'     => array(
					'title' => esc_html__( 'Footer banner link', 'briny' ),
					'desc'  => wp_kses_data( __( 'Insert URL of the banner', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'briny' ),
					),
					'std'   => '',
					'type'  => 'text',
				),
				'footer_banner_img'     => array(
					'title' => esc_html__( 'Footer banner image', 'briny' ),
					'desc'  => wp_kses_data( __( 'Select image to display at the backgound', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'briny' ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'footer_banner_height'  => array(
					'title' => esc_html__( 'Footer banner height', 'briny' ),
					'desc'  => wp_kses_data( __( 'Specify minimal height of the banner (in "px" or "em"). For example: 15em', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'briny' ),
					),
					'std'        => '',
					'type'       => 'text',
				),
				'footer_banner_code'     => array(
					'title'      => esc_html__( 'Footer banner code', 'briny' ),
					'desc'       => wp_kses_data( __( 'Embed html code', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'briny' ),
					),
					'std'        => '',
					'allow_html' => true,
					'type'       => 'textarea',
				),
				'sidebar_banner_link'     => array(
					'title' => esc_html__( 'Sidebar banner link', 'briny' ),
					'desc'  => wp_kses_data( __( 'Insert URL of the banner', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'briny' ),
					),
					'std'   => '',
					'type'  => 'text',
				),
				'sidebar_banner_img'     => array(
					'title' => esc_html__( 'Sidebar banner image', 'briny' ),
					'desc'  => wp_kses_data( __( 'Select image to display at the backgound', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'briny' ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'sidebar_banner_code'     => array(
					'title'      => esc_html__( 'Sidebar banner code', 'briny' ),
					'desc'       => wp_kses_data( __( 'Embed html code', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'briny' ),
					),
					'std'        => '',
					'allow_html' => true,
					'type'       => 'textarea',
				),
				'background_banner_link'     => array(
					'title' => esc_html__( "Post's background banner link", 'briny' ),
					'desc'  => wp_kses_data( __( 'Insert URL of the banner', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'briny' ),
					),
					'std'   => '',
					'type'  => 'text',
				),
				'background_banner_img'     => array(
					'title' => esc_html__( "Post's background banner image", 'briny' ),
					'desc'  => wp_kses_data( __( 'Select image to display at the backgound', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'briny' ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'background_banner_code'     => array(
					'title'      => esc_html__( "Post's background banner code", 'briny' ),
					'desc'       => wp_kses_data( __( 'Embed html code', 'briny' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Banners', 'briny' ),
					),
					'std'        => '',
					'allow_html' => true,
					'type'       => 'textarea',
				),
				'blog_end'                      => array(
					'type' => 'panel_end',
				),



				// 'Colors'
				//---------------------------------------------
				'panel_colors'                  => array(
					'title'    => esc_html__( 'Colors', 'briny' ),
					'desc'     => '',
					'priority' => 300,
					'type'     => 'section',
				),

				'color_schemes_info'            => array(
					'title'  => esc_html__( 'Color schemes', 'briny' ),
					'desc'   => wp_kses_data( __( 'Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'briny' ) ),
					'hidden' => $hide_schemes,
					'type'   => 'info',
				),
				'color_scheme'                  => array(
					'title'    => esc_html__( 'Site Color Scheme', 'briny' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'briny' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'header_scheme'                 => array(
					'title'    => esc_html__( 'Header Color Scheme', 'briny' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'briny' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'menu_scheme'                   => array(
					'title'    => esc_html__( 'Sidemenu Color Scheme', 'briny' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'briny' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes || BRINY_THEME_FREE ? 'hidden' : 'switch',
				),
				'sidebar_scheme'                => array(
					'title'    => esc_html__( 'Sidebar Color Scheme', 'briny' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'briny' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'footer_scheme'                 => array(
					'title'    => esc_html__( 'Footer Color Scheme', 'briny' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'briny' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),

				'color_scheme_editor_info'      => array(
					'title' => esc_html__( 'Color scheme editor', 'briny' ),
					'desc'  => wp_kses_data( __( 'Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'briny' ) ),
					'type'  => 'info',
				),
				'scheme_storage'                => array(
					'title'       => esc_html__( 'Color scheme editor', 'briny' ),
					'desc'        => '',
					'std'         => '$briny_get_scheme_storage',
					'refresh'     => false,
					'colorpicker' => 'tiny',
					'type'        => 'scheme_editor',
				),

				// Internal options.
				// Attention! Don't change any options in the section below!
				// Use huge priority to call render this elements after all options!
				'reset_options'                 => array(
					'title'    => '',
					'desc'     => '',
					'std'      => '0',
					'priority' => 10000,
					'type'     => 'hidden',
				),

				'last_option'                   => array(     // Need to manually call action to include Tiny MCE scripts
					'title' => '',
					'desc'  => '',
					'std'   => 1,
					'type'  => 'hidden',
				),

			)
		);



		// Prepare panel 'Fonts'
		// -------------------------------------------------------------
		$fonts = array(

			// 'Fonts'
			//---------------------------------------------
			'fonts'             => array(
				'title'    => esc_html__( 'Typography', 'briny' ),
				'desc'     => '',
				'priority' => 200,
				'type'     => 'panel',
			),

			// Fonts - Load_fonts
			'load_fonts'        => array(
				'title' => esc_html__( 'Load fonts', 'briny' ),
				'desc'  => wp_kses_data( __( 'Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'briny' ) )
						. '<br>'
						. wp_kses_data( __( 'Attention! Press "Refresh" button to reload preview area after the all fonts are changed', 'briny' ) ),
				'type'  => 'section',
			),
			'load_fonts_subset' => array(
				'title'   => esc_html__( 'Google fonts subsets', 'briny' ),
				'desc'    => wp_kses_data( __( 'Specify comma separated list of the subsets which will be load from Google fonts', 'briny' ) )
						. '<br>'
						. wp_kses_data( __( 'Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'briny' ) ),
				'class'   => 'briny_column-1_3 briny_new_row',
				'refresh' => false,
				'std'     => '$briny_get_load_fonts_subset',
				'type'    => 'text',
			),
		);

		for ( $i = 1; $i <= briny_get_theme_setting( 'max_load_fonts' ); $i++ ) {
			if ( briny_get_value_gp( 'page' ) != 'theme_options' ) {
				$fonts[ "load_fonts-{$i}-info" ] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					'title' => esc_html( sprintf( __( 'Font %s', 'briny' ), $i ) ),
					'desc'  => '',
					'type'  => 'info',
				);
			}
			$fonts[ "load_fonts-{$i}-name" ]   = array(
				'title'   => esc_html__( 'Font name', 'briny' ),
				'desc'    => '',
				'class'   => 'briny_column-1_3 briny_new_row',
				'refresh' => false,
				'std'     => '$briny_get_load_fonts_option',
				'type'    => 'text',
			);
			$fonts[ "load_fonts-{$i}-family" ] = array(
				'title'   => esc_html__( 'Font family', 'briny' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Select font family to use it if font above is not available', 'briny' ) )
							: '',
				'class'   => 'briny_column-1_3',
				'refresh' => false,
				'std'     => '$briny_get_load_fonts_option',
				'options' => array(
					'inherit'    => esc_html__( 'Inherit', 'briny' ),
					'serif'      => esc_html__( 'serif', 'briny' ),
					'sans-serif' => esc_html__( 'sans-serif', 'briny' ),
					'monospace'  => esc_html__( 'monospace', 'briny' ),
					'cursive'    => esc_html__( 'cursive', 'briny' ),
					'fantasy'    => esc_html__( 'fantasy', 'briny' ),
				),
				'type'    => 'select',
			);
			$fonts[ "load_fonts-{$i}-styles" ] = array(
				'title'   => esc_html__( 'Font styles', 'briny' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'briny' ) )
								. '<br>'
								. wp_kses_data( __( 'Attention! Each weight and style increase download size! Specify only used weights and styles.', 'briny' ) )
							: '',
				'class'   => 'briny_column-1_3',
				'refresh' => false,
				'std'     => '$briny_get_load_fonts_option',
				'type'    => 'text',
			);
		}
		$fonts['load_fonts_end'] = array(
			'type' => 'section_end',
		);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = briny_get_theme_fonts();
		foreach ( $theme_fonts as $tag => $v ) {
			$fonts[ "{$tag}_section" ] = array(
				'title' => ! empty( $v['title'] )
								? $v['title']
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html( sprintf( __( '%s settings', 'briny' ), $tag ) ),
				'desc'  => ! empty( $v['description'] )
								? $v['description']
								// Translators: Add tag's name to make description
								: wp_kses( sprintf( __( 'Font settings of the "%s" tag.', 'briny' ), $tag ), 'briny_kses_content' ),
				'type'  => 'section',
			);

			foreach ( $v as $css_prop => $css_value ) {
				if ( in_array( $css_prop, array( 'title', 'description' ) ) ) {
					continue;
				}
				$options    = '';
				$type       = 'text';
				$load_order = 1;
				$title      = ucfirst( str_replace( '-', ' ', $css_prop ) );
				if ( 'font-family' == $css_prop ) {
					$type       = 'select';
					$options    = array();
					$load_order = 2;        // Load this option's value after all options are loaded (use option 'load_fonts' to build fonts list)
				} elseif ( 'font-weight' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'briny' ),
						'100'     => esc_html__( '100 (Light)', 'briny' ),
						'200'     => esc_html__( '200 (Light)', 'briny' ),
						'300'     => esc_html__( '300 (Thin)', 'briny' ),
						'400'     => esc_html__( '400 (Normal)', 'briny' ),
						'500'     => esc_html__( '500 (Semibold)', 'briny' ),
						'600'     => esc_html__( '600 (Semibold)', 'briny' ),
						'700'     => esc_html__( '700 (Bold)', 'briny' ),
						'800'     => esc_html__( '800 (Black)', 'briny' ),
						'900'     => esc_html__( '900 (Black)', 'briny' ),
					);
				} elseif ( 'font-style' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'briny' ),
						'normal'  => esc_html__( 'Normal', 'briny' ),
						'italic'  => esc_html__( 'Italic', 'briny' ),
					);
				} elseif ( 'text-decoration' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'      => esc_html__( 'Inherit', 'briny' ),
						'none'         => esc_html__( 'None', 'briny' ),
						'underline'    => esc_html__( 'Underline', 'briny' ),
						'overline'     => esc_html__( 'Overline', 'briny' ),
						'line-through' => esc_html__( 'Line-through', 'briny' ),
					);
				} elseif ( 'text-transform' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'    => esc_html__( 'Inherit', 'briny' ),
						'none'       => esc_html__( 'None', 'briny' ),
						'uppercase'  => esc_html__( 'Uppercase', 'briny' ),
						'lowercase'  => esc_html__( 'Lowercase', 'briny' ),
						'capitalize' => esc_html__( 'Capitalize', 'briny' ),
					);
				}
				$fonts[ "{$tag}_{$css_prop}" ] = array(
					'title'      => $title,
					'desc'       => '',
					'class'      => 'briny_column-1_5',
					'refresh'    => false,
					'load_order' => $load_order,
					'std'        => '$briny_get_theme_fonts_option',
					'options'    => $options,
					'type'       => $type,
				);
			}

			$fonts[ "{$tag}_section_end" ] = array(
				'type' => 'section_end',
			);
		}

		$fonts['fonts_end'] = array(
			'type' => 'panel_end',
		);

		// Add fonts parameters to Theme Options
		briny_storage_set_array_before( 'options', 'panel_colors', $fonts );

		// Add Header Video if WP version < 4.7
		// -----------------------------------------------------
		if ( ! function_exists( 'get_header_video_url' ) ) {
			briny_storage_set_array_after(
				'options', 'header_image_override', 'header_video', array(
					'title'    => esc_html__( 'Header video', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select video to use it as background for the header', 'briny' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'briny' ),
					),
					'std'      => '',
					'type'     => 'video',
				)
			);
		}

		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is not 'Customize'
		// ------------------------------------------------------
		if ( ! function_exists( 'the_custom_logo' ) || ! briny_check_url( 'customize.php' ) ) {
			briny_storage_set_array_before(
				'options', 'logo_retina', function_exists( 'the_custom_logo' ) ? 'custom_logo' : 'logo', array(
					'title'    => esc_html__( 'Logo', 'briny' ),
					'desc'     => wp_kses_data( __( 'Select or upload the site logo', 'briny' ) ),
					'class'    => 'briny_column-1_2 briny_new_row',
					'priority' => 60,
					'std'      => '',
					'qsetup'   => esc_html__( 'General', 'briny' ),
					'type'     => 'image',
				)
			);
		}

	}
}


// Returns a list of options that can be overridden for CPT
if ( ! function_exists( 'briny_options_get_list_cpt_options' ) ) {
	function briny_options_get_list_cpt_options( $cpt, $title = '' ) {
		if ( empty( $title ) ) {
			$title = ucfirst( $cpt );
		}
		return array(
			"content_info_{$cpt}"           => array(
				'title' => esc_html__( 'Content', 'briny' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"body_style_{$cpt}"             => array(
				'title'    => esc_html__( 'Body style', 'briny' ),
				'desc'     => wp_kses_data( __( 'Select width of the body content', 'briny' ) ),
				'std'      => 'inherit',
				'options'  => briny_get_list_body_styles( true ),
				'type'     => 'select',
			),
			"boxed_bg_image_{$cpt}"         => array(
				'title'      => esc_html__( 'Boxed bg image', 'briny' ),
				'desc'       => wp_kses_data( __( 'Select or upload image, used as background in the boxed body', 'briny' ) ),
				'dependency' => array(
					"body_style_{$cpt}" => array( 'boxed' ),
				),
				'std'        => 'inherit',
				'type'       => 'image',
			),
			"header_info_{$cpt}"            => array(
				'title' => esc_html__( 'Header', 'briny' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"header_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Header style', 'briny' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'briny' ) ),
				'std'     => 'inherit',
				'options' => briny_get_list_header_footer_types( true ),
				'type'    => BRINY_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'briny' ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select custom layout to display the site header on the %s pages', 'briny' ), $title ) ),
				'dependency' => array(
					"header_type_{$cpt}" => array( 'custom' ),
				),
				'std'        => 'inherit',
				'options'    => array(),
				'type'       => BRINY_THEME_FREE ? 'hidden' : 'select',
			),
			"header_position_{$cpt}"        => array(
				'title'   => esc_html__( 'Header position', 'briny' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to display the site header on the %s pages', 'briny' ), $title ) ),
				'std'     => 'inherit',
				'options' => array(),
				'type'    => BRINY_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_image_override_{$cpt}"  => array(
				'title'   => esc_html__( 'Header image override', 'briny' ),
				'desc'    => wp_kses_data( __( "Allow override the header image with the post's featured image", 'briny' ) ),
				'std'     => 'inherit',
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'briny' ),
					1         => esc_html__( 'Yes', 'briny' ),
					0         => esc_html__( 'No', 'briny' ),
				),
				'type'    => BRINY_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_widgets_{$cpt}"         => array(
				'title'   => esc_html__( 'Header widgets', 'briny' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select set of widgets to show in the header on the %s pages', 'briny' ), $title ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => 'select',
			),

			"sidebar_info_{$cpt}"           => array(
				'title' => esc_html__( 'Sidebar', 'briny' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"sidebar_position_{$cpt}"       => array(
				'title'   => sprintf( esc_html__( 'Sidebar position on the %s list', 'briny' ), $title ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to show sidebar on the %s list', 'briny' ), $title ) ),
				'std'     => 'left',
				'options' => array(),
				'type'    => 'switch',
			),
			"sidebar_position_ss_{$cpt}"=> array(
				'title'    => sprintf( esc_html__( 'Sidebar position on the %s list on the small screen', 'briny' ), $title ),
				'desc'     => wp_kses_data( __( 'Select position to move sidebar on the small screen - above or below the content', 'briny' ) ),
				'std'      => 'below',
				'dependency' => array(
					"sidebar_position_{$cpt}" => array( '^hide' ),
				),
				'options'  => array(),
				'type'     => 'switch',
			),
			"sidebar_widgets_{$cpt}"        => array(
				'title'      => sprintf( esc_html__( 'Sidebar widgets on the %s list', 'briny' ), $title ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select sidebar to show on the %s list', 'briny' ), $title ) ),
				'dependency' => array(
					"sidebar_position_{$cpt}" => array( '^hide' ),
				),
				'std'        => 'left',
				'options'    => array(),
				'type'       => 'select',
			),
			"sidebar_position_single_{$cpt}"       => array(
				'title'   => sprintf( esc_html__( 'Sidebar position on the single post', 'briny' ), $title ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to show sidebar on the single posts of the %s', 'briny' ), $title ) ),
				'std'     => 'left',
				'options' => array(),
				'type'    => 'switch',
			),
			"sidebar_position_ss_single_{$cpt}"=> array(
				'title'    => esc_html__( 'Sidebar position on the single post on the small screen', 'briny' ),
				'desc'     => wp_kses_data( __( 'Select position to move sidebar on the small screen - above or below the content', 'briny' ) ),
				'dependency' => array(
					"sidebar_position_single_{$cpt}" => array( '^hide' ),
				),
				'std'      => 'below',
				'options'  => array(),
				'type'     => 'switch',
			),
			"sidebar_widgets_single_{$cpt}"        => array(
				'title'      => sprintf( esc_html__( 'Sidebar widgets on the single post', 'briny' ), $title ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select widgets to show in the sidebar on the single posts of the %s', 'briny' ), $title ) ),
				'dependency' => array(
					"sidebar_position_single_{$cpt}" => array( '^hide' ),
				),
				'std'        => 'hide',
				'options'    => array(),
				'type'       => 'select',
			),
			"expand_content_{$cpt}"         => array(
				'title'   => esc_html__( 'Expand content', 'briny' ),
				'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'briny' ) ),
				'refresh' => false,
				'std'     => 'inherit',
				'options'  => briny_get_list_checkbox_values( true ),
				'type'     => BRINY_THEME_FREE ? 'hidden' : 'switch',
			),
			"expand_content_single_{$cpt}"         => array(
				'title'   => esc_html__( 'Expand content on the single post', 'briny' ),
				'desc'    => wp_kses_data( __( 'Expand the content width on the single post if the sidebar is hidden', 'briny' ) ),
				'refresh' => false,
				'std'     => 'inherit',
				'options'  => briny_get_list_checkbox_values( true ),
				'type'     => BRINY_THEME_FREE ? 'hidden' : 'switch',
			),

			"footer_info_{$cpt}"            => array(
				'title' => esc_html__( 'Footer', 'briny' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"footer_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Footer style', 'briny' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'briny' ) ),
				'std'     => 'inherit',
				'options' => briny_get_list_header_footer_types( true ),
				'type'    => BRINY_THEME_FREE ? 'hidden' : 'switch',
			),
			"footer_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'briny' ),
				'desc'       => wp_kses_data( __( 'Select custom layout to display the site footer', 'briny' ) ),
				'std'        => 'inherit',
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'custom' ),
				),
				'options'    => array(),
				'type'       => BRINY_THEME_FREE ? 'hidden' : 'select',
			),
			"footer_widgets_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer widgets', 'briny' ),
				'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'briny' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default' ),
				),
				'std'        => 'footer_widgets',
				'options'    => array(),
				'type'       => 'select',
			),
			"footer_columns_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer columns', 'briny' ),
				'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'briny' ) ),
				'dependency' => array(
					"footer_type_{$cpt}"    => array( 'default' ),
					"footer_widgets_{$cpt}" => array( '^hide' ),
				),
				'std'        => 0,
				'options'    => briny_get_list_range( 0, 6 ),
				'type'       => 'select',
			),
			"footer_wide_{$cpt}"            => array(
				'title'      => esc_html__( 'Footer fullwidth', 'briny' ),
				'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'briny' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default' ),
				),
				'std'        => 0,
				'type'       => 'checkbox',
			),

			"widgets_info_{$cpt}"           => array(
				'title' => esc_html__( 'Additional panels', 'briny' ),
				'desc'  => '',
				'type'  => BRINY_THEME_FREE ? 'hidden' : 'info',
			),
			"widgets_above_page_{$cpt}"     => array(
				'title'   => esc_html__( 'Widgets at the top of the page', 'briny' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'briny' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => BRINY_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_above_content_{$cpt}"  => array(
				'title'   => esc_html__( 'Widgets above the content', 'briny' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'briny' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => BRINY_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_below_content_{$cpt}"  => array(
				'title'   => esc_html__( 'Widgets below the content', 'briny' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'briny' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => BRINY_THEME_FREE ? 'hidden' : 'select',
			),
			"widgets_below_page_{$cpt}"     => array(
				'title'   => esc_html__( 'Widgets at the bottom of the page', 'briny' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'briny' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => BRINY_THEME_FREE ? 'hidden' : 'select',
			),
		);
	}
}


// Return lists with choises when its need in the admin mode
if ( ! function_exists( 'briny_options_get_list_choises' ) ) {
	add_filter( 'briny_filter_options_get_list_choises', 'briny_options_get_list_choises', 10, 2 );
	function briny_options_get_list_choises( $list, $id ) {
		if ( is_array( $list ) && count( $list ) == 0 ) {
			if ( strpos( $id, 'header_style' ) === 0 ) {
				$list = briny_get_list_header_styles( strpos( $id, 'header_style_' ) === 0 );
			} elseif ( strpos( $id, 'header_position' ) === 0 ) {
				$list = briny_get_list_header_positions( strpos( $id, 'header_position_' ) === 0 );
			} elseif ( strpos( $id, 'header_widgets' ) === 0 ) {
				$list = briny_get_list_sidebars( strpos( $id, 'header_widgets_' ) === 0, true );
			} elseif ( strpos( $id, '_scheme' ) > 0 ) {
				$list = briny_get_list_schemes( 'color_scheme' != $id );
			} elseif ( strpos( $id, 'sidebar_widgets' ) === 0 ) {
				$list = briny_get_list_sidebars( 'sidebar_widgets_single' != $id && ( strpos( $id, 'sidebar_widgets_' ) === 0 || strpos( $id, 'sidebar_widgets_single_' ) === 0 ), true );
			} elseif ( strpos( $id, 'sidebar_position_ss' ) === 0 ) {
				$list = briny_get_list_sidebars_positions_ss( strpos( $id, 'sidebar_position_ss_' ) === 0 );
			} elseif ( strpos( $id, 'sidebar_position' ) === 0 ) {
				$list = briny_get_list_sidebars_positions( strpos( $id, 'sidebar_position_' ) === 0 );
			} elseif ( strpos( $id, 'widgets_above_page' ) === 0 ) {
				$list = briny_get_list_sidebars( strpos( $id, 'widgets_above_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_above_content' ) === 0 ) {
				$list = briny_get_list_sidebars( strpos( $id, 'widgets_above_content_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_page' ) === 0 ) {
				$list = briny_get_list_sidebars( strpos( $id, 'widgets_below_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_content' ) === 0 ) {
				$list = briny_get_list_sidebars( strpos( $id, 'widgets_below_content_' ) === 0, true );
			} elseif ( strpos( $id, 'footer_style' ) === 0 ) {
				$list = briny_get_list_footer_styles( strpos( $id, 'footer_style_' ) === 0 );
			} elseif ( strpos( $id, 'footer_widgets' ) === 0 ) {
				$list = briny_get_list_sidebars( strpos( $id, 'footer_widgets_' ) === 0, true );
			} elseif ( strpos( $id, 'blog_style' ) === 0 ) {
				$list = briny_get_list_blog_styles( strpos( $id, 'blog_style_' ) === 0 );
			} elseif ( strpos( $id, 'post_type' ) === 0 ) {
				$list = briny_get_list_posts_types();
			} elseif ( strpos( $id, 'parent_cat' ) === 0 ) {
				$list = briny_array_merge( array( 0 => esc_html__( '- Select category -', 'briny' ) ), briny_get_list_categories() );
			} elseif ( strpos( $id, 'blog_animation' ) === 0 ) {
				$list = briny_get_list_animations_in();
			} elseif ( 'color_scheme_editor' == $id ) {
				$list = briny_get_list_schemes();
			} elseif ( strpos( $id, '_font-family' ) > 0 ) {
				$list = briny_get_list_load_fonts( true );
			}
		}
		return $list;
	}
}
