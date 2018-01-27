<?php

/*

Title: Plugin Lock

Version: 1.0

Last Updated: July 10, 2013

Description: Prevents deactivation of crucial plugins

array(
	array( {fieldtype:text,textarea,truefalse,info}, {name/id}, {label}, {help/info}, {defaultvalue}, {help/info css styles} ) 
)
*/

$FNKOP[basename(__FILE__, '.php')] = array(array('textarea', 'locked_plugins', 'Enter plugins as directory-name/plugin.php - one on each line'));

add_filter( 'plugin_action_links', 'idp_lock_plugins', 10, 4 );

function idp_lock_plugins( $actions, $plugin_file, $plugin_data, $context ) {
	$funkset = get_option('funktions');
	$locked = explode("\r\n",$funkset['locked_plugins']);
    // Remove edit link for all

    if ( array_key_exists( 'edit', $actions ) )

        unset( $actions['edit'] );

    // Remove deactivate link for crucial plugins

    if ( array_key_exists( 'deactivate', $actions ) && in_array( $plugin_file, $locked))

        unset( $actions['deactivate'] );

    return $actions;

}