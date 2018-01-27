<?php

/*

Title: Clean Head Tags

Version: 1.0

Last Updated: July 10, 2013

Description: Removes unneeded wp default tags from head area.  If RSS is needed, comment out feed_links

SETTING FORMAT
array(
	array( {fieldtype:text,textarea,truefalse,info}, {name/id}, {label}, {help/info}, {defaultvalue}, {help/info css styles} ) 
)
*/
$FNKOP[basename(__FILE__, '.php')] = array(array('info', '', '', 'Removes unneeded wordpress head tags', '','font-style:italic'));

add_action('init', 'idp_clean_wp_header');

function idp_clean_wp_header() { 

	remove_action('wp_head', 'wp_generator'); 

	remove_action('wp_head', 'rel_canonical'); 

	remove_action('wp_head', 'rsd_link'); 

	remove_action('wp_head', 'feed_links',2); 

	remove_action('wp_head', 'feed_links_extra',3); 

	remove_action('wp_head', 'wlwmanifest_link'); 

	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); 

	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); 

}