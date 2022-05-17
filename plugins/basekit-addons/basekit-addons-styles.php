<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'briny_addons_get_css' ) ) {
	add_filter( 'briny_filter_get_css', 'briny_addons_get_css', 10, 2 );
	function briny_addons_get_css( $css, $args ) {
        if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
            $colors         = $args['colors'];
            $css['colors'] .= <<<CSS
.boats_page_featured .boats_page_title_price{
    background-color: {$colors['extra_bg_color_07']};	
}
.boats_page_featured .boats_page_title_price .boats_price .boats_price_data,
.boats_page_featured .boats_page_title_price .boats_price .boats_price_label{
    color: {$colors['inverse_text']};
}      
.boats_page_gallery{
    background-color: {$colors['alter_bg_color']};	
}
.boats_page_title_address:before{
     color: {$colors['text_link']};
}
.boats_page_meta_wrap .boats_page_section_item .boats_page_label{
     color: {$colors['text_hover']};
}
.boat_specification .boat_specification_wrapper .boat_amenities_list a, .boat_specification .boat_specification_wrapper .boat_specification_list a{
    color: {$colors['text_dark']};
}
.boat_specification .boat_specification_wrapper .boat_amenities_list a:hover, .boat_specification .boat_specification_wrapper .boat_specification_list a:hover{
    color: {$colors['text_hover']};
}
.boat_specification .boat_specification_wrapper .boat_amenities_list a:before, .boat_specification .boat_specification_wrapper .boat_specification_list a:before{
    background-color: {$colors['text_link']};	
}
.boat_specification, 
.boats_page_agent, 
.boats_page_attachments,
.boats_page_book{
    border-color: {$colors['text_dark_015']};	  
}
.boats_page_agent_wrap.scheme_self{
    background-color: {$colors['bg_color']};	
}
.boats_page_agent_info_phones a:before{
     color: {$colors['text_hover']};
}
.boats_page_agent_wrap.scheme_self .boats_page_agent_info_phones a,
.boats_page_agent_wrap.scheme_self .boats_page_agent_info_position{
    color: {$colors['text']};
}
.boats_page_agent_wrap.scheme_self .boats_page_agent_info_phones a:hover{
    color: {$colors['text_dark']};
}
.boats_page_title_address a {
    color: {$colors['text']};
}
.boats_page_title_address a:hover {
    color: {$colors['text_hover']};
}
.boats_search_basic  .sc_form_field_wrap input[placeholder]::placeholder{
   color: {$colors['input_text']}; 
}
span.sc_form_field_title, .boats_search_vertical .boats_search_form .boats_search_basic .boats_search_show_advanced, .search_title_section, .boats_search_form .boats_search_basic .boats_search_show_advanced {
     color: {$colors['input_text']}; 
}
 div.ui-slider .ui-slider-range{
    background-color: {$colors['alter_bg_color']};	 
}
div.ui-slider .ui-slider-handle{
    background-color: {$colors['text_hover']};
}
div.ui-slider{
      background-color: {$colors['text_hover']};
      border-color: {$colors['text_hover']};
}
.sc_boats_item_options .sc_boats_item_row_address, .sc_boats_item_options .sc_boats_item_row_meta{
     color: {$colors['text']}; 
}

.trx_addons_range_slider_label_cur{
     background-color:transparent;
}
input[type="radio"] + label:before, input[type="checkbox"] + label:before,
input[type="radio"] + .wpcf7-list-item-label:before,
input[type="checkbox"] + .wpcf7-list-item-label:before,
.wpcf7-list-item-label.wpcf7-list-item-right:before,
.edd_price_options ul > li > label > input[type="radio"] + span:before,
.edd_price_options ul > li > label > input[type="checkbox"] + span:before,
.wpgdprc-checkbox label input[type="checkbox"]:before{
    border-color: {$colors['input_text']}!important;
}

/*Booked plugins on the boat single page*/
.single-cpt_boats table.booked-calendar thead tr th{
    background: {$colors['alter_bg_color']}!important;
    border-color: {$colors['bg_color']}!important;
}
         

CSS;
        }

        return $css;
    }
}

