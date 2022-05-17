<?php
// Add plugin-specific vars to the custom CSS
if ( ! function_exists( 'briny_elm_add_theme_vars' ) ) {
	add_filter( 'briny_filter_add_theme_vars', 'briny_elm_add_theme_vars', 10, 2 );
	function briny_elm_add_theme_vars( $rez, $vars ) {
		foreach ( array( 10, 20, 30, 40, 60 ) as $m ) {
			if ( substr( $vars['page'], 0, 2 ) != '{{' ) {
				$rez[ "page{$m}" ]    = ( $vars['page'] + $m ) . 'px';
				$rez[ "content{$m}" ] = ( $vars['page'] - $vars['gap'] - $vars['sidebar'] + $m ) . 'px';
			} else {
				$rez[ "page{$m}" ]    = "{{ data.page{$m} }}";
				$rez[ "content{$m}" ] = "{{ data.content{$m} }}";
			}
		}
		return $rez;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'briny_elm_get_css' ) ) {
	add_filter( 'briny_filter_get_css', 'briny_elm_get_css', 10, 2 );
	function briny_elm_get_css( $css, $args ) {

		if ( isset( $css['vars'] ) && isset( $args['vars'] ) ) {
			extract( $args['vars'] );
			$css['vars'] .= <<<CSS
/* Narrow: 5px */
.elementor-section.elementor-section-justified.elementor-section-boxed:not(.elementor-inner-section) > .elementor-container.elementor-column-gap-narrow,
.elementor-section.elementor-section-justified.elementor-section-full_width:not(.elementor-section-stretched):not(.elementor-inner-section) > .elementor-container.elementor-column-gap-narrow {
	width: $page10; 
}
.sidebar_show .content_wrap .elementor-section.elementor-section-justified.elementor-section-boxed:not(.elementor-inner-section) > .elementor-container.elementor-column-gap-narrow,
.sidebar_show .content_wrap .elementor-section.elementor-section-justified.elementor-section-full_width:not(.elementor-section-stretched):not(.elementor-inner-section) > .elementor-container.elementor-column-gap-narrow {
	width: $content10; 
}

/* Default: 10px */
.elementor-section.elementor-section-justified.elementor-section-boxed:not(.elementor-inner-section) > .elementor-container.elementor-column-gap-default,
.elementor-section.elementor-section-justified.elementor-section-full_width:not(.elementor-section-stretched):not(.elementor-inner-section) > .elementor-container.elementor-column-gap-default {
	width: $page20;
}
.sidebar_show .content_wrap .elementor-section.elementor-section-justified.elementor-section-boxed:not(.elementor-inner-section) > .elementor-container.elementor-column-gap-default,
.sidebar_show .content_wrap .elementor-section.elementor-section-justified.elementor-section-full_width:not(.elementor-section-stretched):not(.elementor-inner-section) > .elementor-container.elementor-column-gap-default {
	width: $content20;
}

/* Extended: 15px */
.elementor-section.elementor-section-justified.elementor-section-boxed:not(.elementor-inner-section) > .elementor-container.elementor-column-gap-extended,
.elementor-section.elementor-section-justified.elementor-section-full_width:not(.elementor-section-stretched):not(.elementor-inner-section) > .elementor-container.elementor-column-gap-extended {
	width: $page30; 
}
.sidebar_show .content_wrap .elementor-section.elementor-section-justified.elementor-section-boxed:not(.elementor-inner-section) > .elementor-container.elementor-column-gap-extended,
.sidebar_show .content_wrap .elementor-section.elementor-section-justified.elementor-section-full_width:not(.elementor-section-stretched):not(.elementor-inner-section) > .elementor-container.elementor-column-gap-extended {
	width: $content30; 
}

/* Wide: 20px */
.elementor-section.elementor-section-justified.elementor-section-boxed:not(.elementor-inner-section) > .elementor-container.elementor-column-gap-wide,
.elementor-section.elementor-section-justified.elementor-section-full_width:not(.elementor-section-stretched):not(.elementor-inner-section) > .elementor-container.elementor-column-gap-wide {
	width: $page40; 
}
.sidebar_show .content_wrap .elementor-section.elementor-section-justified.elementor-section-boxed:not(.elementor-inner-section) > .elementor-container.elementor-column-gap-wide,
.sidebar_show .content_wrap .elementor-section.elementor-section-justified.elementor-section-full_width:not(.elementor-section-stretched):not(.elementor-inner-section) > .elementor-container.elementor-column-gap-wide {
	width: $content40; 
}

/* Wider: 30px */
.elementor-section.elementor-section-justified.elementor-section-boxed:not(.elementor-inner-section) > .elementor-container.elementor-column-gap-wider,
.elementor-section.elementor-section-justified.elementor-section-full_width:not(.elementor-section-stretched):not(.elementor-inner-section) > .elementor-container.elementor-column-gap-wider {
	width: $page60; 
}
.sidebar_show .content_wrap .elementor-section.elementor-section-justified.elementor-section-boxed:not(.elementor-inner-section) > .elementor-container.elementor-column-gap-wider,
.sidebar_show .content_wrap .elementor-section.elementor-section-justified.elementor-section-full_width:not(.elementor-section-stretched):not(.elementor-inner-section) > .elementor-container.elementor-column-gap-wider {
	width: $content60; 
}

CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS

/* Shape above and below rows */
.elementor-shape .elementor-shape-fill {
	fill: {$colors['bg_color']};
}

/* Divider */
.elementor-divider-separator {
	border-color: {$colors['bd_color']};
}
.elementor-toggle .elementor-tab-title {
    background-color: {$colors['bg_color']};
}
.elementor-toggle .elementor-tab-title.elementor-active{
    background-color: {$colors['text_hover']};
}
.elementor-toggle .elementor-tab-title.elementor-active .elementor-toggle-icon:before{
    background-color: {$colors['text_link']};
}
.elementor-toggle .elementor-tab-title.elementor-active a{
    color: {$colors['inverse_text']};
}
.elementor-toggle .elementor-tab-title a{
     color: {$colors['text_dark']};
}
.elementor-toggle .elementor-tab-title:hover a{
     color: {$colors['text_link']};
}
.elementor-toggle .elementor-tab-title.elementor-active:hover a{
     color: {$colors['text_dark']};
}

.scheme_self.elementor-widget-toggle .elementor-tab-title {
    background-color: {$colors['alter_bg_color']};
}

.elementor-toggle .elementor-tab-title .elementor-toggle-icon:before{
    background-color: {$colors['text_hover']};
}
.elementor-toggle .elementor-tab-title .elementor-toggle-icon i{
     color: {$colors['inverse_text']};
}
.elementor-toggle .elementor-tab-content{
    border-color: {$colors['text_hover']};
}

.elementor-widget-tabs .elementor-tab-desktop-title.elementor-active, .elementor-widget-tabs .elementor-tab-desktop-title:hover, .elementor-widget-tabs .elementor-tab-mobile-title.elementor-active, .elementor-widget-tabs .elementor-tab-mobile-title:hover {   
    background-color: {$colors['extra_bg_color']};
}
.elementor-widget-tabs .elementor-tab-desktop-title.elementor-active a, .elementor-widget-tabs .elementor-tab-desktop-title:hover a, .elementor-widget-tabs .elementor-tab-mobile-title:hover,
.elementor-widget-tabs .elementor-tab-mobile-title.elementor-active{  
     color: {$colors['inverse_text']};
}
.elementor-widget-tabs .elementor-tab-desktop-title, .elementor-widget-tabs .elementor-tab-mobile-title{
    background-color: {$colors['bg_color']};
}
.scheme_self.elementor-widget-tabs .elementor-tab-desktop-title, .scheme_self.elementor-widget-tabs .elementor-tab-mobile-title {
    background-color: {$colors['alter_bg_color']};
}
.elementor-widget-tabs .elementor-tab-desktop-title a{
    color: {$colors['text_dark']};
}

.scheme_self .elementor-text-editor a{
   color: {$colors['text']};
}
.scheme_self .elementor-text-editor a:hover{
   color: {$colors['text_hover']};
}
.elementor-widget-image-box.elementor-position-left .elementor-image-box-content .elementor-image-box-title u,
.elementor-widget-image-box.elementor-position-right .elementor-image-box-content .elementor-image-box-title u{
    color: {$colors['text_link']};
}


CSS;
		}

		return $css;
	}
}

