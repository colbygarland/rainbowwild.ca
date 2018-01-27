<?php
/*
Title: Misc Shortcodes
Version: 1.0
Last Updated: Aug 22, 2013
Description: Collection of useful shortcodes
*/
add_shortcode('iframe', 'idp_iframe');
function idp_iframe($atts){
		extract( shortcode_atts( array(
		'url' 	=> false, 
		'height'	=> 600,
		'width' 	=> 750,
	), $atts ) );
	
	if( $url )	
		return '<iframe frameBorder="0" class="iframe" src="'.$url.'" width="'.$width.'" height="'.$height.'" style="border: none;"></iframe>';

}
