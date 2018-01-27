<?php

/*

Title: Sitemap

Version: 1.0

Last Updated: July 10, 2013

Description: use [sitemap] or idp_sitemap(); to display

SETTING FORMAT
array(
	array( {fieldtype:text,textarea,truefalse,info}, {name/id}, {label}, {help/info}, {defaultvalue}, {help/info css styles} ) 
)
*/
$FNKOP[basename(__FILE__, '.php')] = array(array('info', '', '', '<strong>Usage: </strong>add shortcode <code>[sitemap]</code> or use function <code>echo idp_sitemap();</code> in your template files.', '','font-style:italic'));

add_shortcode('sitemap', 'idp_sitemap'); 

function idp_sitemap($atts=false){

	global $wpdb;

	$pages = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type='page' AND post_status='publish' AND post_parent = '' ORDER BY menu_order ASC");

	//print_r($pages);

		foreach($pages as $P):

			$subpages = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type='page' AND post_status='publish' AND post_parent = '".$P->ID."' ORDER BY menu_order ASC");

			$pgs .= '<li><a href="'.get_permalink($P->ID).'">'.$P->post_title.'</a>';

			if( $subpages ) $pgs .= '<ul>';

			foreach($subpages as $S):

				$subsubpages = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type='page' AND post_status='publish' AND post_parent = '".$S->ID."' ORDER BY menu_order ASC");

				$pgs .= '<li><a href="'.get_permalink($S->ID).'">'.$S->post_title.'</a>';

				if( $subsubpages ) $pgs .= '<ul>';

				foreach($subsubpages as $SS):

					$output .= '<li><a href="'.get_permalink($SS->ID).'">'.$SS->post_title.'</a></li>'."\n";

				endforeach;

				if( $subsubpages ) $pgs .= '</ul>';

				$pgs .= '</li>'."\n";

			endforeach;

			if( $subpages ) $pgs .= '</ul>';

			$pgs .= '</li>'."\n";

		endforeach;

	$output = "<ul id='SiteMap'>$pgs</ul>";

	return $output;

}

if( !function_exists('ShowSitemap') ){

	function ShowSitemap(){ echo idp_sitemap(); }	

}