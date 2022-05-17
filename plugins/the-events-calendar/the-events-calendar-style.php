<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'briny_tribe_events_get_css' ) ) {
	add_filter( 'briny_filter_get_css', 'briny_tribe_events_get_css', 10, 2 );
	function briny_tribe_events_get_css( $css, $args ) {
		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS
			
.tribe-events-list .tribe-events-list-event-title,
.tribe-common--breakpoint-medium.tribe-common .tribe-common-h6--min-medium,
.tribe-common .tribe-common-h1, .tribe-common .tribe-common-h2,
.tribe-common .tribe-common-h3, .tribe-common .tribe-common-h4,
.tribe-common .tribe-common-h5, .tribe-common .tribe-common-h6,
.tribe-common .tribe-common-h7, .tribe-common .tribe-common-h8  {
	{$fonts['h3_font-family']}
}

#tribe-events .tribe-events-button,
.tribe-events-button,
.tribe-events-cal-links a,
.tribe-events-sub-nav li a {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}
#tribe-bar-form button, #tribe-bar-form a,
.tribe-events-read-more {
	{$fonts['button_font-family']}
	{$fonts['button_letter-spacing']}
}
.tribe-events-list .tribe-events-list-separator-month,
.tribe-events-calendar thead th,
.tribe-common .tribe-common-b3,
.tribe-events-schedule, .tribe-events-schedule h2 {
	{$fonts['h5_font-family']}
}
#tribe-bar-form input, #tribe-events-content.tribe-events-month,
#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title,
#tribe-mobile-container .type-tribe_events,
.tribe-events-list-widget ol li .tribe-event-title,
.tribe-events .datepicker .day,



.tribe-common .tribe-common-b1,
.tribe-common .tribe-common-b2,
.tribe-common .tribe-common-h3 .tribe-events-c-top-bar__datepicker-desktop,
.tribe-events .tribe-events-c-view-selector__list-item-text,
.tribe-common .tribe-common-c-btn, .tribe-common a.tribe-common-c-btn,
.tribe-events .tribe-events-calendar-list__event-date-tag-weekday,
.tribe-common .tribe-common-c-btn-border, .tribe-common a.tribe-common-c-btn-border,
.tribe-events .tribe-events-calendar-month__calendar-event-datetime,
.tribe-common .tribe-common-c-btn-border-small, .tribe-common a.tribe-common-c-btn-border-small,
.tribe-events .datepicker .month, .tribe-events .datepicker .year,
.tribe-events .tribe-events-calendar-month__calendar-event-tooltip-datetime,
.tribe-common--breakpoint-medium.tribe-common .tribe-common-form-control-text__input, .tribe-common .tribe-common-form-control-text__input  {
	{$fonts['p_font-family']}
}
.tribe-events-loop .tribe-event-schedule-details,
.single-tribe_events #tribe-events-content .tribe-events-event-meta dt,
#tribe-mobile-container .type-tribe_events .tribe-event-date-start {
	{$fonts['info_font-family']};
}
#tribe-bar-form input[type="text"] {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}

#tribe-events .tribe-events-content p, 
.tribe-events-after-html p, .tribe-events-before-html p,
.tribe-events-event-meta {
	{$fonts['p_font-family']}
	{$fonts['p_font-size']}
	{$fonts['p_font-weight']}
	{$fonts['p_font-style']}
	{$fonts['p_line-height']}
	{$fonts['p_text-decoration']}
	{$fonts['p_text-transform']}
	{$fonts['p_letter-spacing']}
}

CSS;
		}

		if ( isset( $css['vars'] ) && isset( $args['vars'] ) ) {
			$vars         = $args['vars'];
			$css['vars'] .= <<<CSS

#tribe-bar-form .tribe-bar-submit input[type="submit"],
#tribe-bar-form button,
#tribe-bar-form a,
#tribe-events .tribe-events-button,
#tribe-bar-views .tribe-bar-views-list,
.tribe-events-button,
.tribe-events-cal-links a,
#tribe-events-footer ~ a.tribe-events-ical.tribe-events-button,
.tribe-events-sub-nav li a {
	-webkit-border-radius: {$vars['rad']};
	    -ms-border-radius: {$vars['rad']};
			border-radius: {$vars['rad']};
}

CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS

/* Filters bar */
#tribe-bar-form {
	color: {$colors['text_dark']};
}
#tribe-bar-form input[type="text"] {
	color: {$colors['text_dark']};
	border-color: {$colors['bd_color']};
}

.datepicker thead tr:first-child th:hover, .datepicker tfoot tr th:hover {
	color: {$colors['text_link']};
	background: {$colors['text_dark']};
}


.tribe-common a {
	color: {$colors['text_dark']};
}
.tribe-common a:active, 
.tribe-common a:focus{
	color: {$colors['text_hover']};
}
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-view-selector--tabs .tribe-events-c-view-selector__list-item--active .tribe-events-c-view-selector__list-item-link:after {
	background: {$colors['text_hover']};
}
button.tribe-events-c-top-bar__datepicker-button,
button.tribe-events-c-top-bar__datepicker-button:hover {
	background: transparent;
}
.tribe-common .tribe-events-c-top-bar__datepicker-time .tribe-common-h3 {
	color: {$colors['text_link']};
}
.tribe-common  .tribe-common-h3.tribe-events-c-top-bar__datepicker-button:hover,
.tribe-common  .tribe-common-h3.tribe-events-c-top-bar__datepicker-button:focus {
	color: {$colors['text_hover']};
}

.tribe-common .tribe-events-c-view-selector__list-item a:hover span,
.tribe-common .tribe-events-c-view-selector__list-item--active a span {
	color: {$colors['text_hover']};
}

.tribe-common button[disabled] {
	background-color: transparent !important;
}

.tribe-events-event-meta a, .tribe-events-event-meta a:visited {
	color: {$colors['text_link']};
}
.tribe-events-event-meta a:hover, .tribe-events-event-meta a:visited:hover {
	color: {$colors['text_hover']};
}

input.tribe-common-form-control-text__input,
input.tribe-common-form-control-text__input:focus,
input.tribe-common-form-control-text__input.filled {
  	background-color: transparent;
}

.tribe-events .datepicker .prev .tribe-common-svgicon:before,
.tribe-events .datepicker .next .tribe-common-svgicon:before {
	color: {$colors['bg_color']} ;
}

.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-nav__next, 
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-nav__prev {
	background-color: {$colors['text_link']} ;
}

.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-nav__next:hover, 
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-nav__prev:hover{
	background-color: {$colors['text_hover']} ;
}

.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-nav__next, 
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-nav__prev,
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-nav__next:after, 
.tribe-common--breakpoint-medium.tribe-events .tribe-events-c-nav__prev:before {
	color: {$colors['inverse_link']} ;
}

.tribe-common .tribe-common-c-btn-border, .tribe-common a.tribe-common-c-btn-border {
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']} ;
}

.tribe-common .tribe-common-c-btn-border:focus, .tribe-common .tribe-common-c-btn-border:hover, 
.tribe-common a.tribe-common-c-btn-border:focus, .tribe-common a.tribe-common-c-btn-border:hover {
	color: {$colors['text_hover']};
	border-color: {$colors['text_hover']} ;
}

.tribe-common--breakpoint-medium.tribe-events .tribe-events-calendar-month__day:hover:after {
	background-color: {$colors['text_hover']};
}

.tribe-common .tribe-common-anchor-alt {
	color: {$colors['text_link']};
	border-color: {$colors['text_link']};
}
.tribe-common .tribe-common-anchor-alt:hover {
	color: {$colors['text_hover']};
	border-color: {$colors['text_hover']};
}
.tribe-events .tribe-events-c-events-bar__search-button, 
.tribe-events .tribe-events-c-view-selector__button { 
	background: transparent !important;
}


.tribe-events .tribe-events-c-events-bar__search-button-icon:before {
	color: {$colors['text_link']};
}

.tribe-common .tribe-common-svgicon--list:hover:before,
.tribe-events .tribe-events-c-events-bar__search-button-icon:hover:before {
	color: {$colors['text_hover']};
}

.tribe-events .tribe-events-c-events-bar__search-button:before,
.tribe-events .tribe-events-c-view-selector__button:before {
	background-color: {$colors['text_hover']};
}

button.tribe-events-calendar-month__day-cell {
	background: transparent !important;
}

.tribe-events .tribe-events-calendar-month__day-cell--mobile:focus, 
.tribe-events .tribe-events-calendar-month__day-cell--mobile:hover {
	color: {$colors['text_link']} !important;
}
.tribe-events .tribe-events-calendar-month__day-cell--selected .tribe-events-calendar-month__day-date,
.tribe-events .tribe-events-calendar-month__day-cell--mobile:focus .tribe-events-calendar-month__day-date-daynum, 
.tribe-events .tribe-events-calendar-month__day-cell--mobile:hover .tribe-events-calendar-month__day-date-daynum {
	color: {$colors['text_link']};
}

.tribe-events .tribe-events-calendar-month__mobile-events-icon--event {
	background-color: {$colors['text_link']};
}

.tribe-events .tribe-events-calendar-month__day-cell--mobile:focus .tribe-events-calendar-month__mobile-events-icon--event, 
.tribe-events .tribe-events-calendar-month__day-cell--mobile:hover .tribe-events-calendar-month__mobile-events-icon--event {
	background-color: {$colors['text_link']};
}

.tribe-common .tribe-common-c-loader__dot.tribe-common-c-svgicon--dot {
	background-color: {$colors['text_link']};
}

.tribe-common--breakpoint-medium.tribe-common .tribe-common-h3:not(.tribe-events-c-top-bar__datepicker-button) {
	color: {$colors['bg_color']};
	background-color: {$colors['text_link']};	
}

.tribe-common--breakpoint-medium.tribe-common .tribe-common-h3.tribe-events-c-top-bar__datepicker-button {
	color: {$colors['text_link']};	
}
.tribe-common--breakpoint-medium.tribe-common .tribe-common-h3.tribe-events-c-top-bar__datepicker-button:hover{
    color: {$colors['text_hover']};
}
.tribe-common--breakpoint-medium.tribe-common .tribe-common-h3:not(.tribe-events-c-top-bar__datepicker-button):hover {
	color: {$colors['bg_color']};
	background-color: {$colors['text_hover']};	
}

.tribe-common .tribe-events-c-top-bar__nav-list .tribe-common-c-btn-icon:before,
.tribe-common .tribe-events-c-top-bar__nav-list .tribe-common-c-btn-icon:after{
		color: {$colors['bg_color']};
	background-color: {$colors['text_link']};	
}

.tribe-common .tribe-events-c-top-bar__nav-list .tribe-common-c-btn-icon:hover:before,
.tribe-common .tribe-events-c-top-bar__nav-list .tribe-common-c-btn-icon:hover:after{
	color: {$colors['bg_color']};
	background-color: {$colors['text_hover']};	
}

.tribe-events .tribe-events-calendar-month__multiday-event-bar-inner {
	color: {$colors['bg_color']};
	background-color: {$colors['text_link_02']};	
}

.tribe-events .tribe-events-c-nav__prev:disabled,
.tribe-events .tribe-events-c-nav__next:disabled,
.tribe-events .tribe-events-c-nav__prev:disabled:before,
.tribe-events .tribe-events-c-nav__next:disabled:before,
.tribe-events .tribe-events-c-nav__prev:disabled:after,
.tribe-events .tribe-events-c-nav__next:disabled:after {
	color: {$colors['text_link']} !important;
}

.tribe-events .datepicker .datepicker-switch {
	color: {$colors['bg_color']};
}

.tribe-events .datepicker-days .table-condensed th{
	color: {$colors['bg_color']};
}

.tribe-events .datepicker .day.active, .tribe-events .datepicker .day.active.focused, 
.tribe-events .datepicker .day.active:focus, .tribe-events .datepicker .day.active:hover, 
.tribe-events .datepicker .month.active, .tribe-events .datepicker .month.active.focused, 
.tribe-events .datepicker .month.active:focus, .tribe-events .datepicker .month.active:hover, 
.tribe-events .datepicker .year.active, .tribe-events .datepicker .year.active.focused, 
.tribe-events .datepicker .year.active:focus, .tribe-events .datepicker .year.active:hover {
	background: {$colors['text_hover']};
}

.tribe-events .tribe-events-calendar-month__day--current .tribe-events-calendar-month__day-date, 
.tribe-events .tribe-events-calendar-month__day--current .tribe-events-calendar-month__day-date-link {
	color: {$colors['text_link']} ;
}

.tribe-common-h3.tribe-common-h--alt.tribe-events-c-top-bar__datepicker-button {
	color: {$colors['text_link']};
}

.tribe-events .tribe-events-c-small-cta__price {
	color: {$colors['text_hover']} ;
}



/* Content */
.tribe-events-calendar thead th {
	color: {$colors['extra_hover3']};
	background: {$colors['extra_bg_color']} !important;
}
.tribe-events-calendar thead th + th:before {
	background: {$colors['extra_dark']};
}

#tribe-events-content .tribe-events-calendar td {
    background-color: {$colors['alter_bg_color']} !important;
}
#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth {
    background-color: {$colors['alter_bg_color_07']} !important;
}
#tribe-events-content .tribe-events-calendar td,
#tribe-events-content .tribe-events-calendar th {
	border-color: {$colors['bg_color']} !important;
}
.tribe-events-calendar td div[id*="tribe-events-daynum-"],
.tribe-events-calendar td div[id*="tribe-events-daynum-"] > a {
	color: {$colors['extra_link2']};
}
.tribe-events-calendar td.tribe-events-othermonth {
	color: {$colors['alter_light']};
	background: {$colors['alter_bg_color']} !important;
}
.tribe-events-calendar td.tribe-events-othermonth div[id*="tribe-events-daynum-"],
.tribe-events-calendar td.tribe-events-othermonth div[id*="tribe-events-daynum-"] > a {
	color: {$colors['extra_link2']};
}
.tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"], 
.tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"] > a {
	color: {$colors['extra_link2']} !important;
}
.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"],
.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"] > a {
	color: {$colors['extra_link2']};
}
.tribe-events-calendar td.tribe-events-present:before {
	border-color: {$colors['text_link2']};
}
.tribe-events-calendar .tribe-events-has-events:after {
	background-color: {$colors['text']};
}
.tribe-events-calendar .mobile-active.tribe-events-has-events:after {
	background-color: {$colors['text_link']};
}
#tribe-events-content .tribe-events-calendar td,
#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title a {
	color: {$colors['text_dark']};
}
#tribe-events-content .tribe-events-calendar div[id*="tribe-events-event-"] h3.tribe-events-month-event-title a:hover {
	color: {$colors['text_link']};
}
#tribe-events-content .tribe-events-calendar td.mobile-active,
#tribe-events-content .tribe-events-calendar td.mobile-active:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
#tribe-events-content .tribe-events-calendar td.mobile-active div[id*="tribe-events-daynum-"] {
	color: {$colors['extra_link2']};
	background-color: transparent;
}
#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth.mobile-active div[id*="tribe-events-daynum-"] a,
.tribe-events-calendar .mobile-active div[id*="tribe-events-daynum-"] a {
	background-color: transparent;
	color: {$colors['extra_link2']};
}
.events-archive.events-gridview #tribe-events-content table .type-tribe_events {
	border-color: {$colors['bd_color']};
}
#tribe-bar-form.tribe-bar-collapse #tribe-bar-collapse-toggle {
    color: {$colors['inverse_link']};
}
.tribe-common .tribe-events-calendar-list__event-date-tag .tribe-events-calendar-list__event-date-tag-daynum {
	color: {$colors['text_link']};
}


/* Tooltip */
.recurring-info-tooltip,
.tribe-events-calendar .tribe-events-tooltip,
.tribe-events-week .tribe-events-tooltip,
.tribe-events-shortcode.view-week .tribe-events-tooltip,
.tribe-events-tooltip .tribe-events-arrow {
	color: {$colors['extra_link2']};
	background: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
}
#tribe-events-content .tribe-events-tooltip .summary { 
	color: {$colors['extra_hover3']};
	background: {$colors['extra_bg_color']};
}
.tribe-events-tooltip .tribe-event-duration {
	color: {$colors['extra_hover3']};
}

/* Events list */
.tribe-events-list-separator-month {
	color: {$colors['text_dark']};
}
.tribe-events-list-separator-month:after {
	border-color: {$colors['bd_color']};
}
.tribe-events-list .type-tribe_events + .type-tribe_events,
.tribe-events-day .tribe-events-day-time-slot + .tribe-events-day-time-slot + .tribe-events-day-time-slot {
	border-color: {$colors['bd_color']};
}
.tribe-events-list-separator-month span {
	background-color: {$colors['bg_color']};	
}
.tribe-events-list .tribe-events-event-cost span {
	color: {$colors['extra_hover3']};
	border-color: {$colors['extra_bg_color']};
	background: {$colors['extra_bg_color']};
}
.tribe-mobile .tribe-events-loop .tribe-events-event-meta {
	color: {$colors['alter_text']};
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color']};
}
.tribe-mobile .tribe-events-loop .tribe-events-event-meta a {
	color: {$colors['alter_link']};
}
.tribe-mobile .tribe-events-loop .tribe-events-event-meta a:hover {
	color: {$colors['alter_hover']};
}
.tribe-mobile .tribe-events-list .tribe-events-venue-details {
	border-color: {$colors['alter_bd_color']};
}

.single-tribe_events #tribe-events-footer,
.tribe-events-day #tribe-events-footer,
.events-list #tribe-events-footer,
.tribe-events-map #tribe-events-footer,
.tribe-events-photo #tribe-events-footer {
	border-color: {$colors['bd_color']};	
}

/* Events day */
.tribe-events-day .tribe-events-day-time-slot h5,
.tribe-events-day .tribe-events-day-time-slot .tribe-events-day-time-slot-heading {
	color: {$colors['extra_hover3']};
	background: {$colors['extra_bg_color']};
}



/* Single Event */
.single-tribe_events .tribe-events-venue-map {
	color: {$colors['alter_text']};
	border-color: {$colors['alter_bd_hover']};
}
.single-tribe_events .tribe-events-schedule .tribe-events-cost {
	color: {$colors['text_dark']};
}
.single-tribe_events .type-tribe_events {
	border-color: {$colors['bd_color']};
}

#tribe-bar-form input[type="text"] {
    color: {$colors['input_text']};
	border-color: {$colors['input_bd_color']} !important;
	background-color: {$colors['input_bg_color']};
}
#tribe-bar-form input[type="text"]:focus {
    color: {$colors['input_dark']};
	border-color: {$colors['text_hover']} !important;
	background-color: {$colors['input_bg_hover']};
}
input[placeholder]::-webkit-input-placeholder       { color: {$colors['input_text']}; opacity: 1; font-style: normal;}
input[placeholder]::-moz-placeholder                { color: {$colors['input_text']}; opacity: 1; font-style: normal;}
input[placeholder]:-ms-input-placeholder            { color: {$colors['input_text']}; opacity: 1; font-style: normal;}
input[placeholder]::placeholder                     { color: {$colors['input_text']}; opacity: 1; font-style: normal;}

.tribe-events-sub-nav .tribe-events-nav-previous a,
.tribe-events-sub-nav .tribe-events-nav-next a {
    color: {$colors['text_dark']} !important;
}
.tribe-events-sub-nav .tribe-events-nav-previous a:before,
.tribe-events-sub-nav .tribe-events-nav-next a:after {
    border-color: {$colors['bd_color']} !important;
}
.tribe-events-sub-nav .tribe-events-nav-previous a:hover,
.tribe-events-sub-nav .tribe-events-nav-next a:hover {
    color: {$colors['text_link']} !important;
}
.datepicker .datepicker-switch:hover, .datepicker .next:hover, .datepicker .prev:hover, .datepicker tfoot tr th:hover {
    background-color: {$colors['text_link']} !important;
}

.tribe-events .tribe-events-c-ical__link{
    border-color: {$colors['text_link']};
    color: {$colors['text_link']};
}
.tribe-events .tribe-events-c-ical__link:hover{
    background-color: {$colors['text_link']};
    color: {$colors['alter_bg_color']};
}
.tribe-events-calendar-day__event-description,
.tribe-events-calendar-month__calendar-event-tooltip-description,
.tribe-events-calendar-list__event-description{
     color: {$colors['text']};
}

.tribe-common .tribe-common-c-svgicon.tribe-common-c-svgicon--search {
	color: {$colors['text_hover']};
}

.tribe-common .tribe-common-c-svgicon.tribe-common-c-svgicon--messages-not-found {
	color: {$colors['text_hover']};
}

.tribe-common .tribe-events-c-messages__message-list-item-link.tribe-common-anchor-thin-alt {
	color: {$colors['text_link']};
}
.tribe-common .tribe-events-c-messages__message-list-item-link.tribe-common-anchor-thin-alt:hover {
	color: {$colors['text_hover']};
}

#tribe-events .tribe-events-content p, 
.tribe-events-after-html p, .tribe-events-before-html p,
.single-tribe_events .tribe-events-single .tribe-events-event-meta {
	color: {$colors['text']};
}

.tribe-events-meta-group .tribe-events-single-section-title {
	color: {$colors['text_dark']};
}

.tribe-events .tribe-events-header {
	border-color: {$colors['bd_color']};
}


CSS;
		}

		return $css;
	}
}

