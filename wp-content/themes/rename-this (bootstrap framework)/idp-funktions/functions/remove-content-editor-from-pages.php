<?php

/*

Title: Remove Content Editor from Pages

Version: 1.1

Last Updated: Feb 23, 2015

Description: Removes the content editor from pages and subpages as specified

SETTING FORMAT
array(
	array( {fieldtype:text,textarea,truefalse,info}, {name/id}, {label}, {help/info}, {defaultvalue}, {help/info css styles} ) 
)
*/
$FNKOP[basename(__FILE__, '.php')] = array(
	array('truefalse', 'remove_allpgs', 'Remove from all Pages'), 
	array('text', 'remove_pgs', 'Enter single Page IDs (comma separated)')
);


add_action('admin_head', 'idp_noeditor_home');

function idp_noeditor_home(){
	global $post;
	$funkset = get_option('funktions');
	$all = $funkset['remove_allpgs'];
	$remove_from_pages = explode(',',str_replace(', ', ',', $funkset['remove_pgs']));
	//$parent = $post->parent_id;
	
	
	if( (!$all && in_array($_GET['post'], $remove_from_pages)) || ( $all && $post->post_type == 'page' ) ):

		remove_post_type_support('page', 'editor');

	endif;	

}