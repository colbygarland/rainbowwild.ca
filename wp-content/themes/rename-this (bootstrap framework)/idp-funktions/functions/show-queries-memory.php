<?php
/*
Title: Show DB Query Times & Memory Usage
Version: 1.0
Last Updated: July 10, 2013
Description: Show DB Query Times & Memory Usage in a hidden comment at the bottom of each page
*/
add_action('wp_footer', 'idp_footer_stats_display', 20);
function idp_footer_stats_display($visible = false) { 
	$stat = sprintf( '%d queries in %.3f seconds, using %.2fMB memory', 
					get_num_queries(), timer_stop( 0, 3 ), 
					memory_get_peak_usage() / 1024 / 1024);   
	echo $visible ? $stat : "<!-- {$stat} -->" ; 
}