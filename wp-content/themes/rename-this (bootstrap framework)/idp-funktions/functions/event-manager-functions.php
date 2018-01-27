<?php
/*
Title: Event Manager Functions
Version: 1.0
Last Updated: July 10, 2013
Description: is_event and Category List shortcode
*/
$event_pg_ID = 11;
function is_event(){
	global $event_pg_ID;
	if( is_page($event_pg_ID) || 'event' == get_post_type() || 'location' == get_post_type() || is_post_type_archive('event') || is_tax('event-categories') ) 
		return true;
	else
		return false;	
}
add_shortcode('categories_select', 'EventCatSelect');
function EventCatSelect(){
	$list = do_shortcode('[categories_list]');
	$list = str_replace( "<ul class='em-categories-list'>", '', $list);
	$list = str_replace( "</ul>", "", $list);
	$split = explode('</li>', $list);
	$opt = '<option value="">All Events</option>';
	foreach( $split as $li ):
		$opt .= preg_replace( '/<li><a href=\"(.*)\">(.*)<\/a>/', '<option value="$1">$2</option>', $li);
		//echo '<!-- LI = '.$opt.' -->';
	endforeach;
	return $opt;
}