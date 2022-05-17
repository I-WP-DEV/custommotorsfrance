<?php
// Add plugin-specific colors and fonts to the custom CSS
if ( ! function_exists( 'briny_booked_get_css' ) ) {
	add_filter( 'briny_filter_get_css', 'briny_booked_get_css', 10, 2 );
	function briny_booked_get_css( $css, $args ) {

		if ( isset( $css['fonts'] ) && isset( $args['fonts'] ) ) {
			$fonts         = $args['fonts'];
			$css['fonts'] .= <<<CSS

.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button,
body #booked-profile-page input[type="submit"],
body #booked-profile-page button,
body .booked-list-view input[type="submit"],
body .booked-list-view button,
body table.booked-calendar input[type="submit"],
body table.booked-calendar button,
body .booked-modal input[type="submit"],
body .booked-modal button {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}

CSS;
		}

		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors         = $args['colors'];
			$css['colors'] .= <<<CSS

/* Form fields */
#booked-page-form {
	color: {$colors['text']};
	border-color: {$colors['bd_color']};
}

#booked-profile-page .booked-profile-header {
	background-color: {$colors['bg_color']} !important;
	border-color: transparent !important;
	color: {$colors['text']};
}
#booked-profile-page .booked-user h3 {
	color: {$colors['text_dark']};
}
#booked-profile-page .booked-profile-header .booked-logout-button:hover {
	color: {$colors['text_link']};
}

#booked-profile-page .booked-tabs {
	border-color: {$colors['alter_bd_color']} !important;
}

.booked-modal .bm-window p.booked-title-bar {
	color: {$colors['alter_bg_color']} !important;
	background-color: {$colors['extra_bg_hover']} !important;
}
.booked-modal .bm-window .close i {
	color: {$colors['alter_bg_color']};
}
.booked-modal .bm-window .booked-scrollable {
	color: {$colors['extra_text']};
	background-color: {$colors['extra_bg_color']} !important;
}
.booked-modal .bm-window .booked-scrollable em {
	color: {$colors['extra_link']};
}
.booked-modal .bm-window #customerChoices {
	background-color: {$colors['extra_bg_hover']};
	border-color: {$colors['extra_bd_hover']};
}
.booked-form .booked-appointments {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_hover']} !important;	
}
.booked-modal .bm-window p.appointment-title {
	color: {$colors['alter_dark']};	
}

/* Profile page and tabs */
.booked-calendarSwitcher.calendar,
.booked-calendarSwitcher.calendar select,
#booked-profile-page .booked-tabs {
	background-color: {$colors['alter_bg_color']} !important;
}
#booked-profile-page .booked-tabs li a {
	background-color: {$colors['extra_bg_hover']};
	color: {$colors['extra_dark']};
}
#booked-profile-page .booked-tabs li a i {
	color: {$colors['extra_dark']};
}
#booked-profile-page .booked-tabs li.active a,
#booked-profile-page .booked-tabs li.active a:hover,
#booked-profile-page .booked-tabs li a:hover {
	color: {$colors['extra_dark']} !important;
	background-color: {$colors['extra_bg_color']} !important;
}
#booked-profile-page .booked-tab-content {
	background-color: {$colors['bg_color']};
	border-color: {$colors['alter_bd_color']};
}

/* Calendar */
table.booked-calendar thead tr th {
	color: {$colors['text_dark']} !important;
	border-color: transparent !important;
    background:  transparent !important;
}
table.booked-calendar thead th .monthName a {
	color: {$colors['extra_link']};
}
table.booked-calendar thead th .monthName a:hover {
	color: {$colors['extra_hover']};
}

table.booked-calendar tbody tr td {
	background-color: {$colors['alter_bg_hover']} !important;
}
table.booked-calendar tbody tr td {
	color: {$colors['alter_text']} !important;
	border-color: {$colors['bg_color']} !important;
}
table.booked-calendar tbody tr td:hover {
	color: {$colors['alter_dark']} !important;
}
table.booked-calendar tbody tr td.today .date {
	color: {$colors['inverse_text']} !important;
	background-color: {$colors['text_hover']} !important;
}
table.booked-calendar tbody td.today .date span {
	border-color: transparent;
}
table.booked-calendar tbody td.today:hover .date span {
	background-color: {$colors['alter_hover']} !important;
	color: {$colors['inverse_link']} !important;
}
body table.booked-calendar tr.days{
    background-color: transparent!important;
    background: transparent!important;
}
body table.booked-calendar th .monthName:after{
    color: {$colors['text_hover']};
}
table.booked-calendar thead th i{
    color: {$colors['text_dark']};
}
body table.booked-calendar thead th .page-right:hover, body table.booked-calendar thead th .page-left:hover{
   border-color: {$colors['text_link']};
   background-color: {$colors['text_link']};		
}
body table.booked-calendar thead th .page-right:hover i, body table.booked-calendar thead th .page-left:hover i{
    color: {$colors['inverse_text']}; 
}
table.booked-calendar tbody tr td.prev-month, 
table.booked-calendar tbody tr td.next-month{
     background-color: {$colors['alter_bg_color_05']}!important;		
}
body table.booked-calendar td .date{
	background-color: {$colors['alter_bg_color']};
} 
body table.booked-calendar td:hover .date span{
     background-color: {$colors['text_hover']};		
}
body table.booked-calendar td.today.prev-date .date span{
     color: {$colors['inverse_text']}!important; 
}
body table.booked-calendar tr.week td.active .date, 
body table.booked-calendar tr.week td.active:hover .date,
body table.booked-calendar tr.entryBlock{
     background-color: {$colors['text_hover']};		
}
body table.booked-calendar tr.week td.active .date .number{
    background-color: {$colors['text_hover']} !important;
	color: {$colors['inverse_link']} !important;
}
body table.booked-calendar .booked-appt-list .timeslot .timeslot-people button:hover{
    background-color: {$colors['text_hover']} !important;
}
.booked-calendar-wrap .booked-appt-list h2 {
	color: {$colors['text_dark']};
}
.booked-modal .bm-window .close i:hover{
    color: {$colors['text_link']};
}
.booked-modal input[type=submit].button-primary{
    background-color: {$colors['text_hover']} !important;
}
.booked-modal input[type=submit].button-primary:hover{
    background-color: {$colors['text_link']} !important;
}
body .booked-modal button.cancel:hover{
    background-color: {$colors['text_hover']} !important;
     color: {$colors['inverse_text']}!important; 
}
body .booked-modal .bm-window p i.fa,
body .booked-modal .bm-window a, body .booked-appt-list .booked-public-appointment-title,
body .booked-modal .bm-window p.appointment-title, .booked-ms-modal.visible:hover .booked-book-appt{
    color: {$colors['text_link']};
}
body .booked-modal .bm-window a:hover {
	color: {$colors['text_hover']};
}
.booked-calendar-wrap .booked-appt-list .timeslot {
	border-color: {$colors['alter_bd_color']};	
}
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-title {
	color: {$colors['text_link']};
}
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-time {
	color: {$colors['text_dark']};
}
.booked-calendar-wrap .booked-appt-list .timeslot .spots-available {
	color: {$colors['text_dark']};
}
.booked-calendar-wrap .booked-appt-list .timeslot .button .spots-available{
    color: {$colors['inverse_text']};
}

body .booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button[disabled]{
    background-color: {$colors['bg_color']} !important;
    color: {$colors['text_dark']}!important; 
}

CSS;
		}

		return $css;
	}
}

