<?php
/*
Title: Google Docs - Embed Shortcode
Version: 1.0
Last Updated: July 10, 2013
Description:  Embed Google Docs on a page (iframe) [gdoc url="" height=600 width=750]
*/
add_shortcode('gdoc', 'idp_embedDoc');
function idp_embedDoc($atts){
	extract( shortcode_atts( array(
		'url' 	=> false, //google doc URL
		'height'	=> 600,
		'width' 	=> 750,
	), $atts ) );
	
	if( $url ):
	
	return '<iframe src="http://docs.google.com/viewer?url='.$url.'&embedded=true" width="'.$width.'" height="'.$height.'" style="border: none;"></iframe>';
		
	endif;
}