<?php

/*

Title: Remove Versions Query

Version: 1.0

Last Updated: July 10, 2013

Description: Removes version queries from wordpress resources - ?ver=3.2.1

SETTING FORMAT
array(
	array( {fieldtype:text,textarea,truefalse,info}, {name/id}, {label}, {help/info}, {defaultvalue}, {help/info css styles} ) 
)
*/
$FNKOP[basename(__FILE__, '.php')] = array(array('info', '', '', 'Removes the ?ver=4.1.1 from all resource links for better caching', '','font-style:italic'));

add_filter( 'script_loader_src', 'idp_unversion' );

add_filter( 'style_loader_src', 'idp_unversion' );

function idp_unversion( $src ) {

	$src = remove_query_arg( 'ver', $src );

    return $src;

}