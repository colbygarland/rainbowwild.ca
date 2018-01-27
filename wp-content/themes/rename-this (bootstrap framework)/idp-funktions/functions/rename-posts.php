<?php

/*

Title: Rename Posts in Admin

Version: 1.0

Last Updated: July 10, 2013

Description: Change the name of Posts to something more descriptive for clients such as News or Blog

SETTING FORMAT
array(
	array( {fieldtype:text,textarea,truefalse,info}, {name/id}, {label}, {help/info}, {defaultvalue}, {help/info css styles} ) 
)

*/
$FNKOP[basename(__FILE__, '.php')] = array(
	array('text', 'postsname', 'Rename Posts to:', '', 'Blog')
);
$funkset = get_option('funktions');
$PostsName = $funkset['postsname'];




function idp_change_post_menu_label() {

global $menu, $submenu, $PostsName;

$menu[5][0] = $PostsName;

$submenu['edit.php'][5][0] = $PostsName;

$submenu['edit.php'][10][0] = 'Add '.$PostsName;

$submenu['edit.php'][16][0] = 'Tags';

}

function idp_change_post_object_label() {

global $wp_post_types, $PostsName;

$labels = &$wp_post_types['post']->labels;

$labels->name = $PostsName;

$labels->singular_name = $PostsName;

$labels->add_new = _x('Create', $PostsName);

$labels->add_new_item = 'Create New '.$PostsName;

$labels->edit_item = 'Edit '.$PostsName;

$labels->new_item = 'Add '.$PostsName;

$labels->view_item = 'View '.$PostsName;

$labels->search_items = 'Search '.$PostsName;

$labels->not_found = 'No '.$PostsName.' found';

$labels->not_found_in_trash = 'No '.$PostsName.' found in trash.';

}

add_action( 'init', 'idp_change_post_object_label' );

add_action( 'admin_menu', 'idp_change_post_menu_label' );